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
                
         /*      var flightPlanCoordinates = [
          {lat: 37.772, lng: -122.214},
          {lat: 21.291, lng: -157.821},
          {lat: -18.142, lng: 178.431},
          {lat: -27.467, lng: 153.027}
        ];*/
        var flightPath = new google.maps.Polyline({
          path: lat,
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
        //Connect to the mysqli database that is holding your data, replace the x's with your data
     /*   mysqli_connect("localhost", "xxxxx_xxx", "xxxx") or
         die("Could not connect: " . mysqli_error());
        mysqli_select_db("xxxxx_xxxx");*/
       
$qrbranchstr="SELECT * FROM `avo_branch` where 1";
if($_SESSION['designation']=="3")
{
$qrbranchstr.=" and id=".$_SESSION['branch'];
}
//echo $qrbranchstr;
        $qrybranch = mysqli_query($con1,$qrbranchstr);
        //Initialize your first couple variables
        $x = 0; //This is a trigger to keep the string tidy
         
        if($_POST['branch']!=-1 or $_POST['pid']!='')
        {
        $dt= date('Y-m-d');
        $dt= $dt.' 00:00:00';
        if(isset($_POST['date']) && isset($_POST['date2']))  {      
        $fdate=str_replace("/","-",$_POST['date']);
        $time1 = strtotime($fdate);
        $from = date('Y-m-d',$time1).' 00:00:00';
        $tdate=str_replace("/","-",$_POST['date2']);
        $time2 = strtotime($tdate);
        $to = date('Y-m-d',$time2).' 23:59:59';
        }
        if($_POST['pid']!='')
        $resultx = mysqli_query($con1,"SELECT loginid,engg_name FROM `area_engg` where area='".$_POST['branch']."' and loginid=(select srno from login where username='".$_POST['pid']."') and status=1 and deleted=0");
        else
        $resultx = mysqli_query($con1,"SELECT loginid,engg_name FROM `area_engg` where area='".$_POST['branch']."' and status=1 and deleted=0");
        //Now we do a simple query to the database
     //   echo mysqli_num_rows($resultx).'<br>';
       // $result = mysqli_query($con1,"SELECT srno FROM `login` where username='".$_POST['pid']."'");
       $cnt=0;
       $encodedString = ""; //This is the string that will hold all your location data
        while($srno=mysqli_fetch_row($resultx)){
        $cnt++;
        $initials=substr($srno[1],0,1);
        //$srno[0]='1133<br>';
    //    echo $srno[0];
        if(isset($_POST['date']) && isset($_POST['date2']))  {      
        $result = mysqli_query($con1,"SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt between '".$from."' and '".$to."' AND latitude != 0.000000");
    //    echo "SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt between '".$from."' and '".$to."' AND latitude != 0.000000"."<br>";
        }
        else
        $result = mysqli_query($con1,"SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt>'".$dt."' AND latitude != 0.000000");
     //   echo "SELECT id,latitude,longitude,dt FROM `Location` where mac_address in (select mac_id from notification_tble where logid='".$srno[0]."') and dt between '".$from."' and '".$to."'";
      //  echo mysqli_num_rows($result).'<br>';
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
            "<br><b>Address: </b>".$row[3].
            "<br><b>Division: </b>".$row[3].
            "</p>&&&".$row[1]."&&&".$row[2]."&&&".$initials;
            $x = $x + 1;
          //  if(strpos($encodedString,'****')==0)
          //  $encodedString=substr($encodedString,4);
        } 
        ?>
        
        <?php
       // echo $encodedString;
        } } }
       // echo $encodedString;       
        ?>
        <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
        <form action="track.php" method="post" >
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
        </form>
    </div>
    <div id="map_canvas"></div>
    </body>
</html>

 