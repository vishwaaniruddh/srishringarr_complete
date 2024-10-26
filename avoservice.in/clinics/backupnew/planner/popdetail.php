<?
require("include/calvars.inc.php");
?>
<html>
<HEAD><title>Planner::Event Detail</title>
<SCRIPT language="JavaScript">
function confirmdel( thisid, daystamp )
{
  if(confirm("Are you sure you want to delete this event?"))
  {
    var loc = "del.php?id="+thisid+"&daystamp="+daystamp;
    window.location = loc;
  }
}
</SCRIPT>
<link rel="stylesheet" type="text/css" href="styles/calstyles.css">
</HEAD>
<BODY class="popdetail">
<CENTER>
<TABLE border=0 widht=100% width="100%" cellspacing="0" cellpadding="5" class="popdetail">
  <TR bgcolor="#CCCCCC">
    <TD><b>Start</b></TD>
    <TD><b>End</b></TD>
    <TD><b>Description</b></TD>
    <TD><b>Location</b></TD>
  </TR>
  <TR>
    <TD><?=$_GET['stime']?></TD>
    <TD><?=$_GET['etime']?></TD>
    <TD><?=$_GET['desc']?></TD>
    <TD><?=$_GET['loc']?></TD>
  </TR>
</TABLE>
<BR><BR>
<?if($_SESSION['ADMIN']){?>
|&nbsp;<A HREF="#" class="popdetail" onClick="window.open('mod.php?id=<?=$_GET['id']?>&daystamp=<?=$_GET['daystamp']?>','newwin1','height=400,width=450,top=120,left=150,scrollbars=auto,resizable=yes'); self.close()">Modify</A>
&nbsp;|&nbsp;<A HREF="#" class="popdetail" onClick="confirmdel(<?=$_GET['id']?>,<?=$_GET['daystamp']?>);return false;">Delete</A>&nbsp;|
<?}?>
</CENTER>
</BODY>
</HTML>