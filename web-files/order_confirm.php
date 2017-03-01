<?php
session_start();
?> 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">
	<head> 
		<!--Joe-->
		<title> User Registration Confirmation Page </title>
		<link rel="stylesheet" type="text/css" href="format.css"/>
		<link rel="icon" href="favicon.ico"/>
	</head>

		<?php
		
				$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

				if(!$db)
					exit("Error - could not connect to MySQL");
				
				$er = mysql_select_db("bjoseph2");
				if(!$er)
					exit("Error - could not select post database");
				
				
				$cust = $_SESSION['Session_ID'];
				$prices = $_POST['price'];
				$quantity = $_POST['quantity'];
				$itemList =  $_POST['name'];
				$address =   mysql_real_escape_string(htmlspecialchars($_POST['address']));
				$zip =   mysql_real_escape_string(htmlspecialchars($_POST['zip']));
				$state =   mysql_real_escape_string(htmlspecialchars($_POST['state']));
				$rest = $_SESSION['current'];
				$list ="";
				$total=0;
				$counter=0;
				
				//loops for every field within the post, checks if it is entered and creates the list and calculates the final price
				for ($i=0; $i < count($_POST['quantity']); $i++) {
					if($_POST['quantity'][$i]>0){
	
						$list =  $list." ".$_POST['name'][$i].": ".$_POST['quantity'][$i];
						$total += ( $_POST['quantity'][$i] * $_POST['price'][$i]);
						}
				}
		
	
				$insert = "INSERT INTO COrder(customer_ID , Restaurant_ID , item_list, cost, street , zip, state,completed) VALUES ('$cust','$rest','$list',
					'$total','$address','$zip', '$state',0)";
					
					mysql_query($insert);
		
		
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
 //check to see if user is signed in as a customer before displaying anything on page
if($_SESSION['Login'] == "customer"){
?>
		<h2>Order Info</h2>
		<table>
		<tr>
			<th colspan="2">Order Summary</th><th>Total Cost</th>
		</tr>
		<tr>
			<td colspan="2"><?php echo $list ?></td><td> <?php echo $total ?> </td>
		</tr>
		</table>
		<p>Your order has been placed!</p>
		
		<?php
	}//end check to see if customer
		else{
		?>
		<p>You must be signed in as a customer to view this page.</p>
		<?php } ?>
	</div>

		
	</body>
</html>
</html>