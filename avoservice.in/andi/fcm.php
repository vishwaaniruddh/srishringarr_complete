<?php
include('config.php');
$newTime = strtotime('-30 minutes');
$nt = date('Y-m-d H:i:s', $newTime);
$date=date('Y-m-d H:i:s');
$q="SELECT a.gcm_regid FROM notification_tble a,`engg_current_location` b where b.last_updated<'".$nt."' and a.mac_id=b.mac_id";
//echo $q;
    $result = mysqli_query($conn,$q);
    while($row=mysqli_fetch_row($result)){
        $keys[]=$row[0];
    }
    $cnt= count($keys);
  //  echo $cnt;
    $regids=implode(",",$keys);
  //  echo $regids;
    mysqli_query($conn,"insert into notification_log(regids,sendtime,idcount) values('".$regids."','".$date."','".$cnt."')");
    //echo "insert into notification_log(regids,sendtime,idcount) values('".$regids."','".$date."','".$cnt."')";
//session_start();
//echo $_SESSION['regid'];
//   $key = $_SESSION['regid'];
 $img_url = "http://www.avoservice.in/andi/Avo_notification_image.jpeg";
    $title = "Your location related enquiry is generated";
    $message="Send Location";
//echo $message;
 $path_to_fcm = "https://fcm.googleapis.com/fcm/send";
 $sever_key = "AIzaSyC0i3pLxDN-ArZhHIxI60p5vBOhMWM9tB0";
 //  $sever_key = "AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI";
    
    $headers = array(
        'Authorization:key = '.$sever_key,
        'Content-Type:application/json'
    );
    
/* $count=count($key);
for($i=0;$i<$count;$i++){
         print '<pre>';
    print_r($key[$i]);
    print '</pre>';*/
         $fields = array(
        //'to'=>$key[$i],
        //'to'=>'fisslgGZ6aY:APA91bHz-3cAgWh3YxnaRxrsXXz-uO1ke2FF7yZj0aXh2I8YLotmnYqEFIbQGs5KFjjjWMg1j5Ar9J68YIhEHR3z3BVPQCPBnZsQya-J3mfpYfHS5pQK5X2ToQMFssS_scW34IhcViq9',
        //'to'=>'cz1VoiTCKEQ:APA91bFbIqo81fCkrEzqsWiACCJ6BgmG1wovOYKVUEO2raef2VZhF9VqL2Ok9u2l2Ml9HaZFifV-JAX9gk6iFyllvI3l4-fh58Yl3ssVuwbFNnw8pTnH4LgnwzM0YWS_AOjPwP2ycgts',
        'registration_ids' => $keys,
        'notification'=>array('title'=>$title,'message'=>$message,'img_url'=>$img_url,
       /* 'click_action'=>'com.example.hp.ipua_TARGET_NOTIFICATION'
       'data'=>array(
      "Nick" => "Mario",
      "Room" => "PoSDenmark",*/
        ));
        
        
    $payload = json_encode($fields);
    $curl_session = curl_init();
    curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
    curl_setopt($curl_session, CURLOPT_POST, true);
    curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
    /*curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);*/
    curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
    
    $test=curl_exec($curl_session);
echo $test;
    curl_close($curl_session);
    echo "Ends";
//}
?>