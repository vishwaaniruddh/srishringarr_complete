<?php
include("access.php");
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Other Expenses</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>


function validate()
{

var form=document.getElementById('engform');
with(form)
{


if(date.value=='0')
{
alert("Please Select Correct Date");
date.focus();
return;
}



form.submit();
}
}


</script>
</head>

<body>
<center>
<?php include("menubar.php"); 

$id=$_GET['id'];

//echo $id;

$abc="select * from engg_oth_expenses where id='".$id."'" ;

$qruy=mysqli_query($con1,$abc);
$row=mysqli_fetch_row($qruy);

$sql= "select * from area_engg where engg_id='".$row[1]."' ";

$result = mysqli_query($con1,$sql);
$engr=mysqli_fetch_row($result);

?>

<h2>Edit Engineer Other Expenses</h2>
<h4>This claims will be settled through branch expenses</h4>

<div id="header">
<form action="process_edit_othexp.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>
<tr>
<td width="160" height="35">Claim Date: </td>

<td width="160" colspan="2"><input type="text" name="date" id="date" style="color:red; font-size:15px; font-weight:bold;" class="date" readonly="readonly" value="<?php echo $row[2]; ?>" ></td>
</tr>
<tr>
<td height="35">Name: </td>
<td colspan="2" width="130"><input type="hidden" name="engg_id" id="engg_id" 
value="<?php echo $engr[0];?>"> <?php echo $engr[1] ; ?> </td>
</tr>
<tr>
<td height="35">Branch : </td>
 
<td colspan="2">
<select name="branch" id="branch">
<?php

$state=mysqli_query($con1,"select id, name from `avo_branch` where id='".$engr[2]."' ");
while($stro=mysqli_fetch_row($state))
{
?>
<option value="<?php echo $engr[2]; ?>"> <?php echo $stro[1];} ?> 
</option>
</td>
</tr>


<tr>
<th height="30" width="160" >Expenses Type </th width="160"> <th>Remarks / Reason </th> <th width="60">Amount</th>
</tr>

<tr>
<td height="30"> Transport/ Logistics Expenses </td>
<td><input type="text" name="log_rem" id="log_rem" value="<? echo $row[4]; ?>" maxlength="150"></td>
<td><input type="number" min="0" max="3000" name="log_exp" id="log_exp" value="<? echo $row[5]; ?>" onkeyup="if(parseInt(this.value)>3000){ this.value =0; return false; }" /></td>
</tr>
<tr>
<td height="30"> Handling / Hamali Charges </td>
<td><input type="text" name="hand_rem" id="hand_rem" value="<? echo $row[6]; ?>" maxlength="150"></td>
<td><input type="number" min="0" max="3000" name="hand_exp" id="hand_exp" value="<? echo $row[7]; ?>" onkeyup="if(parseInt(this.value)>3000){ this.value =0; return false; }" /></td>
</tr>

<tr>
<td height="30"> Spares Purchases </td>
<td><input type="text" name="spare_rem" id="spare_rem" value="<? echo $row[8]; ?>" maxlength="150"></td>
<td><input type="number" min="0" max="1000" value="<? echo $row[9]; ?>" name="spare_exp" id="spare_exp" placeholder="max-1000" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>
</tr>

<tr>
<td height="30"> Courier </td>
<td><input type="text" name="mobile_rem" id="mobile_rem" value="<? echo $row[10]; ?>" maxlength="150"></td>
<td><input type="number" min="0" max="1000" name="mobile_exp" id="mobile_exp" value="<? echo $row[11]; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>
</tr>
<tr>
<td height="30"> Stationary Expenses </td>
<td><input type="text" name="room_rem" id="room_rem" value="<? echo $row[12]; ?>" maxlength="150"></td>
<td><input type="number" min="0" max="1000" name="room_exp" id="room_exp" value="<? echo $row[13]; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>
</tr>

<tr>
<td height="30"> Other Expenses, If any. </td>
<td><input type="text" name="oth_rem" id="oth_rem" value="<? echo $row[14]; ?>" maxlength="150"></td>
<td><input type="number" min="0" max="2000" name="oth_exp" id="oth_exp" value="<? echo $row[15]; ?>" onkeyup="if(parseInt(this.value)>2000){ this.value =0; return false; }" /></td>
</tr>
<input type="hidden" name="id" id="id" value="<?php echo $id;?>">

<tr>
<td></td><td height="30">
 
    <input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>
<td></td>
</tr>

</table>
</form>
</div>
</center>
</body>
</html>