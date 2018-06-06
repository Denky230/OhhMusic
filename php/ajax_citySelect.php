<?php

require_once 'dmlFunctions.php';
session_start();
echo "<select name='city' id='sel_city'>";
$cities = select_fields("id_city, name", "city", "WHERE community = '" . $_GET['p'] . "' ORDER BY name");
while ($city = mysqli_fetch_assoc($cities)) {
    if($_SESSION["id_user"]) {
        $homes = select("id_city", "user", "where id_user = '" . $_SESSION["id_user"] . "'");
        $home = mysqli_fetch_assoc($homes);

        if ($city["id_city"] == $home["id_city"]) {
            echo "<option selected value='" . $city["id_city"] . "'>" . $city["name"] . "</option>";
        } else {
            echo "<option value='" . $city["id_city"] . "'>" . $city["name"] . "</option>";
        }
    }else{
        echo "<option value='" . $city["id_city"] . "'>" . $city["name"] . "</option>";
    }
}
echo "</select>";

?>