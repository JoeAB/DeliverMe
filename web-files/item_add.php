<?php
session_start();

		$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

	if(!$db)
		exit("Error - could not connect to MySQL");
	
	
	$er = mysql_select_db("bjoseph2");
	if(!$er)
		exit("Error - could not select post database");
?> 
 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns = "http://www.w3.org/1999/xhtml">

<!--Created by Joe Bennett-->
<?php
//checks to see if post for has been filled or not
if (!empty($_POST)){

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
	
 //connect to database server
 $db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

	if(!$db)
		exit("Error - could not connect to MySQL");	
	
	//open database
	$er = mysql_select_db("bjoseph2");
	if(!$er)
		exit("Error - could not select post database");
	
	
	//variable for item insert that retrieves sessions RID
	$restID = $_SESSION['Session_ID'];
	//retrieving rest of post values
	$item = mysql_real_escape_string(htmlspecialchars($_POST["iName"]));
	$price =  mysql_real_escape_string(htmlspecialchars($_POST["iPrice"]));
	$desc =  mysql_real_escape_string(htmlspecialchars($_POST["description"]));
	$filePath = $target_file;
	$mime = $imageFileType;
	//insert new item into database
	//insert into item(name,price,description,picture,Restaurant_ID) values (item, price, desc, filePath, restID)
	//should give path mime type and more
	$insertItem = "INSERT INTO Item(name,price,description,picture,mime,Restaurant_ID) values('$item','$price','$desc', '$filePath','$mime','$restID')";
	mysql_query($insertItem);
	
}//end check to see if submitted 
?>

<head>
	<title>Add to Menu</title>
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
	<div class="center">
	<?php 
	//check to see if restaurant is logged in or not
	if($_SESSION['Login'] == "restaurant"){
	?>
		
				<?php 
				
				$restID = $_SESSION['Session_ID'];
				$selectItems = "Select * FROM Item WHERE Restaurant_ID = '$restID'";
	
				$results = mysql_query($selectItems);
	
				while($foodArray= mysql_fetch_array($results)){
				?>
					<div class="menuBlock">
						<div class="menuPrice">
							<p>Price: <?php echo $foodArray["price"] ?></p>
						</div>
						<p><strong><?php echo $foodArray["name"] ?></strong><br />
						<?php echo $foodArray["description"] ?></p>
						<br /> 
					</div>
				<?php 
				}
				?>
			
			<div class="register">
				<form action = "item_add.php" method="POST" enctype="multipart/form-data">
					<table >
						<tr>
							<td>Enter the name of your menu item</td>
							<td>Enter the price of your menu item</td>
						</tr>
						<tr>
							<td> <input type="text" name="iName" /></td>
							<td> <input type="text" name="iPrice" /></td>
						</tr>
						<tr>
							<td colspan="2">Enter a brief description of the menu item</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2"><textarea name="description" cols="50" rows="2"> </textarea></td>
						</tr>
						<tr>
							<td colspan="2"> <input type="file" name="fileToUpload" /></td>
						</tr>
						<tr>
							<td colspan="2"> <input  type="submit" value="Add Item" /></td>
						</tr>
					</table>
				</form>
			</div>
	<?php 
	}
	//end print if it is a rest
	else{
	?>
		<p> You must be signed into a restaurant account to access this page.</p>	
	<?php	
	}
	?>
		</div>
</body>

</html>