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
require_once('db_pdo.php');
$pdo = new PDO("mysql:host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME,DB_USER,DB_PW);  
$query = "Select wine.wine_name, grape_variety.variety, wine.year, winery.winery_name, region.region_name, inventory.cost, inventory.on_hand, items.price, items.qty, (items.qty*items.price-inventory.cost*items.qty) as rev
          From wine, grape_variety, winery, region, inventory, items, wine_variety
		  Where wine.winery_id = winery.winery_id
		    And winery.region_id = region.region_id
			And inventory.wine_id = wine.wine_id
			And wine.wine_id = items.wine_id
			And wine.wine_id = wine_variety.wine_id
			And grape_variety.variety_id = wine_variety.variety_id
			And wine_name LIKE :winename
			And winery_name LIKE :wineryname
			And region_name LIKE :regionname
			And variety = :grapevariety
			And year between :minyear and :maxyear
			And inventory.on_hand >= :minstock
			And items.qty >= :minorder
			And inventory.cost between :mincost and :maxcost
			order by wine.wine_name";
			
$prepare = $pdo->prepare($query, array(PDO::ATTR_CURSOR=>PDO::CURSOR_FWDONLY));
$winename = $_GET['winename'];
if($winename == "All"){
$winename = "";
}
$wineryname = $_GET['wineryname'];
$regionname = $_GET['region'];
if($regionname == "All"){
$regionname = "";
}
$grapevariety = $_GET['grape'];
$year = $_GET['year'];
$years = explode("~", $year);
$maxyear = intval($years[1]);
$minyear = intval($years[0]);
$minstock = intval($_GET['minstock']);
$minorder = intval($_GET['minorder']);
$mincost = intval($_GET['mincost']);
$maxcost = intval($_GET['maxcost']);
$value = array(":winename" => "%$winename%",
               ":wineryname" => "%$wineryname%",
			   ":regionname" => "%$regionname%",
			   ":grapevariety" => "$grapevariety",
			   ":minyear" => "$minyear",
			   ":maxyear" => "$maxyear",
			   ":minstock" => "$minstock",
			   ":minorder" => "$minorder",
			   ":mincost" => "$mincost",
			   ":maxcost" => "$maxcost");

$prepare->execute($value);
$table = $prepare->fetchAll(PDO::FETCH_ASSOC);
$num_table = count($table);
echo "</body>";
echo "</html>";
?>