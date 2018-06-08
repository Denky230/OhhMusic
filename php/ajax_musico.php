<?php

require_once 'dmlFunctions.php';
session_start();

/* ------------- DRAW CONCERTS ------------- */
if (isset($_GET["concertState"])){
    $concertState = $_GET["concertState"];
    switch ($concertState) {
        case 'proposed':
            $concerts = select("concert.id_concert concertID, concert.concert_date fecha, user.name localName, city.name cityName, local.phone localPhone",
                        "concert
                        INNER JOIN user ON concert.id_local = user.id_user
                        INNER JOIN city ON user.id_city = city.id_city
                        INNER JOIN local ON user.id_user = local.id_local", 
                        "WHERE concert.id_genre = (SELECT id_genre FROM musician WHERE id_musician = ".$_SESSION["id_user"].")
                        AND concert.id_concert NOT IN (SELECT id_concert FROM applyConcert WHERE id_musician = ".$_SESSION["id_user"].")
                        AND state = 0");
            break;
        case 'accepted':
            $concerts = select("concert.id_concert concertID, concert.concert_date fecha, user.name localName, city.name cityName, local.phone localPhone",
                        "concert
                        INNER JOIN user ON concert.id_local = user.id_user
                        INNER JOIN city ON user.id_city = city.id_city
                        INNER JOIN local ON user.id_user = local.id_local",
                        "WHERE concert.id_musician = ".$_SESSION["id_user"]."
                        AND concert.state = 1");
            break;
        case 'pending':
            $concerts = select("concert.id_concert concertID, concert.concert_date fecha, user.name localName, city.name cityName, local.phone localPhone",
                        "applyConcert
                        INNER JOIN concert ON applyConcert.id_concert = concert.id_concert
                        INNER JOIN user ON concert.id_local = user.id_user
                        INNER JOIN city ON user.id_city = city.id_city
                        INNER JOIN local ON user.id_user = local.id_local",
                        "WHERE applyConcert.id_musician = ".$_SESSION["id_user"]."
                        AND applyConcert.state = 0");
            break;
        default:
    }

    while ($concert = mysqli_fetch_assoc($concerts)){
        /* CONCERT BOX */
        echo "<div class='concert_box'>
                  <img id='concert_img' src='../media/random.jpg'>
                  <div id='concert_info'>
                    <div class='concert_info_title'>
                      <img src='../media/icons8-cabaña-filled-50.png'>
                      <span>".$concert["localName"]."</span>
                      <img src='../media/icons8-marker-filled-50.png'>
                      <span>".$concert["cityName"]."</span>
                    </div>
                    <div class='concert_info_title'>
                    <img src='../media/icons8-smartphone-con-pantalla-táctil-26.png'>
                      <span>".$concert["localPhone"]."</span>
                    <img src='../media/icons8-calendar-64.png'>
                      <span>".$concert["fecha"]."</span></div>";
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
    $insert = insert("applyConcert", $_SESSION["id_user"].", ".$_GET["subConcert"].", 0");
    if ($insert === "Ok"){
        echo "Te has registrado exitosamente a este concierto";
    } else {
        echo "Oops, algo ha salido mal: $insert";
    }
/* ----------- UNSUB FROM CONCERT ----------- */
} else if (isset($_GET["unsubConcert"])){
    delete("applyConcert", "WHERE id_musician = ".$_SESSION["id_user"]." AND id_concert = ".$_GET["unsubConcert"]);
    echo "Te has dado de baja de este concierto exitosamente";
}

?>