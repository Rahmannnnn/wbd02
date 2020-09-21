<?php

//Connect ke database
$db = mysqli_connect("localhost", "root", "", "w04");

// Query
function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }

    return $rows;
}

?>