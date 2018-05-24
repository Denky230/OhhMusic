<?php
require "dmlFunctions.php";

if(isset($_POST["search"])){
    $name = $_POST["search"];
    $search = search("*", "user u inner join musician m on u.id_user = m.id_musician", "where username like '%$name%' limit 5");

    echo("<ul>");

    while($s = mysqli_fetch_assoc($search)){
        ?>
        <li onclick='fill("<?php echo $Result['Name']; ?>")'><a><?php echo($s["username"]); ?></a></li>
<?php
    }
}
?>