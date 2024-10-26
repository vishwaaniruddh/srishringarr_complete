<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Expenses</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<link href="menu.css" rel="stylesheet" type="text/css" />



<script type="text/javascript" src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>

<script type="text/javascript">
    
    function validate() {
        
    // alert("hello");   
        var date = document.getElementById('date').value; //alert(date);
      
 
    edate=new Date(date.split('/').reverse().join('-')).toISOString().split('T')[0];


        var cdate = document.getElementById('cdate').value; 
   
  //  alert(cdate);
  alert(edate);
  
  if( Date.parse(cdate) < Date.parse(edate )) {
    alert("You Can't enter Future date");
     return false;
      }
   

  /*    
     var resdate = new Date(dateSecond[2], dateSecond[1], dateSecond[0]); //Year, Month, Date
	
			var dd = resdate.getDate(); alert(dd);
            var mm = resdate.getMonth(); alert(mm);
            var yyyy = resdate.getFullYear(); alert(yyyy); 
            var edate = mm+'/'+dd+'/'+yyyy;
           
      var cdate = document.getElementById('cdate').value; 
  
  alert(cdate);
  alert(edate);
  
      if( Date.parse(cdate) <= Date.parse(edate )) {
    alert("You Can't enter Future date");
     return false;
      
          
      } */

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



form.submit();
}
}


</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<?
//echo $_SESSION['user']." ".$_SESSION['srno']." ".$_SESSION['designation'];

$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
//echo "select srno from login where username='".$_SESSION['user']."'";

$qry2ro=mysqli_fetch_row($qry2);

$sql.= "select * from area_engg where loginid='".$qry2ro[0]."' and status='1' ";

//$sql.= "select * from area_engg where loginid='".$qry2ro[0]."' and status='1' and engg_desgn not like '%Charge%' ";

//echo $sql;

$result = mysqli_query($con1,$sql);
$engr=mysqli_fetch_row($result);

?>

<h2>Engineer Expense Entry</h2>
<div id="header">

<form action="process_eng_expenses.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>

<? $last_date=date("d/m/Y", strtotime( '-7 days' ) );
$cdate=date('Y-m-d');

//echo $cdate ; 
?>
<input type="hidden" name="date1" id="date1" value="<?php echo $last_date; ?>" >
<input type="hidden" name="cdate" id="cdate" value="<?php echo $cdate; ?>" >

<td><input type="text" name="date" id="date" style="color:red; font-size:15px; font-weight:bold;" class="date" readonly="readonly" value="<?php echo date('d/m/Y'); ?>"  onClick="displayDatePicker('date');" ></td>

<tr>
<td width="130" height="35">Name: </td>
<td width="130"><input type="hidden" name="engg_id" id="engg_id" 
value="<?php echo $engr[0];?>"> <?php echo $engr[1] ; ?> </td>

<td width="130" height="35">Branch : </td>
 
<td width="130">
<select name="branch" id="branch">
<?php
//include("config.php");
$state=mysqli_query($con1,"select id, name from `avo_branch` where id='".$engr[2]."' ");
while($stro=mysqli_fetch_row($state))
{
?>
<option value="<?php echo $engr[2]; ?>"> <?php echo $stro[1];} ?> 
</option>
</td>
</tr>

<tr>

<td height="35">No. of Calls Attended </td>
<td><input type="number" min="0" max="50" name="calls" id="calls" value="0" style="color:red; font-size:15px; font-weight:bold;" onkeyup="if(parseInt(this.value)>50){ this.value =''; return false; }" /></td>

<td height="35">Company Vehicle travel KM: </td>
<td><input type="number" min="0" max="2000" name="comp_km" id="comp_km" placeholder="in KMs" value="0" onkeyup="if(parseInt(this.value)>2000){ this.value =0; return false; }" /></td>

</tr>


<tr>

<td height="35">Bike travel KM: </td>
<td><input type="number" min="0" max="1000" value="0" name="bike_km" id="bike_km" placeholder="in KMs" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

<td height="35">Bike Expenses: </td>
<td><input type="number" min="0" max="2000" name="bike_exp" id="bike_exp" placeholder="max:2000" value="0" onkeyup="if(parseInt(this.value)>2000){ this.value =0; return false; }" /></td>

</tr>
<tr>
<td height="35">Cab/Taxi KM: </td>
<td><input type="number" min="0" max="1000" name="cab_km" id="cab_km" placeholder="in KMs" value="0" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

<td height="35">Taxi Expenses: </td>
<td><input type="number" min="0" max="2000" name="cab_exp" id="cab_exp" placeholder="max:2000" value="0" onkeyup="if(parseInt(this.value)>2000){ this.value =0; return false; }" /></td>
</tr>
<tr>

<td height="35">Public Transport KM:</td>
<td><input type="number" min="0" max="2000" name="public_km" id="public_km" placeholder="in KMs" value="0" onkeyup="if(parseInt(this.value)>2000){ this.value =0; return false; }" /></td>

<td height="35">Travel Expenses:</td>
<td><input type="number" min="0" max="3000" name="public_exp" id="public_exp"  placeholder="max:3000" value="0" onkeyup="if(parseInt(this.value)>3000){ this.value =0; return false; }" /></td>

</tr>
<tr>
<td height="35">Food Expenses: </td>
<td><input type="number" min="0" max="1000" name="food" id="food" placeholder="max:1000" value="0" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>

<td height="35">Lodging / Hotel Stay Expenses: </td>
<td><input type="number" min="0" max="1000" name="lodge" id="lodge" placeholder="max:1000" value="0" onkeyup="if(parseInt(this.value)>1000){ this.value =0; return false; }" /></td>
</tr>



<tr>
<td height="35" style="color:red;">Mobile Expenses: </td>
<td><input type="number" min="0" max="300" name="mobile" id="mobile" placeholder="max:300" value="0" onkeyup="if(parseInt(this.value)>300){ this.value =0; return false; }" /></td>

<td height="35"style="color:red;">Monthly Room rent, If any: </td>
<td><input type="number" min="0" max="10000" name="room" id="room" value="0" placeholder="max:10000" onkeyup="if(parseInt(this.value)>10000){ this.value =0; return false; }" /></td>

</tr>


<tr>
<td height="35">No.of Other Visits: </td>
<td><input type="number" min="0" max="50" name="close" id="close"style="color:red; font-size:15px; font-weight:bold;" value="0" onkeyup="if(parseInt(this.value)>50){ this.value =''; return false; }" /></td>

<td>Purpose of Other Visits </td>
<td><textarea input type="text" name="oth_reason" id="oth_reason" placeholder="Purpose of visit" maxlength="100"></textarea></td>
</tr> 


<tr>
<td height="35" colspan="2"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>

</tr>

</table>
</form>
</div>
</center>
</body>
</html>