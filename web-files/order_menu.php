<?php
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<!--Created by Joe Bennett-->
<head>
	<title>Menu</title>
	<link rel="stylesheet" type="text/css" href="format.css" />
	<link rel="icon" href="favicon.ico"/>
	<script type="text/javascript" src="order.js"> </script>
	  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
</head>
<body onload="specialColor()">
	<?php 
		$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

	if(!$db)
		exit("Error - could not connect to MySQL");
	
	
	$er = mysql_select_db("bjoseph2");
	if(!$er)
		exit("Error - could not select post database");
	

	
	$RestID =  mysql_real_escape_string(htmlspecialchars($_GET['rest']));
	$_SESSION['current'] = $RestID;
	$select = "Select * FROM Restaurant WHERE Restaurant_ID = '$RestID'";
	
	$result = mysql_query($select);
	$row_array= mysql_fetch_array($result);
	
//php function that uses the pathway from a database entry to pull the file from the storage location on server, and the mime type to allow http know how to handle encoding 
function imageAccess($file, $mime) 
{  
  $contents = file_get_contents($file);
  $base64   = base64_encode($contents); 
  return ('data:' . $mime . ';base64,' . $base64);
}
	?>


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
	<div class="center">
	<?php
 //check to see if user is signed in as a customer before displaying anything on page
if($_SESSION['Login'] == "customer"){
?>
		<br />
		<div class="restInfo">
			<h2><?php echo $row_array["name"] ?></h2>
			<img src="<?php echo imageAccess($row_array["logo"],"image/".$row_array["mime"]) ?>" alt="Logo" />
			<h3> Address: <?php echo $row_array["street"] ?> <?php echo $row_array["state"] ?> <?php echo $row_array["zip"] ?></h3>
			<h3> Phone Number: <?php echo $row_array["phone"] ?> </h3>
			<h3> Specilities: <div id="special"><?php echo $row_array["keyword"] ?></div></h3>
		</div>
		<br />
		<form name="order" action="order_confirm.php" method="POST" onsubmit="return validate();">

			
		<?php 
			$selectItems = "Select * FROM Item WHERE Restaurant_ID = '$RestID'";
			$results = mysql_query($selectItems);
	
		 while($foodArray= mysql_fetch_array($results)){
			?>
			
			<div class="menuBlock">
				<img src="<?php echo imageAccess($foodArray["picture"],"image/".$foodArray["mime"])?>" alt="Item" /> 
					<div class="menuPrice">
						<p>Price: $<input size="100" type="text" value="<?php echo $foodArray["price"] ?>" name="price[]"  readonly /><br />
						  <label>
							Quantity: <input type="number" name="quantity[]" />
						  </label>
						</p>
					</div>
					
					<p><input type="text" value="<?php echo $foodArray["name"] ?>" name="name[]" readonly /><br />
					<?php echo $foodArray["description"] ?></p>
					
					<br /> 
			</div>
		
				
			<?php 
		}
		?>
		
	
		<br />
			<div class="menuBlock" id="confirm">
					<label>Delivery Address <input type="text" name="address" id="address" /></label>
					<label>Zip <input type="text" name="zip" id="zip" /></label>
					<label>State <select name="state" id="state">
						<option value="MD">Maryland</option>
						<option value="VA">Virgina</option>
						<option value="DC">Washington D.C.</option>
						</select></label>
					<input type="button" value="Use Home Address" onclick="getDefaultAddress()" />
					<input type="submit" value="Order Now" />
					<br />
					<br />
			</div>
			</form>
			<?php
	}//end check to see if signed in as a customer
	else{
	?>	
	<p> You must be signed in as a customer to view this page.</p?
	<?php
	}
	?>
	</div>
</body>

</html>