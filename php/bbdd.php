<meta charset="UTF-8">
<?php
function getProvince($nombre){
    $c = conectar();
    $select = "SELECT * FROM ciudades.provincias
where comunidad_id = 
(select id_comunidad from ciudades.comunidades where nombre = '$nombre')";
    $result = mysqli_query($c, $select);
    desconectar($c);
    return $result;
}
function getCouncil(){
    $c = conectar();
    $select = "select * from ciudades.comunidades";
    $result = mysqli_query($c, $select);
    desconectar($c);
    return $result;
}
function conectar(){
    $conexion = mysqli_connect("localhost", "root", "", "ciudades");
    mysqli_set_charset($conexion, 'utf8');
    if(!$conexion){
        die ("You couldn't connect to the database");
    }
    return $conexion;
}
function desconectar($conexion){
    mysqli_close($conexion);
}
?>