<?php
include("access.php");
if(!isset($_GET['hid']) && !isset($_GET['id']))
header('location:view_cityhead.php');
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
$hid=$_GET['hid'];
$id=$_GET['id'];
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<title>Assign more branch</title>
</head>
<script type="text/javascript">
//////atm id data
function atmid()
{ //alert("h");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
  ////alert(s);
  document.getElementById('br_no').value=s;
  if(s==3){
  
  document.getElementById('detail').style.display='none';
  document.getElementById('msg').style.display='block';
 //// alert("done");
  }else{
  document.getElementById('detail').style.display='block';
  document.getElementById('msg').style.display='none';
  }
	 ///document.getElementById('asset_div').innerHTML = s;	
    }
  }
   var city=document.getElementById('city').value;
   
  
 //////alert("get_data.php?cust="+cust+"&po="+po+"&ref="+ref);
  
xmlhttp.open("GET","get_branch.php?city="+city,true);

xmlhttp.send();
}


//////////////////////////////site type function

function validate1(){
var a=document.getElementById("form1");
//alert(a);
 with(a)
 {

 var numbers = /^[0-9]+$/;
var namePattern = /^[A-Za-z()_ ]/;
if(state.value==0)
{
	alert("Please Select State");
	state.focus();
	return;
}
if(bradd.value=='')
{
	alert("Please Enter Branch Address");
	bradd.focus();
	return;
}
if(brcity.value=='')
{
	alert("Please Enter City");
	brcity.focus();
	return;
}
if(brpin.value=='')
{
	alert("Please Enter Pincode");
	brpin.focus();
	return;
}
//alert(hname.length);
//var i=document.getElementById('hname').length;
//alert(hname[0]);

a.submit();

 
 }
 }
 

</script>
<body>
<center>
<?php include("menubar.php");

 ?>

<h2> New Branch</h2>
<div id="header">
<form action="processaddbranch.php" method="post" name="form"  id="form1">
<table>
<tr>
<td width="108" height="35">Select State : </td>
<td width="181" colspan=2>
<select name="state" id="city" onChange="atmid();">
<?php
include("config.php");
$log=mysqli_query($con1,"select branch from login where srno='".$hid."'");
$logro=mysqli_fetch_row($log);
//echo $logro[0];
$br1=str_replace(",","','",$logro[0]);
$br1="'".$br1."'";

//echo "select state_id,state from state where state_id NOT IN ($br1)";	
$state=mysqli_query($con1,"select state_id,state from state where state_id NOT IN ($br1)");
?>
<option value="0">select</option>
<?php while($row=mysqli_fetch_row($state)){ ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>
<tr>
<td width="108" height="35">Branch Address : </td>
<td width="181" colspan=2>
<textarea name="bradd"></textarea>
</td>
</tr>
<tr>
<td width="108" height="35">City : </td>
<td width="181" colspan=2>
<input type="text" name="brcity">
</td>
</tr>
<tr>
<td width="108" height="35">Pincode : </td>
<td width="181" colspan=2>
<input type="text" name="brpin">
</td>
</tr>
<tr>
<?php
//include("config.php");

$qry=mysqli_query($con1,"select * from branch_head where head_id='".$id."'");
$qryrow=mysqli_fetch_row($qry);
?>
<td colspan="3">
<fieldset><legend>Branch Head Details</legend>
<table id="detail" width="100%" >
<tr>
<td height="35">Head Name :<br><input type="text" name="hname[]" id="hname1" value="<?php echo $qryrow[2]; ?>" readonly="readonly" /> </td><td>&nbsp; </td>
<td height="35">Contact :<br><input type="text" name="cont[]" id="cont1" value="<?php echo $qryrow[4]; ?>" readonly="readonly" /> </td><td>&nbsp; </td>
<td height="35">Email :<br><input type="text" name="email[]" id="email1" value="<?php echo $qryrow[3]; ?>" readonly="readonly" /> </td>

</tr>
<input type="hidden" name="logid" id="logid" value="<?php echo $hid; ?>" />
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
</table>
</fieldset>
</td></tr>
<tr>
<td height="35" colspan=3><input type="button" value="submit" class="readbutton" onclick="validate1()"/></td>
</tr>
</table>
<div id="msg" style="display:none;">No More Coordinator's Can be added on this branch </div>
</form>
</div>
</center>
</body>
</html>