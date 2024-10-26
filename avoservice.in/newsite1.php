<?php
//include("access.php");
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<style>
.space{margin-left:80px;}
.addcolor{font-size:20px; color:#C60000; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
</style>
<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<script src="jquery-1.8.3.js"></script>

<script type="text/javascript">

//=============================start send assets=====================================
function sendAssets(){
				//start here sending data
				 //alert("hi2");
				document.getElementById("mysub").disabled = true;
				if (window.XMLHttpRequest)				 
				  {
					  // code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				  }
				   
				  nos=document.getElementById('nos').value;
				  //alert(nos); 
				  cust=document.getElementById('cust').value;
                                        //alert("customer id"+cust);
         		  
				  servicetype=document.getElementById('servicetype').value;
				  po=document.getElementById('po').value;
				  podt=document.getElementById('podt').value;
				  saleperson=document.getElementById('saleperson').value;
				  atm=document.getElementById('atm').value;
				  bank=document.getElementById('bank').value;
				  area=document.getElementById('area').value;
				  pin=document.getElementById('pin').value;
				  city=document.getElementById('city').value;
				  state=document.getElementById('state').value;
				  site_branch=document.getElementById('site_branch').value;
				  address=document.getElementById('address').value;
				  address_clean = encodeURIComponent(address);
				 
				  ups=document.getElementById('ups').value;
				  upsno=document.getElementById('upsno').value;
				  upswr=document.getElementById('upswr').value;
				   upswrexp=document.getElementById('upswrexp').value;
				  upsrate=document.getElementById('upsrate').value;
				 
						 oth=document.getElementById('oth').value;
						 othqty=document.getElementById('othqty').value;
						 othwr=document.getElementById('othwr').value;
						 othexp=document.getElementById('othexp').value;
						 othrate=document.getElementById('othrate').value;
						 nos=document.getElementById('nos').value;
						 
						 baddt=document.getElementById('badd').value;
                                                 badd_= encodeURIComponent(baddt);
						 gst_=document.getElementById('gst').value;
						 contact_=document.getElementById('contact').value;
						 contactno_=document.getElementById('contactno').value;
						
			if(upsno>0 || othqty>0)	
			{
					var url = "test_process_newsiteme.php";		
					var params='cust='+cust+'&servicetype='+servicetype+'&po='+po+'&atm='+atm+'&bank='+bank+'&area='+area+'&pin='+pin+'&city='+city+'&state='+state+'&address='+address_clean+'&badd='+badd_+'&gst='+gst_+'&cont='+contact_+'&cno='+contactno_+'&ups='+ups+'&upsno='+upsno+'&upswr='+upswr+'&upsrate='+upsrate+'&oth='+oth+'&othqty='+othqty+'&othwr='+othwr+'&othexp='+othexp+'&othrate='+othrate+'&nos='+nos+'&site_branch='+site_branch+'&ubrate='+ubrate+'&podt='+podt+'&saleperson='+saleperson;
					//alert(params);
					
					xmlhttp.open("POST",url, true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send(params);
					}
					else alert("Please enter at least one asset");
			}
	

//=========================Form validation

function validate(form)
{
			with(form)
				{
				//==================================
			
			var regularExpression = /^[a-zA-Z0-9@#$&()`.+,_/"-]*$/;
			
		
					
				//==============================================
				if(cust.value=="0" || cust.value=="")
				{
				alert("Please Select Customer Name.");
				cust.focus();
				return false;
				}
				
				//==============================================
				if(servicetype.value=="")
				{
				alert("Please Select Preventive maintenance.");
				servicetype.focus();
				return false;
				}
				//==============================================
				if(po.value=="")
				{
				alert("Please Enter Purchase Order.");
				po.focus();
				return false;
				}
				//==============================================
			
			
			
				if(upsno.value=='0')

				{
				alert("Please Select UPS Quantitiy And Warranty.");
				//upsno.focus();
				return false;
				}
			
				//==============================================
				if(bank.value=="")
				{
				alert("Please Enter Bank Name.");
				bank.focus();
				return false;
				}
				//==============================================
				if(atm.value=="")
				{
				alert("Please Enter ATMID.");
				atm.focus();
				return false;
				}
				//==============================================
				if(area.value=="")
				{
				alert("Please Enter Area.");
				area.focus();
				return false;
				}
				//==============================================
				
				if(city.value=="")
				{
				alert("Please Enter City.");
				city.focus();
				return false;
				}
				//==============================================
				if(site_branch.value=="")
				{
				alert("Please Select Branch.");
				site_branch.focus();
				return false;
				}
				//==============================================
				
				if(address.value=="")
				{
				alert("Please Enter Address.");
				address.focus();
				return false;
				}
				//==============================================
				if(state.value=="")
				{
				alert("Please Select State.");
				state.focus();
				return false;
				}
				
				siteexist();
							
		}
}


	
// ==============does site exist
function siteexist(){
	atm=document.getElementById('atm').value;
	  //alert("hi");
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
		//alert(allatmdata);
		data=allatmdata.split("##");
				
				if(data[0]==2){
				alert("The site already exist in AMC database. You Want to renew ?");                                 
				}
								
				else{
			//============================================== here we call function sendAssets ===============================	
			sendAssets();	
			       }	
		}
	  }   
    		
	atm=atm;
	//alert('getatm_detail.php?atm='+atm);			  					
	xmlhttp.open("GET",'getamc_detail.php?atm='+atm, true);					
	xmlhttp.send();	
	
    
    
}	
// ==================================================================== GET ATM ID FROM ATM TABLE

	function getallatm(){
	atm=document.getElementById('atmid').value;
	  //alert("hi");
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
		//alert(allatmdata);
		
		if(allatmdata==0){
		      alert("No such ATM")
				document.getElementById('bank').focus() ;
				document.getElementById('mysub').disabled=false;
			}else{				
			data=allatmdata.split("##");
				//alert("This ATM Already Exist Please Insert Another ATM Name");
			   	document.getElementById('bank').value=data[1];
			   	document.getElementById('area').value=data[2];
			   	document.getElementById('pin').value=data[3];
			   	document.getElementById('city').value=data[4];
			   	//alert(data[6]);
			   	document.getElementById('site_branch').value=(data[5]);
			   	document.getElementById('state').value=(data[6]);
			   	document.getElementById('mysub').disabled=false;
			   	
			   	}
					
		}
	  }   
    		
	atm=atm;
	//alert('getatm_detail.php?atm='+atm);			  					
	xmlhttp.open("GET",'getamc_detail.php?atm='+atm, true);					
	xmlhttp.send();	
	}
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
		
	
</script>
</head>
<body>
<center>
<?php 


    

