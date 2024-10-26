<?php
include("access.php");
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Attendance Summary<?php echo $_SESSION['user']; ?></title>
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
            
             
              var Branch=document.getElementById("Branch").value;
              var Department=document.getElementById("Department").value;
              var from=document.getElementById("from").value;
              var to=document.getElementById("to").value; 
              
              
//alert(Branch)
 //perp='50';

var Page="";
if(strPage!="")
{
Page=strPage;
}

var perp='';
if(perpg=='')
perp='10';
else
perp=document.getElementById(perpg).value;



         document.getElementById("show").innerHTML ="<center><img src=loader.gif></center>";

             $.ajax({
               
            type:'POST',    
   url:'AttendanceSummary_process.php',
//url:'testing.php',
  data:'Branch='+Branch+'&Department='+Department+'&from='+from+'&to='+to+'&Page='+Page+'&perpg='+perp,

   success: function(msg){
     //var jsr = JSON.parse(msg);
    
  //alert(msg);
   document.getElementById("show").innerHTML=msg;
   
  
   
} })
            }
        </script>
        
        
        
        
        
        
</head>
      &nbsp;&nbsp;&nbsp;
     <!--  <body onload="a('','');" >
-->
  <body  >

<?php include("menubar.php");?>
		      
		      <h2 class="h2color" align="center" st>Attendance Summary</h2>
<div>
	
		<table border="0"  style="border: 1px solid #fff;" align="center"  >       
			<tr >
                            

                                  
				<th> Branch:</th>
				<th> Department:</th>
				
                                <th>from date:</th>
                                <th>To date:</th>
                               
				
				</tr>
<tr>


<td width="77" colspan="">
<select name="Branch" id="Branch" onchange="searchById('Listing','1','');"> 
<option value="">Select</option>
      <?php 
         $qry="select * from avo_branch";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select>
    </td>

<td width="77" colspan="">
<select name="Department" id="Department" onchange="searchById('Listing','1','');">
<option value="">Select</option> 
      <?php 
         $qry="select * from deparment";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_array($result))
	   {  ?>
		<option value="<?php echo $row['dep_name'];?>"/><?php echo $row['dep_name']; ?></option>
               <br/>
      <?php } ?>
   
</select>
    </td>
                                
                                <td><input type="date" name="from" id="from"></td>
                                <td><input type="date" name="to" id="to"></td>
                               
				<td><input type="button" name="submit" onclick="a('','')" value="search"></button></td>
				
				
			</tr>
			
		</table>
		<table align="right" style="border:0px solid #fff;margin-top:-25px">
		<tr><td><input type="button" onclick="tableToExcel('show', 'W3C Example Table')" value="Export to Excel" style="float: right;" >
				<button onclick="myFunction()" style="float: right;" style="margin-top:50px" >Print this page</button></td></tr>
		</table>
	            </div>
            <div id="show"></div>
            
			
			
                        </div>
			
               
<!--<input type="button" name="csv"  placeholder="csv formate" value ="csv formate" onclick="csv()">-->


<script>
function myFunction() {
    window.print();
}
</script>


</div>

			  
        </body>
    
</html>





