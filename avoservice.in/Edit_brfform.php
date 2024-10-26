<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BRF form</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />


<?php
include ('config.php');
include("access.php");

$ticket=$_REQUEST['ticketno'];

?>
<style>
      table, td {
                 border: 1px solid black;
                padding:5px;
                }
                
                
</style>


</head>
<body>
<?php include("menubar.php");
include 'config.php';

$sql="select * from BRF_form where Call_Ticket='".$ticket."'";
$result=mysqli_query($con1,$sql);
$row=mysqli_fetch_array($result);
$tktdat=$row['VendorTktDate'];
$tktdate=date("d-m-Y",strtotime($tktdat));

$compdate=$row['CompletedDate'];
$compdate=date("d-m-Y",strtotime($compdate));
?>

<h2 align="center">Edit BRF Form</h2>

<div class="container" style="margin-left:0px;">
<form  method="post" action="Editbrf_process.php">

<table align="center" id="myTable" width="70" height="35" border="1">
         
  <tr>
<td><leble>Vendor Ticket No:</lable></td>
    <td ><input type="text" name="VendorTicketNo" id="VendorTicketNo" style="width: 168px;" value="<?php echo $row['VendorTicketNo']?>" ></td>
</tr>
<input type="hidden" name="ticket" id="ticket" style="width: 168px;" value="<?php echo $ticket;?>" >

 <tr>
<td><leble>Vendor Tkt Date:</lable></td>
    <td ><input type="date" name="VendorTktDate" id="VendorTktDate" style="width: 168px;" value="<?php echo $row['VendorTktDate']?>" ></td>
</tr>
<!-- <tr>
<td><leble>Completed Date:</lable></td>
    <td ><input type="date" name="CompletedDate" id="CompletedDate" style="width: 168px;" value="<?php echo $row['CompletedDate']?>" ></td>
</tr>

 <tr>
<td><leble>No. Of Batteries Replaced:</lable></td>
    <td ><input type="text" name="BatteriesReplaced" id="BatteriesReplaced" style="width: 168px;" ></td> -->
</tr>
</table>
</br>

	      
  <div align="center"> <input type="submit"  name="submit" value="create" class="readbutton" /></div>
		</form>
	</body>
</html>
