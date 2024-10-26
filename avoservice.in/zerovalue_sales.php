<?php
include("access.php");
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>


<script type="text/javascript">

function pick_model(val)
{
brid=val;
//alert(brid);
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
    //  alert("get_prod_specs1.php?brid="+brid);    
	xmlhttp.open("GET","get_prod_specs1.php?brid="+brid,true);
	xmlhttp.send();
}


///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='25';
else
ppg=document.getElementById(perpg).value;

//alert(ppg);
document.getElementById("search").innerHTML ="<center><img src=../loader.gif></center>";

		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		
			 
			 var cid=document.getElementById('cid').value;
			 
			 if(a!="Loading"){
			var cid=document.getElementById('cid').value;
			 var product=document.getElementById('product').value;//alert(city);
			 var specs=document.getElementById('specs').value;//alert(invno);
			 var state=document.getElementById('state').value; //alert(state);
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			 var edate=document.getElementById('edate').value;//alert(edate);	
			 }
			var url = 'search_zerovalue_sales.php';
		var pmeters="";
		//	alert(url);
			if(a!="Loading"){ 
 			pmeters = 'product='+product+'&cid='+cid+'&state='+state+'&specs='+specs+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg;	
			}
			//alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert("gg"); 
			HttPRequest.onreadystatechange = function()
			{
 
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }
 
function newwin(url,winname,w,h)
{
//alert("hi");
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
 }
 

</script>

</head>

<body>
<center>

<?php  if($_SESSION['designation']==5){
            include("AccountManager/menubar.php");
        } else{
          include("menubar.php");  
        } ?>

<h2 class="h2color">Zero Value Invoices</h2>

<div>

<table  border="0" cellpadding="0" cellspacing="0">

<tr><th>Product</th><th>Model</th><th>Customer Vertical</th><th>Branch</th><th>From Inv Date</th><th>To Inv date</th><th>Search</th></tr>

<tr>
<?php
    include("config.php");
$prodqry=mysqli_query($con1,"Select * from assets order by assets_id ASC");
?>
<th><select name="product" id="product" onchange="pick_model(this.value);">
<option value="">--Select--</option> 
<? while($prod=mysqli_fetch_row($prodqry)){  ?>
<option value="<?php echo $prod[1];?>"><?php echo $prod[1];?></option> 
<? } ?>
</select></th>
<th>
<div id="mystate">
<select name="specs" id="specs" >
<option value="">-Select-</option>
    
</th>    

 <?  
    $client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==5){
   
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
   
    <th>
         <select name="cid" id="cid" onchange="searchById('Listing','1','');"> 
   <?php if($_SESSION['designation']!=5){ ?>
   
    <option value="">Select Client</option> <?php } ?>
<?php
$cl=mysqli_query($con1,$client);
while($clro=mysqli_fetch_row($cl))
{
?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></th>

<th width="75">

<select name="state" id="state" >
<option value="">--Select Branch--</option>
<?php 
$sql=mysqli_query($con1,"select * from avo_branch");
while($sql1=mysqli_fetch_row($sql)){

?>
<option value="<?php echo $sql1[0];?>" ><?php echo $sql1[1];?></option>
<?php } ?>
</select>
</th>


<th width="75">
<input type="text" name="sdate" id="sdate"  readonly="readonly" onclick="displayDatePicker('sdate')"; placeholder="From Inv Date"/></th>


<th width="75"><input type="text" name="edate" id="edate"  readonly="readonly" onclick="displayDatePicker('edate')"; placeholder="To Inv Date"/></th>
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
</tr>
</table>
</div>

<div id="search"> </div>

</center>
</body>
</html>