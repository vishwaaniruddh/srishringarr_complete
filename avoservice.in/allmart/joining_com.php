<? include('config.php');

$instance = '180819';
$token = 'buomgfo2nwdad2wd';

error_reporting(0);
ini_set('max_execution_time', 0);

function member($parameter,$id){
    global $con;
    
    $mem_sql = mysqli_query($con,"select $parameter from new_member where id='".$id."'");
    $mem_sql_result = mysqli_fetch_assoc($mem_sql);
    
    return $mem_sql_result[$parameter];

}

function get_image($id){
    global $con;
    
    
    $sql = mysqli_query($con,"select * from  joining_com where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['chart_img'];
}



$id = $_GET['id'];

$image = get_image($id);
$sql = mysqli_query($con,"select * from joining_com_details where joining_com_id='".$id."'");


$mobile = array(); 

$mobile = array('7021889883','9820309824','9867477227');

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $member = $sql_result['member_id'];
    
    if($member=='SAR'){
        $mobile[]= '9323654529';
    }
    else{
    $mobile[] = member('mobile',$member);        
    }

}



$SendToMobile = $mobile;



foreach($SendToMobile as $key => $val){


 
           $data = ['phone' => '91'.$val, // Receivers phone
            'body' => $image, // Message
            'filename'=> $image,
            'caption'=> ''];
        $json = json_encode($data);
 $modified_json=stripslashes($json);
 
$url = 'https://api.chat-api.com/instance172450/sendFile?token=rmmecklghkytj5wu';
        
        //  $url = 'https://api.chat-api.com/instance180819/sendFile?token=buomgfo2nwdad2wd';
         
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
?>

<a href="https://www.allmart.world/franchise">Reuturn to Franchise</a>