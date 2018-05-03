<?php

require_once 'dmlFunctions.php';
session_start();

switch (key($_GET)) {
    case 'draw':
        switch (array_values($_GET)[0]) {
            case 'concert':
                // Select all concerts
                $concerts = select("m.artist_name, u.name as name, y.name as province, m.web, c.concert_date, c.concert_time",
                        "concert c inner join user u on c.id_local = u.id_user
                        inner join musician m on c.id_musician = m.id_musician
                        inner join local l on c.id_local = l.id_local
                        inner join city y on u.id_city = y.id_city",
                        "where c.state = 1
                        order by c.concert_date, c.concert_time asc");

                while ($concert = mysqli_fetch_assoc($concerts)){
                    /* CONCERT BOX */
                    echo "
                        <div class='concert_box'>
                            <img id='concert_img' src='../media/random.jpg'>
                            <div id='concert_info'>
                                <div class='concert_info_title'>
                                    <img src='../media/icons8-micrófono-2-filled-50.png'>
                                    <p>".$concert['artist_name']."</p>
                                    <div id='space'></div>
                                    <img src='../media/icons8-arena-filled-50.png'>
                                    <p>".$concert['name']."</p>
                                </div>
                                <div class='concert_info_title'>
                                    <img src='../media/icons8-marker-filled-50.png'>
                                    <p>".$concert['province']."</p>
                                    <div id='space'></div>
                                    <img src='../media/icons8-website-50.png'>
                                    <p>".$concert['web']."</p>
                                </div>
                                <div class='concert_info_title'>
                                    <img src='../media/icons8-calendar-64.png'>
                                    <p>".$concert['concert_date']."</p>
                                    <div id='space'></div>
                                    <img src='../media/icons8-reloj-32.png'>
                                    <p>".$concert['concert_time']."</p>
                                </div>
                            </div>
                        </div>                               
                    ";
                }
                break;
            case 'musician':
                // Select fan's genre musicians
                $musicians = mysqli_fetch_assoc(select("m.artist_name as 'Nombre de artista', g.name as Genero", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre"));
                $musicians += [ "Voto" => 0 ];
                echo "<table>";
                // Header
                foreach ($musicians as $key => $value) {
                    echo "<th>$key</th>";
                }
                $musicians = select("m.artist_name as 'Nombre de artista', g.name as Genero", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre");
                while ($musician = mysqli_fetch_assoc($musicians)) {
                    echo "<tr>
                        <td>".$musician["Nombre de artista"]."</td>
                        <td>".$musician["Genero"]."</td>
                        </tr>";
                }
                echo "</table>";
            default:
        }        
        break;
    case 'voteConcert':
        // Update concert vote
        break;
    case 'voteMusician':
        // Update musician vote
    default:
}

?>