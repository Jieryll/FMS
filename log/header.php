<?php
ob_start();
    include("Mysql/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/signup.css">
</head>
<style>
    
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

img{
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

</style>
<body>
    <div class="header-fixed">
        <div class="header">
            <div class="left">
                <img src="images&logo/Association-.png">
            </div>
            <div class="right">
                <div><a href="./index.php">Home</a></div>
                <div><a href="./index-ab.php">About</a></div>
                <div><a href="./index-ab.php">Announcements</a></div>
                <div><a href="./index-ab.php">Community Forum</a></div>
                <div><a id="open" >Login</a></div>
                <div><a href="log/signin.php" >SignUp</a></div>
            </div>
        </div>
        <div class="login-popup" id="login">
            <div class="alignment">
                <div class="login-container">
                    <div class="close-design">
                    <div><span class="close">&times;</span></div>
                        </div>
                    <div class="login-form">
                        <h2>LOGIN</h2>
                        <form action="system/login.php" method="POST">
                            <div class="input-group">
                                <input type="text" name="User" placeholder="Username or Number" required>
                            </div>
                            <div class="input-group">
                                <div><input type="password" name="Pass" placeholder="Password" required></div>
                            </div>
                            <div class="pass-align">
                                <button type="submit">Submit</button>
                            </div>
                            <div class="links">
                                <div><a class="acc" href="#" id="open_fp">Forgot Password</a></div>
                            </div>
                        </form>
                    </div>
                    <div class="background-section">
                        <p></p>
                    </div>
                    <script src="js/pop-up.js"></script>
                </div>
            </div>
        </div>
    </div>
    <script>

        var sp= document.getElementById("sp");
        var sp_open= document.getElementById("open_sp");
        var sp_close= document.getElementsByClassName("spclose")[0];
        sp_open.onclick = function(event) {
            event.preventDefault();
            sp.style.display = "block";
        }
        sp_close.onclick = function() {
            sp.style.display = "none";
        }
    </script>
</body>
</html>
