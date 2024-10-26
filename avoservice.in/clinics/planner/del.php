<?
require("include/calvars.inc.php");
$conn=mysql_connect($host,$user,$pwd);
mysql_select_db($db,$conn);

if(isset($_GET['id']))
{
 $sql="DELETE FROM ".$events_table." WHERE id='".$_GET['id']."'";
 $result=mysql_query($sql,$conn);
}
else
 $result = FALSE;
?>
<HTML>
<HEAD><TITLE>Planner::Delete Event</TITLE>
<BASE TARGET="mymain">
<link rel="stylesheet" href="styles/calstyles.css" TYPE="text/css">
</HEAD>
<BODY class="popdetail">
<CENTER>
<BR><BR>
<?if($result!=FALSE){?>
Event has been deleted<BR><BR><A HREF="index.php?timestamp=<?=$_GET['daystamp']?>&noinc=0" onClick="self.close()">click here to refresh calendar</A>
<?}
else
    print "Delete FAILED";
?>
</BODY>
</HTML>