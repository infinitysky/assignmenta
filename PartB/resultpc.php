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
	
	$query = "Select wine.wine_name, grape_variety.variety, wine.year, winery.winery_name, region.region_name, inventory.cost, inventory.on_hand, items.price, items.qty, items.qty*items.price-inventory.cost*items.qty as revenue 
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

	$year = $_GET['year'];
	
	$years = explode("~", $year);
	
	$maxyear = intval($years[1]);
	
	$minyear = intval($years[0]);
	
	if(!empty($minyear) && !empty($maxyear)&&$$minyear < $maxyear){
		$query .= " And year between $minyear and $maxyear";
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
//if(empty($resultcheckpage[0]) || !is_numeric($_GET['minstock']) || !is_numeric($_GET['minorder']) || !is_numeric($_GET['mincost'])|| !is_numeric($_GET['maxcost'])){
i
f(empty($resultcheckpage[0]) || !is_numeric($_GET['minstock']) || !is_numeric($_GET['minorder']) || !is_numeric($_GET['mincost'])|| !is_numeric($_GET['maxcost'])){
echo "No result found";

}
else{



define("USER_HOME_DIR", "/home/stud/s3240514");
require(USER_HOME_DIR . "/Smarty-3.1.11/Smarty.class.php");


$smarty = new Smarty();

$smarty->template_dir = USER_HOME_DIR . "/Smarty-Work-Dir/templates";
$smarty->compile_dir = USER_HOME_DIR . "/Smarty-Work-Dir/templates_c";
$smarty->cache_dir = USER_HOME_DIR . "/Smarty-Work-Dir/cache";
$smarty->config_dir = USER_HOME_DIR . " /Smarty-Work-Dir/configs";

$smarty->assign('result', 'Result Page');
$smarty->assign('Name', 'Name');
$smarty->assign('Variety', 'Variety');
$smarty->assign('Year', 'Year');
$smarty->assign('Winery', 'Winery');
$smarty->assign('Region', 'Region');
$smarty->assign('Cost', 'Cost');
$smarty->assign('Stock', 'Stock');
$smarty->assign('Price', 'Price');
$smarty->assign('Quantity', 'Quantity');
$smarty->assign('Revenue', 'Revenue');




while($result = mysql_fetch_assoc($resultcheck)){
$namearray[] = $result["winename"];
$variety[] = $result["variety"];
$year[] = $result["year"];
$winery[] = $result["wineryname"];
$region[] = $result["regionname"];
$cost[] = $result["cost"];
$instock[] = $result["instock"];
$price[] = $result["price"];
$quantity[] = $result["quantity"];
$revenue[] = $result["revenue"];

}


for($i=0; $i<mysql_num_rows($resultcheck); $i++){
$smarty->assign('result_name',$namearray);
$smarty->assign('result_variety', $variety);
$smarty->assign('result_year', $year);
$smarty->assign('result_winery', $winery);
$smarty->assign('result_region', $region);
$smarty->assign('result_cost', $cost);
$smarty->assign('result_stock', $onhand);
$smarty->assign('result_price', $price);
$smarty->assign('result_quantity', $quantity);
$smarty->assign('result_revenue', $revenue);
}
$smarty->display('partc.tpl');
}
	
?>

	
</body>
</html>