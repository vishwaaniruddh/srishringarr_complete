<?php
include("access.php");
include('config.php');
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AMC PO </title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js"
      integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script>

<script>
//====================function to get ATM id if single site-=======

function getallatm(){
	atm=document.getElementById('atmid').value;
	  
	 // alert("hi");
	  if(atm=="")
	  {
	   alert("Please enter ATM ID");
	  }
	  else
	  {
	if (window.XMLHttpRequest)				 
	  {
		  // code for IE7+, Firefox, Chrome, Opera, Safari
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
				
		allatmdata=xmlhttp.responseText;
	//	alert(allatmdata);
		
		if(allatmdata==0){
		      alert("No such ATM")
				document.getElementById('bank').focus() ;
				document.getElementById('mysub').disabled=false;
			}else{	
			  if (confirm("SIte ID Available, Are You renewing the AMC!!")) {  
			   
			data=allatmdata.split("##");
				//alert("This ATM Already Exist Please Insert Another ATM Name");
			   	document.getElementById('bank').value=data[2];
			   	document.getElementById('area').value=data[3];
			   	document.getElementById('pincode').value=data[4];
			   	document.getElementById('city').value=data[5];
			   	document.getElementById('address').value=data[6];
			   	//alert(data[6]);
			   	document.getElementById('branch_avo').value=(data[7]);
			   	document.getElementById('state').value=(data[7]);
			   	document.getElementById('mysub').disabled=false;
			   	
			   	}}
					
		}
	  }   
    		
	//alert('getatm_detail.php?atm='+atm);			  					
	xmlhttp.open("GET",'getamc_detail.php?atm='+atm, true);					
	xmlhttp.send();	
	}
	}

	



//================================
function validate1(form1){
 with(form1)
 {

if(po.value=="")
{
	alert("Please Enter PO.");
	po.focus();
	return false;
}

if(podate.value=="")
{
	alert("Please select PO date.");
	podate.focus();
	return false;
}

if(cust.value==0)
{
	alert("Please Select Customer.");
	cust.focus();
	return false;
}
if(sites.value==0)
{
	alert("Please Enter No. of Sites.");
	sites.focus();
	return false;
}

if(buyer.value==0)
{
	alert("Please Enter Buyer Name.");
	buyer.focus();
	return false;
}
if(buyer_add.value==0)
{
	alert("Please Enter Buyer Address.");
	buyer_add.focus();
	return false;
}


if(start_date.value==0)
{
	alert("Please Select Start Date.");
	start_date.focus();
	return false;
}
	
if(exp_date.value==0)
{
	alert("Please Select Expiry Date.");
	exp_date.focus();
	return false;
}
if(bill_br.value==0)
{
	alert("Please Select Billing Branch");
	bill_br.focus();
	return false;
}

if(invfile.value==0)
{
	alert("Please Attach PO/ AMC working sheet.");
	invfile.focus();
	return false;
}
//====================
if(sites.value>2) {
if(data_file.value==0)
{
	alert("Please Attach Site data Excel Sheet.");
	data_file.focus();
	return false;
}
}
//==========

if(sites.value<2) {
if(atmid.value==0)
{
	alert("Please Enter SIte/Branch/ATM/Sol ID.");
	address.focus();
	return false;
}

if(branch_avo.value=="")
{
	alert("Please Enter Branch.");
	branch_avo.focus();
	return false;
}
 var numbers = /^[0-9]+$/;
var namePattern = /^[A-Za-z()_ ]/;


if(bank.value==0)
{
	alert("Please Enter Bank Name.");
	bank.focus();
	return false;
}
if(area.value==0)
{
	alert("Please Enter Area.");
	area.focus();
	return false;
}

if(city.value==0)
{
	alert("Please Enter City.");
	city.focus();
	return false;
}
if(address.value==0)
{
	alert("Please Enter Address.");
	address.focus();
	return false;
}

if(state.value==0)
{
	alert("Please Select State.");
	state.focus();
	return false;
}
}
//================

if(oth.value==0 || othqty.value==0 || othrate.value==0){
if(ups.value==0)
{
	alert("Please Select UPS Type.");
	ups.focus();
	return false;
}
if(upsno.value==0)
{
	alert("Please Enter UPS qty.");
	upsno.focus();
	return false;
}

if(upsrate.value==0)
{
	alert("Please AMC Rate.");
	upsrate.focus();
	return false;
}
 }	
 }

 return true;
 }



