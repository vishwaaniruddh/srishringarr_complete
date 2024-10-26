<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Factory</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<link href="menu.css" rel="stylesheet" type="text/css" />
<script>

function getXMLHttp()
{
 var xmlHttp
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

function MakeRequest()

{ 
  var xmlHttp = getXMLHttp();
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {

      HandleResponse3(xmlHttp.responseText);
    }
  }
  //alert("getarea.php?ccode="+document.forms[0].city.value);
var str=document.getElementById('city').value;
//alert(str);
  xmlHttp.open("GET", "get_area.php?city="+str, true);

  xmlHttp.send(null);
}

function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}

function validate()
{
//alert("hello");
var form=document.getElementById('engform');
with(form)
{
//alert("hello");
if(agent.value=='')
{
//alert("hi");
alert("Please Enter Agent Name");
agent.focus();
return;
}

if(cust.value=='0')
{
alert("Please Enter Customer / Party ");
cust.focus();
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
$qry=mysqli_query($con1,"select * from factory_entries where id='".$id."'");

$result=mysqli_fetch_row($qry);

$bdate= date("d/m/Y",strtotime($result[7]));
$ldate= date("d/m/Y",strtotime($result[15]));
$vessdate= date("d/m/Y",strtotime($result[16]));
$eta= date("d/m/Y",strtotime($result[17]));

?>


<h2>Edit Entries</h2>
<div id="header">
<form action="process_editentries.php" method="post" name="engform" enctype="multipart/form-data" id="engform">
<table>


<tr>
<td height="35">Agent Name: </td>
<td><select name="agent" id="agent" />
<option value=''> Select </option>

<?php
$qry=mysqli_query($con1,"select * from agents order by agent_name ASC");
while($row=mysqli_fetch_row($qry)) { ?>
<option value="<?php echo $row[0]; ?>" <?php if($result[2]==$row[0]){ echo "selected"; } ?> ><?php echo $row[1]; ?> </option>
<? } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Party / Supplier Name: </td>
<td><select name="cust" id="cust" />
<option value=''> Select </option>

<?php
$qry1=mysqli_query($con1,"select * from parties order by party_name ASC");
while($row1=mysqli_fetch_row($qry1)) { ?>
<option value="<?php echo $row1[0]; ?>"<?php if($result[1]==$row1[0]){ echo "selected"; } ?> ><?php echo $row1[1]; ?> </option>
<? } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Product: </td>
<td><select name="material" id="material" />
<option value=''> Select </option>

<?php
$qry1=mysqli_query($con1,"select a.prod_spcid, b.prod_name, a.specs from factory_productlist a, factory_product_master b where a.prod_id=b.prod_id  order by b.prod_id ASC");
while($pro=mysqli_fetch_row($qry1)) { ?>
<option value="<?php echo $pro[0]; ?>" <?php if($result[3]==$pro[0]){ echo "selected"; } ?> ><?php echo $pro[1]." - ".$pro[2]; ?> </option>
<? } ?>
</select>
</td>
</tr>

<tr>
<td height="35">Qty: </td>
<td><input type="number" min="0" max="10000000" value="<?php echo $result[4]; ?>" name="qty" id="qty" style="font-size:15px; font-weight:bold;" onkeyup="if(parseInt(this.value)>10000000){ this.value =''; return false; }" /></td>
</tr>

<tr>
<td height="35">Actual Qty: </td>
<td><input type="number" min="0" max="10000000" value="<?php echo $result[5]; ?>" name="aqty" id="aqty" style="font-size:15px; font-weight:bold;" onkeyup="if(parseInt(this.value)>10000000){ this.value =''; return false; }" required/></td>
</tr>

<tr>
<td height="35">PI / SO No: </td>
<td><input type="text" name="so" id="so" value="<?php echo $result[6]; ?>"/></td>
</tr>

<tr>
<td>Date of Booking </td>
<td>
<input type="text" name="date" id="date" value="<?php echo $bdate; ?>" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('date');" placeholder="Booking date" required/>
</td>
</tr>

<tr>
<td height="35">Invoice No: </td>
<td><input type="text" name="inv" id="inv" value="<?php echo $result[8]; ?>" required/></td>
</tr>


<tr>
<td>Rate</td>



<td><input type="number" min="1" max="100000000" value="<?php echo $result[9]; ?>"  name="rate" id="rate" onkeyup="if(parseInt(this.value)>100000000){ this.value =''; return false; }" /></td>
</tr>
<tr>
<td>Terms of delivery </td>
<td> <input type="text" name="terms" id="terms" value="<?php echo $result[10]; ?>" required/>
</td>
</tr>

<tr>
<td>Port of delivery</td>
<td> <input type="text" name="port" id="port" value="<?php echo $result[11]; ?>" required/>
</td>
</tr>

<tr>
<td height="35">Select Factory: </td>
<td><select name="factory" id="factory" />
<option value=''> Select </option>

<?php
$qry2=mysqli_query($con1,"select * from factories where status=1 ");
while($row2=mysqli_fetch_row($qry2)) { ?>
<option value="<?php echo $row2[1]; ?>"<?php if($result[12]==$row2[1]){ echo "selected"; } ?>><?php echo $row2[1]; ?> </option>
<? } ?>
</select>
</td>
</tr>

<tr>
<td>Payment Terms</td>
<td> <input type="text" name="payterm" id="payterm" value="<?php echo $result[13]; ?>" required/>
</td>
</tr>

<tr>
<td>BL No</td>
<td> <input type="text" name="blno" id="blno" value="<?php echo $result[14]; ?>" required/>
</td>
</tr>

<tr>
<td>Loading Date</td>
<td>
<input type="text" name="ldate" id="ldate" value="<?php echo $ldate; ?>" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('ldate');" placeholder="Loading date" required/>
</td>
</tr>

<tr>
<td>Vessel Takeoff Date</td>
<td>
<input type="text" name="vdate" id="vdate" value="<?php echo $vessdate; ?>" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('vdate');" placeholder="Takeoff date" required/> 
</td>
</tr>

<tr>
<td>ETA</td>
<td>
<input type="text" name="eta" id="eta" value="<?php echo $eta; ?>" onkeypress="return runScript(event)"  readonly="readonly" onclick="displayDatePicker('eta');" placeholder="ETA" required/> 
</td>
</tr>

<tr>
<td>Special Terms - If any</td>
<td> <input type="text" name="splterm" id="splterm" value="<?php echo $result[18]; ?>" required/>
</td>
</tr>

<tr>
<td>Status</td>
<td> <select name="status" id="status" required/>

<option value="<?php echo $result[19]; ?>"><?php echo $result[19]; ?></option>
<option value='To be Loaded'> To be Loaded</option>
<option value='To be Dispatched'> To be Dispatched</option>
<option value='Dispatched'> Dispatched</option>
<option value='Arrived'> Arrived</option>
<option value='Cleared'> Cleared</option>

</select>
</td>
</tr>

<tr>
<td>Docs Status</td>
<td> <select name="docstatus" id="docstatus" required/>
<option value="<?php echo $result[20]; ?>"><?php echo $result[20]; ?></option>
<option value='Pending'> Pending</option>
<option value='Verified - Correct'> Verified - Correct</option>
<option value='Verified - InCorrect'> Verified - InCorrect</option>
</select>
</td>
</tr>

<tr>
<td height="35" colspan="2"><input  type="button" value="submit" class="readbutton" onclick="validate();"/></td>

<input type="hidden" name='id' id='id' value="<?php echo $id; ?>"/>
</tr>

</table>
</form>
</div>
</center>
</body>
</html>