<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/musico.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/functions.js"></script>
        <script src="../js/musico.js"></script>
    </head>
    <body>
        <div id="main">
            <div id="frameTitle">
                <h2>
                    <div id="proposed" onclick="drawConcerts(this)">CONCIERTOS PROPUESTOS</div> / 
                    <div id="accepted" onclick="drawConcerts(this)">CONCIERTOS ACEPTADOS</div> / 
                    <div id="pending" onclick="drawConcerts(this)">CONCIERTOS PENDIENTES</div>
                </h2>
            </div>
            <div id="concerts"></div>
        </div>
    </body>
</html>
