<?php

require_once 'dmlFunctions.php';
$p = $_GET['p'];

echo "<select name='city' id='sel_city'>";
$cities = selectFields("id_city, name", "city", "WHERE province = '$p' ORDER BY name");
    while ($city = mysqli_fetch_assoc($cities)){
        echo "<option value='".$city["id_city"]."'>".$city["name"]."</option>";
    }
echo "</select>";
    
?>