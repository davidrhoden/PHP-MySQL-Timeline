<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
//$db = mysql_connect("internal-db.s48663.gridserver.com", "db48663", "howlinwolf") or die ("Couldn't connect to the production machine.");
//mysql_select_db("db48663_davidrhoden",$db) or die ("Couldn't select db."); 


$db = mysql_connect("localhost", "root", "root") or die ("Couldn't connect to the local machine.");
mysql_select_db("db48663_davidrhoden",$db) or die ("Couldn't select db."); 

//$var_array = explode("/",$_SERVER['PATH_INFO']);
//$arr = $var_array[1];
$eYear ='';
$eMonth = '';
$eDay = '';
$monthnames = array(0=>" ","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug",
					"Sep","Oct","Nov","Dec");
$dates = array($eYear, $eMonth, $eDay);
$today = date("Y-M-d");
$todayarray = explode("-", $today);
$makeordinal = implode("-", $dates);

function dateDiff($start, $end) {
$start_ts = strtotime($start);
$end_ts = strtotime($end);
$diff = $end_ts - $start_ts;
return round($diff / 86400);
}

?>