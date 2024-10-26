<?php
include("access.php");
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];
$branch=$_SESSION['branch'];
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
var tableToExcel = (function() {
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


	<script src="jquery-3.3.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <script type="text/javascript" src="javascript.js"></script>
        <script>
        
            function a(strPage,perpg){
            
             
              var BatteryVendorName=document.getElementById("BatteryVendorName").value;
              var Customer_Name=document.getElementById("Customer_Name").value;
              var branch=document.getElementById("branch").value;
              var fromdate=document.getElementById("fromdate").value;
              var todate=document.getElementById("todate").value;
              var calltype=document.getElementById("calltype").value;
              var tktno=document.getElementById("tktno").value;
              var atmid=document.getElementById("atmid").value;
              
//alert(Branch)
 //perp='50';

var Page="";
if(strPage!="")
{
Page=strPage;
}

var perp='';
if(perpg=='')
perp='25';
else
perp=document.getElementById(perpg).value;



         document.getElementById("show").innerHTML ="<center><img src=loader.gif></center>";

             $.ajax({
               
            type:'POST',    
   url:'viewBRFform_process.php',
  data:'BatteryVendorName='+BatteryVendorName+'&Customer_Name='+Customer_Name+'&branch='+branch+'&fromdate='+fromdate+'&todate='+todate+'&calltype='+calltype+'&Page='+Page+'&perpg='+perp+'&tktno='+tktno+'&atmid='+atmid,

   success: function(msg){
    
    
  // alert(msg);
   document.getElementById("show").innerHTML=msg;
   
  
   
} })
            }
        </script>
        
        
        
        
        
        
</head>
      &nbsp;&nbsp;&nbsp;
        <body onload="a('','');" >
<?php include("menubar.php");?>
		      
		      <h2 class="h2color" align="center" st>View Alert</h2>
<div>
	
		<table border="0"  style="border: 1px solid #fff;" align="center"  >       
			<tr >
                            
<th> Calls:</th>
<th> Battery Vendor Name :</th>
<th> Customer Name:</th>
<th> Branch</th>
<th> Site / ATM Id</th>
<th>Ticket No</th>
<th>From Date:</th>
<th>To Date:</th>
				
</tr>
<tr>


<td width="77" colspan="">
<select name="calltype" id="calltype" onchange="searchById('Listing','1','');"> 
      <!--<option value="">select </option>-->
      <option value="0">Open </option>
      <option value="1">Closed </option>
      <option value="2">Rejected </option>
      <option value="">All </option>
         </select>
    </td>
				<td><input type="text" name="BatteryVendorName" id="BatteryVendorName" ></td>
				<td><input type="text" name="Customer_Name" id="Customer_Name" ></td>

<td><select name="branch" id="branch" onchange="searchById('Listing','1','');" >
<option value="">Branch</option>
<?php

if($_SESSION['branch']=='all')
$br ="select * from avo_branch ";
else 
$br ="select * from avo_branch where id in('$branch') ";
$br1=mysqli_query($con1,$br);

while($brr=mysqli_fetch_array($br1))
{
?>
<option value="<?php echo $brr[1]; ?>"><?php echo $brr[1]; ?></option>
<?php
}
?>
</select>
</td>			
 	            <td><input type="text" name="atmid" id="atmid" ></td>
				<td><input type="text" name="tktno" id="tktno" ></td>
				<td><input type ="date" id ="fromdate"></td>
				<td><input type ="date" id ="todate"></td>
				<td><input type="button" name="submit" onclick="a('','')" value="search"></button></td>
				
				
			</tr>
			
		</table>
		<table align="right" style="border:0px solid #fff;margin-top:-25px">
	<!--	<tr><td><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >
				<button onclick="myFunction()" style="float: right;" style="margin-top:50px" >Print this page</button></td></tr> -->
		</table>
	            </div>
            <div id="show"></div>
            
			
			<div><input type="button" onclick="tableToExcel('show', 'BRF Calls')" value="Export to Excel" style="float: left;">
			
                        </div>
			
               
<!--<input type="button" name="csv"  placeholder="csv formate" value ="csv formate" onclick="csv()">-->


<!--<script>
function myFunction() {
    window.print();
}
</script>-->


</div>

			  
        </body>
    
</html>





