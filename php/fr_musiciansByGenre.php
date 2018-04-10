<?php
require_once 'dmlFunctions.php';

$rowsPerPage = 5;
$currPage = (isset($_GET["currPage"]) ? $_GET["currPage"] : 1);

$genre = $_GET["genre"];
$musiciansTotalRows = mysqli_num_rows(select("*", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre", "WHERE g.name = '$genre'"));
$musicians = select("artist_name AS 'Artista'", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre", "WHERE g.name = '$genre'");
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
            <div id="frameTitle"><h2>MÚSICOS DE <?php echo $genre ?></h2></div>
            <table>
                <?php
                // Header
                foreach (mysqli_fetch_assoc($musicians) as $key => $value){
                    echo "<th>$key</th>";
                }
                $musicians = select("artist_name", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre", "WHERE g.name = '$genre' LIMIT ".($currPage - 1) * $rowsPerPage.", $rowsPerPage");
                while ($musician = mysqli_fetch_assoc($musicians)){
                    echo "<tr>
                         <td>".$musician["artist_name"]."</td>
                         </tr>";
                }
                ?>
            </table>
            <?php            
            // PAGINEIXON
            $numPages = ceil($musiciansTotalRows / $rowsPerPage);
            
            if ($currPage > 1){
                echo "<a href='fr_musiciansByGenre.php?genre=$genre&currPage=1'><<</a> ";
                echo "<a href='fr_musiciansByGenre.php?genre=$genre&currPage=".($currPage - 1)."'><</a> ";
            }
            for ($i = 1; $i <= $numPages; $i++){
                echo "<a href='fr_musiciansByGenre.php?genre=$genre&currPage=$i'>$i</a> ";
            }
            if ($currPage < $numPages){
                echo "<a href='fr_musiciansByGenre.php?genre=$genre&currPage=".($currPage + 1)."'>></a> ";
                echo "<a href='fr_musiciansByGenre.php?genre=$genre&currPage=$numPages'>>></a> ";
            }
            ?>
        </div>
    </body>
</html>
