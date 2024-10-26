<?php include("access.php");
include("config.php");


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


function HandleResponse3(response)

{
//alert(response);
  document.getElementById('res').innerHTML = response;
}
</script>
</head>

<body>
<center>

<? $snapid=$_GET['id'];
$atmid=$_GET['atmid'];


$snapqry=mysqli_query($con1,"Select * from snap_inst where snap_id='".$snapid."' ");
$srow=mysqli_fetch_row($snapqry);

$alertqry=mysqli_query($con1,"Select * from alert where alert_id='".$srow[1]."'");
$row=mysqli_fetch_row($alertqry);

$url="www.avoservice.in/";
if($srow[2] !='') {$link.="Full Product: ".$url.$srow[2]."<br>";}
if($srow[3] !='') {$link.="Front Panel: ".$url.$srow[3]."<br>";}
if($srow[4] !='') {$link.="Buyback: ".$url.$srow[4]."<br>";}
if($srow[5] !='') {$link.="Input Voltage: ".$url.$srow[5]."<br>";}
if($srow[6] !='') {$link.="Output Voltage: ".$url.$srow[6]."<br>";}
if($srow[7] !='') {$link.="Earth Voltage: ".$url.$srow[7];}

//echo $link;
// include("menubar.php"); ?>

<h2>Send Mail</h2>
<div id="header">

<form action="process_emailsnap.php" method="post" name="form">
<table>
<tr>
<td width="126" height="35"> Customer : </td>
<td width="221">
<?php
$qry2=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
$qry2row=mysqli_fetch_row($qry2);
echo $qry2row[0];
?>
</td>
</tr>
<!--<input type="hidden" name="site_id1" id="site_id1" value="<? echo $atmid; ?>" ></td>-->
<tr>
<td height="35">Site/Sol/ATM ID : </td>
<td><input type="text" name="site_id" id="site_id" value="<? echo $atmid; ?>" readonly="readonly"> </td>
</tr>

<tr>
<td height="35"> End User : </td>
<td><?php echo $row[3]; ?></td>
</tr>
<tr>
<td height="35">Address : </td>
<td><?php echo $row[5]; ?></td>
</tr>
<tr>
<td height="35">Emails To send: Comma(,) separated email Ids </td>
<td><textarea rows="4" cols="28" name="add" id="add" ></textarea></td>
</tr>

<tr>
<td height="35">Snap Links</td>

<td><textarea rows="4" cols="28" name="link" id="link" readonly="readonly"><?php echo $link; ?> </textarea></td>
</tr>

<tr>
<td height="35" colspan="2" align="center">
<input type="submit" value="Send" class="readbutton" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>