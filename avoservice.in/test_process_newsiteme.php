<?php
session_start();
	include('config.php');
 	$cust=$_POST['cust'];
 	//echo "cust=".$cust."<br>";
 	
 	
 	
 	$userid=$_SESSION['user'];
	$service=$_POST['servicetype'];
	$pordr=mysqli_real_escape_string($_POST['po']);
	$atm=$_POST['atm'];
	$bank=mysqli_real_escape_string($_POST['bank']);
	$area=mysqli_real_escape_string($_POST['area']);
	$pincode=$_POST['pin'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$site_branch=$_POST['site_branch'];
	$addr=mysqli_real_escape_string($_POST['address']);	
	$badd=mysqli_real_escape_string($_POST['badd']);	
	$gst=$_POST['gst'];
	$contact=trim($_POST['cont']);
	$contactno=$_POST['cno'];
	

	$podt=$_POST['podt'];   // PO date
	$sp=$_POST['saleperson']; 
	$nos=$_POST['nos']; 
       
	$upsrate=$_POST['upsrate'];
	$avrrate=$_POST['othrate'];

        $entry_date=date('Y-m-d H:i:s');

  	$ups=$_POST['ups'];
 	$upsno=$_POST['upsno'];
	$upswr=$_POST['upswr'];
 	
 	$oth=$_POST['oth'];
 	$othqty=$_POST['othqty'];
	$othwr=$_POST['othwr'];
	$othexp=$_POST['othexp'];
	

	$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
    $qry2ro=mysqli_fetch_row($qry2);
	//echo "<br>select * from alert where entry_date LIKE ('".date('Y-m-d')."%')";
	
	
//=============================inserting code start here==========================================
	
	
	//	 $add=mysqli_query($con1,"select * from `purchase_order` where `po_no`='".$pordr."'");
	//	 if(mysqli_num_rows($add)>0)
	//	 {
	//	  echo "Already same PO available in Database and It will be Updated";   
	//	 }
		 
	$result12=mysqli_query($con1,"insert into `amc_po_new`(po_no,no_sites,cust_id,po_date,buyer,gst,saleperson) VALUES ('".$pordr."','".$nos."','".$cust."',STR_TO_DATE('".$podt."','%d/%m/%Y'),'".$badd."','".$gst."','".$saleperson."')");
		 
		 $amc_poid=mysqli_insert_id();
		 
		 if($result12){
		    
		   if($upsno>0)
	{
	 $addasset=mysqli_query($con1,"insert into `amc_assets_new` (`po_id`,`assets_name`,`specs`,`po_qty`,`rate`, `start_date`,`ex_date`) 
		   values('".$amc_poid."','UPS','".$ups."','".$upsno."','".$upsrate."', '".$upswr."', '".$upswr."')"); 
	 }
	 
	 if($othqty>0)
	{

	
	$addasset=mysqli_query($con1,"insert into `amc_assets_new` (`po_no`,`assets_name`,`specs`,`qty`,`warranty`,`rate`) 
		   values('".$amc_poid."','OTHER','".$avr."','".$avrno."','".$avrwr."','".$avrrate."')");
	 }
	
		 }
	 
	 	$flag=0;
	
	$result=mysqli_query($con1,"SELECT `ATMID` from Amc where `ATMID`='".$atm."'");
        $numrow=mysqli_num_rows($result);	
        
        
        if($numrow>0){
         $result= mysqli_query($con1,"select AMCID FROM Amc where ATMID='".$atm."'"); 
        $row=mysqli_fetch_row($result);
        $id=$row[0];   
            
            
         //   UPDATE SQL
                    
                $flag=2;
                     }

 
 

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

$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback,callid) values('$cust','$pordr','UPS','".$ups."','".$upsno."','".$id."','".$upsrate."','".$ubrate."','".$pid."')");
	}
	

	
	 if($othqty>0)
	{

	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid)values('$cust','$pordr','Stabilizer','".$stab."','".$stabwr."','".$stabno."','".$atm."')";
	
	$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid,rate,buyback,callid) values('$cust','$pordr','OTHER','".$avr."','".$avrno."','".$id."','".$avrrate."','".$avbrate."','".$pid."')");
	 }
	 if(isset($oth) and $oth!='')
	

	if($flag==2){	     
		 echo "1 Success**##" .$ponum1;	 
		}else {
			 echo "Failed";
			 } 

?>
