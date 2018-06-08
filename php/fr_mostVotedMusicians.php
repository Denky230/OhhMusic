<?php
require_once 'dmlFunctions.php';

$rowsPerPage = 5;
$currPage = (isset($_GET["currPage"]) ? $_GET["currPage"] : 1);

$musician = $_GET["musician"];

$musicianTotalRows = mysqli_num_rows(select("*", "musician m inner join voteMusician v on m.id_musician = v.id_musician", "where v.id_musician = (select id_musician from musician where artist_name = '$musician')"));
$music = select("m.artist_name as 'Artista'", "musician m inner join voteMusician v on m.id_musician = v.id_musician", "where v.id_musician = (select id_musician from musician where artist_name = '$musician')");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/frame.css">
</head>
<body>
<div id="main">
    <div id="frameTitle"><h2><?php echo $musician ?></h2></div>
    <table>
        <?php
        // Header
        $music = select("*, count(v.id_musician) as 'total'",
            "musician m inner join voteMusician v on m.id_musician = v.id_musician inner join genre g on m.id_genre = g.id_genre",
            "WHERE v.id_musician = (select id_musician from musician where artist_name = '$musician')");
        while ($m = mysqli_fetch_assoc($music)){
            echo "<tr>
                        <td><b>Gender: </b></td>
                        <td>".$m["name"]."</td>
                  </tr>
                  <tr>
                        <td><b>Likes: </b></td>
                        <td>".$m["total"]."</td>
                  </tr>";
        }
        ?>
    </table><br>
    <table width="20%">
        <tr>
            <td><b>Next Concerts: </b></td>
            <td><b>At: </b></td>
            <td><b>Local: </b></td>
        </tr>
        <?php
        $next = select("*", "concert c inner join user u on c.id_local = u.id_user",
            "WHERE current_date < c.concert_date and c.state = 1 and c.id_musician = (select id_musician from musician where artist_name = '$musician') LIMIT ".($currPage - 1) * $rowsPerPage.", $rowsPerPage");
        while ($nextConcert = mysqli_fetch_assoc($next)){
            echo "<tr>
                        <td>". $nextConcert["concert_date"] ."</td>
                        <td>".$nextConcert["concert_time"]."</td>
                        <td>".$nextConcert["name"]."</td>
                  </tr>";
        }
        ?>
    </table>
    <?php
    // PAGINEIXON
    $numPages = ceil($musicianTotalRows / $rowsPerPage);

    if ($currPage > 1) {
        echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=1'><<</a> ";
        echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=".($currPage - 1)."'><</a> ";
        
        for ($i = 1; $i <= $numPages; $i++) {
            echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=$i'>$i</a> ";
        }
        if ($currPage < $numPages) {
            echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=".($currPage + 1)."'>></a> ";
            echo "<a href='fr_mostVotedMusicians.php?musician=$musician&currPage=$numPages'>>></a> ";
        }
    }
    ?>
</div>
</body>
</html>

