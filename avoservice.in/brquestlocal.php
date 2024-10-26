<?php
include("config.php");
 $alertid=$_POST['aid'];
 $type=$_POST['calltype'];
$qry=mysqli_query($con1,"select * from query where questtype='".$type."'");
$num=mysqli_num_rows($qry);
if($num>0)
{
?>
<form name="frm" method="post" action="processquerylocal.php">
<br>
<table>

<?php
$cnt=0;
while($row=mysqli_fetch_row($qry))
{
$cnt=$cnt+1;
?>
<tr><td><input type="hidden" name="questid[]" value="<?php echo $row[0]; ?>" /><?php echo $row[2]; ?></td><td><textarea name="txtquest[]"></textarea></td></tr>
<?php
}
?>
<tr><td colspan="2" valign="top">Comment(will be viewed by Others) :<textarea name="cmnt" id="cmnt" rows="7" cols="35"></textarea></td></tr>
<tr><td colspan="2" align="center"><input type="radio" name="status" value="accept" checked> Call Accepted&nbsp;&nbsp;&nbsp;
<input type="radio" name="status" value="reject" > Call Rejected&nbsp;&nbsp;&nbsp;
<input type="radio" name="status" value="hold" > Call On Hold&nbsp;&nbsp;&nbsp;
</td></tr>
<tr><td colspan="2" align="center">
<input type="hidden" name="cnt" id="cnt" value="<?php echo $cnt; ?>">
<input type="hidden" name="alertid" id="alertid" value="<?php echo $alertid; ?>">
<input type="hidden" name="type" id="type" value="<?php echo $type; ?>">
<input type="submit" name="cmdsub" value="Submit">&nbsp;&nbsp;&nbsp;<input type="reset" name="cmdreset" value="Reset"></td></tr>
</table>
</form>
<?php
}
else
echo "Please Select Call Type";
?>