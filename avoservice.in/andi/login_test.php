<?php
//Include database connection details
error_reporting(-1);
include 'db_conn.php';
//Array to store validation errors
function clean($str2)
{
    $str = @trim($str2);
    if (get_magic_quotes_gpc()) {
        $str2 = stripslashes($str2);
    }
    return mysqli_real_escape_string($conapp,$str2);
}
$response = array();

//================ IF Username===
$login = $_GET['uname']; //   Using Username // satyendra
//$login = 'Mari1440';
//============If Login id=======
$login_qry = "SELECT * FROM login WHERE username='" . $login . "' and status=1 and designation = 4 ";
//echo $login_qry;

$log_result = mysqli_query($conapp, $login_qry);
if (mysqli_num_rows($log_result) >= 1) {

$log_row = mysqli_fetch_row($log_result);
$login = $log_row[0];

        $str = array();
      
        
        $qry2 = mysqli_query($conapp, "select engg_id from area_engg where loginid='".$login."'");
        
        $ro = mysqli_fetch_row($qry2);
  //  echo "Select * from alert_delegation where engineer='" . $ro[0] . "' and call_close_status=0 and status=0 and alert_id in (select alert_id from alert where ( call_status<>'Rejected' and status<>'Done' and call_status<>'Done' AND call_status <>'onhold'))";
   // die;
    $sql1 = mysqli_query($conapp, "Select * from alert_delegation where engineer='" . $ro[0] . "' and call_close_status=0 and status=0 and alert_id in (select alert_id from alert where ( call_status<>'Rejected' and status<>'Done' and call_status<>'Done' AND call_status <>'onhold'))");
       
        while ($row1 = mysqli_fetch_row($sql1)) {
            $atmrow = '';
            $atmid = '';
            
            $sql2 = mysqli_query($conapp, "select * from alert where alert_id='" . $row1[3] . "'");
            if (mysqli_num_rows($sql2) > 0) {
                
                $row2 = mysqli_fetch_row($sql2);
                
                if($row2[21] !='' || $row2[21] != NULL){
              
                if ($row2[21] == 'amc') {
                    $atm = mysqli_query($conapp, "select atmid from Amc where amcid='" . $row2[2] . "'");
                    
                    $sitestatus = 'AMC';
                } elseif ($row2[21] == 'site') {
                    $atm = mysqli_query($conapp, "select atm_id from atm where track_id='" . $row2[2] . "'");
                    $sitestatus = 'Warranty';
                    
                } else {  $atmid = $row2[2]; 
                    
                }
                 if(mysqli_num_rows($atm) > 0) {
                    $atmrow = mysqli_fetch_row($atm);
                    $atmid = $atmrow[0];
                }
                } else { $atmid = $row2[2];
                $sitestatus = 'PCB';
                    
                }
               
                if ($row2[9] != '') {
                    $problem = $row2[9];
                } else {
                    $problem = $row2[17];
                }
                
                if ($row2[17] == 'new') {
                    $calltype = 'Installation';
                } else if ($row2[17] == 'new temp' || $row2[17] == 'service') {
                    $calltype = 'Service';
                } else if ($row2[17] == 'temp_pm' || $row2[17] == 'pm') {
                    $calltype = 'PM';
                } else if ($row2[17] == 'dere' || $row2[17] == 'temp_dere') {
                    $calltype = 'DERE';
                } else {
                    $calltype = 'PM';
                }
               
                $cl = mysqli_query($conapp, "select cust_id,cust_name from customer where cust_id='" . $row2[1] . "' ");
                $cust_name = "";
                if (mysqli_num_rows($cl) > 0) {
                    $clro = mysqli_fetch_array($cl);
                    $cust_name = $clro[1];
                } else {}
                if ($row2[15] != 'Done') {
                    $engstat = "Pending";
                } else {
                    $engstat = "Done";
                }
              
                $str[] = array('compid' => htmlspecialchars($row2[25]), 'atmid' => htmlspecialchars($atmid), 'address' => htmlspecialchars($row2[5]), 'callid' => htmlspecialchars($row2[0]), 'engid' => $ro[0], 'engstat' => htmlspecialchars($engstat), 'contactperson' => htmlspecialchars($row2[12]), 'phone' => htmlspecialchars($row2[13]), 'bank' => htmlspecialchars($row2[3]), 'problem' => htmlspecialchars($problem), 'eta' => $row2[31], 'customerName' => htmlspecialchars($cust_name), 'siteStatus' => htmlspecialchars($sitestatus), 'callType' => $calltype);
            
                
            }
           
        }
          echo "<pre>";
          print_r($str);
          echo "</pre>";
        echo json_encode($str);
        
           } else {
        //Login failed
        $str = -1;
        echo json_encode($str);
    }

