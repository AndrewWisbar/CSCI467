<html><head><title>Warehouse Front Desk</title></head><body><pre>

<?php

	// How it works:
	//
	// 1) Connect to both databases
	// 2) Retrieve user input
	// 3) Look for part in legacy database
	// 4) Store part ID from legacy database
	// 5) Look for part ID in auto_parts_store database
	// 6) Update part quantity by 1


	//hide warnings (caused when there's initially no input data)
	error_reporting(E_ERROR | E_PARSE);

	//database connections
	include 'connect.php';
	//if there is an active session, end it
	if(session_id() != "") {
		session_unset();
		session_destroy();
	}
	$conn = open_connection();
	$conn2 = legacy_connect();
	
	echo "<font size=30><b>Warehouse Front Desk Interface</b></font>\n";
	echo "<font size=5>Input the data below to update the inventory quantity for delivered products</font>\n\n";
	//----------------------------------------------------------------------------------------------------------
	//SETUP FORM	
	//		(NOTE: CHANGE URL BELOW FOR DEMONSTRATION!!!!!!!!!!!!!!!!)
	//		(NOTE: CHANGE URL BELOW FOR DEMONSTRATION!!!!!!!!!!!!!!!!)
	//		(NOTE: CHANGE URL BELOW FOR DEMONSTRATION!!!!!!!!!!!!!!!!)
	//		(NOTE: CHANGE URL BELOW FOR DEMONSTRATION!!!!!!!!!!!!!!!!)
	//		(NOTE: CHANGE URL BELOW FOR DEMONSTRATION!!!!!!!!!!!!!!!!)
	//		(NOTE: CHANGE URL BELOW FOR DEMONSTRATION!!!!!!!!!!!!!!!!)
	//		(NOTE: CHANGE URL BELOW FOR DEMONSTRATION!!!!!!!!!!!!!!!!)
	//		(NOTE: CHANGE URL BELOW FOR DEMONSTRATION!!!!!!!!!!!!!!!!)
	//----------------------------------------------------------------------------------------------------------
	echo '<form action="" method="POST" id="form1"></form>';
	echo '<form action="./" method="POST" id="form2"></form>';
	//----------------------------------------------------------------------------------------------------------
	//RADIO BUTTONS
	//----------------------------------------------------------------------------------------------------------
	echo "Enter input type: \n";
	echo '<input type="radio" name="input_type" id="part_ID" value="ID" form="form1">';
	echo '<label for="part_ID">Part ID</label>';
	echo "\n";
	echo '<input type="radio" name="input_type" id="part_description" value="description" form="form1">';
	echo '<label for="part_description">Part Description</label>';
	echo "\n\n";
	//----------------------------------------------------------------------------------------------------------
	//TEXT BOX
	//----------------------------------------------------------------------------------------------------------
	echo "Enter input data: \n";
	echo '<input type="text" name="input_data" id="part_data" form="form1">';
	echo "\n\n";
	//----------------------------------------------------------------------------------------------------------
	//NUMBER BOX
	//----------------------------------------------------------------------------------------------------------
	echo "Enter quantity to add: \n";
	echo '<input type="number" name="qty_data" id="qty_data" value="0" form="form1">';
	echo "\n\n";
	//----------------------------------------------------------------------------------------------------------
	//SUBMIT BUTTON
	//----------------------------------------------------------------------------------------------------------
	echo '<input type="submit" name="input_submit" id="part_submit" value="Submit" form="form1">';
	echo '<label for="part_submit"> (Update Quantity)</label>';
	echo "\n\n";
	//----------------------------------------------------------------------------------------------------------
	//HOME BUTTON
	//----------------------------------------------------------------------------------------------------------
	echo '<input type="submit" name="Return" id="return" value="Home" form="form2">';
	echo '<label for="part_submit"> (Return to Warehouse Homepage)</label>';
	echo "\n\n";
	//----------------------------------------------------------------------------------------------------------

	//RETRIEVE INPUT DATA
	$qty = $_POST['qty_data'];
	$input_type = $_POST["input_type"];
	$input_data = $_POST["input_data"];
	$input_submit = $_POST["input_submit"];
	
	$status = 0; //(0 = not updated, 1 = updated quantity successfully)

	//CHECK (SUBMIT CLICK) + (INPUT TYPE) + (INPUT DATA)
	if (isset($input_submit) and isset($input_type) and !empty($input_type) and isset($input_data) and !empty($input_data))
	{
		//DETERMINE SEARCH TYPE
		if ($input_type == "ID")
		{
			//SEARCH "ID" IN LEGACY DATABASE
			$query = "SELECT * FROM parts WHERE number = $input_data";
		}
		elseif ($input_type == "description")
		{
			//SEARCH "description" IN LEGACY DATABASE
			$query = "SELECT * FROM parts where description = $input_data";
		}
		//RUN QUERY
		$result = $conn2->query($query);
		if ($result)
		{
			//ONLY USE FIRST RESULT / ROW
			$row = $result->fetch_assoc();
			$part_ID = $row["number"]; //SAVE PART ID AND LOOK UP ID IN OTHER DATABASE + UPDATE QUANTITY
			$query = "UPDATE inventory SET Quantity = Quantity + $qty WHERE ItemID = $part_ID";
			$result = $conn->query($query);
			$rows_affected = mysqli_affected_rows($conn2);
			if ($rows_affected > 0)
			{
				$status = 1;	
			}
		}
		if ($status == 0)
		{
			echo "Status: Problem Updating Inventory Quantity\n";
		}
		elseif ($status == 1)
		{
			echo "Status: Inventory Quantity Successfully Updated\n";
		}
	}

	//Close connections
	$conn->close();
	$conn2->close();
?>
</pre></body></html>
