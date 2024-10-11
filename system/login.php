<?php
session_start();

include('../Mysql/connection.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = isset($_POST["User"]) ? trim($_POST["User"]) : null;
    $pass = isset($_POST["Pass"]) ? trim($_POST["Pass"]) : null;


    $stmt = $conn->prepare("SELECT username, password FROM accounts WHERE (username = ? OR number = ?) AND statuss = 'offline'");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();
    

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($pass === $row['password']) {
            $_SESSION['username'] = $row['username'];
            
            $updateStmt = $conn->prepare("UPDATE accounts SET statuss = 'online' WHERE username = ?");
            $updateStmt->bind_param("s", $row['username']);
            
            if ($updateStmt->execute()) {
                echo '<script>alert("Successfully Logged In"); window.location.href = "../UI/logHome.index.php";</script>';
            } else {
                echo '<script>alert("Error updating status. Please try again.");</script>';
            }

            $updateStmt->close();
        } else {
            echo '<script>alert("Incorrect password.");</script>';
            echo '<script>location.href="../index.php";</script>';
        }
    } else {
        echo '<script>alert("User not found");</script>';
        echo '<script>location.href="../index.php";</script>';
    }

    $stmt->close();
}

$conn->close();
?>
