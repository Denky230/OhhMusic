<?php
function getMunicipality($nombre){
    $conn = mysqli_connect("localhost", "root", "", "ciudades");
    mysqli_set_charset($conn, 'utf8');
    $result = $conn->query("SELECT * FROM ciudades.municipios
where provincia_id = 
(select provincia_id from ciudades.provincias where nom_provincia = '$nombre')");
    while($row = $result->fetch_array()){
        echo($row["nom_municipi"] . "/");
    }
    $conn->close();
}

function getProvince($nombre){
    $conn = mysqli_connect("localhost", "root", "", "ciudades");
    mysqli_set_charset($conn, 'utf8');
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query( "SELECT * FROM ciudades.provincias
    where comunidad_id = 
    (select id_comunidad from ciudades.comunidades where nombre = '$nombre')");
    while($row = $result->fetch_assoc()){
        echo($row["nom_provincia"] . "/");
    }
    $conn -> close();
}

function getCouncil(){
    $conn = new mysqli("localhost", "root", "", "ciudades");
    mysqli_set_charset($conn, 'utf8');
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query("select * from ciudades.comunidades");
    while($row = $result->fetch_assoc()) {
        echo $row["nombre"]."/";
    }
    $conn->close();
}

$query = $_POST['query'];

switch($query){
    case 'comunidad':
        getCouncil();
        break;
    case 'provincia':
        $nombre = $_POST["provin"];
        getProvince($nombre);
        break;
    case 'municipio':
        getMunicipality($nombre);
        break;
    default:
        break;
}

?>