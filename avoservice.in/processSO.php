<?php
session_start();
	include('config.php');
 
$error=0;

	$sid=$_POST['sid'];
 	//echo "cust=".$cust."<br>";
 	$invno=$_POST['invno'];
	$date1=$_POST['date1'];
	$invval=$_POST['invval'];
	$cname=$_POST['cname'];
	$dno=$_POST['dno'];
	$estdate=$_POST['estdate'];
	$date2=$_POST['date2'];
	$crn=$_POST['crn'];
	$crndate=$_POST['crndate'];
	$crnamt=$_POST['crnamt'];
	$crnfile=$_POST['crnfile'];
	$target_dir = "invoices/";
	$target_dir1 = "creditnotes/";
	//echo $_POST['invfile'];
$deldt="0000-00-00";
if($_POST['deldt']!="")
{
$daten = str_replace('/', '-', $_POST['deldt']);
$deldt= date('Y-m-d', strtotime($daten));
}

        $target_file = $target_dir . $_FILES['invfile']['name']; echo "DB--file:".$target_file ;
        $target_file1 = $target_dir1 . $_FILES['crnfile']['name']; //echo "file:".$target_file1 ; 
        $uploadOk = 1;
       // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
       
     //  $qry=mysqli_query($con1,"insert into sales_orders(po_id,inv_no,inv_date,inv_value,courier,docketno,est_date,dis_date,crn_no,crn_date,crn_amount,del_date) values('".$sid."','".$invno."',STR_TO_DATE('".$date1."','%d/%m/%Y'),'".$invval."','".$cname."','".$dno."',STR_TO_DATE('".$estdate."','%d/%m/%Y'),STR_TO_DATE('".$date2."','%d/%m/%Y'),'".$crn."',STR_TO_DATE('".$crndate."','%d/%m/%Y'),'".$crnamt."','".$deldt."')");
       
        //$check = getimagesize($_FILES['invfile']['tmp_name']); echo "image:".$check;
     $lid=mysqli_INSERT_ID();  
     
      
        // if(move_uploaded_file($_FILES["invfile"]["tmp_name"], $target_file)){          
         // mysqli_query($con1,"UPDATE sales_orders set inv_img='".$target_file."',inv_img_time='".date("Y-m-d H:i:s")."' where id='".$lid."'");
        //  }
             //$check1 = getimagesize($_FILES['crnfile']['tmp_name']); //echo "image:".$check;
         if(move_uploaded_file($_FILES["crnfile"]["tmp_name"], $target_file1)){
                           //    mysqli_query($con1,"UPDATE sales_orders set crn_img='".$target_file1."' where id='".$lid."'");
                              
                                }           
	 
	echo '<center><br><br><br>';
	if($qry)
{


$srchqr=mysqli_query($con1,"select * from pending_installations where id='".$sid."'");
$pon=mysqli_fetch_array($srchqr);
$email=$pon[17];
if($pon[7]=="AMC")
{
$nm="select bankname,atmid,cid,area,city,address,state,pincode,branch from Amc where amcid='".$pon[1]."'";

}
	else{
	
$nm="select  bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id from atm where track_id='".$pon[1]."'";
	}

	    $atm=mysqli_query($con1,$nm);
$atmdets=mysqli_fetch_array($atm);

$message="<html>";
$message=$message."<table border=1><th>PO NO</th><th>SO DATE</th><th>BANK NAME</th><th>Address</th><th>SITE ID</th>";
$message=$message."<tr><td>".$pon[2]."</td><td>".$pon[4]."</td><td>".$atmdets[0]."</td><td>".$atmdets[5]."</td><td>".$atmdets[1]."</td>";
$message=$message."<tr></table></br></br>";


$message=$message."<table border=1><th>INVOICE NO</th><th>INVOICE DATE</th><th>COURIER NAME</th><th>DOCKET NO</th><th>ETA</th><th>DISPATCH DATE</th><th>DELIVERY DATE</th>";
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

}
}else
{
$error++;
}


if($error=="0")
{
	mysqli_query($con1,"update pending_installations set status=1 where id='".$sid."'");
	echo 'Invoice generated successfully.';
	}
	else{
        echo 'Error Occurred. Please <a href="salesorder.php?id='.$sid.'" >GO BACK</a> and try again.';
	
	}
	echo '</center>';
	
	
	?>