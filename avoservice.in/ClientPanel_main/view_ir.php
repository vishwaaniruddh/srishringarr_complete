<?php session_start();
include("access.php");
include("../config.php");


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
ppg='20';
else
ppg=document.getElementById(perpg).value;
document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
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
			 if(a!="Loading"){
				
			 	var cid=document.getElementById('cid').value;//alert(cid);
			 	var fromdt=document.getElementById('fromdt').value;//alert(fromdt);
			 	var todt=document.getElementById('todt').value;//alert(todt);
				var atmid=document.getElementById('atmid').value;//alert(site_id);
				var branch=document.getElementById('branch').value;//alert(branch);
				var bank=document.getElementById('bank').value;//alert(bank);
				var complaintno=document.getElementById('complaintno').value;//alert(complaintno);
			  }
			var url = 'search_ir.php';
		
		    var pmeters="";
			//alert(url);
			//var pmeters = 'mode='+Mode+'&Page='+Page+'&bank='+bank; 
			if(a!="Loading"){ 
   pmeters = 'cid='+cid+'&Page='+b+'&perpg='+ppg+'&fromdt='+fromdt+'&todt='+todt+'&branch='+branch+'&atmid='+atmid+'&complaintno='+complaintno+'&bank='+bank;
			//alert(pmeters);
			}
			else
			{
				 pmeters='Page='+b+'&perpg='+ppg+'cid='+cid;
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

  mywindow = window.open(url, winname, "location=400,status=1,scrollbars=1, width=500,height=600,left=420,top=130");
  
 }
</script>


<style>


div#lyrics{
    width:300px;
    height:100px;
    background-color:#003300;
    position:absolute;
    left:700px;
    padding:10px;
	color:#FFF;
    
}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script type="text/javascript">
 
$(document).ready(function(){
    $("div#lyrics").hide();
    
    $("#songlist tr").mouseover(function(){
        $(this).css("background-color","#ccc");
        $("#lyrics",this).show();
    }).mouseout(function(){
        $(this).css("background-color","#eee");
        $("#lyrics",this).hide();
    });
    
});
</script>
</head>

<body> 

<? include("menubar.php"); ?>
<center>

<h2 class="h2color">Installation Reports</h2>
<h4 class="h2color">Here You can view the Snaps Calls completed till 17-10-2022 </h4>

<div >
<table cellpadding="" cellspacing="0" >
  <tr>
    <th>
   <? 
   include("../config.php");
   
   $client="select cust_id,cust_name from customer where 1";
    if($_SESSION['designation']==6){
  // echo "select client from clienthandle where logid='".$_SESSION['logid']."'";
    $cust=mysql_query("select client from clienthandle where logid='".$_SESSION['logid']."'");
    
    $cc=array();
    while($custr=mysql_fetch_array($cust))
    $cc[]=$custr[0];
    
   // print_r($cc);
    $ccl=implode(",",$cc);
    $ccl=str_replace(",","','",$ccl);
    $ccl="'".$ccl."'";
    $client.=" and cust_name in($ccl)";
    
    }
    $client.=" order by cust_name ASC";
   
    ?>
    <select name="cid" id="cid"> 
    <option value=""> Select</option>
	<?php 
	$cl=mysql_query($client);
	while($clro=mysql_fetch_row($cl))
		{ 		?>
		<option value="<?php echo $clro[0]; ?>"><?php echo $clro[1]; ?></option>
		<?php
		} 		?>
	</select>
	</th>
    	
    
        
       	<!--Branch Name-->
    	<th>
        	<select name="branch" id="branch"  ><option value="">AVO Branch</option>
					<?php
                    $st=mysql_query("SELECT * FROM `avo_branch` ORDER BY `name` ASC");
                    while($stro=mysql_fetch_array($st))
                    {
                    ?>
                    <option value="<?php echo $stro[0]; ?>"><?php echo $stro[1]; ?></option>
                    <?php
                    }
                    ?>
                    </select>
       	</th>
     	
        <!--CSIte Ide-->
    	<th width="75" colspan="2">
     <input type="text" name="atmid" id="atmid" placeholder="Site / Sol ID"/></th>
     <th width="75" colspan="2">
     <input type="text" name="bank" id="bank" placeholder="End User / Bank"/></th>
     <th width="75" colspan="2">
     <input type="text" name="complaintno" id="complaintno" placeholder="Complaint No"/></th>
        
        <!--From Date-->
     	<th width="75" colspan="2">
     <input type="text" name="fromdt" id="fromdt" readonly="readonly" onclick="displayDatePicker('fromdt');" placeholder="From Date"/></th>
     
     	<!--To Date-->
   		<th width="75" colspan="2">
   		<input type="text" name="todt" id="todt" readonly="readonly" onclick="displayDatePicker('todt');" placeholder="To Date"/></th>
     
   <th width="75" rowspan="2"><input type="button" onclick="searchById('Listing','1','');" value="Search" /></th>
   
  </tr>
  
</table>
</div>
<div id="search"></div>


</center>
</body>
</html>