<? include('config.php');

    $cust_state = $_POST['cust_state'];
    $cust_branch = $_POST['cust_branch'];
    
    $sql = mysqli_query($con1,"select * from avo_branch where name ='".$cust_branch."'");
    $sql_result=mysqli_fetch_assoc($sql);
    
    $branch_id = $sql_result['id'];
    
    $state_sql= mysqli_query($con1,"select * from state where state ='".$cust_state."'");
    $state_sql_result = mysqli_fetch_assoc($state_sql);
    
    $state_id = $state_sql_result['state_id'];
    
    $data=['state_id'=>$state_id,'branch_id'=>$branch_id];
    
    echo json_encode($data);    

?>