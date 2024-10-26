<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>





<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Employee form</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />


<?php
include ('config.php');
include("access.php");
$ids=$_GET['ids'];

$query="select * from employee where id='".$ids."'";
$run=mysqli_query($con1,$query);
$erow=mysqli_fetch_array($run);
//$dt=$erow['dob'];

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
  var AVOContactPerson= document.getElementById('AVOContactPerson').value;
//alert(AVOContactPerson);
  var AVOContactNumber= document.getElementById('AVOContactNumber').value;
  var NatureofProblem= document.getElementById('NatureofProblem').value;
  var BatteryType= document.getElementById('BatteryType').value;
  var BatteryRating_AH= document.getElementById('BatteryRating_AH').value;
  var BatteryQuantity= document.getElementById('BatteryQuantity').value;
  var PhysicalCondition= document.getElementById('PhysicalCondition').value;
  var ConnectedtoUPS= document.getElementById('ConnectedtoUPS').value;
  var KVARating= document.getElementById('KVARating').value;
  var SrNo_ofUPS= document.getElementById('SrNo_ofUPS').value;
  var FloatVoltage= document.getElementById('FloatVoltage').value;
  var ChargingCurrentSetting= document.getElementById('ChargingCurrentSetting').value; 
  var CutOffVoltage= document.getElementById('CutOffVoltage').value;
  var No_ofbatteriesfound= document.getElementById('No_ofbatteriesfound').value;
 
     
               
        if (AVOContactPerson=="")
        {
        alert("Please Fill up AVO Contact Person");
       
        return false;            
        }
        else if (AVOContactNumber=="")
        {
        alert("Please fill up AVO Contact Number");
       
        return false;            
        }

        else if (NatureofProblem=="")
        {
        alert("Please fill up Nature of Problem");
       
        return false;            
        }
       else if (BatteryType=="")
        {
        alert("Please fill up Battery Type");
        
        return false;            
        }
       else if (BatteryRating_AH=="")
        {
        alert("Please fill up Battery Rating ");
       
        return false;            
        }
       else if (BatteryQuantity=="")
        {
        alert("Please fill up Battery Quantity");
       
        return false;            
        }

      else if (PhysicalCondition=="")
        {
        alert("Please fill up Physical Condition");
       
        return false;            
        }
       else if (ConnectedtoUPS=="")
        {
        alert("Please fill up Connected to UPS");
       
        return false;            
        }
      else if (KVARating=="")
        {
        alert("Please fill up KVA Rating");
      
        return false;            
        }
     else if (SrNo_ofUPS=="")
        {
        alert("Please fill up Sr No of UPS");
       
        return false;            
        }

      else if (FloatVoltage=="")
        {
        alert("Please fill up Sr No of UPS");
      
        return false;            
        }
      else if (ChargingCurrentSetting=="")
        {
        alert("Please fill up Sr No of UPS");
       
        return false;            
        }

      else if (CutOffVoltage=="")
        {
        alert("Please fill up Sr No of UPS");
       
        return false;            
        }
      else if (No_ofbatteriesfound=="")
        {
        alert("Please fill up Sr No of UPS");
       
        return false;            
        }
       else
       {
       popup();
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
<?php //include("menubar.php"); ?>






<div class="container" style="margin-left:0px;">
<h2 align="center">Employee from</h2>
<form  method="post" action="Process_editemployee.php" onsubmit="return validation()">

<table align="center" id="myTable" width="70" height="35" border="1">
         
  <tr>
<td><leble>Employee Name:</lable></td>
<input type="hidden" name="ids" id="ids" value="<?php echo  $ids;?>"style="width: 168px;">
    <td ><input type="text" name="EmployeeName" id="EmployeeName" style="width: 168px;" value="<?php
echo $erow['EmployeeName']?>"></td>
</tr>
 <tr>
<td><leble>Employee Surname:</lable></td>
    <td ><input type="text" name="Surname" id="Surname" style="width: 168px;" value="<?php
echo $erow['Surname']?>"></td>
</tr>
 <tr>
<td><leble>Employee code:</lable></td>
    <td ><input type="text" name="empcode" id="empcode" style="width: 168px;" value="<?php
echo $erow['empcode']?>"></td>
</tr>
<tr>
<td><leble>Employee Grade:</lable></td>
    <td ><input type="text" name="Grade" id="Grade" style="width: 168px;" value="<?php
echo $erow['Grade']?>"></td>
</tr>
<tr>
<td><leble>Department:</lable></td>
<td><select name="department" id="department" style="width: 168px; height:25px">
     <option value="<?php
echo $erow['department']?>"><?php
echo $erow['department']?></option>
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
<td><leble>Branch:</lable></td>
<td><select name="branch" id="branch" style="width: 168px; height:25px">
     <option value="<?php
echo $erow['branch']?>"><?php
echo $erow['branch']?></option>
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
    <td ><input type="text" name="Contact" id="Contact" style="width: 168px;" value="<?php echo $erow['Contact']?>"></td>
</tr>

 <tr>
<td><leble>Date of Joining:</lable></td>
    <td ><input type="date" name="dob" id="dob" style="width: 168px;" value="<?php echo $erow['dob']?>"></td>
</tr>

</table>
</br>

	      
  <div align="center"> <input type="submit"  name="submit" value="create" class="readbutton"  />


                      

		</form>
		


		


</body>
</html>
