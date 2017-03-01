<?php
  function imageAccess($file, $mime) 
{  
  $contents = file_get_contents($file);
  $base64   = base64_encode($contents); 
  return ('data:' . $mime . ';base64,' . $base64);
}




		$db = mysql_connect("studentdb-maria.gl.umbc.edu","bjoseph2","bjoseph2");

				if(!$db)
					exit("Error - could not connect to MySQL");
				
				$er = mysql_select_db("bjoseph2");
				if(!$er)
					exit("Error - could not select post database");
				
		
				$select ="SELECT * FROM Restaurant ORDER BY RAND() LIMIT 1";
				$result = mysql_query($select);
				$f_array = mysql_fetch_array($result);
		
			?>
				<div id="featured">
				<a href="order_menu.php?rest=<?php echo $f_array['Restaurant_ID']?>" > <h2> <?php echo $f_array['name']?></h2> <br />
				<img style="  margin-left: 450px;	  margin-right: 400px;	" src="<?php echo imageAccess($f_array["logo"],"image/".$f_array["mime"]) ?>" alt="Logo" /> </a>
				<?php
?>