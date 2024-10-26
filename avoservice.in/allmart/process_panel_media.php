<?php include('config.php');
error_reporting(0);
ini_set('max_execution_time', 0);

date_default_timezone_set('Asia/Kolkata');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$instance = 'instance172450';
$token = 'rmmecklghkytj5wu';

function drop_value($i){
            global $conn;
            
            if($i==1){
                $max = 500;
                $min = $max - 499;
            }
            else{
                $max = $i*500;
                $min = $max - 499;    
            }

        return [$min,$max];   
        }


$datetime =   date("Y-m-d h:i:s");



$doc = $_POST['doc'];
$msg = $_POST['msg'];
$range = $_POST['range'];

$date = date('Y-m-d');

$range = drop_value($range);

$msg = str_replace( "'", "", $msg );
$msg = str_replace(PHP_EOL,'\n',  $msg );
$msg = preg_replace('/([\r\n\t])/','', $msg);
$msg = preg_replace('/[^A-Za-z0-9,.*%\\\n\-]/', ' ', $msg);

 $range = $range[0]-1;

$min_offset = $range +1;
$max_offset = $range +500;

$offset = $min_offset . ' - '. $max_offset;  

$SendToMobile = array('7021889883','8879265547','9820309824','7710877218');




$sql = mysqli_query($con,"select * from new_member where status = '1' and is_whatsapp_send=1 LIMIT $range,500 ");

while($sql_result = mysqli_fetch_assoc($sql)){
    $SendToMobile[] = $sql_result['mobile']; 
}




foreach($SendToMobile as $key => $val){

    $service_url = 'https://api.chat-api.com/'.$instance.'/checkPhone?token='.$token.'&phone=91'.$val;

    $curl = curl_init($service_url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    $decoded = json_decode($curl_response,true);
    $result = $decoded['result'];
    
    if($result == 'exists'){
        
        $data = ['phone' => '91'.$val, // Receivers phone
            'body' => $doc, // Message
            'filename'=> $doc,
            'caption'=> $msg];
        $json = json_encode($data);
        $modified_json=stripslashes($json);
        $url = 'https://api.chat-api.com/instance172450/sendFile?token=rmmecklghkytj5wu';
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