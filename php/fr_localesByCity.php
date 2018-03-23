<?php
require_once 'dmlFunctions.php';
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
            <?php
            $city = $_GET["city"];
            $locales = select("user.name AS Local", "user", "WHERE user.type = 2 AND id_city = (SELECT id_city FROM city WHERE name = '$city')");
            ?>
            <div id="frameTitle"><h2>LOCALES DE <?php echo $city ?></h2></div>
            <table>
                <?php
                foreach (mysqli_fetch_assoc($locales) as $key => $value){
                    echo "<th>$key</th>";
                }
                $locales = select("user.name", "user", "WHERE user.type = 2 AND id_city = (SELECT id_city FROM city WHERE name = '$city')");
                while ($local = mysqli_fetch_assoc($locales)){
                    echo "<tr>
                         <td>".$local["name"]."</td>
                         </tr>";
                }
                ?>
            </table>
        </div>
    </body>
</html>