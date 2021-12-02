<?php
include 'connect.php';
session_start();

$conn = open_connection();
$leg_conn = legacy_connect();
$query = "SELECT * FROM orderdetails WHERE OrderID=" . $_SESSION['order'];
$res = $conn->query($query);

$row = $res->fetch_assoc();

$content = "Packing Slip - Order #" . $_SESSION['order'] . "\n\n" . "Ship To: " . $row['lname'] . ', ' . $row['fname'] . "\n     at: " . $row['addr'] . "\n\nContents:\n";

$query = "SELECT * FROM orderquantity \nWHERE OrderID = " . $_SESSION['order'];
$result = $conn->query($query);

if($result) {
    while($row = $result->fetch_assoc()) {

        $leg_query = "SELECT * FROM parts WHERE number = " . $row['ItemID'];
        $leg_res = $leg_conn->query($leg_query);
        $part = $leg_res->fetch_assoc();
        $content = $content . "\nPART: \"". $part['description'] . "\" WEIGHT: " . $part['weight'] . " X" . $row['OrderedQuantity']; 
    }
}

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