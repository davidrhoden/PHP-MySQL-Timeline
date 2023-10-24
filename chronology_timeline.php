<!DOCTYPE html>
<html>
<head>
<title>David Rhoden : Chronology</title>
<link href="css/chronology.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
<script type="text/javascript" src="js/jquery.scrollTo.js"></script>
<script type="text/javascript" src="js/jquery.localscroll.js"></script>
<!-- script type="text/javascript" src="js/jquery.lazyload.js" ></script-->
<script type="text/javascript" src="js/chronology.js"></script>
<body>
<div id="timeline_container_container">
	<form action="chronology_timeline_submit" method="get" accept-charset="utf-8">
		<label for="art">Art</label><input type="checkbox" name="art" value="" checked="checked" id="art">
		<label for="school">Medical</label><input type="checkbox" name="medical" value="" checked="checked" id="medical">
		<label for="music">Music</label><input type="checkbox" name="music" value="" checked="checked" id="music">
		<label for="personal">Personal</label><input type="checkbox" name="personal" value="" checked="checked" id="personal">
		<label for="school">School</label><input type="checkbox" name="school" value="" checked="checked" id="school">
		<label for="travel">Travel</label><input type="checkbox" name="travel" value="" checked="checked" id="travel">
		<label for="work">Work</label><input type="checkbox" name="work" value="" checked="checked" id="work">
		

		<input type="submit" value="Continue &rarr;">
	</form>
<div id="timeline_container"><div><div>
<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
include 'getin.php';
$getitems = mysql_query("SELECT chronology.id, chronology.start_date, chronology.end_date, chronology.title, chronology.exhibit, chronology.caption, chronology.milieu AS chronmil, milieus.milieu FROM chronology LEFT JOIN milieus ON chronology.milieu = milieus.milieu_id ORDER BY start_date ASC, milieu, title, caption");

$is_first = TRUE;
$last_start_year ='';
$last_start_date = '';
print "<div>";
while ($items = mysql_fetch_object($getitems)) {
$makeyear = explode ('-', $items->start_date);
$thisyear = $makeyear[0];
$thisdate = $items->start_date;

if ($last_start_year !=$thisyear){ //change year
print "</div></div>";
print "<div class=\"year year$thisyear\">";
print "<div class=\"yearmarker\">{$thisyear}";
	if ($last_start_date !=$thisdate){  //new day?
	$i = 1;
	print "</div><div class=\"day $thisdate\">";  //where does this close?
	print "<div class=\"square firstofyear $thisdate milieu{$items->chronmil}\"><a href=\"#{$items->id}\"><img src=\"images/spacer.gif\"
 width=\"12\" height=\"12\" border=\"0\"></a><div class=\"preview\" style=\"display:none;\">{$items->start_date} {$items->milieu}: {$items->title}: {$items->caption}</div>";
	$last_start_date = $thisdate;
	$i++;
}
print "</div>";
$last_start_year = $thisyear;	
} else {
	if ($last_start_date !=$thisdate){
		$i = 1;
		print "</div><div class=\"day $thisdate\">";
print "<div class=\"square $thisdate newdaynotfirstofyear milieu{$items->chronmil}\"><a href=\"#id{$items->id}\"><img src=\"images/spacer.gif\" width=\"12\" height=\"12\" border=\"0\"></a><div class=\"preview\" style=\"display:none;\">{$items->start_date} {$items->milieu}: {$items->title}: {$items->caption}</div>";
$last_start_date = $thisdate;
$i++;
	} else {
	print "<div class=\"square $thisdate notnewdaynotfirstofyear milieu{$items->chronmil}\"><a href=\"#id{$items->id}\"><img src=\"images/spacer.gif\" width=\"12\" height=\"12\" border=\"0\"></a><div class=\"preview\" style=\"display:none;\">{$items->start_date} {$items->milieu}: {$items->title}: {$items->caption}</div>";
	$last_start_date = $thisdate;
	$i++;
}
print "</div>";
$last_start_year = $thisyear;	
}
}
?>
</div></div>
</div>
<div id="viewport"><div id="mainpart"><ul id="timeline">

<?php 
$last_start_year ='';
$last_start_date = '';
$getitems2 = mysql_query("SELECT chronology.id, chronology.start_date, chronology.end_date, chronology.title, chronology.exhibit, chronology.caption, chronology.milieu AS chronmil, milieus.milieu FROM chronology LEFT JOIN milieus ON chronology.milieu = milieus.milieu_id ORDER BY start_date ASC, milieu, title, caption");
print "<li>";
while ($items2 = mysql_fetch_object($getitems2)) {
	$thisdate = $items2->start_date;
		if ($last_start_date !=$thisdate){
		$i = 1;
		print "</li><li>";
print "<div id=\"id{$items2->id}\">{$items2->start_date}<br />{$items2->milieu}<br /><img src=\"chronology_exhibits/{$items2->exhibit}\" width=\"300\"><a href=\"chronology_exhibit.php?id={$items2->id}\">{$items2->title}</a><br />{$items2->caption}$last_start_date $thisdate</div>";
$last_start_date = $thisdate;
} else {
print "<div id=\"id{$items2->id}\">{$items2->start_date}<br />{$items2->milieu}<br /><img src=\"chronology_exhibits/{$items2->exhibit}\" width=\"300\"><a href=\"chronology_exhibit.php?id={$items2->id}\">{$items2->title}</a><br />{$items2->caption}$last_start_date $thisdate</div>";
$last_start_date = $thisdate;

}
}
?>
</ul></div></div>
</body>
</html>
