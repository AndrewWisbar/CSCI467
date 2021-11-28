<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Store - Order Fulfillment</title>
</head>
<body>
<h3>Unfulfilled Orders</h3>
<form action="./packing_info.php" method="post">
<table>
    <tr>
        <th>Order ID</th>
        <th>Total Weight</th>
        <th>Select</th>
    </tr>
<?php

include 'connect.php';

//if there is an active session end it.
if(session_id() != "") {
    session_unset();
    session_destroy();
}

// connect to new DB
$conn = open_connection();

//Get all unfulfilled orders
$query = "SELECT * FROM ordertotals \nWHERE Status = 0";
$result = $conn->query($query);

//display orders in table
if($result) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["OrderID"] . "</td><td>" . $row["TotalWeight"] . '</td><td><button type="submit" name="submit" value="'. $row['OrderID'] .'">Pack Order</button></td></tr>';
    }
}
else {
    Print("Failed To Retrieve Order Information");
}
?>
</table>
</form>
<form action="./" method="post">
    <button type='submit'>Home</button>
</form>
</body>