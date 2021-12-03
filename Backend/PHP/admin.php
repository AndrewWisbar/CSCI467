<html><head><title>Admin</title></head><body><pre>
<div align="center">
<style>
	hr.line1 { 
		border: 0; 
 		height: 1px; 
 		background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
 		background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
 		background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
 		background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
 	}
</style>
<?php

	// How it works:
	//
	// 1) Weight brackets:
	// 2) Ask user how many brackets to use
	// 3) Submit button
	// 4) After submit is valid, prompt user a bunch of text boxes (Weight, Rate)
	// 5) Submit button
	// 6) After submit is valid (all weights and rates are valid numbers), store it into database

	//hide warnings (caused when there's initially no input data)
	error_reporting(E_ERROR | E_PARSE);

	include 'connect.php';

	//if there is an active session, end it
	if(session_id() != "") {
		session_unset();
		session_destroy();
	}
	//database connections
	$conn = open_connection();
	$conn2 = legacy_connect();
	session_start();
	
	echo "<font size=30><b>Admin Interface</b></font>\n\n";
	echo "<hr class=line1>";
	echo "\n\n\n";
	echo "<font size=5><b>Setup shipping / handling charges:</b></font>\n\n";
	echo "Enter number of weight brackets:\n";
	
	echo '<form action="" method="POST" id="form1"></form>';
	echo "<input type=text name=input_total_brackets id=total_brackets form=form1>";
	echo '<input type="submit" name="input_submit1" id="input_submit1" value="Submit" form="form1">';
	echo "\n\n";

	//SAVE SESSION DATA FOR TEXTBOX IF THERE IS VALID INPUT
	$input_submit1 = $_POST["input_submit1"];
	$input_total_brackets = $_POST["input_total_brackets"];
	if(isset($input_submit1) and isset($input_total_brackets) and is_numeric($input_total_brackets) and ($input_total_brackets > 0))
	{
		$_SESSION["input_total_brackets"] = $input_total_brackets; //Save to session	
	}
	//SET UP TABLE IF THE USER WANTS TO MAKE NEW BRACKETS
	if(isset($_SESSION["input_total_brackets"]))
	{
		echo '<form action="" method="POST" id="form2"></form>';
		echo "Enter the weight and rate for each bracket:\n";
		echo "Weight                  Rate\n";
		for ($i=0; $i < $_SESSION["input_total_brackets"]; $i++)
		{
			//SETUP ROW [WEIGHT, RATE]
			echo "<input type=text name=weight$i id=weight$i form=form2>";
			echo "<input type=text name=rate$i id=rate$i form=form2>";
			echo "\n";
		}
		echo "\n";
		echo '<input type="submit" name="input_submit2" id="input_submit2" value="Submit" form="form2">';	
	}
	//CHECK EACH TEXT BOX VALUE
	$input_submit2 = $_POST["input_submit2"];
	if(isset($input_submit2))
	{
		$input_valid = True;
		for ($i=0; $i < $_SESSION["input_total_brackets"]; $i++)
		{
			$val1 = $_POST["weight$i"];
			$val2 = $_POST["rate$i"];
			if (!isset($val1) or !is_numeric($val1) or !isset($val2) or !is_numeric($val2))
			{
				$input_valid = False;
			}	
			
		}
		if ($input_valid == True)
		{
			//clear out old brackets from database
			$query = "DELETE FROM shiprate";
			$result = $conn->query($query);
			//insert new brackets
			for ($i=0; $i < $_SESSION["input_total_brackets"]; $i++)
			{
				$val1 = $_POST["weight$i"];
				$val2 = $_POST["rate$i"];
				$query = "INSERT INTO shiprate (bound, rate) VALUES ($val1, $val2)";
				$result = $conn->query($query);
				
			}
		}
	}
	echo "<hr class=line1>";
	echo "\n\n\n";

	//VIEW ORDERS=====================================

	echo "<font size=5><b>View all orders:</b></font>\n\n";
	echo "Select a search filter:\n";

	echo '<form action="" method="POST" id="sort"></form>';
	echo '<input type="submit" name="allorders" value="All Orders" form="sort">';
	echo " ";
	echo '<input type="submit" name="daterange" value="Date Range" form="sort">';
	echo " ";
	echo '<input type="submit" name="status" value="Status" form="sort">';
	echo " ";
	echo '<input type="submit" name="pricerange" value="Price Range" form="sort">';
	echo "\n\n";
	
	//Determine filter for orders list
	$button1_click = $_POST["allorders"];
	if(isset($button1_click) and !empty($button1_click))
	{
		$_SESSION["sort"] = 1;	
	}
	$button2_click = $_POST["daterange"];
	if(isset($button2_click) and !empty($button2_click))
	{
		$_SESSION["sort"] = 2;
	}
	$button3_click = $_POST["status"];
	if(isset($button3_click) and !empty($button3_click))
	{
		$_SESSION["sort"] = 3;
	}
	$button4_click = $_POST["pricerange"];
	if(isset($button4_click) and !empty($button4_click))
	{
		$_SESSION["sort"] = 4;
	}
	//Set default sort if it's 0
	if($_SESSION["sort"] == 0)
	{
		$_SESSION["sort"] = 1;
	}
	

	//draw_table documentation
	//	Params
	//		$result is the returned value from the SQL query
	//	
	//	How it works
	//		Takes the result and creates a tab

	function draw_table($result)
	{
		echo "List of orders based on search:\n\n";
		echo "<table border=1 cellspacing=2>";
		echo "<tr>";
		echo "<td>"."<b>Order ID</b>"."</td>";	
		echo "<td>"."<b>Time</b>"."</td>";	
		echo "<td>"."<b>First Name</b>"."</td>";	
		echo "<td>"."<b>Last Name</b>"."</td>";	
		echo "<td>"."<b>Email</b>"."</td>";	
		echo "<td>"."<b>Address</b>"."</td>";	
		echo "<td>"."<b>Total Price</b>"."</td>";	
		echo "<td>"."<b>Total Weight</b>"."</td>";
		echo "<td>"."<b>Status</b>"."</td>";	
		echo "</tr>";
		if ($result)
		{
			while($row = $result->fetch_assoc())
			{
				$column1 = $row["OrderID"];
				$column2 = $row["time"];
				$column3 = $row["fname"];
				$column4 = $row["lname"];
				$column5 = $row["email"];
				$column6 = $row["addr"];
				$column7 = $row["TotalPrice"];
				$column8 = $row["TotalWeight"];
				$column9 = $row["Status"];
				echo "<tr>";
				echo "<td>"."$column1"."</td>";
				echo "<td>"."$column2"."</td>";
				echo "<td>"."$column3"."</td>";
				echo "<td>"."$column4"."</td>";
				echo "<td>"."$column5"."</td>";
				echo "<td>"."$column6"."</td>";
				echo "<td>"."$column7"."</td>";
				echo "<td>"."$column8"."</td>";
				echo "<td>"."$column9"."</td>";
				echo "</tr>";
			}
		}
	echo "</table>";
		
	}

	if ($_SESSION["sort"] == 1)
	{
		$query = "SELECT * FROM orderdetails";
		$result = $conn->query($query);
		draw_table($result);
	}
	else if ($_SESSION["sort"] == 2)
	{
		//create 2 text boxes for date range
		echo "\n";
		echo "Enter date range: \n";
		echo '<form action="" method="POST" id="daterange"></form>';
		echo "<input type=text name=date1 id=date1 form=daterange>";
		echo "<input type=text name=date2 id=date2 form=daterange>";
		echo "<input type=submit name=daterange value=Submit form=daterange>";
		echo "\n\n";
		//button click
		$input_submit3 = $_POST["daterange"];
		$daterange1 = $_POST["date1"];
		$daterange2 = $_POST["date2"];
		//make a query
		if (isset($input_submit3) and isset($daterange1) and isset($daterange2))
		{
			$query = "SELECT * FROM orderdetails WHERE `time` BETWEEN "."\"$daterange1\""." AND "."\"$daterange2\"";
			$result = $conn->query($query);
			draw_table($result);
		}

	}
	else if ($_SESSION["sort"] == 3)
	{
		//2 radio buttons for status
		echo "\n";
		echo "Enter status: \n";
		echo '<form action="" method="POST" id="status_"></form>';
		echo "<input type=radio name=status_type id=authorized value=authorized form=status_>";
		echo "<label for=authorized>Authorized</label>";
		echo " ";
		echo "<input type=radio name=status_type id=shipped value=shipped form=status_>";
		echo "<label for=shipped>Shipped</label>";
		echo " ";
		echo "<input type=submit name=status_ value=Submit form=status_>";
		echo "\n\n";
		//button click
		$input_submit3 = $_POST["status_"];
		$status_type = $_POST["status_type"];
		if (isset($input_submit3) and isset($status_type))
		{
			if ($status_type == "authorized")
			{
				$query = "SELECT * FROM orderdetails WHERE Status = 0";
				$result = $conn->query($query);
				draw_table($result);
			}
			else if ($status_type == "shipped")
			{
				$query = "SELECT * FROM orderdetails WHERE Status = 1";
				$result = $conn->query($query);
				draw_table($result);
			}
		}
	}
	else if ($_SESSION["sort"] == 4)
	{
		//2 textboxes
		echo "\n";
		echo "Enter price range: \n";
		echo '<form action="" method="POST" id="pricerange"></form>';
		echo "<input type=text name=price1 id=price1 form=pricerange>";
		echo "<input type=text name=price2 id=price2 form=pricerange>";
		echo "<input type=submit name=pricerange value=Submit form=pricerange>";
		echo "\n\n";
		//button click
		$input_submit3 = $_POST["pricerange"];
		$pricerange1 = $_POST["price1"];
		$pricerange2 = $_POST["price2"];
		//make a query
		if (isset($input_submit3) and isset($pricerange1) and isset($pricerange2))
		{
			$query = "SELECT * FROM orderdetails WHERE TotalPrice BETWEEN "."\"$pricerange1\""." AND "."\"$pricerange2\"";
			$result = $conn->query($query);
			draw_table($result);
		}
	}
	echo "<hr class=line1>";
	
	//View Selected Order
	echo "\n\n\n";
	echo "<font size=5><b>View selected order:</b></font>\n\n";
	echo "Enter an order ID to view complete order details:\n";

	echo '<form action="" method="POST" id="order"></form>';
	echo "<input type=text name=input_orderID id=orderID form=order>";
	echo '<input type="submit" name="input_submit4" id="input_submit4" value="Submit" form="order">';
	echo "\n\n";

	//SAVE SESSION DATA FOR TEXTBOX IF THERE IS VALID INPUT
	$input_submit4 = $_POST["input_submit4"];
	$input_orderID = $_POST["input_orderID"];
	

	if (isset($input_submit4) and !empty($input_submit4) and isset($input_orderID) and is_numeric($input_orderID))
	{
		$query = "SELECT * FROM orderdetails WHERE orderID = $input_orderID";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
	
		$orderID = $row["OrderID"];
		$time = $row["time"];
		$fname = $row["fname"];
		$lname = $row["lname"];
		$email = $row["email"];	
		$addr = $row["addr"];	
		$totalprice = $row["TotalPrice"];	
		$totalweight = $row["TotalWeight"];
		$status = $row["Status"];
		
		echo "Order Summary:\n";
		echo "<table border=1 cellspacing=2>";
		echo "<tr>";
		echo "<td><b>Order ID</b></td>";
		echo "<td><b>Time</b></td>";
		echo "<td><b>First Name</b></td>";
		echo "<td><b>Last Name</b></td>";
		echo "<td><b>Email</b></td>";
		echo "<td><b>Address</b></td>";
		echo "<td><b>Total Price</b></td>";
		echo "<td><b>Total Weight</b></td>";
		echo "<td><b>Status</b></td>";
		echo "</tr>";
		echo "<td>$orderID</td>";
		echo "<td>$time</td>";
		echo "<td>$fname</td>";
		echo "<td>$lname</td>";
		echo "<td>$email</td>";
		echo "<td>$addr</td>";
		echo "<td>$totalprice</td>";
		echo "<td>$totalweight</td>";
		echo "<td>$status</td>";
		echo "</table>";
		echo "\n";

		//get data for each item
		echo "Order Part Data:\n";
		$query = "SELECT * FROM orderquantity WHERE OrderID = $orderID";
		$result = $conn->query($query);
		if ($result)
		{
			echo "<table border=1 cellspacing=2>";
			echo "<tr>";
			echo "<td><b>Part Number</b></td>";
			echo "<td><b>Description</b></td>";
			echo "<td><b>Price</b></td>";
			echo "<td><b>Weight</b></td>";
			echo "<td><b>Quantity Ordered</b></td>";
			echo "</tr>";
			while($row = $result->fetch_assoc())
			{
				$partnumber = $row["ItemID"];
				$quantity = $row["OrderedQuantity"];
				//get description, price, weight from legacyDB
				$query2 = "SELECT * FROM parts WHERE number = $partnumber";
				$result2 = $conn2->query($query2);
				$row2 = $result2->fetch_assoc();
				$description = $row2["description"];
				$price = $row2["price"];
				$weight = $row2["weight"];
				//put row into table
				echo "<tr>";
				echo "<td>$partnumber</td>";
				echo "<td>$description</td>";
				echo "<td>$price</td>";
				echo "<td>$weight</td>";
				echo "<td>$quantity</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		
	


	}

	//Close connections
	$conn->close();
	$conn2->close();
	
?>
</div></pre></body></html>