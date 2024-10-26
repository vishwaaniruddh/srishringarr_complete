<?php
session_start() ;
// response json
$json = array();
error_reporting(E_ALL);
/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_POST["username"]) && isset($_POST["regId"]) && isset($_POST["mac_id"]) && isset($_POST["name"]) && isset($_POST["email"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $gcm_regid = $_POST["regId"];
    $mac_id = $_POST["mac_id"];
    $username=$_POST["username"]; // GCM Registration ID
   // echo $name."-".$email."-".$gcm_regid."-".$mac_id."-".$username;
    // Store user details in db
    include_once './db_functions.php';
    //include_once './GCM.php';
    //include './send_notification.php';
    $db = new DB_Functions();
  //  $gcm = new GCM();
    $_SESSION['regid']=$gcm_regid;
    $res = $db->storeUser($username,$gcm_regid,$mac_id,$name,$email);
  //  echo "done";
  //  $registatoin_ids = array($gcm_regid);
  //  $message = array("alert" => "You have Registered successfully.Now you will receive your call alerts");
    //header("location: http://avoservice.in/andi/send_notification.php");
  // $resulttemp=xyz($gcm_regid); //$gcm->send_notification($registatoin_ids, $message);

  //  echo $result;
  
    echo json_encode($res);
} else {
     echo "false";
}

?>