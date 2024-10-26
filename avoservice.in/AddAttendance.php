<?php
session_start();
include ('config.php');
include("access.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Attendance</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
            function checkk(){
               //alert("hello");
                
                var dates=document.getElementById("datepicker").value;
            //alert(dates);
                $.ajax({
                    
                    type:'POST',
                    url:'checkdates.php',
                     data:'dates='+dates,
                    success:function(msg){
                     //alert(msg);   
                       if(msg==1){
                        alert("Attendance already done");
                     
                       }
                        
                       else{
                       
                       document.getElementById("myname").submit();
                       alert("Attendance done successfully");
                       }
                     
                    }
                });
                
            }
        </script>


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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script> 

    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet"> 
    
    <script>
var boolemail=false;
function validation()
{ 
  var datepicker= document.getElementById('datepicker').value;
  
              
        if (datepicker=="")
        {
        alert("Please Select Date");
        // return false;         
        }
        else{
       //return true;
        checkk();
        //finalval()
        //funcheckvalidate();
        //isOneChecked(radio);
        }
        
        
  //  boolemail=true;
      
          
}
function finalval()
{
   
    if(validation()  && funcheckvalidate())
    {
       return true; 
       
    }
    else
    {
        
        return false; 
        
    }
    
   
}

</script>  

<script>
/*
function radioValidation(){

        var gender = document.getElementsByName("radio[]");
        var genValue = false;
alert(gender.length);
        for(var i=0; i<gender.length;i++){
            if(gender[i].checked == true){
                genValue = true;  
                //alert(gender[i]);  
            }
        }
        if(!genValue){
            alert("Please Choose the gender");
            alert(genValue);
            return false;
        }

    }
*/
</script>

<script>
/*
function funcheckvalidate() {
var tcount = document.getElementById('cnt').value;
//var no='1';
var retval = false;
for(i= 0;i< tcount;i++){

         if (document.getElementById("radio"+i).checked  == false) {
            alert('Attendance button Not Checked');
           retval = false;
        }else{
    document.getElementById("myname").submit();
    alert("Attendance done successfully");  
    retval =true;
                
    }
    
    return retval ;  
    }
                      
    }
    */
</script>
</head>
<body>
<?php include("menubar.php"); ?>

<h2 align="center">Add Attendance</h2>
<div class="container text-center">



     

</div>	



<div class="container" style="margin-left:0px;">
<form  method="post" id="myname" name="myform" action="process_AddAttendance.php">

<table id="myTable" align="center" width="108" height="35" border="1">
          <tr><td><strong><font color="red">Select Date:</font></strong> <input type="text" name="datepicker" id="datepicker" class="from-control"></td></tr>
<script type="text/javascript">

    $( "#datepicker" ).datepicker();

</script>

           <tr> 
                <td>id</td>
                <td>Employee Name</td>
		<td>Employee Surname</td>
		<td>Employee code</td>
		<td>branch</td>
                <td>Department</td>
		<td>Present</td>
		<td>Leave</td>
		<td>Absent</td>
		           
           </tr>
 <?php
 if($_SESSION['branch']=="all"){
$sql="select * from employee where status ='0'";
}else{
$brch=mysqli_query($con1,"select name from avo_branch where id='".$_SESSION['branch']."'");
$brname=mysqli_fetch_array($brch);

$sql="select * from employee where status ='0' and branch='".$brname[0]."'";
//echo $sql;
}
$result=mysqli_query($con1,$sql);
$cnt=0;
   $cunt=mysqli_num_rows($result);
   
   date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d');
$day=date('D');
   ?>
   
   <input type="hidden" name="cnt" id="cnt" value="<?echo $cunt;?>">
   <!--<input type="date" name="dates" id="dates" value="<?php echo $dates;?>  readonly/>
   <input type="text" name="day" id="day" value="<?php echo $day?>"  readonly/>
   <input type="date" name="date" id="date" data-maxdate="<?php echo date("Y-m-d", strtotime("+1 day"));?>"/>-->
   <?
   $sr=1;
while($row=mysqli_fetch_array($result)){
?>
  <tr>
  <td ><?php echo $sr;?></td>
    <td ><?php echo $row['EmployeeName']?></td>
    <td><?php echo $row['Surname']?></td>
    
<td><?php echo $row['empcode']?></td>
<td><?php echo $row['branch']?></td>
<td><?php echo $row['department']?></td>
<td><input type="radio" name="radio<?php echo $cnt; ?>[]" id="radio<?php echo $cnt; ?>" value="p" style="width: 50px;"></td>
<td><input type="radio" name="radio<?php echo $cnt; ?>[]" id="radio<?php echo $cnt; ?>" value="l" style="width: 50px;"></td>
<td><input type="radio" name="radio<?php echo $cnt; ?>[]" id="radio<?php echo $cnt; ?>" value="A" checked style="width: 50px;"></td>

    
    
  </tr>
  <input type="hidden" name="id[]" value="<?php echo $row['id']?>"  readonly/>
  <input type="hidden" name="empName[]" value="<?php echo $row['EmployeeName']?>"  readonly/>
  <input type="hidden" name="Surname[]" value="<?php echo $row['Surname']?>"  readonly/>
  <input type="hidden" name="empcode[]" value="<?php echo $row['empcode']?>"  readonly/>
  <input type="hidden" name="branch[]" value="<?php echo $row['branch']?>"  readonly/>
  <input type="hidden" name="department[]" value="<?php echo $row['department']?>"  readonly/>
  
  
  
  
  
  <?php
  $cnt++;
  $sr++;
}
?>			
 
 </table>

<br>
 <div align="center">
	         <input type="button" name="done" value="done" class="readbutton" onclick="return validation();"/>
		
		
         </form>       
                  <!--<input type="button" value="view" class="readbutton" onclick='window.location.href="batterynenderview.php"'/>-->

		</div>

		</form>


</body>
</html>

