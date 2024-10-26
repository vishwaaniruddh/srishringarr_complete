<?php
session_start();
	include('config.php');




function get_data($parameter,$soid){
    global $con1;

    $sql = mysqli_query($con1,"select $parameter from new_sales_order where so_trackid='".$soid."'");

    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}



$error=0;

	$sid=$_POST['sid'];
	
	
	
	$customer_vertical = get_data('po_custid',$sid);
	$atm_id = get_data('atm_id',$sid);
	$avo_branch = get_data('branch_id',$sid);

 	//echo "cust=".$cust."<br>";
 	$invno=$_POST['invno'];
	$date1=$_POST['date1'];

	$invval=$_POST['invval'];
	$del_mode=$_POST['del_mode'];
	$cname=$_POST['cname'];
	$dno=$_POST['dno'];
	$crn=$_POST['crn'];
	


	$crnamt=$_POST['crnamt'];
	//	$crnfile=$_POST['crnfile'];
	

	if($cname==''){$crndate='NULL';}
	if($dno==''){$dno='NULL';}
	if($crn==''){$crn='NULL';}
	

	$target_dir = "invoices050922/";
	$target_dir1 = "creditnotes/";

if($_POST['date2']!="")
{
$datdist = str_replace('/', '-', $_POST['date2']);
$date2= date('Y-m-d', strtotime($datdist));
} else {
$date2="0000-00-00";    
}		

if($_POST['estdate']!="")
{
$datest = str_replace('/', '-', $_POST['estdate']);
$estdate= date('Y-m-d', strtotime($datest));
} else {
$estdate="0000-00-00";    
}

if($_POST['crndate']!="")
{
$datcrn = str_replace('/', '-', $_POST['deldt']);
$crndate= date('Y-m-d', strtotime($datcrn));
} else {
$crndate="0000-00-00";    
}

if($_POST['deldt']!="")
{
$daten = str_replace('/', '-', $_POST['deldt']);
$deldt= date('Y-m-d', strtotime($daten));
} else {
$deldt="0000-00-00";    
}

        $target_file = $target_dir . $_FILES['invfile']['name']; 
        
        //echo "file:".$target_file ;

         $target_file1 = $target_dir1 . $_FILES['crnfile']['name'];
        //echo "file:".$target_file1 ; 
        
        $uploadOk = 1;
      $qry=mysqli_query($con1,"insert into so_order(po_id,inv_no,inv_date,inv_value,courier,docketno,est_date,dis_date,crn_no,crn_date,crn_amount,status,inv_img,customer_vertical,atm_id,avo_branch, del_mode) values('".$sid."','".$invno."',STR_TO_DATE('".$date1."','%d/%m/%Y'),'".$invval."','".$cname."','".$dno."','".$estdate."','".$date2."','".$crn."','".$crndate."','".$crnamt."','1','".$target_file."','".$customer_vertical."','".$atm_id."','".$avo_branch."', '".$del_mode."')");
 

        //$check = getimagesize($_FILES['invfile']['tmp_name']); echo "image:".$check;
     $lid=mysqli_insert_id($con1);  
     
      
         if(move_uploaded_file($_FILES["invfile"]["tmp_name"], $target_file)){          
          mysqli_query($con1,"UPDATE so_order set inv_img='".$target_file."',inv_img_time='".date("Y-m-d H:i:s")."' where id='".$lid."'");
          }
             //$check1 = getimagesize($_FILES['crnfile']['tmp_name']); //echo "image:".$check;
         if(move_uploaded_file($_FILES["crnfile"]["tmp_name"], $target_file1)){
    mysqli_query($con1,"UPDATE so_order set crn_img='".$target_file1."' where id='".$lid."'");
                              
                                }           
	 
