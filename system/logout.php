<?php
include('../Mysql/connection.php');

session_start(); 


if (isset($_POST['logout']) && isset($_SESSION['username'])) {
    $username = $_SESSION['username']; 
    $stmt = $conn->prepare("UPDATE accounts SET statuss = 'offline' WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
    session_destroy();
    header("Location: ../index.php");
    exit();
}
?>

?>
