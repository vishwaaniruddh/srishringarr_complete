<?php
                         
 //  REJECT CALL CODE  //
 //********************************************//
include('db_conn.php');   

   $reason = urldecode($_POST['post_reject_reason']);
   $compid = $_POST['post_compid'];
   $engid  = $_POST['post_engid'];
   $uptime = $_POST['post_reject_time'];

  $response["result"] = array();  
	
	//echo $qry;
	$resultx=mysqli_query($conapp,"select alert_id, call_status, status from alert where createdby='".$compid."'");
	if(mysqli_num_rows($resultx)>0)
	  {
	$rowx=mysqli_fetch_row($resultx);

	$resulteng=mysqli_query($conapp,"select engg_id from area_engg where loginid='".$engid."'");
	$roweng=mysqli_fetch_row($resulteng);
	
	$result1=mysqli_query($conapp,"select id from alert_delegation where alert_id='".$rowx[0]."' and engineer='".$roweng[0]."'");
	
	if(mysqli_num_rows($result1)>0) {
	$row1=mysqli_fetch_row($result1);
	$result2=mysqli_query($conapp,"update alert_delegation set status=2 where id='".$row1[0]."'");
if($rowx[1] !='Done' && $rowx[1] !='Rejected' && $rowx[2] !='Done'){

	$result3=mysqli_query($conapp,"update alert set status='Pending', call_status='Pending' where alert_id='".$rowx[0]."'");
}
	$result4=mysqli_query($conapp,"insert into rejectedcalls(alertid,reason,engid,rdate) values('".$rowx[0]."','".$reason."','".$roweng[0]."','".$uptime."')");
	
	$result5=mysqli_query($conapp,"insert into eng_feedback(alert_id,feedback,engineer,feed_date) values('".$rowx[0]."','".$reason."','".$engid."','".$uptime."')");    
	} else {
	    
	 $result4=mysqli_query($conapp,"insert into rejectedcalls(alertid,reason,engid,rdate) values('".$rowx[0]."','".$reason."','".$roweng[0]."','".$uptime."')");
	 $result5=mysqli_query($conapp,"insert into eng_feedback(alert_id,feedback,engineer,feed_date) values('".$rowx[0]."','".$reason."','".$engid."','".$uptime."')");  
	 }

	if($result4)
	{
	    $response["result"] = "1";
	}
	else
	{
	        $response["result"] = "0";	

	}
	  }
	else
	        $response["result"] = "0";	
	echo json_encode($response);
?>