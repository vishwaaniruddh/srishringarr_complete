<?php 
include('connect.php');

// $zone = $_POST['zone_id'];

// $state = mysqli_query($con,"select * from state_copy where zone='".$zone."'  ");
// $statesql = mysqli_fetch_assoc($state);
// $stateid= $statesql['state_id'];

$branch=  $_POST['branch'];

$sql = mysqli_query($con,"select * from avo_branch  group by id ");
$option = "<option value=''>".'Select'."</option>";

while($sql_result = mysqli_fetch_assoc($sql)){

    $option=$option."<option value='".$sql_result['id']."'>".$sql_result['name']."</option>";

    
}

echo $option;

?>