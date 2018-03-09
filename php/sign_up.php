<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require "bbdd.php";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Sign Up</title>
    </head>
    <body>
    <form method="post">
        <h3>Sign Up</h3><br>
        Username: <input type="text" name="user"><br>
        Password: <input type="password" name="pass"><br>
        Name: <input type="text" name="name"><br>
        E-mail: <input type="email" name="email"><br>
        <form method="post">
        County council: <select name="city" onchange="provincia()">
            <?php
                $list = getCouncil();
                while($fila = mysqli_fetch_assoc($list)){
                    echo("<option id='comunidad'>");
                    echo($fila["nombre"]);
                    echo("</option>");
                }
            ?>
            </select><br>
        </form>
        Image: <input type="file" name="image" accept="image/*"><br>
        <input type="submit" name="submit" value="Send">
    </form>
    <script>
        function provincia(){
            var comunidad = document.getElementById("comunidad");
            <?php
                $list = getProvince();
                while($fila = mysqli_fetch_assoc($list)){
                    echo("<option>");
                    echo($fila[""]);
                }
            ?>
        }
    </script>
    </body>
</html>
