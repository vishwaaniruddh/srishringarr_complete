<?php
include("access.php");

?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>AMC PO</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="popup.js" type="text/jscript" language="javascript"> </script>


<script type="text/javascript">

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
		
			 var branch=document.getElementById('branch').value; //alert(branch);
			 var cid=document.getElementById('cid').value;
			 
			 if(a!="Loading"){
			 var branch=document.getElementById('branch').value;    
			 var cid=document.getElementById('cid').value;
			 var buyer=document.getElementById('buyer').value;//alert(buyer);
			 var po_no=document.getElementById('po_no').value;//alert(po_no);
			 var fromdate=document.getElementById('fromdate').value;//alert(fromdate);
			 var todate=document.getElementById('todate').value;//alert(todate);			 
			  var status=document.getElementById('status').value;//alert(status);
			 }
		     
		     var url='search_amc_salesorder.php'
		     
		    
		var pmeters="";
		//	alert(url);
			if(a!="Loading"){ 
 			pmeters = 'cid='+cid+'&branch='+branch+'&po_no='+po_no+'&buyer='+buyer+'&Page='+b+'&perpg='+ppg+'&fromdate='+fromdate+'&todate='+todate+'&status='+status;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&cid='+cid+'&branch='+branch;	
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

//============================Update upload status==

function setSubmit(id)
{

//alert("hi");
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                 alert(xmlhttp.responseText);
                 document.getElementById('subdiv'+id).innerHTML = "";
                 document.getElementById('subdiv'+id).innerHTML = xmlhttp.responseText;
                 
                //alert('You have no update ');
             }
         }
         //sub=document.getElementById('sub'+id).value;
         date=document.getElementById('date'+id).value; // alert (date);
         status=document.getElementById('status'+id).value; //alert (status);
        
         if(date.length==0)
         alert("Please Select Date of Upload");
         if(status.value==1)
         alert("Please Confirm YES for Upload cases");
         
         else{
       
         xmlhttp.open("GET", "amcpo_update_new.php?id="+id+"&status="+status+"&date="+date, true);
      
         xmlhttp.send();
         }
}


 
</script>

</head>

<body onLoad="searchById('Loading','1','')"> 
<center>
<?php if($_SESSION['designation']==5){
    include("AccountManager/menubar.php");
        }else{
          include("menubar.php");  
        } ?>
<h2 class="h2color">AMC Sales Orders </h2>

<div>

<table  border="0" cellpadding="0" cellspacing="0">

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
    <th>
        <select name="cid" id="cid" onchange="searchById('Listing','1','');"> 
       <option value="">Select Client</option>
<?php
$cl=mysqli_query($con1,$client);
while($clro=mysqli_fetch_row($cl)) { ?>
<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
<?php } ?></select></th>

<th>
<?php 
		$selbr="select * from avo_branch where 1";
		if($_SESSION['branch']!='all')
		$selbr.=" and id in(".$_SESSION['branch'].") ";
		$selbr.=" order by id ASC";
		$selbr2=mysqli_query($con1,$selbr)  ?>
        <select name="branch" id="branch" >
        <?php if($_SESSION['branch']=='all'){?>
        <option value="">Select</option>
        <?php }
        while($branch1=mysqli_fetch_array($selbr2))  {  ?>
               <option value="<?php echo $branch1[0]; ?>"><?php echo $branch1[1]; ?></option>
        <?php } ?>
        </select>
</th>




<th width="145"><input type="text" size="15" name="po_no" id="po_no" onkeyup="" placeholder="Po Number"/></th>

<th width="145"><input type="text" size="15" name="buyer" id="buyer" onkeyup="" placeholder="End User"/></th>

<th width="75">

<select name="status" id="status" >

<option value="">--All--</option>
<option value="0">Pending</option>
<option value="1">Part Billing</option>
<option value="2">Fully Billed</option>
</select>
</th>

<th width="75">
<input type="text" name="fromdate" id="fromdate"  readonly="readonly" onclick="displayDatePicker('fromdate')"; placeholder="PO Date from"/></th>


<th width="75"><input type="text" name="todate" id="todate"  readonly="readonly" onclick="displayDatePicker('todate')"; placeholder="PO Date to"/></th>
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
</tr>
</table>
</div>

<div id="search"> </div>

</center>
</body>
</html>