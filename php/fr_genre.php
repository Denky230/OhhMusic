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
            $genre = $_GET["genre"];
            $musicians = select("artist_name AS 'Artista'", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre", "WHERE g.name = '$genre'");
            ?>
            <div id="frameTitle"><h2>MÚSICOS DE <?php echo $genre ?></h2></div>
            <table>
                <?php
                foreach (mysqli_fetch_assoc($musicians) as $key => $value){
                    echo "<th>$key</th>";
                }
                $musicians = select("artist_name", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre", "WHERE g.name = '$genre'");
                while ($musician = mysqli_fetch_assoc($musicians)){
                    echo "<tr>
                         <td>".$musician["artist_name"]."</td>
                         </tr>";
                }
                ?>
            </table>
        </div>
    </body>
</html>
