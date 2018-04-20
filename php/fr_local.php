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
                <img id='list_ico' src="../media/icons8-lista-50.png"/>
                <img id='grid_ico' src="../media/icons8-cuadricula-de-actividad-2-50.png"/>
            </div>
            <div id="concerts">
                <?php
                $concerts = select("*", "concert", "WHERE state = 0 AND id_local = '".$_SESSION["id_user"]."'");
                while ($concert = mysqli_fetch_assoc($concerts)){
                    $musiciansApplied = select("id_musician, u.name as name", "applyconcert a INNER JOIN user u ON a.id_musician = u.id_user", "WHERE id_concert = ".$concert["id_concert"]);
                    ?>
                    <!-- CONCERT BOX -->
                    <div class="concert_box">
                        <?php echo $concert["id_concert"] ?>
                        <input type="hidden" name="idconcert" value="<?php echo $concert['id_concert']; ?>">
                        <input type="button" name="delete" class="delete_btn" value="X" onclick="deleteConcert(<?php echo $concert["id_concert"] ?>)">
                        <img id='concert_img' src='../media/random.jpg'>
                        <h2>Username</h2>
                        <h2>Phone</h2>
                        <h2>Date</h2>
                        <div id="assignMusician">
                            <?php
                            if (mysqli_num_rows($musiciansApplied) > 0){
                                echo "<input type='button' name='assign' class='assign_btn' value='Asignar' onclick='assignMusician(".$concert["id_concert"].")'>";
                                echo "<select name='musiciansApplied' id='musiciansApplied'>";
                                while ($musician = mysqli_fetch_assoc($musiciansApplied)){
                                    echo "<option value='".$musician["id_musician"]."'>"
                                        .$musician["name"].
                                        "</option>";
                                }
                                echo "</select>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
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
        <script src="../js/functions.js"></script>
        <script src="../js/local.js"></script>
        <script src="../js/gridList_toggle.js"></script>
    </body>
</html>
