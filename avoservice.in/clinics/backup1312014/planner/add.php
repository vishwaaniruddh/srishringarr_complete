<?php 
require("include/calvars.inc.php");
?>
<html>
<head>
<title>Planner::Add Event</title>
<link rel="stylesheet" href="styles/calstyles.css" type="text/css">
<SCRIPT SRC="include/functions.js"></SCRIPT>
</head>
<?php 
$conn=mysql_connect($host,$user,$pwd);
$db=mysql_select_db($db,$conn);

//if (isset($_POST['addrec'])) { $addrec = $_POST['addrec']; }
//if (isset($_POST['dstring'])) { $addrec = $_POST['addrec']; }
//if (isset($_POST['ststring'])) { $addrec = $_POST['addrec']; }
//if (isset($_POST['etstring'])) { $etstring = $_POST['addrec']; }

if(isset($_POST['addrec']) && $_POST['addrec'] == "Add Record")  // 'Add Record' BUTTON CLICKED
{
?>
<body class="popdetail">
<?php 
  //$dstring = $dstring." ".$TZONE;
  $datestamp = strtotime($_POST['dstring']);
  if($time_standard == 0) //24 hour time
  {
     $stimestamp = strtotime($_POST['ststring']);
     $etimestamp = strtotime($_POST['etstring']);
 }
  else if($time_standard == 1) //12 hour time
  {
      $_POST['ststring'] = $_POST['ststring'].$_POST['saorp'];
      $stimestamp = strtotime($_POST['ststring']);
      $etstring = $_POST['etstring'].$_POST['eaorp'];
      $etimestamp = strtotime($_POST['etstring']);
  }
  if(!isset($_POST['resource']) || $_POST['resource'] == "")
     $_POST['resource'] = "";
  $sql="INSERT INTO ".$events_table." VALUES ('',".$datestamp.",".$stimestamp.",".$etimestamp.",'".$_POST['resource']."','".$_POST['desc']."')";
  mysql_query($sql,$conn) or die("couldn't add<BR>");

  if($_POST['recur'] != "none")
  {
      $i=1;
      while($i < $_POST['numrecur'])
      {
          if($_POST['recur'] == "daily")
             $nextdstamp = future_date($datestamp,"d",1);
          else if($_POST['recur'] == "weekly")
             $nextdstamp = future_date($datestamp,"w",1);
          else if($_POST['recur'] == "monthly")
             $nextdstamp = future_date($datestamp,"m",1);
          else if($_POST['recur'] == "yearly")
             $nextdstamp = future_date($datestamp,"y",1);
          $datestamp = $nextdstamp;
          $sql="INSERT INTO ".$events_table." VALUES ('',".$nextdstamp.",".$stimestamp.",".$etimestamp.",'".$_POST['resource']."','".$_POST['desc']."')";
          mysql_query($sql,$conn) or die("couldn't add<BR>");
          $i++;
      }
  }
  print "<CENTER><BR>Event has been added to the schedule<BR><BR>";
  print "<a href=\"index.php\" target=\"mymain\" onClick=\"self.close()\">click here to refresh calendar</a></CENTER>";

  mysql_close($conn);
}
else  // HAVE NOT CLICKED 'Add Record' YET
{
if (isset($_POST['Res']) && $_POST['Res']=="Add Location")
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
?>
<body class="popdetail" onLoad="document.AddEvnt.dstring.focus()">
<em><b>Add a New Scheduled Item</b></em>
<form action="add.php" method="POST" name="AddEvnt">
<?php 
if($date_standard == 0) // ISO Standard yyyy-mm-dd
{
?>
Scheduled Date: <input type="text" size="10" name="dstring" <?php if(isset($_GET['pasdstring'])){?>value="<?php $_GET['pasdstring']?>"<?php }?>> (yyyy-mm-dd)
<?php 
} // end ISO Standard
else if($date_standard == 1) // American style mm/dd/yyyy
{
?>
Scheduled Date: <input type="text" size="10" name="dstring" <?php if(isset($_GET['pasdstring'])){?>value="<?php $_GET['pasdstring']?>"<?php }?>> (mm/dd/yyyy)
<?php 
} // end American style
if($time_standard == 0) //24 hour time
{
?>
<p>
Start Time: <input type="text" size="5" name="ststring"> (Use hh:mm format)
</p>
<p>
End Time: <input type="text" size="5" name="etstring"> (Use hh:mm format)
</p>
<?php 
} //end 24 hour time
else if($time_standard == 1)  //12 hour time
{
?>
<p>
Start Time: <input type="text" size="5" name="ststring">
<input type="radio" name="saorp" value="am">AM
<input type="radio" name="saorp" value="pm">PM (Use hh:mm format)
</p>
<p>
End Time: <input type="text" size="5" name="etstring">
<input type="radio" name="eaorp" value="am">AM
<input type="radio" name="eaorp" value="pm">PM (Use hh:mm format)
</p>
<?php 
} //end 12 hour time
?>
<p>Location: <select name="resource" size="1"></p>
<?php 
// Populate drop-down box with resources (locations)
if (mysql_num_rows($result)>0)
{
   while($rs=mysql_fetch_array($result))
   {
?>
    <OPTION><?php  echo $rs["resource"]; ?></OPTION>
<?php  }
}
//mysql_free_result($result);
//mysql_close($conn);
?>
    </select></p>
<p>Description: <input type="text" size=50 maxlength=50 name="desc"></p>
<DIV id="recurdiv">
Recurrence:&nbsp;
<SELECT name="recur" onChange="rbox_handler()">
  <OPTION value="none">none</OPTION>
  <OPTION value="daily">daily</OPTION>
  <OPTION value="weekly">weekly</OPTION>
  <OPTION value = "monthly">monthly</OPTION>
  <OPTION value="yearly">yearly</OPTION>
</SELECT>&nbsp;&nbsp;one time only
</DIV>
<BR>
<input type="submit" name="addrec" value="Add Record">
<input type="reset" name="clear" value="Clear">
</form>
<form action="add.php" method="POST" name="AddRes">
<input type="text" size=20 maxlength=50 name="ResDesc">
<input type="submit" name="Res" value="Add Location">
<BR>
<?php if(isset($_POST['Res']) && $_POST['Res'] == "Add Location")
  print "<FONT COLOR=red><I>".$_POST['ResDesc']." was added</I></FONT><BR>";
  ?>
<select name="resource2" size="1">
<?php 
mysql_data_seek($result,0);
while($rs = mysql_fetch_array($result))
{
?>
    <OPTION><?php $rs['resource']?></OPTION>
<?php 
}
?>
</SELECT>
&nbsp;<INPUT type="submit" name="delLoc" value="Delete Location">
<?php if(isset($_POST['delLoc']) && $_POST['delLoc'] == "Delete Location")
   print "<BR><FONT COLOR=red><I>".$_POST['resource2']." was deleted</I></FONT>";
?>
</form>
</p>
</body>
</html>
<?php 
} //end top else
?>