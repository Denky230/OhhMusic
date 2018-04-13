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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="main">
            <div id="frameTitle">
                <h2><div id="proposed">CONCIERTOS PROPUESTOS</div> / <div id="accepted">CONCIERTOS ACEPTADOS</div></h2>
            </div>
            <div id="concerts">
                <!-- TEST -->
                <div id='concert_box'>
                    <img id='concert_img' src=''>
                    <div id='concert_info'>
                        <h2>Nombre Local</h2>
                        <h2>Lugar Local</h2>
                        <h2>Telf Local</h2>
                        <input type="button" id="concert_submit" value="Sign" onclick="signUpConcert()">
                    </div>
                </div>
                <!-- TEST -->
            </div>
        </div>
        <script src="../js/musico.js"></script>
    </body>
</html>
