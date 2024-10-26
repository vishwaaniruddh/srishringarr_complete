<?php
include("access.php");
 
 include("config.php");
 
 $id=$_POST['asset_id'];
 $spec=$_POST['spec'];
 $cname=$_POST['cname'];
 
 //echo "update `assets_specification` set `name`='".$spec."' ,`company_name`='".$cname."' where `ass_spc_id`='".$id."'";
 $qry=mysqli_query($con1,"update `assets_specification` set `name`='".$spec."' ,`company_name`='".$cname."' where `ass_spc_id`='".$id."'" );
 if(!$qry)
 echo mysqli_error();
 if($qry){
 header('Location:view_assets.php');
 }
?>
