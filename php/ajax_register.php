<?php

require_once 'dmlFunctions.php';
session_start();

$t = $_GET['t'];
$_SESSION["type"] = $t;

switch ($t){
        
    /* ------------------------------------- MUSICIAN ------------------------------------- */
        
    case 'M':
        echo "<input type='text' name='artistName' id='' placeholder='Nombre de artista'           maxlength='35' required>
            <select name='genre' id=''>";
            $genres = select("*", "genre");
            while ($genre = mysqli_fetch_assoc($genres)){
                echo "<option value=".$genre["id_genre"].">".$genre["name"]."</option>";
            }
            echo "</select>
            <input type='text' name='surname' id='' placeholder='Apellidos' maxlength='30'     required>
            <input type='text' name='phone' id='' placeholder='Teléfono' maxlength='9'          required>
            <input type='text' name='web' id='' placeholder='Página web' maxlength='255'>
            <input type='number' name='groupSize' id='' placeholder='Tamaño del grupo' required>";
        break;
        
    /* --------------------------------------- LOCAL --------------------------------------- */
        
    case 'L':
        echo "<input type='text' name='phone' id='' placeholder='Teléfono' maxlength='9'           required>
            <input type='number' name='capacity' id='' placeholder='Capacidad' required>
            <input type='text' name='web' id='' placeholder='Página web' maxlength='255'>";
        break;
        
    /* ---------------------------------------- FAN ---------------------------------------- */
        
    case 'F':
        echo "<input type='text' name='phone' id='' placeholder='Teléfono' maxlength='9'>
            <input type='text' name='address' id='' placeholder='Dirección' maxlength='50'><input type='text' name='surname' id='' placeholder='Apellidos' maxlength='30'     required>";
        break;
}
    
?>