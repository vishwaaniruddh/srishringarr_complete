<?php
include("config.php");
$dt=date('Y-m-d H:i:s');
$eml=array();
//echo "select distinct(escalateto) from escalation where endtime<='".$dt."'";
$em=mysqli_query($con1,"select distinct(escalateto) from escalation where endtime<='".$dt."'");
while($emro=mysqli_fetch_array($em))
$eml[]=$emro[0];



for($i=0;$i<count($eml);$i++)
{


//echo "select * from escalation where escalateto='".$eml[$i]."'<br> ";

$esc=mysqli_query($con1,"select * from escalation where escalateto='".$eml[$i]."' ");
if(mysqli_num_rows($esc)>0){
$tbl='';
$cnt=0;
$tbl="<table border='1'><tr><th>Sr No</th><th>Complain ID</th><th>ATM ID</th><th>Call Logged Datetime</th><th>State</th><th>Address</th><th>Status</th></tr>";
while($escro=mysqli_fetch_array($esc))
{
$cnt=$cnt+1;
//echo "<br>select createdby,state from alert where alert_id='".$escro[1]."'<br>";
//echo "select email from esclatingpeople where level='".$escro[6]."' and state like '%".$alertro[1]."%' and status=0<br>";
$alert=mysqli_query($con1,"select createdby,state,assetstatus,atm_id,entry_date,address from alert where alert_id='".$escro[1]."'");
$alertro=mysqli_fetch_row($alert);
$atm='';
if($alertro[2]=='amc'){
$at=mysqli_query($con1,"select atmid from Amc where amcid='".$alertro[3]."'");
$atro=mysqli_fetch_row($at);
$atm=$atro[0];
}
elseif($alertro[2]=='site'){
$at=mysqli_query($con1,"select atm_id from atm where track_id='".$alertro[3]."'");
$atro=mysqli_fetch_row($at);
$atm=$atro[0];
}
else{
$att=explode("_",$alertro[3]);
$atm=$att[1];
}

$mailto=$pplro[0];
$tbl.="<tr><td>".$cnt."</td><td>".$alertro[0]."</td><td>".$atm."</td><td>".date('d/m/Y h:i:s a',strtotime($alertro[4]))."</td><td>".$alertro[1]."</td><td>".$alertro[5]."</td><td>";
$msg='';
if($escro[5]==0)
{
$msg.="Waiting for Delegation";

}//end of status=0
elseif($escro[5]==1)
{
$msg.="Waiting for Update";
}//end of status=1
elseif($escro[5]==2)
{
$msg.="Waiting for Engineer to close";
}//end of status=2
elseif($escro[5]==3)
{
$msg.="Waiting for Branch Manager for Final Close";
}//end of status=3
$tbl.=$msg."</td></tr>";

$st='';
			if($escro[5]==0)
			$st=", endtime=DATE_ADD('$dt', INTERVAL 15 MINUTE)";
			else
			$st=", endtime=DATE_ADD('$dt', INTERVAL 4 HOUR)";
			
		$escpple=mysqli_query($con1,"select email,level from esclatingpeople where level>'".$escro[6]."' and state like '%".$alertro[1]."%' and status=0 order by id ASC");
$pplro=mysqli_fetch_row($escpple);	
			
	$upd=mysqli_query($con1,"update escalation set level='$pplro[1]',escalateto='$pplro[0]' $st where id='".$escro[0]."'");	
	//echo "update escalation set level='$pplro[1]',escalateto='$pplro[0]' $st where id='".$escro[0]."'";	
//echo "<br>";


}
$tbl.="</table>";
//echo $tbl."<br>";

$mailto=$eml[$i];
$subject="Escalation From AVO Electro Power Limited";
//echo "<br>";
$message=$tbl;
$headers = "From: <Switching AVO Electro Power Limited>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl;
			$message=$tbl;
			
			mail($mailto, $subject, $message, $headers);
			






}//end if
}//end for loop

/*

$escpple=mysqli_query($con1,"select email from esclatingpeople where level='".$escro[6]."' and state like '%".$alertro[1]."%' and status=0");
if(mysqli_num_rows($escpple)>0){
$alert=mysqli_query($con1,"select createdby,state from alert where alert_id='".$escro[1]."'");
$alertro=mysqli_fetch_row($alert);
$pplro=mysqli_fetch_row($escpple);
$mailto=$pplro[0];
$msg="Complain ID ".$alertro[0];
if($escro[7]==0)
{
$msg.=" waiting for Delegation";

}//end of status=0
elseif($escro[7]==1)
{
$msg.=" waiting for Update";
}//end of status=1
elseif($escro[7]==2)
{
$msg.=" waiting for Engineer to close";
}//end of status=2
elseif($escro[7]==3)
{
$msg.=" waiting for Branch Manager for Final Close";
}//end of status=3
echo $msg;
echo $email;

$subject="Escalation for Complain ID ".$alertro[0];
//echo "<br>";

$headers = "From: <Switching AVO Electro Power Limited>\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			//$headers .= "Cc: ".$this->ccm."\r\n";
			//echo $tbl;
			$message=$msg;
			
			mail($mailto, $subject, $message, $headers);
			$st='';
			if($escro[7]==0)
			$st=", endtime=DATE_ADD('$dt', INTERVAL 15 MINUTE)";
			else
			$st=", endtime=DATE_ADD('$dt', INTERVAL 4 HOUR)";
	$upd=mysqli_query($con1,"update escalation set level=level+1 $st where id='".$escro[0]."'");	
	echo "update escalation set level=level+1 $st where id='".$escro[0]."'";	
echo "<br>";
}

*/
?>