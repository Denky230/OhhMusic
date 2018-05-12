<?php
require_once 'dmlFunctions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/home.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/home.js"></script>        
    </head>
    <body>
        <!-- BODY -->
        <div id="main">
            <div id="frameTitle"><h2>CONCIERTOS</h2></div>
            <div id="concerts">
                    <?php
                        $concerts = select("*, u.name as 'nombre', y.name as province",
                            "concert c inner join user u on c.id_local=u.id_user
                            inner join musician m on c.id_musician=m.id_musician
                            inner join local l on c.id_local=l.id_local
                            inner join city y on u.id_city = y.id_city",
                            "where c.state = 1 and c.concert_date > current_date
                            order by c.concert_date, c.concert_time asc");
                        while ($concert = mysqli_fetch_assoc($concerts)){
                            /* CONCERT BOX */
                            echo "
                                <div class='concert_box'>
                                    <img id='concert_img' src='../media/random.jpg'>
                                    <div id='concert_info'>
                                        <div class='concert_info_title'>
                                            <img src='../media/icons8-micrófono-2-filled-50.png'>
                                            <span>".$concert['artist_name']."</span>                                           
                                            <img src='../media/icons8-cabaña-filled-50.png'>
                                            <span>".$concert['nombre']."</span>
                                        </div>
                                        <div class='concert_info_title'>
                                            <img src='../media/icons8-marker-filled-50.png'>
                                            <span>".$concert['province']."</span>                                           
                                            <img src='../media/icons8-smartphone-con-pantalla-táctil-26.png'>
                                            <span>".$concert['phone']."</span>
                                        </div>
                                        <div class='concert_info_title'>
                                            <img src='../media/icons8-calendar-64.png'>
                                            <span>".$concert['concert_date']."</span>                                           
                                            <img src='../media/icons8-reloj-64.png'>
                                            <span>".$concert['concert_time']."</span>
                                        </div>
                                    </div>
                                </div>                               
                            ";
                        }
                    ?>
            </div>
        </div>

        <!-- RIGHT FRAME -->

        <aside id="frame_right">
            <div id="mostVotedMusicians">
                <span>TOP MUSICIANS</span>
                <div id="mostVotedMusicians_btns">
                    <form action="fr_mostVotedMusicians.php" method="GET">
                        <?php
                            $tops = select("*, count(v.id_musician) as 'total'", "musician m inner join votemusician v on m.id_musician=v.id_musician",
                                "group by v.id_musician order by total desc");
                            while($top = mysqli_fetch_assoc($tops)){
                                echo("<ol>");
                                echo("<li><input type='submit' name='musician' value='".strtoupper($top["artist_name"])."'></li>");
                                echo("</ol>");
                            }
                        ?>
                    </form>
                </div>
            </div>
            <div id="musiciansByGenre">
                <p>MUSICOS BY GENRE:</p>
                <div id="musiciansByGenre_btns">
                    <form action="fr_musiciansByGenre.php" method="GET">
                        <?php
                        // Select every genre played by min 1 musician
                        $genres = select_fields("name", "genre", "WHERE id_genre IN (SELECT id_genre FROM musician)");
                        while ($genre = mysqli_fetch_assoc($genres)){
                            echo "<ol>";
                            echo "<li><input type='submit' name='genre' value='".strtoupper($genre["name"])."'></li>";
                            echo "</ol>";
                        }
                        ?>
                    </form>
                </div>
            </div>
            <div id="propertiesByCity">
                <p>LOCALES BY PROVINCE:</p>
                <div id="propertiesByCity_btns">
                    <form action="fr_localesByCity.php" method="GET">
                        <?php
                        // Select every city which contains min 1 local
                        $cities = select_fields("name", "city", "WHERE id_city IN (SELECT id_city FROM user WHERE user.type = 2 GROUP BY id_city)");
                        while ($city = mysqli_fetch_assoc($cities)){
                            echo "<ol>";
                            echo "<li><input type='submit' name='city' value='".strtoupper($city["name"])."'></li>";
                            echo "</ol>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </aside>
    </body>
</html>
