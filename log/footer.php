<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <footer>
        <div class="layout">
            <div class="contacts">
                <div><p>Contact Us on: </p></div>
                <div class="footer">
                    <div><a href="https://www.facebook.com/profile.php?id=100094979312022" target="_blank"><img class="con-icon" id="gmail" src="images&logo/fb.png" style=""></a></div>
                    <div><a href="https://mail.google.com/mail/?view=cm&fs=1&to=jieryllden@gmail.com&su=&body=" target="_blank"><img class="con-icon" id="gmail" src="images&logo/gmail.png"></a></div>
                    <div><p>09475393023</p></div>
                </div>
            </div>
            <div ><p> &copy; 2024 All RIght Reserves</p></div>
            <div class="contacts">
                <div>
                    <h3>Languages</h3>
                </div>
                <div class="language">
                    <div><a>Bisaya</a></div>
                    <div><a>Tagalog</a></div>
                    <div><a>English</a></div>
                </div>
            </div>
        </div>
        
    </footer>
</body>
</html>
<style>

.language{
    display: flex;
    flex-direction: row;
    gap: 40px;
}
footer{
    color: #FEAE6F; 
    background-color: rgb(6, 66, 30);
}
.footer{
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 20px;
}
.contacts{
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 20px;
}
.layout{
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-around;
}
.img{
    border-radius: 20px;
    width: 100vh;
    height: 80vh;
}
.con-icon{
   border-width: 2px solid black ;
   width: 50px;
   height: auto;
}
.con-icon:hover{
    box-shadow: 0 4px 10px rgba(0, 0, 0, 5);
}
</style>
