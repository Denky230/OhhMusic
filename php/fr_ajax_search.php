<?php
require "dmlFunctions.php";

$rowsPerPage = 3;
$currPage = (isset($_GET["currPage"]) ? $_GET["currPage"] : 1);

$name = $_GET["search"];
$totalMusicianRows = mysqli_num_rows(select("*", "user u inner join musician m on u.id_user = m.id_musician", "where username like '%$name%'"));
$totalLocalRows = mysqli_num_rows(select("*", "user u inner join local l on u.id_user = l.id_local", "where username like '%$name%'"));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/frame.css">
</head>
    <body>
        <div id="main">
            <div id="frameTitle"><h1>Resultados de <?php echo $name ?></h1></div>
            <div id="search">
                <div id="musicos">
                    <h3>Musicians</h3>
                    <?php
                    // Header
                    if($musicians = select("*", "user u inner join musician m on u.id_user = m.id_musician inner join concert c on m.id_musician = c.id_musician",
                        "group by u.id_user having u.username like '%$name%' or m.artist_name like '%$name%' LIMIT ".($currPage - 1) * $rowsPerPage.", $rowsPerPage")){
                    while($musician = mysqli_fetch_assoc($musicians)){
                        ?>
                            <div class="todos"><?php echo($musician["username"]) ?></div>
                        <?php
                    }}
                    $numPages = ceil($totalMusicianRows / $rowsPerPage);

                    if ($currPage > 1){
                        echo "<a href='ajax_search.php?name=$name&currPage=1'><<</a> ";
                        echo "<a href='ajax_search.php?name=$name&currPage=".($currPage - 1)."'><</a> ";
                    }
                    for ($i = 1; $i <= $numPages; $i++){
                        echo "<a href='ajax_search.php?name=$name&currPage=$i'>$i</a> ";
                    }
                    if ($currPage < $numPages){
                        echo "<a href='ajax_search.php?name=$name&currPage=".($currPage + 1)."'>></a> ";
                        echo "<a href='ajax_search.php?name=$name&currPage=$numPages'>>></a> ";
                    }
                    ?>
                </div>
                <div id="locales">
                    <h3>Locals</h3>
                    <?php
                    // Header
                    if($locals = select("*", "user u inner join local l on u.id_user = l.id_local", "where username like '%$name%' LIMIT " .($currPage - 1) * $rowsPerPage.", $rowsPerPage")){
                    while($local = mysqli_fetch_assoc($locals)){
                        ?>
                        <div class="todos"><?php echo($local["username"]) ?></div>
                        <?php
                    }}
                    $numPages = ceil($totalLocalRows / $rowsPerPage);

                    if ($currPage > 1){
                        echo "<a href='ajax_search.php?name=$name&currPage=1'><<</a> ";
                        echo "<a href='ajax_search.php?name=$name&currPage=".($currPage - 1)."'><</a> ";
                    }
                    for ($i = 1; $i <= $numPages; $i++){
                        echo "<a href='ajax_search.php?name=$name&currPage=$i'>$i</a> ";
                    }
                    if ($currPage < $numPages){
                        echo "<a href='ajax_search.php?name=$name&currPage=".($currPage + 1)."'>></a> ";
                        echo "<a href='ajax_search.php?name=$name&currPage=$numPages'>>></a> ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
