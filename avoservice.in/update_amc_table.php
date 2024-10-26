<?php
session_start();
//include("access.php");
include("config.php");

$id=$_GET['id'];
$userid=$_SESSION['user'];
$entry_date=date('Y-m-d');
   

$query=mysqli_query($con1,"select * from new_amc_sites where po_id='".$id."'");

//echo "select * from new_amc_site where po_id='".$id."'";

while ($result=mysqli_fetch_assoc($query)){
    
    $po_id=$result['po_id'];
    $atm_id=$result['atm_id'];
    
    $poquery=mysqli_query($con1,"select * from amc_po_new where po_id='".$po_id."'");
   
  
    $podata=mysqli_fetch_assoc($poquery);

 
 
 $po_no=$podata['po_no'] ;
 $po_date=$podata['po_date'] ;
 $cust_id=$podata['cust_id'] ; 
 $start_date=$podata['start_date'] ;
 $exp_date=$podata['exp_date'] ;
 
 $atm_id=$result['atm_id'] ;
 $branch_id=$result['branch_id'] ;
 $state=$result['state'] ;
 $enduser=$result['enduser'] ;
 $city=$result['city'] ;
 $area=$result['area'] ;
 $pincode=$result['pincode'] ;
 $address=$result['address'] ;
 $pincode=$result['pincode'] ;
 
 $pm_period=$result['pm_period'] ;
 
 
 //==========================
 $amcquery= mysqli_query($con1,"select * from `Amc`where ATMID='".$atm_id."'");  
  $atm=mysqli_num_rows($amcquery);	
  
 
    if($atm>0){
    $amcdata= mysqli_fetch_row($amcquery); 
    $amcid= $amcdata[0];
    
    echo "update `Amc` set PO='".$po_no."', AMC_ST_DATE='".$start_date."',  AMC_EX_DATE='".$exp_date."', active='Y' where AMCID='".$amcid."' ";
    
    $update=mysqli_query($con1,"update `Amc` set PO='".$po_no."', AMC_ST_DATE='".$start_date."',  AMC_EX_DATE='".$exp_date."', active='Y' where AMCID='".$amcid."' ");
 
    } else {
     
     echo "insert into `Amc`set PO='".$po_no."', AMC_ST_DATE='".$start_date."',  AMC_EX_DATE='".$exp_date."', CAT='B', active='Y',  ATMID='".$atm_id."', CID='".$cust_id."' ,  BANKNAME='".$enduser."' , AREA='".$area."' , CITY='".$city."' , ADDRESS='".$address."' , BRANCH='".$branch_id."' , STATE='".$state."' ";   
 
    $insert=mysqli_query($con1,"insert into `Amc`set PO='".$po_no."', AMC_ST_DATE='".$start_date."',  AMC_EX_DATE='".$exp_date."', CAT='B', active='Y',  ATMID='".$atm_id."', CID='".$cust_id."' ,  BANKNAME='".$enduser."' , AREA='".$area."' , CITY='".$city."' , ADDRESS='".$address."' , BRANCH='".$branch_id."' , STATE='".$state."' ");
    
      $amcid= mysqli_insert_id($con1);
        
    }
}    

 if($update || $insert){
    
 $poupdate=mysqli_query($con1,"update amc_po_new set upload_date='".$entry_date."', status='2' where po_id='".$po_id."'");
   
 
 //=================Assets==============
 $i=0;
 $assetquery=mysqli_query($con1,"select * from `amc_assets_new` where po_id='".$po_id."'"); 
 
// echo "select * from `amc_assets_new` where po_id='".$po_id."'";
 
 while ($asset=mysqli_fetch_array($assetquery)) {
		    
$assetname=$asset[2];
$specs=$asset[3];
$po_qty=$asset[4];
//echo $assetname;

 $addasset=mysqli_query($con1,"insert into `amcassets` (`assets_name`,`assetspecid`,`amcid`,`amcpoid`, `siteid`,`quantity`) 
		   values('".$assetname."','$specs','".$cust_id."','".$po_no."','".$amcid."', '".$po_qty."')"); 

$i++;
 }

}

	 
	if ($update && $addasset){
	?> 
	
	<script type="text/javascript">
	alert("Successfully Updated the AMC Site ");
	
	window.close();
	</script> 
	<?} elseif ($insert && $addasset){ ?>
	<script type="text/javascript">
	alert("Successfully Inserted the AMC site");
	window.close();
	</script>  
	    
	 <?   
	} else 
	?>
	<script type="text/javascript">
	alert("Failed to update !!");
	history.back();
	</script>
	