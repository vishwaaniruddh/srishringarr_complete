<?php
// include("access.php");
include("config.php");
error_reporting(1);
// function ($engg_id, $message) {
$engg_id="1";
    $aidqry = mysqli_query($con1,"SELECT phone_no1 FROM `area_engg`WHERE engg_id='" . $engg_id . "'");
    $aidrow = mysqli_fetch_row($aidqry);
    $req = $aidrow[0];
    var_dump($req);

//     if ($req != '') {

        // $Mobile = $req;
        $Mobile = "7974003201";
        $InstantId = "instance367588";
        $Token = "z1kce5n1cvftao08";
        $Message = "You have New Alerts";

        if ($Mobile !== '') {

            $data = explode(',', $Mobile);
            
            foreach ($data as $key => $number) {
               
            $jsonData = json_decode(file_get_contents('https://avoservice.in/whatsapp/WhatsAppSend.php?Mobile=91'.(int)$number.'&InstantId='.$InstantId.'&Token='.$Token.'&Message='.urlencode($Message)));
                $c_data=date('Y-m-d H:i:s');
                $type="1";  // type "1" for delegation
                
                $intdata=mysqli_query($con1,"INSERT INTO `whatsapp_message_report`(`type`, `engg_id`, `response`, `date_time`) VALUES('".$type."','".$engg_id."','".json_encode($jsonData)."','".$c_data."')");
                //echo "INSERT INTO `whatsapp_message_report`(`type`, `engg_id`, `response`, `date_time`) VALUES('".$type."','".$engg_id."','".json_encode($jsonData)."','".$c_data."')";
                var_dump($intdata);
            }
        } else {
            echo "Enter Mobile Number";
        }
//     }

// }
