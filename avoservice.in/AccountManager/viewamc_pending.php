<?php
include "../access.php";
//echo $_SESSION['designation']." ".$_SESSION['user'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<link href="../menu.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript">
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_site.php?id="+id;
	}

}


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
		 /* if(document.getElementById('idd').value=="" && document.getElementById('fname22').value=="")
		  {
			  var url = 'get_docID.php';
		  }else   if(document.getElementById('fname22').value==""){

			  var s=document.getElementById('idd').value;
			var url = 'get_docID.php?id='+s;
		  } else if(document.getElementById('idd').value==""){

			   var s=document.getElementById('fname22').value;
			var url = 'get_docID.php?fname='+s;
		  } else{*/
			 // var id=document.getElementById('idd').value;//alert(id);
			var type=document.getElementById('type').value
			 var cid=document.getElementById('cid').value;
			 if(a!="Loading"){
			 var id=document.getElementById('id').value;//alert(id);
			//alert(cid);
			 var bank=document.getElementById('bank').value;//alert(bank);
			 var city=document.getElementById('city').value;//alert(city);
			 var area=document.getElementById('area').value;//alert(area);
			 var state=document.getElementById('state').value;//alert(state);
			 var pin=document.getElementById('pin').value;//alert(pin);
			 //var sdate=document.getElementById('sdate').value;//alert(sdate);
			 //var edate=document.getElementById('edate').value;//alert(edate);
			  }
			////alert(document.getElementById('type').value);
			if(document.getElementById('type').value=="amc"){
			var url = 'search_pendingamc.php';
			}else{
			var url='search_site.php'
		 }
 	//alert(url);
		var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank;
			if(a!="Loading"){
			 pmeters = 'id='+id+'&cid='+cid+'&city='+city+'&state='+state+'&area='+area+'&pin='+pin+'&area='+area+'&bank='+bank+'&Page='+b+'&perpg='+ppg;
			}//alert("gg");
			else
			{
			pmeters = 'Page='+b+'&perpg='+ppg+'&cid='+cid;
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

</script>
</head>

<body onLoad="searchById('Loading','1','')">
<center>
<?php include "menubar.php";?>

<h2 class="h2color">View AMC Pending Site</h2>


<button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export Example')">Export Table data into Excel</button>
	<p><br />
    </p>
	<table  border="0" cellpadding="0" cellspacing="0">
  <tr>

</tr>
<tr>
<th >Select Site <select  name="type" id="type" onchange="searchById('Listing','1','');">

<!--<option value="sale">Sales Site</option>-->
<option value="amc">AMC Site</option>

</select> </th>
<?php
include "../config.php";
$client = "select cust_id,cust_name from customer where 1";
if ($_SESSION['designation'] == 5) {
    //echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust = mysqli_query($con1, "select client from clienthandle where logid= (select srno from login where username='" . $_SESSION['user'] . "')");
    $cc = array();
    while ($custr = mysqli_fetch_array($cust)) {
        $cc[] = $custr[0];
    }

    $ccl = implode(",", $cc);
    $ccl = str_replace(",", "','", $ccl);
    $ccl = "'" . $ccl . "'";
    $client .= " and cust_name in($ccl)";

}
$client .= " order by cust_name ASC";
//echo $client;
?>
    <th>
      <select name="cid" id="cid" onchange="searchById('Listing','1','');">
     <?php if ($_SESSION['designation'] != 5) {?><option value="">Select Client</option><?php }
$cl = mysqli_query($con1, $client);
while ($clro = mysqli_fetch_row($cl)) {
    ?>
   <option value="<?php echo $clro[1]; ?>"><?php echo $clro[1]; ?></option>
   <?php
}
?></select></th>
<!--<th width="77"><input type="text" size="15" name="cid" id="cid" onkeyup="" placeholder="Customer"/></th>-->
<th width="145"><input type="text" size="15" name="bank" id="bank" onkeyup="" placeholder="Bank"/></th>

<th width="75"><input type="text" size="15" name="city" id="city" onkeyup="" placeholder="City"/></th>
<th width="75"><input type="text" size="15" name="state" id="state" onkeyup="" placeholder="State"/></th>
<th width="75"><input type="text" size="15" name="pin" id="pin" onkeyup="" placeholder="Pincode"/></th>
<th width="75"><input type="text" size="15" name="area" id="area" onkeyup="" placeholder="Address"/></th>
<th width="75"><input type="text" size="15" name="id" id="id" onkeyup="" placeholder="ATM"/><br /></th>


<!--<td width="75"><input type="text" name="sdate" id="sdate"  onkeyup="searchById('Listing','1');" placeholder="From Date"/></td>
<td width="75"><input type="text" name="edate" id="edate"  onkeyup="" placeholder="To Date"/></td>-->
<th><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
</tr>
</table>





<div id="search"></div>

</center>
</body>
</html>