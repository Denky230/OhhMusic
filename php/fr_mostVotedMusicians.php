<?php
require_once 'dmlFunctions.php';

$rowsPerPage = 3;
$currPage = (isset($_GET["currPage"]) ? $_GET["currPage"] : 1);

$musician = $_GET["musician"];

$musicianTotalRows = mysqli_num_rows(select("*", "musician m inner join votemusician v on m.id_musician = v.id_musician", "where v.id_musician = (select id_musician from musician where artist_name = '$musician')"));
$music = select("m.artist_name as 'Artista'", "musician m inner join votemusician v on m.id_musician = v.id_musician", "where v.id_musician = (select id_musician from musician where artist_name = '$musician')");
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
    <div id="frameTitle"><h2>ARTISTA <?php echo $musician ?></h2></div>
    <table>
        <?php
        // Header
        foreach (mysqli_fetch_assoc($music) as $key => $value){
            echo "<th>$key</th>";
        }
        $music = select("*, count(v.id_musician) as 'total'",
            "musician m inner join votemusician v on m.id_musician = v.id_musician inner join genre g on m.id_genre = g.id_genre",
            "WHERE v.id_musician = (select id_musician from musician where artist_name = '$musician' LIMIT ".($currPage - 1) * $rowsPerPage.", $rowsPerPage");
        while ($m = mysqli_fetch_assoc($music)){
            echo "<tr>
                        <td>Artist Info</td>
                        <td>".$m["artist_name"]."</td>
                        <td>".$m["name"]."</td>
                        <td>".$m["total"]."</td>
                  </tr>";
        }
        ?>
    </table>
    <?php
    // PAGINEIXON
    $numPages = ceil($musicianTotalRows / $rowsPerPage);

    if ($currPage > 1){
        echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=1'><<</a> ";
        echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=".($currPage - 1)."'><</a> ";
    }
    for ($i = 1; $i <= $numPages; $i++){
        echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=$i'>$i</a> ";
    }
    if ($currPage < $numPages){
        echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=".($currPage + 1)."'>></a> ";
        echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=$numPages'>>></a> ";
    }
    ?>
</div>
</body>
</html>

