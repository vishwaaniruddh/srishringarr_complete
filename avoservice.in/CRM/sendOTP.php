<?php
include ('config.php');
$email=$_POST['email']; 
$mob=$_POST['mob'];
$otp=mt_rand(1000,9999);

sendotp($mob,$otp,$email);
// function to send otp
function sendotp($mobile,$otpval,$email)
{
    $curl = curl_init();
//http://control.msg91.com/api/sendotp.php?otp_length=4&authkey=265031A9Tcwgh5PSl5c76512f&sender=loyals&mobile=9323654529&otp=2353
curl_setopt_array($curl, array(
  CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?otp_length=4&authkey=265031A9Tcwgh5PSl5c76512f&sender=loyals&mobile=".$mobile."&otp=".$otpval."&email=".$email,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  return "cURL Error #:" . $err;
} else {
  return $response;
}
} //end of otp function
$datetime=date("Y-m-d H:i:s");
$sqlr2=mysqli_query($conn,"INSERT INTO `otp`( `mobile`, `otpvalue`,`gtime`) VALUES ('".$mob."','".$otp."','".$datetime."')");
if($sqlr2){
echo '1';
}
?>