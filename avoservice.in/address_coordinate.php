<? 
include("access.php");
include("config.php");
include("andi/GCM.php");
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI"></script>
<!--<script>
    var latitude = '';
    var longitude = '';

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode(
    { 
       componentRestrictions: { 
           country: 'IN', 
           postalCode: '744102'
       } 
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            latitude = results[0].geometry.location.lat();
            longitude = results[0].geometry.location.lng();
            console.log(latitude + ", " + longitude);
        } else {
            alert("Request failed.")
        }
    });
</script> -->


<?




//=======ATM table
$at=mysqli_query($con1,"select track_id, address,city,state1,pincode from atm where latitude='0.0000000000' and active='Y'and branch_id=5 ");

//==============AMC table===
//$at=mysqli_query($con1,"select amcid,address,city,state, pincode from Amc where latitude='0.0000000000' and active ='Y'and branch=1 and amcid= ");

while($atro=mysqli_fetch_row($at)) {
	
      	$track_id=$atro[0];
        
        $addsplit=explode(',', $atro[1]);
        
   // $add=$addsplit[1].','.$addsplit[2].','.$addsplit[3].','.$addsplit[4].','.$addsplit[5].','.$addsplit[6] ;
      
    // $address=$atro[1].','.$atro[2].','.$atro[3].','.$atro[4];  
     
 $address=$atro[1];
    
     //   $formattedAddr = str_replace(' ','+',$address);
      $formattedAddr=$address;
      echo $formattedAddr."<br>";
       
        //Send request and receive json data by address
        $geocodeFromAddr = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false&key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI'); 
        $output = json_decode($geocodeFromAddr);
        //Get latitude and longitute from json data
        //$data['latitude']  = $output->results[0]->geometry->location->lat; 
        //$data['longitude'] = $output->results[0]->geometry->location->lng;
        //Return latitude and longitude of the given address
        //print_r($output);
        echo $data['latitude'];
        echo $data['longitude'];
        
        $latitude=$output->results[0]->geometry->location->lat; 
        $longitude=$output->results[0]->geometry->location->lng; 
        
    $update=mysqli_query($con1,"update atm set latitude='".$latitude."',longitude='".$longitude."' where track_id='".$track_id."'");
	   
//	mysqli_query($con1,"update Amc set latitude='".$latitude."',longitude='".$longitude."' where amcid='".$track_id."'");
  
  echo "update atm set latitude='".$latitude."',longitude='".$longitude."' where track_id='".$track_id."'";
  
	}    ?>