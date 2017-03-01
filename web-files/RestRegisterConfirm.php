<?php
session_start();
?> 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">
	<head> 
		<title> Restaurant Registration Confirmation Page </title>
		<link rel="stylesheet" type="text/css" href="format.css"/>
		<link rel="icon" href="favicon.ico"/>
	</head>
		<?php
	
	
	$target_dir = "/afs/umbc.edu/users/b/j/bjoseph2/pub/php-files/";



	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadAllow = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "GIF" && $imageFileType != "PNG" && $imageFileType != "JPG"  && $imageFileType != "JPEG"  ) {
		
		$uploadAllow = 0;
	}

	if ($uploadAllow  == 0) {
		
	// try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			
		} else {
		
		}
	}
				$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

				if(!$db)
					exit("Error - could not connect to MySQL");
				
				$er = mysql_select_db("bjoseph2");
				if(!$er)
					exit("Error - could not select post database");
				
				$restName =   mysql_real_escape_string(htmlspecialchars($_POST['restaurantName']));
				$restEmail =   mysql_real_escape_string(htmlspecialchars($_POST['email']));
				$restAddress =   mysql_real_escape_string(htmlspecialchars($_POST['address']));
				$restZip =   mysql_real_escape_string(htmlspecialchars($_POST['zip']));
				$restPass =   mysql_real_escape_string(htmlspecialchars($_POST['password']));
				$restState =   mysql_real_escape_string(htmlspecialchars($_POST['state']));
				$restKeywords =   mysql_real_escape_string(htmlspecialchars($_POST['keywords']));
				$restLogo =  $target_file;
				$restPhone =  mysql_real_escape_string(htmlspecialchars($_POST['phone']));
				$mime = $imageFileType;
	
				$insert = "INSERT INTO Restaurant(name , street , zip , state , manager_email , password , logo , phone, keyword,mime) VALUES ('$restName', '$restAddress', '$restZip', 
					'$restState','$restEmail','$restPass','$restLogo', '$restPhone', '$restKeywords','$mime')";
					
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
	if($create==true){
		$select = "Select * From Restaurant where manager_email ='$restEmail' AND password = '$restPass'" ;
		$result = mysql_query($select);
		if(mysql_num_rows($result) == 1){
			echo("Account created. Starting creating your menu and reaching customers now!");
			//creates session info
			$restaurant = mysql_fetch_assoc($result);
			$_SESSION['Session_ID'] = $restaurant['Restaurant_ID'];
			$_SESSION['Login'] = "restaurant";
		}
	}
	else
		echo("Account creation failed.")
	?>
	</div>

		
	</body>
</html>