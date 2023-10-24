<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<link href="css/chronology.css" rel="stylesheet" type="text/css">
<script src="js/jquery-3.4.0.min.js" type="text/javascript"></script>
</head>
<body>
<div id="container">
<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
include 'getin.php';

$result = mysql_query("SELECT chronology.id, chronology.start_date, chronology.end_date, chronology.title, chronology.exhibit, chronology.caption, milieus.milieu FROM chronology LEFT JOIN milieus ON chronology.milieu = milieus.milieu_id WHERE id=$_GET[id]",$db);
while ($myrow = mysql_fetch_array($result)) {	
printf("<div id=\"exhibit_photo\"><img src=\"chronology_exhibits/%s\"></div><div id=\"exhibit_text\">%s %s</div><div id=\"exhibit_caption\">%s</div>",  $myrow["exhibit"],  $myrow["start_date"], $myrow["title"], $myrow["caption"]);
$thisdate = $myrow["start_date"];
}
$userinfoq = mysql_query("SELECT user_first, user_last, user_birth FROM chronology_user WHERE user_id='1'",$db);
while ($userinfo = mysql_fetch_array($userinfoq)) {
$birthdate = $userinfo["user_birth"];
$firstname = $userinfo["user_first"];
$lastname = $userinfo["user_last"];
}
// echo $thisdate;
// echo $birthdate;
// echo dateDiff($birthdate, $thisdate);
$dayslived = dateDiff($birthdate, $thisdate);
printf("This was the %sth day of %s %s's life.", $dayslived, $firstname, $lastname);

$long_itemsq = mysql_query("SELECT * FROM chronology_long LEFT JOIN milieus ON chronology_long.milieu = milieus.milieu_id WHERE start_date > $thisdate",$db);
while ($long_items = mysql_fetch_array($long_itemsq)) {echo "hello";}
?>
<div id="timesfeed"></div>
<script type="text/javascript">
$(document).ready(function(){
	console.log("started");
var url = 'http://api.nytimes.com/svc/search/v1/article?format=json&query=abstract:world&begin_date=20081001&end_date=20081201&facets=classifiers_facet&fields=title, url&api-key=adab4d9b8f688083e2c5da69d034c783:14:25085358';
var nytimes = $('<ul id="nytimes">').appendTo("#timesfeed");
	console.log(url, nytimes);
$.getJSON(url,function(data){
	console.log(url);
$.each(data.results, function(i,item){
var s = item.title;
nytimes.append('<li><a href="http://www.nytimes.com/'+s+'"title="click to view on nytimes.com">click to view</a></li>');
});
});
});
</script>

</div>
</body>
</html>
