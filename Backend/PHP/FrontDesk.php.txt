$servername = "blitz.cs.niu.edu";
$username = "student";
$password = "student";
$dbname = "csci467";

$dbhost = "127.0.0.1";
$dbuser = "root";
$dbpass = "";
$db = "auto_parts_store";

Enter Input Data: <input type="text" enter="enter" value="<?php echo $enter;?>">

Input Type:
<input type="radio" name="type"
<?php if (isset($type) && $selection=="description") echo "checked";?>
value="description">Description
<input type="radio" name="type"
<?php if (isset($type) && $selection=="number") echo "checked";?>
value="number">Number

$dbh1 = mysql_connect($servername, $username, $password); 
$dbh2 = mysql_connect($dbhost, $dbuser, $dbpass, true); 

mysql_select_db('$dbname', $dbh1);
mysql_select_db('$db', $dbh2);

if ($_GET["selection"] == "description") 
{
						$query = "SELECT description FROM parts WHERE description = " . $_GET["description"] . ";";
						$rs = $pdo->query($query, $dbh2);
						$rows = $rs->fetch();
						
						$query = "UPDATE InventoryDatabase SET Quantity = Quantity + 1 WHERE ItemID = ";
						$rs = $pdo->exec($query, $dbh1);
						
						echo "<p>Status: Inventory Quantity Updated Successfully</p>";
    
}
else if ($_GET["selection"] == "number") 
{
    					$query = "SELECT number FROM parts WHERE number = " . $_GET["number"] . ";";
						$rs = $pdo->query($query, $dbh2);
						$rows = $rs->fetch();
						
						$query = "UPDATE InventoryDatabase SET Quantity = Quantity + 1 WHERE ItemID = ";
						$rs = $pdo->exec($query, $dbh1);
						
						echo "<p>Status: Inventory Quantity Updated Successfully</p>";
}