<?php
session_start();
	include('config.php');
	$errors=0;
	
	$pid=$_POST['poid'];/*****pending installation id ********/
 	$cust=$_POST['cust'];
 	//echo "cust=".$cust."<br>";
 	$type=$_POST['type'];
 	$newemailr=mysqli_real_escape_string($_POST['neweml']);
 	
 	$userid=$_SESSION['user'];
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
	$badd=htmlspecialchars($_POST['badd']);	
	$gst=$_POST['gst'];
	$contact=$_POST['cont'];
	$contactno=$_POST['cno'];
	$bbd=htmlspecialchars($_POST['bbd']);
	$bbdrate=$_POST['bbdrate'];	
	$ref=$_POST['ref'];
	$dateget=$_POST['dt'];  // DO date
	$podt=$_POST['podt'];   // PO date
	$sp=$_POST['sp']; 
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
        $entry_date=date('Y-m-d H:i:s');
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
	//if(isset($_POST['ed']))
        //$ed=$_POST['ed'];
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
//=============================update code start here==========================================
mysqli_query($con1,"BEGIN");	

	$qr="update `purchase_order` set buyeraddress='".$badd."',gst='".$gst."',salesperson='".$sp."' where `po_no`='".$pordr."'";
//echo $qr;

$add=mysqli_query($con1,$qr);
if(!$add)
{
echo $qr."6"."</br>";

$errors++;
}

/**************update ups ************************/
if($upsno>0)
{
	
$chkifexs=mysqli_query($con1,"select specs from po_assets where po_no='".$pordr."' and assets_name='UPS'");
$chkrws=mysqli_num_rows($chkifexs);
/*if($chkrws>0)
{
$edassetqr="update po_assets set specs='".$ups."',qty='".$upsno."',warranty='".$upswr."',rate='".$upsrate."' where po_no='".$pordr."' and assets_name='UPS'";
}else*/
if($chkrws==0)
{
$edassetqr="insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','UPS','".$ups."','".$upsno."','".$upswr."','".$upsrate."')";
}
	
if($edassetqr!="")
{
$addasset=mysqli_query($con1,$edassetqr);
if(!$addasset)
{
echo $edassetqr."5"."</br>";
$errors++;
}
}
}

/**************update battery************************/
if($btryno>0)
{
$chkifexs=mysqli_query($con1,"select specs from po_assets where po_no='".$pordr."' and assets_name='Battery'");
$chkrws=mysqli_num_rows($chkifexs);
/*if($chkrws>0)
{
$edassetqr="update po_assets set specs='".$btry."',qty='".$btryno."',warranty='".$btrywr."',rate='".$batteryrate."' where po_no='".$pordr."' and assets_name='Battery'"; 
}else*/
if($chkrws==0)
{
$edassetqr="insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','Battery','".$btry."','".$btryno."','".$btrywr."','".$batteryrate."')";
}

if($edassetqr!="")
{
$addasset=mysqli_query($con1,$edassetqr);
if(!$addasset)
{
echo $edassetqr."4"."</br>";
$errors++;
}
}
 }

/**************update Isolation Transformer************************/	
 if($isotno>0)
	{

$chkifexs=mysqli_query($con1,"select specs from po_assets where po_no='".$pordr."' and assets_name='Isolation Transformer'");
$chkrws=mysqli_num_rows($chkifexs);
/*if($chkrws>0)
{
$edassetqr="update po_assets set specs='".$isot."',qty='".$isotno."',warranty='".$isotwr."',rate='".$isotrate."' where po_no='".$pordr."' and assets_name='Isolation Transformer'"; 
}else*/
if($chkrws==0)
{
$edassetqr="insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','Isolation Transformer','".$isot."','".$isotno."','".$isotwr."','".$isotrate."')";
}
	
if($edassetqr!="")
{
$addasset=mysqli_query($con1,$edassetqr);
if(!$addasset)
{
echo $edassetqr."3"."</br>";
$errors++;
}
}
	 }

/**************update stabilizer************************/	

