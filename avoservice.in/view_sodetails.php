<?php
include("access.php");
$poid=$_GET['id'];


$typch="";

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
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
<script>
$(document).ready(function(){
$('#bb1').hide();
$('#bbr1').hide();
$('#bb2').hide();
$('#bbr2').hide();
$('#bb3').hide();
$('#bbr3').hide();
$('#bb4').hide();
$('#bbr4').hide();
$('#bb5').hide();
$('#bbr5').hide();
$('#type2').click(function(){
$('#war1').hide();
$('#war').hide();
$('#war2').hide();
$('#w1').hide();
$('#war3').hide();
$('#w2').hide();
$('#war4').hide();
$('#w3').hide();
$('#war5').hide();
$('#w4').hide();
$('#bb1').show();
$('#bbr1').show();
$('#bb2').show();
$('#bbr2').show();
$('#bb3').show();
$('#bbr3').show();
$('#bb4').show();
$('#bbr4').show();
$('#bb5').show();
$('#bbr5').show();
});
$('#type').click(function(){
$('#war1').show();
$('#war').show();
$('#war2').show();
$('#w1').show();
$('#war3').show();
$('#w2').show();
$('#war4').show();
$('#w3').show();
$('#war5').show();
$('#w4').show();
$('#bb1').hide();
$('#bbr1').hide();
$('#bb2').hide();
$('#bbr2').hide();
$('#bb3').hide();
$('#bbr3').hide();
$('#bb4').hide();
$('#bbr4').hide();
$('#bb5').hide();
$('#bbr5').hide();

});
});
</script>

<script type="text/javascript">

//=============================start send assets=====================================
function sendAssets(){
				//start here sending data
				// alert("hi2");
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
				  xmlhttp.onreadystatechange=function()
				  {
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
					alert(xmlhttp.responseText);
					
					if(xmlhttp.responseText==""){
						document.getElementById("mysub").innerHTML ="<center><img src=ajax-loader.gif></center>";
						}
						
					str=xmlhttp.responseText;
					str2=str.split("**##");
					//alert("hi");
					//alert("value of response o or 1="+str2[0]);
					if(str2[0]==1){	
							document.getElementById('atm').value="";
							document.getElementById('area').value="";
							document.getElementById('pin').value="";
							document.getElementById('city').value="";
							document.getElementById('address').value="";
							//document.getElementById('bank').value="";
							document.getElementById('state').value=""; 
							document.getElementById('addsite').value=str2[1];
							
							//alert("Data is not uploaded successfully");					
						alert("Data uploaded successfully");
						document.getElementById("mysub").disabled = false;
						}else{
							
							alert("Data not uploaded successfully");
							document.getElementById("mysub").disabled = false;
							}
					
					}
				  }   
				  nos=document.getElementById('nos').value;
				  //alert(nos); 
				  cust=document.getElementById('cust').value;
                            if (document.getElementById('type').checked) {
                          type = document.getElementById('type').value;
                            }
                          if (document.getElementById('type2').checked) {
                          type = document.getElementById('type2').value;
                            }

				  
				  servicetype=document.getElementById('servicetype').value;
				  po=document.getElementById('po').value;
				  atm=document.getElementById('atm').value;
				  bank=document.getElementById('bank').value;
				  area=document.getElementById('area').value;
				  pin=document.getElementById('pin').value;
				  city=document.getElementById('city').value;
				  state=document.getElementById('state').value;
				  site_branch=document.getElementById('site_branch').value;
				  address=document.getElementById('address').value;
				  address_clean = encodeURIComponent(address);
				  ref=document.getElementById('ref').value;
				  dt=document.getElementById('dt').value;
				  ups=document.getElementById('ups').value;
				  upsno=document.getElementById('upsno').value;
				  upswr=document.getElementById('upswr').value;
				  upsrate=document.getElementById('upsrate').value;
				  btry=document.getElementById('btry').value;
				  btryno=document.getElementById('btryno').value;
				  btrywr=document.getElementById('btrywr').value;
				  batteryrate=document.getElementById('batteryrate').value;
				   isot=document.getElementById('isot').value;
					isotno=document.getElementById('isotno').value;
					 isotwr=document.getElementById('isotwr').value;
					  isotrate=document.getElementById('isotrate').value;
					   stab=document.getElementById('stab').value;
						stabno=document.getElementById('stabno').value;
						 stabwr=document.getElementById('stabwr').value;
						 stabrate=document.getElementById('stabrate').value;
						 avr=document.getElementById('avr').value;
						 avrno=document.getElementById('avrno').value;
						 avrwr=document.getElementById('avrwr').value;
						 avrrate=document.getElementById('avrrate').value;
						 nos=document.getElementById('nos').value;
						 del_type=document.getElementById('del_type').value;
						 if(document.getElementById('ed').checked==true)
						 ed=1;
						 else
						 ed=0;
						// alert(ed);
						 ubrate=document.getElementById('upsbbrate').value;
						 batbrate=document.getElementById('batbbrate').value;
						 isobrate=document.getElementById('isobbrate').value;
						 stbrate=document.getElementById('stbbrate').value;
						 avbrate=document.getElementById('avrbbrate').value;
						 oth=document.getElementById('oth').value;
						 othrate=document.getElementById('othrate').value;
				
					var url = "process_newsiteme_new.php";		
					var params='cust='+cust+'&type='+type+'&servicetype='+servicetype+'&po='+po+'&atm='+atm+'&bank='+bank+'&area='+area+'&pin='+pin+'&city='+city+'&state='+state+'&address='+address_clean+'&ref='+ref+'&dt='+dt+'&ups='+ups+'&upsno='+upsno+'&upswr='+upswr+'&upsrate='+upsrate+'&btry='+btry+'&btryno='+btryno+'&btrywr='+btrywr+'&batteryrate='+batteryrate+'&isot='+isot+'&isotno='+isotno+'&isotwr='+isotwr+'&isotrate='+isotrate+'&stab='+stab+'&stabno='+stabno+'&stabwr='+stabwr+'&stabrate='+stabrate+'&avr='+avr+'&avrno='+avrno+'&avrwr='+avrwr+'&avrrate='+avrrate+'&nos='+nos+'&site_branch='+site_branch+'&deltype='+del_type+'&ed='+ed+'&ubrate='+ubrate+'&batbrate='+batbrate+'&isobrate='+isobrate+'&stbrate='+stbrate+'&avbrate='+avbrate+'&oth='+oth+'&othrate='+othrate;
					//alert(params);
					xmlhttp.open("POST",url, true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send(params);
			}
	

