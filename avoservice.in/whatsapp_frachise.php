<?php
header("Content-Type:  application/json");


$id = $_GET['id'];

// Database Check 
$host="198.38.84.103";
$user="allmart_sarmicro";
$pass="SARsar@@2020";
$dbname="allmart_web";
$con = new mysqli_($host, $user, $pass, $dbname);
// Check connection
if ($con->connect_error) {
    // die("Connection failed: " . $con->connect_error);
} else {
// echo "Connected succesfull";
   
}

$sql = mysqli_query($con, "select * from new_member where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);
$mobile = $sql_result['mobile'];


$otp_sql = mysqli_query($con,"select * from otp_verification where mobile_no='".$mobile."'");
$otp_sql_result = mysqli_fetch_assoc($otp_sql);

$otp = $otp_sql_result['otp'];

$data = [
          'phone'=> '91'.$mobile,
          'body'=> 'Hello ! Your Franchise Login Otp is '.$otp
        ];
    
    
    
      $json = json_encode($data); // Encode data to JSON
        
        $url = 'https://api.chat-api.com/instance146045/sendMessage?token=mkmkhwk960b3up2l';
        // $url = 'https://api.chat-api.com/instance144540/sendMessage?token=2sxg4xt9a83t0dj0';
        //  $url = 'https://api.chat-api.com/instance142969/sendMessage?token=uchf9qh0t7nsj3jr';
        //   $url = 'https://api.chat-api.com/instance141128/sendMessage?token=l56fn1j0s74ju8vs';

      $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
        
        $result = file_get_contents($url, false, $options);


        return;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);
if(!$json) {
    echo curl_error($ch);
}
curl_close($ch);
print_r(json_decode($json));



var_dump($result);

?>