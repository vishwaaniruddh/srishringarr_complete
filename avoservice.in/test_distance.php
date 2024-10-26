<?php
include('config.php');

//=========
?>
<script>
 function getDistanceOneToOne(lat1, lng1, lat2, lng2)    {
       var Location1Str = lat1 + "," + lng1;
       var Location2Str = lat2 + "," + lng2;
alert(Location1Str);

       let ApiURL = "https://maps.googleapis.com/maps/api/distancematrix/json?";

       let params = `origins=${Location1Str}&destinations=${Location2Str}&key=AIzaSyAPte3KtFoLYgBej7RuZUCg7PSFqV1ov-o`; // you need to get a key
       let finalApiURL = `${ApiURL}${encodeURI(params)}`;

       let fetchResult =  await fetch(finalApiURL); // call API
       let Result =  await fetchResult.json(); // extract json

       return Result.rows[0].elements[0].distance;
    }
</script>
<?
$result=mysqli_query($con1,"SELECT latitude, longitude FROM `area_engg` where status=1 and deleted=0 and engg_id=1071");
$row=mysqli_fetch_row($result);

    $lat1=$row[0];
    $lon1=$row[1];
    
$amctab=mysqli_query($con1,"SELECT latitude1, longitude1 FROM `Amc` where atmid='S1DA0291'");
 $rx=mysqli_fetch_row($amctab);   
        $lat2=$rx[0];
        $lon2=$rx[1];
echo"<br>". $lat1.",".$lon1;
echo"<br>". $lat2.",".$lon2;
        
     //  $dis=distance($lat1, $lon1, $lat2, $lon2, "K");
        echo "<br>.Distance- ".$dis;

$route=getDistanceOneToOne($lat1, $lon1, $lat2, $lon2);
echo "<br>.Route Dist- ".$route;

//=================
?>
<!-- <script>
function getDistanceOneToOne(lat1, lng1, lat2, lng2)    {
const point1[0] = lat1;
const point1[1] = lng1;
const point2[0] = lat2;
const point2[1] = lat2;
const url = `https://router.project-osrm.org/route/v1/walking/${point1[0]},${point1[1]};${point2[0]},${point2[1]}?overview=full`


fetch(url)
.then(function (response) {
  return response.json();
}).then(function (data) {
    console.log(data);
}).catch(function (err) {
    console.warn('Something went wrong.', err);
});

}
</script> -->
