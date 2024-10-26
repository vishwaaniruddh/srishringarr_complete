<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="Complain ID \t Client Docket Number \t Name \t ATM \t Bank \t City \t Area \t Address \t State  \t Problem \t Alert Date \t Call Close \t Remark\t Contact Person \t Phone \t Delegated To \t Engg Number\t Customer Status \t ETA \t Remarks Update \t";
 
 
 
while($row=mysqli_fetch_row($table))
{



if(($row[17]=='service' || $row[17]=='pm' || $row[17]=='dere')&&  $row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");

//echo "select atmid from Amc where amcid='".$row[2]."'";


	if(($row[17]=='service' || $row[17]=='pm' || $row[17]=='dere') &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");

//echo "select atm_id from atm where track_id='".$row[2]."'";
	
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysqli_fetch_row($tab);
	//echo "eng stat".$row[15];
		

$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
 $custrow=mysqli_fetch_row($qry);



//======Complian ID========
$contents.="\n".$row[25];
//======Client Docket Number========
$contents.="\t".$row[30];
//======Name========
$contents.="\t".$custrow[0];
//======Atm ========
if($row[17]=='new' || $row[17]=='new temp' || $row[17]=='temp_pm'){ $contents.="\t".$row[2]; } else {  
  $atmrow=mysqli_fetch_row($atm);

$contents.="\t".$atmrow[0];
//echo "atm :".$atmrow[0];



}   
//======Bank========   
$contents.="\t".$row[3];

//======city========
$contents.="\t".$row[6];
//======Address========
$contents.="\t".$row[4];
//======State========
$contents.="\t".$row[5];
//======problem========
$contents.="\t".$row[27];
//======alert date========
if($row[28]=='1')
 {
 //echo "select desc from buyback where alertid='".$row[0]."'";
 $buy=mysqli_query($con1,"select * from buyback where alertid='".$row[0]."'");
 $buyro=mysqli_fetch_row($buy);
"<br><b>Buy Back :</b>".$contents.="\t".$buyro[2]."<br>";
 
 } 
$contents.="\t".$row[9];
//======call close========
if($row[17]=='service' || $row[17]=='new temp'){ $date1=date('d/m/Y h:i:s a',strtotime($row[10])); 
$contents.="\t".$date1;
 } else{ if(isset($row[11]) and $row[11]!='0000-00-00') $date2=date('d/m/Y h:i:s a',strtotime($row[11])); $contents.="\t".$date2;}

//======Remarks========
if($row[18]!='0000-00-00 00:00:00'){ $date3=date('d/m/Y h:i:s a',strtotime($row[18])); $contents.="\t".$date3; } else{ $contents.="\t"."Call still Active"; }
//======Remarks
$contents.="\t"."";
//======Contact Person========
$contents.="\t".$row[12];
//======Phone========
$contents.="\t".$row[13];
//======Delegate to======== 
$oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."'");
$getold=mysqli_fetch_row($oldeng);
$fetchengid=mysqli_query($con1,"Select engg_name,phone_no1 from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);
$contents.="\t".$getoldname[0];

//======engg number========
$contents.="\t".$getoldname[1];
//======Contact statue========
if(0 === strpos($row[2], 'temp'))
	$contents.="\t"."PCB";
	else
 if($row[21]=='' || $row[21]=='site'){ $contents.="\t"."Under Warrenty"; }else if($row[21]=='amc'){ $contents.="\t"."AMC"; }else{ $contents.="\t"."PCB"; }
  

//===========ETA===
$contents.="\t".$row[31]; 
 
//===============Remarks Update========
if($row1[0]!=''){
//echo "select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC";

if(mysqli_num_rows($tab)>0){




$dt=date('d/m/Y h:i:s a',strtotime($row1[2]))."<br>".wordwrap($row1[0],10,"<br />\n",TRUE); 
$contents.="\t".$dt;
}
else
$contents.="\t"."No Updates so far";


 



//$contents.="\t".$fetchpo[0]; 



   
//if($row1[0]!=''){
//echo "select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC";

if(mysqli_num_rows($tab)>0){




 date('d/m/Y h:i:s a',strtotime($contents.="\t".$row1[2]))."<br>".wordwrap($contents.="\t".$row1[0],10,"<br />\n",TRUE); 

}
else
echo "No Updates so far";


 



$contents.="\t".$fetchpo[0]; 
}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=view_alert.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>