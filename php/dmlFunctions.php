<?php

/* ----------------------------------------- DELETE ----------------------------------------- */

function delete_array($table, $field, $valuesArray){
    $deleteValues = "";
    
    // Building of DELETE sentence
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
    $result = mysqli_query($connection, $delete);
        
    disconnect($connection);
    return $result;
}

/* ----------------------------------------- UPDATE ----------------------------------------- */

function update($table, $field, $newValue, $conditions = ""){
    $connection = connect();
    
    $update = "update $table set $field = $newValue $conditions";
    if (mysqli_query($connection, $update)){
        $result = "Ok";
    } else {
        $result = mysqli_error($connection);
    }
    
    disconnect($conexion);
    return $result;
}

/* ----------------------------------------- INSERT ----------------------------------------- */

function insert_array($table, $valuesArray){
    $insertValues = "";
    
    // Building of INSERT sentence
    foreach($valuesArray as $value){
        $insertValues = $insertValues . "'$value', ";
    }
    $insertValues = $insertValues . "_";                        // Gitanada para eliminar ", " 
    $insertValues = str_replace(", _", "", $insertValues);      // del final de la sentencia
    
    return insert($table, $insertValues);
}
function insert($table, $values){
    $connection = connect();
    
    $insert = "insert into $table values ($values)";
    if (mysqli_query($connection, $insert)){
        $result = "Ok";
    } else {
        $result = mysqli_error($connection);
    }
    
    disconnect($connection);
    return $result;
}

/* ----------------------------------------- SELECT ----------------------------------------- */



function count_field($field, $table, $name){
    $select = "select $field from $table where $field = '$name'";    
    $result = mysqli_num_rows(mysqli_query($connection, $select));
    
    return mysqli_num_rows(select());
}
// Returns a single value instead of a select result
function select_value($field, $table, $conditions = ""){
    $valueAssoc = mysqli_fetch_assoc(select($field, $table, $conditions));
    return $valueAssoc["$field"];
}
//  $fields = exact field names ONLY
function selectFields($fields, $table, $conditions = ""){
    // Remove " "s and add table name before each field, just in case
    $fields = "$table." . $fields;
    $fields = str_replace(",", ",$table.", str_replace(" ", "", $fields));
    
    return select($fields, $table, $conditions);
}
function select($fields, $table, $conditions = ""){
    $connection = connect();
    
    $select = "select $fields from $table $conditions";
    $result = mysqli_query($connection, $select);
        
    disconnect($connection);
    return $result;
}

/* --------------------------------------- CONNECTION --------------------------------------- */

function connect(){
    $connection = mysqli_connect("localhost", "root", "", "ohhmusic");    
    if (!$connection){
        die("No se ha podido establecer la conexión");
    }
    
    return $connection;
}
function disconnect($connection){
    mysqli_close($connection);
}