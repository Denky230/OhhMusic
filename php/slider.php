<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="slides.js"></script>
        <link href="slider.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="slidercontainer">
            <div class="showSlide fade">
                <img src="images/POTD_chick_3597497k.jpg"/>
                <div class="content">Chicken</div>
                <p>Hola?</p>
            </div>
            <div class="showSlide fade">
                <img src="images/maxresdefault.jpg"/>
                <div class="content">Unknown</div>
            </div>
            <div class="showSlide fade">
                <img src="images/potd-squirrel_3519920k.jpg"/>
                <div class="content">Squirrel</div>
            </div>
            <a class="left" onclick="nextSlide(-1)"><</a>
            <a class="right" onclick="nextSlide(1)">></a>
        </div>
    </body>
</html>
