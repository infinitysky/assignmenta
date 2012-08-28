<!DOCTYPE HTML PUBLIC
"-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>Result Page</title>
</head>
<body>
<?php
	require_once('db.php');
	if(!mysql_connect(DB_HOST, DB_USER, DB_PW)){
	echo "unable connect to database";
	}
	else{
	$dbcon = mysql_connect(DB_HOST, DB_USER, DB_PW);
	mysql_select_db('winestore', $dbcon);
	}
	
	
	
	function display($dbcon, $query){
	$result_page = mysql_query($query, $connection);
	$rowfound = mysql_num_rows($result_page);
	echo $rowfound." results found";
	echo "<table width='90%'>";
	echo "<tr><th align='left'>Name</th>
      	<th align='left'>Variety</th>
	  	<th align='left'>Year</th>
	  	<th align='left'>Winery</th>
	  	<th align='left'>Region</th>
	  	<th align='left'>Cost</th>
	  	<th align='left'>Stock</th>
	  	<th align='left'>Price</th>
	  	<th align='left'>Quantity</th>
	  	<th align='left'>Revenue</th></tr>";

	
	
	
	
?>

	
</body>
</html>