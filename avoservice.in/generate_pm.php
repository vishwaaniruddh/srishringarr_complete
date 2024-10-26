<?php
include("access.php");
include('config.php');
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$site_id=$_GET['id'];
$stype=$_GET['type'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Temporary Site</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>

function validate1(form1){
 with(form1)
 {
//=================Branch
if(branch_avo.value=="")
{
	alert("Please Enter Branch.");
	branch_avo.focus();
	return false;
}
 var numbers = /^[0-9]+$/;
var namePattern = /^[A-Za-z()_ ]/;

if(bank.value==0)
{
	alert("Please Enter Bank Name.");
	bank.focus();
	return false;
}

	}
 return true;
 }
 
  
function getXMLHttp()
{   var xmlHttp
  try
  {
    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
   catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
}

function addThem()
{
var a = document.form.asset;
var add = a.value+',';
document.form.asset_box.value += add;
return true;
}


function fill()
{
//alert("hii");
//alert(document.getElementById('cc').value);
document.getElementById('ccemail').innerHTML='';
document.getElementById('ccemail').innerHTML=document.getElementById('cc').value;
}


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

</script>


</head>

<body>
<center>
<?php //include("menubar.php"); 

if($stype=='warr')
$siteqry="select atm_id, cust_id, bank_name,area,pincode,city,address, branch_id, state1 from atm where track_id='".$site_id."'";
else 
$siteqry="select atmid,cid,bankname,area,pincode,city,address,branch,state from Amc where amcid='".$site_id."'";

//echo $siteqry;

$siteqr=mysqli_query($con1,$siteqry);
$srow=mysqli_fetch_row($siteqr);

$custqry=mysqli_query($con1,"select cust_id, cust_name from customer where cust_id='".$srow[1]."'");
$curow=mysqli_fetch_row($custqry);

?>

<h2>Generate PM call</h2>

<form action="process_pmcall.php" method="post" name="form" onSubmit="return validate1(this)">

<br />
<table width="500">
<tr>
<td width="115" height="35">Subject : </td>
<td width="305">
<input type="text" name="sub" id="sub" />
</td>
</tr>

<tr><td width="155" height="35"> Vertical Customer : </td>

<td width="131"><?php echo $curow[1]; ?> </td>
</tr>

<tr>
<td width="115" height="35">Site Id : </td>
<td width="305"> <?php echo $srow[0]; ?> </td>
</tr>
<tr>
<td width="115" height="35">End User Name : </td>
<td width="305"> <?php echo $srow[2]; ?> </td>
</tr>
<tr>
<td width="115" height="35">Area : </td>
<td width="305"> <?php echo $srow[3]; ?> </td>
</tr>
<tr>
<td width="115" height="35">City : </td>
<td width="305"> <?php echo $srow[5]; ?> </td>
</tr>

<tr>
<td width="115" height="35">Pincode : </td>
<td width="305"> <?php echo $srow[4]; ?> </td>
</tr>

<!----============Branch============= -->
<tr>
<td width="115" height="35">Branch : </td>


<?php 
		$selbr="select name from avo_branch where id='".$srow[7]."'";
		$selbr2=mysqli_query($con1,$selbr);
		$branch=mysqli_fetch_row($selbr2);
		?>
        
<td width="305"> <?php echo $branch[0]; ?> </td>
</tr>

<tr>
<td width="115" height="35">State : </td>
<td width="305"><?php echo $srow[8]; ?> </td>

</tr>


<tr>
<td width="115" height="35">Address : </td>
<td width="305"> <?php echo $srow[6]; ?> </td>
</tr>

<tr>
<td width="115" height="35">Type of Site: </td>
<? if ($stype=='warr'){  ?>
<td width="305" style="color:yellow"> Warranty </td>
<? } else if($stype=='amc') { ?>
<td width="305" style="color:yellow"> AMC site </td>
<? } ?>

</tr>
<tr>
<td height="35"> Date : </td>
<td><input type="text" name="adate" id="adate" value="<?php echo date('d/m/Y h:i:s'); ?>" /></td>
</tr>

<tr>
<td height="35">Type Of Call : </td>
<td style="color:yellow"> PM Call</td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td><input type="text" name="cname" id="cname" maxlength="20"  /></td>
</tr>

<tr>
<td height="35">Contact No.: </td>
<td><input type="text" name="cphone" id="cphone"  onkeypress="return isNumber(event)" maxlength="10"  /></td>
</tr>

<tr>
<td height="35">Email : </td>
<td><input type="text" name="cemail" id="cemail"/></td>
</tr>
<tr>
<td height="35">CC Email : </td>
<td>
<?php
$cc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 order by c.cust_name,e.bank ASC");
?>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while($ccro=mysqli_fetch_array($cc))
{
?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select>
<textarea name="ccemail" id="ccemail"  rows=5 cols=25></textarea></td>
</tr>

<tr>
<input type="hidden" name="site_id" id="site_id" value = "<?php echo $site_id; ?>" /> 
<input type="hidden" name="stype" id="stype" value = "<?php echo $stype; ?>" /> 

<td colspan="2" height="35"><input type="submit" name="cmdsubmit" value="submit" class="readbutton" /></td>
</tr>
</table>

</form>


</center>
</body>
</html>