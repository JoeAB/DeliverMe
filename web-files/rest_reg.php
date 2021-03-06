<?php
session_start();
?>  
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">

<head>
	<title>Restaurant Registration</title>
	<link rel="stylesheet" type="text/css" href="format.css" />
	<link rel="icon" href="favicon.ico"/>
	<script type = "text/javascript"  src = "rest_reg.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
	
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
	<div class="center">
		<div class="register">
			<form action = "RestRegisterConfirm.php" method="POST" id="restLogin" name="restLogin" enctype="multipart/form-data" onsubmit=" return validate();">
				<table>
					<tr>
						<td>Enter Restaurant Name</td>
						<td>Enter E-Mail Address</td>
					</tr>
					<tr>
						<td> <input type="text" name="restaurantName" id="rName" /> </td>
						<td> <input type="text" name="email" id="email" /></td>
					</tr>
					<tr>
						<td>Enter Restaurant Street Address</td>
						<td>Enter Zip Code</td>
					</tr>
					<tr>
						<td> <input type="text" name="address" id="address" /></td>
						<td> <input type="text" name="zip" id="zip" /></td>
					</tr>
					<tr>
						<td>Enter a Password</td>
						<td>Verify your Password</td>
					</tr>
					
					<tr>
						<td> <input type="password" name="password" id="password" /></td>
						<td> <input type="password" name="cPassword" id="cPassword"/></td>
					</tr>
					
					<tr>
						<td>Select your State</td>
						<td>Select Specialty</td>
					</tr>
					<tr>
						<td><select name="state">
								<option value="MD">Maryland</option>
								<option value="VA">Virgina</option>
								<option value="DC">Washington D.C.</option>
							</select>
						</td>
						<td>
						<select name="keywords" >
							<option value="Italian">Italian</option>
							<option value="Chinese">Chinese</option>
							<option value="French">French</option>
							<option value="Vietnamese">Vietnamese</option>
							<option value="American">American</option>
							<option value="Japanese">Japanese</option>
							<option value="Mexican">Mexican</option>
							<option value="Indian">Indian</option>
							<option value="Other">Other</option>
						</select>
									
						</td>
						
					<tr>
						<td>Enter a Phone Number</td>		
					</tr>
					
					<tr>
						<td> <input type="text" name="phone" id="phone"/></td>
					</tr>	
					</tr>
						<tr>
						<td>Upload Logo or Location Picture</td>
						<td></td>
					</tr>
					<tr>
						<td> <input type="file" name="fileToUpload" /></td>
						<td> <input type="submit" value="Register"/></td>
						
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>

</html>