if($stabno>0)
	{


$chkifexs=mysqli_query($con1,"select specs from po_assets where po_no='".$pordr."' and assets_name='Stabilizer'");
$chkrws=mysqli_num_rows($chkifexs);
/*if($chkrws>0)
{
$edassetqr="update po_assets set specs='".$stab."',qty='".$stabno."',warranty='".$stabwr."',rate='".$stabrate."' where po_no='".$pordr."' and assets_name='Stabilizer'"; 
}else*/
if($chkrws==0)
{
$edassetqr="insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','Stabilizer','".$stab."','".$stabno."','".$stabwr."','".$stabrate."')";
}
	
if($edassetqr!="")
{
$addasset=mysqli_query($con1,$edassetqr);
if(!$addasset)
{
echo $edassetqr."2"."</br>";
$errors++;
}
}
	 }

/**************update avr************************/	

if($avrno>0)
{	
$chkifexs=mysqli_query($con1,"select specs from po_assets where po_no='".$pordr."' and assets_name='AVR'");
$chkrws=mysqli_num_rows($chkifexs);
/*if($chkrws>0)
{
$edassetqr="update po_assets set specs='".$avr."',qty='".$avrno."',warranty='".$avrwr."',rate='".$avrrate."' where po_no='".$pordr."' and assets_name='AVR'"; 
}else*/
if($chkrws==0)
{
$edassetqr="insert into `po_assets` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$pordr."','AVR','".$avr."','".$avrno."','".$avrwr."','".$avrrate."')";
}
	
//echo $edassetqr."</br>";
if($edassetqr!="")
{
$addasset=mysqli_query($con1,$edassetqr);
if(!$addasset)
{
echo $edassetqr."1"."</br>";
$errors++;
}
}
}
	
	/************************other asset  update************************/ 
if(isset($oth) and $oth!='')
	 {
	 
	 
	 $chkifexs=mysqli_query($con1,"select specs from po_assets where po_no='".$pordr."' and assets_name not in('AVR','Battery','Isolation Transformer','Stabilizer','UPS')");
$chkrws=mysqli_num_rows($chkifexs);
/*if($chkrws>0)
{
$edassetqr="update po_assets set assets_name='".$oth."',rate='".$othrate."' where po_no='".$pordr."' and not in('AVR','Battery','Isolation Transformer','Stabilizer','UPS')"; 
}else*/
if($chkrws==0)
{
$edassetqr="insert into `po_assets` (`po_no`,`assets_name`,`rate`) 
		   values('".$pordr."','".$oth."','".$othrate."')";
}
	
	
	
if($edassetqr!="")
{
$addasset=mysqli_query($con1,$edassetqr);
if(!$addasset)
{
echo $edassetqr."10"."</br>";
$errors++;
}
}	
}


/*********************************update pending installations*************************************************/ 
$uppendingins=mysqli_query($con1,"update pending_installations set BB_Details='".$bbd."',bbdrate='".$bbdrate."',contactperson='".$contact."',contactno='".$contactno."',new_email='".$newemailr."' where id='".$pid."'");

if(!$uppendingins)
{
echo "update pending_installations set BB_Details='".$bbd."',bbdrate='".$bbdrate."',contactperson='".$contact."',contactno'".$contactno."',new_email='".$newemailr."' where id='".$pid."'";
$errors++;
} 


$atm=mysqli_query($con1,"select bankname,atmid,cid,area,city,address,state,pincode,BRANCH,AMCID from Amc where po='".$fetchqrypo[0]."'");
	$flag="amc";
	if(mysqli_num_rows($atm)==0){
	$flag="atm";
	$atm=mysqli_query($con1,"select bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id,track_id from atm where po='".$fetchqrypo[0]."'");
	}
	