//========================================Branch wise state function

function pick_state(val){
//alert(val);
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
	 document.getElementById('mystate').innerHTML = s;	
    }
  }
   
   	//alert("get_state_br.php?brid="+brid);    
	xmlhttp.open("GET","get_state_br.php?brid="+brid,true);
	xmlhttp.send();
}	



function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

</script>


</head>

<body>
<center>
<?php if($_SESSION['designation']==5){
    include("AccountManager/menubar.php");
        }else{
          include("menubar.php");  
        } ?>

<h2>Add AMC PO </h2>



<form action="process_new_amc_po.php" method="post" name="form" onSubmit="return validate1(this)" enctype="multipart/form-data">

<br/>



<table width="800">


<tr>
<td height="35" width="120"> PO No :</td>
<td width="225" id="po_no"> 
<input type="text" name="po" id="po" size="50"/></td>


<td height="35" width="120"> PO Date:</td>
<td width="225" id="po_no"> 
<input type="text" name="podate" id="podate" readonly="readonly" onclick="displayDatePicker('podate');" /></td>
</tr>

<tr>

<td height="35"> Select Customer : </td>

<? $client="select cust_id,cust_name from customer where 1";
   if($_SESSION['designation']==5){
   $cust=mysqli_query($con1,"select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)"; }
    $client.=" order by cust_name ASC"; 
?>
<td > <select name="cust" id="cust">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,$client);
while($row=mysqli_fetch_row($qry1)){
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php } ?>
</select>
</td>

<td height="35">No. of Sites: </td>
<td><input type="text" name="sites" id="sites" onkeypress="return isNumber(event)" maxlength="5"   /></td> 
</tr>

<tr>
<td height="35">Buyer Name: </td>
<td><input type="text" name="buyer" id="buyer" cols="26"></td>

<td height="35">Buyer Address: </td>
<td><textarea name="buyer_add" id="buyer_add" cols="26"></textarea></td>

</tr>
<tr>
<td height="35">Sales Person: </td>
<td><input type="text" name="saleperson" id="saleperson"  /></td>

<td height="35"><b>Preventive Maintenance:</b></td>
<td colspan=""><select name="pmtime" id="pmtime"><option value=''>Select</option>
<option value="3" >Every 3 Month</option>
<option value="6" >Every 6 Month</option>
<option value="12" >Once in a Year</option>
<option value="0" >Not Required</option>
</select></td> 
</tr>


<tr>
<td height="35" >AMC Start Date:</td>
<td > 
<input type="text" name="start_date" id="start_date" readonly="readonly" onclick="displayDatePicker('start_date');" /></td>

<td height="35"> AMC Expiry Date:</td>
<td > 
<input type="text" name="exp_date" id="exp_date" readonly="readonly" onclick="displayDatePicker('exp_date');" /></td>
</tr>

<tr>
<td height="35">Billing Cycle: </td>
<td><select name="billperiod" id="billperiod"><option value=''>Select</option>
<option value="0" >100% Advance</option>
<option value="3" >Quarterly</option>
<option value="6" >Half yearly</option>
<option value="12" >End of AMC period</option>
</select></td>


<td height="35" >AMC Value:</td>
<td><input type="text" name="value" id="value"  onkeypress="return isNumber(event)" maxlength="10"  /></td>
</tr>
<!-- =============Billing Branch===============  -->
<tr>
<td></td>
<td height="35">Billing Branch : </td>
<td>
<?php 
		$selbr="select * from avo_branch where 1";
		if($_SESSION['branch']!='all')
		$selbr.=" and id in(".$_SESSION['branch'].") ";
		$selbr.=" order by id ASC";
		$selbr2=mysqli_query($con1,$selbr)  ?>
        <select name="bill_br" id="bill_br" >
        <?php if($_SESSION['branch']=='all'){?>
        <option value="">Select</option>
        <option value="all">All Branch</option>
        <?php }
        while($branch1=mysqli_fetch_array($selbr2))  {  ?>
               <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
        <?php } ?>
        </select>
