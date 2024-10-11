<?php
session_start();
include('../Mysql/connection.php');

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit(); 
}
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<style>
    *{
        padding:0;
        margin:0;
    }
    .header-fixed {
    font-size: 20px;
    font-family: sans-serif;
    display: flex;
    justify-content: space-between;
    position: fixed; 
    top: 0;
    width: 100%;
    background-color: #043627; 
}

.img{
    width: 100px;
    height: 100px;
}
.header{
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    background-color: #043627;
    width: 100%;
}
.right{
    display: flex;
    flex-direction: row;
    gap: 40px;
}
a{
    cursor: pointer;
    color: #FEAE6F;
    text-decoration: none;
}
a:hover{
    cursor: pointer;
    color: #F6DCAC;
}
input::placeholder {
  font-size: 15px;
}
.logged-use{
    display: flex;
    flex-direction: row;
    width: 50px;
    background: blue;
}
</style>
<body>
    <div class="header-fixed">
        <div class="header">
            <div class="left">
                <img class="img" src="../images&logo/Association-.png" alt="">
            </div>
            <div class="right">
                <div><a href="logHome.index.php">Home</a></div>
                <div><a href="logAbout.index.php">About</a></div>
                <div><a href="logAnnouncement.index.php">Announcements</a></div>
                <div><a href="logCommunity.index.php">Community Forum</a></div>
                <div class="logged-user">
                    <div><a href="#"><?php echo $username;?></a></div>
                    <select id="userOptions" onchange="handleDropdownChange(this)">
                        <option value=""></option>
                        <option value="profile">Profile</option>
                        <option value="logout">Logout</option>
                    </select>
                    <form id="logoutForm" method="POST" action="../system/logout.php">
                        <input type="hidden" name="logout" value="1">
                    </form>
                </div>
            </div>
        </div>  
    </div>
</body>
</html>
<script>
function handleDropdownChange(select) {
    const value = select.value;
    if (value === "profile") {
        window.location.href = "profile.php";
    } else if (value === "logout") {
        document.getElementById('logoutForm').submit();
    }
}


window.addEventListener('beforeunload', function() {
    const formData = new FormData();
    formData.append('status', 'offline');

    navigator.sendBeacon('../system/update_statuslogout.php', formData);
});
</script>