include("menubar.php");  
include("config.php"); 

$oldpo=mysqli_query($con1,"select `po` from `atm` where 1 ");
$oldpo1=mysqli_fetch_row($oldpo);

?>
 <h2 class="h2color">Add AMC PO & SO</h2>

<form action="" method="post" enctype="multipart/form-data"  name="form" id="form" >
<table width="60%">

<tr>
<td width="50" height="35"><b class="addcolor">Purchase Order:</b></td>
<td width="50"><input type="text" name="po" id="po" onblur="getpo();" /></td>

<td width="50" height="35"><b>PO Date :</b></td>
<td width="50"><input type="text" name="podt" id="podt" onclick="displayDatePicker('podt')" value="<?php echo date('d/m/Y'); ?>"/></td>

</tr> 

<tr>
<td height="35"><b>Preventive Maintenance:</b></td>
<td colspan=""><select name="servicetype" id="servicetype"><option value=''>Select</option>
<option value="3" >Every 3 Month</option>
<option value="6" >Every 6 Month</option>
<option value="12" >Once in a Year</option>
<option value="0" >Not Required</option>


</select></td> 


<td width="50"> <b> Select Vertical Customer Name <b> </td>
    <td>
    <?php
	$client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==5){
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysqli_query($con1,"select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')");
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC";
    //echo $client;
    ?>
    	<select name="cust" id="cust" onchange="searchById('Listing','1','');"> <?php if($_SESSION['designation']!=5){ ?>
            <option value="0">Select Client</option><?php }
            $cl=mysqli_query($con1,$client);
            while($clro=mysqli_fetch_row($cl))
            {
            ?>
            <option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
		<?php } ?>
        </select>
 	</td>

</tr> 

<tr>

<td rowspan="2">Buyers name with address</td>

<td rowspan="2"><textarea name="badd" id="badd" rows="4" cols="28" /></textarea></td>
<td>Buyers GST No.</td><td><input type="text" name="gst" id="gst" /></td>
</tr> <tr>
<td>Sales Person</td><td><input type="text" name="saleperson" id="saleperson" /></td>
</tr>


<tr>
<td width="50" height="35"><b class="addcolor">No Of Sites:</b></td>
<td width="50"><input type="number" name="sites" id="sites" ></td>
<td></td>
</tr>

<div id="allassets">
<!--====UPS==================-->
<tr>
<td colspan="4" >
<!---============table start for  assests==========================-->
<table width="80%" bordercolor="#000" border="2">
<tr>
<td height="35" width="100">
<b>UPS</b>
</td>

<td> <select name="ups" id="ups">
<option value="0">select</option>
<?php
$qry1=mysqli_query($con1,"Select * from assets_specification where assets_id='1'");
while($row=mysqli_fetch_row($qry1))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[2]; ?></option>
<?php
}
?>

