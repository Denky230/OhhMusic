<?php
require "dmlFunctions.php";

$rowsPerPage = 3;
$currPage = (isset($_GET["currPage"]) ? $_GET["currPage"] : 1);

$name = $_GET["search"];
$totalSearchRows = mysqli_num_rows(select("*", "user u inner join musician m on u.id_user = m.id_musician", "where username like '%$name%'"));
$search = select("*", "user u inner join musician m on u.id_user = m.id_musician", "where username like '%$name%'");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/frame.css">
</head>
<body>
<div id="main">
    <div id="frameTitle"><h2>Resultados de <?php echo $name ?></h2></div>
    <table>
        <?php
        // Header
        $search = select("*", "user u inner join musician m on u.id_user = m.id_musician", "where username like '%$name%' LIMIT ".($currPage - 1) * $rowsPerPage.", $rowsPerPage");
        while ($s = mysqli_fetch_assoc($search)) {
            ?>
            <tr>
                <td><?php echo $s["username"]; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <?php
    // PAGINEIXON
    $numPages = ceil($totalSearchRows / $rowsPerPage);

    if ($currPage > 1) {
        echo "<a href='ajax_search.php?name=$name&currPage=1'><<</a> ";
        echo "<a href='ajax_search.php?name=$name&currPage=".($currPage - 1)."'><</a> ";
    }
    for ($i = 1; $i <= $numPages; $i++) {
        echo "<a href='ajax_search.php?name=$name&currPage=$i'>$i</a> ";
    }
    if ($currPage < $numPages) {
        echo "<a href='ajax_search.php?name=$name&currPage=".($currPage + 1)."'>></a> ";
        echo "<a href='ajax_search.php?name=$name&currPage=$numPages'>>></a> ";
    }
    ?>
</div>
</body>
</html>
