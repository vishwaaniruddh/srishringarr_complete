<?php
//Include database connection details
error_reporting(-1);
include 'db_conn.php';

$response = array();
$macid = $_GET['macid']; //echo "mac:".$macid;
//Create query
$result = mysqli_query($conapp, "select logid from notification_tble where mac_id='" . $macid . "'");

//Check whether the query was successful or not
if ($result) {
    if (mysqli_num_rows($result) == 1) {
        $str = array();
        $row = mysqli_fetch_row($result);
        $login_id = $row[0];
        $array = array(["code"=>200,"login_id"=>$login_id]);
        
        
    } else {
        //Login failed
        $array = array(["code"=>201]);
    }
} else {
    $array = array(["code"=>202]);
}

echo json_encode($array);