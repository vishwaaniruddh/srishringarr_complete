<?php 

 $mobile = $_GET['mobile'];
 $name=$_GET['name'];
 $district=$_GET['district'];
 $state=$_GET['state'];
 $role=$_GET['role'];

 $data = [
    'phone' => '919867477227', // Receivers phone
    'body' => '*Name* : '.$name.'\n*Mobile* :'.$mobile.'\n*District* :'.$district.'\n*State* : '.$state.'\n*Role* :'.$role, // Message
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

<script> window.location.href = 'https://shyambabadham.com/vishwakirtiman.php'; </script>
