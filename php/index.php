<?php
require_once 'dmlFunctions.php';
session_start();

/* ---- GITANADA (?) ---- */
if (isset($_GET["close"])){
    session_destroy();
    header("Location: index.php"); // Refresh site + remove $_GET["close"]
}
/* ---------------------- */
if (isset($_POST["signup_submit"])){
    // INSERT USER
    extract($_POST);
    
    insert("user", "0, $userType, '$username', '".password_hash($pass, PASSWORD_DEFAULT)."', '$name', '$email', '$city', 0");
    // Get last registered user's ID
    $lastUserID = select_value("max(id_user)", "user");
    
    switch ($userType){
        case 1: // MUSICIAN
            insert("musician", "'$lastUserID', '$artistName', '$genre', '$surname', '$phone', '$web', '$groupSize'");
            break;
        case 2: // LOCAL
            insert("local", "'$lastUserID', '$phone', '$capacity', '$web'");
            break;
        case 3: // FAN
            insert("fan", "'$lastUserID', '$phone', '$address', '$surname'");
            break;
    }
} else if (isset($_POST["login_submit"])){
    // VALIDATE USER
    $userData = mysqli_fetch_assoc(select("pass, type", "user", "WHERE username = '".$_POST["username"]."'"));
    if (password_verify($_POST["pass"], $userData["pass"])){
        $_SESSION["type"] = $userData["type"];
        $_SESSION["id_user"] = select_value("id_user", "user", "WHERE username = '".$_POST["username"]."'");
        header("Location: index.php?user");
    } else {
        echo "incorresto";
    }
}
/* ------------- TEST ------------- */
if (isset($_POST["quickAdd"])){
    for ($i = 0; $i < $_POST["quickAdd"]; $i++){
        switch ($_POST["qa_usertype"]){
            case 1: // MUSICIAN
                $numM = mysqli_num_rows(select("*", "musician")) + 1;

                insert("user", "0, ".$_POST["qa_usertype"].", 'M".str_pad($numM, 2, '0', STR_PAD_LEFT)."', '".password_hash(123, PASSWORD_DEFAULT)."', 'musi', 'mus@ician.com', 1, 0");

                // Get last registered user's ID
                $lastUserID = select_value("max(id_user)", "user");
                insert("musician", "'$lastUserID', 'M".str_pad($numM, 2, '0', STR_PAD_LEFT)."', 1, 'cian', 12345, 'web', 1");
                break;
            case 2: // LOCAL
                $numL = mysqli_num_rows(select("*", "local")) + 1;

                insert("user", "0, ".$_POST["qa_usertype"].", 'L".str_pad($numL, 2, '0', STR_PAD_LEFT)."', '".password_hash(123, PASSWORD_DEFAULT)."', 'L".str_pad($numL, 2, '0', STR_PAD_LEFT)."', 'lo@cal.com', 1, 0");

                // Get last registered user's ID
                $lastUserID = select_value("max(id_user)", "user");
                insert("local", "'$lastUserID', 12345, 5, 'web'");
                break;
            case 3: // FAN
                $numF = mysqli_num_rows(select("*", "fan")) + 1;

                insert("user", "0, ".$_POST["qa_usertype"].", 'F".str_pad($numF, 2, '0', STR_PAD_LEFT)."', '".password_hash(123, PASSWORD_DEFAULT)."', 'fan', 'fan@felis.com', 1, 0");

                // Get last registered user's ID
                $lastUserID = select_value("max(id_user)", "user");
                insert("fan", "'$lastUserID', 12345, 'MaHause', 'felis'");
                break;
        }
    }    
}
/*
echo "SESSION:<br>";
foreach ($_SESSION as $key => $value){
    echo "$key - $value<br>";
}
echo "POST:<br>";
foreach ($_POST as $key => $value){
    echo "$key - $value<br>";
}
echo "GET:<br>";
foreach ($_GET as $key => $value){
    echo "$key - $value<br>";
}
 ------------- TEST ------------- */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/base.css"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Ohh Music</title>
    </head>
    <body>
        <!-- SITE HEADER -->
        <header id="header">
            <div id="langs">ESPAÑOL</div>            
            <div id="title"><h1><a href="index.php">OHH MUSIC</a></h1></div>
            <div id="account">
                <?php
                // Check if there's a user logged in
                if (isset($_SESSION["type"])){
                    // $_GET["close"] --> destroy session // $_GET["user"] --> user page
                    echo "<a href='index.php?close'>CLOSE SESSION</a>&nbsp/
                          <a href='index.php?profile'>MY PROFILE</a>&nbsp/
                          <a href='index.php?user'>MY PAGE</a>";
                } else {
                    echo "<div id='login_btn'>LOG IN</div> / <div id='signup_btn'>SIGN UP</div>";
                }
                ?>
            </div>
            <img id="search_icon" src="../media/search.png">
            <form method="GET">
                <input id="search_bar" type="text" name="search" placeholder="Busca grupos, conciertos, locales..." required>
                <div id="display"></div>
            </form>
        </header>
        <!-- LEFT FRAME -->
        <aside id="frame_left">
            <div id="groupBanner_left"><iframe id="main" src="slider.php"></iframe></div>
            <div id="adBanner_left">ad here</div>
        </aside>
        <!-- SITE BODY (iFRAME) -->
        <?php
        $iframe = "<iframe id='main' src='";
        // $_GET["user"] = user page
        if (isset($_GET["user"])) {
            if (isset($_SESSION["type"])) {
                switch ($_SESSION["type"]) {
                    case 1: // MUSICIAN
                        $iframe .= "fr_musico.php";
                        break;
                    case 2: // LOCAL
                        $iframe .= "fr_local.php";
                        break;
                    case 3: // FAN
                        $iframe .= "fr_fan.php";
                        break;
                    default:
                }
            }
        // $_GET["profile"] = user profile page
        } else if (isset($_GET["profile"])) {
            $iframe .= "fr_perfil.php";
        // $_GET["search"] = search page
        } else if (isset($_GET["search"])) {
            $iframe .= "fr_ajax_search.php?search=".$_GET["search"];
        // No $_GET = home page
        } else {
            $iframe .= "fr_home.php";
        }

        echo $iframe .= "'></iframe>";
        ?>
        <!-- MODAL -->
        <div id="modal">
            <!-- LOGIN FORM -->
            <!-- <div id="login_form">
                <h2>LOGIN</h2>
                <form method="POST" onsubmit="verifySignup()">
                    <input type="text" name="username" id="login_username" placeholder="Username" required>
                    <input type="password" name="pass" placeholder="Password" required>
                    <input type="submit" name="login_submit" value="Log in">
                </form>
            </div> -->
            <!-- REGISTER FORM -->
            <!-- <div id="signup_form">
                <h2><div id="signup_title"></div></h2>
                <form method="POST" onsubmit="verifySignup()">
                    <div id="signup_fields">
                        <div id="userSpecFields">
                            <input type="text" name="username" id="signup_username" placeholder="Username" maxlength="25" required>
                            <input type="password" name="pass" id="signup_pass"placeholder="Password" maxlength="12" required>
                            <input type="password" name="varPass" id="signup_verPass"placeholder="Verify password" maxlength="12" required>
                            <input type="text" name="name" placeholder="Name" maxlength="25" required>
                            <input type="email" name="email" placeholder="E-mail" maxlength="30" required>
                            <select name="community" id="community_select" onchange="updateCities()">
                                ?php
                                $communities = select("distinct community", "city");
                                while ($community = mysqli_fetch_assoc($communities)){
                                    echo "<option>".$community["community"]."</option>";
                                }
                                ?>
                            </select>
                            <div id="citySelect"></div>
                        </div>
                        <div id="nonUserSpecFields"></div>
                    </div>
                    <input type="submit" name="signup_submit" id="signup_submit" value="Sign up">
                </form> -->
                <!-- TEST -->
               <!--  <form method="POST">
                    <input type="number" name="quickAdd" id="quickAdd" placeholder="Quick Add (TESTING)">
                    <input type="hidden" name="qa_usertype" id="qa_usertype">
                    <input type="submit" value="ADD" id="quickAdd" onclick="getUserType()">
                </form> -->
                <!-- TEST -->
            </div>
        </div>
        <!-- SIGN UP - USER TYPE SELECT -->
        <div id="signup_select_modal">
            <div id="signup_select">
                <h3>Quieres ser...</h3>
                <select name="userType_select" id="userType_select">
                    <option value="1">Músico</option>
                    <option value="2">Local</option>
                    <option value="3">Fan</option>
                </select>
                <button type="button" id="register_btn">Registrar</button>
            </div>
        </div>
        <script src="../js/functions.js"></script>
        <script src="../js/search.js"></script>
        <script src="../js/account.js"></script>
        <script src="../js/test.js"></script>
    </body>
</html>
