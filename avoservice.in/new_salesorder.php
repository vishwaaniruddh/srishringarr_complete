<html>
<head>
<title>View Sales order</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script>

function validate1(form1){
 with(form1)
 {

if(invno.value=='')
{
	alert("Please Enter Invoice Number.");
	invno.focus();
	return false;
}
if(date1.value==0)
{
	alert("Please Select Invoice date.");
	date1.focus();
	return false;
}
if(del_mode.value=='')
{
	alert("Please Select Delivery Mode.");
	del_mode.focus();
	return false;
}
if(invval.value==0)
{
	alert("Please Enter bCorrect Invoice Value.");
	invval.focus();
	return false;
}
if(del_mode.value==0)
{
	alert("Please Select Delivery Mode.");
	del_mode.focus();
	return false;
}
if(del_mode.value==0)
{
	alert("Please Select Delivery Mode.");
	del_mode.focus();
	return false;
}
}

 return true;
 }
</script>

<style>

</style>
</head>
<body>
<form name="form" action="new_processSO.php" method="post" enctype="multipart/form-data" onSubmit="return validate1(this)">

<div align="center" style="padding:10px">
<input type="hidden" name="sid" value="<?php echo $_GET['id']; ?>" >
<h3>SALES ORDER</h3>
<table id="tab">
<tr>
  <td>
  Invoice NO:
  </td>
  
  
  <td>
  <input type="text" name="invno" id="invno" required />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Invoice Date:
  </td>
  
  <td>
  <input type="text" name="date1" id="date1"  onclick="displayDatePicker('date1');" readonly="readonly" required />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Invoice Value:
  </td>
 <td><input type="number" min="0" max="100000000" name="invval" id="invval" value="" onkeyup="if(parseInt(this.value)>100000000){ this.value =0; return false; }" /></td> 
  
</tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>Delivery Mode: </td>
  
  <td>
  <select name="del_mode" id="del_mode" required>
  <option value="">select</option>
<option value="Contract Couriers">Contract Couriers </option>
<option value="Public Bus transport">Public Bus transport</option>
<option value="Own Vehicle">Own Vehicle</option>
<option value="Customer pickup">Customer pickup</option>
<option value="Engineer in Hand">Engineer in Hand</option>
</select>
  </td>
</tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Courier Name:
  </td>
  
  <td>
  <input type="text" name="cname" id="cname"/>
  </td>
</tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Docket No:
  </td>
  
  <td>
  <input type="text" name="dno" id="dno"/>
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Estimated Delivery Date:
  </td>
  
  <td>
  <input type="text" name="estdate" id="estdate"  onclick="displayDatePicker('estdate');" readonly="readonly"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td>
  Dispatch Date:
  </td>
  
  <td>
  <input type="text" name="date2" id="date2"  onclick="displayDatePicker('date2');" readonly="readonly" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Delivery Date:
  </td>
  
  <td>
  <input type="text" name="deldt" id="deldt"  onclick="displayDatePicker('deldt');" readonly="readonly"  />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>
  <td>
  Upload Invoice:
  </td>
  
  <td>
  <input type="file" name="invfile" id="invfile" required />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note No.:
  </td>
  
  <td>
  <input type="text" name="crn" id="crn" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note Date:
  </td>
  
  <td>
  <input type="text" name="crndate" id="crndate" onclick="displayDatePicker('crndate');" readonly="readonly" />
  </td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Credit Note Amount:
  </td>
 <td><input type="number" min="0" max="100000000" name="crnamt" id="crnamt" value="0" onkeyup="if(parseInt(this.value)>100000000){ this.value =0; return false; }" /></td> 
 
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td>
  Upload Credit Note:
  </td>
  
  <td>
  <input type="file" name="crnfile" id="crnfile" />
  </td>
</tr>

<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
  <td colspan="2" align="center">
  <input type="submit" name="subs" value="submit" />
  </td>
</tr>

</table>
<br>
<a href="view_sales_order.php" >BACK</a>
</div>
</form>
</body>