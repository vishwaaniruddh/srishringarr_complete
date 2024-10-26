<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme.' limit 1000';
//echo $sqlme;

$table=mysqli_query($con1,$sqlme);
//echo mysqli_num_rows($table);

$contents='';
 $contents.="Sr. No.\t Complaint ID\t Client Name\t Site/Sol/ATM ID\t End User\t Address\t Branch\t Alert Date\t Engineer Name\t Response Time\t Resolution Time\t Last FeedBack\t UPS Model\t UPS Cap\t UPS Qty\t UPS S.No\tBattery Detail\t Batt Qty\t Input L-N \t Input L-E \t Input N-E\t Output L-N\t Output L-E\t  Output N-E\t  Charger Voltage\t  Output Load Amp\t ";


// echo $contents;

 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

//=======ATM ID====
if ($row[21] ==  'amc' || $row[21] ==  'AMC')
{
$atmid=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	//echo "select cat,atmid from Amc where amcid='".$row[2]."'";
}
elseif ($row[21] == 'site')
{
$atmid=mysqli_query($con1,"select atm_id from `atm` where `track_id`='".$row[2]."'");
//echo "select * from `atm` where `track_id`='".$row[2]."'";
	}
$atmid1=mysqli_fetch_row($atmid);
if ($atmid1[0]=='') $atmid1[0]= $row[2];

//=========Cust========

$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
//======Feed back===========

$tab=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC LIMIT 1"); //taking time
	$row1=mysqli_fetch_row($tab);

//echo "select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$row[0]."')<br>";
//==========Engineer Name=======
$oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1");
        $getold=mysqli_fetch_row($oldeng);
      //  $getold[0]=1;

$engr=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$getold[0]."'");
	$engro=mysqli_fetch_row($engr);
//=======FSR Data================
$fsrqry= mysqli_query($con1,"select * from FSR_details where alertid='".$row[0]."'");
$fsr=mysqli_fetch_row($fsrqry);

	 $contents.="\n".$cnt."\t";
	 $contents.=$row[25]."\t";
	 $contents.=$custrow[0]."\t";

     
     $contents.=$atmid1[0]."\t";  // ATM ID
   	 
	 $contents.=trim(preg_replace('/\s+/', ' ', $row[3]))."\t";
	 $contents.=trim(preg_replace('/\s+/', ' ', addslashes($row[5])))."\t";//Add

//=========Branch===	
 $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
    $contents.=$branchro[0]."\t";
	
     $contents.= date('d/m/Y H:i:s',strtotime($row[10])); 
     $contents.="\t";

//=======Engineer Name ======
     $contents.=$engro[0]."\t";

//=======Response Time====== 
 if($row[24]!='0000-00-00 00:00:00')
 	$contents.=date('d/m/Y H:i:s',strtotime($row[24]));
 
 	$contents.="\t";
 
//========Call close Time========
	$contents.=$row[18]."\t";
//========Last FeedBack ========	
 	if($row1[0]!=''){  
	$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row1[0])); 
 	}else{ 
	$al=mysqli_query($con1,"select max(id),feedback from eng_feedback where alert_id='".$row[0]."'");
	$alro=mysqli_fetch_row($al);
 	$engf=preg_replace('/\s+/', ' ', $alro[1]);
	//$engf=str_replace("\n"," ",$alro[1]);
	$contents.=$engf;
 	}
 $contents.="\t";
 
//==== FSR Data=====
    $contents.=$fsr[3]."\t";
    $contents.=$fsr[4]."\t";
    $contents.=$fsr[5]."\t";
    $contents.=$fsr[6]."\t";
    $contents.=$fsr[7]."\t";
    $contents.=$fsr[8]."\t";
    $contents.=$fsr[10]."\t";
    $contents.=$fsr[11]."\t";
    $contents.=$fsr[12]."\t";
    $contents.=$fsr[13]."\t";
    $contents.=$fsr[14]."\t";
    $contents.=$fsr[15]."\t";
    $contents.=$fsr[16]." Volts"."\t";
    $contents.=$fsr[17]." Amps"."\t";


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