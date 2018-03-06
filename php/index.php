<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/base.css"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Home</title>
    </head>
    <body>
        <header id="header">
            <div id="langs">ESPAÑOL</div>
            <div id="title"><h1>OHH MUSIC</h1></div>
            <div id="account">
                <div id="login">LOG IN</div> / <div id="signup">SIGN UP</div>
            </div>
            <img id="search_icon" src="../media/search.png">
            <form method="POST">
                <input id="search_bar" type="text" name="search" placeholder="Busca grupos, conciertos, locales..." required>
            </form>
        </header>
        
        <aside id="frame_left">
            <div id="groupBanner_left">group banner here</div>
            <div id="adBanner_left">ad here</div>
        </aside>
        
        <iframe id="main" src="fr_home.php"></iframe>
        
        <div id="modal">
            <div id="modal_login">
                <h2>LOGIN</h2>
                <form method="POST">
                    <input type="text" name="username" id="login_username" placeholder="Username" required><br>
                    <input type="password" name="pass" placeholder="Password" required><br>
                    <input type="submit" value="Log in">
                </form>
            </div>
            <div id="modal_signup">
                <form method="POST">
                    
                </form>
            </div>
        </div>
        
        <script src="../js/search.js"></script>
        <script src="../js/account.js"></script>
    </body>
</html>