$bank=$_POST['bank'];
	$area=$_POST['area'];
	$pincode=$_POST['pin'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$site_branch=$_POST['site_branch'];
	$addr=htmlspecialchars($_POST['address']);

if($type=='sales')
{
/*echo "UPDATE atm set bank_name='".$bank."',area='".$area."',city='".$city."',address='".$addr."',state1='".$state."',pincode='".$pincode."',branch_id='".$site_branch."' where po='".$pordr."'";*/
/*$resultATM1=mysqli_query($con1,"UPDATE atm set bank_name='".$bank."',area='".$area."',city='".$city."',address='".$addr."',state1='".$state."',pincode='".$pincode."',branch_id='".$site_branch."' where po='".$pordr."'"); 
if(!$resultATM1)
{
$errors++;
}    */        
}elseif($type=='AMC')
{
/*$resultATM1= mysqli_query($con1,"update atm SET bankname='".$bank."',area='".$area."',city='".$city."',address='".$addr."',state='".$state."',pincode='".$pincode."',BRANCH='".$site_branch."' where po='".$pordr."'"); 

if(!$resultATM1)
{
$errors++;
}

*/
}


/*********************************update pending installations end*************************************************/


/*********************************update siteaccets and amcaccets starts here*************************************************/


if($type=='sales')
{
$resultATM=mysqli_query($con1,"select track_id from atm where atm_id='".$atm."'"); 
            $row=mysqli_fetch_row($resultATM);
            $id=$row[0];

}elseif($type=='AMC')
{
$resultATM= mysqli_query($con1,"select AMCID FROM Amc where ATMID='".$atm."'"); 
 $row=mysqli_fetch_row($resultATM);
 $id=$row[0];

}


/***********************************************update ups*****************************************************/
if($upsno>0)
	{
if($type=='sales')
{

$chkqrr="select cust_id from site_assets where callid='".$pid."' and po='".$pordr."' and assets_name='UPS'";
}
elseif($type=='AMC')
{

$chkqrr="select amcid from amcassets where callid='".$pid."' and amcpoid='".$pordr."' and assets_name='UPS'";
}

$result1chk=mysqli_query($con1,$chkqrr);
$chknrwexs=mysqli_num_rows($result1chk);

if($chknrwexs>0)
{
 if($type=='sales')
 {

 $result1qr="update site_assets set assets_spec='".$ups."',valid='".$upswr."',quantity='".$upsno."',rate='".$upsrate."' where callid='".$pid."' and 
  po='".$pordr."' and assets_name='UPS'";
 }elseif($type=='AMC')
 {
$result1qr="update amcassets set assetspecid='".$ups."',quantity='".$upsno."',rate='".$upsrate."',buyback='".$ubrate."' where callid='".$pid."' and 
  amcpoid='".$pordr."' and assets_name='UPS'";
 }
}
else
{
  if($type=='sales')
 {
  $result1qr="insert into 
 `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate,callid)values('$cust','$pordr','UPS','".$ups."','".$upswr."','".$upsno."','
  ".$id."','NEW','".$upsrate."','".$pid."')";
 }elseif($type=='AMC')
 {
  $result1qr="insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback,callid) values('$cust','$pordr','UPS','".$ups."','".$upsno."','".$id."','".$upsrate."','".$ubrate."','".$pid."')";

 }
}
	

//echo $result1qr."</br>";
$result1= mysqli_query($con1,$result1qr);

if(!$result1)
{

echo "12"."</br>";

$errors++;
}

}
	


/***********************************************update ups end*****************************************************/

/***********************************************update battery*****************************************************/
if($btryno>0)
	{
if($type=='sales')
{

$chkqrr="select cust_id from site_assets where callid='".$pid."' and po='".$pordr."' and assets_name='Battery'";
}
elseif($type=='AMC')
{

$chkqrr="select amcid from amcassets where callid='".$pid."' and amcpoid='".$pordr."' and assets_name='Battery'";
}

$result1chk=mysqli_query($con1,$chkqrr);
$chknrwexs=mysqli_num_rows($result1chk);

if($chknrwexs>0)
{
 if($type=='sales')
 {

 $result1qr="update site_assets set assets_spec='".$btry."',valid='".$btrywr."',quantity='".$btryno."',rate='".$batteryrate."' where callid='".$pid."' and 
  po='".$pordr."' and assets_name='Battery'";
 }elseif($type=='AMC')
 {
$result1qr="update amcassets set assetspecid='".$btry."',quantity='".$btryno."',rate='".$batteryrate."',buyback='".$batbrate."' where callid='".$pid."' and 
  amcpoid='".$pordr."' and assets_name='Battery'";
 }
}
else
{
  if($type=='sales')
 {
  $result1qr="insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate,callid)values('$cust','$pordr','Battery','".$btry."','".$btrywr."','".$btryno."','".$id."','NEW','".$batteryrate."','".$pid."')";
 }
elseif($type=='AMC')
 {
  $result1qr="insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback,callid) values('$cust','$pordr','Battery','".$btry."','".$btryno."','".$id."','".$upsrate."','".$batbrate."','".$pid."')";

 }
}
	

//echo $result1qr."</br>";
$result1= mysqli_query($con1,$result1qr);

if(!$result1)
{
echo $result1qr."11"."</br>";

$errors++;
}

}
	


/***********************************************update battery end*****************************************************/

/***********************************************update Isolation Transformer start *****************************************************/
if($isotno>0)
	{
if($type=='sales')
{

$chkqrr="select cust_id from site_assets where callid='".$pid."' and po='".$pordr."' and assets_name='Isolation Transformer'";
}
elseif($type=='AMC')
{

$chkqrr="select amcid from amcassets where callid='".$pid."' and amcpoid='".$pordr."' and assets_name='Isolation Transformer'";
}

$result1chk=mysqli_query($con1,$chkqrr);
$chknrwexs=mysqli_num_rows($result1chk);

if($chknrwexs>0)
{
 if($type=='sales')
 {

 $result1qr="update site_assets set assets_spec='".$isot."',valid='".$isotwr."',quantity='".$isotno."',rate='".$isotrate."' where callid='".$pid."' and 
  po='".$pordr."' and assets_name='Isolation Transformer'";
 }elseif($type=='AMC')
 {
$result1qr="update amcassets set assetspecid='".$isot."',quantity='".$isotno."',rate='".$isotrate."',buyback='".$isobrate."' where callid='".$pid."' and 
  amcpoid='".$pordr."' and assets_name='Isolation Transformer'";
 }
}
else
{
  if($type=='sales')
 {
  $result1qr="insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate,callid)values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotwr."','".$isotno."','".$id."','NEW','".$isotrate."','".$pid."')";
 }
elseif($type=='AMC')
 {
  $result1qr="insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback,callid) values('$cust','$pordr','Isolation Transformer','".$isot."','".$isotno."','".$id."','".$isotrate."','".$isobrate."','".$pid."')";

 }
}
	

//echo $result1qr."</br>";
$result1= mysqli_query($con1,$result1qr);

if(!$result1)
{
echo $result1qr."10"."</br>";

$errors++;
}

}
	


/***********************************************update Isolation Transformer end*****************************************************/


/***********************************************update Stabilizer start *****************************************************/
if($stabno>0)
	{
if($type=='sales')
{

$chkqrr="select cust_id from site_assets where callid='".$pid."' and po='".$pordr."' and assets_name='Stabilizer'";
}
elseif($type=='AMC')
{

$chkqrr="select amcid from amcassets where callid='".$pid."' and amcpoid='".$pordr."' and assets_name='Stabilizer'";
}

$result1chk=mysqli_query($con1,$chkqrr);
$chknrwexs=mysqli_num_rows($result1chk);

if($chknrwexs>0)
{
 if($type=='sales')
 {

 $result1qr="update site_assets set assets_spec='".$stab."',valid='".$stabwr."',quantity='".$stabno."',rate='".$stabrate."' where callid='".$pid."' and 
  po='".$pordr."' and assets_name='Stabilizer'";
 }elseif($type=='AMC')
 {
$result1qr="update amcassets set assetspecid='".$stab."',quantity='".$stabno."',rate='".$isotrate."',buyback='".$stbrate."' where callid='".$pid."' and 
  amcpoid='".$pordr."' and assets_name='Stabilizer'";
 }
}
else
{
  if($type=='sales')
 {
  $result1qr="insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate,callid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$id."','NEW','".$stabrate."','".$pid."')";
 }
elseif($type=='AMC')
 {
  $result1qr="insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback,callid) values('$cust','$pordr','Stabilizer','".$stab."','".$stabno."','".$id."','".$stabrate."','".$stbrate."','".$pid."')";

 }
}
	

//echo $result1qr."</br>";
$result1= mysqli_query($con1,$result1qr);

if(!$result1)
{
echo $result1qr."9"."</br>";

$errors++;
}

}
	


/***********************************************update Stabilizer end*****************************************************/

/***********************************************update AVR start *****************************************************/
if($avrno>0)
	{
if($type=='sales')
{

$chkqrr="select cust_id from site_assets where callid='".$pid."' and po='".$pordr."' and assets_name='AVR'";
}
elseif($type=='AMC')
{

$chkqrr="select amcid from amcassets where callid='".$pid."' and amcpoid='".$pordr."' and assets_name='AVR'";
}

$result1chk=mysqli_query($con1,$chkqrr);
$chknrwexs=mysqli_num_rows($result1chk);

if($chknrwexs>0)
{
 if($type=='sales')
 {

 $result1qr="update site_assets set assets_spec='".$avr."',valid='".$avrwr."',quantity='".$avrno."',rate='".$avrrate."' where callid='".$pid."' and 
  po='".$pordr."' and assets_name='AVR'";
 }elseif($type=='AMC')
 {
$result1qr="update amcassets set assetspecid='".$avr."',quantity='".$avrno."',rate='".$avrrate."',buyback='".$avbrate."' where callid='".$pid."' and 
  amcpoid='".$pordr."' and assets_name='AVR'";
 }
}
else
{
  if($type=='sales')
 {
  $result1qr="insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid,type,rate,callid)values('$cust','$pordr','AVR','".$avr."','".$avrwr."','".$avrno."','".$id."' ,'NEW','".$avrrate."','".$pid."')";
 }
elseif($type=='AMC')
 {
  $result1qr="insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback,callid) values('$cust','$pordr','AVR','".$avr."','".$avrno."','".$id."','".$avrrate."','".$avbrate."','".$pid."')";

 }
}
	

//echo $result1qr."</br>";
$result1= mysqli_query($con1,$result1qr);

if(!$result1)
{
echo $result1qr."8"."</br>";

$errors++;
}

}
	


/***********************************************update AVR end*****************************************************/


/***********************************************update OTHER ASSETS start *****************************************************/
if(isset($oth) and $oth!='')
	{
if($type=='sales')
{

$chkqrr="select cust_id from site_assets where callid='".$pid."' and po='".$pordr."' and assets_name not in('AVR','Battery','Isolation Transformer','Stabilizer','UPS')";
}
elseif($type=='AMC')
{

$chkqrr="select amcid from amcassets where callid='".$pid."' and amcpoid='".$pordr."' and assets_name not in('AVR','Battery','Isolation Transformer','Stabilizer','UPS')";
}

$result1chk=mysqli_query($con1,$chkqrr);
$chknrwexs=mysqli_num_rows($result1chk);

if($chknrwexs>0)
{
 if($type=='sales')
 {

 $result1qr="update site_assets set assets_name='".$oth."',rate='".$othrate."' where callid='".$pid."' and 
  po='".$pordr."' and assets_name not in('AVR','Battery','Isolation Transformer','Stabilizer','UPS')";
 }elseif($type=='AMC')
 {
$result1qr="update amcassets set assets_name='".$oth."',rate='".$othrate."' where callid='".$pid."' and 
  amcpoid='".$pordr."' and assets_name not in('AVR','Battery','Isolation Transformer','Stabilizer','UPS')";
 }
}
else
{
  if($type=='sales')
 {
  $result1qr="insert into `site_assets` (cust_id,po,assets_name,atmid,rate,callid) 
		   values('$cust','".$pordr."','".$oth."','".$id."','".$othrate."','".$pid."')";
 }
elseif($type=='AMC')
 {
  $result1qr="insert into `amcassets` (amcid,amcpoid,assets_name,siteid,rate,callid) 
		   values('$cust','".$pordr."','".$oth."','".$id."','".$othrate."','".$pid."')";

 }
}
	


$result1= mysqli_query($con1,$result1qr);

if(!$result1)
{
$errors++;
echo $result1qr."7"."</br>";
}

}
	


/***********************************************update other assets end*****************************************************/

/*********************************update siteaccets and amcaccets ends here*************************************************/



if($errors=="0")
{
mysqli_query($con1,"COMMIT");
echo 1;
}
else
{
mysqli_query($con1,"ROLLBACK");
echo mysqli_error();
echo 0;
}

	
?>