<?php

    include '../Backend/PHP/connect.php';
    session_start();
    $transactionID1 = rand(100,999);
    $transactionID2 = rand(100000000,999999999);
    $transactionID3 = rand(100,999);

    $TotaltransactionID = "$transactionID1-$transactionID2-$transactionID3";
    $_SESSION['fname'] = $_POST['first_name'];
    $_SESSION['lname'] = $_POST['last_name'];
    $_SESSION['email'] = $_POST['in_email'];
    $_SESSION['transactionID'] = $TotaltransactionID;
    $_SESSION['address'] = $_POST['in_addr'];

    $url = 'http://blitz.cs.niu.edu/CreditCard/';
    $data = array(
        'vendor' => 'AutoPartsOnline',
        'trans' => $TotaltransactionID,
        'cc' => $_POST['in_ccNum'],
        'name' => $_POST['first_name'] . " " . $_POST['last_name'], 
        'exp' => $_POST['in_exp'], 
        'amount' => round($_SESSION['totalPrice'], 2));

    $options = array(
        'http' => array(
            'header' => array('Content-type: application/json', 'Accept: application/json'),
            'method' => 'POST',
            'content'=> json_encode($data)
        )
    );
    // $context  = stream_context_create($options);
    // $result = file_get_contents($url, false, $context);
    // $decoded = json_decode($result);

    if(isset($decoded->errors)) {
        print("<h3>Error: Transaction could not be completed</h3>");
        foreach($decoded->errors as $err) {
            print("<p>" . $err . "</p>");
        }
    }
    else {
        //Update the Orders Database
        $conn = open_connection();


        // add the order to the database
        $query = 'INSERT INTO orderdetails (fname, lname, email, addr, TotalPrice, TotalWeight) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $conn->prepare($query);
        //print_r($conn->error_list);
        $stmt->bind_param("ssssii", $_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['address'], $_SESSION['totalPrice'], $_SESSION['totalWeight']);
        $stmt->execute();

        $ord = $stmt->insert_id;

        //for each item in the order, add it to orderquantity and update the inventory table
        while($entry = current($_SESSION['shopping_cart'])) {

            //add to orderquantity
            $query = 'INSERT INTO orderquantity VALUES (?, ?, ?)';
            $item = key($_SESSION['shopping_cart']);
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iii", $ord, $item, $entry);
            $stmt->execute();

            //update inventory
            $query = 'UPDATE inventory SET Quantity = Quantity - ? WHERE ItemID = ?';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $entry, $item);
            $stmt->execute();
            next($_SESSION['shopping_cart']);
        }

        //send email
        $parts_conn = legacy_connect();
        $body = "Hello " . $_POST['first_name'] . ", \nThis email is to provide confirmation that your order has been recieved and we will ship it as soon as possible. \n\nCONTENTS:\n";
        while($entry = current($_SESSION['shopping_cart'])) {
                
            $query = "SELECT * FROM parts \nWHERE number = " . key($_SESSION['shopping_cart']) . "\nLIMIT 1";

            $result = $parts_conn->query($query);

            if($result) {
                $row = $result->fetch_assoc();
                $body = $body . "\nItem: " . $row['description'] . "  Quantity: " . $entry;
            }
            next($_SESSION['shopping_cart']);
        }

        print("<h3>Success! Your Transaction has been processed!</h3>");
        print("<p>You should recieve an email momentarily confirming your purchase, and another once your order has been packed for shipping.</p>");

        $to_email = $_SESSION['email'];
        $subject = "Auto Parts Store Order Confirmation";
        $headers = "From: groupa4a.autoparts@gmail.com";
        mail($to_email, $subject, $body, $headers);

        session_unset();
    }
?>

<form action="./">
    <button type="submit">Home</button>
</form>