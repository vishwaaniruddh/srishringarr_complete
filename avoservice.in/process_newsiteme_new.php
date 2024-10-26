<?php
session_start();
	include('config.php');
 	$cust=$_POST['cust'];
 	//echo "cust=".$cust."<br>";
 	$type=$_POST['type'];
 	
 	
	$service=$_POST['servicetype'];
	$pordr=$_POST['po'];
	$atm=$_POST['atm'];
	$bank=$_POST['bank'];
	$area=$_POST['area'];
	$pincode=$_POST['pin'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$site_branch=$_POST['site_branch'];
	$addr=htmlspecialchars($_POST['address']);	
	$ref=$_POST['ref'];
	$dateget=$_POST['dt']; 
	$nos=$_POST['nos']; 
//$bomno=$_POST['bomno'];
//$bomdate=$_POST['bomdate'];
//$indentno=$_POST['indentno'];
//$indentdate=$_POST['indentdate'];
//$ed=$_POST['ed'];
//$vat=$_POST['vat'];
//$dono=$_POST['dono'];
//$freight=$_POST['freight'];
	$upsrate=$_POST['upsrate'];
	$batteryrate=$_POST['batteryrate'];
	$isotrate=$_POST['isotrate'];
	$stabrate=$_POST['stabrate'];
	$avrrate=$_POST['avrrate'];
//$cat=$_POST['cat'];
 
//$dtstr=STR_TO_DATE('".$dateget."','%Y/%m/%d');
//echo $dtstr;
 //$dtrep=str_replace("/","-",$dateget);
  	$ups=$_POST['ups'];
 	$upsno=$_POST['upsno'];
	$upswr=$_POST['upswr'];
 	$btry=$_POST['btry'];
 	$btryno=$_POST['btryno'];
	$btrywr=$_POST['btrywr'];
	$isot=$_POST['isot'];
	$isotno=$_POST['isotno'];
	$isotwr=$_POST['isotwr'];
	$stab=$_POST['stab'];
	$stabno=$_POST['stabno'];
	$stabwr=$_POST['stabwr'];
 	$avr=$_POST['avr'];
 	$avrno=$_POST['avrno'];
	$avrwr=$_POST['avrwr'];
	$del_type=$_POST['deltype'];
	if(isset($_POST['ed']))
        $ed=$_POST['ed'];
	$ubrate=$_POST['ubrate'];
	$batbrate=$_POST['batbrate'];
	$isobrate=$_POST['isobrate'];
	$stbrate=$_POST['stbrate'];
	$avbrate=$_POST['avbrate'];
	$oth=$_POST['oth'];
	$othrate=$_POST['othrate'];
	$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);
	//echo "<br>select * from alert where entry_date LIKE ('".date('Y-m-d')."%')";
	$qrr=mysqli_query($con1,"select * from alert where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
//=============================inserting code start here==========================================
	
if($_POST['mysub']=="submit")
{
	
		 $add=mysqli_query($con1,"select * from `purchase_order` where `po_no`='".$pordr."'");
		 if(mysqli_num_rows($add)>0){}
		 else{
		 $result12=mysqli_query($con1,"insert into `purchase_order`(po_no,no_sites,cust_id,ref_id,pm,po_date,ed,del_type) VALUES ('".$pordr."','".$nos."','".$cust."','".$ref."','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'".$ed."','".$del_type."')");
		 	//echo "insert into`purchase_order` VALUES ('".$pordr."','".$nos."','".$cust."','".$ref."','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'".$ed."','".$del_type."')";   
		   if($upsno>0)
	{
	//echo "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) values('".$pordr."','UPS','".$ups."','".$upsno."','".$upswr."','".$upsrate."')";
		   
		   
	 $addasset=mysqli_query($con1,"insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','UPS','".$ups."','".$upsno."','".$upswr."','".$upsrate."')"); 
	 }
	 if($btryno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','NEW','".$atm."')";
	
	 $addasset=mysqli_query($con1,"insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','Battery','".$btry."','".$btryno."','".$btrywr."','".$batteryrate."')"); 
	 }
	 
	 if($isotno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$atm."')";
	
	$addasset=mysqli_query($con1,"insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','Isolation Transformer','".$isot."','".$isotno."','".$isotwr."','".$isotrate."')");
	 }
	 if($stabno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";
	
	$addasset=mysqli_query($con1,"insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','Stabilizer','".$stab."','".$stabno."','".$stabwr."','".$stabrate."')");
	 }
	 if($avrno>0)
	{

	echo "insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','AVR','".$avr."','".$avrno."','".$avrwr."','".$avrrate."')";
	
	
	$addasset=mysqli_query($con1,"insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','AVR','".$avr."','".$avrno."','".$avrwr."','".$avrrate."')");
	 }
	 if(isset($oth) and $oth!='')
	 {
	  $addasset=mysqli_query($con1,"insert into `po_assets` (`po_no`,`assets_name`,`rate`) 
		   values('".$pordr."','".$oth."','".$othrate."')");
	 }	
		 }
	 	
	
//echo "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1)  VALUES('$atm','$bank','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$addr')";
if($type=='sales')
{
	
//echo "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1,cat)  VALUES('$atm','$bank','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$state','$cat')";

$result= mysqli_query($con1,"INSERT INTO  atm(atm_id,bank_name,area,pincode,city,branch_id,address,ref_id,po,cust_id,servicetype,podate,state1,cat,pending_status)  
VALUES('$atm','$bank','$area','$pincode','".$city."','".$site_branch."','".$addr."','".$ref."','".$pordr."','".$cust."','".$service."', STR_TO_DATE('".$dateget."','%d/%m/%Y'),'".$state."','".$cat."',1)");
 $id=mysqli_insert_id();
 
 	$ponum=mysqli_query($con1,"select `po` from `atm` where `po`='".$pordr."'");
	$ponum1=mysqli_num_rows($ponum);
	
if($result){
		//echo "INSERT INTO `instdetails`(`atm_id`, `bomno`, `bomdate`, `indentno`, `indentdate`, `vat`, `ed`, `dono`, `freight`) VALUES ('".$id."','".$bomno."',STR_TO_DATE('".$bomdate."','%d/%m/%Y'),'".$indentno."',STR_TO_DATE('".$indentdate."','%d/%m/%Y'),'".$vat."','".$ed."','".$dono."','".$freight."')";
		$qry=mysqli_query($con1,"INSERT INTO `instdetails`(`atm_id`, `bomno`, `bomdate`, `indentno`, `indentdate`, `vat`, `ed`, `dono`, `freight`) VALUES ('".$id."','".$bomno."',STR_TO_DATE('".$bomdate."','%d/%m/%Y'),'".$indentno."',STR_TO_DATE('".$indentdate."','%d/%m/%Y'),'".$vat."','".$ed."','".$dono."','".$freight."')");
}
	if($upsno>0)
	{
	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','UPS','".$ups."','".$upswr."','".$upsno."','".$id."','NEW','".$upsrate."')";
	$result1= mysqli_query($con1,"insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','UPS','".$ups."','".$upswr."','".$upsno."','".$id."','NEW','".$upsrate."')");
	 }
	 if($btryno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','NEW','".$atm."')";
	
	$result1= mysqli_query($con1,"insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','".$id."','NEW','".$batteryrate."')");
	 }
	 
	 if($isotno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$atm."')";
	
	$result1= mysqli_query($con1,"insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$id."','NEW','".$isotrate."')");
	 }
	 if($stabno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";
	
	$result1= mysqli_query($con1,"insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$id."','NEW','".$stabrate."')");
	 }
	 if($avrno>0)
	{
	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";	
	$result1= mysqli_query($con1,"insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate)values('$cust','$pordr','AVR','".$avr."','".$avrwr."','".$avrno."','".$id."' ,'NEW','".$avrrate."')");
	 }	

	/* if($del_type=='ware_del'){
          $sql = mysqli_query($con1,"INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `status`, `call_status`, `alert_type`, `close_date`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`) VALUES (NULL, '".$cust."','".$id."' , '".$bank."', '".$area."', '".$addr."', '".$city."', '".$site_branch."', '".$pincode."', 'New Installation', STR_TO_DATE('".$dateget."','%d/%m/%Y'), STR_TO_DATE('".$dateget."','%d/%m/%Y'), 'Pending', 'Pending', 'new', '', '', '".$pordr."','site', '', 'auto','".$state."','".$qry2ro[0]."_".date("ymd").$num3."','new installation','".$ref."','satyendra1111@gmail.com')");
         }*/

	if($result){	     
		 echo "1 **##" .$ponum1;	 
		}else {
			 echo "0";
			 } 
	 
	
}
elseif($type=="AMC")
{
	echo "INSERT INTO Amc(po,cid,atmid,bankname,area,pincode,city,branch,address,Refid,state)VALUES('".$pordr."', '".$cust."', '".$atm."', '".$bank."', '".$area."', '".$pincode."', '".$city."', '".$site_branch."','".$addr."','".$ref."','".$state."')";

$result= mysqli_query($con1,"INSERT INTO Amc(po,cid,atmid,bankname,area,pincode,city,branch,address,Refid,state)VALUES('".$pordr."', '".$cust."', '".$atm."', '".$bank."', '".$area."', '".$pincode."', '".$city."', '".$site_branch."','".$addr."','".$ref."','".$state."')");
 
 $id=mysqli_insert_id();
 
 $ponum=mysqli_query($con1,"select `po` from `Amc` where `po`='".$pordr."'");
 $ponum1=mysqli_num_rows($ponum);
	
 $dt=str_replace("/","-",$dateget);
// echo $dt;
 $start=date('Y-m-d', strtotime($dt));
 //echo $start;
 //echo "INSERT INTO `satyavan_accounts`.`amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$pordr."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id."')";
  $qry=mysqli_query($con1,"INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$pordr."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id."')");
  if(!$result)
echo "".mysqli_error();
$today = strtotime($dt);

if($service=='3')
{
	
	for($i=1;$i<=4;$i++)
	{
		//echo $i."<br>";
	$j=$service*$i;
	//echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
elseif($service=='6')
{
	
	for($i=1;$i<=2;$i++)
	{
		//echo $i."<br>";
	$j=$service*$i;
	//echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$pordr."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
	
	if($upsno>0)
	{
	
//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','UPS','".$ups."','".$upsno."','".$id."')";
$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback) values('$cust','$pordr','UPS','".$ups."','".$upsno."','".$id."','".$upsrate."','".$ubrate."')");
	}
	
	if($btryno>0)
	{
	
//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Battery','".$btry."','".$btryno."','".$id."')";
$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback) values('$cust','$pordr','Battery','".$btry."','".$btryno."','".$id."','".$upsrate."','".$batbrate."')");
	}
	
	if($isotno>0)
	{
	
//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotno."','".$id."')";
$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback) values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotno."','".$id."','".$batteryrate."','".$isobrate."')");
	}
	
	if($stabno>0)
	{
	
//echo "insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$pordr','Stabilizer','".$stab."','".$stabno."','".$id."')";
$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback) values('$cust','$pordr','Stabilizer','".$stab."','".$stabno."','".$id."','".$isotrate."','".$stbrate."')");
	}
	
	 if($avrno>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";
	
	$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback) values('$cust','$pordr','AVR','".$avr."','".$avrno."','".$id."','".$avrrate."','".$avbrate."')");
	 }
	 if(isset($oth) and $oth!='')
	 {
	  $insert=mysqli_query($con1,"insert into `amcassets` (amcid,amcpoid,assets_name,siteid,rate) 
		   values('$cust','".$pordr."','".$oth."','".$id."','".$othrate."')");
	 }	
/*
if($del_type=='ware_del'){
          $sql = mysqli_query($con1,"INSERT INTO `alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `branch_id`, `pincode`, `problem`, `entry_date`, `alert_date`, `status`, `call_status`, `alert_type`, `close_date`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`,`ccmail`) VALUES (NULL, '".$cust."','".$id."' , '".$bank."', '".$area."', '".$addr."', '".$city."', '".$site_branch."', '".$pincode."', 'Amc Installation', STR_TO_DATE('".$dateget."','%d/%m/%Y'), STR_TO_DATE('".$dateget."','%d/%m/%Y'), 'Pending', 'Pending', 'amc', '', '', '".$pordr."','amc', '', 'auto','".$state."','".$qry2ro[0]."_".date("ymd").$num3."','amc installation','".$ref."','satyendra1111@gmail.com')");
         }*/

	if($insert){	     
		 echo "1 **##" .$ponum1;	 
		}else {
			 echo "0";
			 } 
}


}
else if($_POST['update']=='update')
{

//======================================Query For Update=============================================================
$po_id=$_POST['poid'];
$qryedit=mysqli_query($con1,"select * from purchase_order where id='".$po_id."'");
 if(mysqli_num_rows($qryedit)>0){
		 
$fetcheditqry=mysqli_query($con1,$qryedit);

$qryst=mysqli_query($con1,"Update purchase_order set no_sites='".$nos."',cust_id='".$cust."',ref_id='".$ref."',pm='".$service."',po_date=STR_TO_DATE('".$dateget."','%d/%m/%Y'),del_type='".$del_type."',ed='".$ed."' where `po_no`='".$pordr."' where PO='".$fetcheditqry[0]."'");

 if($upsno>0)
	{	   
	 $addasset=mysqli_query($con1,"Update `po_assets` set `assets_name`='UPS',`specs`='".$ups."',`qty`='".$upsno."',`warranty`='".$upswr."',`rate`='".$upsrate."' where po_no='".$pordr."'"); 
		
	 }
	  if($btryno>0)
	{
	 $addasset=mysqli_query($con1,"Update `po_assets` set `assets_name`='Battery',`specs`='".$btry."',`qty`='".$btryno."',`warranty`='".$btrywr."',`rate`='".$batteryrate."' where `po_no`='".$pordr."'");
		   
	 }
	  if($isotno>0)
	{
	$addasset=mysqli_query($con1,"Update `po_assets` set `assets_name`='Isolation Transformer',`specs`='".$isot."',`qty`='".$isotno."',`warranty`='".$isotwr."',`rate`='".$isotrate."' where `po_no`='".$pordr."'") ;
		   values('".$pordr."',,,=,,)");
	 }
	 if($stabno>0)
	{
	$addasset=mysqli_query($con1,"Update `po_assets`  set `assets_name`='Stabilizer',`specs`='".$stab."',`qty`='".$stabno."',`warranty`='".$stabwr."',`rate`='".$stabrate."'" where `po_no`='".$pordr."'") ;
		  
	 }
	  if($avrno>0)
	{
	
	$addasset=mysqli_query($con1,"update `po_assets` set `assets_name`='AVR',`specs`='".$avr."',`qty`='".$avrno."',`warranty`='".$avrwr."',`rate`='".$avrrate."' where `po_no`='".$pordr."'");
		   
	 }
	 if(isset($oth) and $oth!='')
	 {
	  $addasset=mysqli_query($con1,"update `po_assets` set `assets_name`='".$oth."',`rate`='".$othrate."' where `po_no`='".$pordr."'");
		  
	 }	
	 }
	 
//=========================
	 if($type=='sales')
{
	
//echo "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1,cat)  VALUES('$atm','$bank','$area','$pincode','$city','$state','$addr','".$ref."','$pordr','$cust','".$service."',STR_TO_DATE('".$dateget."','%d/%m/%Y'),'$state','$cat')";

$result= mysqli_query($con1,"Update atm set atm_id='$atm',bank_name='$bank',area='$area',pincode='$pincode',city='".$city."',branch_id'".$site_branch."',address='".$addr."',ref_id='".$ref."',po=,cust_id='".$cust."',servicetyp='".$service."',podate=STR_TO_DATE('".$dateget."','%d/%m/%Y'),'",state1='".$state."',cat='".$cat."',pending_status=1 where `po_no`='".$pordr."'")  

// $id=mysqli_insert_id();
 
 	$ponum=mysqli_query($con1,"select atm_id,`po` from `atm` where `po`='".$pordr."'");
         $ponum_num=mysqli_num_rows($ponum);
	$ponum1=mysqli_fetch_query($ponum);
	
if($result){
		$qry=mysqli_query($con1,"Update `instdetails` set `atm_id`='".$id."', `bomno`='".$bomno."', `bomdate`=STR_TO_DATE(,'%d/%m/%Y'), `indentno`='".$indentno."',`indentdate`='".$indentdate."' , `vat`='".$vat."', `ed`='".$ed."', `dono`'".$dono."', `freight`='".$freight."' where atm_id='".$ponum1[0]."'");
}
	if($upsno>0)
	{
	$result1= mysqli_query($con1,"Update  `site_assets` set cust_id='$cust',assets_name='UPS',assets_spec='".$ups."',valid='".$upswr."',quantity='".$upsno."',type='NEW',rate='".$upsrate."' where atm_id='".$ponum1[0]."'");
	 }
	 if($btryno>0)
	{

	
	$result1= mysqli_query($con1,"Update `site_assets` set cust_id='$cust',assets_name='Battery',assets_spec='".$btry."',valid='".$btrywr."',quantity='".$btryno."',type='NEW',rate='".$batteryrate."' where atm_id='".$ponum1[0]."'");
	 }
	 
	 if($isotno>0)
	{

	
	$result1= mysqli_query($con1,"Update  `site_assets` set cust_id='$cust',assets_name='Isolation Transformer',assets_spec='".$isot."',valid='".$isotwr."',quantity='".$isotno."',type='NEW',rate='".$isotrate."' where atm_id='".$ponum1[0]."'");
	 if($stabno>0)
	{

	
	$result1= mysqli_query($con1,"Update `site_assets` set cust_id='$cust',assets_name='Stabilizer',assets_spec='".$stab."',valid='".$stabwr."',quantity='".$stabno."',type='NEW',rate='".$stabrate."' where  atm_id='".$ponum1[0]."'");
	 }
	 if($avrno>0)
	{
	$result1= mysqli_query($con1,"Update `site_assets` set cust_id='$cust',assets_name='AVR',assets_spec='".$avr."',valid='".$avrwr."',quantity='".$avrno."' ,typ='NEW',rate='".$avrrate."' where atm_id='".$ponum1[0]."'");
	 }	

	

	if($result){	     
		 echo "1 **##" .$ponum_num;	 
		}else {
			 echo "0";
			 } 
	 
	
}
//for Amc


elseif($type=="AMC")
{
	
$result= mysqli_query($con1,"Update Amc set cid='".$cust."',atmid='".$atm."',bankname='".$bank."',area='".$area."',pincode='".$pincode."',city='".$city."',branch='".$site_branch."',address='".$addr."',Refid='".$ref."',state='".$state."' where PO='".$fetcheditqry[0]."');
 
 //$id=mysqli_insert_id();
 
 $ponum=mysqli_query($con1,"select AMCID,`po` from `Amc` where `po`='".$pordr."'");
$ponum_num=mysqli_num_rows($ponum);
 $ponum1=mysqli_fetch_array($ponum);
	
 $dt=str_replace("/","-",$dateget);
// echo $dt;
 $start=date('Y-m-d', strtotime($dt));
 //echo $start;
  $qry=mysqli_query($con1,"Update `amcpurchaseorder` set `cid`='".$cust."', `po`='".$pordr."', `startdt`='".$start."', `expdt`=strtotime("+12 months $start"))."' where `amcsiteid`='".$ponum1[0]."'");
  if(!$result)
echo "".mysqli_error();
$today = strtotime($dt);

if($service=='3')
{
	
	for($i=1;$i<=4;$i++)
	{
		//echo $i."<br>";
	$j=$service*$i;
	$q=mysqli_query($con1,"Update servicemonth Set `po`='".$pordr."',`date`='".date("Y-m-d",strtotime("+".$j." months",`type`='AMC'  where `siteid`='".$ponum1[0]."'");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
elseif($service=='6')
{
	
	for($i=1;$i<=2;$i++)
	{
		//echo $i."<br>";
	$j=$service*$i;
	$q=mysqli_query($con1,"Update servicemonth set `po`='".$pordr."',`date`='".date("Y-m-d",strtotime("+".$j." months", $today))."',`type`='AMC',where `siteid`='".$ponum1[0]."'");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
	
	if($upsno>0)
	{
	
$insert=mysqli_query($con1,"Update `amcassets` set amcid='$cust',amcpoid='$pordr',assets_name='UPS',assetspecid='".$ups."',quantity='".$upsno."',rate='".$upsrate."',buyback='".$ubrate."' where siteid='".$ponum1[0]."'");
	}
	
	if($btryno>0)
	{
	
$insert=mysqli_query($con1,"Update `amcassets` set amcid='$cust',amcpoid='$pordr',assets_name='Battery',assetspecid='".$btry."',quantity='".$btryno."',rate='".$upsrate."',buyback='".$batbrate."' where siteid='".$ponum1[0]."'");
	}
	
	if($isotno>0)
	{
	
$insert=mysqli_query($con1,"Update `amcassets` set amcid='$cust',amcpoid='$pordr',assets_name='Isolation Transformer',assetspecid='".$isot."',quantity='".$isotno."' ,rate='".$batteryrate."',buyback='".$isobrate."' where siteid='".$ponum1[0]."'");
	}
	
	if($stabno>0)
	{
	
$insert=mysqli_query($con1,"Update `amcassets` set amcid='$cust',amcpoid='$pordr',assets_name='Stabilizer',assetspecid='".$stab."',quantity='".$stabno."',rate='".$isotrate."',buyback='".$stbrate."' where siteid='".$ponum1[0]."'");
	}
	
	 if($avrno>0)
	{

	
	$insert=mysqli_query($con1,"Update `amcassets` set amcid='$cust',amcpoid='$pordr',assets_name='AVR',assetspecid='".$avr."',quantity='".$avrno."',rate='".$avrrate."',buyback='".$avbrate."' where siteid='".$ponum1[0]."'");
	 }
	 if(isset($oth) and $oth!='')
	 {
	  $insert=mysqli_query($con1,"Update `amcassets` set amcid='$cust',amcpoid='$pordr',assets_name='".$oth."',rate='".$othrate."'" where siteid='".$ponum1[0]."'"); 
		   
	 }	


	if($insert){	     
		 echo "1 **##" .$ponum_num;	 
		}else {
			 echo "0";
			 } 
}

	
?>

