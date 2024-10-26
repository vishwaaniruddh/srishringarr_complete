<?php

include("access.php");
include("config.php");
//include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$id=$_GET['id'];
$br=$_GET['br'];
$ctype=$_GET['ctype'];


/*require_once('config.php');
$sq=mysqli_query($con1,"select cust_id from alert where alert_id='$id'");
$ro=mysqli_fetch_row($sq);

$sq1=mysqli_query($con1,"select * from cust where id='$ro[0]'");
$ro1=mysqli_fetch_row($sq1);
*/

/*include_once('class_files/filter.php');
	$ob=new filter();
	$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("cust_id"),'alert',array("alert_id"),array($id),'','');
	$ro=mysqli_fetch_row($tab);
	//echo $ro[0];
	$tab1=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),'customer',array("cust_id"),array($ro[0]),'','');
	$ro1=mysqli_fetch_row($tab1);*/
date_default_timezone_set('Asia/Kolkata');

$qr=mysqli_query($con1,"select caller_email,call_status from alertlocal where alert_id='".$id."'");
$ro1=mysqli_fetch_row($qr);



// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script>
    window.onunload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
</script>

<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>
<script>

function mail_value(){
	
if(document.getElementById('mail').checked==false){
	//alert("hi");
	document.getElementById('email').value="";
}
else
document.getElementById('email').value=document.getElementById('ml').value;
}

function responsetime(){
	
if(document.getElementById('response').checked==false){
	//alert("hi");
	document.getElementById('rtime').value="";
}
else
document.getElementById('rtime').value=document.getElementById('dt').value;
}
</script>

<script>
function validate(form){
 with(form)
 {
   if(up.value=="")/*Name validation*/
   {
	alert("Please Enter Some Update");
	up.focus();
	return false;
    }
   
 }
   if(confirm('Are you sure you want to Enter this Update.')) 
   {
    return true;
   }
   else 
   {
    return false;
}
 return true;
 }


</script>
<style>
h2{color:#F00;}

</style>


<!--<h2 align="center">Updates <a href="#" onclick="closepopup('<?php echo $id; ?>');"><span class="close_button">X</span></a></h2>-->

<body bgcolor="#009999">
<table border="1" width="50%">
<thead>
<tr><th colspan="3" align="center"> <h2 style="text-align:center">Previous Update</h2> </th> </tr>
<tr>
<th>Update</th>
<th>Date / Time</th>
<th>Updating Person</th>
</tr>
</thead>

<tbody>

<?php

//include_once('config.php');
//$sql=mysqli_query($con1,"select * from alert_updates where alert_id='$id'");

//include_once('class_files/filter.php');
	//$ob=new filter();
	//$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),'alert_updates',array("alert_id"),array($id),'','');
	//echo "<br><brselect * from alert_updates where alert_id='".$id."' order by id DESC";
	//echo "select f.feedback,f.engineer,f.feed_date,l.designation from eng_feedbacklocal f,login l where f.alert_id='".$id."' and f.engineer=l.srno order by f.feed_date DESC";
	$tab=mysqli_query($con1,"select f.feedback,f.engineer,f.feed_date,l.designation from eng_feedbacklocal f,login l where f.alert_id='".$id."' and f.engineer=l.srno order by f.feed_date DESC");
 while ($row=mysqli_fetch_row($tab)) {
 	$upby="Masteradmin";
	 $str="";
	 if($row[3]=='4')
	 $str="select engg_name from area_engg where loginid='".$row[1]."'";
	 elseif($row[3]=='3')
	 $str="select head_name from branch_head where loginid='".$row[1]."'";
	 if($str!="")
	 {
	 $up=mysqli_query($con1,$str);
	 $upro=mysqli_fetch_array($up);
	 $upby=$upro[0];
	 }
	// $qry=mysqli_query($con1,"select * from state where state_id='".$row[4]."'");
	 //$rw=mysqli_fetch_row($qry);
	
	  ?>
    

<tr>
<td><?php echo $row[0]; ?></td>
<td><?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($row[2])); ?></td>
<td><?php echo $upby; ?></td>
</tr>
<?php } ?>



<tr><td colspan="3" align="center"><h2>New Update</h2></td></tr>
<tr><td colspan="3" align="center"> 
<form action="process_update1local.php" method="post" name="form" onsubmit="return validate(this) ">
<input type="hidden" name="ml" id="ml" value="<?php echo $ro1[0];  ?>" />
<table width="363">
<tr>
<td width="184" height="35">Update : </td>
<td width="167">
<textarea name="up" id="up" rows="4" cols="25"></textarea>
</td>
</tr>

