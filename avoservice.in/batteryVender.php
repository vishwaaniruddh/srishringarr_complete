<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Battery Requisition Form</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />


<?php
include ('config.php');
include("access.php");

//echo $_SESSION['user'].$_SESSION['designation'].$_SESSION['branch'];

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
{ var Battery_Vendor= document.getElementsByName('Battery_Vendor[]');
  var Mobile_Number= document.getElementsByName('Mobile_Number[]');
  var mail= document.getElementsByName('mail[]');
var emailFilter =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
  
  
 
        for (var i = 0; i < Battery_Vendor.length; i++)
       {      
              
               
        if (Battery_Vendor[i].value=="")
        {
        alert("Please Fillup Battery Vendor From");
        Battery_Vendor[i].focus();
        return false;            
        }
        else if (Mobile_Number[i].value=="")
        {
        alert("Please fillup Mobile Number");
        Mobile_Number[i].focus();
        return false;            
        }
        else if (mail[i].value=="")
        {
        alert("Please Select email  ");
        mail[i].focus();
        return false;            
        }
        	else if (!emailFilter.test(Email))
	{
		
		alert("invalid email ")
		return false;
	}                 
       
        }
 
return true;
        
}

</script>
<style>
      table, td {
                 border: 1px solid black;
                
                }
                
                
</style>


</head>
<body>
<?php include("menubar.php"); ?>

<h2 align="center">Battery Vendor</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="process_batteryVender.php" onsubmit="return validation()">

<table id="myTable" align="center" width="108" height="35" border="1">
          
           <tr> 
                <td>Battery Vendor Name </td>
		<td>Mobile Number</td>
		<td>e-mail Address</td>
		<td></td>
		           
           </tr>
 
  <tr>
    <td ><input type="text" name="Battery_Vendor[]" id="Battery_Vendor[]" style="width: 168px;"></td>
<!--<td><select name="Battery_Vendor[]" id="Battery_Vendor[]" style="width: 120px;">
     <option value="">Select</option>
      <?php 
         $qry="select * from ComponentsMaster";
         $result=mysqli_query($con1,$qry);
         while($row = mysqli_fetch_row($result))
	   {  ?>
		<option value="<?php echo $row[1];?>"/><?php echo $row[1]; ?></option>
               <br/>
      <?php } ?>
   
</select>-->
    <td><input type="text" name="Mobile_Number[]" id="Mobile_Number[]" maxlength="10" onkeypress="return isNumberKey(event)"></td>
    <td><input type="text" name="mail[]" id="mail[]" /></td>
    
    
  </tr>
  			
 
 </table>
<br>
 <div align="center">
	         <input type="submit" name="submit" value="submit" class="readbutton" />
		
		
                <!--<input type="button" onclick="" value="view row" class="readbutton">-->
                 
                  <input type="button" value="view" class="readbutton" onclick='window.location.href="batterynenderview.php"'/>

		</div>

		</form>
		


		


</body>
</html>
