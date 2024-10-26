<?
require("include/calvars.inc.php");
?>
<html>
<head>
       <title>Planner::Purge Old Events</title>
<link rel="stylesheet" href="styles/calstyles.css" type="text/css">
</head>
<body class="rightnow">
<B><EM>Purge Old Entries</EM></B>
<CENTER>
<?
if(!isset($_POST['bound']))
{
    $today = getdate();
    $y2 = $today['year'];
    $m2 = $today['mon'];
    $d2 = $today['mday'];

    if($date_standard == 0){
       $todaystring = $y2."-".$m2."-".$d2;
       $caption = "&nbsp;(yyyy-mm-dd)<BR>";
    }
    else if($date_standard == 1){
       $todaystring = $m2."/".$d2."/".$y2;
       $caption = "&nbsp;(mm/dd/yyyy)<BR>";
    }
?>
<FORM name="form1" ACTION="purgeold.php?daystamp=<?=$_GET['daystamp']?>" METHOD="POST">
Purge entries older than:
<INPUT TYPE="text" size="10" maxlength=10 name="bound" value=<?=$todaystring?>>
<?=$caption?>
<p><INPUT TYPE=submit value="Submit">
</FORM>
<?
}

else
{
    $boundstamp = strtotime($_POST['bound']);
    //purge_old($boundstamp);
    mysql_connect($host,$user,$pwd);
    mysql_select_db($db);
    $sql = "DELETE FROM ".$events_table." WHERE datestamp < ".$boundstamp;
    mysql_query($sql);
    print "<BR><a href=\"index.php?timestamp=".$_GET['daystamp']."&noinc=0\" target=\"mymain\" onClick=\"self.close()\">Done</a>";
}
?>
</CENTER>
</body>
</html>