<?php
  session_start();
  
 //connect to database server
 $db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

	if(!$db)
		exit("Error - could not connect to MySQL");	
	
	//open database
	$er = mysql_select_db("bjoseph2");
	if(!$er)
		exit("Error - could not select post database");
?> 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">
<!--Created by Joe Bennett-->

<head>
	<title>Order History</title>
	<link rel="stylesheet" type="text/css" href="format.css" />
	<link rel="icon" href="favicon.ico"/>
</head>
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
	//checks session to see if user is a logged in customer before displaying item list
	 if($_SESSION['Login'] == "customer"){
	?>
		<br />
		
		<table style="border: 3px solid white;border-spacing: 25px;">
			<tr>
				<th colspan="10">Order Date and Time</th>
				<th>Restaurant</th>
				<th colspan="10">Ordered Items</th>
				<th>Total Cost</th>
			</tr>
			<?php
			//loop through ordered menu items
			$userId = $_SESSION['Session_ID'];
			$orderSelect = "SELECT * FROM COrder WHERE customer_ID = '$userId'";
			$orderResult = mysql_query($orderSelect);
			//loops through all orders
			while($order_array= mysql_fetch_array($orderResult)){
				//select name of restaurant
				$resID = $order_array["Restaurant_ID"];
				$resSelect = "SELECT name FROM Restaurant WHERE Restaurant_ID = '$resID'";
				$resNameResult = mysql_query($resSelect);
				$resNameArray = mysql_fetch_array($resNameResult);
			?>
			<tr>
				<td colspan="10"><?php echo $order_array["delv_time"] ?></td>
				<td><?php echo $resNameArray["name"] ?></td>
				<td colspan="10"><?php echo $order_array["item_list"] ?></td>
				<td>$<?php echo $order_array["cost"] ?> </td>
			</tr>
			<?php
			} //ends printout loop
			?>
		</table>
		<br />
	<?php
	  }
	  //ends printout if check for logged in user
	  // print if not a signed in user
	  if($_SESSION['Login']=="restaurant"|| !isset($_SESSION['Login'])){
		?>
		<p>You must be a registered user to view this page.</p>
		<?php
	  }
		?>
	</div>
</body>