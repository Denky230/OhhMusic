<?php

require_once 'dmlFunctions.php';
session_start();

/* ------------- DRAW CONCERTS ------------- */
if (isset($_GET["concertState"])){
    $concertState = $_GET["concertState"];
    switch ($concertState) {
        case 'proposed':
            $concerts = select("concert.id_concert concertID, user.name localName, city.name cityName, local.phone localPhone", 
                        "concert
                        INNER JOIN user ON concert.id_local = user.id_user
                        INNER JOIN city ON user.id_city = city.id_city
                        INNER JOIN local ON user.id_user = local.id_local", 
                        "WHERE concert.id_genre = (SELECT id_genre FROM musician WHERE id_musician = ".$_SESSION["id_user"].")
                        AND concert.id_concert NOT IN (SELECT id_concert FROM applyconcert WHERE id_musician = ".$_SESSION["id_user"].")
                        AND state = 0");
            break;
        case 'accepted':
            $concerts = select("concert.id_concert concertID, user.name localName, city.name cityName, local.phone localPhone", 
                        "concert
                        INNER JOIN user ON concert.id_local = user.id_user
                        INNER JOIN city ON user.id_city = city.id_city
                        INNER JOIN local ON user.id_user = local.id_local",
                        "WHERE concert.id_musician = ".$_SESSION["id_user"]."
                        AND concert.state = 1");
            break;
        case 'pending':
            $concerts = select("concert.id_concert concertID, user.name localName, city.name cityName, local.phone localPhone", 
                        "applyconcert
                        INNER JOIN concert ON applyconcert.id_concert = concert.id_concert
                        INNER JOIN user ON concert.id_local = user.id_user
                        INNER JOIN city ON user.id_city = city.id_city
                        INNER JOIN local ON user.id_user = local.id_local",
                        "WHERE applyconcert.id_musician = ".$_SESSION["id_user"]."
                        AND applyconcert.state = 0");
            break;
        default:
    }

    while ($concert = mysqli_fetch_assoc($concerts)){
        // CONCERT BOX
        echo "<div class='concert_box'>
                  <img id='concert_img' src=''>
                  <div id='concert_info'>
                      <h2>".$concert["localName"]."</h2>
                      <h2>".$concert["cityName"]."</h2>
                      <h2>".$concert["localPhone"]."</h2>";
                    // Only show buttons for proposed or pending concerts
                    if ($concertState === 'proposed')
                        echo "<input type='button' id='concert_sub' value='Inscribirse' onclick='subConcert(".$concert["concertID"].")'>";
                    else if ($concertState === 'pending')
                        echo "<input type='button' id='concert_unsub' value='Desinscribirse' onclick='unsubConcert(".$concert["concertID"].")'>";
            echo "</div>
              </div>";
    }
/* ----------- SIGN UP TO CONCERT ----------- */
} else if (isset($_GET["subConcert"])){
    $insert = insert("applyconcert", $_SESSION["id_user"].", ".$_GET["subConcert"].", 0");
    if ($insert === "Ok"){
        echo "Te has registrado exitosamente a este concierto (ID: ".$_GET["subConcert"].") :D";
    } else {
        echo "Oops, algo ha salido mal: $insert";
    }
/* ----------- UNSUB FROM CONCERT ----------- */
} else if (isset($_GET["unsubConcert"])){
    delete("applyconcert", "WHERE id_musician = ".$_SESSION["id_user"]." AND id_concert = ".$_GET["unsubConcert"]);
    echo "Te has dado de baja de este concierto exitosamente (ID: ".$_GET["unsubConcert"].")";
}

?>