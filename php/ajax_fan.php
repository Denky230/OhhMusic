<?php

require_once 'dmlFunctions.php';
session_start();

switch (key($_GET)) {
    case 'draw':
        switch (array_values($_GET)[0]) {
            /* ------------------------- DRAW CONCERTS ------------------------- */
            case 'concert':
                // Select all accepted concerts
                $concerts = select("c.id_concert, m.artist_name, u.name as localName, y.name as province, m.phone, c.concert_date, c.concert_time",
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
                                    <img src='../media/microfono.png'>
                                    <span>".$concert['artist_name']."</span>
                                    <img src='../media/cabana.png'>
                                    <span>".$concert['localName']."</span>
                                </div>
                                <div class='concert_info_title'>
                                    <img src='../media/icons8-marker-filled-50.png'>
                                    <span>".$concert['province']."</span>
                                    <img src='../media/phone.png'>
                                    <span>".$concert['phone']."</span>
                                </div>
                                <div class='concert_info_title'>
                                    <img src='../media/icons8-calendar-64.png'>
                                    <span>".$concert['concert_date']."</span>
                                    <span>".$concert['concert_time']."</span>";
                                // Draw WhiteHeart if the fan didn't vote for this concert yet, RedHeart otherwise
                                echo (mysqli_num_rows(select("id_fan", "voteConcert", "WHERE id_fan = '".$_SESSION["id_user"]."' AND id_concert = '".$concert["id_concert"]."'")) == 0 ? 
                                    "<img src='../media/heart_white.png' onclick='voteConcert(".$concert["id_concert"].", 1)'>" :
                                    "<img src='../media/heart_red.png' onclick='voteConcert(".$concert["id_concert"].", 0)'>").
                                "</div>
                            </div>
                        </div>";
                }
                break;
            /* ------------------------ LIST MUSICIANS ------------------------ */
            case 'musician':
                // Select fan's genre musicians
                $musicians = mysqli_fetch_assoc(select("m.artist_name as 'Nombre de artista', g.name as 'Genero'", "musician m INNER JOIN genre g ON m.id_genre = g.id_genre"));
                $musicians += [ "Voto" => 0 ];
                echo "<table>";
                // Header
                foreach ($musicians as $key => $value) {
                    echo "<th>
                            <div class='header' id='".array_search($key, array_keys($musicians))."'>
                                $key
                                <img src='../media/orderBy".$_GET["order"].".png' id='".$_GET["order"]."'>
                            </div>
                        </th>";
                }
                $musicians = select("m.artist_name as 'Nombre de artista', g.name as Genero, IFNULL(id_fan, 0) as 'Voto', m.id_musician",
                    "musician m INNER JOIN genre g ON m.id_genre = g.id_genre
                    LEFT JOIN voteMusician vm ON m.id_musician = vm.id_musician",
                    "ORDER BY ".$_GET["orderByField"]." ".$_GET["order"]);
                while ($musician = mysqli_fetch_assoc($musicians)) {
                    echo "<tr>
                        <td>".$musician["Nombre de artista"]."</td>
                        <td>".$musician["Genero"]."</td>";
                    // Draw LIKE button if the fan didn't vote for this musician yet, UNLIKE button otherwise
                    echo "<td>".($musician["Voto"] != $_SESSION["id_user"] ? 
                        "<input type='button' value='MI GUSTA' id='like' onclick='voteMusician(".$musician["id_musician"].", 1)'>" : 
                        "<input type='button' value='YA NO MI GUSTA' id='unlike' onclick='voteMusician(".$musician["id_musician"].", 0)'>").
                        "</td>
                        </tr>";
                }
                echo "</table>";
            default:
        }
        break;
    case 'voteConcert':
        // Update concert vote
        if ($_GET["value"] == 1)
            insert("voteConcert", $_SESSION["id_user"].", ".$_GET["voteConcert"]);
        else delete("voteConcert", "WHERE id_fan = '".$_SESSION["id_user"]."' AND id_concert = '".$_GET["voteConcert"]."'");
        break;
    case 'voteMusician':
        // Update musician vote
        if ($_GET["value"] == 1)
            insert("voteMusician", $_SESSION["id_user"].", ".$_GET["voteMusician"]);
        else delete("voteMusician", "WHERE id_fan = '".$_SESSION["id_user"]."' AND id_musician = '".$_GET["voteMusician"]."'");
    default:
}

?>