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
                    <div id="proposed" onclick="drawConcerts(this)">CONCIERTOS PROPUESTOS</div>
                </h2>
            </div>
            <div id="view_icons">
                <img src="../media/icons8-lista-50.png" class='view-list'/>
                <img src="../media/icons8-cuadricula-de-actividad-2-50.png" class='view-grid'/>
            </div>
            <div id="concerts">
                <ol class='grid' id='frame'>
                <?php
                $concerts = select("*", "concert", "WHERE state = 0 AND id_local = '".$_SESSION["id_user"]."'");

                while ($concert = mysqli_fetch_assoc($concerts)){
                    $musiciansApplied = select("applyconcert", "");
                    ?>
                    <!-- CONCERT BOX -->
                    <div id="concert_box">
                        <input type="hidden" name="idconcert" value="<?php echo $concert['id_concert']; ?>">
                        <input type="button" name="delete" id="delete" value="X" onclick="deleteConcert(<?php echo $concert["id_concert"] ?>)">
                        <li class='frame'>
                            <div class='inset'>
                                <div class='image'></div>
                                <div class='info'>
                                    <div class='title'>Lorem Ipsum</div>
                                    <div class='description'></div>
                                </div>
                            </div>
                        </li>
                    </div>
                    <?php
                }
                ?>
                </ol>
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
                        <input type="date" name="concert_date" required>
                        <h4>Hora:</h4>
                        <input type="time" name="concert_time" required>
                        <h4>Tarifa:</h4>
                        <input type="number" name="price" required>
                        <input type="submit" name="button" value="Crear">
                    </form>
                </div>
            </div>
        </aside>
    </body>
</html>
