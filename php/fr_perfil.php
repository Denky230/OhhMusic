<?php
require_once 'dmlFunctions.php';
session_start();

if (isset($_POST["edit"])){
    // Update user fields
    updateMultiple("user", array("name", "email"), array($_POST['name'], $_POST['email']), "WHERE id_user = ".$_SESSION["id_user"]);

    extract($_POST);
    // Update non-user fields
    switch ($_SESSION["type"]) {
        case 1:
            updateMultiple("musician",
                array("artist_name", "id_genre", "surname", "phone", "web", "group_size"),
                array($artist_name, $genre, $surname, $phone, $web, $group_size ),
                "WHERE id_musician = ".$_SESSION["id_user"]);
            break;
        case 2:
            updateMultiple("local",
                array("phone", "capacity", "web"),
                array($phone, $capacity, $web),
                "WHERE id_local = ".$_SESSION["id_user"]);
            break;
        case 3:
            updateMultiple("fan",
                array("phone", "address", "surname"),
                array($phone, $address, $surname),
                "WHERE id_fan = ".$_SESSION["id_user"]);
            break;
        default:
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/perfil.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/functions.js"></script>
        <script src="../js/account.js"></script>
    </head>
    <body>
        <div id="main">
            <form method="POST">
                <?php
                $user = mysqli_fetch_assoc(select("u.image, u.username, u.name, u.pass, u.email, c.name AS city", "user u INNER JOIN city c ON u.id_city = c.id_city", "WHERE id_user = '".$_SESSION["id_user"]."'"));
                ?>
                <input type='submit' id='edit_submit' name='edit' value='Modificar datos'>
                <div id="container">
                    <div id="profile_general_info">
                        <?php
                        $user = mysqli_fetch_assoc(select("u.image, u.username, u.name, u.pass, u.email, c.name AS city", "user u INNER JOIN city c ON u.id_city = c.id_city", "WHERE id_user = '".$_SESSION["id_user"]."'"));
                        ?>
                        <div id="profile_img"></div>                        
                        <div id='fieldTitle'>Username:</div>
                        <input type="text" name="username" value="<?php echo $user['username']; ?>" disabled>
                        <div id='fieldTitle'>Name:</div>
                        <input type="text" name="name" value="<?php echo $user['name']; ?>">
                        <div id='fieldTitle'>E-mail:</div>
                        <input type="email" name="email" value="<?php echo $user['email']; ?>">
                        <div id='fieldTitle'>CCAA:</div>
                        <select name="community" id="community_select" onchange="updateCities()">
                            <?php
                            $communities = select("distinct community", "city");
                            while ($community = mysqli_fetch_assoc($communities)){
                                echo "<option>".$community["community"]."</option>";
                            }
                            ?>
                        </select>
                        <div id="fieldTitle">Provincia:</div>
                        <div id="citySelect"></div>
                    </div>
                    <div id="profile_specific_info">
                        <?php
                        switch ($_SESSION["type"]) {
                            case 1:
                                $musician = mysqli_fetch_assoc(select("artist_name, id_genre, surname, phone, web, group_size", "musician", "WHERE id_musician = '".$_SESSION["id_user"]."'"));
                                echo "<div id='fieldTitle'>Artist:</div><input type='text' name='artist_name' value='".$musician['artist_name']."'>";

                                $genres = select("*", "genre");
                                echo "<div id='fieldTitle'>Genre:</div><select name='genre'>";
                                while($genre = mysqli_fetch_assoc($genres)) {
                                    if ($genre["id_genre"] === $musician["id_genre"])
                                        echo "<option value='".$genre['id_genre']."' selected>".$genre['name']."</option>";
                                    else echo "<option value='".$genre['id_genre']."'>".$genre['name']."</option>";                                    
                                }
                                echo "</select>";

                                echo "<div id='fieldTitle'>Surname:</div><input type='text' name='surname' value='".$musician['surname']."'>
                                    <div id='fieldTitle'>Phone:</div><input type='number' name='phone' value='".$musician['phone']."'>
                                    <div id='fieldTitle'>Webpage:</div><input type='text' name='web' value='".$musician['web']."'>
                                    <div id='fieldTitle'>Group Size:</div><input type='number' name='group_size' value='".$musician['group_size']."'>";
                                break;
                            case 2:
                                $local = mysqli_fetch_assoc(select("phone, capacity, web", "local", "WHERE id_local = '".$_SESSION["id_user"]."'"));
                                echo "<div id='fieldTitle'>Phone number:</div><input type='number' name='phone' value='".$local['phone']."'>
                                    <div id='fieldTitle'>Max Capacity:</div><input type='number' name='capacity' value='".$local['capacity']."'>
                                    <div id='fieldTitle'>Webpage:</div><input type='text' name='web' value='".$local['web']."'>";
                                break;
                            case 3:
                                $fan = mysqli_fetch_assoc(select("phone, address, surname", "fan", "WHERE id_fan = '".$_SESSION["id_user"]."'"));
                                $fan = mysqli_fetch_assoc(select("phone, address, surname", "fan", "WHERE id_fan = '".$_SESSION["id_user"]."'"));
                                $fan = mysqli_fetch_assoc(select("phone, address, surname", "fan", "WHERE id_fan = '".$_SESSION["id_user"]."'"));
                                echo "<div id='fieldTitle'>Phone number:</div><input type='number' name='phone' value='".$fan['phone']."'>
                                    <div id='fieldTitle'>Address:</div><input type='text' name='address' value='".$fan['address']."'>
                                    <div id='fieldTitle'>Surname:</div><input type='text' name='surname' value='".$fan['surname']."'>";
                                break;
                        }
                        ?>
                    </div>
                </div>
            </form>
        </div>        
    </body>
</html>