<?php include('config.php');
error_reporting(0);
ini_set('max_execution_time', 0);

$instance = 'instance172450';
$token = 'rmmecklghkytj5wu';

date_default_timezone_set('Asia/Kolkata');

$datetime =   date("Y-m-d h:i:s");



$msg = $_POST['msg'];
$msg = str_replace( "'", "", $msg );
$msg = str_replace(PHP_EOL,'\n',  $msg );
$msg = preg_replace('/([\r\n\t])/','', $msg);
$msg = preg_replace('/[^A-Za-z0-9,.*%\\\n\-]/', ' ', $msg);

$testing = $_POST['testing'];

$date = date('Y-m-d');

$SendToMobile = array('7021889883','8879265547','9820309824','7710877218');


if(isset($testing)){
    
}else{
$sql = mysqli_query($con,"select * from new_member where status=1 and is_whatsapp_send=1");

while($sql_result = mysqli_fetch_assoc($sql)){
    $SendToMobile[] = $sql_result['mobile']; 
}    
}

foreach($SendToMobile as $key => $val){

// http://api.chat-api.com/instance172450/checkPhone?token=rmmecklghkytj5wu&phone=917021889883
    $service_url = 'https://api.chat-api.com/'.$instance.'/checkPhone?token='.$token.'&phone=91'.$val;
    
    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    $decoded = json_decode($curl_response,true);
    $result = $decoded['result'];
    

    if($result == 'exists'){
        
          $data = ['phone' => '91'.$val, // Receivers phone
            'body' => $msg ];
        $json = json_encode($data);
        $modified_json=stripslashes($json);
        $url = 'https://api.chat-api.com/'.$instance.'/sendMessage?token='.$token;
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $modified_json
            ]
        ]);
        $result = file_get_contents($url, false, $options);
        
    
        echo "Send To ". $val . " Successfully ! " ;  
        echo '<br>';
    }
    else{
        
        echo "Send To ". $val . " Failed ! " ;  
        echo '<br>';
    }
}
?>