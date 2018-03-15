<?php
require_once 'dmlFunctions.php';
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
/* ------ GITANADA ------ */
if (isset($_GET["close"])){
    session_destroy();
}
/* ---------------------- */
if (isset($_POST["reg_submit"])){
    // Insert user
    extract($_POST);
    switch ($_SESSION["type"]){
        case 'M':            
            insert("user", "0, 1, '$username', '".password_hash($pass, PASSWORD_DEFAULT)."', '$name', '$email', '$city', 0");
            $lastUserID = select_value("max(id_user)", "user");
            insert("musician", "'$lastUserID', '$artistName', '$genre', '$surname', '$phone', '$web', '$groupSize'");
            break;
        case 'L':
            insert("user", "0, 2, '$username', '".password_hash($pass, PASSWORD_DEFAULT)."', '$name', '$email', '$city', 0");
            $lastUserID = select_value("max(id_user)", "user");
            insert("local", "'$lastUserID', '$phone', '$capacity', '$web'");
            break;
        case 'F':
            insert("user", "0, 3, '$username', '".password_hash($pass, PASSWORD_DEFAULT)."', '$name', '$email', '$city', 0");
            $lastUserID = select_value("max(id_user)", "user");
            insert("fan", "'$lastUserID', '$phone', '$address', '$surname'");
            break;
    }
} else if (isset($_POST["login_submit"])){
    // Validate user
    $userData = mysqli_fetch_assoc(select("pass, type", "user", "WHERE username = '".$_POST["username"]."'"));
    if (password_verify($_POST["pass"], $userData["pass"])){
        $_SESSION["type"] = $userData["type"];        
        header("Location:index.php?pag=" . $userData["type"]);
    } else {
        echo "incorresto";
    }
}

echo "SESSION:<br>";
foreach ($_SESSION as $key => $value){
    echo "$key: $value<br>";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/base.css"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Home</title>
    </head>
    <body>
        <!-- SITE HEADER -->
        <header id="header">
            <div id="langs">ESPAÑOL</div>
            <div id="title"><h1><a href="index.php">OHH MUSIC</a></h1></div>
            <div id="account">
                <?php
                if (isset($_SESSION["type"])){ 
                    echo "<div id='profile'><a href='index.php?close'>CLOSE SESSION</a></div>";
                } else {
                    echo "<div id='login_btn'>LOG IN</div> / <div id='signup_btn'>SIGN UP</div>";
                }
                ?>
            </div>
            <img id="search_icon" src="../media/search.png">
            <form method="POST">
                <input id="search_bar" type="text" name="search" placeholder="Busca grupos, conciertos, locales..." required>
            </form>
        </header>
        <!-- LEFT FRAME -->
        <aside id="frame_left">
            <div id="groupBanner_left">group banner here</div>
            <div id="adBanner_left">ad here</div>
        </aside>
        <!-- SITE BODY (iFRAME) -->
        <?php
        if (isset($_GET["pag"])){
            switch ($_GET["pag"]){
                case "1": // MUSICIAN
                    echo "<iframe id='main' src='fr_musico.php'></iframe>";
                    break;
                case "2": // LOCAL
                    echo "<iframe id='main' src='fr_local.php'></iframe>";
                    break;
                case "3": // FAN
                    echo "<iframe id='main' src='fr_fan.php'></iframe>";
                    break;
            }
        } else {
            echo "<iframe id='main' src='fr_home.php'></iframe>";
        }            
        ?>
        <!-- MODAL -->
        <div id="modal">
            <!-- LOGIN FORM -->
            <div id="login_form">
                <h2>LOGIN</h2>
                <form method="POST">
                    <input type="text" name="username" id="login_username" placeholder="Username" required>
                    <input type="password" name="pass" placeholder="Password" required>
                    <input type="submit" name="login_submit" value="Log in">
                </form>
            </div>
            <!-- REGISTER FORM -->
            <div id="signup_form">
                <h2>REGISTRO</h2>
                <form method="POST">
                    <div id="signup_fields">
                        <div id="userSpecFields">
                            <input type="text" name="username" id="signup_username" placeholder="Username" maxlength="25" required>
                            <input type="password" name="pass" placeholder="Password" maxlength="255" required>
                            <input type="text" name="name" placeholder="Name" maxlength="25" required>
                            <input type="email" name="email" placeholder="E-mail" maxlength="30" required>
                            <select name="province" id="sel_province" onchange="updateCities()">
                                <?php
                                $provinces = selectFields("province", "city", "GROUP BY province");
                                while ($province = mysqli_fetch_assoc($provinces)){
                                    echo "<option>".$province["province"]."</option>";
                                }
                                ?>
                            </select>
                            <div id="citySelect"></div></div>
                        <div id="nonUserSpecFields"></div>
                    </div>
                    <!--
                    <select name="city" id="sel_city">
                        <?php
                        /*
                        $p = $_GET['p'];
                        $cities = select("name", "city", "WHERE province = '$p' ORDER BY name");
                        while ($city = mysqli_fetch_assoc($cities)){
                            echo "<option>".$city["name"]."</option>";
                        }
                        */
                        ?>
                    </select>
                    -->
                    <input type="submit" name="reg_submit" value="Sign up">
                </form>
            </div>
        </div>
        <!-- SIGN UP - USER TYPE SELECT -->
        <div id="signup_bg">
            <div id="signup_select">
                <h3>Quieres ser...</h3>
                <select name="userType_select" id="userType_select">
                    <option value="M">Musician</option>
                    <option value="L">Local</option>
                    <option value="F">Fan</option>
                </select>
                <button type="button" id="signup_select_btn">Registrar</button>
            </div>    
        </div>
        <script src="../js/search.js"></script>
        <script src="../js/account.js"></script>
    </body>
</html>