//=========================Form validation
//
function validate(form)
{
			with(form)
				{
				//==================================
				if(addsite.value == nos.value )
				{
				alert("You have completed " +nos.value+ " site against Purchase Order.");
				document.getElementById('ups').disabled=true;
				document.getElementById('upsno').disabled=true ;
				document.getElementById('upswr').disabled=true ;
				document.getElementById('upsrate').disabled=true ;
				
				document.getElementById('btry').disabled=true ;
				document.getElementById('btryno').disabled=true ;
				document.getElementById('btrywr').disabled=true ;
				document.getElementById('batteryrate').disabled=true ;
				
				document.getElementById('isot').disabled=true ;
				document.getElementById('isotno').disabled=true ;
				document.getElementById('isotwr').disabled=true ;
				document.getElementById('isotrate').disabled=true ;
				
				document.getElementById('stab').disabled=true ;
				document.getElementById('stabno').disabled=true ;
				document.getElementById('stabwr').disabled=true ;
				document.getElementById('stabrate').disabled=true ;
				
				document.getElementById('avr').disabled=true ;
				document.getElementById('avrno').disabled=true ;
				document.getElementById('avrwr').disabled=true ;
				document.getElementById('avrrate').disabled=true ;
						
				return false;
				}	
				//==============================================
				if(cust.value=="0")
				{
				alert("Please Select Customer Name.");
				cust.focus();
				return false;
				}
				//if(ed.checked==true)alert("1");
				//else alert("0");
				//==============================================
				if(servicetype.value=="")
				{
				alert("Please Select Primitive maintenance.");
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
				if(ref.value=="")
				{
				alert("Please Enter Reference ID.");
				ref.focus();
				return false;
				}
				//==============================================
				if(nos.value=="" || nos.value<1 )
				{
				alert("Please Enter Atleast 1 Site.");
				nos.focus();
				return false;
				}
				//==============================================
				if(ups.value >0 && type.value=='sales')
				{ 
				if(upsno.value=='0' || upswr.value=='0')

				{
				alert("Please Select UPS Quantitiy And Warranty.");
				//upsno.focus();
				return false;
				}
				}
                               if(ups.value >0 && type.value=='AMC')
				{ 
				if(upsno.value=='0')

				{
				alert("Please Select UPS Quantitiy ");
				//upsno.focus();
				return false;
				}
				}
				//==============================================
				if(btry.value >0 && type.value=='sales')
				{ 
				if(btryno.value=='0' && btrywr.value=='0')
				{
				alert("Please Select Battery Quantitiy And Warranty.");
				//btryno.focus();
				return false;
				}
				}
                                if(btry.value >0 && type.value=='AMC')
				{ 
				if(btryno.value=='0')
				{
				alert("Please Select Battery Quantitiy");
				//btryno.focus();
				return false;
				}
				}
				//==============================================
				if(isot.value >0 && type.value=='sales')
				{ 
				if(isotno.value=='0' || isotwr.value=='0')
				{
				alert("Please Select Isolation Transformer Quantitiy And Warranty.");
				//isotno.focus();
				return false;
				}
				}
                                if(isot.value >0 && type.value=='AMC')
				{ 
				if(isotno.value=='0')
				{
				alert("Please Select Isolation Transformer Quantitiy");
				//isotno.focus();
				return false;
				}
				}
				//==============================================
				if(stab.value >0 && type.value=='sales')
				{ 
				if(stabno.value=='0' || stabwr.value=='0')
				{
				alert("Please Select Stabilizer Quantitiy And Warranty.");
				//stabno.focus();
				return false;
				}				
				}
                                if(stab.value >0 && type.value=='AMC')
				{ 
				if(stabno.value=='0')
				{
				alert("Please Select Stabilizer Quantitiy");
				//stabno.focus();
				return false;
				}				
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
				if(pin.value=="")
				{
				alert("Please Enter Pincode.");
				pin.focus();
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
				
				
				
				
			//============================================== here we call function sendAssets ===============================	
			sendAssets();					
		}
}

//==================get DATA FROM PURCHASE_ORDER ===============================================

function getpo(){
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
		//alert(xmlhttp.responseText);
	
		response=xmlhttp.responseText;
		response2=response.split("**##");
		//alert('index1='+response2[0]);
		//alert('index2='+response2[1]);
		//alert('index3='+response2[2]);
		if(response2[2]==-1){
		document.getElementById('nos').readOnly;		
		document.getElementById('addsite').value=response2[0];
		document.getElementById('bank').value=response2[1];
		document.getElementById('nos').value="";
		//document.getElementById('nos').readOnly=true;
		document.getElementById('cust').value=response2[3];
		document.getElementById('ref').value="";
		document.getElementById('servicetype').value=response2[5];
		//alert(response2[6]);
		}else{
			document.getElementById('nos').readOnly;		
			document.getElementById('addsite').value=response2[0];
			document.getElementById('bank').value=response2[1];
			document.getElementById('nos').value=response2[2];
			//document.getElementById('nos').readOnly=true;
			document.getElementById('cust').value=response2[3];
			document.getElementById('ref').value=response2[4];
			document.getElementById('servicetype').value=response2[5];
				
			}
			//yy=document.getElementById('addsite').value;	
			//alert(response2[6]);		
			if(response2[6]="undefined"){
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			today = dd+'/'+mm+'/'+yyyy;
			//alert(today);
			dd=document.getElementById('dt').value=today;
			}else{						
			ndd=document.getElementById('dt').value=response2[6];
		//alert("ndd="+str2[6]);
			}
			
			if(response2[2]==-1){
			//alert("in disable = false");	
			document.getElementById('nos').disabled=false;
			document.getElementById('ref').disabled=false;
			document.getElementById('servicetype').disabled=false;
			document.getElementById('cust').disabled=false;		
			}else{
				//alert("in disable = true");
				document.getElementById('nos').disabled=true;
				document.getElementById('ref').disabled=true;
				document.getElementById('servicetype').disabled=true;
				document.getElementById('cust').disabled=true;
				}
		
		
		
		
		    //alert("str2[6]="+str2[6]);
			
			response3=response2[7].split("****");
			//alert(str3);
			
			for(i=0;i<response3.length ;i++){
				
					if(response3[i]=='UPS'){
						document.getElementById('ups').value=response3[i+1];
						document.getElementById('upsno').value=response3[i+2];
						document.getElementById('upswr').value=response3[i+3];
						document.getElementById('upsrate').value=response3[i+4];
					}
					if(response3[i]=='Battery'){
						document.getElementById('btry').value=response3[i+1];
						document.getElementById('btryno').value=response3[i+2];
						document.getElementById('btrywr').value=response3[i+3];
						document.getElementById('batteryrate').value=response3[i+4];
					}
					if(response3[i]=='Isolation Transformer'){
						document.getElementById('isot').value=response3[i+1];
						document.getElementById('isotno').value=response3[i+2];
						document.getElementById('isotwr').value=response3[i+3];
						document.getElementById('isotrate').value=response3[i+4];
					}
					if(response3[i]=='Stabilizer'){
						document.getElementById('stab').value=response3[i+1];
						document.getElementById('stabno').value=response3[i+2];
						document.getElementById('stabwr').value=response3[i+3];
						document.getElementById('stabrate').value=response3[i+4];
					}
					if(response3[i]=='AVR'){
						document.getElementById('avr').value=response3[i+1];
						document.getElementById('avrno').value=response3[i+2];
						document.getElementById('avrwr').value=response3[i+3];
						document.getElementById('avrrate').value=response3[i+4];
					}
				}
		}
	  }   
    		
	newpo=document.getElementById('po').value;
	//alert('getpo_detail.php?po='+newpo);			  					
	xmlhttp.open("GET",'getpo_detail.php?po='+newpo, true);					
	xmlhttp.send();	
	}
	
// ==================================================================== GET ATM ID FROM ATM TABLE

	function getallatm(atm){
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
		if(allatmdata==0){
				document.getElementById('area').focus() ;
			}else{				
				alert("This ATM Allready Exist Please Insert Another ATM Name");
			   	document.getElementById('atm').value="" ;
			   //document.getElementById('atm').focus() ;
				}
					
		}
	  }   
    		
	atm=atm
	//alert('getatm_detail.php?atm='+atm);			  					
	xmlhttp.open("GET",'getatm_detail.php?atm='+atm, true);					
	xmlhttp.send();	
	}
	
	//=================================================
	function addnsite(){
		document.getElementById('atm').value="" ;
		
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
		
	function enableamc(){
	//alert("hi");
	document.getElementById('type2').disabled=false ;
	
	}
</script>
</head>
<body>
<center>
<?php include("menubar.php");
include("config.php"); 
$qrypo=mysqli_query($con1,"select * from pending_installations where id='".$poid."'");
$fetchqrypo=mysqli_fetch_array($qrypo);
$tab=mysqli_query($con1,"select buyeraddress,gst,po_date,salesperson,pm from purchase_order where po_no='".$fetchqrypo[2]."'");	
	$row1=mysqli_fetch_row($tab);
?>
<h2 class="h2color">VIEW SO DETAILS</h2>

<form action="" method="post" enctype="multipart/form-data"  name="form" id="form" >
<input type="hidden" name="poid" id="po" value="$_GET['id'];" />
<table width="100%">
<tr>
<td width="200" height="35"><b class="addcolor">Purchase Order :</b></td>
<td width="200"><input type="text" style="width:200px" name="po" id="po" value="<?php echo $fetchqrypo[2];?>" readonly/></td>
 


	<td width="300" height="35"><b>Select Site Type</b></td>
	<td width="" colspan="2">	
	<select name="del_type" id="del_type" onchange="enableamc()" disabled="disabled"><option value="ware_del" <?php if($fetchqrypo[6]=='ware_del'){echo "selected";}?> >Warehouse Delivery</option>
	                         <option value="site_del" <?php if($fetchqrypo[6]=='site_del'){echo "selected";}?> >Site Delivery</option>
	                         </select>
 </td>
</tr>
<tr>
<td width="200" height="35"><b>PO Date :</b></td>
<td width="200"><input type="text" style="width:200px" name="podt" id="podt" value="<?php echo $row1[2];?>" readonly/></td>



	<td width="300" height="35"><b>Select Delivery Type</b></td>
	<td width="" colspan="2">
<input type="radio" name="type" id="type" value="sales"  class="type" <?php if($fetchqrypo[7]=='sales'){echo "checked"; $typch="atm";}?> disabled="disabled"/>Sales Site
	
  <input type="radio" name="type" id="type2" value="AMC" class="type"   <?php if($fetchqrypo[7]=='AMC'){echo "checked";$typch="Amc";}?> disabled="disabled"/>AMC Site	
	
 </td>
</tr>

<tr>
</td>
</tr>

<tr>
<td height="35"><b>Primitive Maintenance:</b></td>
<td colspan=""><select name="servicetype" id="servicetype" disabled="disabled"><option value=''>Select</option>
<option value="3" <?php if($row1[4]=='3'){echo "selected";}?> >Every 3 Month</option>
<option value="6" <?php if($row1[4]=='6'){echo "selected";}?>>Every 6 Month</option>

</select></td>

<td width="200"> <b> Customer Name <b> </td>
    <td>
    <?php
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$fetchqrypo[3]."'");
	$custrow=mysqli_fetch_row($qry);
    //echo $client;
    echo $custrow[0];
    ?>
    	
 	</td>


