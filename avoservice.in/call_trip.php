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
     </head>
    <body>
    <div id='input'>
 
        <?php
    
        include('config.php');
        $engg_id=1431; /// Engg Id manually taken
        
        $qryengg = mysqli_query($con1,"SELECT latitude,longitude FROM area_engg where engg_id=='".$engg_id."'");
        $engg = mysqli_fetch_row($qryengg);
        $engg_lat=$engg[0];
        $engg_long=$engg[1];
        
        
        //=========Site -1 Lat long
        $site1_lat=12.12164175237888 ;
        $site1_long=78.15442442736514;
        //   Site - 2 Latlong
        $site1_lat=12.528185602218134;
        $site1_long=78.21373599084527;


?>
</div>      
    </body>
</html>