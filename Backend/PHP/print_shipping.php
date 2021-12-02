<?php

include 'connect.php';
session_start();

$file = "ship_label_" . $_SESSION['order'] . ".txt";
$txt = fopen($file, "w") or die("Unable to open file!");

$conn = open_connection();
$query = "SELECT * FROM orderdetails WHERE OrderID=" . $_SESSION['order'];
$res = $conn->query($query);

$row = $res->fetch_assoc();

$content = "Shipping Label - Order #" . $_SESSION['order'] . "\n" 
            . $row['lname'] . ", " . $row['fname'] . "\n"
            . $row['addr'] . "\n"
            . "Weight: " . $row['TotalWeight'];


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