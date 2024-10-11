<?php
include('../Mysql/connection.php');
session_start(); 


if (isset($_SESSION['username'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
        $username = $_SESSION['username']; 
        $status = $_POST['status'];

        if (!empty($status)) {
            $stmt = $conn->prepare("UPDATE accounts SET statuss = ? WHERE username = ?");
            $stmt->bind_param("ss", $status, $username);
            if ($stmt->execute()) {
                echo 'Status updated successfully!';
            } else {
                echo 'Failed to update status.';
            }
            $stmt->close();
        } else {
            echo 'Status is empty or invalid.';
        }
    } else {
        echo 'Invalid request or status not set.';
    }
    
    $conn->close(); 
} else {
    header('Location: ../index.php');
    exit();
}
?>
