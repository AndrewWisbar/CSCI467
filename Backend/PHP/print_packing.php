<?php
/*
print_packing.php

this script prints the packing slip for a given order
First it retireves the order's info from the database,
Then it generates the text for the file,
Then finally it creates the file and downloads it.
*/
include 'connect.php';
session_start();

//connect to new database
$conn = open_connection();

//connect to legacy database
$leg_conn = legacy_connect();

//get the general details of the order
$query = "SELECT * FROM orderdetails WHERE OrderID=" . $_SESSION['order'];
$res = $conn->query($query);
$row = $res->fetch_assoc();

// Put general order info into file
$content = "Packing Slip - Order #" . $_SESSION['order'] . "\n\n" . "Ship To: " . $row['lname'] . ', ' . $row['fname'] . "\n     at: " . $row['addr'] . "\n\nContents:\n";

// get the parts from the order
$query = "SELECT * FROM orderquantity \nWHERE OrderID = " . $_SESSION['order'];
$result = $conn->query($query);

//for each part, get its info and append it to the file
if($result) {
    while($row = $result->fetch_assoc()) {

        $leg_query = "SELECT * FROM parts WHERE number = " . $row['ItemID'];
        $leg_res = $leg_conn->query($leg_query);
        $part = $leg_res->fetch_assoc();
        $content = $content . "\nPART: \"". $part['description'] . "\" WEIGHT: " . $part['weight'] . " X" . $row['OrderedQuantity']; 
    }
}


//generate the file and download
$file = "packing_slip_" . $_SESSION['order'] . ".txt";
$txt = fopen($file, "w") or die("Unable to open file!");
fwrite($txt, $content);
fclose($txt);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename='.basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
header("Content-Type: text/plain");
readfile($file);

?>