//	echo '<center><br><br><br>';
	if($qry)
{

	mysqli_query($con1,"update new_sales_order set status=2 where so_trackid='".$sid."'");

//=============whatsApp

$qryal=mysqli_query($con1,"Select * from new_sales_order where so_trackid='".$sid."'");
$sorow=mysqli_fetch_row($qryal);

$poqry=mysqli_query($con1,"Select po_no from purchase_order where id='".$sorow[1]."'");
$po=mysqli_fetch_row($poqry);

$cusal=mysqli_query($con1,"Select cust_name from customer where cust_id='".$sorow[3]."'");
$cust=mysqli_fetch_row($cusal);

$brqry=mysqli_query($con1,"Select name from avo_branch where id='".$sorow[4]."'");
$br=mysqli_fetch_row($brqry);


$atmqry=mysqli_query($con1,"select * from demo_atm where so_id='".$sid."'");
$atmrow=mysqli_fetch_row($atmqry);

$executive_qry = mysqli_query($con2,"SELECT exe_contact FROM salesteam where exe_id = '".$po[11]."'");
$exec=mysqli_fetch_row($executive_qry);
$exe_mob=$exec[0];

if($estdate=='') { $estdate="Will let you know";} 
if($deldt=='') { $deldt="Will let you know once delivered";} 

        $MassageNew = "[IN] *Switching AVO Electro Power Ltd*";
        $Massage1="*Invoice is raised against your PO:* ".$po[0];
      //  $Massage2="Materials will be billed & dispatched Shortly !!";
        $Massage3="======== Sales Order Details ========";
        $Massage4="*Vertical:* ".$cust[0];
        $Massage5="*Site /Sol / ATM Id:* ".$sorow[7];
        $Massage6="*End User Name:* ".$atmrow[6] ;
        $Massage7="*Delivery Address:* ".$atmrow[11] ;
        $Massage8="*State:* ".$atmrow[13] ;
        $Massage9="======== Invoice Details ========";
        $Massage10="*Invoice No:* ".$invno ;
        $Massage11="*Invoice Date:* ".$date1 ;
        $Massage12="*Expected Date of Delivery:* ".$estdate ;
        $Massage13="*Expected Date of Delivery:* ".$estdate ;
       
        
$exe_mob=$exec[0]; 

$cmobile=$sorow[10];
$gmobile=$sorow[19];
$whats_no=$exe_mob.",".$cmobile.",".$gmobile;
//$whats_no=$exe_mob;

$allMessage = $MassageNew."\n".$Massage1."\n".$Massage3."\n".$Massage4."\n".$Massage5."\n".$Massage6."\n".$Massage7."\n".$Massage8."\n".$Massage9."\n".$Massage10."\n".$Massage11."\n".$Massage12."\n".$Massage13;

//echo $allMessage;

//SendWhatmsg($whats_no,$allMessage);	


$tomail=$sorow[11];
$ccmail=$sorow[18];

if (filter_var($ccmail, FILTER_VALIDATE_EMAIL)) {
     $email=$tomail.",".$ccmail; 
   }
   else{
      $email = $tomail;
   }

$message="<html>";
$message=$message."<table border=1><th>DO No</th><th>DO Date</th><th>Consignee</th><th>Address</th><th>City</th><th>Site/Sol ID</th><th>State</th>";

$message=$message."<tr><td>".$sorow[2]."</td><td>".$sorow[15]."</td><td>".$atmrow[6]."</td><td>".$atmrow[11]."</td><td>".$atmrow[9]."</td><td>".$atmrow[1]."</td><td>".$atmrow[13]."</td>";
$message=$message."<tr></table></br></br>";


$message=$message."<table border=1><th>Invoice No</th><th>Invoice Date</th><th>Courier Name</th><th>Docket No</th><th>Exp time of Delivery</th><th>Dispatch Date</th><th>Delivery Date</th>";
$message=$message."<tr><td>".$invno."</td><td>".$date1."</td><td>".$cname."</td><td>".$dno."</td><td>".$estdate."</td><td>".$date2."</td><td>".$deldt."</td>";
$message=$message."<tr></table></br></br>";


 
$message=$message."</html>";

$subject="Invoice generated-".$atmrow[1];
if($email!="")
{
$headers = "From: <AVO-eAccounts@avoservice.in>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
		mail($email, $subject, $message, $headers);
}

}else
{
    
echo $error++;
}


if($error=="0")
{
// 	mysqli_query($con1,"update pending_installations set status=1 where id='".$sid."'");
	echo '<script>
	alert("Invoice generated successfully.");
	window.location.href="view_sales_order.php";
	</script>';
	
	

	}
 	else{
        echo 'Error Occurred. Please <a href="view_sales_order.php?id='.$sid.'" >GO BACK</a> and try again.';
	
 	}
	echo '</center>';


	
	?>