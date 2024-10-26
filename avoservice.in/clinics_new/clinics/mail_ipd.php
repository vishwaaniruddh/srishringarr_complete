<?php
include 'config.php';
$msg=$_POST['msg'];
$result = mysqli_query($con,$msg);
if(!$result){
	mysqli_error($con);
}

$message='<table class="results" border="1" cellpadding="3" cellspacing="1">
 
       
<tr>
<th>Name</th>
<th>Relation</th>
<th>Case Reg</th>
<th>Ref No</th>
<th>Ref_Date</th>
<th>Treat Type</th>
<th>Diagnosis</th>
<th>CGHS_Rate</th>
<th>Bill No</th>
<th>Bill Date</th>
<th>Bill Amount</th>
<th>Amount Payable</th>
</tr>';


$intRows = 0;
// Insert a new row in the table for each person returned

while($row= mysqli_fetch_row($result))
{
$sql1=mysqli_query($con,"select * from patient where no='$row[2]'");
$row1=mysqli_fetch_row($sql1);

$sql2=mysqli_query($con,"select * from admission where ad_id='$row[1]'");
$row2=mysqli_fetch_row($sql2);
 	 

$message.='<tr>
    
   
    <td>'.$row1[6].'</td>
    <td>'.$row1[43].'</td>
	<td></td>
	<td>'.$row1[42].'</td>
	<td>';
	if(isset($row2[40]) and $row2[40]!='0000-00-00')
    $message.=date('d/m/Y',strtotime($row2[40])).' </td>';
	$message.='<td>'.$row2[33].'</td>
	<td>'.$row1[41].'</td>
    <td></td>
    <td>'.$row[0].'</td>
	<td>';
	if(isset($row[13]) and $row[13]!='0000-00-00')
    $message.=date('d/m/Y',strtotime($row[13])).' </td>
    <td>'.$row[10].'</td>
    </tr>';
    
	 $intRows++; } 
	 
$message.='</table>'; //echo $message;

$to = 'dr.pk.sinha@esic.in,tikendra.sharma@esic.in,raghavtanay@gmail.com';
			
			$subject = 'MONTHLY IPD REPORT FOR GDH';
			
			$headers = "From: " .GDH. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            
// message
/*$message = '
<html>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</html>
';*/

// To send HTML mail, the Content-type header must be set
//$headers  = 'MIME-Version: 1.0;';
//$headers .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";

// Additional headers
//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
//$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it
/*
              echo 'Your message has been Mailed.';
            } else {
              echo 'There was a problem sending the email.';
            }*/
header("Location: http://sarmicrosystems.in/esimail.php?msg=".$message);
?>
