<?php
include 'config.php';
$msg=$_POST['msg'];
$result = mysqli_query($con,$msg);
if(!$result){
	mysqli_error($con);
}

$message='<table class="results" border="1" cellpadding="3" cellspacing="1">
                  
          <tr>
		  <td style="color:#ac0404; font-size:12px; font-weight:bold;">IP NO.</td>
		  <td style="color:#ac0404; font-size:12px; font-weight:bold;">IP Name</td>
		  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Dependent Name</td>
		  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Relation with IP</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Patient Name</td>		  
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Case Reg no.</td>	
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Ref No.</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Ref Date</td>	
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Treatment Type</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Diagnosis</td>		  	  		  	  
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Admit Date </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Admit Time </td>
          </tr>';
$intRows = 0;
// Insert a new row in the table for each person returned

while($row= mysqli_fetch_row($result))
{ 	 
$message.='<tr>
    
    <td>'.$row[0].'</td>
             <td>'.$row[3].'</td>
      <td>'.$row[1].'</td>
      <td>'.$row[2].'</td>
      <td>'.$row[1].'</td>
     <td> &nbsp; </td>
     <td>'.$row[4].'</td>
    <td >';  if(isset($row[5]) and $row[5]!='0000-00-00') 
  $message.=date('d/m/Y',strtotime($row[5])).'</td>
    <td>'.$row[9].'</td>
    <td>'.$row[8].'</td>
    <td>'.$row[6].'</td>
    <td>'.$row[7].'</td>   	
    </tr>';
    
	 $intRows++; } 
	 
$message.='</table>'; //echo $message;

$to = 'dr.pk.sinha@esic.in,raghavtanay@gmail.com';
			
			$subject = 'DAILY ADMISSION REPORT FOR GDH';
			
			$headers = "From: GDH \r\n";
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
/*if (mail($to, $subject, $message, $headers)) {
              echo 'Your message has been Mailed.';
            } else {
              echo 'There was a problem sending the email.';
            }*/
?>
<form name="myform" id="myform" action="http://sarmicrosystems.in/esimail.php" method="post" >
<input type='hidden' name="msg" value='<?php echo $message; ?>' />
<input type='hidden' name="subject" value='<?php echo $subject; ?>' />
<input type='hidden' name="headers" value='<?php echo $headers; ?>' />
</form>
<script>
document.getElementById("myform").submit();
</script>