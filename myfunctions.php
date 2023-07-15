<?php
session_start();
include 'config.php';

 function getAll($table){
    global $conn;
    $query = "SELECT * FROM $table";
    return $run_query = mysqli_query($conn,$query);
}

function getById($table,$id){
    global $conn;
    $query = "SELECT * FROM $table WHERE id = '$id'";
    return $run_query = mysqli_query($conn,$query);
}

function getByIdname($table,$id,$row){
    global $conn;
    // Query the database to retrieve the value based on the table, row, and id
    $sql = "SELECT $row FROM $table WHERE id = '$id'";
    $result = $conn->query($sql);
    return $result;
}

function redirect($url,$message){
    $_SESSION['message'] = $message;
    header('Location: '.$url);
    exit();
}


?>