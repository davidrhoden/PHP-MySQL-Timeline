<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<link href="css/chronology.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
include 'getin.php';
$result = mysql_query("SELECT id, start_date, title, caption, milieu FROM chronology ORDER BY start_date DESC, title, caption");
$last_start_date = '';
$is_first = TRUE;
$output = '';

function render($record) {
  $output .= "<a href='chronology_exhibit.php?id={$record->id}'>{$record->title}</a>\n";
  $output .= "{$record->caption}\n";
  $output .= "{$record->milieu}\n";
  return $output;
}

while ($record = mysql_fetch_object($result)) {
  if ($last_start_date != $record->start_date) {
    if (!$is_first) {
      print "</div>\n";
    }
    $is_first = FALSE;
    print "<div class=\"year\">\n";
    print "{$last_start_date}\n";
    print  $output;
    $output = '';
    $last_start_date = $record->start_date;
  }
  $output .= render($record);
}
print "</div>\n";
print "<div class=\"year\">\n";
print "{$last_start_date}\n";
print $output;
print "</div>\n";
?>
</body>
</html>