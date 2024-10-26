<?
require("include/calvars.inc.php");
?>
<html>
<head>
<title>Planner::Modify Event</title>
<link rel="stylesheet" href="styles/calstyles.css" type="text/css">
<SCRIPT SRC="include/functions.js"></SCRIPT>
</head>
<body class="popdetail">
<?
$conn=mysql_connect($host,$user,$pwd);
$db=mysql_select_db($db,$conn);

if(isset($_POST['update']) && $_POST['update'] == "Update")  // 'Update' BUTTON CLICKED
{
  $datestamp = fixsdate( $_POST['dstring'] );
  $datestamp = strtotime( $_POST['dstring'] );
  if($time_standard == 0) //24 hour time
  {
     $stimestamp = strtotime($_POST['ststring']);
     $etimestamp = strtotime($_POST['etstring']);
 }
 else if($time_standard == 1) //12 hour time
  {
      $_POST['ststring'] = $_POST['ststring'].$_POST['saorp'];
      $stimestamp = strtotime($_POST['ststring']);
      $_POST['etstring'] = $_POST['etstring'].$_POST['eaorp'];
      $etimestamp = strtotime($_POST['etstring']);
  }

  $sql="UPDATE `".$events_table."` SET `datestamp`='".$datestamp."', `stimestamp`='".$stimestamp."', `etimestamp`='".$etimestamp."', `resource`='".$_POST['resource']."', `descr`='".$_POST['desc']."' WHERE `id`='".$_GET['id']."' LIMIT 1;";
  //print "sql = $sql<BR>";
  mysql_query($sql,$conn) or die("didn't add<BR>");
  print "<CENTER><BR>Event has been modified<BR><BR><a href=\"index.php?timestamp=".$_GET['daystamp']."&noinc=0\" target=\"mymain\" onClick=\"self.close()\")>click here to refresh calendar</a></CENTER>";
  mysql_close($conn);
}
else  // HAVE NOT CLICKED 'Update' YET
{
if (isset($_POST['Res']) && $_POST['Res']=="Add Resource")
{
  $sql="INSERT into ".$locations_table." VALUES ('".$_POST['ResDesc']."')";
  mysql_query($sql,$conn);
}
else if(isset($_POST['delLoc']) && $_POST['delLoc'] == "Delete Location")
{
  $sql = "DELETE FROM ".$locations_table." WHERE `resource`='".$_POST['resource2']."';";
  mysql_query($sql,$conn);
}

$sql="SELECT * FROM ".$locations_table." ORDER by Resource";
$result=mysql_query($sql,$conn);

$sql2 = "SELECT * FROM ".$events_table." WHERE id = ".$_GET['id'];
$result2 = mysql_query($sql2,$conn);
$rs2 = mysql_fetch_array($result2);
$datestamp = $rs2['datestamp'];
$stimestamp = $rs2['stimestamp'];
$etimestamp = $rs2['etimestamp'];
$loc = $rs2['resource'];
$desc = $rs2['descr'];
?>

<p><em><b>Modify Event</b></em></p>
<form action="mod.php?id=<?=$_GET['id']?>&daystamp=<?=$_GET['daystamp']?>" method="POST" name="AddEvnt">
<?
if($date_standard == 0) // ISO Standard yyyy-mm-dd
{
$ddata = strftime("%Y-%m-%d",$datestamp);
?>
<p>
Scheduled Date: <input type="text" size="10" name="dstring" value=<?=$ddata?>> (Use yyyy-mm-dd Format)
</p>
<?
} // end ISO Standard
else if($date_standard == 1) // American style mm/dd/yyyy
{
$ddata = strftime("%m/%d/%Y",$datestamp);
?>
<p>
Scheduled Date: <input type="text" size="10" name="dstring" value=<?=$ddata?>> (Use mm/dd/yyyy Format)
</p>
<?
} // end American style
if($time_standard == 0) //24 hour time
{
$stdata = strftime("%H:%M",$stimestamp);
$etdata = strftime("%H:%M",$etimestamp);
?>
<p>
Start Time: <input type="text" size="5" name="ststring" value=<?=$stdata?>> (Use hh:mm format)
</p>
<p>
End Time: <input type="text" size="5" name="etstring" value=<?=$etdata?>> (Use hh:mm format)
</p>
<?
} //end 24 hour time
else if($time_standard == 1)  //12 hour time
{
$stdata = strftime("%I:%M",$stimestamp);
$staorp = strftime("%p",$stimestamp);
$etdata = strftime("%I:%M",$etimestamp);
$etaorp = strftime("%p",$etimestamp);
?>
<p>
Start Time: <input type="text" size="5" name="ststring" value=<?=$stdata?>>
<input type="radio" name="saorp" value="am" <?if($staorp=="AM"){?>checked<?}?>>AM
<input type="radio" name="saorp" value="pm" <?if($staorp=="PM"){?>checked<?}?>>PM (Use hh:mm format)
</p>
<p>
End Time: <input type="text" size="5" name="etstring" value=<?=$etdata?>>
<input type="radio" name="eaorp" value="am" <?if($etaorp=="AM"){?>checked<?}?>>AM
<input type="radio" name="eaorp" value="pm"<?if($etaorp=="PM"){?>checked<?}?>>PM (Use hh:mm format)
</p>
<?
} //end 12 hour time
?>
<p>Location: <select name="resource" size="1">
<?
// Populate drop-down box with resources (locations)
if (mysql_num_rows($result)>0)
{
   while($rs=mysql_fetch_array($result))
   {
?>
    <OPTION <?if($loc == ($rs['resource'])){?>selected<?}?>><? echo $rs["resource"]; ?></OPTION>
<? }
}
//mysql_free_result($result);
//mysql_close($conn);
?>
    </select></p>
    <p>Description: <input type="text" size=50 maxlength=50 name="desc" value="<?=$desc?>"></p>
<table border="0" cellspacing="0" cellpadding="3">
<tr>
<td><input type="submit" name="update" value="Update"></td>
</tr>
</table>
</form>
<p>
<p>
<form action="mod.php?daystamp=<?=$_GET['daystamp']?>&id=<?=$_GET['id']?>" method="POST" name="AddRes">
<input type="text" size=20 maxlength=50 name="ResDesc">
<input type="submit" name="Res" value="Add Resource">
<?if(isset($_POST['Res']) && $_POST['Res'] == "Add Resource")
  print "<BR><FONT COLOR=red><I>".$_POST['ResDesc']." was added</I></FONT>";
  ?>
<p>
<select name="resource2" size="1">
<?
mysql_data_seek($result,0);
while($rs = mysql_fetch_array($result))
{
?>
    <OPTION><?=$rs['resource']?></OPTION>
<?
}
?>
</SELECT>
&nbsp;<INPUT type="submit" name="delLoc" value="Delete Location">
<?if(isset($_POST['delLoc']) && $_POST['delLoc'] == "Delete Location")
   print "<BR><FONT COLOR=red><I>".$_POST['resource2']." was deleted</I></FONT>";
?>
</form>
</p>

</body>
</html>
<?
} //end top else
?>