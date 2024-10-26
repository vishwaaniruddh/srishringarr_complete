<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
$brme=($_SESSION['branch']);

 
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />
<link href="../popup.css"  rel="stylesheet" type="text/css">
<!--datepicker-->
<link href="../datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="../datepicker/datepick_js.js" type="text/javascript"></script>
<script src="../popup.js" type="text/jscript" language="javascript"> </script>
<script type="text/javascript">

var tableToExcel = (function() {
//alert("hii");
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<script>
///////////////////////////////search 
function searchById(a,b,perpg) {
//alert(a+" "+b+" "+perpg);
var ppg='';
if(perpg=='')
ppg='10';
else
ppg=document.getElementById(perpg).value;
document.getElementById("search").innerHTML ="<center><img src='../loader.gif'></center>";
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
	
		   	var cid=document.getElementById('cid').value;//alert(cid);
		   	var status=document.getElementById('status').value;//alert(status);
			 if(a!="Loading"){
			 var id=document.getElementById('atmid').value;//alert(id);
			 var status=document.getElementById('status').value;//alert(bank);
			 var fromdt=document.getElementById('fromdt').value;
			 var todt=document.getElementById('todt').value;
			 var state=document.getElementById('state').value;
            var complaintno=document.getElementById('complaintno').value;
			  }
		
			var url = 'search_bfr.php'; 
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
			 pmeters = 'atmid='+id+'&cid='+cid+'&Page='+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&state='+state+'&complaintno='+complaintno+'&status='+status;
			 //alert(pmeters);
			}
			else
			{
				 pmeters = "&Page="+b+'&perpg='+ppg+'&cid='+cid;
			}
			//alert(pmeters);
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 
//alert(pmeters); 
			HttPRequest.onreadystatechange = function()
			{
 /*
			if(HttPRequest.readyState == 3)  // Loading Request
				  {
	document.getElementById("listingAJAX").innerHTML = '<img src="loader.gif" align="center" />';
				  }
 */
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
 
 //alert(response);
				  document.getElementById("search").innerHTML = response;
			  }
		}
  }


function newwin(url,winname)
{

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=400,left=350,top=200");
  
 }
</script>
</head>

<body onLoad="searchById('Loading','1','')">
<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>



<h2 class="h2color">View Battery Failure Report</h2>

<div >
 <!--<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<br />-->
<table cellpadding="" cellspacing="0" >
  <tr>

    <th>
    <?php
    include("../config.php");
    $client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==6){
  // echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysqli_query($con1,"select client from clienthandle where logid='".$_SESSION['logid']."'");
    
    $cc=array();
    while($custr=mysqli_fetch_array($cust))
    $cc[]=$custr[0];
    
   // print_r($cc);
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC";
   //echo $client;
    ?>
    <select name="cid" id="cid" onchange=""> 
	
<!--	<option value="">Select Client</option> -->
	<?php 
	$cl=mysqli_query($con1,$client);
	while($clro=mysqli_fetch_row($cl))
		{
		?>
		<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
		<?php
		}
		?>
	</select>
	</th>
 <th width="77" colspan="">
<select name="status" id="status" onchange="searchById('Listing','1','');"> 
      <!--<option value="">select </option>-->
      <option value="0">Open </option>
      <option value="1">Closed </option>
      <option value="2">Rejected </option>
         </select>
    </th>
    <th width="75"><input type="text" name="atmid" id="atmid" onkeyup="" placeholder="Sol/Site/ATM ID"/></th>
   
     <th width="75">

<?php 
$batchname=mysqli_query($con1,"select * from avo_branch");
?>

<select name="state" id="state">
<option value="">Select branch</option>
<?php 
while($batchnamef=mysqli_fetch_array($batchname))
{ ?>
<option value="<?php echo $batchnamef[1];?>"><?php echo $batchnamef[1];?></option>
<?php 

} ?>
</select>
</th>
     <th width="75"><input type="text" name="complaintno" id="complaintno" onkeyup="" placeholder="Complaint No"/></th>
     
     <th width="75">
	 <input type="text" name="fromdt" id="fromdt" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/>
	</th>
	<th width="75">
	 <input type="text" name="todt" id="todt"  readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
	<th> <input type="button" onclick="searchById('Listing','1','');" value="SEARCH" /></th>
  
   </tr>
  </table>
</div>
<div id="search"></div>


</center>
</body>
</html>