</tr>
<tr>
<td rowspan="2">Buyers name with address</td><td rowspan="2"><?php echo $row1[0]; ?></td>
<td>Buyers GST No.</td><td><?php echo $row1[1]; ?></td></tr>
<tr><td>Sales Person</td><td><?php echo $row1[3]; ?></td>
</tr>

<tr>

<!--<td>Bom No: </td><td><input type="text" name="bomno" id="bomno" /></td>-->
</tr>



<tr>


<!--<td>VAT: </td><td><input type="text" name="vat" id="vat" /></td>-->
</tr>

<tr>
<td width="100" height="35"><b>DO. No.:</b></td>
<td width="200"><input type="text" name="ref" id="ref" value="<?php echo $fetchqrypo[5];?>" readonly/></td>
<td width="100" height="35"><b>DO Date:</b></td>
<td width="200"><input type="text" name="dt" id="dt" value="<?php echo $fetchqrypo[4]; ?>" readonly/></td>

<!--<td>Document no : </td><td><input type="text" name="dono" id="dono" /></td>-->
</tr>

<tr>
<td width="100" height="35"></td>
<td width="200"></td>

<td width="100" height="35"></td>
<td width="200"></td>
<!--<td>Freight Charges: </td><td><input type="text" name="freight" id="freight" /></td>-->
</tr>

