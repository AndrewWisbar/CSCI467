<html>

<head>
	<?php
	$username = 'z1826490' ;
	$password = '1998May20' ;

	try{
	$dsn = "mysql:host=courses;dbname=z1881567" ;
	$pdo = new PDO($dsn, $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	catch(PDOexception $e){
	die("ERROR: Could not connect to database." . $e->getMessage());
	}

	?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Parts | Ecommerce Wedbsite </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="header">
    <div class="container">
      <div class="navbar">
          <div class="logo">
              <a href="index.php"><img src="pics/logo.jpeg" width="100px" height="50px"></a>
          </div>
          <nav>
            <ul id="MenuItems">
              <li> <a href="index.php">Home</a></li>
              <li> <a href="products.php">Products</a></li>
              <li> <a href="user_account.php">Login</a></li>
            </ul>
          </nav>
          <a href="cart.php"><img src="pics/view_cart.png" width="30px" height="30px"></a>

          <img src="pics/menu.png" class="menu-icon" onclick="menutoggle()">
      </div>
    </div>
    </div>
	<title>Order</title>


<form action="sub_order.php" method="POST"> Full Name:

        <input type="text" name="fullname">

	<input type="text" name="Email"> <br> Address:

	<input type="text" name="Street">

	<input type="text" name="City">

	<input type="text" name="State">

	<input type="text" name="ZipCode"> <br> Card Info:

	<input type="text" name="CardNumber">

	<input type="text" name="CardExp">

        <input type="hidden" name="form_submitted" value="1" />

        <input type="submit" value="Submit">

</form>


<?php
	if (isset($_POST['form_submitted'])):
	$randnum = rand(111111111111111,999999999999999);
	$url = 'http://blitz.cs.niu.edu/CreditCard/';
	$data = array(
	'vendor' => 'VE001-99',
	'trans' => $randnum,
	'cc' => $_POST['CardNumber'],
	'name' => $_POST['fullname'],
	'exp' => $_POST['CardExp'],
	'amount' => '654.32');

	$options = array(
    		'http' => array(
        	'header' => array('Content-type: application/json', 'Accept: application/json'),
        	'method' => 'POST',
        	'content'=> json_encode($data)
    		)
	);

	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);


	if (strpos($result, 'errors') !== false) {
	echo("There was an error in your payment please try again");
	}else{
	$array = explode(":", $result);
	$auth = preg_replace('/[^0-9]/', '', $array[8]);

	$insertOrder = $pdo->query("INSERT INTO orders (customerName, customerStreet, customerCity, customerState, customerZip, customerEmail, paymentAuth, totalPrice, status) VALUES ('".$_POST['fullname']."','".$_POST['Street']."', '".$_POST['City']."', '".$_POST['State']."','".$_POST['ZipCode']."','".$_POST['Email']."', '".$auth."', 654.32, 'Placed');");
	echo("Your order has been placed succesfully, thakn you!");
	}
	endif;
?>
</body>

</html>