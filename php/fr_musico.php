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
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/musico.css"/>
    </head>
    <body>
        <div id="main">
            <div id="frameTitle"><h2>CONCIERTOS ACEPTADOS</h2></div>
            <div id="concerts">
                <?php
                $acceptedConcerts = select("*", "concert", "WHERE id_musician = ".$_SESSION["id_user"]." AND state = 1");
                
                while ($acceptedConcert = mysqli_fetch_assoc($acceptedConcerts)){
                    ?>
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
        </div>
    </body>
</html>