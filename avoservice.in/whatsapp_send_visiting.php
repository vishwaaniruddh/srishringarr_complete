<?php $id = $_GET['id'];

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


if($sql_result = mysqli_fetch_assoc($sql)){

$mobile = $sql_result['mobile'];

// $mobile = '9826285884';
// return;


        $data = [
            // 'phone' => '91'.$mobile, // Receivers phone
            'phone' => '917021889883',
            'body' => 'https://allmart.world/franchise/visiting_card_images/'.$mobile.'.png', // Message
            'filename'=> '1.png'
        ];
    
    
    

        $json = json_encode($data); // Encode data to JSON
        $modified_json=stripslashes($json);
        
        // $url = 'https://api.chat-api.com/instance148487/sendFile?token=anafitndawvemh6m';
        
        
        $url = 'https://api.chat-api.com/instance172450/sendFile?token=rmmecklghkytj5wu';
        
        
        $options = stream_context_create(['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/json',
                'content' => $modified_json
            ]
        ]);
        
        $result = file_get_contents($url, false, $options);


?>

<script>
    alert('Successfully shares on whatsApp !! ');
    window.history.back();
    
</script>
    
<? }
 else{ ?>
     
     
<script>
    alert('Error on WhatsApp Share !! ');
    window.history.back();
    
</script>
    
    
  <? }

?>