<?php

require_once 'dmlFunctions.php';
session_start();

switch (key($_GET)) {
    case 'draw':
        switch (array_values($_GET)[0]) {
            /* ------------------------------ DRAW CONCERTS ------------------------------ */
            case 'concert':
                // Select all accepted concerts
                $concerts = select("m.artist_name, u.name as localName, y.name as province, m.phone, c.concert_date, c.concert_time",
                        "concert c inner join user u on c.id_local = u.id_user
                        inner join musician m on c.id_musician = m.id_musician
                        inner join local l on c.id_local = l.id_local
                        inner join city y on u.id_city = y.id_city",
                        "where c.state = 1
                        order by c.concert_date, c.concert_time asc");

                while ($concert = mysqli_fetch_assoc($concerts)) {
                    /* CONCERT BOX */
                    echo "
                        <div class='concert_box'>
                            <img id='concert_img' src='../media/random.jpg'>
                            <div id='concert_info'>
                                <div class='concert_info_title'>
                                    <img src='../media/icons8-micrófono-2-filled-50.png'>
                                    <span>".$concert['artist_name']."</span>                                    
                                    <img src='../media/icons8-cabaña-filled-50.png'>
                                    <span>".$concert['localName']."</span>
                                </div>
                                <div class='concert_info_title'>
                                    <img src='../media/icons8-marker-filled-50.png'>
                                    <span>".$concert['province']."</span>                                    
                                    <img src='../media/icons8-smartphone-con-pantalla-táctil-26.png'>
                                    <span>".$concert['phone']."</span>
                                </div>
                                <div class='concert_info_title'>
                                    <img src='../media/icons8-calendar-64.png'>
                                    <span>".$concert['concert_date']."</span>
                                    <span>".$concert['concert_time']."</span>
                                    <img src='../media/icons8-corazones-40.png'>
                                </div>
                            </div>
                        </div>                               
                    ";
                }
                break;
            /* ----------------------------- LIST MUSICIANS ----------------------------- */
            case 'musician':
                // Select fan's genre musicians
                $musicians = mysqli_fetch_assoc(select("m.artist_name as 'Nombre de artista', g.name as Genero", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre"));
                $musicians += [ "Voto" => 0 ];
                echo "<table>";
                // Header
                foreach ($musicians as $key => $value) {
                    echo "<th>$key</th>";
                }
                $musicians = select("m.id_musician, m.artist_name as 'Nombre de artista', g.name as Genero", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre");
                while ($musician = mysqli_fetch_assoc($musicians)) {
                    echo "<tr>
                        <td>".$musician["Nombre de artista"]."</td>
                        <td>".$musician["Genero"]."</td>";
                    // Draw LIKE button if the fan didn't vote for the musician yet, UNLIKE button otherwise
                    echo "<td>".(mysqli_num_rows(select("id_fan", "voteMusician", "WHERE id_fan = '".$_SESSION["id_user"]."' AND id_musician = '".$musician["id_musician"]."'")) > 0 ? 
                                    "<input type='button' value='YA NO MI GUSTA' id='unlike' onclick='voteMusician(".$musician["id_musician"].", 0)'>" :
                                    "<input type='button' value='MI GUSTA' id='like' onclick='voteMusician(".$musician["id_musician"].", 1)'>"
                                    
                                ).
                        "</td>
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
        if ($_GET["value"] == 1)
            insert("voteMusician", $_SESSION["id_user"].", ".$_GET["voteMusician"]);
        else delete("voteMusician", "WHERE id_fan = '".$_SESSION["id_user"]."' AND id_musician = '".$_GET["voteMusician"]."'");
    default:
}

?>