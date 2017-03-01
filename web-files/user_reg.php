<?php
session_start();
?> 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">

<head>
	<title>Customer Registration</title>
	<link rel="stylesheet" type="text/css" href="format.css" />
	<link rel="icon" href="favicon.ico"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
	<script type="text/javascript" src="user_check.js"></script>
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
			<form action = "user_confirm.php" method="POST" onsubmit="return validate()">
							<table >
					<tr>
						<td>Enter your first name</td>
						<td>Enter your last name</td>
					</tr>
					<tr>
						<td> <input type="text" name="fName" id="f" /></td>
						<td> <input type="text" name="lName" id="l"/></td>
					</tr>
					<tr>
	
						<td>Enter your Email Address</td>
					</tr>
					<tr>
			
						<td> <input type="text" name="email" value="" id="e" 
							onblur="checkEmail(this.value);"/><span id="emailbox"></span> </td>
					</tr>
					<tr>
						<td>Enter a Password</td>
						<td>Verify your Password</td>
					</tr>
					<tr>
						<td> <input type="password" name="pass" id="p" /></td>
						<td> <input type="password" name="passV" id="pv"  /></td>
					</tr>
					<tr>
						<td>Enter your Address</td>
						<td>Enter your ZIP Code</td>
					</tr>
					<tr>
						<td> <input type="text" name="address" id="a" /></td>
						<td> <input type="text" name="zip" id="z" /></td>
					</tr>
					<tr>
						<td>Select your State</td>
						<td></td>
					</tr>
					<tr>
						<td> <select name="state">
							<option value="MD">Maryland</option>
							<option value="VA">Virgina</option>
							<option value="DC">Washington D.C.</option>
							</select>
						</td>
						<td> <input type="submit" value="Register" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>

</html>