<div id="allassets">
<!--====UPS==================-->
<tr>
<td colspan="4" >
<!---============table start for  assests==========================-->
<?php $qryassests=mysqli_query($con1,"select * from po_assets where po_no='".$fetchqrypo[2]."'");
//echo "select * from po_assets where po_no='".$fetchqrypo[2]."'";

//echo "select * from po_assets where po_no='".$fetchqrypo[0]."'";
?>

<table width="100%" bordercolor="#000" border="2">
<?php
while($row=mysqli_fetch_row($qryassests))
{
 if($row[1]=="UPS")
 {
  $qry1=mysqli_query($con1,"Select name from assets_specification where ass_spc_id='".$row[2]."'");
  $rowx=mysqli_fetch_row($qry1);
?>
<tr>
<td width="200">
<b>UPS</b>
</td>
<td>
<?php
echo $rowx[0];
?>
</td>
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<?php
 echo $row[3];
?>
</td>
<td width="50" id="war1">
<span class="space">Warranty:</span>
</td>
<td id="war">
<?php
 echo $row[4];
?>
</td>
<td width="50">
<span class="space">Rate: </span>
</td>
<td>
<?php echo $row[5]; ?>
</td>
<td id="bb1">
<span class="space">BuyBack:</span> 
</td>
<td id="bbr1">
<input type="text" name="upsbbrate" id="upsbbrate" />
</td>

</tr>
<?php } 
else if($row[1]=="Battery")
 {
  $qry1=mysqli_query($con1,"Select name from assets_specification where ass_spc_id='".$row[2]."'");
  $rowx=mysqli_fetch_row($qry1);
?>
<tr>
<td><b>Battery</b></td>
<td>
<?php
echo $rowx[0];
?>
</td>
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<?php
 echo $row[3];
?>
</td>
<td width="50" id="war1">
<span class="space">Warranty:</span>
</td>
<td id="war">
<?php
 echo $row[4];
?>
</td>
<td width="50">
<span class="space">Rate: </span>
</td>
<td>
<?php echo $row[5]; ?>
</td>
<td id="bb2">
<span class="space">BuyBack:</span> 
</td>
<td id="bbr2">

<input type="text" name="batbbrate" id="batbbrate" />
</td>

</tr>
<?php } 
else if($row[1]=="Isolation Transformer")
 {
  $qry1=mysqli_query($con1,"Select name from assets_specification where ass_spc_id='".$row[2]."'");
  $rowx=mysqli_fetch_row($qry1);
?>
<tr>
<td> <b>Isolation Transformer</b> </td>

<td>
<?php
echo $rowx[0];
?>
</td>
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<?php
 echo $row[3];
?>
</td>
<td width="50" id="war1">
<span class="space">Warranty:</span>
</td>
<td id="war">
<?php
 echo $row[4];
?>
</td>
<td width="50">
<span class="space">Rate: </span>
</td>
<td>
<?php echo $row[5]; ?>
</td>
<td id="bb3">
<span class="space">BuyBack:</span> 
</td>
<td id="bbr3">

<input type="text" name="isobbrate" id="isobbrate" />
</td>

</tr>
<?php } 
else if($row[1]=="Stabilizer")
 {
  $qry1=mysqli_query($con1,"Select name from assets_specification where ass_spc_id='".$row[2]."'");
  $rowx=mysqli_fetch_row($qry1);
?>

<tr>
<td> <b> Stabilizer</b></td>

<td>
<?php
echo $rowx[0];
?>
</td>
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<?php
 echo $row[3];
?>
</td>
<td width="50" id="war1">
<span class="space">Warranty:</span>
</td>
<td id="war">
<?php
 echo $row[4];
?>
</td>
<td width="50">
<span class="space">Rate: </span>
</td>
<td>
<?php echo $row[5]; ?>
</td>
<td id="bb4">
<span class="space">BuyBack:</span> 
</td>
<td id="bbr4">

<input type="text" name="stbbrate" id="stbbrate" />
</td>

</tr>
<?php } 
else if($row[1]=="AVR")
 {
  $qry1=mysqli_query($con1,"Select name from assets_specification where ass_spc_id='".$row[2]."'");
  $rowx=mysqli_fetch_row($qry1);
?>

<tr>
<td>
<b>AVR</b>
</td>
<td>
<?php
echo $rowx[0];
?>
</td>
<td width="50">
<span class="space">Number</span>:
</td>
<td>
<?php
 echo $row[3];
?>
</td>
<td width="50" id="war1">
<span class="space">Warranty:</span>
</td>
<td id="war">
<?php
 echo $row[4];
?>
</td>
<td width="50">
<span class="space">Rate: </span>
</td>
<td>
<?php echo $row[5]; ?>
</td>
<td id="bb5">
<span class="space">BuyBack:</span> 
</td>
<td id="bbr5">

<input type="text" name="avrbbrate" id="avrbbrate" />
</td>
</tr>
<?php }  
else{
?>
<tr>
<td>
<b>Others</b>
</td>
<td colspan="5">
<textarea name="oth" id="oth" cols="50" value="<?php echo $row[1]; ?>"></textarea>
</td>

<td>
<span class="space">Rate:</span> 
</td>
<td>

<input type="text" name="othrate" id="othrate" value="<?php echo $row[5]; ?>" />
</td>

</tr>
<?php } } ?>
</table>
<!-- =====================TABLE END FOR ASSESTS=======================================================-->
</td></tr>
</div>
<?php 
 if($fetchqrypo=="AMC"){
 $atm=mysqli_query($con1,"select bankname,atmid,cid,area,city,address,state,pincode,BRANCH from Amc where amcid='".$fetchqrypo[1]."'");
	$flag="amc";
	}
	else{
	$flag="atm";
	$atm=mysqli_query($con1,"select bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id from atm where track_id='".$fetchqrypo[1]."'");
	}
	$atmdet=mysqli_fetch_row($atm);
	
	//$cp=mysqli_query($con1,"select contactperson,contactno from pending_installations where po='".$fetchqrypo[0]."' and atmid='".$atmdet[9]."'");	
        //$cpdet=mysqli_fetch_row($cp);
