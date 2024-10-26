<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php  include("config.php");
$eid=$_GET['eid']; $fromdt=$_GET['fromdt']; $todt=$_GET['todt'];

 
 function get_atmid($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select atm_id from atm where track_id='".$id."'");
    if(mysqli_num_rows($sql)==0){
    $sql=mysqli_query($con1,"select atmid from Amc where amcid='".$id."'");   
    }
    $result=mysqli_fetch_row($sql);
    $atm_id = $result[0];
    if($atm_id==''){
        $atm_id=$id;
    }
    
    return $atm_id;
}
 
 
//$serviceqry= "SELECT distinct(a.alert_id), b.engineer FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$eid."' and (a.status='Done' or a.call_status='Done') and (alert_type='service' or alert_type='new temp') and b.status !=2 and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY order by close_date ";
$serviceqry= "SELECT distinct(a.alert_id), b.engineer FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$eid."' and (a.status='Done' or a.call_status='Done') and (alert_type='service' or alert_type='new temp') and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY order by close_date ";

echo $serviceqry;

 $str="SELECT * FROM `eng_mis` where eng_id='".$eid."' and  type='Field' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
 $str1="SELECT * FROM `eng_mis` where eng_id='".$eid."' and  type='In House' and mis_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by name ";
                                							
$service=mysqli_query($con1,$serviceqry); 
if(mysqli_num_rows($service)>0){?>

<h2><center>Service Calls</center></h2>
    <table><tr><th>S No.</th><th>Ticket No</th><th>Site Id</th><th>Address</th><th>City</th><th>State</th><th>Attended Date</th></tr>
<?php 
$cnt=1;
   while($ser=mysqli_fetch_row($service)) {			
        
     $alertqry="SELECT atm_id,address,city,state1,assetstatus,responsetime,alert_type ,createdby FROM `alert` where alert_id = '".$ser[0]."'";   
     //   echo $alertqry;
        $call_row=mysqli_query($con1,$alertqry);
        $row=mysqli_fetch_row($call_row);  
       
  echo "<tr><td>".$cnt."</td><td>".$row[7]."</td><td>".get_atmid($row[0])."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td></tr>";
  $cnt++;
   }
   echo "</table>";
}
// $instqry= "SELECT distinct(a.alert_id), b.engineer FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$eid."' and (a.status='Done' or a.call_status='Done') and alert_type='new' and b.status !=2 and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY order by close_date "; 

$instqry= "SELECT distinct(a.alert_id), b.engineer FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$eid."' and (a.status='Done' or a.call_status='Done') and alert_type='new' and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY order by close_date "; 
 $inst=mysqli_query($con1,$instqry);

if(mysqli_num_rows($inst)>0){
?>
  <h2><center>Installation Calls</center></h2>
    <table><tr><th>S No.</th><th>Ticket No</th><th>Site Id</th><th>Address</th><th>City</th><th>State</th><th>Attended Date</th></tr>
  <?php 
$cnt=1;
   while($ins=mysqli_fetch_row($inst)) {			
        
     $alertqry="SELECT atm_id,address,city,state1,assetstatus,responsetime,alert_type ,createdby FROM `alert` where alert_id = '".$ins[0]."'";   
     //   echo $alertqry;
        $call_row=mysqli_query($con1,$alertqry);
        $row=mysqli_fetch_row($call_row);       
  echo "<tr><td>".$cnt."</td><td>".$row[7]."</td><td>".get_atmid($row[0])."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td></tr>";
$cnt++;
   }
      
   echo "</table>";
}   
 
 $pmqry= "SELECT distinct(a.alert_id), b.engineer FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$eid."' and (a.status='Done' or a.call_status='Done') and (alert_type='pm' or alert_type='temp_pm') and b.status !=2 and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY order by close_date "; 
  $pmqry= "SELECT distinct(a.alert_id), b.engineer FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$eid."' and (a.status='Done' or a.call_status='Done') and (alert_type='pm' or alert_type='temp_pm') and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY order by close_date "; 
 $pmro=mysqli_query($con1,$pmqry);
 if(mysqli_num_rows($pmro)>0){
?>
  <h2><center>PM Calls</center></h2>
   <table><tr><th>S No.</th><th>Ticket No</th><th>Site Id</th><th>Address</th><th>City</th><th>State</th><th>Attended Date</th></tr>
<?
$cnt=1;
   while($pm=mysqli_fetch_row($pmro)) {			
        
     $alertqry="SELECT atm_id,address,city,state1,assetstatus,responsetime,alert_type ,createdby FROM `alert` where alert_id = '".$pm[0]."'";   
     //   echo $alertqry;
        $call_row=mysqli_query($con1,$alertqry);
        $row=mysqli_fetch_row($call_row);  
    
  echo "<tr><td>".$cnt."</td><td>".$row[7]."</td><td>".get_atmid($row[0])."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td></tr>";
  $cnt++;
}
   echo "</table>";
}// end if for PM calls
$dereqry= "SELECT distinct(a.alert_id), b.engineer FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$eid."' and (a.status='Done' or a.call_status='Done') and (alert_type='dere' or alert_type='temp_dere') and b.status !=2 and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY order by close_date "; 

$dereqry= "SELECT distinct(a.alert_id), b.engineer FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$eid."' and (a.status='Done' or a.call_status='Done') and (alert_type='dere' or alert_type='temp_dere') and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY order by close_date "; 
 $dere=mysqli_query($con1,$dereqry);
 if(mysqli_num_rows($dere)>0){
               
?>
  <h2><center>De-re Calls</center></h2>
    <table><tr><th>S No.</th><th>Ticket No</th><th>Site Id</th><th>Address</th><th>City</th><th>State</th><th>Attended Date</th></tr>
<?php 
$cnt=1;
   while($dererow=mysqli_fetch_row($dere)) {			
        
     $alertqry="SELECT atm_id,address,city,state1,assetstatus,responsetime,alert_type ,createdby FROM `alert` where alert_id = '".$dererow[0]."'";   
     //   echo $alertqry;
        $call_row=mysqli_query($con1,$alertqry);
        $row=mysqli_fetch_row($call_row);      
       
  echo "<tr><td>".$cnt."</td><td>".$row[7]."</td><td>".get_atmid($row[0])."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td></tr>";
$cnt++;
   }
   echo "</table>";
}// end if for Dere calls

if(mysqli_num_rows($opencall)>0) {                    
?>
  <h2><center>Other Field Calls</center></h2>
    <table><tr><th>S No.</th><th>DATE</th><th>CUSTOMER</th><th>LOCATION</th><th>FROM TIME</th><th>TO TIME</th><th>REMARKS</th></tr>
<?php 
     $cnt=1;
     while($row=mysqli_fetch_row($opencall))                                          
      {        
       
  echo "<tr><td>".$cnt."</td><td>".$row[1]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td></tr>";

       $cnt++;
      }
   echo "</table>";
}// end if for On Field calls
if(mysqli_num_rows($opencall1)>0) {                    
?>
  <h2><center>In House Calls</center></h2>
    <table><tr><th>S No.</th><th>DATE</th><th>CUSTOMER</th><th>LOCATION</th><th>FROM TIME</th><th>TO TIME</th><th>REMARKS</th></tr>
<?php 
     $cnt=1;
     while($row=mysqli_fetch_row($opencall1))                                          
      {        
       
  echo "<tr><td>".$cnt."</td><td>".$row[1]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td></tr>";

       $cnt++;
      }
   echo "</table>";
}// end if for In House calls

?>
