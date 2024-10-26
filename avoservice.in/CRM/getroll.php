<?php
include('config.php');
$per=$_POST['per'];

    $sql1="select permission from roll where id = '".$per."' ";
	$runsql1=mysqli_query($conn,$sql1);
    $frunsql1=mysqli_fetch_array($runsql1);
    
    $data=array();
    $sql2="select * from menuAccess where pid in (".$frunsql1['permission'].") ";
    
	$runsql2=mysqli_query($conn,$sql2);
    while($frunsql2=mysqli_fetch_array($runsql2)){
        $data[]=$frunsql2['name'];
    }
    echo json_encode($data);
?>