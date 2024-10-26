<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php  include("config.php");
$eid=$_GET['eid']; $todt=$_GET['todt']; $ct=$_GET['ct'];
     // echo $eid;
     $brqry=mysqli_query($con1,"select engg_id,engg_name,loginid from area_engg where area='".$eid."' and status=1 and deleted=0");  
     while($brrow= mysqli_fetch_row($brqry)){    
     ?>
    <!-- <center><b><u><?php echo $brrow[1]; ?></u></b></center>-->
     <?php                    
     $alerts='';
				$engqry=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$brrow[0]."'");                          
				while($engrow= mysqli_fetch_row($engqry)){
				$alerts=$alerts.$engrow[0].',';
				}
				$alerts=substr($alerts,0,strlen($alerts)-1);
				// echo $stratn;        
				if($ct=='sc') {
				$strsc="SELECT atm_id,address,city,state1,assetstatus,close_date,alert_type FROM `alert` where alert_id in(".$alerts.") and (alert_type='service' or alert_type='new temp') and close_date Between STR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";      
				//echo $strsc;     
				}else if($ct=='ins') {                         
 $strins="SELECT atm_id,address,city,state1,assetstatus,responsetime,alert_type FROM `alert` where alert_id in(".$alerts.") and alert_type='new' and close_date Between STR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";      
                               }else if($ct=='pm') {
 $strpm="SELECT atm_id,address,city,state1,assetstatus,responsetime,alert_type FROM `alert` where alert_id in(".$alerts.") and (alert_type='temp_pm' or alert_type='pm') and close_date Between STR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY"; 
 $strpm1="SELECT * FROM `Pmcalls` where engId='".$brrow[2]."' and (Uptime Between STR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY)";
                                }else if($ct=='dere') {    
 $strdere="SELECT atm_id,address,city,state1,assetstatus,responsetime,alert_type FROM `alert` where alert_id in(".$alerts.") and (alert_type='dere' or alert_type='temp_dere') and close_date Between STR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
                                }else if($ct=='atd') {
 $stratd="SELECT a.atm_id,a.address,a.city,a.state1,a.assetstatus,b.responsetime,a.alert_type FROM `alert` a,alert_progress b where a.alert_id in(".$alerts.") and (b.responsetime Between STR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY and a.close_date='0000-00-00 00:00:00') and a.alert_id=b.alert_id";         
// echo  "SELECT a.atm_id,a.address,a.city,a.state1,a.assetstatus,b.responsetime,a.alert_type FROM `alert` a,alert_progress b where a.alert_id in(".$alerts.") and (b.responsetime Between STR_TO_DATE('$todt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY and a.close_date='0000-00-00 00:00:00') and a.alert_id=b.alert_id";                     							
}
//echo $str;					                    					
				$atn=0;$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;$cntdere=0;$cntatd=0;	
			//	$atncall=mysqli_query($con1,$stratn);
			//        $opencall=mysqli_query($con1,$str);
			//	$opencall1=mysqli_query($con1,$str1);                                                      
                              $opencallpm=mysqli_query($con1,$strpm);
                              $opencallpm1=mysqli_query($con1,$strpm1);
                              $opencalldere=mysqli_query($con1,$strdere);
                              $opencallatd=mysqli_query($con1,$stratd);
                              
                              if($ct=='sc') {
                              $opencallsc=mysqli_query($con1,$strsc);
                    if(mysqli_num_rows($opencallsc)>0)     {                    
?><center><b><u><?php echo $brrow[1]; ?></u></b></center>
 <!-- <h2><center>Service Calls</center></h2>-->
    <table><tr><th>S No.</th><th>ATMID</th><th>ADDRESS</th><th>CITY</th><th>STATE</th><th>DATE TIME</th>    <th>STATUS</th></tr>
<?php 
     $cnt=1;
     while($row=mysqli_fetch_row($opencallsc))                                          
      { 
       if($row[4]=='site'){
       $atmqry=mysqli_query($con1,"select atm_id from atm where track_id=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else if($row[4]=='amc'){
       $atmqry=mysqli_query($con1,"select atmid from Amc where amcid=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else
       $atmid=$row[0];
       
  echo "<tr><td>".$cnt."</td><td>".$atmid."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td><td>&nbsp;</td></tr>";


       $cnt++;
      }
   echo "</table>";
} }// end if for service calls
else if($ct=='ins') { 
$opencallins=mysqli_query($con1,$strins);
if(mysqli_num_rows($opencallins)>0) {                    
?><center><b><u><?php echo $brrow[1]; ?></u></b></center>
 <!-- <h2><center>Installation Calls</center></h2>-->
    <table><tr><th>S No.</th><th>ATMID</th><th>ADDRESS</th><th>CITY</th><th>STATE</th><th>DATE TIME</th><th>STATUS</th></tr>
<?php 
     $cnt=1;
     while($row=mysqli_fetch_row($opencallins))                                          
      { 
       if($row[4]=='site'){
       $atmqry=mysqli_query($con1,"select atm_id from atm where track_id=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else if($row[4]=='amc'){
       $atmqry=mysqli_query($con1,"select atmid from Amc where amcid=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else
       $atmid=$row[0];
       
  echo "<tr><td>".$cnt."</td><td>".$atmid."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td><td>&nbsp;</td></tr>";

       $cnt++;
      }
   echo "</table>";
} }// end if for installation calls
else if($ct=='pm') { 
$opencallpm=mysqli_query($con1,$strpm);
if(mysqli_num_rows($opencallpm)>0) {                    
?><center><b><u><?php echo $brrow[1]; ?></u></b></center>
  <!--<h2><center>PM Calls</center></h2>-->
    <table><tr><th>S No.</th><th>ATMID</th><th>ADDRESS</th><th>CITY</th><th>STATE</th><th>DATE TIME</th><th>STATUS</th></tr>
<?php 
     $cnt=1;
     while($row=mysqli_fetch_row($opencallpm))                                          
      { 
       if($row[4]=='site'){
       $atmqry=mysqli_query($con1,"select atm_id from atm where track_id=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else if($row[4]=='amc'){
       $atmqry=mysqli_query($con1,"select atmid from Amc where amcid=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else
       $atmid=$row[0];
       
  echo "<tr><td>".$cnt."</td><td>".$atmid."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td><td>&nbsp;</td></tr>";

       $cnt++;
      }
   echo "</table>";
}
$opencallpm1=mysqli_query($con1,$strpm1);
if(mysqli_num_rows($opencallpm1)>0) {                    
?><center><b><u><?php echo $brrow[1]; ?></u></b></center>
  <!--<h2><center>PM Calls(Mobile App)</center></h2>-->
    <table><tr><th>S No.</th><th>ATMID</th><th>UPS STATUS</th><th>BATTERY STATUS</th><th>BACK UP</th><th>DATE TIME</th><th>STATUS</th></tr>
<?php 
     $cnt=1;
     while($row=mysqli_fetch_row($opencallpm1))                                          
      { 
     /*  if($row[4]=='site'){
       $atmqry=mysqli_query($con1,"select atm_id from atm where track_id=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else if($row[4]=='amc'){
       $atmqry=mysqli_query($con1,"select atmid from Amc where amcid=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else
       $atmid=$row[0];*/
       
  echo "<tr><td>".$cnt."</td><td>".$row[1]."</td><td>".$row[3]."</td><td>".$row[8]."</td><td>".$row[7]."</td><td>".$row[11]."</td><td>&nbsp;</td></tr>";

       $cnt++;
      }
   echo "</table>";
} }// end if for PM calls
else if($ct=='dere') { 
$opencalldere=mysqli_query($con1,$strdere);
if(mysqli_num_rows($opencalldere)>0) {                    
?><center><b><u><?php echo $brrow[1]; ?></u></b></center>
  <!--<h2><center>DERE Calls</center></h2>-->
    <table><tr><th>S No.</th><th>ATMID</th><th>ADDRESS</th><th>CITY</th><th>STATE</th><th>DATE TIME</th><th>STATUS</th></tr>
<?php 
     $cnt=1;
     while($row=mysqli_fetch_row($opencalldere))                                          
      { 
       if($row[4]=='site'){
       $atmqry=mysqli_query($con1,"select atm_id from atm where track_id=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else if($row[4]=='amc'){
       $atmqry=mysqli_query($con1,"select atmid from Amc where amcid=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else
       $atmid=$row[0];
       
  echo "<tr><td>".$cnt."</td><td>".$atmid."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td><td>&nbsp;</td></tr>";

       $cnt++;
      }
   echo "</table>";
} }// end if for On Field calls
else if($ct=='atd') { 
$opencallatd=mysqli_query($con1,$stratd);
if(mysqli_num_rows($opencallatd)>0) {                    
?><center><b><u><?php echo $brrow[1]; ?></u></b></center>
 <!-- <h2><center>Attended Calls</center></h2>-->
   <table><tr><th>S No.</th><th>ATMID</th><th>ADDRESS</th><th>CITY</th><th>STATE</th><th>DATE TIME</th><th>STATUS</th></tr>
<?php 
     $cnt=1;
     while($row=mysqli_fetch_row($opencallatd))                                          
      { 
       if($row[4]=='site'){
       $atmqry=mysqli_query($con1,"select atm_id from atm where track_id=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else if($row[4]=='amc'){
       $atmqry=mysqli_query($con1,"select atmid from Amc where amcid=".$row[0]);
       $atmrow=mysqli_fetch_row($atmqry);
       $atmid=$atmrow[0];
       }
       else
       $atmid=$row[0];
       
  echo "<tr><td>".$cnt."</td><td>".$atmid."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td><td>&nbsp;</td></tr>";

       $cnt++;
      }
   echo "</table>";
}}// end if for In House calls
}
?>
