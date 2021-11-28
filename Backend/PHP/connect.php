<?php
function legacy_connect() {
    $servername = "blitz.cs.niu.edu";
    $username = "student";
    $password = "student";
    $dbname = "csci467";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else {
        return $conn;
    } 
}

function open_connection() {
    $dbhost = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "";
    $db = "auto_parts_store";
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
}

function close_connection($conn) {
    $conn -> close();
}
?>