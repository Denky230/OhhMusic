<?php

require_once 'dmlFunctions.php';
session_start();

/* ------------- DRAW CONCERTS ------------- */
if (isset($_GET["concertState"])){
    $concertState = $_GET["concertState"];
    switch ($concertState) {
        case 'proposed':
            $concerts = select("*", "concert c INNER JOIN genre g ON c.id_genre = g.id_genre", "WHERE state = 0 AND id_local = ".$_SESSION["id_user"]);
            break;
        case 'accepted':
            $concerts = select("*", "concert c INNER JOIN genre g ON c.id_genre = g.id_genre", "WHERE state = 1 AND id_local = ".$_SESSION["id_user"]);
            break;
        default:
    }
    while ($concert = mysqli_fetch_assoc($concerts)){
        if ($concertState === "proposed")
            $musiciansApplied = select("id_musician, u.name as name", "applyConcert a INNER JOIN user u ON a.id_musician = u.id_user", "WHERE id_concert = ".$concert["id_concert"]);
        else $musicianAssigned = select_value("artist_name", "concert c INNER JOIN musician m ON c.id_musician = m.id_musician", "WHERE id_concert = ".$concert["id_concert"]);
        /* CONCERT BOX */
        echo "
            <div class='concert_box'>";
                if ($concertState === "proposed")
                    echo "<input type='button' name='delete' class='delete_btn' value='X' onclick='deleteConcert(".$concert['id_concert'].")'>";
                echo "<img id='concert_img' src='../media/random.jpg'>
                    <div id='concert_info'>
                        <div class='concert_info_title'>
                            <img src='../media/icons8-calendar-64.png'>
                            <span>".$concert["concert_date"]."</span>
                            <img src='../media/icons8-reloj-64.png'>
                            <span>".$concert["concert_time"]."</span>
                        </div>
                        <div class='concert_info_title'>
                            <img src='../media/icons8-parte-trasera-de-tarjeta-bancaria-50.png'>
                            <span>".$concert["payment"]."€</span>
                            <img src='../media/icons8-notas-musicales-64.png'>
                            <span>".$concert["name"]."</span>
                        </div>
                        <div id='assignMusician'>";
                        if ($concertState === "proposed"){
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
                        } else {
                            echo "<h2>Musico/a: $musicianAssigned</h2>";
                        }
                echo "</div>
                </div>                
            </div>";
    }
/* --------------- DELETE CONCERT --------------- */
} else if (isset($_GET["deleteConcert"])){
    delete("concert", "WHERE id_concert = ".$_GET["deleteConcert"]);
    echo "Has borrado exitosamente este concierto";    
/* --------- ASSIGN MUSICIAN TO CONCERT --------- */
} else if (isset($_GET["assignMusician"])){
    // Update from concert id_musician to asigned musician's ID and state to 1
    updateMultiple("concert", array("id_musician", "state"), array($_GET["assignMusician"], 1), "WHERE id_concert = ".$_GET["concertID"]);
    // Update applys state, asigned to 1 and rest to 2
    update("applyConcert", "state", 1, "WHERE id_concert = ".$_GET["concertID"]." AND id_musician = ".$_GET["assignMusician"]);
    update("applyConcert", "state", 2, "WHERE id_concert = ".$_GET["concertID"]." AND id_musician <> ".$_GET["assignMusician"]);
    echo "El músico ".select_value("artist_name", "musician", "WHERE id_musician = ".$_GET["assignMusician"])." ha sido asignado a este concierto exitosamente, todos los demás han sido rechazados. :(";
}

?>