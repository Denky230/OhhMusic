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
        <link rel="stylesheet" href="../css/home.css"/>
        <title>Home</title>
    </head>
    <body>
        <!-- BODY -->
        <div id="main">
            <div id="concerts">
                <div id="concert_box">
                    <img id="concert_img" src="../media/random.jpg" alt="">
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
            </div>
        </div>
        <!-- RIGHT FRAME -->
        <aside id="frame_right">
            <div id="musiciansByGenre">
                <p>MUSICOS BY GENRE:</p>
                <div id="musiciansByGenre_btns">
                    <form>
                        <?php
                        $genres = select("genre.name", "genre");
                        while ($genre = mysqli_fetch_assoc($genres)){
                            echo "<input type='submit' value='".strtoupper($genre["name"])."'>";
                        }
                        ?>
                    </form>
                </div>
            </div>
            <div id="propertiesByCity">
                <p>LOCALES BY CITY:</p>                
                <div id="propertiesByCity_btns">
                    <form>
                        <?php
                        // Select every city which contains min 1 local
                        $cities = select("city", "user", "WHERE user.type = 'L' GROUP BY city");
                        while ($city = mysqli_fetch_assoc($cities)){
                            echo "<input type='submit' value='".strtoupper($city["city"])."'>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </aside>
    </body>
</html>
