<?php
	//Include database connection details
	include('db_conn.php');

$alertid = $_GET['alertid'];
if(isset($_GET['alertid'])){

$sql2=mysqli_query($conapp,"select * from alert where alert_id='".$alertid."'");	

if($sql2){
	$row2=mysqli_fetch_row($sql2);
if(($row2[17]=='service' || $row2[17]=='new' || $row2[17]=='pm') &&  $row2[21] ==  'amc')
    $atm=mysqli_query($conapp,"select atmid from Amc where amcid='".$row2[2]."'");
	elseif(($row2[17]=='service' || $row2[17]=='new') &&  $row2[21] == 'site')
	$atm=mysqli_query($conapp,"select atm_id from atm where track_id='".$row2[2]."'");


	  if($row2[17]=='new temp' || $row2[17]=='temp_pm' || $row2[17]=='temp_dere' || $row2[17]=='temp_servi' || $row2[17]=='temp_w2pcb'){ $atmid=$row2[2]; }else {  
  $atmrow=mysqli_fetch_row($atm);
   $atmid=$atmrow[0];  }
   
  if($row2[9]!='')
  $problem=$row2[9];
  else
  $problem=$row2[17];

  if($row2[21]=='site')
  $sitestatus='Warranty';
  else if($row2[21]=='amc')
  $sitestatus='AMC';
  else
  $sitestatus='PCB';

  if($row2[17]=='new')
  $calltype='Installation';
  else if($row2[17]=='new temp' || $row2[17]=='service' )
  $calltype='Service';
  else if($row2[17]=='temp_pm' || $row2[17]=='pm' )
  $calltype='PM';
  else if($row2[17]=='dere' || $row2[17]=='temp_dere' )
  $calltype='DERE';

	$cl=mysqli_query($conapp,"select cust_id,cust_name from customer where cust_id='".$row2[1]."' ");
        $clro=mysqli_fetch_array($cl);
        
	 
	 if($row2[15]!='Done')
	 $engstat="Pending";
	 else
	 $engstat="Done";

	 $str[]=array( 'compid' => $row2[25],'atmid'=>$atmid,'address'=>$row2[5],'callid'=>$row2[0],'engid'=>$row[0],'engstat'=>$engstat,'contactperson'=>$row2[12],'phone'=>$row2[13],'bank'=>$row2[3],'problem'=>$problem,'eta'=>$row2[31],'customerName'=>$clro[1], 'siteStatus'=>$sitestatus,'callType'=>$calltype);
	 
	 echo json_encode($str);
	 
	 }
	else
	{
	$str=-1;
	echo json_encode($str);
	}
}else
{
    	$str=-1;
	echo json_encode($str);
}

    mysqli_close($con);	
    mysqli_close($con2);
?>