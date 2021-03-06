<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/fan.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/functions.js"></script>
        <script src="../js/fan.js"></script>
    </head>
    <body>
        <div id="main">
            <div id="frameTitle">
                <h2>
                    <div id="concert" onclick="drawContent(this)">CONCIERTOS</div> /
                    <div id="musician" onclick="drawContent(this)">MUSICOS</div>
                </h2>
            </div>
            <div id="concerts"></div>
        </div>
    </body>
</html>