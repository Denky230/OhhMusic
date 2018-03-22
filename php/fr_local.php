<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/frame.css"/>
        <link rel="stylesheet" href="../css/local.css"/>
        <title>Local</title>
    </head>
    <body>
        <div id="main">
            <div id="container">
                <div id="concerts">
                    <header id='header'>
                        <img src="../media/icons8-lista-50.png" class='view-list'/>
                        <img src="../media/icons8-cuadricula-de-actividad-2-50.png" class='view-grid'/>
                    </header>
                    <ol class='grid' id='frame'>
                        <div class="concert_box">
                            <li class='frame'>
                                <div class='inset'>
                                    <div class='image'></div>
                                    <div class='info'>
                                        <div class='title'>Lorem Ipsum</div>
                                        <div class='description'>bfuiebadj</div>
                                        <div class='shares'>
                                            <div class='icon-lik likes'></div>
                                            <div class='icon-ask comments'></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                        <div class="concert_box">
                            <li class='frame'>
                                <div class='inset'>
                                    <div class='image'></div>
                                    <div class='info'>
                                        <div class='title'>Lorem Ipsum</div>
                                        <div class='description'></div>
                                        <div class='shares'>
                                            <div class='icon-lik likes'></div>
                                            <div class='icon-ask comments'></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                        <div class="concert_box">
                            <li class='frame'>
                                <div class='inset'>
                                    <div class='image'></div>
                                    <div class='info'>
                                        <div class='title'>Lorem Ipsum</div>
                                        <div class='description'></div>
                                        <div class='shares'>
                                            <div class='icon-lik likes'></div>
                                            <div class='icon-ask comments'></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                        <div class="concert_box">
                            <li class='frame'>
                                <div class='inset'>
                                    <div class='image'></div>
                                    <div class='info'>
                                        <div class='title'>Lorem Ipsum</div>
                                        <div class='description'></div>
                                        <div class='shares'>
                                            <div class='icon-lik likes'></div>
                                            <div class='icon-ask comments'></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                        <div class="concert_box">
                            <li class='frame'>
                                <div class='inset'>
                                    <div class='image'></div>
                                    <div class='info'>
                                        <div class='title'>Lorem Ipsum</div>
                                        <div class='description'></div>
                                        <div class='shares'>
                                            <div class='icon-lik likes'></div>
                                            <div class='icon-ask comments'></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
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
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
        <script src="../js/gridList_toggle.js" type="text/javascript"></script>
    </body>
</html>