</select>
</td>
<td width="50">
<span class="space">Qty</span>:
</td>
<td>
<input type="text" name="upsno"  maxlength="3" id="upsno" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

</td>


<td width="50" id="war1">
<span class="space">Start:</span>
</td>

<td id="war">
<input type="text" name="upswr" id="upswr" onclick="displayDatePicker('upswr')"/></td>
</td>
<!--     AMC expiry Date---->
<td width="50">
<span class="space">Expiry: </span>
</td>
<td >
<input type="text" name="upswrexp" id="upswrexp" onclick="displayDatePicker('upswrexp')"/></td>
</td>

<td width="50">
<span class="space">Rate: </span>
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
<textarea name="oth" id="oth" cols="50"></textarea>
</td>

<td width="50">
<span class="space">Qty</span>:
</td>
<td>
<input type="text" name="othqty"  maxlength="3" id="othqty" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

</td>

<td width="50" id="war2">
<span class="space">Start:</span>
</td>

<td >
<input type="text" name="othwr" id="othwr" onclick="displayDatePicker('othwr')"/></td>
</td>
<!--     AMC expiry Date---->
<td width="50">
<span class="space">Expiry: </span>
</td>
<td >
<input type="text" name="othexp" id="othexp" onclick="displayDatePicker('othexp')"/></td>
</td>

<td width="50">
<span class="space">Rate: </span>
</td>
<td>
<input type="text" name="othrate" id="othrate" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
</td>

</tr>


</table>
<!-- =====================TABLE END FOR ASSESTS=======================================================-->
</td> </tr>
</div>





<tr><td colspan="4"style="center"> <h2 class="h2color">Enter End user Details if Single site AMC</h2></td>
   
</tr>
<tr>

<td width="100" height="35"><b>End User Name :</b></td>
<td width="200"><input type="text" name="bank" id="bank" /></td>
<td width="100" height="35"><b>Site/Sol/ATM ID:</b></td>
<td width="200"><input type="text" name="atm" id="atm" />
                <input type="button" name="getdata" id="getdata" value="GET" onclick="getallatm();" /></td>
<!--<td>Indent No: </td><td><input type="text" name="indentno" id="indentno" /></td>-->
</tr>


<tr>
<td width="100" height="35"><b>Area :</b></td>
<td width="200"><input type="text" name="area" id="area" /></td>
<td width="100" height="35"><b>Pincode:</b></td>
<td width="200" colspan="1"><input type="text" name="pin" id="pin" onkeypress="return isNumber(event)"/></td>
<!--<td>Indent Date: </td><td><input type="text" name="indentdate" id="indentdate" onclick="displayDatePicker('indentdate');"/></td>-->
</tr>

<tr>

</tr>

<tr>
<td width="100" height="35"><b>City : </b></td>
<td width="200">
<input type="text" name="city" id="city"  />
</td>

<td width="100" height="35"><b>Branch :</b> </td>
<td width="200" colspan="">
<select name="site_branch" id="site_branch" onchange="pick_state(this.value);">
<option value="">Select Branch</option>
<?php 
$sqlbr=mysqli_query($con1,"select * from `avo_branch`");
while($sqlbr1=mysqli_fetch_row($sqlbr)){
?>
<option value="<?php echo $sqlbr1[0]; ?>"><?php echo $sqlbr1[1]."-".$sqlbr1[0]; ?></option>
<?php } ?>
</select>
</td>


</tr>

<tr>
<td width="100" height="35"><b>Address :</b> </td>
<td width="200" colspan="">
<textarea name="address" id="address" rows="4" cols="28" /></textarea>
</td>

<td width="100" height="35"><b>State : </b></td>
<td width="200">
<div id="mystate">
<!--<input type="text" name="state" id="state" onblur="filladd(this);" />-->
<select name="state" id="state" onchange="filladd(this);">
<option value="">Select State</option>
<?php
$state=mysqli_query($con1,"select * from state order by state ASC");
while($stro=mysqli_fetch_array($state))
{
?>
<option value="<?php echo $stro[1]; ?>"><?php echo $stro[1]; ?></option>
<?php
}
?>
</select>
</div>
</td>


</tr>
<tr>
<td width="100" height="35"><b>Contact Person :</b> </td>
<td width="200" colspan="">
<input type="text" name="contact" id="contact" />
</td>

<td width="100" height="35"><b>Contact No.: </b></td>
<td width="200">
<input type="text" name="contactno" id="contactno" onkeypress="return isNumber(event)" maxlength="10" /></td>
</tr>


<tr>

<td colspan="4" align="center" height="50"><div id="search"><button type="button" name="mysub" id="mysub" disabled="true" onclick="validate(this.form); " class="readbutton" value=""> Submit </button></div> </td> 
</tr>
</table>
</form>
</center>
</body>
</html>