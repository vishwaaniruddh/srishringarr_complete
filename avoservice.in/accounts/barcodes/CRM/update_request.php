<?php
include("access.php");
//echo $_SESSION['user'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAR CRM</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript" charset="utf-8"></script>
<!---date--->
<script type='text/javascript' src='jquery-1.4.4.min.js'></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
<script type='text/javascript'>//<![CDATA[ 
////get end date
$(function() {
	
	
    $(".firstcal").datepicker({
        dateFormat: "dd/mm/yy",
        onSelect: function(dateText, instance) {
			
		
			
          
        }
    });
 
	
});
</script>

<script type='text/javascript'>

function validate1(form1){
 with(form1)
 {

if(amount.value=="" && feedback.value=="" && cdate.value=="")
{
	alert("Please Enter the Fields.");
	return false;
}
 
}
 return true;
 }

</script>
</head>

<body>
<center>
<input type="button" value="PM Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>

<h2>Customer Request</h2>
<form action="process_open.php" method="post" onSubmit="return validate1(this)"  id="form1" name="form1">
<?php
include('config.php');
$id=$_GET['id'];
$type=$_GET['type'];

$sql=mysql_query("select * from  phppos_request where id='$id' and cust_type='$type'");
$row = mysql_fetch_row($sql);
if($type=="sales"){
$result1 = mysql_query("SELECT * FROM  phppos_service where id='$row[1]' ");
}else {
$result1 = mysql_query("SELECT * FROM  phppos_service1 where id='$row[1]' ");	
}
$row1 = mysql_fetch_row($result1); 
?>
<table>
<tr><td width="152" height="40">Date : </td><td width="252"><?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); ?></td></tr>
<tr>
<td height="40">Customer Name : </td>
<td>

<?php echo $row1[2]; ?>

</td></tr>

<tr>
<td height="40">Request : </td>
<td><?php echo $row[2]; ?><input type="hidden" value="<?php echo $id; ?>" name="id"/></td>
</tr>

<tr>
<td height="40">Assign To :</td>
<td>

<?php
$result2 = mysql_query("SELECT * FROM  phppos_engineer where id='$row[4]' order by name");
$row2 = mysql_fetch_row($result2); ?>
<?php echo $row2[1]; ?>


</td>
<?php if($row[8]=="0.00"){ }else{ ?>
<tr ><td height="40">Paid amount : </td><td><input type="text" value="" name="amount" id="amount"/></td>
</tr>
<?php } ?>
<tr><td height="40">Feedback : </td><td><label for="textarea"></label>
    <textarea name="feedback" id="feedback" rows="4" cols="30"><?php echo $row[7] ?></textarea></td>
</tr>
<tr>
<td height="40">Close Date :</td>
<td>
<input type="text" name="cdate" id="cdate" class="firstcal" value="<?php if(isset($row[6]) and $row[6]!='0000-00-00') echo date('d/m/Y',strtotime($row[6])); ?>"/>
  </td>
</tr>
<tr>
<td height="40">Status :</td>
<td>
  <select name="status" id="status">
  <option value="">Select</option>
  <option value="Close">Close</option>
  </select></td>
</tr>
<tr>
<td height="40">Client Name :</td>
<td>
 <input type="text" value="<?php echo $row[10] ?>" name="client" id="client" />
</td>
</tr>
<tr>
<td height="34"><input type="submit" value="submit" class="button"/></td>
<td height="34"><input type="button" value="Cancel" class="button" onclick="javascript:location.href = 'open.php';"/></td>

</tr>
</table>
</form>
</center>
</body>
</html>