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
 
        #map_canvas { width:75%; height: 100%; z-index: 0; float:left; }
        
        .row {
    display : flex;
    align-items : center;
    margin-bottom: 15px;
}
.box {
  height: 20px;
  width: 20px;
  border: 1px solid black;
  margin-right : 5px;
  clear: both;
}

.red {
  background-color: red;
}

.green {
  background-color: green;
}

.yellow {
  background-color: yellow;
}
    </style>
   <!--  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" /></script>-->
   <script  type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBE1Xgn2mQmGOtUevIuFYw6443BkKCjbI&sensor=false&region=IN" ></script>
    <script type='text/javascript'>
 
    //This javascript will load when the page loads.
    jQuery(document).ready( function($){
 
            //Initialize the Google Maps
            var geocoder;
            var map;
            var markersArray = [];
            var infos = [];
            var latlong = [];
            var mids = [];
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
            debugger;
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
                var mid=  addressDetails[3];
                //Create a new marker and info window
                marker = new google.maps.Marker({
                    map: map,
                    position: lat,
                    content: addressDetails[0],
                    icon: {
      url: "http://maps.google.com/mapfiles/ms/icons/"+addressDetails[4]
    },
                    //label: addressDetails[3],
                    val: addressDetails[3],
                    //Content is what will show up in the info window
                    //content: addressDetails[0]
                    
                });
                //Pushing the markers into an array so that it's easier to manage them
                markersArray.push(marker);
                latlong.push(lat);
                mids.push(mid);
                google.maps.event.addListener( marker, 'mouseover', function () {
                    closeInfos();
                    var info = new google.maps.InfoWindow({content: this.content});
                    //On click the map will load the info window
                    info.open(map,this);
                    infos[0]=info;
                });
                
                google.maps.event.addListener( marker, 'click', function () {
            //window.open("http://avoservice.in/trackx.php?mid="+this.val);
                });
                
        /*        var flightPath = new google.maps.Polyline({
          path: latlong,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);*/
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
       if($_SESSION['designation']=='1' ||  $_SESSION['designation']=="3")
       {
        include('config.php');
 
        //Initialize your first couple variables
        $x = 0; //This is a trigger to keep the string tidy
         
     
        $resultx = mysqli_query($con1,"SELECT loginid,engg_name,engg_id FROM `area_engg` where status=1 and deleted=0");
       $cnt=0;
       $encodedString = ""; //This is the string that will hold all your location data
       $cnt_online=0;$cnt_offline=0;$gps_off=0;
        while($srno=mysqli_fetch_row($resultx)){
           $cnt++;
           $initials=substr($srno[1],0,1);
         
           $dd=date('Y-m-d H:i:s', strtotime('-120 minutes'));
         //  $sql_qry = "SELECT latitude,longitude,last_updated,mac_id FROM `engg_current_location` where engg_id='".$srno[2]."'";
           
           $result = mysqli_query($con1,"SELECT latitude,longitude,last_updated,mac_id FROM `engg_current_location` where engg_id='".$srno[2]."'");
     
         // Multiple rows are returned
        
           // $row = mysqli_fetch_array($result, mysqli_NUM);
            $row = mysqli_fetch_array($result);
           // echo '<pre>';print_r($row);echo '</pre>';die;
            if($row[0]==0.0000000000){ $gps_off++; continue;}
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
            if($row[2]>$dd) { $col="green-dot.png"; $cnt_online++;}
            else { $col="yellow-dot.png"; $cnt_offline++; }
            
            $encodedString = $encodedString.$separator.
            "<p class='content'><b>Lat:</b> ".$row[0].
            "<br><b>Long:</b> ".$row[1].
            "<br><b>Name: </b>".$srno[1].
            //"<br><b>Address: </b>".$row[3].
            "<br><b>Time: </b>".$row[2].
            "</p>&&&".$row[0]."&&&".$row[1]."&&&".$row[3]."&&&".$col;
            $x = $x + 1;
          //  if(strpos($encodedString,'****')==0)
          //  $encodedString=substr($encodedString,4);
         
        ?>
        
        <?php
       // echo $encodedString;
       // }
       } 
       $sqlx=mysqli_query($con1,"SELECT count(*),del_type FROM `Delegation_tracking` where del_date like'".date('Y-m-d')."%' GROUP by del_type");
    //   echo "SELECT count(*),del_type FROM `Delegation_tracking` where del_date like'".date('Y-m-d')."%' GROUP by del_type";
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
    <div id="map_canvas" ></div>
    <div style="float:left;margin:10px">
        
        <div class="row">
  <div class='box green'></div>
  <span>= Online (<?php echo $cnt_online; ?>)</span>
</div>
<div class="row">
        <div class='box yellow'></div><a href="offline_2hrs.php" target="_new"><span>= Offline for more than 2 hours (<?php echo $cnt_offline; ?>)</span></a>
        </div>
        <div class="row">
        <div class='box red'></div><a href="offline.php" target="_new"><span>= GPS Off (<?php echo $gps_off; ?>)</span></a>
        </div>
        
        <center><a href="livetrack.php" >Reload</a></center>
        <br><br><br>
        <?php
          $gps; $his; $dbm;
          while($srow=mysqli_fetch_row($sqlx)){
              if($srow[1]==1)
              { echo "GPS Delegation - ".$srow[0]."<br>"; $gps=$srow[0]; }
              else if($srow[1]==2)
              { echo "History Delegation - ".$srow[0]."<br>"; $his=$srow[0]; }
              else if($srow[1]==3)
              { echo "DB Mapped Delegation - ".$srow[0]."<br>"; $dbm=$srow[0]; }
              
          }
          echo "Total = ".($gps+$his+$dbm)."<br><br>"; $total=$gps+$his+$dbm;
          echo "GPS -".round($gps*100/$total,2)."%<br>";
          echo "History -".round($his*100/$total,2)."%<br>";
          echo "Mapped -".round($dbm*100/$total,2)."%<br>";
        ?>
        </div>
    </body>
</html>

 