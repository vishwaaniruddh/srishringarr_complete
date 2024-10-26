<?php
include("../access.php");
include('../config.php');
//echo $_SESSION['designation'];
 $cust=$_GET['cust'];
  $atmid=$_GET['atmid'];
  $trackid=$_GET['trackid'];
  $so_order_id = $_GET['so_order_id'];

  function get_po($parameter, $id){
    
    global $con;
    
    $sql= mysql_query("select $parameter from purchase_order where id = '".$id."' ");
    
    $sql_result = mysql_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}




  function get_new_sales_order($parameter, $id){
    
    global $con;
    
    $sql= mysql_query("select $parameter from new_sales_order where so_trackid = '".$id."' ");
    
    $sql_result = mysql_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
} 


function get_atm($parameter, $id){
    
    global $con;
    
    $sql= mysql_query("select $parameter from demo_atm where so_id = '".$id."' ");
    
    $sql_result = mysql_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}



$qrycust=mysql_query("Select cust_name from customer where cust_id='".$cust."'");
$cname=mysql_fetch_row($qrycust);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->
<script>

function validate1(form1){
 with(form1)
			 {
			
		//	var numbers = /^[0-9]+$/;
		//  var namePattern = /^[A-Za-z()'"@#*+_-]/g ;  [!@#$%^&*(),.?":{}|<>]
		//	var regularExpression = /^[a-zA-Z0-9@#&()'.+,_/"-]+$/;
			
			if(cust.value==0)
			{
				alert("Please Select Customer.");
				cust.focus();
				return false;
			}
			if(po.value==0)
			{
				alert("Please Check Purchase Order.");
				po.focus();
				return false;
			}
			
			if(ref_id.value==0)
			{
				alert("Please Select Site ID.");
				ref_id.focus();
				return false;
			}
			
			//========Branch
			if(branch_avo.value==0)
			{
				alert("Please Select Branch.");
				branch_avo.focus();
				return false;
			}
			
			
			if(cname.value.search(/[a-z]+$/)== -1 && cname.value.search(/[A-Z]+$/)== -1 )
			{
				alert("Please Enter  Contact Person Name in letters");
				cname.focus();
				return false;
			}
			if(cphone.value.length!=10)
			 {
			alert("Please Enter 10 Digits Contact Number.");
			cphone.focus();
			return false;
			}
			
			if(!cphone.value.match(numbers))
			  {
			alert("Please Enter Contact No. to continue.");
			cphone.focus();
			return false;
			}
			 
			if(cemail.value.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)==-1)
			{
			alert("Invalid E-mail Address! Please re-enter.")
			cemail.focus();
			return false;
			}
}


 return true;
 }
 
  


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



function atmid()
{ //alert("hi11111111");
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
  // alert("Hello");
	 document.getElementById('asset_div').innerHTML = s;	
    }
  }
   
   var cust=document.getElementById('cust').value;// alert(cust);
    var po=document.getElementById('po').value; //alert(po);
  var ref=document.getElementById('ref_id').value; //alert(ref_id);
  var callid=document.getElementById('trackid').value; //alert(trackid);
  
//alert("new_get_datame.php?cust="+cust+"&po="+po+"&ref="+ref+"&callid="+callid,true);
  
xmlhttp.open("GET","new_get_datame.php?cust="+cust+"&po="+po+"&ref="+ref+"&callid="+callid,true);

xmlhttp.send();
}


////assets
function addThem()
{
var a = document.form.asset;
var add = a.value+',';
document.form.asset_box.value += add;
return true;
}


function HandleResponse5(response)

{

  document.getElementById('ref_id1').innerHTML = response;

}

function HandleResponse4(response)

{

  document.getElementById('po_no').innerHTML = response;

}


function fill()
{
//alert("hii");
//alert(document.getElementById('cc').value);
document.getElementById('ccemail').innerHTML='';
document.getElementById('ccemail').innerHTML=document.getElementById('cc').value;
}
</script>
</head>

<body onload="atmid();">
<center>
<?php 
include("menubar.php"); 
?>

