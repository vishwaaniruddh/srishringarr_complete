<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Expenses</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>


function validate()
{
//alert("hello");
var form=document.getElementById('engform');
with(form)
{
//alert("hello");
if(engg_id.value=='')
{
//alert("hi");
alert("Check Your Login");
engg_id.focus();
return;
}
if(branch.value=='')
{
alert("Please Select Branch");
branch.focus();
return;
}

if(date.value=='0')
{
alert("Please Select Correct Date");
date.focus();
return;
}

if(calls.value=='')
{
alert("Please enter correct call count");
calls.focus();
return;
}


if(calls.value=='')
{
alert("Please enter correct call count");
calls.focus();
return;
}
if(comp_km.value=='')
{
alert("Please enter KMs else enter zero");
comp_km.focus();
return;
}
if(bike_exp.value=='')
{
alert("Please enter amount else enter zero");
bike_exp.focus();
return;
}
if(bike_km.value=='')
{
alert("Please enter correct call count");
bike_km.focus();
return;
}


if(public_exp.value=='')
{
alert("Please enter Travel Expenses else enter zero");
public_exp.focus();
return;
}

if(cab_exp.value=='')
{
alert("Please enter Cab Expenses else enter zero");
cab_exp.focus();
return;
}
if(food.value=='')
{
alert("Please enter Food Expenses else enter zero");
food.focus();
return;
}

if(lodge.value=='')
{
alert("Please enter Lodge expenses if zero enter zero");
lodge.focus();
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

$id= $_GET['id'];
$qry=mysqli_query($con1,"select * from daily_expenses where id='".$_GET['id']."'");
while ($row=mysqli_fetch_row($qry)) {

?>

<h2>Edit Expenses</h2>
<div id="header">
<form action="process_edit_exp.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>


<td><input type="text" style="color:red; font-size:15px; font-weight:bold;" class="date" readonly="readonly" value="<?php echo $row[3]; ?>"  ></td>

<tr>
<td width="130" height="35">Name: </td>
<?$eng= mysqli_query($con1,"select engg_name  from area_engg where engg_id='".$row[1]."'");
$eng1= mysqli_fetch_row($eng);
 //echo "select engg_name  from area_engg where engg_id='".$row[1]."'";
?>
<td width="130"><?php echo $eng1[0];?> </td>


<td width="130" height="35">Branch : </td>
 
<?php
$state=mysqli_query($con1,"select name from `avo_branch` where id='".$row[2]."' ");
$stro=mysqli_fetch_row($state);  ?>

<td width="130"> <?php echo $stro[0];?> </td>

</tr>

<tr>

<td height="35">No. of Calls Attended </td>
<td><input type="number" min="0" max="50" name="calls" id="calls" value= "<? echo $row[4] ; ?>" style="color:red; font-size:15px; font-weight:bold;" onkeyup="if(parseInt(this.value)>50){ this.value =''; return false; }" /></td>

<td height="35">Company Vehicle travel KM: </td>
<td><input type="number" min="0" max="1000" name="comp_km" id="comp_km" value= "<? echo $row[20] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

</tr>


<tr>

<td height="35">Bike travel KM: </td>
<td><input type="number" min="0" max="1000" name="bike_km" id="bike_km" value= "<? echo $row[6] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

<td height="35">Bike Expenses: </td>
<td><input type="number" min="0" max="1500" name="bike_exp" id="bike_exp" value= "<? echo $row[7] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

</tr>
<tr>
<td height="35">Cab/Taxi KM: </td>
<td><input type="number" min="0" max="2000" name="cab_km" id="cab_km" value= "<? echo $row[8] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

<td height="35">Taxi Expenses: </td>
<td><input type="number" min="0" max="1000" name="cab_exp" id="cab_exp" value= "<? echo $row[9] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>
</tr>
<tr>

<td height="35">Public Transport KM:</td>
<td><input type="number" min="0" max="1000" name="public_km" id="public_km" value= "<? echo $row[10] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

<td height="35">Travel Expenses:</td>
<td><input type="number" min="0" max="1000" name="public_exp" id="public_exp"  value= "<? echo $row[11] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

</tr>
<tr>
<td height="35">Food Expenses: </td>
<td><input type="number" min="0" max="1000" name="food" id="food" value= "<? echo $row[12] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

<td height="35">Lodging Expenses: </td>
<td><input type="number" min="0" max="1000" name="lodge" id="lodge" value= "<? echo $row[13] ; ?>" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>
</tr>



<tr>
<td height="35" style="color:red;">Mobile Expenses: </td>
<td><input type="number" min="0" max="300" name="mobile" id="mobile" value= "<? echo $row[16] ; ?>" onkeyup="if(parseInt(this.value)>300){ this.value =0; return false; }" /></td>

<td height="35"style="color:red;">Monthly Room rent, If any: </td>
<td><input type="number" min="0" max="10000" name="room" id="room" value= "<? echo $row[23] ; ?>" onkeyup="if(parseInt(this.value)>10000){ this.value =0; return false; }" /></td>

</tr>


<tr>
<td height="35">No.of Other Visits: </td>
<td><input type="number" min="0" max="50" name="close" id="close" value= "<? echo $row[5] ; ?>"style="color:red; font-size:15px; font-weight:bold;" onkeyup="if(parseInt(this.value)>50){ this.value =''; return false; }" /></td>

<td>Purpose of Other Visits </td>
<td><textarea input type="text" name="oth_reason" id="oth_reason" value= "<? echo $row[21] ; ?>" maxlength="100"></textarea></td>
</tr> 


<tr>
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" >

<td height="35" colspan="2"><input  type="submit" value="submit" class="readbutton" onclick="validate();"/></td>

</tr>

</table>
</form>
</div>

<? } ?>
</center>

</body>
</html>