<?php
include_once 'andi/GCM.php';
session_start();
include("config.php");
$atm=$_POST['trackid'];
$cust=$_POST['cust'];
$bank=$_POST['bank'];
$state=$_POST['state'];

$city=$_POST['city'];
$area=$_POST['area'];
$add=$_POST['address'];
$pin=$_POST['pin'];
$adate=$_POST['adate'];
///$cdate=$_GET['cdate'];
$prob=$_POST['prob'];
$cname=$_POST['cname'];
$cphone=$_POST['cphone'];
$cemail=$_POST['cemail'];
//$call=$_POST['call'];
$cdate = date('Y-m-d H:i:s');
$po=$_POST['po'];
 $asset=$_POST['assetsme'];


// print_r($asset);
 //$strhy=array();
  
/* for($i=0;$i<count($asset);$i++)
 {
	 $strhy=explode("-",$asset[$i]);
	 $asstre = $strhy[0];
	$qtyre = $strhy[1];
	echo $qtyre;
 }*/
/*for($i=0;$i<count($asset);$i++)
{
	$strhy=explode("-",$asset[$i]);
	 $asstre = $strhy[0];
	$qtyre = $strhy[1];
//echo $qtyre;
$tab1=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert_assets',array("alert_id","po","assets","qty"),array($id,$po,$assetre,$qtyre));
}*/

include('class_files/insert.php');
$in_obj=new insert();
include("config.php");

//==for branch
//echo "select branch_id from state where state like('$state')";
$branch_avo=mysqli_query($con1,"select branch_id from state where state like('$state')");
$branch_avo1=mysqli_fetch_row($branch_avo);


$buy=0;
$bdesc='';
if(isset($_POST['buybk']))
{
$buy=1;

if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['buybkdesc']))
{
   $bdesc=str_replace("'","\'",$_POST['buybkdesc']);
}
else
$bdesc=$_POST['buybkdesc'];
}


//echo "Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`state`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`entry_date`,`po`) Values('".$cust."','".$atm."','".$bank."','".$area."','".$add."','".$city."','".$state."','".$pin."','".$prob."','".$cname."','".$cphone."','".$cemail."','".$adate."','Pending','new','".$cdate."','".$po."')";
$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);
$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
$query=mysqli_query($con1,"Insert into alert(`cust_id`,`atm_id`,`bank_name`,`area`,`address`,`city`,`branch_id`,`pincode`,`problem`,`caller_name`,`caller_phone`,`caller_email`,`alert_date`,`call_status`,`alert_type`,`po`,`state1`,`buyback`,`createdby`,`subject`,`custdoctno`,`assetstatus`) Values('".$cust."','".$atm."','".$bank."','".$area."','".$add."','".$city."','".$branch_avo1[0]."','".$pin."','".$prob."','".$cname."','".$cphone."','".$cemail."',STR_TO_DATE('".$adate."','%d/%m/%Y'),'1','new','".$po."','".$state."','".$buy."','".$qry2ro[0]."_".date("ymd").$num3."','".$_POST['sub']."','".$_POST['doc']."','site')");

if(!$query)
echo "failed".mysqli_error();

/*$tab=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert',array("cust_id","atm_id","bank_name","area","address","city","state","pincode","problem","caller_name","caller_phone","caller_email","alert_date","call_status","alert_type","entry_date","po"),array($cust,$atm,$bank,$area,$add,$city,$state,$pin,$prob,$cname,$cphone,$cemail,$adate,'Pending','New Installation',$cdate,$po));*/
$id=mysqli_insert_id();
if($buy=='1')
$buyback=mysqli_query($con1,"INSERT INTO `buyback` (`id`, `alertid`, `desc`, `status`) VALUES (NULL, '".$id."', '".$bdesc."', '0')");

//echo "INSERT INTO `satyavan_accounts`.`buyback` (`id`, `alertid`, `desc`, `status`) VALUES (NULL, '".$id."', '".$bdesc."', '0')";

//echo "Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$id."' where alert_id='".$id."'";
//$up=mysqli_query($con1,"Update alert set `createdby`='".$qry2ro[0]."_".date("Ymd").$id."' where alert_id='".$id."'");


//echo "Update alert set `createdby`='".$_SESSION[user]."'_'".$id."' where alert_id='".$id."'";
//$sq=mysqli_query($con1,"select max(alert_id) from alert");
//$ro=mysqli_fetch_row($sq);

/*for($i=0;$i<count($asset);$i++){
echo "<br>".$asset[$i]." ".$qty[$i];
$tab1=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert_assets',array("alert_id","po","assets","qty"),array($id,$po,$asset[$i],$qty[$i]));
}*/
/*for($i=0;$i<count($asset);$i++)
{
	$strhy=explode("-",$asset[$i]);
	 $asstre = $strhy[0];
	$qtyre = $strhy[1];
//echo $qtyre;
$tab1=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert_assets',array("alert_id","po","assets","qty"),array($id,$po,$asstre,$qtyre));
}*/
for($i=0;$i<count($asset);$i++)
{
	$strhy=explode("-",$asset[$i]);
	 $asstre = $strhy[0];
	$qtyre = $strhy[1];
	//echo $qtyre;
	$qtyex=explode("*",$qtyre);
	$qtyfinal=$qtyex[0];
	$valid=$qtyex[1];
	//echo $qtyfinal;
	//echo $valid;
//echo $qtyre;
$qryst=mysqli_query($con1,"INSERT INTO `alert_assets` (`id`, `alert_id`, `po`, `assets`, `qty`, `valid`) VALUES (NULL, '".$id."', '".$po."', '".$asstre."', '".$qtyfinal."', '".$valid."')");
}
if($query)
{
$message2="";
		//echo "Select state_id from state where state='".$state"'";
		$qry1=mysqli_query($con1,"Select state_id from state where state='".$state."'");
		if(mysqli_num_rows($qry1)>0)
		{
		$resltrow=mysqli_fetch_row($qry1);
		$message2="You have  New Alerts";
			$qry2=mysqli_query($con1,"Select * from login where designation='3'");
			$srno=array();
			while($max1=mysqli_fetch_row($qry2))
				{
				//echo $max1[3]."<br>";
				$br=explode(",",$max1[3]);
				for($i=0;$i<count($br);$i++)
				{
				//echo "<br>br=".($br[$i])."<br>";
					if($br[$i]==$resltrow[0])
					{
					$srno[]=$max1[0];
					break;
					}
				}
					
				
				}
				$logid=implode(",",$srno);
				//echo "Select gcm_regid from notification_tble where logid in($logid)";
				$qryreslt=mysqli_query($con1,"Select gcm_regid from notification_tble where logid in($logid)");
				if(mysqli_num_rows($qryreslt)>0)
				{
				$str2=array();
						while($maxnew=mysqli_fetch_row($qryreslt))
						{
							$str2[]=$maxnew[0];
						
						}
						//$maxnew=mysqli_fetch_row($qryreslt);
						//$str2=$maxnew[0];
				//print_r($str2);
				
						 $gcm = new GCM();
							//$registatoin_ids = $str2;
							// echo $str2." ".$message2;
							$message = array("alert" => $message2);
						
							$result = $gcm->send_notification($str2, $message);
				}
		}

//echo $atm;
?>
<script type="text/javascript">
alert("Alert created successfully and complaint number is <?php echo $qry2ro[0]."_".date("ymd").$num3; ?>");
window.location='newalert.php';
</script>
<?php
	//header('Location:newalert.php');
}
else
echo "Error Creating Alert".mysqli_error();
 ?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>




