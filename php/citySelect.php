<?php

require_once 'dmlFunctions.php';
$p = $_GET['p'];

echo "<select name='city' id='sel_city'>";
$cities = select("name", "city", "WHERE province = '$p' ORDER BY name");
    while ($city = mysqli_fetch_assoc($cities)){
        echo "<option>".$city["name"]."</option>";
    }
echo "</select>";
    
?>