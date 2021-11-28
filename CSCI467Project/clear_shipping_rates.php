<?php
 $username = "z1826490";
 $password = "1998May20";

try
 {
 $dsn = "mysql:host=courses;dbname=z1826490";
 $pdo = new PDO($dsn, $username, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $rs = $pdo->prepare("DELETE from management");
 $rs->execute();
 echo "<br>";
 echo "<br>";
 echo "Shipping rates database has been cleared";
 echo "<br>";
 echo "<br>";
}
catch(PDOExeption $e)
{
	echo "Connection to database failed: " . $e->getMessage();
}

?>
<html>
<a href="shippingcost.php"><input type="submit" class="btn" style="background-color: #4CAF50;" color: white; value="return to 'set shipping cost'"/></a>
</html>