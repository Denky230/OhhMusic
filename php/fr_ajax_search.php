<?php
require "dmlFunctions.php";

$rowsPerPage = 5;
$currPage = (isset($_GET["currPage"]) ? $_GET["currPage"] : 1);

$search = $_GET["search"];
$totalMusicianRows = mysqli_num_rows(select("*", "user u inner join musician m on u.id_user = m.id_musician", "where username like '%$search%'"));
$totalLocalRows = mysqli_num_rows(select("*", "user u inner join local l on u.id_user = l.id_local", "where username like '%$search%'"));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/frame.css">
</head>
    <body>
        <div id="main">
            <div id="frameTitle"><h1>Resultados de <?php echo $search ?></h1></div>
            <div id="search">
                <div id="musicos">
                    <h2>Musicians</h2>
                    <table id="tabla">
                        <tr>
                            <td><b>Nombre</b></td>
                            <td><b>Género</b></td>
                            <td><b>Web</b></td>
                        </tr>
                    <?php
                    // Header
                    if($musicians = select("*, g.name as 'genero'", "user u inner join musician m on u.id_user = m.id_musician inner join concert c on m.id_musician = c.id_musician
                        inner join genre g on m.id_genre = g.id_genre", "group by u.id_user having u.username like '%$search%' or m.artist_name like '%$search%' LIMIT ".($currPage - 1) * $rowsPerPage.", $rowsPerPage")){
                    while($musician = mysqli_fetch_assoc($musicians)){
                        ?>
                            <tr>
                                <td><?php echo($musician["username"]) ?></td>
                                <td><?php echo($musician["genero"]) ?></td>
                                <td><?php echo($musician["web"]) ?></td>
                            </tr>
                    <?php
                    }}echo("</table>");
                    $numPages = ceil($totalMusicianRows / $rowsPerPage);

                    if ($currPage > 1){
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=1'><<</a> ";
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=".($currPage - 1)."'><</a> ";
                    }
                    for ($i = 1; $i <= $numPages; $i++){
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=$i'>$i</a> ";
                    }
                    if ($currPage < $numPages){
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=".($currPage + 1)."'>></a> ";
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=$numPages'>>></a> ";
                    }
                    ?>
                </div>
                <div id="locales">
                    <h2>Locals</h2>
                    <table id="tabla">
                        <tr>
                            <td><b>Nombre</b></td>
                            <td><b>Email</b></td>
                            <td><b>Web</b></td>
                        </tr>
                    <?php
                    // Header
                    if($locals = select("*", "user u inner join local l on u.id_user = l.id_local", "where username like '%$search%' LIMIT " .($currPage - 1) * $rowsPerPage.", $rowsPerPage")){
                    while($local = mysqli_fetch_assoc($locals)){
                        ?>
                        <tr>
                            <td><?php echo($local["username"]) ?></td>
                            <td><?php echo($local["email"]) ?></td>
                            <td><?php echo($local["web"]) ?></td>
                        </tr>
                    <?php
                    }}
                    echo("</table>");
                    $numPages = ceil($totalLocalRows / $rowsPerPage);

                    if ($currPage > 1){
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=1'><<</a> ";
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=".($currPage - 1)."'><</a> ";
                    }
                    for ($i = 1; $i <= $numPages; $i++){
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=$i'>$i</a> ";
                    }
                    if ($currPage < $numPages){
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=".($currPage + 1)."'>></a> ";
                        echo "<a href='fr_ajax_search.php?search=$search&currPage=$numPages'>>></a> ";
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
