<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>Search Page Part B</title>
</head>

<body>
<form action = "resultpb.php" method = "GET">


<?php
require_once('db.php');
mysql_connect(DB_HOST, DB_USER, DB_PW);
$dbcon = mysql_connect(DB_HOST, DB_USER, DB_PW);

if(!$dbcon)
{
//echo 'Could not connect to mysql on ' . DB_HOST . "\n";
//exit;
die('Can not accesse '.mysqlerror());
}
echo 'Connected to mysql on ' . DB_HOST . "\n";
mysql_select_db("winestore", $dbcon);

mysql_close($dbcon);
?>





<br />
<br />
<br />

<span>Please Enter wine name:</span>
<input type = "text" name = "winename" id = "winename" />
<br />
<br />
<br />
<br />

<span>Enter winery name:</span>
<input type = "text" name = "wineryname" id = "wineryname" />
<br />
<br />



<?php
require_once('db.php');
mysql_connect(DB_HOST, DB_USER, DB_PW);
$dbcon = mysql_connect(DB_HOST, DB_USER, DB_PW);

if(!$dbcon)
{
//echo 'Could not connect to mysql on ' . DB_HOST . "\n";
//exit;
die('Can not accesse '.mysqlerror());
}
//echo 'Connected to mysql on ' . DB_HOST . "\n";
mysql_select_db("winestore", $dbcon);


$query_region = "select region_name from region ";
$result_region = mysql_query($query_region, $dbcon);
echo "Select a region ";
echo "<select name = 'region' id  = 'region'>";
while ($option = mysql_fetch_row($result_region)){
	for($j = 0; $j < mysql_num_fields($result_region); $j++){
		echo "<option value = '$option[$i]'>$option[$i]</option>";
	}
}
echo "</select>";
echo "<br />";
echo "<br />";
echo "<br />";


$query_grape = "select region_name from grape ";
$result_grape = mysql_query($query_grape, $dbcon);
echo "Select a grape variety";
echo "<select name = 'grape' id  = 'grape'>";
while ($option = mysql_fetch_row($result_grape)){
	for($j = 0; $k < mysql_num_fields($result_grape); $k++){
		echo "<option value = '$option[$i]'>$option[$i]</option>";
	}
}
echo "</select>";
echo "<br />";
echo "<br />";
echo "<br />";

echo "Select years";
echo "<select name = 'years' id  = 'years'>";


$query_years = "select region_name from grape ";
$result_years = mysql_query($query_years, $dbcon);
while ($option = mysql_fetch_row($result_years)){
	$year[$i] = mysql_result($result_years, $i);



	for($i = 0; $i <count($year); $i++){
		
		//echo "<option value = '$option[$i]'>$option[$i]</option>";
		echo "<option value = '$year[$i]~$year[$count]'>$year[$i]~$year[$count]</option>";
	}

	
}
echo "</select>";
echo "<br />";
echo "<br />";
echo "<br />";




?>

<span>Minimum number of wines in stock</span>
<input type = "text" name = "minstock" id = "minstock" value = 0 />
<br />
<br />
<br />
<span>Minimum number of wines ordered</span>
<input type = "text" name = "minorder" id = "minorder" value = 0 />
<br />
<br />
<br />
<span>Enter minimum cost:</span>
<input type = "text" name = "mincost" id ="mincost" value = 0 />
<br />
<br />
<br />
<span>Enter maximum cost:</span>
<input type= "text" name = "maxcost" id="maxcost" value = 0 />
<br />
<br />
<br />

<input type = "submit" name = "submit" id = "submit" value = "Search" />


<br />
<br />



</form>
</body>
</html>