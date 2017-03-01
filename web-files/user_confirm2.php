<?php
	$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

		if(!$db)
			exit("Error - could not connect to MySQL");
				
			$er = mysql_select_db("bjoseph2");
			if(!$er)
			exit("Error - could not select post database");

			$user_email =  $_POST["name"];

			$query = "SELECT * FROM Customer where email = '$user_email'";
			$eresult = mysql_query($query);

			if (mysql_num_rows($eresult) > 0 ) {
				$response = "&#x2715;";

			}
			else {
				$response = "&#x2713;";
			}
				
			echo $response;

?>