<?php
        session_start();
        ?>
<html>
    <head>
    <script type='text/javascript' src='jquery-1.6.2.min.js'></script>
    <script type='text/javascript' src='jquery-ui-1.8.14.custom.min.js'></script>
    
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

    <style>
 
        BODY {font-family : Verdana,Arial,Helvetica,sans-serif; color: #000000; font-size : 13px ; }
 
        #map_canvas { width:100%; height: 100%; z-index: 0; }
    </style>
   
    <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI&sensor=false&region=IN" ></script>
    <script type='text/javascript'>
    function distance(lat1, lon1, lat2, lon2, unit) {
	var radlat1 = Math.PI * lat1/180;
	var radlat2 = Math.PI * lat2/180;
	var theta = lon1-lon2;
	var radtheta = Math.PI * theta/180;
	var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
	dist = Math.acos(dist);
	dist = dist * 180/Math.PI;
	dist = dist * 60 * 1.1515;
	if (unit=="K") { dist = dist * 1.609344; }
	if (unit=="N") { dist = dist * 0.8684; }
	alert(dist);
	return dist;
}
 
    //This javascript will load when the page loads.
    jQuery(document).ready( function($){
 
            //Initialize the Google Maps
            var geocoder;
            var map;
            var markersArray = [];
            var infos = [];
 
            geocoder = new google.maps.Geocoder();
            var myOptions = {
                  zoom: 9,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            //Load the Map into the map_canvas div
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
            //Initialize a variable that the auto-size the map to whatever you are plotting
            var bounds = new google.maps.LatLngBounds();
            //Initialize the encoded string       
            var encodedString;
            //Initialize the array that will hold the contents of the split string
            
           // var enc = [];
            //Get the value of the encoded string from the hidden input
            //enc = document.getElementsByName("encodedString");
            //alert(enc.length);
            //var ct=enc.length;
            //for(int i=0;i<ct;i++){
            var stringArray = [];
            encodedString = document.getElementsByName("encodedString")[0].value;
            //Split the encoded string into an array the separates each location
            stringArray = encodedString.split("****");
 
            var x;
            for (x = 0; x < stringArray.length; x = x + 1)
            {
                var addressDetails = [];
                var marker;
                //Separate each field
                addressDetails = stringArray[x].split("&&&");
                //Load the lat, long data
                var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);
                //Create a new marker and info window
                marker = new google.maps.Marker({
                    map: map,
                    position: lat,
                    label: addressDetails[3],
                    //Content is what will show up in the info window
                    content: addressDetails[0]
                });
                //Pushing the markers into an array so that it's easier to manage them
                markersArray.push(marker);
                google.maps.event.addListener( marker, 'click', function () {
                    closeInfos();
                    var info = new google.maps.InfoWindow({content: this.content});
                    //On click the map will load the info window
                    info.open(map,this);
                    infos[0]=info;
                });
               //Extends the boundaries of the map to include this new location
               bounds.extend(lat);
            }
           // }
            //Takes all the lat, longs in the bounds variable and autosizes the map
            map.fitBounds(bounds);
 
            //Manages the info windows
            function closeInfos(){
           if(infos.length > 0){
              infos[0].set("marker",null);
              infos[0].close();
              infos.length = 0;
           }
            }
 
    });
    </script>
 
    </head>
    <body>
    <div id='input'>
 
        <?php
      //  session_start();       
    //   if($_SESSION['user']=='masteradmin')
    //   {
        include('config.php');
        //Connect to the mysqli database that is holding your data, replace the x's with your data
     /*   mysqli_connect("localhost", "xxxxx_xxx", "xxxx") or
         die("Could not connect: " . mysqli_error());
        mysqli_select_db("xxxxx_xxxx");*/
       
        
         
       
        $dt= date('Y-m-d');
        $dt= $dt.' 00:00:00';
        
        if($_GET['pid']!=''){
        $qrybranch = mysqli_query($con1,"SELECT latitude,longitude FROM `site_location` where atmid=(select atm_id from alert where alert_id='".$_GET['pid']."')");
           $rowbranch =mysqli_fetch_row($qrybranch );
        //Initialize your first couple variables
        $x = 0; //This is a trigger to keep the string tidy
        $qryy=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$_GET['pid']."'");
        $eng_id=mysqli_fetch_row($qryy);
    //    echo "select engineer from alert_delegation where alert_id='".$_GET['pid']."'";
        $resultx = mysqli_query($con1,"SELECT loginid,engg_name FROM `area_engg` where engg_id='".$eng_id[0]."'");
   
        }
  
       $cnt=0;
       $encodedString = ""; //This is the string that will hold all your location data
        while($srno=mysqli_fetch_row($resultx)){
        $cnt++;
        $initials=substr($srno[1],0,1);
        //$srno[0]='1133<br>';
      //  echo $srno[0];
    $resultxy = mysqli_query($con1,"SELECT entry_date FROM `alert` where alert_id='".$_GET['pid']."'");
        $edate=mysqli_fetch_row($resultxy);
        $result = mysqli_query($con1,"SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt>'".$edate[0]."' AND latitude != 0.000000");
     
        //Multiple rows are returned
        while ($row = mysqli_fetch_array($result, mysqli_NUM))
        {
            //This is to keep an empty first or last line from forming, when the string is split
            if ( $x == 0 )
            {
                 $separator = "";
            }
            else
            {
                 //Each row in the database is separated in the string by four *'s
                 $separator = "****";
            }
            //Saving to the String, each variable is separated by three &'s
            $encodedString = $encodedString.$separator.
            "<p class='content'><b>Lat:</b> ".$row[1].
            "<br><b>Long:</b> ".$row[2].
            "<br><b>Name: </b>".$srno[1].
         //   "<br><b>Address: </b>".$row[3].
            "<br><b>Time: </b>".$row[3].
            "</p>&&&".$row[1]."&&&".$row[2]."&&&".$initials;
            $x = $x + 1;
          //  if(strpos($encodedString,'****')==0)
          //  $encodedString=substr($encodedString,4);
          $llat=$row[1];
        $llong=$row[2];
        } 
        $encodedString=$encodedString."@";
        $encodedString = $encodedString."****".
            "<p class='content'><b>Lat:</b> ".$rowbranch[0].
            "<br><b>Long:</b> ".$rowbranch[1].
            "<br><b>Name: </b>SITE".
           // "<br><b>Address: </b>".$row[3].
          //  "<br><b>Division: </b>".$row[3].
            "</p>&&&".$rowbranch[0]."&&&".$rowbranch[1]."&&&$$";
           $slat=$rowbranch[0];
        $slong=$rowbranch[1]; 
      //  echo $llat.'-'.$llong.'-'.$slat.'-'.$slong;
        ?>
       
        <?php
     //   echo $encodedString;
        } //} 
     //   echo $encodedString;       
        ?>
       <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
       <font color="red" >Distance from Site: <input type="label" id="dist" name="dist" readonly="readonly" />
       
       </font>
        <form action="calltrack.php" method="post" >
        
    <!--    Enter Call ID :<input type="text" name="pid" id="pid" size="10"/>
         
        <input type="submit" value="Search" />-->
        </form>
    </div>
    <script>
    //   var dista=distance(<?php echo $llat; ?>,<?php echo $llong; ?>,<?php echo $slat; ?>,<?php echo $slong; ?>,"K");
       
       khu = 21.208435138368934, 81.40130301035904
       rai = 21.25642157622186, 81.63041885268908
       dist = dista=distance(<?php echo 21.208435138368934; ?>,<?php echo 81.40130301035904; ?>,<?php echo 21.25642157622186; ?>,<?php echo 81.63041885268908; ?>,"K");
       alert((dista*100)+" meters");
       document.getElementById("dist").value=dista.toFixed(3)+" KM";
      
      </script>
    <div id="map_canvas"></div>
    </body>
</html>

 