<?php
    session_start();
    print_r($_POST);
    $transactionID1 = rand(100,999);
    $transactionID2 = rand(100000000,999999999);
    $transactionID3 = rand(100,999);

    $TotaltransactionID = "$transactionID1-$transactionID2-$transactionID3";
    $_SESSION['name'] = $_POST['in_name'];
    $_SESSION['email'] = $_POST['in_email'];
    $_SESSION['transactionID'] = $TotaltransactionID;

    $url = 'http://blitz.cs.niu.edu/CreditCard/';
    $data = array(
        'vendor' => 'AutoPartsOnline',
        'trans' => $TotaltransactionID,
        'cc' => $_POST['in_ccNum'],
        'name' => $_POST['in_name'], 
        'exp' => $_POST['in_exp'], 
        'amount' => $_SESSION['totalPrice']);

    $options = array(
        'http' => array(
            'header' => array('Content-type: application/json', 'Accept: application/json'),
            'method' => 'POST',
            'content'=> json_encode($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    echo($result);
?>