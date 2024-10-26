<?php
session_start();
include('config.php');
$alert=$_POST['alert'];
$eng_id=$_POST['eng_id'];
$feed=$_POST['feed'];
$upssrno=$_POST['txt1ups'];
$upsspec=$_POST['assetsups'];
$assetme=$_POST['assetsme'];
//===============================Feed Date by code=========
$fdate=date('Y-m-d H:i:s');
$dt=date('Y-m-d');
if(isset($_POST['close']))
$close="Done";
else
$close='Pending';

if(isset($_POST['stand']))
{
$stand=$_POST['stand'];
$close="Done";
}
//===============feedback================
$st='';
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $feed))
{
 $st=str_replace("'","\'",$feed);
}
else
$st=str_replace("'","\'",$feed);
//======
$qry=mysqli_query($con1,"select * from alert where alert_id='".$alert."'");
$qryro=mysqli_fetch_row($qry);
$cc=$qryro[32];
$complaintid=$qryro[25];
//============ start if For service call under warranty ===============
if($qryro[17]=='service'){
	if($qryro[21]=='amc'){
	$sitestr=mysqli_query($con1,"select atmid from Amc where amcid='".$qryro[2]."'");
	$row3=mysqli_fetch_row($sitestr);
	$atmid=$row3[0];
	}else{
		$qry3=mysqli_query($con1,"select * from atm where atm_id='".$qryro[2]."'");
		$row3=mysqli_fetch_row($qry3);
		$atmid=$row3[1];
		}
		//============update for serial no. in amcassets table==================	
		if($_POST['serial']!='' || $_POST['serial']!=null)
		$qry2=mysqli_query($con1,"update amcassets set serialno='".$_POST['serial']."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''");
		//============update for serial no. in site_assets table==================	
		if($_POST['serial']!='' || $_POST['serial']!=null)
		$qry2=mysqli_query($con1,"update `site_assets` set `serialno`='".$_POST['serial']."' where `atmid`='".$qryro[2]."' and `assets_name`='UPS' and serialno=''");

}elseif($qryro[17]=='new'){
//============ start For New call installed===============
$at=(explode("_",$qryro[2]));
if($at[0]!='temp'){
	if($qryro[21]=='amc'){
	$sitestr=mysqli_query($con1,"select atmid from Amc where amcid='".$qryro[2]."'");
	$row3=mysqli_fetch_row($sitestr);
	$atmid=$row3[0];
}else{
	$qry3=mysqli_query($con1,"select * from atm where atm_id='".$qryro[2]."'");
	$row3=mysqli_fetch_row($qry3);
	$atmid=$row3[1];
	}
if(isset($assetme)){
	$str=array();
	$qryval=mysqli_query($con1,"Select valid from alert_assets where alert_id='$alert' and assets not like '%".UPS."%'");
	while($resval=mysqli_fetch_row($qryval)){
	$str[]=$resval[0];	
	}	
	$valres=str_replace(",","",$str);
	
		for($i=0;$i<count($assetme);$i++){
			$strhy=explode("-",$assetme[$i]);
	 		$asstre = $strhy[0];
			$qtyre = $strhy[1];
			$expdt=date('Y-m-d', strtotime($dt .' +'.$valres[$i]));

$tab1=mysqli_query($con1,"insert into installed_sitesme(assets,qty,alert_id,atm_id,startdt,expdt,assetstatus)values('".$asstre."','".$qtyre."','".$alert."','".$qryro[2]."','".$dt."','$expdt','".$qryro[21]."')");


$tabeng=mysqli_query($con1,"insert into enginstalled_sites(assets,qty,alert_id,atm_id,startdt,expdt,assetstatus)values('".$asstre."','".$qtyre."','".$alert."','".$qryro[2]."','".$dt."','$expdt','".$qryro[21]."')");
	}//==for loop close
}
if(isset($upsspec)){
	$str=array();
	$qryval=mysqli_query($con1,"Select valid from alert_assets where alert_id='$alert' and assets like '%".UPS."%'");
	$resval=mysqli_fetch_row($qryval);
	$str=$resval[0];	
	//print_r($str);
	$valres=str_replace(",","",$str);
	//echo $valres;
	for($i=0;$i<count($upsspec);$i++){
	$expdt=date('Y-m-d', strtotime($dt .' +'.$valres));	
	$tab1=mysqli_query($con1,"insert into installed_sitesme(assets,qty,alert_id,atm_id,upssrno,startdt,expdt,assetstatus)values('".$upsspec[$i]."','1','".$alert."','".$qryro[2]."','".$upssrno[$i]."','".$dt."','$expdt','".$qryro[21]."')");
	$tab1=mysqli_query($con1,"insert into enginstalled_sites(assets,qty,alert_id,atm_id,upssrno,startdt,expdt,assetstatus)values('".$upsspec[$i]."','1','".$alert."','".$qryro[2]."','".$upssrno[$i]."','".$dt."','$expdt','".$qryro[21]."')");
	}//for loop close
}	

}else{
		//========== Update serialno into tempsites table for temporary sites
		$atmid=$qryro[2];
		$qry1=mysqli_query($con1,"update tempsites set serialno='".$_POST['serial']."' where atmid='".$qryro[2]."' and serialno=''");
	}
}//main esle close

//====insert feedback into eng_feedback table===============
$sql=mysqli_query($con1,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`standby`,`feed_date`) Values('".$eng_id."','".$alert."','".$st."','".$stand."','".$fdate."')");
$tab1=mysqli_query($con1,"update alert set status='".$close."', standby='".$stand."' where alert_id='".$alert."'");

//============= if call is closed by eng in alert_delegation table call_close_status will become 1===============
if(isset($_POST['close'])){

}

if(!$tab1)
echo "failed".mysqli_error();
//===========================Mailing part start here ===============================
if($sql && $tab1)
{
$tbl="<html>
<head>
<title>Switching AVO Electro Power Limited</title>
</head>
<body>
<p>New Updates for for Below Site: <font color='blue'>".$st."</font></p>
<table border='1' width='700px'>
<tr><th>COMPLAINT ID</th><th>ATM ID</th><th>BANK</th><th>State</th><th>City</th><th>Address</th><th>ISSUE</th><th>STATUS</th></tr>";
  $tbl.="<tr>
		<td>".$qryro[25]."</td>
		<td>".$atmid."</td>
		<td>".$qryro[3]."</td>
		<td>".$qryro[27]."</td>
		<td>".$qryro[6]."</td>
		<td>".$qryro[5]."</td>
		<td>".$qryro[9]."</td>
		<td><b>".$close."</b></td>
	</tr>";	
	$to = "service2@avoups.com";	
	$cc=$qryro[32];
	$subject = $qryro[29];
	$tbl.="</table><br><br><font color='blue'>Switching <font color='red'>AVO</font> Electro Power Limited</font> 
			<br><br><font color='blue'>Updated By:</font> <font color='red'>".$_SESSION['user']."</font> </body></html>";
	$headers = "From:<HelpDesk@avoservice.in>\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$headers .= "Cc: ".$cc. "\r\n";
	$message=$tbl;	
	$mailqry=mail($to, $subject, $message, $headers);
	header('Location:eng_alert.php');
}
else
echo "Error Updating Alert";
?>