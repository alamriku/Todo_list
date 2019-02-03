<?php
echo "actual format ".date("Y-m-d H:i:s");

echo "<br><br>";
echo "<br> The <strong>strtotime</strong> function returns the time in seconds since the Unix Epoch <br>";
echo "<br><br>";

$currentTime = strtotime(date("Y-m-d H:i:s"));

echo "this are string format present date and time ".$currentTime."<br><br>";

$dupur_12=strtotime(date(date('Y-m-d')."12:00:00"));

$bikal_5=strtotime(date(date('Y-m-d')."17:00:00"));

echo "this are string format Dupur 12ta ".$dupur_12."<br><br>";
echo "this are string format bika 5ta ".$bikal_5;


echo "<br><br>";
echo "<br><br>";
echo "123 converted to english number format";
echo "<br><br>";
$f = new NumberFormatter('en',NumberFormatter::SPELLOUT);
echo $f->format(123);
?>