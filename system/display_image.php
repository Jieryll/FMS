<?php

include('../Mysql/connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); 

    $stmt = $conn->prepare("SELECT image FROM announcements WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imageData);
    $stmt->fetch();
    $stmt->close();
    header("Content-Type: image/jpeg");
    echo $imageData;
}

$conn->close();
?>
