<?php
session_start();
//echo $_SESSION['regid'];
   $key = $_SESSION['regid'];
 $img_url = "http://www.avoservice.in/andi/Avo_notification_image.jpeg";
    $title = "Your service related enquiry is generated";
    $message="Test msg";

 $path_to_fcm = "https://fcm.googleapis.com/fcm/send";
 $sever_key = "AIzaSyC0i3pLxDN-ArZhHIxI60p5vBOhMWM9tB0";
   
    
    $headers = array(
        'Authorization:key = '.$sever_key,
        'Content-Type:application/json'
    );
    
 $count=count($key);
for($i=0;$i<$count;$i++){
         print '<pre>';
    print_r($key[$i]);
    print '</pre>';
         $fields = array(
        'to'=>$key[$i],
        'notification'=>array('title'=>$title,'message'=>$message,'img_url'=>$img_url
       /* 'click_action'=>'com.example.hp.ipua_TARGET_NOTIFICATION'*/
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
}
?>