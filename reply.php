<?php
session_start();

require 'functions.php';

if(isset($_POST["reply"])) {
    $id_parent = $_POST["reply"];

    $message = $_POST["reply_area"];

    $date = date_create();
    
    $timestamp = date_timestamp_get($date);

    $username = $_SESSION["username"];
    
    $query = "INSERT INTO post
                VALUES ('', '$timestamp', '$username', '$message', '$id_parent')
            ";
    mysqli_query($db, $query);

    header("Location: home.php");
    exit;
}

if(isset($_POST["buttonDelrep"])) {

    $id = $_POST["buttonDelrep"];
    
    $query = " DELETE FROM post WHERE id = $id; ";
    mysqli_query($db, $query);

    header("Location: home.php");
    exit;
}
?>