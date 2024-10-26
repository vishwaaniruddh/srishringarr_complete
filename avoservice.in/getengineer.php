<?php 
include('connect.php');

$branch=  $_POST['branchid'];
// $eng = $_POST['eng_id'];
// var_dump($_POST);

$sql = mysqli_query($con,"select * from area_engg where branch_id = '".$branch."' and status=1 and deleted=0 and latitude!=0.00");
//$option = "<option value=''>Select</option>";
$data = [];
while($sql_result = mysqli_fetch_assoc($sql)){
$id = $sql_result['engg_id'];
$name = $sql_result['engg_name'];
 $newdata = [];
 $newdata['id'] = $id;
 $newdata['name'] = $name;
  array_push($data,$newdata);  
  
}

echo json_encode($data);

?>