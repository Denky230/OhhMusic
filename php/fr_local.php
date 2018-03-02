<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/local.css"/>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="../js/local.js" type="text/javascript"></script>
        <title>Local</title>
    </head>
    <body>
        <div id="main">
            <div id="concerts">
                <div id="container">
                    <header id="header">
                        <span>View:</span>
                        <button class="view-list">List</button>
                        <button class="view-grid">Grid</button>
                    </header>
                    <ol class="grid" id="frame">
                        <li class="frame">
                            <div class="inset">
                                <div class="image"></div>
                                <div class="info">
                                    <div class="title">Concierto</div>
                                    <div class="description">Descripcion</div>
                                    <div class="shares">
                                        <div class="icon-lik like"></div>
                                    </div>
                                </div>
                            </div>
                        </li><li class="frame">
                            <div class="inset">
                                <div class="image"></div>
                                <div class="info">
                                    <div class="title">Concierto</div>
                                    <div class="description">Descripcion</div>
                                    <div class="shares">
                                        <div class="icon-lik like"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <aside id="frame_right">
            <div id="concert_creation">
                <h2>Creacion concierto:</h2><br><br>
                <div id="create_concert">
                    <form method="post">
                        <h4>Fecha del concierto:</h4>
                        <input type="date" name="concert_date"><br>
                        <h4>Hora:</h4>
                        <input type="time" name="concert_time"><br>
                        <h4>Genero:</h4>
                        <input type="text" name="genre"><br>
                        <h4>Tarifa:</h4>
                        <input type="number" name="price"><br><br>
                        <input type="submit" name="button" value="Enviar">
                    </form>
                </div>                
            </div>
        </aside>        
    </body>
</html>
