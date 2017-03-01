<?php
session_start();
?> 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">
	<head> 
		<title> User Registration Confirmation Page </title>
		<link rel="stylesheet" type="text/css" href="format.css"/>
		<link rel="icon" href="favicon.ico"/>
	</head>

		<?php
		
		//if(isset($_POST))
				$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

				if(!$db)
					exit("Error - could not connect to MySQL");
				
				$er = mysql_select_db("bjoseph2");
				if(!$er)
					exit("Error - could not select post database");
				
				$fname =   mysql_real_escape_string(htmlspecialchars($_POST['fName']));
				$lname =   mysql_real_escape_string(htmlspecialchars($_POST['lName']));
				$user_email =   mysql_real_escape_string(htmlspecialchars($_POST['email']));
				$password =   mysql_real_escape_string(htmlspecialchars($_POST['pass']));
				$verfiy_password =   mysql_real_escape_string(htmlspecialchars($_POST['passV']));
				$user_address =   mysql_real_escape_string(htmlspecialchars($_POST['address']));
				$user_zip =   mysql_real_escape_string(htmlspecialchars($_POST['zip']));
				$user_state =   mysql_real_escape_string(htmlspecialchars($_POST['state']));

				if ($password == $verfiy_password) {
					$password = $verfiy_password;
				}
				else {
					echo("Error, passwords do not match.");
				}

	
				$insert = "INSERT INTO Customer(email , first_name , last_name , password , street , zip, state) VALUES ('$user_email','$fname', '$lname',
					'$password','$user_address','$user_zip', '$user_state')";
					
					//checks to see if insert was success
				$create = mysql_query($insert);
		
		?>

<body>
		<div class="top">
		<h1>DeliverMe</h1>
				<p>We deliver your take-out orders!</p>
	</div>
	<div class="nav">
		<img src="logo.png" alt="Company logo" width="200" height="150"/>
		<ul>
			<li><a href="home.php">Home</a></li>
			<?php
			//displays new user if no sign in data is there
			if(!isset($_SESSION['Login'])){
			?>
			<li><a href="user_reg.php">New Customer</a></li>
			<li><a href="rest_reg.php">New Restaurant</a></li>
			<?php
			}
			//checks if customer 
			if($_SESSION['Login'] == "customer"){
			?>
			<li><a href="order_history.php">History</a></li>
			<li><a href="search.php">Search</a></li>
			<!--Click links should link directly to search result page url and with keywords appended to the url to fill in as search result parameters-->
			<li>Quick Search Categories
				<ul>
					<!-- This hard link will be removed and replaced with PHP generated search results in final project.-->
					<li><a href="search.php?search=Italian&searchType=keyword">Italian</a></li>
					<li><a href="search.php?search=Chinese&searchType=keyword">Chinese</a></li>
					<li><a href="search.php?search=French&searchType=keyword">French</a></li>
					<li><a href="search.php?search=Vietnamese&searchType=keyword">Vietnamese</a></li>
					<li><a href="search.php?search=American&searchType=keyword">American</a></li>
					<li><a href="search.php?search=Japanese&searchType=keyword">Japanese</a></li>
					<li><a href="search.php?search=Mexican&searchType=keyword">Mexican</a></li>
					<li><a href="search.php?search=Indian&searchType=keyword">Indian</a></li>
				</ul>
			</li>
			<?php
			}
			//rest options
			if($_SESSION['Login'] == "restaurant"){
			?>
			<li><a href="item_add.php">Menu</a></>
			<li><a href="pending_orders.php">Pending Orders</a></li>
			<?php
			}
			if(isset($_SESSION['Login'])){
			?>
			<li><a href="logout.php">Logout</a></li>
			<?php
			}
			?>
		</ul>
	</div>

	<div class="center" >
			<?php
			//checks to see if creation was success
		if($create ==true){
			//signs the user into their account after they have been registered
			$select = "Select * From Customer where email ='$user_email' AND password = '$password'  " ;
			$result = mysql_query($select);
			if(mysql_num_rows($result) == 1){
				echo("Success. Start browsing and ordering now!");
				//creates session info
				$customer = mysql_fetch_assoc($result);
				$_SESSION['Session_ID'] = $customer['customer_ID'];
				$_SESSION['Login'] = "customer";

			}
		}
	else
			echo("Failed to create account.");
		?>

	</div>

		
	</body>
</html>
</html>