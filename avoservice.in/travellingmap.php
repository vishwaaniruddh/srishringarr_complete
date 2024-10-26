<?php
        session_start();
        ?>
<html>
    <head>
    <script type='text/javascript' src='../jquery-1.6.2.min.js'></script>
    <script type='text/javascript' src='../jquery-ui-1.8.14.custom.min.js'></script>
    
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

    <style>
 
        BODY {font-family : Verdana,Arial,Helvetica,sans-serif; color: #000000; font-size : 13px ; }
 
        #map_canvas { width:100%; height: 100%; z-index: 0; }
    </style>
   <!--  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" /></script>-->
   <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI&sensor=false" ></script>
    <script type='text/javascript'>
 
    //This javascript will load when the page loads.
    jQuery(document).ready( function($){
 
            //Initialize the Google Maps
            var geocoder;
            var map;
            var markersArray = [];
            var infos = [];
            var latlong = [];
 
            geocoder = new google.maps.Geocoder();
            var myOptions = {
                  zoom: 9,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            //Load the Map into the map_canvas div
        //    var map = new google.maps.Map(document.getElementById("map_canvas"//), myOptions);
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
            //Initialize a variable that the auto-size the map to whatever you are plotting
            var bounds = new google.maps.LatLngBounds();
            //Initialize the encoded string       
            var encodedString;
            
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
                latlong.push(lat);
                google.maps.event.addListener( marker, 'click', function () {
                    closeInfos();
                    var info = new google.maps.InfoWindow({content: this.content});
                    //On click the map will load the info window
                    info.open(map,this);
                    infos[0]=info;
                });
                
                var flightPath = new google.maps.Polyline({
          path: latlong,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
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
           include('config.php');
       
       
        
        //Initialize your first couple variables
        $x = 0; //This is a trigger to keep the string tidy
         
        
            
        $engg_id=$_GET['eid'];
        $date=$_GET['date'];
        
        if($date==''){
        $date= date('Y-m-d');
        }
        
       // $engg_logid= $_SESSION['user'];
      //  echo $engg_logid;
 //   echo "SELECT loginid,engg_name,engg_id FROM `area_engg` where engg_id ='".$engg_id."' and status=1 and deleted=0";  
        
        $resultx = mysqli_query($con1,"SELECT loginid,engg_name,engg_id FROM `area_engg` where engg_id ='".$engg_id."' and status=1 and deleted=0");

       
       $cnt=0;
       $encodedString = ""; //This is the string that will hold all your location data
        while($srno=mysqli_fetch_row($resultx)){
        $cnt++;
        $initials=substr($srno[1],0,1);
        //$srno[0]='1133<br>';
    //    echo $srno[0];
            
    $result = mysqli_query($con1,"SELECT id,latitude,longitude,dt,address FROM `Location` where engg_id='".$srno[2]."' and dt between '".$date." 00:00:00' and '".$date." 23:59:59' AND latitude != 0.000000");        
   
    //    echo "SELECT id,latitude,longitude,dt FROM `Location` where engg_id='".$srno[2]."' and dt between '".$date." 00:00:00' and '".$date." 23:59:59' AND latitude != 0.000000"."<br>";
        
    
      //  echo mysqli_num_rows($result).'<br>';
        //Multiple rows are returned
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
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
            "<br><b>Address: </b>".$row[4].
            "<br><b>Time: </b>".$row[3].
            "</p>&&&".$row[1]."&&&".$row[2]."&&&".$initials;
            $x = $x + 1;
          //  if(strpos($encodedString,'****')==0)
          //  $encodedString=substr($encodedString,4);
        } 
        ?>
        
        <?php
       // echo $encodedString;
        } 
           
       
       // echo $encodedString;       
        ?>
        <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
      <!--  <form action="livetrack_engg.php" method="post" >


         Date :<input type="text" name="date" id="date"  readonly="readonly" onclick="displayDatePicker('date');" value="<?php echo $_POST["date"]; ?>"  required/>
         
        <input type="submit" value="Search" />
        </form> -->
    </div>
    <div id="map_canvas"></div>
    </body>
</html>

 