</td>

</tr>




<tr>

<th>Product</th><th>Specification</th><th>Qty</th><th>Rate</th>
</tr>

<tr>
<td height="35" width="100"><b>UPS</b></td>

<td> <select name="ups" id="ups">
<option value="0">select</option>
<?php $qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='1'");
while($row=mysqli_fetch_row($qry1))
{ ?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php } ?>
</select>
</td>

<td>
<input type="text" name="upsno"  maxlength="5" id="upsno" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
</td>

<td>
<input type="text" name="upsrate" id="upsrate" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
</td>
</tr>

<tr>
<td>
<b>Others</b>
</td>
<td colspan="1">
<textarea name="oth" id="oth" cols="26"></textarea>
</td>


<td>
<input type="text" name="othqty"  maxlength="5" id="othqty" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

</td>


<td>
<input type="text" name="othrate" id="othrate" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
</td>

</tr>

<tr>
   <th height="30" colspan="4" style="font-size:18px">
<b>If Single site: Enter below details. If Bulk sites, Proceed to attach PO & Site Excel sheet and Submit.</b>  
    </th>
</tr>


<tr>
<td height="35">Site Id(if Single site): </td>
<td><input type="text" name="atmid" id="atmid" />
<input type="button" name="getdata" id="getdata" value="GET" onclick="getallatm();" />
</td>
<td  height="35">End User/ Bank Name: </td>
<td > <input type="text" name="bank" id="bank" cols="26" /> </td>
</tr>
<tr>
<td  height="35">Area : </td>
<td>
<input type="text" name="area" id="area" cols="26" />
</td>

<td height="35">City : </td>
<td >
<input type="text" name="city" id="city" cols="26" />
</td>
</tr>

<tr>
<td  height="35">Address : </td>
<td>
<input type="text" name="address" id="address" rows="2" cols="26" /></td>

<td  height="35">Pincode: </td>
<td>
<input type="text" name="pincode" id="pincode" />
</td>

</tr>

<tr>
<td height="35">Branch : </td>
<td>

<?php 
		$selbr="select * from avo_branch where 1";
		if($_SESSION['branch']!='all')
		$selbr.=" and id in(".$_SESSION['branch'].") ";
		
	 	$selbr.=" order by id ASC";
		//echo $selbr;
		$selbr2=mysqli_query($con1,$selbr)
		?>
        <select name="branch_avo" id="branch_avo" onchange="pick_state(this.value);">
        
		<?php if($_SESSION['branch']=='all'){?>
        <option value="">Branch</option>
        <?php }?>
        
		<?php
        
        while($branch1=mysqli_fetch_array($selbr2))
        {
        ?>
        <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
        <?php
        }
        ?>
        </select>

</td>

<td  height="35">State : </td>
<td>
<div id="mystate">

<?php

$stqry="select state,state_id from state where 1";

	if($_SESSION['branch']!='all')
	$stqry.=" and branch_id= '".$_SESSION['branch']."'";
	//echo $stqry;
?>
<?php
	$stqry="select state,state_id from state where 1";
	if($_SESSION['branch']!='all')
	$stqry.=" and branch_id= '".$_SESSION['branch']."'";
	
	?>
	<select name="state" id="state" >
	<option value="0">-select State-</option>
	<?php
	$stateqry=mysqli_query($con1,$stqry);
	while($sttro=mysqli_fetch_array($stateqry))
	{
	?>
    <option value="<?php echo $sttro[0]; ?>"><?php echo $sttro[0]; ?></option>
    <?php
	}
	?>
     </select>
     
</div>
</td>
</tr>

<tr>
  <td height="35">
  Upload PO:
  </td>
  
  
  <td>
  <input type="file" name="invfile" id="invfile" required />
  </td>
   <td>
  AMC site Data(if Bulk)
  </td>
  
  <td>
  <input type="file" name="data_file" id="data_file" />
  </td>
</tr>


<tr>
<td></td>

<td colspan="1" style="center" height="35"><input type="submit" name="cmdsubmit" value="submit" class="readbutton" id="mysub"  /></td>
<td></td> <td></td>
</tr>  
</table>

</form>


</center>
</body>
</html>