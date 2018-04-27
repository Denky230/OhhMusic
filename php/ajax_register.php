<?php

require_once 'dmlFunctions.php';

$t = $_GET['t'];
switch ($t){

    /* ------------------------------------- MUSICIAN ------------------------------------- */

    case '1':
        echo "<input type='text' name='artistName' id='' placeholder='Nombre de artista' maxlength='35' required>
            <select name='genre' id=''>";
            $genres = selectFields("*", "genre");
            while ($genre = mysqli_fetch_assoc($genres)){
                echo "<option value=".$genre["id_genre"].">".$genre["name"]."</option>";
            }
            echo "</select>
            <input type='text' name='phone' id='' placeholder='Teléfono' maxlength='9' required>
            <input type='text' name='surname' id='' placeholder='Apellidos' maxlength='30' required>
            <input type='text' name='web' id='' placeholder='Página web' maxlength='255'>
            <input type='number' name='groupSize' id='' placeholder='Tamaño del grupo' min='1' required>";
        break;

    /* -------------------------------------- LOCAL -------------------------------------- */

    case '2':
        echo "<input type='text' name='phone' id='' placeholder='Teléfono' maxlength='9' required>
            <input type='number' name='capacity' id='' placeholder='Capacidad' min='0' required>
            <input type='text' name='web' id='' placeholder='Página web' maxlength='255'>";
        break;

    /* --------------------------------------- FAN --------------------------------------- */

    case '3':
        echo "<input type='text' name='phone' id='' placeholder='Teléfono' maxlength='9'>
            <input type='text' name='address' id='' placeholder='Dirección' maxlength='50'><input type='text' name='surname' id='' placeholder='Apellidos' maxlength='30' required>";
        break;
}
echo "<input type='hidden' name='userType' id='userType' value='$t'>"

?>