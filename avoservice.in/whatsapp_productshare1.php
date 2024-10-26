<?php 
header('Access-Control-Allow-Origin: https://allmart.world');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//header("Content-Type:  application/json");
 $pid = $_POST['pid'];
       $catid=$_POST['catid'];
       $proid=$_POST['proid'];
       $proimg=$_POST['proimg'];
       $mid=$_POST['mid'];
// Database Check 

// $catid = '205';
// $proid = '278';
// $proimg = 'https://allmart.world/ecom/userfiles/491/img/2020/07/15946440070.jpg';
// $pid = '34';
// $mid = '2948';

$host="198.38.84.10";
$user="allmart_sarmicro";
$pass="SARsar@@2020";
$dbname="allmart_web";
$con = new mysqli_($host, $user, $pass, $dbname);
// Check connection
if ($con->connect_error) {
     die("Connection failed: " . $con->connect_error);
} else {
// echo "Connected succesfull";
   
}



$sql = mysqli_query($con, "select * from new_member where id='".$mid."'");

if($sql_result = mysqli_fetch_assoc($sql)){

$mobile = $sql_result['mobile'];

        $data = [
              //'phone' => '91'.$mobile, // Receivers phone
             'phone' => '919039014098',
        //    'title' => 'url',
              'body' => $proimg, // Message
              'filename'=> '1.png',
        ];
    $instance = 'instance172450';
    $token = 'rmmecklghkytj5wu';

    $data = [
        'phone' => '919039014098', // Receivers phone
        'body' => 'Hello, Prabir!', // Message
    ];
    
    

        $json = json_encode($data); // Encode data to JSON
        $modified_json=stripslashes($json);
        
        // echo $modified_json ; 
        $url = 'https://api.chat-api.com/instance172450/sendFile?token=rmmecklghkytj5wu';
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $modified_json
            ]
        ]);
        
        $result = file_get_contents($url, false, $options);
        
        $data1 = [
            //  'phone' => '91'.$mobile, // Receivers phone
             'phone' => '919039014098',
            //  'phone' => '917021889883',
            'body'  => '\n https://allmart.world/product_detail.php?pid='.$pid.'&catid='.$catid.'&prod_id='.$proid.' \n',
        ];
    
        $json1 = json_encode($data1); // Encode data to JSON
        $modified_json1=stripslashes($json1);
        $url1 = 'https://api.chat-api.com/instance172450/sendMessage?token=rmmecklghkytj5wu';
        
        $options1 = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $modified_json1
            ]
        ]);
        
        $result1 = file_get_contents($url1, false, $options1);
        
echo "Shared Successfully";

 }
 else{
     
 }

?>