?>
<tr>
<td width="100" height="35"><b>Bank Name :</b></td>
<td width="200"><input type="text" name="bank" id="bank" value="<?php echo $atmdet[0];?>" readonly/></td>
<td width="100" height="35"><b>ATM ID :</b></td>
<td width="200"><input type="text" name="atm" id="atm" value="<?php echo $atmdet[1];?>" readonly/></td>
<!--<td>Indent No: </td><td><input type="text" name="indentno" id="indentno" /></td>-->
</tr>

<tr>

<!--<td>Bom Date: </td><td><input type="text" name="bomdate" id="bomdate" onclick="displayDatePicker('bomdate');"/></td>-->
</tr>

<tr>
<td width="100" height="35"><b>Area :</b></td>
<td width="200"><input type="text" name="area" id="area" value="<?php echo $atmdet[3];?>" readonly/></td>
<td width="100" height="35"><b>Pincode:</b></td>
<td width="200" colspan="1"><input type="text" name="pin" id="pin" value="<?php echo $atmdet[7];?>" readonly/></td>
<!--<td>Indent Date: </td><td><input type="text" name="indentdate" id="indentdate" onclick="displayDatePicker('indentdate');"/></td>-->
</tr>

<tr>

</tr>

<tr>
<td width="100" height="35"><b>City : </b></td>
<td width="200">
<input type="text" name="city" id="city" value="<?php echo $atmdet[4];?>" readonly/>
</td>

