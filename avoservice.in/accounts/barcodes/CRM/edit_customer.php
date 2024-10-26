<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!---date--->
<script type='text/javascript' src='jquery-1.4.4.min.js'></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="jquery-ui.css">
<style>
.text{ width:200px; height:23px;}
</style>
    
<script type='text/javascript'>//<![CDATA[ 
////get end date
$(function() {
	
	
    $(".firstcal").datepicker({
        dateFormat: "dd/mm/yy",
        onSelect: function(dateText, instance) {
			var str1=document.getElementById('pack').value;
			var m=str1.split(" ");
			var a=Number(m[0]);
			
			var mon=m[1]+"()";
			//alert(mon);
            date = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
			if(m[1]=="Year"){
			//alert(date.getFullYear()+3);
			 date.setYear(date.getFullYear() + a);
			 date.setDate(date.getDate() -1);
			}else{
            date.setMonth(date.getMonth() + a);
			 date.setDate(date.getDate() -1);
			}
			
            $(".secondcal").datepicker("setDate", date);
        }
    });
    $(".secondcal").datepicker({
        dateFormat: "dd/mm/yy"
    });
});

////validation
function validate(form){
 with(form)
 {
var numbers = /^[0-9]+$/;  
if(!cont.value.match(numbers))
{
alert("Please Enter Contact No. in numbers");
cont.focus();
return false;
}
if(pin.value=="")
{
alert("Please Enter Pincode");
pin.focus();
return false;
}


}
return true;
}


</script>
</head>
<?php 
include('config.php');
$id=$_GET['id'];
//echo "select * from phppos_service where cust_id='C-$id'";
$query =mysql_query("select * from phppos_service where cust_id='$id'");
$row=mysql_fetch_row($query);
?>
<body>
<center>
<input type="button" value="PR Call" class="button" onclick="javascript:location.href = 'cust_service.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="CR Call" class="button" onclick="javascript:location.href = 'cust_request.php';"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="AMC" class="button" onclick="javascript:location.href = 'amcview.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Open Call" class="button" onclick="javascript:location.href = 'open.php';" />&nbsp;&nbsp;&nbsp;
<input type="button" value="Closed Call" class="button" onclick="javascript:location.href = 'close.php';"  />&nbsp;&nbsp;&nbsp;
<input type="button" value="Alerts" class="button" onclick="javascript:location.href = 'alert.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Expired" class="button" onclick="javascript:location.href = 'expired.php';" style="width:100px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Engineer Performance" class="button" onclick="javascript:location.href = 'engperforma.php';" style="width:160px;"/>&nbsp;&nbsp;&nbsp;
<input type="button" value="Logout" class="button" onclick="javascript:location.href = 'logout.php';" style="width:100px;"/><br /><br>

<h2>Edit Customer </h2>
<form action="update_customer.php" method="post" name="form" onSubmit="return validate(this)" enctype="multipart/form-data">
<table>
<tr>
<td width="140" height="40">Date : </td><td width="202"><?php echo date('d/m/Y'); ?></td>
</tr>

<tr>
<td height="40"> Customer Name : </td>
<td><input type="text" name="cname" id="cname" class="text" value="<?php echo $row[2]; ?>"/></td>
</tr>

<tr>
<td height="40">Contact : </td>
<td><input type="text" name="cont" id="cont" class="text" value="<?php echo $row[3]; ?>"/></td>
</tr>

<tr>
<td height="40">Email : </td>
<td><input type="text" name="email" id="email" class="text" value="<?php echo $row[4]; ?>"/></td>
</tr>

<tr>
<td height="40">Address : </td>
<td><textarea name="add" id="add" rows="4" cols="30"><?php echo $row[5]; ?></textarea></td>
</tr>

<tr>
<td height="40">Pincode : </td>
<td><input type="text" name="pin" id="pin" class="text" value="<?php echo $row[17]; ?>" /></td>
</tr>

<tr>
<td height="40">Model No. : </td>
<td><textarea name="item" id="item" rows="3" cols="30"><?php echo $row[6]; ?></textarea></td>
</tr>

<tr>
<td height="40">Model Image : </td>
<td><input type="file" name="file"  /><img src="modelphoto/<?php echo $row[21];?>" width="50" height="50"><input type="hidden" name="oldimg" id="oldimg" value="<?php echo $row[21];?>"></td>
</tr>


<tr>
<td height="40">Motor Warranty : </td>
<td><select id="motor" name="motor" >
<option value="Not Applicable" <?php if($row[20]=="Not Applicable") echo "Selected";?> >Not Applicable</option>
<option value="1 Year" <?php if($row[20]=="1 Year") echo "Selected";?>>1 year</option>
<option value="2 Year" <?php if($row[20]=="2 Year") echo "Selected";?>>2 Year</option>
<option value="3 Year" <?php if($row[20]=="3 Year") echo "Selected";?>>3 Year</option>
<option value="4 Year" <?php if($row[20]=="4 Year") echo "Selected";?>>4 Year</option>
<option value="5 Year" <?php if($row[20]=="5 Year") echo "Selected";?>>5 Year</option>
</select></td>
</tr>

<tr>
<td height="40">Date of Purchase : </td>
<td><input type="text" name="dop" id="dop" class="text" readonly="readonly" value="<?php if(isset($row[7]) and $row[7]!='0000-00-00') echo date('d/m/Y',strtotime($row[7])); ?>"/></td>
</tr>
<tr>
<td height="34">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="submit" value="submit" class="button"/></td>
</tr>
</table>
</form>
</center>
</body>
</html>