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
        <h3>Sign Up</h3>
        Username<input type="text" name="user">
        Password<input type="password" name="pass">
        Name<input type="text" name="name">
        E-mail<input type="email" name="email">
        City<select name="city">

            </select>
        Image<input type="image" name="image">
    </form>
    </body>
</html>
