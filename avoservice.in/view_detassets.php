<?php
include("access.php");
// include('config.php');
include("db_connection.php");
$con1 = OpenCon1();

$trackid=$_GET['sid'];
$site=$_GET['site'];
?>


 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="1200" >
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="popup.css"  rel="stylesheet" type="text/css"> -->
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<style>
    table { 
    margin-left: auto;
    margin-right: auto;
}
</style>
</head>
<?php
//echo $trackid."---" . $site;

if($site=='amc'){
 // echo "Select ups,nou from Amc where amcid='".$trackid."'";  
$amcqry = mysqli_query($con1,"Select ups,nou, amc_st_date,amc_ex_date,atmid from Amc where amcid='".$trackid."'");
$amc = mysqli_fetch_row($amcqry);
if($amc[0]==''){ $ups="No Product details";} else { $ups = $amc[0];}
if($amc[1]==''){ $qt="No info";} else { $qt = $amc[1];}
$atmid=$amc[4];
?>
<body>
<table border="1">
    <center>
   <tr><td colspan="4" align="center"><b>Products in AMC </b></td>   </tr> 
     <tr><th>Product</th><th>Qty</th><th>Start Date</th><th>Expiry Date</th>   </tr> 
     <tr>
     <td><?php echo $ups; ?></td>
     <td><?php echo $qt; ?></td>
     <td><?php echo $amc[2]; ?></td>
     <td><?php echo $amc[3]; ?></td>
     </tr> 
</center>
</table>
</br>
<? 
$atmqry = mysqli_query($con1,"Select track_id from atm where atm_id like '".$atmid."'");
if(mysqli_num_rows($atmqry)>0) {
$atm = mysqli_fetch_row($atmqry);

?>
<table border="1">
    <center>
   <tr><td colspan="7" align="center"><b>Products in Warranty </b></td>   </tr> 
     <tr><th>Product</th><th>Specs</th><th>Qty</th><th>Warranty</th><th>Start Date</th><th>Expiry Date</th> <th>Status</th>  </tr> 
<?php     
$assetqry = mysqli_query($con1,"Select assets_name, assets_spec, valid,quantity,start_date,exp_date, status from site_assets where atmid = '".$atm[0]."'");
while($asst = mysqli_fetch_row($assetqry)) {
if($asst[6]==0){ $stat="Out of warranty";} 
else if($asst[6]==1){ $stat="Warranty";} 
$spcqry = mysqli_query($con1,"Select name from assets_specification where ass_spc_id ='".$asst[1]."'");
$assname= mysqli_fetch_row($spcqry);
?>
     <tr>
     <td><?php echo $asst[0]; ?></td>
     <td><?php echo $assname[0]; ?></td>
     <td><?php echo $asst[3]; ?></td>
     <td><?php echo $asst[2]; ?></td>
     <td><?php echo $asst[4]; ?></td>
     <td><?php echo $asst[5]; ?></td>
     <td><?php echo $stat; ?></td>
     </tr> 
     <?php } ?>
</center>
</table>

<?php

} else { echo "No Any Products in Warranty";}
} else if($site=='site') {
?>    
<table border="1">
    <center>
   <tr><td colspan="7" align="center"><b>Products in Warranty </b></td>   </tr> 
     <tr><th>Product</th><th>Specs</th><th>Qty</th><th>Warranty</th><th>Start Date</th><th>Expiry Date</th> <th>Status</th>  </tr> 
<?php     
//echo "Select assets_name, assets_spec, valid,quantity,start_date,exp_date, status from site_assets where atmid = '".$trackid."'";
$assetqry = mysqli_query($con1,"Select assets_name, assets_spec, valid,quantity,start_date,exp_date, status from site_assets where atmid = '".$trackid."'");
while($asst = mysqli_fetch_row($assetqry)) {
if($asst[6]==0){ $stat="Out of warranty";} 
else if($asst[6]==1){ $stat="Warranty";} 
$spcqry = mysqli_query($con1,"Select name from assets_specification where ass_spc_id ='".$asst[1]."'");
$assname= mysqli_fetch_row($spcqry);
?>
     <tr>
     <td><?php echo $asst[0]; ?></td>
     <td><?php echo $assname[0]; ?></td>
     <td><?php echo $asst[3]; ?></td>
     <td><?php echo $asst[2]; ?></td>
     <td><?php echo $asst[4]; ?></td>
     <td><?php echo $asst[5]; ?></td>
     <td><?php echo $stat; ?></td>
     </tr> 
<?php } ?>
</center>
</table>


<?    
}
?>

</body>


</html>