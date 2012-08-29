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

require_once('pdodb.php');
$pdo = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME,DB_USER,DB_PW);  
	

	
	$query = "Select wine.wine_name, grape_variety.variety, wine.year, winery.winery_name, region.region_name, inventory.cost, inventory.on_hand, items.price, items.qty, items.qty*items.price-inventory.cost*items.qty
          From wine, grape_variety, winery, region, inventory, items, wine_variety
		  Where wine.winery_id = winery.winery_id
		    And winery.region_id = region.region_id
			And inventory.wine_id = wine.wine_id
			And wine.wine_id = items.wine_id
			And wine.wine_id = wine_variety.wine_id
			And grape_variety.variety_id = wine_variety.variety_id";
	

	
	
	
		
	$winename = $_GET['winename'];
	
	if(!empty($winename) && $winename != "All"){			
		$query .= " And wine_name LIKE '%$winename%'";
	}

	$wineryname = $_GET['wineryname'];
	
	if(!empty($wineryname) && $wineryname != "All"){
		$query .= " And winery_name LIKE '%$wineryname%'";
	}

	$region = $_GET['region'];
	
	if(!empty($regionname) && $region != "All"){
		$query .= " And region_name = '$regionname'";
	}

	$grape = $_GET['grape'];
		if(!empty($grape)){
		$query .= " And variety = '$grape'";
	}

		$maxyear = intval($_GET['yeared']);
	
	$minyear = intval($_GET['yearst']);
	
	if(!empty($minyear) && !empty($maxyear)&&$$minyear < $maxyear){
		$query .= " And year between $minyear and $maxyear";
	}
	if($minyear>$maxyear){
	die("The Max year must great then min year");
	}
	
	$minstock = intval($_GET['minstock']);
	
	if($minstock != 0){
		$query .= " AND inventory.on_hand >= $minstock";
	}
	
	$minorder = intval($_GET['minorder']);
	
	if($minorder != 0){
		$query .= " AND items.qty >= $minorder";
	}
	
	$mincost = intval($_GET['mincost']);
	
	$maxcost = intval($_GET['maxcost']);
	
	if(!empty($mincost) && !empty($maxcost) && $mincost < $maxcost){
		$query .= " AND inventory.cost BETWEEN '$mincost' AND '$maxcost'";
	
	} 
	
	//$query .= " And (inventory.cost between '$minCost' and '$maxCost')";
	





$query .= " order by wine.wine_name";
$resultcheck= mysql_query($query, $dbcon);
$resultcheckpage = mysql_fetch_row($resultcheck);
if(empty($resultcheckpage[0]) || !is_numeric($_GET['minstock']) || !is_numeric($_GET['minorder']) || !is_numeric($_GET['mincost'])|| !is_numeric($_GET['maxcost'])){
echo "No result found";
}else
display($dbcon, $query);	
	
	
	function display($dbcon, $query){
		$result_page = mysql_query($query, $dbcon);
		$rowfound = mysql_num_rows($result_page);
		echo $rowfound." results found";
		echo "<table width='80%'>";
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
		while($result = mysql_fetch_row($result_page)){
				echo "<tr><td width='10%'>$result[0]</td>
	      				<td width='10%'>$result[1]</td>
		  				<td width='10%'>$result[2]</td>
		  				<td width='20%'>$result[3]</td>
		  				<td width='15%'>$result[4]</td>
		  				<td width='10%'>$result[5]</td>
		  				<td width='10%'>$result[6]</td>
		  				<td width='10%'>$result[7]</td>
		  				<td width='10%'>$result[8]</td>
		  				<td>$result[9]</td></tr>";
			}
	
	
	}
	
	
?>

	
</body>
</html>