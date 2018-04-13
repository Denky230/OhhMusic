<?php

require_once 'dmlFunctions.php';
session_start();

if (isset($_GET["concertType"])){
    $concertType = $_GET["concertType"];
    if ($concertType == "proposed"){
        // Proposed concerts
        $concerts = select("*", "concert", "WHERE id_genre = (SELECT id_genre FROM musician WHERE id_musician = ".$_SESSION["id_user"].") AND state = 0");
    } else {
        // Accepted concerts
        $concerts = select("*", "concert", "WHERE id_musician = ".$_SESSION["id_user"]." AND state = 1");
    }

    while ($concert = mysqli_fetch_assoc($concerts)){
        // CONCERT BOX
        echo "<div id='concert_box'>
                  <img id='concert_img' src=''>
                  <div id='concert_info'>
                      <h2>Nombre Local</h2>
                      <h2>Lugar Local</h2>
                      <h2>Telf Local</h2>
                      <input type='button' id='concert_submit' value='Sign' onclick='signUpConcert()'>
                      <form><input type='hidden' name='id_concert' id='id_concert' value='".$concert["id_concert"]."'></form>
                  </div>
              </div>";
    }
} else if (isset($_GET["concertID"])){
    echo insert($_SESSION["id_user"].", ".$_GET["id_concert"].", 0", "applyconcert");
}

?>