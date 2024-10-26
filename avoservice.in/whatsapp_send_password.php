<?php
// header("Content-Type:  application/json");



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

$sql = mysqli_query($con, "select DISTINCT mobile,password,id from new_member where status=1 order by id ASC");


while($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
    $mobile = $sql_result['mobile'];
    $password = $sql_result['password'];
    echo $id. ' '.$mobile. ' '.$password;
    
    echo '<br>';
}



// return;
// while($sql_result = mysqli_fetch_assoc($sql)){

// $mobile = $sql_result['mobile'];

// $password = $sql_result['password'];

// $data = [
//           'phone'=> '91'.$mobile,
//           'body'=> 'Hello ! Your Franchise Password is '.$password
//         ];
    
    
    
//       $json = json_encode($data); // Encode data to JSON
        
//         $url = 'https://api.chat-api.com/instance146045/sendMessage?token=mkmkhwk960b3up2l';

//       $options = stream_context_create(['http' => [
//                 'method'  => 'POST',
//                 'header'  => 'Content-type: application/json',
//                 'content' => $json
//             ]
//         ]);
        
//         $result = file_get_contents($url, false, $options);
    
// }


?>