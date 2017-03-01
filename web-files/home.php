<?php
  session_start();
  
  
  function imageAccess($file, $mime) 
{  
  $contents = file_get_contents($file);
  $base64   = base64_encode($contents); 
  return ('data:' . $mime . ';base64,' . $base64);
}
?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>Home</title>
	<script type = "text/javascript" src = "home.js" ></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js"></script>
	
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
	<?php
	//displays login block if has not logged in this session, should have logout option in place if they are not
	if(!isset($_SESSION['Login'])){
	?>
	<div class="Login">
		<h3>Customer Login:</h3>
		<form name="clogin" id="clogin" action="loginUser.php" method="POST" onsubmit="return chk_blank_clogin();">
        <p>
        Username:
		<br />
        <input type="text" name="custName" id="cName" onblur="bold_cname();"/>
        <br />
		Password:
		<br />
        <input type="password" name="custPass" id="cPass"/>
		<br />
		<br />
		<input type="submit" value="Submit" id= "cSubmit" onclick="return chk_blank_clogin();"/>
		New User? <a href="user_reg.php">Sign Up</a>
		</p>
		</form>
		
		<h3>Restaurant Login:</h3>
		<form name="rlogin" id="rlogin" action="loginRest.php" method="POST" onsubmit="return chk_blank_rlogin();">
        <p>
			Restaurant ID:
			<br />
			<input type="text" name="restName" id="rName" onblur="bold_rname();"/>
			<br />
			Password:
			<br />
			<input type="password" name="restPass" id="rPass" />
			<br />
			<br />
			<input type="submit" value="Submit" id="rSubmit" onclick="return chk_blank_rlogin();"/>
			New Restaurant? <a href="rest_reg.php">Sign Up</a>
		</p>
		</form>
	</div>
	<?php
	
	}
	//else for log out should go here
	
	?>
	<div class="center" >
		<div style="float:right; text-align:center; width:50%;">
			<h2>DeliverMe Advantage</h2>
			<ul>
				<li>Providing services to the DC, Maryland, and Virginia area.</li>
				<li>Enabling restuarants to focus on their food, not running a delivery business.</li>
				<li>Offers competitive, timely deliveries other services can't compete with.</li>
				<li>Restuarants do more business, customers get more food, and everyone is happy</li>
			</ul>
		</div>
		
		<h2>About DeliverMe</h2>
			<p>  Founded in Baltimore Maryland, DeliverMe acts as the middleman between customers and vendors. Customers
			   create an account, search through the many fine locations hosted on our site based on what they're in the mood for, and browse the menu to order what they want.
			   Our delivery staff will then go directly to the seller, pick up the food for the customer, and deliver it to the customer's current location. It's that easy!</p>
	    <br />
		<hr />
		
			<?php
		
		//if(isset($_POST))
				$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

				if(!$db)
					exit("Error - could not connect to MySQL");
				
				$er = mysql_select_db("bjoseph2");
				if(!$er)
					exit("Error - could not select post database");
				
				$select = "SELECT * FROM Restaurant WHERE Restaurant_ID = (SELECT MAX(Restaurant_ID) FROM Restaurant)";
				$result = mysql_query($select);
				$f_array = mysql_fetch_array($result);
		
			?>
				<div id="featured">
				<a href="order_menu.php?rest=<?php echo $f_array['Restaurant_ID']?>" > <h2> <?php echo $f_array['name']?></h2> <br />
				<img style="  margin-left: 450px;	  margin-right: 400px;	" src="<?php echo imageAccess($f_array["logo"],"image/".$f_array["mime"]) ?>" alt="Logo" /> </a>

				</div>
				<br />
				<form onclick="">
				<input style=" margin-left: 450px;	  margin-right: 450px;" value="Show Another Restaurant" type="button" onclick="newRest()">
				</form>
	
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	</div>
		
</body>

</html>