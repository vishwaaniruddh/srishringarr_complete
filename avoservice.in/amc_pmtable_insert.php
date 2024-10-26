<?php
include("access.php");
include('config.php');

$psbqry=mysqli_query($con1,"select amcid,atmid,bankname from Amc where active='Y' and cid=30");

while($row=mysqli_fetch_row($psbqry)) {
    
$pmsiteqry=mysqli_query($con1,"select site_id from amc_pm_sites where site_id= '".$row[0]."'"); 

if(mysqli_num_rows($pmsiteqry) >0 ) {
 echo "Already Available";
 
} else {

$pmqry="insert into amc_pm_sites set site_id = '".$row[0]."', atmid = '".$row[1]."', end_user = '".$row[2]."', pm_reqd=1 , status='1'";
echo $pmqry; 

$qry=mysqli_query($con1,$pmqry) ;
}

}       


mysqli_close($con);
mysqli_close($con2);   

?>