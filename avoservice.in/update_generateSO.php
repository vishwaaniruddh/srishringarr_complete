<?php include("access.php");
include("config.php");
$getdata=$_GET['id'];
$typ=$_GET['typ'];
// echo $typ;
 //echo "hello : ".$getdata; die;

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add SO status</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>


function getXMLHttp()

{

  var xmlHttp

 //alert("hi1");

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


function DDL_reason(){

var ddlReson=document.getElementById('ddl_reson').value;
 
document.getElementById('reason').innerHTML=ddlReson;

}


</script>
</head>



<body>


<center>
 
<?php // include("menubar.php");

 ?>

<table border="1" width="70%">
<thead>
<tr><th colspan="3" align="center"> <h2 style="text-align:center">Previous Update</h2> </th> </tr>
<tr>
<th>Update</th>
<th>Date / Time</th>

</tr>
</thead>

<tbody>
<!--========PREVIOUS UPDATE DATA SHOW HERE ============================-->

<?php
   
	
	$qryfirst="SELECT Remarks_update , date FROM `SO_Update` WHERE so_id='".$getdata."' order by Remarks_update desc ";
	
	$tab=mysqli_query($con1,$qryfirst);
	   while( $rowup=mysqli_fetch_array($tab)){
	
 ?>
<tr>
<td><?php echo $rowup[0];?></td>
<td><?php if(isset($rowup[1]) and $rowup[1]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($rowup[1])); ?></td>

</tr>
<?php } ?>

<tr><td colspan="3" align="center"><h2>New Update</h2></td></tr>

<?php

?>
<div id="header">
<form action="Update_generateSO1.php" method="post" name="form">
<table>
    
    <input type="hidden" name="po_id" value="<?php echo $getdata;?>" />
<input type="hidden" name="typ" value="<?php echo $typ;?>" />
<tr>
<td height="35">Reason: </td>
<td>
<?php if($_GET['typ']==1){?>
<select id="ddl_reson" name="ddl_reson" onchange="DDL_reason()" required>
<option value="">Select Reason</option>
<option value="Stock Not Available">Stock Not Available</option>
<option value="Hold By Customer">Hold By Customer</option>
<option value="Site Not Ready">Site Not Ready</option>
<option value="SO Not Proper">SO Not Proper</option>

</select>
<?php }else{ ?>
<select id="ddl_reson" name="ddl_reson" onchange="DDL_reason()" required>
<option value="">Select Reason</option>
<option value="Dispatch Pending Customer Dependency">Dispatch Pending Customer Dependency</option>
<option value="Dispatch Pending  Remote Location">Dispatch Pending  Remote Location</option>
<option value="Dispatch Pending Site Not Ready">Dispatch Pending Site Not Ready</option>
<option value="Intransit">Intransit</option>
<option value="Delivered">Delivered</option>
</select>
<?php } ?>


<textarea rows="4" cols="28" id="reason" name="reason" value=""></textarea>
<tr>
<td height="35" colspan="2" align="center">

<input type="submit" value="submit" class="readbutton" />
</table>
 </div>
<form>
</center>
</body>
</html>