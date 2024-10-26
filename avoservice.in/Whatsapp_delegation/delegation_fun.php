<?php

include("config.php");


function SendWhatmsg($Mobile,$message) {
    
      // $InstantId="Osyk4rvXVpgAlhq";
    // $InstantId="c0PT9nyrsXvkjbL";
     $InstantId="Sh2X87x6nkMvOrl";
     
  // $Token ="34a1f7f51d4716ff8bb6a27a0e5563cf2bbc5bb8";
   // $Token="febdd763a333ec25be716a226b477fc9e984869c";
    $Token="78022864cd53b496d7dae8d97659724a76441e97";
    
       
        $Message = $message;

        if ($Mobile !== '') {
             $data = explode(',', $Mobile);
            
            foreach ($data as $key => $number) {
               
         //   $jsonData = json_decode(file_get_contents('https://avoservice.in/whatsapp/WhatsAppSend_wapi.php?Mobile=91'.(int)$number.'&InstantId='.$InstantId.'&Token='.$Token.'&Message='.urlencode($Message)));
                $c_date=date('Y-m-d H:i:s');
                $type="1";  // type "1" for delegation
                
          //      $intdata=mysqli_query($con1, "INSERT INTO `whatsapp_message_report1`(`type`, `Mobile`, `response`, `date_time`) VALUES('".$type."','".$Mobile."','".json_encode($jsonData)."','".$c_date."')");
           //     echo "INSERT INTO `whatsapp_message_report`(`type`, `engg_id`, `response`, `date_time`) VALUES('".$type."','".$Mobile."','".json_encode($jsonData)."','".$c_date."')";
                // var_dump($intdata);
            }
        }  
        return null;
}

?>