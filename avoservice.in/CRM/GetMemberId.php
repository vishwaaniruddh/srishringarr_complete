<?php
include 'config.php';
$data=array();
 $result=mysqli_query($conn,"select Primary_nameOnTheCard,GenerateMember_Id,MembershipDetails_Level,DATE_ADD(entryDate, INTERVAL 1 YEAR) from Members where  canceledMember='0'");
 while($row = mysqli_fetch_array($result)) { 
    $data[]=['m_id'=>$row[1],'m_name'=>$row[0],'m_level'=>$row[2],'m_expiry'=>$row[3]];
 }
 echo json_encode($data) ;
?>