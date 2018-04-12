<?php
require_once 'dmlFunctions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/home.css"/>
        <title>Home</title>
    </head>
    <body>
        <!-- BODY -->
        <div id="main">
            <div id="frameTitle"><h2>CONCIERTOS</h2></div>
            <div id="concerts">
                <div id="concert_box">
                    <img id="concert_img" src="../media/random.jpg" alt="">
                    <div id="concert_info">
                        <h2>NombreLocal</h2>
                        <h2>LugarLocal</h2>
                        <h2>TelfLocal</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- RIGHT FRAME -->
        <aside id="frame_right">
            <div id="musiciansByGenre">
                <p>MUSICOS BY GENRE:</p>
                <div id="musiciansByGenre_btns">
                    <form action="fr_musiciansByGenre.php" method="GET">
                        <?php
                        // Select every genre played by min 1 musician
                        $genres = selectFields("name", "genre", "WHERE id_genre IN (SELECT id_genre FROM musician)");
                        while ($genre = mysqli_fetch_assoc($genres)){
                            echo "<input type='submit' name='genre' value='".strtoupper($genre["name"])."'>";
                        }
                        ?>
                    </form>
                </div>
            </div>
            <div id="propertiesByCity">
                <p>LOCALES BY CITY:</p>                
                <div id="propertiesByCity_btns">
                    <form action="fr_localesByCity.php" method="GET">
                        <?php
                        // Select every city which contains min 1 local
                        $cities = selectFields("name", "city", "WHERE id_city IN (SELECT id_city FROM user WHERE user.type = 2 GROUP BY id_city)");
                        while ($city = mysqli_fetch_assoc($cities)){
                            echo "<input type='submit' name='city' value='".strtoupper($city["name"])."'>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </aside>
    </body>
</html>
