<?php
session_start();
	include('config.php');
	include("access.php");


$error=0;
 	
 	$po_id= $_POST['po_id'];
 	$invno=$_POST['invno'];
	$invval=$_POST['invval'];
	$bill_sites=$_POST['bill_sites'];
	$period = $_POST['period'];
	$user=$_SESSION['user'];
	$entry=date('Y-m-d H:i:s');

$daten = str_replace('/', '-', $_POST['date']);
$date= date('Y-m-d', strtotime($daten));

$start1 = str_replace('/', '-', $_POST['start']);
$start= date('Y-m-d', strtotime($start1));

$exp1 = str_replace('/', '-', $_POST['expiry']);
$expiry= date('Y-m-d', strtotime($exp1));

	$target_dir = "amc_invoices/";
      $target_file = $target_dir . $po_id . $_FILES['invfile']['name']; 
      //  echo "file:".$target_file ;

        $uploadOk = 1;
//======

   $qry=mysqli_query($con1,"insert into amc_bills(po_id,inv_no,inv_date,inv_value,bill_start,bill_end,created_by,time, billed_sites, period) values('".$po_id."','".$invno."','".$date."','".$invval."','".$start."','".$expiry."','".$user."','".$entry."', '".$bill_sites."' , '".$period."')");
          
     $lid=mysqli_insert_id($con1);  
     
      
         if(move_uploaded_file($_FILES["invfile"]["tmp_name"], $target_file)){          
          mysqli_query($con1,"UPDATE amc_bills set inv_file='".$target_file."'where id='".$lid."'");
          }
    
	if($qry)
{
$srchqr=mysqli_query($con1,"select * from amc_po_new where po_id='".$po_id."'");
$pon=mysqli_fetch_assoc($srchqr);

$exp_date=$pon['exp_date'];

if($exp_date == $expiry){
    $bill_status='2';
}
 elseif ($exp_date > $expiry){
     $bill_status='1';
 }
mysqli_query($con1,"update amc_po_new set bill_status='".$bill_status."' where po_id='".$po_id."'");


/*$email=$pon[10];

$nm="select bank_name,atm_id,cust_id,area,city,address,state,pincode,branch_id from demo_atm where so_id='".$sid."'";

    $atm=mysqli_query($con1,$nm);
$atmdets=mysqli_fetch_array($atm);

$message="<html>";
$message=$message."<table border=1><th>DO No</th><th>SO Date</th><th>Consignee</th><th>Address</th><th>City</th><th>Site/Sol ID</th><th>State</th>";
$message=$message."<tr><td>".$pon[2]."</td><td>".$pon[14]."</td><td>".$atmdets[0]."</td><td>".$atmdets[5]."</td><td>".$atmdets[4]."</td><td>".$atmdets[1]."</td><td>".$atmdets[6]."</td>";
$message=$message."<tr></table></br></br>";

$message=$message."<table border=1><th>Inoce No</th><th>Invoice Date</th><th>Courier Name</th><th>Docket No</th><th>Exp time of Delivery</th><th>Dispatch Date</th><th>Delivery Date</th>";
$message=$message."<tr><td>".$invno."</td><td>".$date1."</td><td>".$cname."</td><td>".$dno."</td><td>".$estdate."</td><td>".$date2."</td><td>".$deldt."</td>";
$message=$message."<tr></table></br></br>";
$message=$message."</html>";

$subject="SO UPDATE-".$atmdets[1];
if($email!="")
{
$headers = "From: <Accounts@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
		mail($email, $subject, $message, $headers);
}*/

}else
{
$error++;
}

if($error=="0")
{
	echo '<script>
	alert("Invoice generated successfully.");
	window.opener.location.reload();
	self.close();

		</script>';

	}
 	else{
        echo 'Error Occurred. Please <a href="amc_sales_order.php?id='.$sid.'" >GO BACK</a> and try again.';
	
 	}
	echo '</center>';
	?>