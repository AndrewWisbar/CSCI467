<html><head><title>Admin</title></head><body><pre>
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

	//database connections
	include 'connect.php';
	//if there is an active session, end it
	if(session_id() != "") {
		session_unset();
		session_destroy();
	}
	$conn = open_connection();
	$conn2 = legacy_connect();
	session_start();
	
	echo "<font size=30><b>Admin Interface</b></font>\n\n";
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
	echo "\n\n\n";

	//VIEW ORDERS=====================================

	echo "<font size=5><b>View all orders:</b></font>\n\n";
	echo "Select a sort filter:\n";
	echo '<form action="" method="POST" id="sort"></form>';



	//Close connections
	$conn->close();
	$conn2->close();
	
?>
</pre></body></html>