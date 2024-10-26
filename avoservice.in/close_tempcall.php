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
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var ticket=document.getElementById('ticket').value;//alert(ticket);
			 var area=document.getElementById('area').value;//alert(area);
			 var state=document.getElementById('state').value; //alert(state);
			 var sdate=document.getElementById('sdate').value;//alert(sdate);
			 var edate=document.getElementById('edate').value;//alert(edate);			 
			  var status=document.getElementById('status').value;//alert(status);
			
			
			  }
		
			var url = 'search_tempcall.php';
			
 	
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
 			pmeters = 'id='+id+'&cid='+cid+'&state='+state+'&area='+area+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg+'&sdate='+sdate+'&edate='+edate+'&status='+status+'&ticket='+ticket;
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
         reason=document.getElementById('reason'+id).value;
         remarks=document.getElementById('remarks'+id).value;
         if(reason.length==0)
         alert("Please select a Reason");
         
         else{
       //xmlhttp.open("GET", "tempcall_status.php?id="+id+"&sub="+sub, true);
         xmlhttp.open("GET", "tempcall_status.php?id="+id+"&reason="+reason+"&remarks="+remarks, true);
      //  xmlhttp.open("GET", "tempcall_status.php?id="+id+"&reason="+reason, true);
         xmlhttp.send();
         }
}
 
 
 
 
 
 
</script>

</head>

<body onLoad="searchById('Loading','1','')">
<center>

<?php include("menubar.php"); ?>

<h2 class="h2color">View Temporary Calls</h2>

<div>
<!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button> -->
	<br /> 
<table  border="0" cellpadding="0" cellspacing="0">

<tr>

<?php
    include("config.php");
    $client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==5){
    //echo "select client from clienthandle where logid= (select srno from login where username='".$_SESSION['user']."')";
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
<option value="<?php echo $clro[1]; ?>"><?php echo $clro[1]; ?></option>
<?php
}
?></select></th>
<!--<th>
    <select name="call_status" id="call_status" onchange="searchById('Listing','1','');"> 
		<option value="pending">Pending</option>
        <option value="">All</option>		
		<option value="hold">Hold</option>
		<option value="close">Close</option>
	</select></th> -->

<th width="77"><input type="text" size="15" name="ticket" id="ticket" onkeyup="" placeholder="Call Ticket No."/></th>


<th width="145"><input type="text" size="15" name="bank" id="bank" onkeyup="" placeholder="Bank"/></th>

<th width="75"><input type="text" size="15" name="id" id="id" onkeyup="" placeholder="ATM"/><br /></th>


<th width="75">

<!--<input type="text" size="15" name="state" id="state" onkeyup="" placeholder="State"/>-->
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

<th width="75"><input type="text" size="15" name="area" id="area" onkeyup="" placeholder="Address"/></th>

<th width="75">

<select name="status" id="status" >
<option value="">--All--</option>
<option value="1">--Updated--</option>
<!--<option value="0">--Pending--</option> -->
</select>
</th>

<th width="75">
<input type="text" name="sdate" id="sdate"  readonly="readonly" onclick="displayDatePicker('sdate')"; placeholder="From Date"/></th>
<select>
</select>

<th width="75"><input type="text" name="edate" id="edate" readonly="readonly"  onclick="displayDatePicker('edate')"; placeholder="To Date"/></th>
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
</tr>
</table>
</div>

<div id="search"> </div>

</center>
</body>
</html>