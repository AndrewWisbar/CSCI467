<?php
 $username = "z1826490";
 $password = "1998May20";

 include("drawtable.php");

 try
 {
 $dsn = "mysql:host=courses;dbname=z1826490";
 $pdo = new PDO($dsn, $username, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 
  $rs = $pdo->query("SELECT * FROM management");
  $rows = $rs->fetchAll(PDO::FETCH_ASSOC);
  if (count($rows) > 0) {
        draw_table($rows);
  }
  else 
  { 
	  echo "<br>";
	  echo "<br>";
	  echo "No shipping rates have been set yet.";
	  echo "<br>";	  
  }
 }
 catch(PDOExeption $e)
 {
	echo "Connection to database failed: " . $e->getMessage();
 }
?>

<html>
<br>	  
<a href="shippingcost.php"><input type="submit" class="btn"  style="background-color: #4CAF50;" value="return to 'set shipping cost' "/></a>
</html>
