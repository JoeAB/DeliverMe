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
	
     //retrieve login field data (should we check ifsett first?)
	$login =  mysql_real_escape_string(htmlspecialchars($_POST["restName"]));
	$pass =  mysql_real_escape_string(htmlspecialchars($_POST["restPass"]));
	

	$select = "Select * From Restaurant where manager_email ='$login' AND password = '$pass' " ;
	$result = mysql_query($select);
	if(mysql_num_rows($result) == 1){

			//creates session info
			$restaurant = mysql_fetch_assoc($result);
			$_SESSION['Session_ID'] = $restaurant['Restaurant_ID'];
			$_SESSION['Login'] = "restaurant";
			session_write_close();
	}
		
	else
	
?>

<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="format.css" />
	
	
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
		if($_SESSION['Login'] == "restaurant"){
	?>
	<p>Login was successful.</p>
	
	<?php
	}
	else{
		?>
		<p>Login failed</>
		
		
	<?php
	}
	?>

	</div>
		
</body>

</html>