<?php include("access.php");
include("config.php");
$type=$_GET['type'];
$tpid=$_GET['id'];


if($type=='amc')
$sql="select cid,po,bankname,branch,atmid,city,pincode,address, amc_ex_date,area,state from Amc where amcid='".$tpid."'";

elseif($type=='new')
$sql="select cust_id,po,bank_name,branch_id,atm_id,city,pincode,address, expdt, area,state1 from atm where track_id='".$tpid."'";


$qry=mysqli_query($con1,$sql);
$qryrow=mysqli_fetch_row($qry);



 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>
function validate(form){
 with(form)
 {
var numbers = /^[0-9]+$/;  

if(atm.value=="")
{
alert("Please Enter ATM ID");
atm.focus();
return false;
}
if(state.value=="")
{
alert("Please Select Branch");
state.focus();
return false;
}

}
return true;
}


function getXMLHttp()

{   var xmlHttp

  try   {
    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }   catch(e)
  {
    //Internet Explorer
    try     {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }    catch(e)
    {
      try       {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }       catch(e)
      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
}


function MakeRequest()

{ var xmlHttp = getXMLHttp();
   xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
      HandleResponse3(xmlHttp.responseText);
    }
  }

var str=document.getElementById('state').value;
//alert(str);
  xmlHttp.open("GET", "get_city.php?state="+str, true);

  xmlHttp.send(null);
}

function HandleResponse3(response)

{
//alert(response);
  document.getElementById('res').innerHTML = response;
}
</script>
</head>

<body>
<center>
<?php // include("menubar.php"); ?>
<h2>Edit Site</h2>
<div id="header">
<form action="update_site.php" method="post" name="form">
<table>
<tr>
<td width="126" height="35"> Customer : </td>
<td width="221">
<?php
$qry2=mysqli_query($con1,"select cust_name from customer where cust_id='".$qryrow[0]."'");
$qry2row=mysqli_fetch_row($qry2);
echo $qry2row[0];
?>
</td>
</tr>
<tr>
<td width="126" height="35"> PO : </td>
<td width="221">
<?php
echo $qryrow[1];
?>
</td>
</tr>
<tr>
<td height="35">Site/Sol/ATM ID : </td>
<? if ($_SESSION['user']== 'masteradmin' || $_SESSION['designation']== 5) { ?>

<td><input type="text" name="atmid" value="<?php echo $qryrow[4]; ?>" /></td>
<? } else { ?> <td><input type="text" readonly="readonly" name="atmid" value="<?php echo $qryrow[4]; ?>" /></td>
<? } ?>
</tr>

<tr>
<td height="35"> End User : </td>
<td><input type="text" name="bank" value="<?php echo $qryrow[2]; ?>" /></td>
</tr>

<tr>
<td height="35"> Branch : </td>
<td>
<select name="state" id="state" onchange="MakeRequest()">
<option value=""> Select</option>
<?php
$brqry=mysqli_query($con1,"select  name, id  from avo_branch order by name ASC") ;

while($row=mysqli_fetch_row($brqry)) { 
?>

<option value="<?php echo $row[1]; ?>" <?php if($qryrow[3]==$row[1]){ echo "selected"; } ?> > <?php echo $row[0]; ?></option>
<?php } ?>

</select>
</td>
</tr>

<tr>
<td height="35">City : </td>
<td> <input type="text" id="city" name="city" value="<?php echo $qryrow[5];?>">
</tr>

<tr>
<td height="35">Landmark: </td>
<td> <input type="text" id="area" name="area" value="<?php echo $qryrow[9];?>">
</tr>

<tr>
<td height="35">Address : </td>
<td><textarea rows="4" cols="28" name="add" ><?php echo $qryrow[7]; ?></textarea></td>
</tr>

<tr>
<td height="35">State : </td>
<td> <input type="text" id="state_s" name="state_s" value="<?php echo $qryrow[10];?>">
</tr>

<tr>
<td height="35">Pincode : </td>
<td><input type="text" name="pin" id="pin" value="<?php echo $qryrow[6]; ?>"/></td>
</tr>

<?  if($type=='amc'){ ?>
<tr>
<td height="35">Expiry Date : </td>
<? 
if ($_SESSION['user']== 'masteradmin' || $_SESSION['user']== 'admin') {

?>

<td><input type="text" name="startdt" id="startdt" value="<?php echo date('d/m/Y',strtotime($qryrow[8])); ?>" onclick="displayDatePicker('startdt');" readonly="readonly" /></td>
<? } else {?>

<td><input type="text" name="startdt" id="startdt" value="<?php echo $qryrow[8]; ?>" readonly="readonly" /></td>

<? } ?>
</tr>
<? } ?>


<tr>
<td height="35" colspan="2" align="center">
<input type="hidden" name="id" value="<?php echo $tpid; ?>" /><input type="hidden" name="type" value="<?php echo $type; ?>" />
<input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>