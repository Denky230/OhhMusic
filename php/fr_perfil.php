<?php
require "dmlFunctions.php";
session_start();
?>
<!DOCTYPE html>
<?php
if(isset($_POST["button"])){
    if($_SESSION["type"] == 1){
        updateUser("name", $_POST['name'], "email", $_POST['email'], $_SESSION["id_user"]);
        updateMusician("artist_name", $_POST["artist_name"], "id_genre", $_POST["genre"], "surname", $_POST["surname"],
            "phone", $_POST["phone"], "web", $_POST["web"], "group_size", $_POST["group_size"]);
    }elseif ($_SESSION["type"] == 2){
        updateUser("name", $_POST['name'], "email", $_POST['email'], $_SESSION["id_user"]);
        updateLocal("phone", $_POST["phone"], "capacity", $_POST["capacity"], "web", $_POST["web"]);
    }elseif($_SESSION["type"] == 3){
        updateUser("name", $_POST['name'], "email", $_POST['email'], $_SESSION["id_user"]);
        updateFan("phone", $_POST["phone"], "address", $_POST["address"], "surname", $_POST["surname"]);
    }
}
?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../css/frame.css"/>
            <link rel="stylesheet" href="../css/perfil.css"/>
            <title></title>
        </head>
        <body>
            <div id="display">
                <form method="post">
                    <div id="top-part">
                        <?php
                        $user = mysqli_fetch_assoc(select("u.image, u.username, u.name, u.pass, u.email, c.name AS city", "user u INNER JOIN city c ON u.id_city = c.id_city", "WHERE id_user = '".$_SESSION["id_user"]."'"));
                        ?>
                        <div id="image_box"><?php echo $user['image']; ?></div>
                    </div>
                    <div id="container">
                        <div id="profile_general_info">
                            <?php
                            $user = mysqli_fetch_assoc(select("u.image, u.username, u.name, u.pass, u.email, c.name AS city", "user u INNER JOIN city c ON u.id_city = c.id_city", "WHERE id_user = '".$_SESSION["id_user"]."'"));
                            ?>
                            Username: <input type="text" name="username" value="<?php echo $user['username']; ?>" disabled><br>
                            Name: <input type="text" name="name" value="<?php echo $user['name']; ?>"><br>
                            E-mail: <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
                            City:
                            <select name="city">
                                <option></option>
                            </select>
                            <input type="text" name="city" value="<?php echo $user['city']; ?>" disabled><br>
                        </div>
                        <div id="profile_specific_info">
                            <?php
                            switch ($_SESSION["type"]) {
                                case 1:
                                    $musician = mysqli_fetch_assoc(select("m.artist_name, g.name AS genre, m.surname, m.phone, m.web, m.group_size", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre INNER JOIN user ON id_musician = id_user", "WHERE id_user = '".$_SESSION["id_user"]."'"));
                                    echo("Artist:<input type='text' name='artist_name' value='" . $musician['artist_name'] . "'><br>
                                    Genre: <select name = 'genre' >");
                                    $genres = selectFields("*", "genre");
                                    echo("<option disabled>" . $musician["genre"] . "</option>");
                                    while($genre = mysqli_fetch_assoc($genres)) {
                                        echo("<option value = '". $genre['id_genre'] ."' > ". $genre['name'] ." </option >");
                                    }
                                    echo("</select ><br >
                                    Surname:<input type='text' name='surname' value='" . $musician['surname'] . "'><br>
                                    Phone:<input type='number' name='phone' value='" . $musician['phone'] . "'><br>
                                    Webpage:<input type='text' name='web' value='" . $musician['web'] . "'><br>
                                    Group Size:<input type='number' name='group_size' value='" . $musician['group_size'] . "'>");
                                    break;
                                case 2:
                                    $local = mysqli_fetch_assoc(select("phone, capacity, web", "local INNER JOIN user", "WHERE id_user = '".$_SESSION["id_user"]."'"));
                                    echo("Phone number: <input type='number' name='phone' value='" . $local['phone'] . "'><br><br>
                                    Max Capacity: <input type='number' name='capacity' value='" . $local['capacity'] . "'><br>
                                    Webpage: <input type='text' name='web' value='" . $local['web'] . "'>");
                                    break;
                                case 3:
                                    $fan = mysqli_fetch_assoc(select("phone, address, surname", "fan INNER JOIN user", "WHERE id_user = '".$_SESSION["id_user"]."'"));
                                    echo("Phone number: <input type='number' name='phone' value='" . $fan['phone'] . "'><br>
                                    Address: <input type='text' name='address' value='" . $fan['address'] . "'><br>
                                    Surname: <input type='text' name='surname' value='" . $fan['surname'] . "'>");
                                    break;
                            }
                            ?>
                        </div>
                    </div>
                    <div id="submit_Button">
                        <input type='submit' name='button' value='Modificar datos'><br>
                    </div>
                </form>
            </div>
        </body>
    </html>

