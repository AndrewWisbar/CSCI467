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


 <form action="http://students.cs.niu.edu/~z1826490/shippingcost2.php" method="post">
   <style >
     .center{
       margin-left: auto;
       margin-right: auto;
     }
   </style>
   <table class="center" style="width:30%;">
     <tr>
       <td><h1 class='title'>Set Shipping Cost</h1></td>
     </tr>
     <tr>
       <td><label for="max">Max Weight:</label></td>
     </tr>
     <tr>
       <td><input name="max" id="max" type=".01" /></td>
     </tr>
     <br> </br>
     <tr>
       <td><label for="rate">Shipping Rate:</label></td>
     </tr>
     <tr>
       <td><input name="rate" id="rate" type=".001" /> </td>
     </tr>
     <br> </br>
     <tr>
       <td><input type="submit" class="btn" value="submit"/></td>
     </tr>


</form>
</body>
</html>


<?php
 $username = "z1826490";
 $password = "1998May20";

 include("drawtable.php");

 try
 {
 $dsn = "mysql:host=courses;dbname=z1826490";
 $pdo = new PDO($dsn, $username, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 if(!empty($_POST['max']) and !empty($_POST['rate']))
 {
  $max = $_POST['max'];
  $rate = $_POST['rate'];

  $rs = $pdo->prepare("INSERT into management(maxWeight,shippingRate) values(?,?)");
  $rs->execute(array($max,$rate));

  $rs = $pdo->query("SELECT * FROM management");
  $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
  draw_table($rows);
 }

 else
 {
        echo "Submit the correct amount of items.";
 }
	}

catch(PDOExeption $e)
{
        echo "Connection to database failed: " . $e->getMessage();
}
?>
