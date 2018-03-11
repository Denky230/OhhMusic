<?php

function delete_array($table, $field, $valuesArray){
    $deleteValues = "";
    
    // Building DELETE sentence
    foreach ($valuesArray as $value){
        $deleteValues = $deleteValues . "'$value', ";
    }
    $deleteValues = $deleteValues . "_";                        // Gitanada para eliminar ", "
    $deleteValues = str_replace(", _", "", $deleteValues);      // del final de la sentencia
    
    return delete($table, $field, $deleteValues);
}
function delete($table, $field, $values){
    $conexion = connect();
    
    $delete = "delete from $table where $field in ($values)";
    $resultado = mysqli_query($conexion, $delete);
        
    disconnect($conexion);
    return $resultado;
}

function update($table, $field, $newValue, $conditions = ""){
    $conexion = connect();
    
    $update = "update $table set $field = $newValue $conditions";
    if (mysqli_query($conexion, $update)){
        $result = "Ok";
    } else {
        $result = mysqli_error($conexion);
    }
    
    disconnect($conexion);
    return $result;
}


function insert_array($table, $valuesArray){
    $insertValues = "";
    
    // Building SELECT sentence
    foreach($valuesArray as $value){
        $insertValues = $insertValues . "'$value', ";
    }
    $insertValues = $insertValues . "_";                        // Gitanada para eliminar ", " 
    $insertValues = str_replace(", _", "", $insertValues);      // del final de la sentencia
    
    return insert($table, $insertValues);
}
function insert($table, $values){
    $conexion = connect();
    
    $insert = "insert into $table values ($values)";
    if (mysqli_query($conexion, $insert)){
        $result = "Ok";
    } else {
        $result = mysqli_error($conexion);
    }
    
    disconnect($conexion);
    return $result;
}

function count_field($field, $table, $name){
    $conexion = connect();
    
    $select = "select $field from $table where $field = '$name'";    
    $resultado = mysqli_num_rows(mysqli_query($conexion, $select));
    
    disconnect($conexion);
    return $resultado;
}

function select_value($field, $table, $conditions = ""){
    $valueAssoc = mysqli_fetch_assoc(select($field, $table, $conditions));
    return $valueAssoc["$field"];
}
function select($fields, $table, $conditions = ""){
    $conexion = connect();
    
    $select = "select $fields from $table $conditions";
    $resultado = mysqli_query($conexion, $select);
        
    disconnect($conexion);
    return $resultado;
}

// Returns an array containing each word of the string separated by ","
function stringToArray($string){
    return explode(",", str_replace(" ", "", $string));
}

function connect(){
    $conexion = mysqli_connect("localhost", "root", "", "ohhmusic");    
    if (!$conexion){
        die("No se ha podido establecer la conexión");
    }
    
    return $conexion;
}
function disconnect($conexion){
    mysqli_close($conexion);
}

