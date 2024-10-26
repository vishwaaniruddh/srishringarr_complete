<?php 
require("include/calvars.inc.php");

$curstamp = time();
$today = getdate();
$y2 = $today['year'];
$m2 = $today['mon'];
$d2 = $today['mday'];
$hour = $today['hours'];
$min = $today['minutes'];

$todaystring = $y2."-".$m2."-".$d2." ".$hour.":".$min;
$todaystamp = fixsdate( $todaystring );
list($y3,$m3,$d3) = explode("-",strftime("%Y-%m-%d",$todaystamp));
$lowday = mktime(0,0,0,$m3,$d3,$y3);
$highday = mktime(23,59,59,$m3,$d3,$y3);
//print "low = $lowday<BR>high = $highday<BR>";
//print "today = $todaystamp";
$offset = $HOFFSET." hours";
$curstamp = strtotime($offset,$curstamp);

$conn = mysql_connect($host,$user,$pwd);
mysql_select_db($db, $conn);
$sql = "SELECT * FROM ".$events_table." WHERE stimestamp < ".$curstamp." AND etimestamp > ".$curstamp." AND datestamp >= ".$lowday." AND datestamp <= ".$highday;
$rs = mysql_query($sql,$conn);
$numrows = mysql_affected_rows($conn);
//print "numrows = $numrows"
?>
<html>
<head>
       <title>Planner::Find Me</title>
<link rel="stylesheet" href="styles/calstyles.css" type="text/css">
</head>
<body class="rightnow">
<CENTER>
<?php 
if($numrows)
{
    $result = mysql_fetch_array($rs);
    $id = $result['id'];
    $datestamp = $result['datestamp'];
    $stimestamp = $result['stimestamp'];
    $etimestamp = $result['etimestamp'];
    $location = $result['resource'];
    $descr = $result['descr'];
    print "Right now my schedule says: &nbsp;<B>$location</B>&nbsp;&nbsp;<B>$descr</B><BR>";
}
else
{
$sql = "SELECT * FROM ".$events_table." WHERE datestamp >= ".$lowday." AND datestamp <= ".$highday." AND stimestamp > ".$curstamp." ORDER BY stimestamp";
$rs = mysql_query($sql,$conn);
$numrows = mysql_affected_rows($conn);
if($numrows == 0)
{
   $sql = "SELECT * FROM ".$events_table." WHERE datestamp > ".$highday." ORDER BY datestamp,stimestamp";
   $rs = mysql_query($sql,$conn);
   $numrows = mysql_affected_rows($conn);
}
  if($numrows)
  {
   $result = mysql_fetch_array($rs);
   $dstamp = $result['datestamp'];
   $date = strftime("%B %d",$dstamp);
   $stimestamp = $result['stimestamp'];
   $etimestamp = $result['etimestamp'];
   if($time_standard == 0) //ISO Standard 24 hour time
   {
       $stime = strftime("%H:%M",$stimestamp);
       $etime = strftime("%H:%M",$etimestamp);
   }
   else if($time_standard == 1) // 12 hour time
   {
       $stime = strftime("%I:%M",$stimestamp);
       $saorp = strftime("%p",$stimestamp);
       $saorp = strtolower($saorp);
       $stime = $stime.$saorp;
       $etime = strftime("%I:%M",$etimestamp);
       $eaorp = strftime("%p",$etimestamp);
       $eaorp = strtolower($eaorp);
       $etime = $etime.$eaorp;
   }
   $descr = $result['descr'];

   print "I have nothing scheduled at this time<BR><BR>";
   print "The next thing on my schedule is:<BR><B>$date<BR>$stime - $etime<BR>$descr</B>";
  }
  else
  {
      print "I have nothing scheduled at this time";
  }
}
?>
<BR><BR><A HREF="#" onClick="self.close()">close</A>
</CENTER>
</body>
</html>