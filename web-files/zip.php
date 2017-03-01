<?php
session_start();

		$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

	if(!$db)
		exit("Error - could not connect to MySQL");
	
	
	$er = mysql_select_db("bjoseph2");
	if(!$er)
		exit("Error - could not select post database");
	

	
	$userId = $_SESSION['Session_ID'];
	$select = "Select * FROM Customer WHERE customer_ID = '$userId'";
	
	$result = mysql_query($select);
	$row_array= mysql_fetch_array($result);
	echo($row_array["zip"]);
	?>