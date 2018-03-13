<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once 'dmlFunctions.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/fan1.css"/>
        <title>Fan</title>
    </head>
    <body style="background-color: white">
        <div id="main">
           <div id="concerts">
               <div id="list_concerts">
                    <h2>Listado de conciertos</h2> 
                    <?php
               
                    $concerts = selectAllConcerts();
               
                    echo "<table>";

                    echo "<tr>";
                    echo "<th>Id Concert</th><th>State</th><th>Concert Date</th><th>Concert Time</th>"
                    . "<th>Genre</th><th>Payment</th><th>Id Local</th><th>Id Musician</th>";
                    echo "</tr>";

                    while ($fila = mysqli_fetch_assoc($concerts)) {
                    echo "<tr>";
                    foreach ($fila as $valor) {
                    echo "<td>$valor</td>";
                    }
                    echo "</tr>";
                    }
                    echo "</table>";
                    ?>
               </div>
               <div id="list_musicians">
                    <h2>Listado de músicos</h2>
               </div>
           </div>
            
               
               <!--     <div id="concert_box">
                    <img id="concert_img" src="../media/0002045178_10.jpg" alt="">
                    <div id="concert_info">
                        <h2>NombreLocal</h2>
                        <h2>LugarLocal</h2>
                        <h2>TelfLocal</h2>
                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">
                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>
                <div id="concert_box">
                    <img id="concert_img" src="" alt="">
                    <div id="concert_info">

                    </div>
                </div>-->
            
        </div>
    </body>
</html>
