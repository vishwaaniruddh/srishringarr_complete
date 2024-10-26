<?php
include ('config.php');
include("access.php");
$ids=$_GET['ids'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Attendance</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>
<body>
<?php include("menubar.php"); ?>

<h2 align="center">Edit Attendance</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="process_vieweditattendance.php"  >

<table id="myTable" align="center" width="108" height="35" border="1">
          
           <tr> 
                <td>id</td>
                <td>Employee Name</td>
			<td>Employee code</td>
		<td>branch</td>
                <td>Department</td>
		<td>Present</td>
		<td>Leave</td>
		<td>Absent</td>
		           
           </tr>
 <?php
$sql="select * from Attendance where id='".$ids."'";
$result=mysqli_query($con1,$sql);
$cnt=0;
   $cunt=mysqli_num_rows($result);
   
   date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d');
   ?>
   
  
   <input type="hidden" name="dates" id="dates" value="<?php echo $dates?>"  readonly/>
<input type="hidden" name="idd" id="idd" value="<?php echo $ids;?>"  readonly/>
   
   <?
while($row=mysqli_fetch_array($result)){
?>
  <tr>
  <td ><?php echo $row['id']?></td>
    <td ><?php echo $row['empName']?></td>
   
<td><?php echo $row['empcode']?></td>
<td><?php echo $row['branch']?></td>
<td><?php echo $row['department']?></td>
<!--<td><input type="radio" name="radio<?php echo $cnt; ?>" id="radio1" value="p" style="width: 50px;"></td> 
<td><input type="radio" name="radio<?php echo $cnt; ?>" id="radio2" value="l" style="width: 50px;"></td>
<td><input type="radio" name="radio<?php echo $cnt; ?>" id="radio3" value="A" style="width: 50px;"></td> -->

  <td><input type="radio" name="radio" id="radio1" value="p" style="width: 50px;"></td> 
<td><input type="radio" name="radio" id="radio2" value="l" style="width: 50px;"></td>
<td><input type="radio" name="radio" id="radio3" value="A" style="width: 50px;"></td>  
    
  </tr>
 
  <?php
  $cnt++;
}
?>			
 
 </table>

<br>
 <div align="center">
	         <input type="submit" name="update" value="update" class="readbutton"/>
		
		
                
                  <!--<input type="button" value="view" class="readbutton" onclick='window.location.href="batterynenderview.php"'/>-->

		</div>

		</form>


</body>
</html>

