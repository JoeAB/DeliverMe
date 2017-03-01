<?php
session_start();

//connect to database
$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");
if(!$db)
	exit("Error - could not select database");
//select database
$er = mysql_select_db("bjoseph2");
if(!$er)
	exit("Error - could not select database");

function imageAccess($file, $mime) 
{  
  $contents = file_get_contents($file);
  $base64   = base64_encode($contents); 
  return ('data:' . $mime . ';base64,' . $base64);
}

?>
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="format.css" />
	 <script src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js" type="text/javascript"></script>
  <script src = "search.js"></script>
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
 //check to see if user is signed in as a customer before displaying anything on page
if($_SESSION['Login'] == "customer"){
?>

		<h3>Search Restaurants or Food Types</h3><br />

		<form action = "search.php" method="get" onsubmit="return validate();">
			<p>
				<input type="text" name="search" size="70" style="height: 25px;"  id="search" />	
				<input type="submit" value="Search" style="height: 25px;" onMouseOver="this.style.cursor='pointer'" /> <br />
				Suggestions: <input type="text" id="txtHint">
		
			<br /><br />
				Toggle States to Search: 
					<label>Maryland<input type="checkbox" value="MD" name="state[]" checked="checked" /></label>
					<label>Virginia<input type="checkbox" value="VA" name="state[]" checked="checked" /></label>
					<label>Washington D.C.<input type="checkbox" value="DC" name="state[]" checked="checked" /></label>
				<br />Search By:
					<label>Keyword<input type="radio" value="keyword" name= "searchType" /></label>
					<label>Restaurant Name<input type="radio" value="name" name= "searchType" checked="checked" /></label>

			</p>
		</form>
<?php
	
	$search = mysql_real_escape_string(htmlspecialchars($_GET['search']));
	$state = $_GET['state'];
	$searchType = $_GET['searchType'];
	
	
//checks to see if form was submitted or quicklink was selected
if(isset($_GET['searchType'])){

	//add state to where clause
	$state_clause=" and (";
	//needs to change 
	if(sizeof($state)> 0){
		for($i=0; $i < count($state); $i++){
			if($i >=1)
				$state_clause= $state_clause." or ";
			$state_clause= $state_clause."state =  '".$state[$i]."'";
		
		}
		$state_clause = $state_clause.")";
	}
	//if no state check boxes selected, search all states
	else
		$state_clause='';

	//search query under keyword or restaurant name with state selected
	$constructed_query = "SELECT * FROM Restaurant where $searchType like '%".$search."%' ".$state_clause;

	//print("<br>$constructed_query</br>");

	//execute query
	$result = mysql_query($constructed_query);
	if(! $result){
		print("Error - query could not be executed");
		$error = mysql_error();
		print "<p> . $error . </p>";
		exit;
	}

	$num_rows = mysql_num_rows($result);
	$num_fields = mysql_num_fields($result);
	//print result
	if ($num_rows==0)
		print("No restaurants found. Please modify your search and try again.");
	else{
		?>
		<table>
		<?php
		for($row_num = 1; $row_num <= $num_rows; $row_num++){	
			$row_array = mysql_fetch_array($result);
			?>
			<tr><td style="text-align: center;"><a href="order_menu.php?rest=<?php echo $row_array['Restaurant_ID']?>" > <h2> <?php echo $row_array['name']?></h2> <br />
			<img src="<?php echo imageAccess($row_array["logo"],"image/".$row_array["mime"]) ?>" alt="Logo" /> </a>
			</td></tr>
			<?php
		}
		?>
		</table>
	<?php
	}
} //end search data check
} //end customer sign in check statement
	else{ //runs if signed in as rest. or not signed in at all
	?>
		<p> You must be signed into a customer account to access this page.</p>	
	<?php	
	} //close other check
	?>
		</div>
</body>
