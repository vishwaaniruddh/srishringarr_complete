<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Dept</title>
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
{ var dep= document.getElementsByName('dep[]');
  
               
        if (dep =="")
        {
        alert("Please Fillup department name");
        
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

<h2 align="center">Department Form</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="process_department.php" onsubmit="return validation()">

<table id="myTable" align="center" width="108" height="35" border="1">
          
           <tr> 
                <td>Department </td>
		
		<td></td>
		           
           </tr>
 
  <tr>
    <td ><input type="text" name="dep" id="dep" style="width: 168px;"></td>

    
  </tr>
  			
 
 </table>
<br>
 <div align="center">
	         <input type="submit" name="submit" value="submit" class="readbutton" />
		
                  <input type="button" value="view" class="readbutton" onclick='window.location.href="departmentview.php"'/>

		</div>

		</form>
		


		


</body>
</html>
