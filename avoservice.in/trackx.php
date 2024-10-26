<?php
        session_start();
        $mid=$_GET['mid'];
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
                latlong.push(lat);
                google.maps.event.addListener( marker, 'mouseover', function () {
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
      //  session_start();       
       if($_SESSION['user']=='masteradmin' || $_SESSION['designation']=="3")
       {
        include('config.php');
        $dt= date('Y-m-d 08:00:00');
        $dt1= date('Y-m-d 22:00:00');
        $result = mysqli_query($con1,"SELECT id,latitude,longitude,dt FROM `Location` where mac_address='".$mid."' and dt>'2020-06-11 08:00:00' AND dt<='2020-06-11 22:00:00' AND latitude != 0.000000 order by dt");
       // echo "SELECT id,latitude,longitude,dt,address FROM `Location` where mac_address='".$mid."' and dt>'".$dt."' AND dt<='".$dt1."' latitude != 0.000000 order by dt";
        //Multiple rows are returned
        $x=0;
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
           // "<br><b>Name: </b>".$srno[1].
            "<br><b>Address: </b>".$row[4].
            "<br><b>Time: </b>".$row[3].
            "</p>&&&".$row[1]."&&&".$row[2]."&&&".$x;
            $x = $x + 1;
          //  if(strpos($encodedString,'****')==0)
          //  $encodedString=substr($encodedString,4);
        } 
        ?>
        
        <?php
       // echo $encodedString;
        //} 
        //} 
        }
       // echo $encodedString;       
        ?>
        <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
    <!--    <form action="track.php" method="post" >
<?php if($_SESSION['designation']!=3){?>
        Select Branch :<?php } ?><select <?php if($_SESSION['designation']=="3"){?> style="display:none;" <?}?> name="branch" id="branch" required>
<?php if($_SESSION['designation']!="3")
{?>
                      <option value="-1" >select</option>
<?php } ?>
        <?php while($row=mysqli_fetch_row($qrybranch)){ ?>
        <option value="<?php echo $row[0]; ?>" <?php if($_POST["branch"]==$row[0]){ echo "selected";}?>><?php echo $row[1]; ?></option>
        <?php } ?>
        </select>
         Enter ID :<input type="text" name="pid" id="pid" value="<?php echo $_POST["pid"]; ?>" size="10"/>
         From Date :<input type="text" name="date" id="date"  onclick="displayDatePicker('date');" value="<?php echo $_POST["date"]; ?>"  required/>
         To Date :<input type="text" name="date2" id="date2" onclick="displayDatePicker('date2');"  value="<?php echo $_POST["date2"]; ?>" required/> 
        <input type="submit" value="Search" />
        </form>-->
    </div>
    <div id="map_canvas"></div>
    </body>
</html>

 