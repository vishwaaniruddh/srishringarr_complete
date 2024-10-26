<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
      
<script> 
function pick_job(val)
{ //alert("Hiiiii");
//alert(val);
state=val;
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
    var c=xmlhttp.responseText;
  //	alert(c);
	 document.getElementById('mycity').innerHTML = c;	
    }
  }
      //	alert("get_city.php?state="+state);    
	xmlhttp.open("GET","get_job_spec.php?state="+state,true);
	xmlhttp.send();
}
  </script>





<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee form</title>
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
</script>


<script>

function validation()
{ 
  var EmployeeName= document.getElementById('EmployeeName').value;
  var Surname= document.getElementById('Surname').value;
  var empcode= document.getElementById('empcode').value;
  var Grade= document.getElementById('Grade').value;
  var department= document.getElementById('department').value;
  var branch= document.getElementById('branch').value;
  var Contact= document.getElementById('Contact').value;
  var dob= document.getElementById('dob').value;
  var Job_Specific= document.getElementById('Job_Specific').value;
  
               
        if (EmployeeName=="")
        {
        alert("Please Fill up Employee Name");
       
        return false;            
        }
        else if (Surname=="")
        {
        alert("Please fill up Sur name");
       
        return false;            
        }

        else if (empcode=="")
        {
        alert("Please fill up employee code");
       
        return false;            
        }
       else if (Grade=="")
        {
        alert("Please fill up Grade");
        
        return false;            
        }
       else if (department=="")
        {
        alert("Please fill up department ");
       
        return false;            
        }
       else if (branch=="")
        {
        alert("Please fill up branch");
       
        return false;            
        }

      else if (Contact=="")
        {
        alert("Please fill up Contact");
       
        return false;            
        }
       else if (dob=="")
        {
        alert("Please fill up dob");
       
        return false;            
        }
        
        else if (Job_Specific=="")
        {
        alert("Please select Job Specification");
       
        return false;            
        }
     return true;
      
          
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
<?php //include("menubar.php"); ?>






<div class="container" style="margin-left:0px;">
<h2 align="center">Employee from</h2>
<form  method="post" action="Process_employeeform.php" onsubmit="return validation()">

<table align="center" id="myTable" width="70" height="35" border="1">
         
  <tr>
<td><leble>Employee Name:</lable></td>
    <td ><input type="text" name="EmployeeName" id="EmployeeName" style="width: 168px;"></td>
</tr>
 <tr>
<td><leble>Employee Surname:</lable></td>
    <td ><input type="text" name="Surname" id="Surname" style="width: 168px;"></td>
</tr>
 <tr>
<td><leble>Employee code:</lable></td>
    <td ><input type="text" name="empcode" id="empcode" style="width: 168px;"></td>
</tr>
<tr>
<td><leble>Employee Grade:</lable></td>
    <td ><input type="text" name="Grade" id="Grade" style="width: 168px;"></td>
</tr>
<tr>
<td><leble>Department:</lable></td>
<td><select name="department" id="department" onchange="pick_job(this.value);" style="width: 150px;">
     <option value="">Select</option>
      <?php 
         $qry="select * from deparment";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_array($result))
	   {  ?>
		<option value="<?php echo $row['dep_name'];?>"/><?php echo $row['dep_name']; ?></option>
               <br/>
      <?php } ?>
   
</select></td></tr>
 



<tr>
<td><leble>Job Specification:</lable></td>

<td>
<div id="mycity">    <select name="Job_Specific" id="Job_Specific" style="width: 150px;">
     <option value="">Select</option>
      <?php 
         $qry="select * from Job_Specific order by name ASC";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select></div></td></tr>

<tr>
<td><leble>Branch:</lable></td>
<td><select name="branch" id="branch" style="width: 150px;">
     <option value="">Select</option>
      <?php 
         $qry="select * from avo_branch";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select></td></tr>
 <tr>
<td><leble>Contact  Number:</lable></td>
    <td ><input type="text" name="Contact" id="Contact" style="width: 168px;"></td>
</tr>

 <tr>
<td><leble>Date of Joining:</lable></td>
    <td ><input type="date" name="dob" id="dob" style="width: 168px;"></td>
</tr>

</table>
</br>

	      
  <div align="center"> <input type="submit"  name="submit" value="create" class="readbutton"  />


                      

		</form>
		


		


</body>
</html>
