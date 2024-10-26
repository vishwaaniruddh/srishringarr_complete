<?php session_start();

include("../config.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username= trim($_POST["username"]); // GCM Registration ID
    $password= trim($_POST["password"]);
    $sql = mysqli_query($con1,"select * from login where username = '".$username."' and password='".$password."'");
    $result = mysqli_num_rows($sql);
    if($result>0){
        $sql_result = mysqli_fetch_assoc($sql);
        if($sql_result['status']==1){
            $id = $sql_result['srno'];
            $uname = $sql_result['username']; 
           
            $data=['userid'=>$id,'uname'=>$uname,'is_login'=>1];
        }else{
            $data = ['is_login'=>0,'msg'=>'You are inactive'];
        }
        
        echo json_encode($data);
            
    }
    else{
        $data = ['is_login'=>0,'msg'=>'Incorrect Username or password'];
        echo json_encode($data);
    }

}else{
    $data = ['is_login'=>2,'msg'=>'Must Required Username and password'];
    echo json_encode($data);
}
?>