<tr>
<td width="184" height="35">Please Untick if you dont want to send update to client : </td>
<td width="167">
<input type="checkbox" name="mail" id="mail" value="mail" checked="checked" onclick="mail_value();"/><input type="text" name="email" id="email" value="<?php echo $ro1[0];  ?>" readonly="readonly"/>
</td>
</tr>
<tr>
<td width="184" height="35">Make this as response time : </td>
<td width="167">
<input type="checkbox" name="respose" id="response" value="rtime" onclick="responsetime();"/><input type="text" value="" name="rtime" id="rtime" readonly="readonly"/>
</td>
</tr>
<tr><td>ETA</td><td><input type="text" name="est" id="est" value="<?php date('d/m/Y'); ?>" readonly="readonly" onclick="displayDatePicker('est');">
&nbsp;&nbsp;
<select name="time" id="time"><option value="">Select time</option>
<?php
for($i=1;$i<=12;$i++)
{
?>
<option value="<?php echo $i.":00:00"; ?>"><?php echo $i; ?></option>
<?php
}
?>

</select>

<select name="meri" id="meri"><option value="">Select</option>
<option value="am">am</option><option value="pm">pm</option>
</select></td></tr>
<tr><td width="184" height="35" colspan="2" align="center">Call Closure : </td></tr>
<?php
$statusme=0;
$actstat='';
//echo $statusme." ".$ro1[1]."<br>";
$qryin=mysqli_query($con1,"Select * from tempclosedcalllocal where alert_id='".$id."' and status=0");
	if(mysqli_num_rows($qryin)>0)
	{
	$statusme=1;
	$actstat="temp";
	}
	elseif($statusme=='0' && $ro1[1]=='Done')
	{
	$actstat="close";
	}
	elseif($ro1[1]=='2')
	{
	$actstat="wait";
	}
	elseif($ro1[1]=='Pending' || $ro1[1]=='1')
	{
	$actstat="pending";
	}
//echo $actstat;
?>
<tr>
<td width="167" >Pending</td>

<td><input type="radio" name="callclose" value="pending" <?php if($actstat=='pending'){echo "checked='checked'";} ?>
/></td>
</tr>
<tr>
<td width="167" >Temporary Close</td>

<td><input type="radio" name="callclose" value="temp" <?php if($actstat=='temp'){echo "checked='checked'";} ?>
/></td>
</tr>

<tr>
<td width="167" >Standby Close</td>
<td><input type="radio" name="callclose" value="wait"   <?php if($actstat=='wait'){echo "checked='checked'";} ?> /></td>
</tr>

<tr>
<td width="167" >Permanent Close</td>
<td><input type="radio" name="callclose" value="close"   <?php if($actstat=='close'){echo "checked='checked'";} ?> /></td>
</tr>

<tr>
<td colspan="2" align="center">

<table width="394">
<tr><td colspan="2" align="center"><h3>Select Types of Problem Occurred</h3></td></tr>
<?php
//echo $ctype;
if($ctype=='new')
{
	$ctype='new';
}
elseif($ctype=='new temp' || $ctype=='service')
{
	$ctype='service';
}
//echo "Select * from problemtype where type='".$ctype."'  order by problem ASC";
$prob=mysqli_query($con1,"Select * from problemtype where type='".$ctype."'  order by problem ASC");
if(!$prob)
echo mysqli_error();
while($probro=mysqli_fetch_array($prob))
{

?>
<tr><td align="right"><input type="checkbox" name="prob[]" id="prob[]" value="<?php  echo $probro[0]; ?>" /></td><td align="left"><?php  echo $probro[1]; ?></td></tr>

<?php
}


?>


</table>

</td>
</tr>
<?php
//echo "Select * from installed_sitesme where alert_id='".$id."'";
$qrychkin=mysqli_query($con1,"Select * from installed_sitesmelocal where alert_id='".$id."'");
if($ctype=='new' && mysqli_num_rows($qrychkin)>0)
{

?>
<tr>
<td width="184" height="35">Edit Expiry Details:</td>
<td>
<?php
$i=0;
$qrydt=mysqli_query($con1,"Select assets,startdt,id from installed_sitesmelocal where alert_id='".$id."'");
while($resdt=mysqli_fetch_row($qrydt))
{

echo $resdt[0]."</br>";
?>
<input type="hidden" name="astname[]" value="<?php echo $resdt[0]; ?>" />
<input type="hidden" name="astid[]" value="<?php echo $resdt[2]; ?>" />
<input type="text" name="etadt[<?php echo $i; ?>]" id="etadt<?php echo $i; ?>"  value="<?php  echo date('d/m/Y',strtotime($resdt[1]));?>" onclick="displayDatePicker('etadt[<?php echo $i; ?>]');"  /></br>

<?php
$i++;
}?> 
</td>
</tr>
<?php
}

?>


<tr>
<td height="35"><input type="submit" value="submit" class="readbutton"/></td>
<td><input type="button" value="cancel" class="readbutton" onclick="self.close()"/></td>

<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="br" value="<?php echo $br; ?>" />
<input type="hidden" name="ctype" value="<?php echo $ctype; ?>" />
<input type="hidden" name="dt" value="<?php echo date("Y-m-d H:i:s"); ?>" id="dt" />
</tr>
</table>
</form>

</td>
</tr>
</tbody>
</table>

</body>