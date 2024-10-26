<?php
$host="198.38.84.103";
$user="sarmicro_IPUA1";
$pass="ipua123*";
$con=mysqli_connect($host,$user,$pass) or die(mysqli_error());
mysqli_select_db("sarmicro_IPUA",$con);


$id=$_POST['memid'];
echo "mid=".$id;


$fetch_query=mysqli_query($con1,"select * from IPUA_Registration where ID='".$id."'");
$fetch=mysqli_fetch_array($fetch_query);


$Company_name=$fetch[1];
$Esta_year=$fetch[3];
$Esta_type=$fetch[4];
$Pan=$fetch[5];

$geosaop=$fetch[7];
$State_type=$fetch[8];
$Others=$fetch[49];
$Subgeosaop=$fetch[9];
$Association=$fetch[10];
$Group_comp_name=$fetch[11];
$Callaboration=$fetch[12];

$Address1=$fetch[13];
$Address2=$fetch[14];
$City=$fetch[15];
$Pin=$fetch[16];
$State=$fetch[17];
$Membershipno=$fetch[18];
$Website=$fetch[19];
$Mobile=$fetch[47];
$Company_Email=$fetch[48];

$C1title1=$fetch[20];
$C1firstname=$fetch[21];
$C1lastname=$fetch[22];
$C1designation=$fetch[23];
$C1divdept=$fetch[24];
$Person1_Email=$fetch[25];
$C1mobile=$fetch[26];


$C2title2=$fetch[27];
$C2firstname=$fetch[28];
$C2lastname=$fetch[29];
$C2designation=$fetch[30];
$C2divdept=$fetch[31];
$Person2_Email=$fetch[32];
$C2mobile=$fetch[33];


$Prodhandle11=$fetch[34];
$Subprodhandle11=$fetch[35];
$Sub1prodhandle11=$fetch[36];

$Prodhandle22=$fetch[37];
$Subprodhandle22=$fetch[38];
$Sub1prodhandle22=$fetch[39];

$Prodhandle33=$fetch[40];
$Subprodhandle33=$fetch[41];
$Sub1prodhandle33=$fetch[42];
$Membertype=$fetch[43];

$Companyprofile=$fetch[44];

$subject="Details Of New IPUA Members";
$headers = "From: <HelpDesk@ipua.com>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl."<br>";
			//echo $this->ccm;
			 $message = '
    <html>
    <head>
      <title>Details Of New IPUA Members</title>
    </head>
    <body>
      <table>
	  <tr><th colspan="2">Company Information</th><tr>
     <tr><td>Select Type of Membership</td><td>'.$Membertype.'</td></tr>
     <tr><td>Name of the Company</td><td>'.$Company_name.'</td></tr>
     <tr><td>Year of the Establishment in India</td><td>'.$Esta_year.'</td></tr>
	 <tr><td>Type of Establishment</td><td>'.$Esta_type.'</td></tr>
     <tr><td>PAN</td><td>'.$Pan.'</td></tr>
	 <tr><td>Geographical Sales & Operation</td><td>'.$geosaop.'.""'.$State_type.'</td></tr>
     <tr><td>International</td><td>'.$Subgeosaop.'</td></tr>
	 <tr><td>Industry Association membership</td><td>'.$Association.'</td></tr>
     <tr><td>Name of Group Company</td><td>'.$Group_comp_name.'</td></tr>
	 <tr><td>Callaboration / joint Venture</td><td>'.$Callaboration.'</td></tr>
     
	 <tr><th colspan="2">Company Contact Details</th><td><tr>
     <tr><td>Address 1</td><td>'.$Address1.'</td></tr>
     <tr><td>Address 2</td><td>'.$Address2.'</td></tr>
	 <tr><td>City</td><td>'.$City.'</td></tr>
	 <tr><td>Pin</td><td>'.$Pin.'</td></tr>
     <tr><td>State</td><td>'.$State.'</td></tr>
	 <tr><td>Mobile</td><td>'.$Mobile.'</td></tr>
	 <tr><td>Email</td><td>'.$Company_Email.'</td></tr>
	 <tr><td>Website</td><td>'.$Website.'</td></tr>
	 
	 <tr><th colspan="2">Contact Person 1 Details</th><td><tr>
     <tr><td>Title</td><td>'.$C1title1.'</td></tr>
     <tr><td>First name</td><td>'.$C1firstname.'</td></tr>
	 <tr><td>Last Name</td><td>'.$C1lastname.'</td></tr>
	 <tr><td>Designation</td><td>'.$C1designation.'</td></tr>
     <tr><td>Division / Department</td><td>'.$C1divdept.'</td></tr>
	 <tr><td>Mobile</td><td>'.$C1mobile.'</td></tr>
	 <tr><td>Email</td><td>'.$Person1_Email.'</td></tr>
	
	 
	 <tr><th colspan="2">Contact Person 1 Details</th><td><tr>
     <tr><td>Title</td><td>'.$C2title2.'</td></tr>
     <tr><td>First name</td><td>'.$C2firstname.'</td></tr>
	 <tr><td>Last Name</td><td>'.$C2lastname.'</td></tr>
	 <tr><td>Designation</td><td>'.$C2designation.'</td></tr>
     <tr><td>Division / Department</td><td>'.$C2divdept.'</td></tr>
	 <tr><td>Mobile</td><td>'.$C2mobile.'</td></tr>
	 <tr><td>Email</td><td>'.$Person2_Email.'</td></tr>
	 
	 <tr><td>Products Handled 1</td><td>'.$Prodhandle11.'.">>"'.$Subprodhandle11.'">>"'.$Sub1prodhandle11.'</td></tr>
         <tr><td>Products Handled 2</td><td>'.$Prodhandle22.'.">>"'.$Subprodhandle22.'">>"'.$Sub1prodhandle22.'</td></tr>
	 <tr><td>Products Handled 3</td><td>'.$Prodhandle33.'.">>"'.$Subprodhandle33.'">>"'.$Sub1prodhandle33.'</td></tr>
	 <tr><td>Company Profile</td><td>'.$Companyprofile.'</td></tr>
      </table>
    </body>
    </html>';




			/*if(isset($this->sendmail))
			{*/
			mail($Company_Email, $subject, $message, $headers);
/*
if(mail)
{

echo "ok";
}
else

{

echo "error";
}
?>