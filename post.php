<?php
session_start();

require 'functions.php';


if(isset($_POST["posting"])) {
    $message = $_POST["posting_area"];

    $date = date_create();
    
    $timestamp = date_timestamp_get($date);

    $username = $_SESSION["username"];
    
    $query = "INSERT INTO post
                VALUES ('', '$timestamp', '$username', '$message', '')
            ";
    mysqli_query($db, $query);

    header("Location: home.php");
    exit;
}

if(isset($_POST["buttonDelpost"])) {

    $id = $_POST["buttonDelpost"];
    
    $queryA = " DELETE FROM post WHERE id = $id; ";
    $queryB = " DELETE FROM post WHERE id_parent = $id; ";
    mysqli_query($db, $queryA);
    mysqli_query($db, $queryB);

    header("Location: home.php");
    exit;
}
?>