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
            <div id="concerts"></div>
        </div>
        <script src="../js/musico.js"></script>
    </body>
</html>