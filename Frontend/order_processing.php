
<html>
    <head>
        <title>Order_Processing.php</title>
    <meta charset="UTF-8"/>
    </head>
    <body>
    <div id="header">
        <img src="wrench.png" alt="" id='logo'>
        <a href="index.php" class='invis-link'>
            <h1 id="page-title">Auto Parts Store</h1>
        </a>
        <div id="search-div">
            <form action="./search_results.php" method="post" id="search-form">
                <input type="text" value="Search For Products" name="srch-field" id="srch-field">
                <input type="submit" form="search-form">
            </form>
        </div>
        <button type='submit' class='nav-btn' form='cart_form'>Cart</button>
</div>
<?php

echo "Input Information";

<form action="ConfirmationPage.php" method="POST">
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <br><br>
  Email: <input type="text" name="email" value="<?php echo $email;?>">
  <br><br>
  Credit Card Number: <input type="text" name="ccNum" value="<?php echo $ccNum;?>">
  <br><br>
  Experation Date: <input type="text" name="exp" value="<?php echo $exp;?>">
  <br><br>
  <input type="submit"/>  
</form>

$transactionID1 = rand(100,999);
$transactionID2 = rand(100000000,999999999);
$transactionID3 = rand(100,999);

$TotaltransactionID = "$transactionID1-$transactionID2-$transactionID3"

$url = 'http://blitz.cs.niu.edu/CreditCard/';
$data = array(
    'vendor' => 'AutoPartsOnline',
    'trans' => $TotaltransactionID,
    'cc' => $ccNum,
    'name' => $name, 
    'exp' => $exp, 
    'amount' => $totalPrice);

$options = array(
    'http' => array(
        'header' => array('Content-type: application/json', 'Accept: application/json'),
        'method' => 'POST',
        'content'=> json_encode($data)
    )
);

$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['transactionID'] = $TotaltransactionID;

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo($result);

?>
</body>
</html>