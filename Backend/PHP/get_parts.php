<?php
$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully to: " . $servername;

/* change character set to utf8 */
$conn->set_charset("utf8");

// Collects data from "parts" table 
$sql = "SELECT * FROM parts";
$prods = array();
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {  
		$prods[$row['number']] = array("desc"=>$row['description'], "price"=>$row['price'], "weight"=>$row['weight'], "picURL"=>$row['pictureURL']);
	} 
} else {
	Print "0 records found";
}

echo json_encode($prods)
$conn->close();
?>