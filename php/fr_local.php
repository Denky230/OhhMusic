<?php
require 'dmlFunctions.php';
session_start();

if (isset($_POST["button"])){
    insert('concert (state, concert_date, concert_time, id_genre, payment, id_local)', "0, '".$_POST['concert_date']."', '".$_POST['concert_time']."', ".$_POST['genre'].", ".$_POST['price'].", ".$_SESSION['id_user']);    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/local.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="main">
            <div id="frameTitle">
                <h2>
                    <div id="proposed" onclick="drawConcerts(this)">TUS CONCIERTOS PROPUESTOS</div> /
                    <div id="accepted" onclick="drawConcerts(this)">TUS CONCIERTOS ACEPTADOS</div>
                </h2>
            </div>
            <div id="view_icons">
                <img id='list_ico' src="../media/icons8-lista-50.png"/>
                <img id='grid_ico' src="../media/icons8-cuadricula-de-actividad-2-50.png"/>
            </div>
            <div id="concerts">
                
            </div>
        </div>
        <aside id="frame_right">
            <div id="concert_creation">
                <h2>Creacion concierto:</h2>
                <div id="create_concert">
                    <form method="post">
                        <h4>Genero:</h4>
                        <select name="genre" required>
                        <?php
                            $fila = select("id_genre, name", "genre");
                            while($filas = mysqli_fetch_assoc($fila)){
                                echo("<option value='". $filas['id_genre'] ."'> " . $filas['name'] . "</option>");
                            }
                        ?>
                        </select>
                        <h4>Fecha del concierto:</h4>
                        <input type="date" id="concert_date" name="concert_date" required>
                        <h4>Hora:</h4>
                        <input type="time" name="concert_time" required>
                        <h4>Tarifa:</h4>
                        <input type="number" name="price" min="0" required>
                        <input type="submit" name="button" value="Crear">
                    </form>
                </div>
            </div>
        </aside>
        <script src="../js/functions.js"></script>
        <script src="../js/local.js"></script>
        <script src="../js/gridList_toggle.js"></script>
    </body>
</html>
