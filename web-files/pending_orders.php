<?php
session_start();
?> 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">
<!--Created by Joe Bennett-->

<?php

 //connect to database server
 $db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

	if(!$db)
		exit("Error - could not connect to MySQL");	
	
	//open database
	$er = mysql_select_db("bjoseph2");
	if(!$er)
		exit("Error - could not select post database");
	
	//checks to see if restaurant is marking the order as complete
	if(isset($_POST)){
		$ordNum = $_POST["oNum"];
		$update ="UPDATE COrder SET completed = 1 WHERE order_ID ='$ordNum'";
		mysql_query($update);
	}
?>



<head>
	<title>Pending Orders</title>
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
	//check to see if restaurant is logged in or not
	if($_SESSION['Login'] == "restaurant"){
	?>
		<br />
		
		<table style="border: 3px solid white;border-spacing: 25px;">
			<tr>
				<th colspan="10">Order Date and Time</th>
				<th colspan="10">Order Location</th>
				<th colspan="10">Ordered Items</th>
				<th>Total Cost</th>
			</tr>
			<?php
			$restID = $_SESSION['Session_ID'];
			$orderSelect = "Select * from COrder where Restaurant_ID = '$restID' AND completed = 0";
			$orderResult = mysql_query($orderSelect);
			//loops through all orders that are pending
			while($order_array= mysql_fetch_array($orderResult)){
			?>
			<tr>
				<!-- loop form generation with the value of the COrder as the submit value --> 
				<form method="POST" action="pending_orders.php">
					<td colspan="10"><?php echo $order_array["delv_time"] ?></td>
					<td colspan="10"><?php echo $order_array["street"]?>, <?php echo $order_array["city"] ?> <?php echo $order_array["state"]?> <?php echo $order_array["zip"]?></td>
					<td colspan="10"><?php echo $order_array["item_list"] ?></td>
					<td>$<?php echo $order_array["cost"] ?> </td>
					<td>Order ID <input type="text" name="oNum" value="<?php echo $order_array["order_ID"] ?>" size="4" readonly/></td>
					<td><input  type="submit" value="Mark Completed" /></td>
				</form>
			</tr>
			<?php
			} //ends printout loop
			?>
		</table>
		<br />
	<?php
	}
	else{
	?>
		<p> You must be signed into a restaurant account to access this page.</p>	
	<?php	
	}
	?>
	</div>
</body>