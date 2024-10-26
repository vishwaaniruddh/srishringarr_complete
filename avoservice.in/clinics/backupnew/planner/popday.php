<?php
require("include/calvars.inc.php");
$conn2=mysql_pconnect($host,$user,$pwd);
mysql_select_db($db,$conn2);

if(isset($_GET['dodel']) && isset($_GET['delid']) && ($_GET['dodel'] == 1))
{
 $sql="DELETE FROM ".$events_table." WHERE id='".$_GET['delid']."'";
 $delresult=mysql_query($sql,$conn2);
}
else
 $delresult = FALSE;
?>
<html>
<HEAD><TITLE>Planner::Day Schedule</TITLE>
<link rel="stylesheet" href="styles/calstyles.css" type="text/css">
<SCRIPT SRC="include/functions.js"></SCRIPT>
<BODY class="popday" onUnload="window.opener.location='index.php?timestamp=<?=$_GET['daystamp']?>&noinc=0'">
<CENTER>
<TABLE border=0 width="100%" cellspacing="0" cellpadding="5" class="popday">
  <TR bgcolor="#CCCCCC">
    <TD width=65><B>Start</B></TD>
    <TD width=65><B>End</B></TD>
    <TD><B>Description</B></TD>
    <TD><B>Location</B></TD>
    <TD width=75>&nbsp;</TD>
  </TR>
<?php
$sql2="SELECT * FROM appoint WHERE `app_date` = '".$_GET['daystamp']."'";
$sql2=$sql2." ORDER BY `stimestamp`";
$result2=mysql_query($sql2,$conn2);

if (mysql_num_rows($result2)>0)
{
    while($rs2=mysql_fetch_array($result2))
    {
     $datestamp = $rs2['datestamp'];
     if($date_standard == 0)
        $date = strftime("%Y-%m-%d",$datestamp);
     else if($date_standard == 1)
        $date = strftime("%m/%d/%Y",$datestamp);
     $thisid = $rs2['id'];
     $stimestamp = $rs2['stimestamp'];
     $etimestamp = $rs2['etimestamp'];
     $loc = $rs2['resource'];
     $desc = $rs2['descr'];
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
?>
  <TR>
    <TD><?=$stime?></TD>
    <TD><?=$etime?></TD>
    <TD><?=$desc?></TD>
    <TD><?=$loc?></TD>
    <TD width="20%" align=center>
    <?if($_SESSION['ADMIN']){?>
    <A HREF="#" class="popday" onClick="window.open('mod.php?id=<?=$thisid?>&daystamp=<?=$_GET['daystamp']?>','newwin1','height=400,width=450,top=120,left=150,scrollbars=auto'); self.close()">modify</A>
    |&nbsp;<A HREF="popday.php?daystamp=<?=$_GET['daystamp']?>&dodel=1&delid=<?=$thisid?>&date=<?=$date?>" class="popday">delete</A>
    <?}?>
    </TD>
  </TR>
  <?
    } // end while
}// end if(mysql_num_rows($result2)>0)
?>
</TABLE>
<BR><BR>
<?if($_SESSION['ADMIN']){?>
|&nbsp;<A HREF="#" class="popday" onClick="popup('add.php?pasdstring=<?=$date?>', 'Win2', 450, 500); self.close()">Add new</A>&nbsp;|
<?}?>
</CENTER>

</body>
</html>