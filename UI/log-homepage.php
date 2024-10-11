<?php
    include('../Mysql/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers Registration</title>
    <link rel="" href="../images&logo/Association-.png" type="image/x-icon">
    <link rel="icon" href="../images&logo/Association-.png" type="image/x-icon">
</head>
<body style="background-color:#01204E;">
    <div class="content">
        <div class="left-fp">
            <div class="h1">
                <h1>WELCOME</h1>
            </div>
            <div class="paragraph">
                <p>The Farmers Monitoring System for Subsidies is designed to empower barangay officials in managing and distributing agricultural subsidies efficiently. Our system provides a streamlined approach to monitor, track, and support the farmers in your community.</p>
            </div>
            <div>
                <a href="index-ab.php" id="open"><button >Learn more</button></a>
            </div>
        </div>
    </div> 
</body>
</html>
<style>
    body{
    background-image: url("../Images&logo/bg.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    backdrop-filter: blur(5px);
}
.content{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}
.paragraph{
    width: 50%;
    text-justify: auto;
}
.left-fp{
    display: flex;
    flex-direction: column;
    text-align: center;
    justify-content: center;
    align-items: center;
    align-content: center;
}

button{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 40px;
    padding:20px;
    font-size: 15px;
    font-weight: bold;
    border-radius: 10px;
    cursor: pointer;
}
button:hover{
    background-color: #028391;
    color: #F6DCAC;
}
.right-fp{
    width: 100%;
}



</style>