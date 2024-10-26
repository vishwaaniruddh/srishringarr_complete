<?php
include("access.php");
//include('config.php');
//$brmain=$_SESSION['branch'];


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


///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='10';
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
			 var id=document.getElementById('id').value; //alert(id);
			 //var city=document.getElementById('city').value;//alert(city);
			 var invno=document.getElementById('invno').value;//alert(invno);
			 var state=document.getElementById('state').value; //alert(state);
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			 var edate=document.getElementById('edate').value;//alert(edate);			 
		//	  var status=document.getElementById('status').value;//alert(status);
			 }
			 if(document.getElementById('status').value=="pending"){
			 	var url = 'search_barcode_pending.php';
			 } else if(document.getElementById('status').value=="complete") { var url = 'search_barcode_complete.php';}
		
		var pmeters="";
		//	alert(url);
			if(a!="Loading"){ 
 			pmeters = 'id='+id+'&cid='+cid+'&state='+state+'&invno='+invno+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate;
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
//var targetWin = window.open (url, winname, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=1, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  //mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
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

<h2 class="h2color">Barcode Status</h2>

<div>

<table  border="0" cellpadding="0" cellspacing="0">

<tr><th>Bar code Status</th><th>Customer Vertical</th><th>Branch</th><th>Site / ATM Id </th><th>Invoice No. </th><th>From Inv Date</th><th>To Inv date</th><th>Search</th></tr>

<tr>

<?php
    include("config.php");
 
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
 <th width="75">

<select name="status" id="status" onchange="searchById('Listing','1','');">
<option value="pending">Pending</option>
<option value="complete">Completed</option>
</select>
</th>  
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

<th width="75"><input type="text" size="15" name="id" id="id" onkeyup="" placeholder="Site ID"/><br /></th>
<th width="75"><input type="text" size="15" name="invno" id="invno" onkeyup="" placeholder="Invoice No"/></th>


<th width="75">
<input type="text" name="sdate" id="sdate"  readonly="readonly" onclick="displayDatePicker('sdate')"; placeholder="Inv From Date"/></th>


<th width="75"><input type="text" name="edate" id="edate"  readonly="readonly" onclick="displayDatePicker('edate')"; placeholder="Inv To Date"/></th>
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
</tr>
</table>
</div>

<div id="search"> </div>

</center>
</body>
</html>