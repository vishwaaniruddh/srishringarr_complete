<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BRF form</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />


<?php
include ('config.php');
include("access.php");

?>


<script>
  function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
              && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        
function showrow()
{
	var cnt2;
	var cnt=Number(document.getElementById('counter').value);
	//alert(cnt);
	//alert(cnt);
  	cnt2=cnt;
  	cnt=cnt+1;
  	document.getElementById('counter').value=cnt;
	
	//document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";
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
		
var numi = document.getElementById('theValue');
var num = parseInt(document.getElementById('theValue').value) +1;
numi.value = num;

		var newdiv=document.createElement("div");
		newdiv.setAttribute('id',num);
		//alert(xmlhttp.response);
newdiv.innerHTML=xmlhttp.responseText+"<td><input type='button' value='X' onClick='removeElement("+num+")'></td></tr></div><tbody><table>";
	
	document.getElementById('back').appendChild(newdiv);
    document.getElementById('image').innerHTML="";
    }
  }
  
  alert("getnewrow.php?cnt="+cnt);
//xmlhttp.open("GET","getnewrow.php?cnt="+cnt,true);
//xmlhttp.send();

	
}

</script>


<script>

function validation()
{ 
  var Battery_Vendor= document.getElementById('Battery_Vendor').value;
  
       
        if (Battery_Vendor=="")
        {
        alert("Please Fill Battery Vendor Name");
        return false;            
        } else
       { 
       form.submit();
       
       }
} 

</script>
<style>
      table, td {
                 border: 1px solid black;
                padding:5px;
                }
                
                
</style>
</head>
<body>
<?php include("menubar.php");?>
<h2 align="center">BRF Form</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="Process_test_brfform.php" enctype="multipart/form-data" onsubmit="return validation()"> 

<table align="center" id="myTable" width="150" height="35" border="1">
         
  <tr>

 <tr>
<td><lable> Battery Vendor Name:</lable></td>
<td><select name="Battery_Vendor" id="Battery_Vendor" style="width: 168px ;height:25px"  required>
     <option value="">Select</option>
      <?php 
         $qry="select * from batteryVendor";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select></td></tr>



 </table>
<br>

<table id="myTable1" align="center">

 <tr> 
        <td>Sl. No. </td>
		<td>Battery Serial No.</td>
		<td>Charging Voltage</td>
			   <td></td>        
           </tr>
 <? $i=1; ?>
  <tr>
     <input type="hidden" name="theValue" id="theValue" value="1"/> 
    
    <td ><input type="text" name="Sl_no[]" id="Sl_no" style="width: 168px;"></td>
     <td ><input type="text" name="BatterySerialNo[]" id="BatterySerialNo" style="width: 168px;"></td> 
 <td ><input type="text" name="Charging_Voltage[]" id="Charging_Voltage" style="width: 168px;" onkeypress="return isNumberKey(event)" maxlength="4"></td> 
      
       <td> <input  type="button" onclick="myCreateFunction()" value="Add row" maxlength="4"></td>
       </tr>
</table>
</br>

	      
  <!--<div align="center"> <input type="submit"  name="submit" value="create" class="readbutton"  />-->
<div align="center"> <input type="submit"  name="submit" value="Submit" class="readbutton" onclick="validation()" />
<!--<input type="button" name="print" class="readbutton"  value="create pdf" onclick="prints()" ></button>-->
<input type="button" onclick="showrow()" value="Add Row" class="readbutton">		
<input type="button" onclick="myDeleteFunction()" value="Delete row" class="readbutton">


		</div>

		</form>
		


		
<script>
function myCreateFunction() {
    
    alert("Hi....");
     var table = document.getElementById("myTable1");
    // var count = document.getElementById("count").value;
   //  var rowCount = myTable1.rows.length;           
   //  cnt = count++;
    
     
   /* var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);*/
     var row = table.insertRow(-1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
  
cell1.innerHTML ='<input type="text" name="Sl_no[]" id="Sl_no" style="width: 168px;">';

cell2.innerHTML ='<input type="text" name="BatterySerialNo[]" id="BatterySerialNo" style="width: 168px;">';
cell3.innerHTML ='<input type="text" name="Charging_Voltage[]" id="Charging_Voltage" style="width: 168px;" onkeypress="return isNumberKey(event)" maxlength="4">';


}


function myDeleteFunction() {
var rowCount = myTable1.rows.length;
var a=rowCount - 1;
if(a>1){

    document.getElementById("myTable1").deleteRow(-1);
}}
</script>
<script>
function myFunction() {
    window.print();
}
</script>

</body>
</html>
