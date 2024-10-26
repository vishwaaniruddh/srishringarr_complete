<?php 
$pincode = $_POST['pincode'];
try{
$soapclient = new SoapClient('http://netconnect.bluedart.com/Ver1.9/Demo/ShippingAPI/Finder/ServiceFinderQuery.svc?wsdl', array('trace' => 1));

$params = array('pinCode' => $pincode,	
		 'profile' => 
		 array(
		 	'Api_type' => 'S',
			'Area'=>'BOM',
			'Customercode'=>'387273',
			'IsAdmin'=>'',
			'LicenceKey'=>'mufvholvuvstg0sqjfemnebv5stko16j',
			'LoginID'=>'BOM07622',
			'Password'=>'Bluedart@123',
			'Version'=>'1.9')
			);
$response =$soapclient->__soapCall('GetServicesforPincode',array($params));
//var_dump($response);
//echo '<br><br><br>';
$array = json_decode(json_encode($response), true);
//print_r($array);
 //echo '<br><br><br>';
echo  $array['GetServicesforPincodeResult']['DomesticPriorityOutbound'];
/*	  echo '<br><br><br>';
	foreach($array as $item) {
		echo '<pre>'; var_dump($item);
	}  */
}catch(Exception $e){
	echo $e->getMessage();
}	
?>