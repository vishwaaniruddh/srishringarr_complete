<?php
include('config.php');
//$i=0;
//$qry=mysqli_query($con1,"select * from `alert` where `responsetime`='0000-00-00 00:00:00' and `status`='Done' and `call_status`='Done' ");

//while($row=mysqli_fetch_array($qry)){

	//echo $row['alert_id'];
	//echo "<br>";
	
	//if(mysqli_num_rows($qry)>0){
	        // echo "Select * from alert where `status`='Done'and `call_status`='Done' and ((alert_id not IN (select `alert_id` from alert_updates) and alert_id not IN (select `alert_id` from eng_feedback)) )";
	        // echo "<br>";
	   	//$qry2=mysqli_query($con1,"Select * from alert where `status`='Done'and `call_status`='Done' and ((alert_id not IN (select `alert_id` from alert_updates) and alert_id not IN (select `alert_id` from eng_feedback)) )");
	   	while($row2=mysqli_fetch_array($qry2)){
	   	       echo $row2['alert_id']."<br>";
	   		//echo "SELECT * FROM `alert_redelegation` WHERE `alert_id`='".$row2['alert_id']."'<br>";
	   		//$fedd_match_qry=mysqli_query($con1,"SELECT * FROM `alert_redelegation` WHERE `alert_id`='".$row2['alert_id']."'");
			//$fedd_match_qry1=mysqli_fetch_row($fedd_match_qry);
			
			if(mysqli_num_rows($fedd_match_qry)>0){
				
				
			}else{
				
				
				//echo "select `engg_name` from `area_engg` where `engg_id`='".$fedd_match_qry1[1]."' limit '10' <br>";
				//$engg_name=mysqli_query($con1,"select `engg_name` from `area_engg` where `engg_id`='".$fedd_match_qry1[1]."' limit '10' ");
				//$engg_name1=mysqli_fetch_row($engg_name);
				//echo $engg_name1[0];
				//echo "<br>";
				
			}
		}
	//}
	
	
//$i++;
//}
//echo "<br/>Total=".$i;
?>