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
                    <?php
                        $conciertos = select("c.*, u.*, m.*",
                            "concert c inner join user u on c.id_local=u.id_user
                            inner join musician m on c.id_musician=m.id_musician
                            inner join local l on c.id_local=l.id_local",
                            "where c.state = 1 order by c.concert_date, c.concert_time asc");
                        while($concierto = mysqli_fetch_assoc($conciertos)){
                            echo "
                                <div class='concert_box'>
                                    <img id='concert_img' src='../media/random.jpg'>
                                    <div id='concert_info'>
                                        <h2>" . $concierto['username'] ."</h2>
                                        <h2> " . $concierto['phone'] . " </h2>
                                        <h2> " . $concierto['concert_date'] . " </h2>
                                        <h2>". $concierto['concert_time'] ."</h2>
                                        <h2>". $concierto['artist_name'] ."</h2>
                                    </div>
                                </div>
                            ";
                        }
                    ?>
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
