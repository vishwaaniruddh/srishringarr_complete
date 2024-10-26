<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GCM
 *
 * @author Ravi Tamada
 */
class GCM {

    //put your code here
    // constructor
    function __construct() {
        
    }

    /**
     * Sending Push Notification
     */
    public function send_notification($registatoin_ids, $message) {
        // include config
        include_once 'config.php';
        //echo $registatoin_ids." ".$message;

        // Set POST variables
       // $url = 'https://android.googleapis.com/gcm/send';
          $url = "https://fcm.googleapis.com/fcm/send";
      /*  $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );*/

       $fields = array(
        'to'=>$registatoin_ids,
        'notification'=>array('title'=>'AVO Engineer','message'=>'Test Notification'
       /* 'click_action'=>'com.example.hp.ipua_TARGET_NOTIFICATION'*/
        ));

$sever_key = "AAAAUQcn3zE:APA91bGJKoEyyI30aO6VPLPhyS8gJjx7UorzmWgPsXuFY3R4-2xTICjjQr6OUHX6OKcHHMfrL_BaGTYiJ_4kvi8keSMtkC0FYHh7ww64z7leFRTVTQU4yeLKE3RX8wrXLWwyteUYZR6N";
        $headers = array(
            'Authorization: key=' . $sever_key,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
       // echo $result;
    }

}

?>