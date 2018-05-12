<?php

/* --------------------------------------- DELETE --------------------------------------- */

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
function delete($table, $conditions){
    $connection = connect();
    
    $delete = "delete from $table $conditions";
    $result = mysqli_query($connection, $delete);
        
    disconnect($connection);
    return $result;
}

/* --------------------------------------- UPDATE --------------------------------------- */

function updateMultiple($table, $fields, $newValues, $conditions = ""){
    $connection = connect();
    
    // Building of UPDATE sentence
    $update = "update $table set ";
    for ($i = 0; $i < count($fields); $i++) { 
        $update .= "$fields[$i] = '$newValues[$i]',";
    }
    $update = substr($update, 0, strlen($update) - 1)." ".$conditions;
    
    if (mysqli_query($connection, $update)){
        $result = "Ok";
    } else {
        $result = mysqli_error($connection);
    }
    
    disconnect($connection);
    return $result;
}

function update($table, $field, $newValue, $conditions = ""){
    $connection = connect();
    
    $update = "update $table set $field = $newValue $conditions";
    if (mysqli_query($connection, $update)){
        $result = "Ok";
    } else {
        $result = mysqli_error($connection);
    }
    
    disconnect($connection);
    return $result;
}

/* --------------------------------------- INSERT --------------------------------------- */

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

/* --------------------------------------- SELECT --------------------------------------- */

function count_field($field, $table, $name){    
    return mysqli_num_rows(select($field, $table, "WHERE $field = '$name'"));
}
// Returns a single value instead of a select result
function select_value($field, $table, $conditions = ""){
    $valueAssoc = mysqli_fetch_assoc(select($field, $table, $conditions));
    return $valueAssoc["$field"];
}
//  $fields = exact field names ONLY
function select_fields($fields, $table, $conditions = ""){
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

/* ------------------------------------- CONNECTION ------------------------------------- */

function connect(){
    $connection = mysqli_connect("localhost", "root", "", "ohhmusic");    
    if (!$connection){
        die("No se ha podido establecer la conexión");
    }

    mysqli_set_charset($connection,"utf8");

    return $connection;
}
function disconnect($connection){
    mysqli_close($connection);
}
