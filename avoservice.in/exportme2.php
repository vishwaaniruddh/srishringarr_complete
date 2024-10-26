<?php
include('config.php');
$sqlme=$_POST['qr'];
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);

$contents='';
 $contents.="Complain ID \t Client Docket Number \t Name \t ATM \t Bank \t City \t Area \t Address \t State \t Problem \t Alert Date \t Contact Person \t Phone \t Engineer Name\t Customer Status \t Call close time \t Engineer Last FeedBack \t Engineers FeedBack \t Status \t ";
while($row=mysqli_fetch_row($table))
{
if($row[2]!='temp_'){
	if($row[17]=='service' &&  $row[21] ==  'amc')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if($row[17]=='service' &&  $row[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysqli_fetch_row($tab);
	//echo "select engg_name from area_engg where engg_id=select engineer from alert_delegation where alert_id='".$row[0]."'";
	$engr=mysqli_query($con1,"select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$row[0]."')");
	$engro=mysqli_fetch_row($engr);
	 $contents.="\n".$row[25]."\t";
	 $contents.=$row[30]."\t";
	 $contents.=$custrow[0]."\t";
	if($row[17]=='new' || $row[17]=='new temp')
	{
	$contents.=$row[2]."\t";
	 //echo $row[2];
	 } 
	 else
	  {  
   $atmrow=mysqli_fetch_row($atm);
   	$contents.=$atmrow[0]."\t";
    //echo $atmrow[0]; 
    }
	// print $contents;
	 $contents.=$row[3]."\t";
	 //$contents.=$row[27]."\t";
	 $contents.=$row[6]."\t";
$contents.=preg_replace('/\s+/', ' ', $row[4])."\t";
	// $contents.=$row[4]."\t";
$contents.=preg_replace('/\s+/', ' ', $row[5])."\t";
	// $contents.=$row[5]."\t";
	 
	  $contents.=$row[27]."\t";
	   if($row[28]=='1')
 {

 $buy=mysqli_query($con1,"select * from buyback where alertid='".$row[0]."'");
 $buyro=mysqli_fetch_row($buy);

 $contents.=$buyro[2]."\t";
 }
 
 
$contents.=preg_replace('/\s+/', ' ', $row[9])."\t";


if($row[17]=='service' || $row[17]=='new temp')
{
 $contents.= date('d/m/Y h:i:s a',strtotime($row[10])); 
} 
  else
  { 
  if(isset($row[11]) and $row[11]!='0000-00-00') 
  $contents.= date('d/m/Y h:i:s a',strtotime($row[11]));
   }
   $contents.="\t";
   $contents.=$row[12]."\t";
    $contents.=$row[13]."\t";
    $contents.=$engro[0]."\t";
    
    if(0 === strpos($row[2], 'temp'))
	$contents.="PCB"."\t";
	else
 if($row[21]=='' || $row[21]=='site'){ $contents.="Under Warranty"."\t"; }else if($row[21]=='amc'){ $contents.="AMC"."\t"; }else{ $contents.="PCB"."\t"; }
    /*if($row[21]=='')
    {
     $contents.="Payable"."\t";
    }
   else if($row[21]=='site')
    {
     $contents.="Under Warranty"."\t";
    }
   else
    {
     $contents.="AMC"."\t";
    }*/
$contents.=$row[18]."\t";
 if($row1[0]!='')
 {  $contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row1[0])); }else
 { 
$al=mysqli_query($con1,"select max(id),feedback from eng_feedback where alert_id='".$row[0]."'");
$alro=mysqli_fetch_row($al);
 $engf=preg_replace('/\s+/', ' ', $alro[1]);
$engf=str_replace("\n"," ",$alro[1]);
$contents.=$engf;
 }
 $contents.="\t";
$a2=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id ASC ");
while($alro2=mysqli_fetch_row($a2))
{
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro2[0])).",";
}
$contents.="\t";

//$contents.=$row[15];
$a3=mysqli_query($con1,"select up from alert_updates where alert_id='".$row[0]."' order by id ASC ");
while($alro3=mysqli_fetch_row($a3))
{
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro3[0])).",";
}
 //$contents.="\n";
}
 } 
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>