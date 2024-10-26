<?php
error_reporting(0);
// Database Check 
$host="198.38.84.103";
$user="shyambab_Temp";
$pass="sar@123";
$dbname="shyambab_Temple";


$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {

    
}


 $mobile = $_GET['mobile'];
 $SendToMobile = $mobile;
 if(isset($_GET['agent'])){
     $agentMobile = $_GET['agent']; 
     $SendToMobile = $agentMobile;
 }
// $mobile='7021889883';


//----------------------------------------------------------------
$domain_data["fullName"] = "rebrand.ly";
  $post_data["destination"] = "http://www.shyambabadham.com/Committee/vm.php?mobile=".$mobile;
  $post_data["domain"] = $domain_data;
  $ch = curl_init("https://api.rebrandly.com/v1/links");
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "apikey: d058e837e9be489aa66835adcf248fea",
      "Content-Type: application/json"
  ));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
  $result = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($result, true);
  $shortUrl=$response["shortUrl"];
  //print "Short URL is: " . $response["shortUrl"];
//----------------------------------------------------------------

$sql = "SELECT * FROM member where mobile=".$mobile;

$result = mysqli_query($conn,$sql);




// return;
if (mysqli_num_rows($result)> 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {
        $data = [
            'phone' => '91'.$SendToMobile, // Receivers phone
            'body' => 'https://shyambabadham.com/Committee/visiting_card_images/'.$mobile.'.png', // Message
            
            'filename'=> '1.png',
            
             'caption'=> '*Name* : '.ucwords($row['name']).'\n\n *Mobile Number* :'.$row['mobile'].'\n\n *Email*: '.$row['email'].'\n\n *View My Committee* : '.$shortUrl.' \n\n *Bhakt Res Address:* : \n'.$row['address'].' \n Go to map : https://rb.gy/jlrmjj \n\n *Bhakt Office Address* : '.$row['address'].' \n Go to map : https://rb.gy/mxtkcw \n\n *Shyam Baba Dham Address* : Shyam Baba Dham, Village - Chanana, District - Jhunjhunu, Rajasthan - 333026    \n Go to map : https://rb.gy/bl65wk \n\n *Office Address* : 18/2, Sainath Road, Next to Lifeline Hospital, Near Subway, Malad (West), Mumbai - 400064 \n Go to map : https://rb.gy/iwtpsb \n\n *Visit* : \nhttps://www.shyambabadham.com \n\n *Shyam Baba Dham Karyalay Mob No* : \n7700900702 ----- 7700900704'
        ];
    
    
    
        $json = json_encode($data); // Encode data to JSON
        
        $modified_json=stripslashes($json);
        
        $url = 'https://api.chat-api.com/instance86159/sendFile?token=f3j4o90krfo6qrm8';
        
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
<?php

  }
} else {
    echo "0 results";
}

?>
