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
        <title>Local</title>
    </head>
    <body>
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
