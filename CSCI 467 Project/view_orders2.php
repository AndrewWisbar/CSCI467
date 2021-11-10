<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Parts | Ecommerce Warehouse </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="header">
    <div class="container">
      <div class="navbar">
          <div class="logo">
              <img src="logo.jpeg" width="100px" height="50px">
          </div>
          <img src="pics/menu.png" class="menu-icon" onclick="menutoggle()">
      </div>
      </div>
      </div>
 <form action="http://students.cs.niu.edu/~z1826490/view_orders2.php" method="post">
   <style >
     .center{
       margin-left: auto;
       margin-right: auto;
     }
   </style>
<table class="center" style="width:30%;">
     <tr>
	<td><h1 class='title'>View Orders</h1></td>
     </tr>
 
<tr>
<td><h2 class='title'>Orders can be searched based on date range, status (Placed, Shipped) or prize range.</h2></td>
</tr>

<tr>
<td><label for ="status">Enter status:</label></td>
</tr>

<tr>
<td><input name="status" id="status" type="text" /></td>
</tr>

<br> </br>

<tr>
<td><label for="date1">Enter a first date:</label></td>
</tr>

<tr>
 <td><input name="date1" id="date1" type="date" /></td>
</tr>

<tr>
<td><label for="date2">Enter the second date in the second range:</label></td>
</tr> 

<tr>
<td><input name="date2" id="date2" type="date" /></td>
</tr>

 <br> </br>
<tr>
<td> <label for="price1">Price1:</label> </td>
</tr>

<tr>
<td> <input name="price1" id="price1" type=".01" /></td>
</tr>

<tr>
 <td><label for="price2">Price2:</label></td>
 </tr>

<tr>
<td><input name="price2" id="price2" type=".01" /></td>
</tr>

 <br> </br>

<tr>
 <td><input type="hidden" name="process" value="1" /></td>
</tr>
<tr>
 <td><input type="submit" value="Submit" /></td>
</tr>

</form>
</body>
</html>

<?php

 include("drawtable.php");

 $username = "z1826490";
 $password = "1998May20";

 try
 {
 $dsn = "mysql:host=courses;dbname=z1826490";
 $pdo = new PDO($dsn, $username, $password);
/*
 $r = $pdo->query("SELECT * FROM orders;");
 $row = $r->fetchAll(PDO::FETCH_ASSOC);
 draw_table($row);
/*
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
*/
error_reporting(0);

if (!empty($_POST['date1']) and !empty($_POST['date2']))
{
        $date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

 	$s1 = "SELECT * FROM orders WHERE created_at BETWEEN '";
	$s2 = "$date1";
	$s3 = $s1.$s2;
	$s4 = "' and '";
	$s5 = $s3.$s4;
	$s6 = "$date2";
	$s7 = $s5.$s6;
	$s8 = "';";
	$s9 = $s7.$s8;

	$st = $pdo->prepare("$s9");
	$st->execute();

	$rs = $pdo->query("$s9");
	$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
        draw_table($rows);
}

if (!empty($_POST['price1']) and !empty($_POST['price2']))
{
	$price1 = $_POST['price1'];
	$price2 = $_POST['price2'];

	$s1 = "SELECT * FROM orders WHERE totalPrice BETWEEN '";
	$s2 = "$price1";
	$s3 = $s1.$s2;
	$s4 = "' and '";
	$s5 = $s3.$s4;
	$s6 = "$price2";
	$s7 = $s5.$s6;
	$s8 = "';";
	$s9 = $s7.$s8;

	$st = $pdo->prepare("$s9");
        $st->execute();

        $rs = $pdo->query("$s9");
        $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
        draw_table($rows);
}

if(!empty($_POST['status']))
{
	$status = $_POST['status'];

	$s1 = "SELECT * FROM orders WHERE status='";
	$s2 = "$status";
	$s3 = $s1.$s2;
	$s4 = "';";
	$s5 = $s3.$s4;

	$st = $pdo->prepare("$s5");
        $st->execute();

	$rs = $pdo->query("$s5");
	$rows = $rs->fetchAll(PDO::FETCH_ASSOC);
        draw_table($rows);
}
}
catch(PDOException $e)
{
echo "Connection to database failed: " . $e->getMessage();
}
?>