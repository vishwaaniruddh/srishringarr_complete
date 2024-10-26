<?php
session_start() ;
include_once './db_conn.php';
// response json
$json = array();
error_reporting(E_ALL);

/**
     * Storing new user
     * returns user details
     */
    function storeUser($username,$gcm_regid,$mac_id,$name,$email,$conapp) 
	{

   if($username){
    $qry=mysqli_query($conapp,"Select * from login where username='".$username."'");
$cdate = date('Y-m-d H:i:s');
if(mysqli_num_rows($qry)>0)
{
	
	$str="";
	$qryrow=mysqli_fetch_row($qry);
	if($qryrow[4]=='4')
{
	$qry1=mysqli_query($conapp,"Select engg_id from area_engg where loginid='".$qryrow[0]."' and deleted =0");
	$max=mysqli_fetch_row($qry1);
	$str=$max[0];
}
elseif($qryrow[4]=='3')
{
	$qry1=mysqli_query($conapp,"Select head_id from branch_head where loginid='".$qryrow[0]."'");
	$max=mysqli_fetch_row($qry1);
	$str=$max[0];
}
$sqlx=mysqli_query($conapp,"select * from notification_tble where pid='".$str."'");
if(mysqli_num_rows($sqlx)>0)
{
 //$result = mysqli_query($conapp,"update notification_tble set username='".$username."',logid='".$qryrow[0]."',mac_id='".$mac_id."',gcm_regid='".$gcm_regid."',name='".$name."',email='".$email."',updt='".$cdate."' where pid='".$str."'");
 $result = mysqli_query($conapp,"update notification_tble set mac_id='".$mac_id."',gcm_regid='".$gcm_regid."', updt='".$cdate."' where pid='".$str."'");

 $qry="update engg_current_location set mac_id='".$mac_id."' where engg_id='".$str."'";
 mysqli_query($conapp,$qry);

 if ($result) {
                 return true;
              }
         else {
                return false;
              }                
}
else{
 $result = mysqli_query($conapp,"INSERT INTO notification_tble(username, gcm_regid,mac_id,logid,pid,name,email,created_at) VALUES('$username', '$gcm_regid','$mac_id','$qryrow[0]','$str','$name','$email','".$cdate."')");
 
if ($result) {
            // get user details
$id = mysqli_insert_id($conapp); // last inserted id

$result = mysqli_query($conapp,"SELECT * FROM engg_current_location WHERE engg_id = '".$str."'");// or die(mysqli_error());
            // return user details
    if (mysqli_num_rows($result) > 0) {  
        
    } else {
    $xyz="insert into engg_current_location(engg_id,mac_id) values('".$str."','".$mac_id."')";
            mysqli_query($conapp,$xyz);
                return true;//mysqli_fetch_array($result);
            } 
    return true;  //added  
    
} else { 
            return true;
        }
        
        return true;  //added  
        }
        //return $store;
    }
}
else
return false;
	}

if (isset($_POST["username"]) && isset($_POST["regId"]) && isset($_POST["mac_id"]) && isset($_POST["name"]) && isset($_POST["email"])) {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $gcm_regid = $_POST["regId"];
    $mac_id = $_POST["mac_id"];
    $username= trim($_POST["username"]); // GCM Registration ID
    
    $res = storeUser($username,$gcm_regid,$mac_id,$name,$email,$conapp);
     
    echo json_encode($res);
    
    
} else {
     echo "false";
}

?>