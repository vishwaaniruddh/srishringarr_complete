<?php
include ('config.php');

$fdate=$_POST['fdate'];
$toDate=$_POST['toDate'];
 
$fdate1= date('Y-m', strtotime($fdate));
$todate1= date('Y-m', strtotime($toDate));

$fdate2= date('m', strtotime($fdate));
$todate2= date('m', strtotime($toDate));

$fdate3= date('Y', strtotime($fdate));
$todate3= date('Y', strtotime($toDate));

$data=array();
for($i=$fdate2;$i<=$todate2;$i++){
   
$num_padded = sprintf("%02d", $i);

    
    $fdate4=$fdate3."-".$num_padded;
    $todate4=$todate3."-".$num_padded;
    
    $sql="select count(*) from Members where canceledMember='0' and date_format( entryDate, '%Y-%m' ) between  '".$fdate4."' and '".$todate4."'  ";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);

    $data[]=['month_year'=>$fdate4,'member'=>$row[0]];

}




echo json_encode($data);
?>