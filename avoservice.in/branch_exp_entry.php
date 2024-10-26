<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


<script type="text/javascript">
//==================Get Exp type from exp head==========
function gettype(val)
{
  // alert(val);
brid=val;
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var s=xmlhttp.responseText;
  	//alert(s);
	 document.getElementById('mytype').innerHTML = s;	
    }
  }
      //	alert("getexptype.php?brid="+brid);    
	xmlhttp.open("GET","getexptype.php?brid="+brid,true);
	xmlhttp.send();
}


//=======================================    
    function validate() {
        
    var date = document.getElementById('date').value; //alert(date);
    var cdate = document.getElementById('cdate').value;


if ((new Date(date).getTime()) > (new Date(cdate).getTime())) {
    alert('You Cannot enter Future date');
    date.focus();
    
} else {
    }

 
var form=document.getElementById('engform');
with(form)
{

    

if(br_id.value=='')
{
alert("Please Login to correct Branch Id");
br_id.focus();
return;
}


if(exptype.value=='')
{
alert("Please Select Expense Type");
exptype.focus();
return;
}

if(exp_amt.value=='')
{
alert("Please Enter Correct Amount");
exp_amt.focus();
return;
}

if(remarks.value=='')
{
alert("Please Give Narration");
remarks.focus();
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
if ($_SESSION['branch']==4) 
$sql.= "select * from avo_branch where id='".$_SESSION['branch']."'";

echo $sql;
//$result = mysqli_query($con1,$sql);
$branch=mysqli_fetch_row($result);
$branch[0]="1";
$branch[1]="Andhra";

?>

<h2>Branch Expense Entry</h2>
<div id="header">
<form action="process_branch_exp.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>

<? $last_date=date("d/m/Y", strtotime( '-7 days' ) );
$cdate=date('d/m/Y');

//echo $cdate ; 
?>
<input type="hidden" name="date1" id="date1" value="<?php echo $last_date; ?>" >
<input type="hidden" name="cdate" id="cdate" value="<?php echo $cdate; ?>" >

<tr>
<td width="130" height="35">Expense Date: </td>
<td><input type="text" name="date" id="date" style="color:red; font-size:15px; font-weight:bold;" class="date" readonly="readonly" value="<?php echo date('d/m/Y'); ?>"  onClick="displayDatePicker('date');" ></td>
</tr>
<tr>
<td width="130" height="35">Branch Name: </td>
<td width="130"><input type="hidden" name="br_id" id="br_id" 
value="<?php echo $branch[0];?>"> <?php echo $branch[1] ; ?> </td>
</tr>

<tr>
<td height="35">Expenses Type: </td>

<?php 
include("config.php");
$expqry1="select id, name from branch_exphead where status=1 ORDER by id ASC";    
//echo "select id, name from branch_exphead ORDER by id ASC";
?>

<td id="res">
<select name='exp_head' id='exp_head'onchange="gettype(this.value);">
<option value='0'>Select</option>
<?php
include("config.php");
$expqry1=mysqli_query($con1,"select id, name from `branch_exphead` where status=1 order by id");
while($state_avo1=mysqli_fetch_row($expqry1))
{ ?>
<option value="<?php echo $state_avo1[0];  ?>"><?php echo $state_avo1[1];  ?></option>
<?php } ?></select>
</td>
</tr>



<tr>
<td width="130" height="35">Exp Type :</td>
<td id="res" width="189">
<div id="mytype">
<select name="exptype" class="form-control" id="exptype" required>
<option value="">select</option>
</select>
</div>
</td>
</tr>

<tr>
<td>Invoice No: </td>
<td><input type="text" name="remarks" id="remarks" maxlength="200"></td>
</tr>


<tr>
<td height="35">Amount: </td>
<td><input type="number" min="0" max="10000" name="exp_amt" id="exp_amt" placeholder="max:10000" onkeyup="if(parseInt(this.value)>10000){ this.value =''; return false; }" /></td>
</tr>


<tr>
<td>Remarks / Narration: </td>
<td><textarea input type="text" name="remarks" id="remarks" placeholder="Narration" maxlength="200"></textarea></td>
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