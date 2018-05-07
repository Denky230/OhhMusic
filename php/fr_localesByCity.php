<?php
require_once 'dmlFunctions.php';

$rowsPerPage = 3;
$currPage = (isset($_GET["currPage"]) ? $_GET["currPage"] : 1);

$city = $_GET["city"];
$localesTotalRows = mysqli_num_rows(select("*", "user u INNER JOIN city c ON u.id_city = c.id_city", "WHERE u.type = 2 AND c.name = '$city'"));
$locales = select("u.name AS Local", "user u INNER JOIN city c ON u.id_city = c.id_city", "WHERE u.type = 2 AND c.name = '$city'");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css">
        <title>Document</title>
    </head>
    <body>
        <div id="main">
            <div id="frameTitle"><h2>LOCALES DE <?php echo $city ?></h2></div>
            <table>
                <?php
                // Header
                foreach (mysqli_fetch_assoc($locales) as $key => $value){
                    echo "<th>$key</th>";
                }
                $locales = select("u.name AS Local", "user u INNER JOIN city c ON u.id_city = c.id_city", "WHERE u.type = 2 AND c.name = '$city' LIMIT ".($currPage - 1) * $rowsPerPage.", $rowsPerPage");
                while ($local = mysqli_fetch_assoc($locales)){
                    echo "<tr>
                         <td>".$local["Local"]."</td>
                         </tr>";
                }
                ?>
            </table>
            <?php
            // PAGINEIXON
            $numPages = ceil($localesTotalRows / $rowsPerPage);
            
            if ($currPage > 1){
                echo "<a href='fr_localesByCity.php?city=$city&currPage=1'><<</a> ";
                echo "<a href='fr_localesByCity.php?city=$city&currPage=".($currPage - 1)."'><</a> ";
            }
            for ($i = 1; $i <= $numPages; $i++){
                echo "<a href='fr_localesByCity.php?city=$city&currPage=$i'>$i</a> ";
            }
            if ($currPage < $numPages){
                echo "<a href='fr_localesByCity.php?city=$city&currPage=".($currPage + 1)."'>></a> ";
                echo "<a href='fr_localesByCity.php?city=$city&currPage=$numPages'>>></a> ";
            }
            ?>
        </div>
    </body>
</html>