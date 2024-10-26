<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysql_query($sqlme);

$contents='';
 $contents.="Complain ID\t Client Docket Number\t Name\t ATM\t Bank\t City\t Address\t Branch\t Problem \t Alert Date\t Call Type\t Call Close\t Contact Person\t Phone\t Delegated To\t Engg Number\t Customer Status\t ETA\t Remarks Update\t";
 
 
 
while($row=mysql_fetch_row($table))
{



if(($row[17]=='service' || $row[17]=='pm' || $row[17]=='dere')&&  $row[21] ==  'amc')
        $atm=mysql_query("select atmid from Amc where amcid='".$row[2]."'");

//echo "select atmid from Amc where amcid='".$row[2]."'";


	if(($row[17]=='service' || $row[17]=='pm' || $row[17]=='dere') &&  $row[21] == 'site')
	$atm=mysql_query("select atm_id from atm where track_id='".$row[2]."'");

//echo "select atm_id from atm where track_id='".$row[2]."'";
	
	$tab=mysql_query("select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysql_fetch_row($tab);
	//echo "eng stat".$row[15];
		

$qry=mysql_query("select cust_name from customer where cust_id='".$row[1]."'");
 $custrow=mysql_fetch_row($qry);



//======Complian ID========
$contents.="\n".$row[25];
//======Client Docket Number========
$contents.="\t".$row[30];
//======Name========
$contents.="\t".$custrow[0];
//======Atm ========
if($row[17]=='new' || $row[17]=='new temp' || $row[17]=='temp_pm'){ $contents.="\t".$row[2]; } else {  
  $atmrow=mysql_fetch_row($atm);

$contents.="\t".$atmrow[0];
//echo "atm :".$atmrow[0];



}   
//======Bank========   
$contents.="\t".$row[3];

//======city========
$contents.="\t".$row[6];
//======Address========
$contents.="\t".preg_replace('/\s+/', ' ', $row[5]);
//======Branch========
$branch=mysql_query("select name from avo_branch where id='".$row[7]."'");
    $branchro=mysql_fetch_row($branch);    
        $contents.="\t".$branchro[0];

//$contents.="\t".str_replace("\n","",preg_replace('/\s+/', '', $row[7]));
//======problem========
$contents.="\t".str_replace("\n","",preg_replace('/\s+/', '', $row[9]));
//==============
if($row[28]=='1')
 {
 //echo "select desc from buyback where alertid='".$row[0]."'";
 $buy=mysql_query("select * from buyback where alertid='".$row[0]."'");
 $buyro=mysql_fetch_row($buy);
"<br><b>Buy Back :</b>".$contents.="\t".$buyro[2]."<br>";
 
 } 
//======Alert Date========
if($row[17]=='service' || $row[17]=='new temp'){ $date1=date('d/m/Y h:i:s a',strtotime($row[10])); 
$contents.="\t".$date1;
 } else{ if(isset($row[11]) and $row[11]!='0000-00-00') $date2=date('d/m/Y h:i:s a',strtotime($row[11])); $contents.="\t".$date2;}
 
 // Call Type===========
 
if($row[17]=='service' || $row[17]=='new temp'){$contents.="\t"."Service Call";}
if($row[17]=='new'){$contents.="\t"."Installation Call";} 
if($row[17]=='dere' || $row[17]=='temp_dere'){$contents.="\t"."Re-Installation";}
if($row[17]=='pm' || $row[17]=='temp_pm'){$contents.="\t"."PM Call";}

//======Call close========
if ($row[15]=='done'or $row[16]=='done'){$contents.="\t"."Call closed";} else if($row[16]=='Rejected'){$contents.="\t"."Rejected by AVO";}else {$contents.="\t"."Call still active";}
//if($row[18]!='0000-00-00 00:00:00'){ $date3=date('d/m/Y h:i:s a',strtotime($row[18])); $contents.="\t".$date3; } else{ $contents.="\t"."Call still Active"; }
//======Remarks
//if ($row[16]=='Rejected'){$contents.="\t"."Rejected by AVO";} else {
//======Contact Person========
$contents.="\t".$row[12];
//======Phone========
$contents.="\t".$row[13];
//======Delegate to======== 
$oldeng=mysql_query("select engineer from alert_delegation where alert_id='".$row[0]."'");
$getold=mysql_fetch_row($oldeng);
$fetchengid=mysql_query("Select engg_name,phone_no1 from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysql_fetch_row($fetchengid);
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
 
//========Last FeedBack ========	
 	if($row1[0]!=''){  
	$contents.="\t".str_replace("\n","  ",preg_replace('/\s+/', ' ', $row1[0])); 
 	}else{ 
	$al=mysql_query("select max(id),feedback from eng_feedback where alert_id='".$row[0]."'");
	$alro=mysql_fetch_row($al);
 	$engf=preg_replace('/\s+/', ' ', $alro[1]);
	//$engf=str_replace("\n"," ",$alro[1]);
	$contents.="\t".$engf;
 	}
 $contents.="\t";

}
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
 
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
?>