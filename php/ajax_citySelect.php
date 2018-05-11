<?php

require_once 'dmlFunctions.php';

echo "<select name='city' id='sel_city'>";
$cities = select_fields("id_city, name", "city", "WHERE community = '".$_GET['p']."' ORDER BY name");
    while ($city = mysqli_fetch_assoc($cities)){
        echo "<option value='".$city["id_city"]."'>".$city["name"]."</option>";
    }
echo "</select>";
    
?>