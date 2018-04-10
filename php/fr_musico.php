<?php
require_once 'dmlFunctions.php';
session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/musico.css"/>
    </head>
    <body>
        <div id="main">
            <div id="frameTitle"><h2>CONCIERTOS PROPUESTOS</h2></div>
            <div id="concerts">
                <?php 
                $proposedConcerts = select("*", "concert", "WHERE id_genre = (SELECT id_genre FROM musician WHERE id_musician = ".$_SESSION["id_user"].") AND state = 0");
                
                while ($proposedConcert = mysqli_fetch_assoc($proposedConcerts)){
                    ?>
                    <!-- CONCERT BOX -->
                    <div id="concert_box">
                        <img id="concert_img" src="../media/random.jpg" alt="">
                        <div id="concert_info">
                            <h3>Nombre Local</h3>
                            <h3>Lugar Local</h3>
                            <h3>Telf Local</h3>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            
            <!--
            <div id="frameTitle"><h2>CONCIERTOS ACEPTADOS</h2></div>
            <div id="concerts">
                <?php
                /*
                $acceptedConcerts = select("*", "concert", "WHERE id_musician = ".$_SESSION["id_user"]." AND state = 1");
                
                while ($acceptedConcert = mysqli_fetch_assoc($acceptedConcerts)){
                    */
                    ?>
                    <!-- CONCERT BOX
                    <div id="concert_box">
                        <img id="concert_img" src="../media/random.jpg" alt="">
                        <div id="concert_info">
                            <h3>Nombre Local</h3>
                            <h3>Lugar Local</h3>
                            <h3>Telf Local</h3>
                        </div>
                    </div>
                    -->
                    <?php
                //}
                ?>
            <!--
            </div>
            -->
        </div>
    </body>
</html>