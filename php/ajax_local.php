<?php

require_once 'dmlFunctions.php';
session_start();

/* ------------- DRAW CONCERTS ------------- */
if (isset($_GET["concertState"])){
    $concertState = $_GET["concertState"];
    switch ($concertState) {
        case 'proposed':
            $concerts = select("*", "concert", "WHERE state = 0 AND id_local = ".$_SESSION["id_user"]);
            break;
        case 'accepted':
            $concerts = select("*", "concert", "WHERE state = 1 AND id_local = ".$_SESSION["id_user"]);
            break;
        default:        
    }

    while ($concert = mysqli_fetch_assoc($concerts)){
        if ($concertState === "proposed")
            $musiciansApplied = select("id_musician, u.name as name", "applyconcert a INNER JOIN user u ON a.id_musician = u.id_user", "WHERE id_concert = ".$concert["id_concert"]);
        else $musicianAssigned = select_value("artist_name", "concert c INNER JOIN musician m ON c.id_musician = m.id_musician", "WHERE id_concert = ".$concert["id_concert"]);
        /* CONCERT BOX */
        echo "
            <div class='concert_box'>";
                /* TEST */
                echo "ID: ".$concert['id_concert']."
                <input type='hidden' name='idconcert' value='".$concert['id_concert']."'>";
                if ($concertState === "proposed")
                    echo "<input type='button' name='delete' class='delete_btn' value='X' onclick='deleteConcert(".$concert['id_concert'].")'>";
                echo "<img id='concert_img' src='../media/random.jpg'>
                <h2>Username</h2>
                <h2>Phone</h2>
                <h2>Date</h2>
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
                    echo "<h2>Musicaso: $musicianAssigned</h2>";
                }
                echo "
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
    update("applyconcert", "state", 1, "WHERE id_concert = ".$_GET["concertID"]." AND id_musician = ".$_GET["assignMusician"]);
    update("applyconcert", "state", 2, "WHERE id_concert = ".$_GET["concertID"]." AND id_musician <> ".$_GET["assignMusician"]);
    echo "El músico ".select_value("artist_name", "musician", "WHERE id_musician = ".$_GET["assignMusician"])." ha sido asignado a este concierto exitosamente, todos los demás han sido rechazados. :(";
}

?>