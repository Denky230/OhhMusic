<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/local.css"/>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="../js/local.js" type="text/javascript"></script>
        <title>Local</title>
    </head>
    <body>
        <div id="main">
            <div id="concerts">
                <div id="concert_box">
                    <img id="concert_img" src="../media/0002045178_10.jpg" alt="">
                    <div id="concert_info">
                        <h2>NombreLocal</h2>
                        <h2>LugarLocal</h2>
                        <h2>TelfLocal</h2>
                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
            </div>
        </div>
        <aside id="frame_right">
            <div id="concert_creation">
                <h2>Creacion concierto:</h2><br><br>
                <div id="create_concert">
                    <form method="post">
                        <h4>Fecha del concierto:</h4>
                        <input type="date" name="concert_date"><br>
                        <h4>Hora:</h4>
                        <input type="time" name="concert_time"><br>
                        <h4>Genero:</h4>
                        <input type="text" name="genre"><br>
                        <h4>Tarifa:</h4>
                        <input type="number" name="price"><br><br>
                        <input type="submit" name="button" value="Enviar">
                    </form>
                </div>                
            </div>
        </aside>        
    </body>
</html>
