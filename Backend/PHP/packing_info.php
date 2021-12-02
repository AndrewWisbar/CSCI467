<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"></link>
    <title>Auto Store - Order Fulfillment</title>
</head>
<body>
<h3>Pack Orders</h3>
<table>
    <tr>
        <th>Item ID</th>
        <th>Picture</th>
        <th>Name/Description</th>
        <th>Quantity</th>
    </tr>
<?php

include 'connect.php';

//Start php session
if(!session_start()) {
    echo "Error: Unable to start php Session \nPlease Try Again";
}

//connect to DB
$conn = open_connection();
$leg_conn = legacy_connect();
//get the contents of the order 
$query = "SELECT * FROM orderquantity \nWHERE OrderID = " . $_POST['submit'];
$result = $conn->query($query);

// display order contents
$items = array();
if($result) {
    while($row = $result->fetch_assoc()) {

        $leg_query = "SELECT * FROM parts WHERE number = " . $row['ItemID'];
        $leg_res = $leg_conn->query($leg_query);
        $part = $leg_res->fetch_assoc();
        //store order contents
        $items[] = array("ID"=>$row['ItemID'], 
                        "qty"=>$row['OrderedQuantity']);
        echo "<tr><td>". $row['ItemID'] ."</td><td><img src=\"" . $part['pictureURL'] . "\"</td><td>\"" . $part['description'] . "\"</td><td>". $row['OrderedQuantity'] ."</td></tr>";
    }
}
else {
    Print("Failed To Retrieve Order Information");
}

//store order info for use on next page
$_SESSION['items'] = $items;
$_SESSION['order'] = $_POST['submit'];
?>

</table>
<div class="btn-cont">
    <form action="./email.php" action="get">
        <button type="submit">Contents Packed</button>
    </form>
    <form action="./view_unfulfilled.php" action="get">
        <button type="submit">Could Not Pack Order</button>
    </form>
</div>
<div class="btn-cont">
    <form action="./print_shipping.php" action="get">
        <button type="submit">Print Shipping Label</button>
    </form>
    <form action="./print_packing.php" action="get">
        <button type="submit">Print Packing Info</button>
    </form>
</div>
</body>