<h2>Generate Installation Call</h2>

<div id="header">

<form action="process_alert_rental.php" method="post" name="form" onSubmit="return validate1(this)">

<input type="hidden" id="so_id" name="so_id" value="<?php echo $trackid;?>">
<br/>


<div id="assets" style="display:block;">
<table width="601">
 <tr><td width="158">
Subject : </td>
  <td width="154">

<input type="text" name="sub" id="sub">

</td>
<td width="64"> Client Docket Number :
<td width="199"> 
<input type="text" name="doc" id="doc" value="Opex Installation Call" readonly>

</td></tr>
<tr>

<td width="64"> Customer :
<td width="158"> 
<input type="text" name="cust" id="cust" value="<?php echo $cname[0]; ?>" readonly >

</td>


<td width="64"> PO No :
<td width="199" id="po_no"> 

<?php

$po_id = get_new_sales_order('po_trackid', $trackid);

?>
<input type="text" name="po" id="po" value="<?php echo get_po('po_no',$po_id); ?>" readonly >

</td></tr>
<?php
include_once('../class_files/select.php');
$sel_obj=new select();


?>

<tr>
<td width="115" height="35">Site ID : </td>

<td width="305" id="ref_id1" colspan="3">
    
    
    <input type="hidden" name="so_order_id" value="<?php echo $so_order_id; ?>" />
     <input type="hidden" name="trackid" id="trackid" value="<?php echo $_GET['trackid']; ?>" readonly >
    
    <input type="text" name="ref_id" id="ref_id" value="<?php echo $atmid; ?>" readonly >


</td>
</tr>

<tr><td colspan="4">
<div id="asset_div"></div>
</td></tr>


<tr>
<td height="35">Preffered Date : </td><td colspan="3"><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php echo date('d/m/Y'); ?>" /></td>
</tr>

<!---STATE wise-->

<tr>
<td height="35">State : </td>
<td colspan="3"> 
<select id="state_st" name="state_st" >
<option value="0">Select State</option>
<?php 
$sqlst=mysql_query("select * from `state`");
while($sqlst1=mysql_fetch_row($sqlst)){
?>
<option value="<?php echo $sqlst1[1]; ?>" <?php if($sqlst1[1]== get_atm('state', $trackid)) echo "selected"; ?>><?php echo $sqlst1[1]; ?></option>
<?php }?>
</select>
</td>
</tr>

<!---Branch wise-->

<tr>
<td height="35">Branch : </td>
<td colspan="3">
<select id="branch_avo" name="branch_avo">
<option value="0">Select Branch</option>
<?php 
$sqlbr=mysql_query("select * from `avo_branch`");
while($sqlbr1=mysql_fetch_row($sqlbr)){
?>
<option value="<?php echo $sqlbr1[0]; ?>" <?php if($sqlbr1[0]==get_atm('branch_id', $trackid)) echo "selected"; ?>><?php echo $sqlbr1[1]; ?></option>
<?php }?>
</select>
</td>
</tr>

<tr>
<td height="35">Requirement : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"></textarea></td>
</tr>

<tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname" value="<?php echo get_new_sales_order('user_cont_name', $trackid);?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" value="<?php echo get_new_sales_order('user_cont_phone', $trackid);?>"/></td>
</tr>

<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="checkbox" name="em" id="em" checked/><input type="text" name="cemail" id="cemail" value="<?php echo get_new_sales_order('user_mail', $trackid);?>"/></td>
</tr>
<tr>
<td height="35">CC Email : </td>
<td colspan="3"><?php
$cc=mysql_query("select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and type='service' order by c.cust_name,e.bank ASC");
?>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while($ccro=mysql_fetch_array($cc))
{
?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select><br><textarea name="ccemail" id="ccemail"  rows=5 cols=25><?php if(isset($_POST['ccemail'])){ echo $_POST['ccemail']; } ?></textarea></td>
</tr>
<tr>
<td colspan="4" height="35"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</div>
</form>

</div>
</center>
</body>
</html>
<?php  ?>