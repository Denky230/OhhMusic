<?php
require "dmlFunctions.php";
session_start();
?>
<!DOCTYPE html>
<?php
if (isset($_SESSION["type"])) {
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
            <div id="container">
                <div id="profile_general_info"><?php $users = selectFields("image, username, name, email, city", "user");
                                                     $user = mysqli_fetch_assoc($users);?>
                    <div id="image_box"><?php $user['image']; ?></div>
                    Username: <div id="username"><?php $user['username']; ?></div>
                    Name: <div id="name"><?php $user['name']; ?></div>
                    E-mail: <div id="email"><?php $user['email']; ?></div>
                    City: <div id="city"><?php $user['city']; ?></div>
                </div>
                <div id="profile_specific_info"><?php
                        switch ($_SESSION["type"]) {
                            case 1:
                                $musicians = selectFields("artist_name, genre, surname, phone, web, group_size", "musician");
                                $musician = mysqli_fetch_assoc($musicians);
                                echo("Artist Name: <div id='artist_name'>" . $musician['artist_name'] ."</div>
                        Genre: <div id='genre'>". $musician['genre'] ."</div>
                        Surname: <div id='surname'>" . $musician['surname'] . "</div>
                        Phone: <div id='phone'>" . $musician['phone'] ."</div>
                        Webpage: <div id='webpage'>" . $musician['web'] . "</div>
                        Group Size: <div id='group_size'>" . $musician['group_size'] . "</div>");
                                break;
                            case 2:
                                $locals = selectFields("phone, capacity, web", "local");
                                $local = mysqli_fetch_assoc($locals);
                                echo("Phone number: <div id='phone'>" . $local['phone'] . "</div>
                        Max Capacity: <div id='capacity'>" . $local['capacity'] . "</div>
                        Webpage: <div id='webpage'>" . $local['web'] . "</div>");
                                break;
                            case 3:
                                $fans = selectFields("phone, address, surname", "fan");
                                $fan = mysqli_fetch_assoc($fans);
                                echo("Phone number: <div id='phone'>" . $fan['phone'] . "</div>
                        Address: <div id='address'>" . $fan['address'] . "</div>
                        Surname: <div id='surname'>" . $fan['surname'] . "</div>");
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
}
?>
