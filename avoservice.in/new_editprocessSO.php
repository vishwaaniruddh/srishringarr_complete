<?php
session_start();
	include('config.php');
 	$sid=$_POST['sid'];
 	//echo "cust=".$cust."<br>";
 	$invno=$_POST['invno'];
	$date1=$_POST['date1'];
	$invval=$_POST['invval'];
	$del_mode=$_POST['del_mode'];
	$cname=$_POST['cname'];
	$dno=$_POST['dno'];
	$estdate=$_POST['estdate'];
	$date2=$_POST['date2'];
	$crn=$_POST['crn'];
	$crndate=$_POST['crndate'];
	$crnamt=$_POST['crnamt'];
	$crnfile=$_POST['crnfile'];
	
	$target_dir = "invoices050922/";
	$target_dir1 = "creditnotes/";
	//echo $_POST['invfile'];

$deldt="0000-00-00";
if($_POST['deldt']!="")
{

$daten = str_replace('/', '-', $_POST['deldt']);
$deldt= date('Y-m-d', strtotime($daten));
}

        $target_file = $target_dir . $_FILES['invfile']['name']; //echo "file:".$target_file ;
        $target_file1 = $target_dir1 . $_FILES['crnfile']['name'];
        $uploadOk = 1;
       // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

 $qry=mysqli_query($con1,"update so_order set inv_no='".$invno."',inv_date=STR_TO_DATE('".$date1."','%d/%m/%Y'),inv_value='".$invval."',courier='".$cname."',docketno='".$dno."',est_date=STR_TO_DATE('".$estdate."','%d/%m/%Y'),dis_date=STR_TO_DATE('".$date2."','%d/%m/%Y'),crn_no='".$crn."',crn_date=STR_TO_DATE('".$crndate."','%d/%m/%Y'),crn_amount='".$crnamt."',del_date='".$deldt."', del_mode='".$del_mode."' where id='".$sid."'"); 
       
       // $check = getimagesize($_FILES['invfile']['tmp_name']); //echo "image:".$check;
         if($_FILES['invfile']['size']<2000000) {         
          if (move_uploaded_file($_FILES["invfile"]["tmp_name"], $target_file)) {
                      
       mysqli_query($con1,"update so_order set inv_img='".$target_file."' where id='".$sid."'");
       
       } }
       	 
        //$check1 = getimagesize($_FILES['crnfile']['tmp_name']); //echo "image:".$check;
         if($_FILES['crnfile']['size']<2000000) {
                                if(move_uploaded_file($_FILES["crnfile"]["tmp_name"], $target_file1))
                                {
                                mysqli_query($con1,"update so_order set crn_img='".$target_file1."' where id='".$sid."'");
                                }
                               }
                               
                               	echo '<center><br><br><br>';
	if($qry){


$gtdets=mysqli_query($con1,"select po_id from so_order where id='".$sid."'");
$gtdetsrw=mysqli_fetch_array($gtdets);

$srchqr=mysqli_query($con1,"select * from new_sales_order where so_trackid='".$gtdetsrw[0]."'");
$pon=mysqli_fetch_array($srchqr);
$email=$pon[10];

$nm="select  bank_name,atm_id,cust_id,area,city,address,state,pincode,branch_id from demo_atm where so_id='".$pon[0]."'";
	

	    $atm=mysqli_query($con1,$nm);
$atmdets=mysqli_fetch_array($atm);

$message="<html>";
$message=$message."<table border=1><th>PO/DO No.</th><th>SO Date</th><th>Consignee Name</th><th>City</th><th>Address</th><th>Site/Sol ID</th><th>State</th>";
$message=$message."<tr><td>".$pon[2]."</td><td>".$pon[15]."</td><td>".$atmdets[0]."</td><td>".$atmdets[4]."</td><td>".$atmdets[5]."</td><td>".$atmdets[1]."</td><td>".$atmdets[6]."</td>";
$message=$message."<tr></table></br></br>";


$message=$message."<table border=1><th>Invoice No.</th><th>Invoice date</th><th>Courier Name</th><th>Docket No.</th><th>ETD</th><th>Dispatch Date</th><th>Delivery Date</th>";
$message=$message."<tr><td>".$invno."</td><td>".$date1."</td><td>".$cname."</td><td>".$dno."</td><td>".$estdate."</td><td>".$date2."</td><td>".$deldt."</td>";
$message=$message."<tr></table></br></br>";


 
$message=$message."</html>";

$subject="Sales Order Update-".$atmdets[1];
if($email!="")
{
$headers = "From: <Operations@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
		mail($email, $subject, $message, $headers);

}

	//mysqli_query($con1,"update pending_installations set status=1 where id='".$sid."'");

	echo 'Invoice edited successfully.';
	}
	else
        echo 'Error Occurred. Please <a href="new_edit_inv.php?id='.$sid.'" >GO BACK</a> and try again.';
	echo '</center>';
 
 echo '<script> window.setTimeout("window.close()", 1000); </script>';
 
?>