<td width="100" height="35"><b>Branch :</b> </td>
<td width="200" colspan="">
<?php 
$sqlbr=mysqli_query($con1,"select * from `avo_branch` where id='".$atmdet[8]."'");
$sqlbr1=mysqli_fetch_row($sqlbr);
echo $sqlbr1[1]; ?>
</td>


</tr>

<tr>
<td width="100" height="35"><b>Address :</b> </td>
<td width="200" colspan="">
<textarea name="address" id="address" rows="4" cols="28" readonly/><?php echo $atmdet[5];?></textarea>
</td>

<td width="100" height="35"><b>State : </b></td>
<td width="200">
<div id="mystate">
<?php
//$state=mysqli_query($con1,"select * from state where ");
echo $atmdet[6]; ?>
</div>
</td>


</tr>
<tr>
<td width="100" height="35"><b>Contact Person :</b> </td>
<td width="200" colspan="">
<input type="text" name="contact" id="contact" value="<?php echo $fetchqrypo[12]; ?>" readonly/>
</td>

<td width="100" height="35"><b>Contact No.: </b></td>
<td width="200">
<input type="text" name="contactno" id="contactno" value="<?php echo $fetchqrypo[13]; ?>" readonly/></td>
</tr>

<tr>
<td colspan="4" align="center" height="50"><div id="search">
<a href="new_invoices.php" >BACK</a>
</div></td>
<!--<td colspan="4" align="center" height="50"><div id="search">
<?if($_GET['id']=="") {?>
<button type="button" name="mysub" id="mysub" onclick="validate(this.form); " class="readbutton" value=""> Submit </button><?php } else {?>
<button type="button" name="update" id="update" onclick="validate(this.form); " class="readbutton" value=""> Update</button></div> <?php }?></td>-->
</tr>
</table>
</form>
</center>
</body>
</html>