<?php
require "dmlFunctions.php";
session_start();
?>
<!DOCTYPE html>
<?php
//if (isset($_SESSION["type"])) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../css/perfil.css"/>
            <title></title>
        </head>
        <body>
            <div id="main">
                <div id="display">
                    <form method="post">
                        <div id="container">
                            <div id="profile_general_info">
                                <?php
                                $user = mysqli_fetch_assoc(select("u.image, u.username, u.name, u.pass, u.email, c.name AS city", "user u INNER JOIN city c ON u.id_city = c.id_city", "WHERE username = '".$_SESSION["username"]."'"));
                                ?>
                                <div id="image_box"><?php echo $user['image']; ?></div>
                                Username: <div id="username"><?php echo $user['username']; ?></div>
                                Name: <input type="text" name="name" value="<?php echo $user['name']; ?>"><br>
                                E-mail: <input type="email" name="email" value="<?php echo $user['email']; ?>"><br>
                                City: <div id="city"><?php echo $user['city']; ?></div><br>
                            </div>
                            <div id="profile_specific_info"><?php
                                switch ($_SESSION["type"]) {
                                    case 1:
                                        $musician = mysqli_fetch_assoc(select("m.artist_name, g.name AS genre, m.surname, m.phone, m.web, m.group_size", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre"));
                                        echo("Artist Name: <div id='artist_name'>" . $musician['artist_name'] . "</div>
                                        Genre: <div id='genre'>" . $musician['genre'] . "</div>
                                        Surname: <div id='surname'>" . $musician['surname'] . "</div>
                                        Phone: <div id='phone'>" . $musician['phone'] . "</div>
                                        Webpage: <div id='webpage'>" . $musician['web'] . "</div>
                                        Group Size: <div id='group_size'>" . $musician['group_size'] . "</div>");
                                        echo("<input type='submit' name='button' value='Modificar datos'>");
                                        break;
                                    case 2:
                                        $locals = selectFields("phone, capacity, web", "local");
                                        $local = mysqli_fetch_assoc($locals);
                                        echo("Phone number: <div id='phone'>" . $local['phone'] . "</div>
                                        Max Capacity: <div id='capacity'>" . $local['capacity'] . "</div>
                                        Webpage: <div id='webpage'>" . $local['web'] . "</div>");
                                        echo("<input type='submit' name='button' value='Modificar datos'>");
                                        break;
                                    case 3:
                                        $fans = selectFields("phone, address, surname", "fan");
                                        $fan = mysqli_fetch_assoc($fans);
                                        echo("Phone number: <div id='phone'>" . $fan['phone'] . "</div>
                                        Address: <div id='address'>" . $fan['address'] . "</div>
                                        Surname: <div id='surname'>" . $fan['surname'] . "</div>");
                                        echo("<input type='submit' name='button' value='Modificar datos'>");
                                        break;
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </body>
    </html>
    <?php
    if(isset($_POST["button"])){

    }
//}
?>
