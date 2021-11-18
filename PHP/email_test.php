<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Store - Order Fulfillment</title>
</head>
<body>
<h3>Unfulfilled Orders</h3>
<?php

include 'connect.php';
//Given an email and an order ID, send a confirmation email
function send_email($ordernum, $items, $to_email) {

    //Subject and sender info
    $subject = "Auto Parts Store Shipment Confirmation Order ID: " . $ordernum;
    $headers = "From: groupa4a.autoparts@gmail.com";

    // Base for the email body
    $body = "This email was sent to confirm that your order ( Order ID: " . $ordernum . " ), has been processed and will be shipped within the next business day. \nOrder Contents: \n\n";
    
    //SQL query to get the item details
    $l_query = "SELECT * FROM parts \nWHERE number = ";
    
    // open connection to legacy db
    $l_conn = legacy_connect();

    //For each part in the order add its details to the email
    foreach($items as $item) {
        // query the legacy db to get part info
        $sub_res = $l_conn->query($l_query . $item['ID']);
        $l_row = $sub_res->fetch_assoc();
        //append the items to the body
        $body = $body . "Part ID: " . $item['ID'] . ", Item Type: \"". $l_row['description'] . "\". Qty: " . $item['qty'] . ", Weight: ". $item['qty'] * $l_row['weight'] ." lbs, Price: $" . $item['qty'] * $l_row['price']  . "\n";
    }
    //send email
    echo (mail($to_email, $subject, $body, $headers)) ?  "Email Sent to " . $to_email : "Error: Email could not be sent to " . $to_email;
}

//get the order details
session_start();

// Query to update inventory info

// Query to change order status to complete
$order_query = "UPDATE ordertotals \nSET Status=1 \nWHERE OrderID=" . $_SESSION['order'];

$conn = open_connection();

//for each item update inventory info
foreach($_SESSION['items'] as $item) {
    //construct query
    $qty_query = "UPDATE inventory \nSET Quantity= Quantity - ";
    $qty_query = $qty_query . $item['qty'] . "\nWHERE ItemID=" . $item['ID'];
    $conn->query($qty_query);
}

// set order as complete
$conn->query($order_query);

//send confirmation email
send_email($_SESSION['order'], $_SESSION['items'], 'andrewwisbar@gmail.com');


//end the session
if(session_id() != '') {
    session_unset();
    session_destroy();
}
?>


<form action="./view_unfulfilled.php" method="post">
    <button type="submit">Return To List</button>
</form>
</body>