<?php
include('config.php');
//include('db_connection.php');
//$con1 = OpenCon1();

$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';
//echo $sqlme;



$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string); 
  
   return preg_replace('/-+/', '-', $string); 
}
//echo mysqli_num_rows($table);

$contents='';
 $contents.="Sr. No.\t Complaint ID\t Vertical/Client Name\t te/Sol/ATM ID\t Site End User\t City\t Address\t Branch\t Problem\t Alert Date\t Call Type\t Last FeedBack\t Response Time\t Eng Close Status\t Engineer Name\t Engineer at Site Duration\t";
 //echo $contents;
 $cnt=0;

while($calls = mysqli_fetch_row($table)){
$cnt++;
$sql="Select * from alert where alert_id ='".$calls[0]."' ";
//echo $sql;
$aler=mysqli_query($con1,$sql);
$row= mysqli_fetch_row($aler);

     
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	if ($row[21]=='site') {
	$atmid= mysqli_query($con1,"select select atm_id,latitude,longitude,address,city,state1 from atm where track_id='".$row[2]."'"); 
	    
	} else if ($row[21]=='amc') {
	$atmid= mysqli_query($con1,"select atmid,latitude1,longitude1,address,city,state from Amc where amcid='".$row[2]."'"); 
	}
	$atmdet=mysqli_fetch_row($atmid);
	$atm_id=$atmdet[0];
	
	if($atm_id=='') { $atm_id= $row[2]; }
	
	$tab=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
	
	$br= mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'"); 
	
	$branch=mysqli_fetch_row($br);

$contents.="\n".$cnt."\t";
$contents.=$row[25]."\t";

$contents.=$custrow[0]."\t";
$contents.=$atm_id."\t";
$contents.=$row[3]."\t";
$contents.=$row[6]."\t";
$contents.=$row[5]."\t";
$contents.=$branch[0]."\t";
$contents.=$row[9]."\t";
$contents.=$row[10]."\t";
$contents.=$row[17]."\t";
$contents.=clean($row1[0])."\t";
$contents.=$calls[1]."\t";

if ($row[15]=='Done') {$stat = "Closed By Engineer";} 
else if($row[16]=='Done') {$stat= "Closed By Branch" ;}
$contents.=$stat."\t";



$cdate = $calls[1];
$rdate = date("Y-m-d",strtotime($cdate)); 


$engqry = "SELECT engg_id, engg_name FROM `area_engg` where loginid='".$calls[2]."'";
//echo $engqry;
$engg_row=mysqli_query($con1,$engqry); 
$eng_idd=mysqli_fetch_row($engg_row);

//echo "Hello".$eng_idd;
  
$mintime = date("Y-m-d H:i:s", strtotime("-1 minute", strtotime($cdate)));
$maxtime=  date("Y-m-d H:i:s", strtotime("+1 minute", strtotime($cdate)));

$timeqry = "SELECT latitude, longitude FROM `Location` where dt between '$mintime' and '$maxtime' and engg_id ='$eng_idd[0]' order by id DESC limit 1 "; 
//echo $timeqry;
$time_row=mysqli_query($con1,$timeqry); 
$time_row=mysqli_fetch_row($time_row);  

$latitude=$time_row[0]; 
$longitude=$time_row[1]; 
//echo $latitude."--".$longitude;

 $contents.=$eng_idd[1]."\t";
if($latitude ==0) { echo "Unable to get LatLong"; } 
  else {
    //$radius = 20; // in miles
    //  $radius = 25*0.621371192; // in km
    $radius = 0.5*0.621371192;

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);
 
 //echo $longitude."===".$lng_min."---".$lng_max;
   //=======or Engineer Residence========
$qry2="SELECT * FROM Location WHERE  (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) and engg_id='$eng_idd[0]' and CAST(dt AS date)= '$rdate' order by dt ASC";

//echo $qry2;
$res=mysqli_query($con1,$qry2);
if(mysqli_num_rows($res) >0){
while ($locrow=mysqli_fetch_row($res)) {
    $ftime[]=$locrow[4];
}

$first=current($ftime);
$end=end($ftime);
//$total = count($ftime);

$diff = abs(strtotime($end) - strtotime($first));
$tmins = $diff/60;
$hours = floor($tmins/60);
$mins = $tmins%60;

//echo $hours." Hours, ".$mins." Minutes";
$contents.=$hours." Hours, ".$mins." Minutes"."\t";
  } else $contents.="No Records Found"."\t"; 
      
  } 




}

$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
   header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
// CloseCon($con1); 
