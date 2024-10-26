<?php
// include('config.php');
include('db_connection.php');
$con1 = OpenCon1();

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
 $contents.="Sr. No.\t Complaint ID\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t Address\t Branch\t Problem\t Alert Date\t Delegation time\t Engineer Name\t Engr Mobile\t Call Type\t Customer Status\t Last FeedBack\t  Last update Time\t Location\t  Close Status\t Engr first Response\t ETA \t Reached at Site\t  Left The site\t";
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;


	if(($row[17]=='service' || $row[17]=='pm' || $row[17]=='dere') &&  $row[21] ==  'amc')
        $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	if(($row[17]=='new' || $row[17]=='service' || $row[17]=='pm' || $row[17]=='dere') &&  $row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	if(mysqli_num_rows($atm)==0)
	$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	}

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC"); //taking time
	$row1=mysqli_fetch_row($tab);

    $oldeng=mysqli_query($con1,"select engineer,date from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1");
        $getold=mysqli_fetch_row($oldeng);
      //  $getold[0]=1;
	$engr=mysqli_query($con1,"select engg_name, phone_no1 from area_engg where engg_id='".$getold[0]."'");
	$engro=mysqli_fetch_row($engr);
	
	 $contents.="\n".$cnt."\t";
	 $contents.=$row[25]."\t";
	 $contents.=$custrow[0]."\t";
if($row[17]=='temp_pm' || $row[17]=='new temp' || $row[17]=='temp_dere')
	{
	 $contents.=clean(trim($row[2]))."\t";
	 
	 } 
	 else
	  {  
         $atmrow=mysqli_fetch_row($atm);

   	 $contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $atmrow[0]))."\t";
 
         }
	
	 $contents.=clean(trim($row[3]))."\t";
	 $contents.=clean(trim(addslashes($row[5])))."\t";
	
    $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
        $contents.=$branchro[0]."\t";
	
     $contents.=clean($row[9])."\t";
     $contents.= $row[10]."\t"; 
     
//==========Delegation time====
  $contents.=$getold[1]."\t";

//=======Engineer Name ======
     
  //  $contents.=trim($engro[0])." (". $engro[1].")"."\t";
    $contents.=trim($engro[0])."\t";
    $contents.=trim($engro[1])."\t";

//=======Call Type ======
if($row[17]=='service' or $row[17]=='new temp') { $call = "Service";}
if($row[17]=='pm' or $row[17]=='temp_pm') { $call = "PM Call";}
if($row[17]=='dere' or $row[17]=='temp_dere') { $call = "De-Re Call";}
if($row[17]=='new') { $call = "inst Call";}
$contents.=$call."\t";
//===== Customer Status ===========    
    if(0 === strpos($row[2], 'temp'))
    {
  
$atm=mysqli_query($con1,"select type from tempsites where atmid='".$row[2]."' and custid='".$row[1]."'");
        $ress=mysqli_fetch_row($atm);
        if( $ress[0]!='' && $ress[0]=="addon")$contents.="ADDON"."\t";
        else
	$contents.="PCB"."\t";
       
	}
	else
 	if($row[21]=='' || $row[21]=='site'){ $contents.="Under Warranty"."\t"; }
 	
 	else if($row[21]=='amc'){ $contents.="AMC"."\t"; }else{ $contents.="PCB"."\t"; }
//========Last FeedBack ========	
   
	$al=mysqli_query($con1,"select id,feedback, feed_date,fromplace from eng_feedback where alert_id='".$row[0]."' order by id DESC ");
	$alro=mysqli_fetch_row($al);
 	if(mysqli_num_rows($al)>0){
 	    $engf=clean(preg_replace('/\s+/', ' ', $alro[1]));
    	$engf=str_replace("\n"," ",$engf);
    	$contents.=$engf;
 	}
//  	$engf=clean(preg_replace('/\s+/', ' ', $alro[1]));
// 	$engf=str_replace("\n"," ",$engf);
// 	$contents.=$engf;
 	
 $contents.="\t";
 
 //============Last update Time =============
$contents.= date('d/m/Y H:i:s',strtotime($alro[2]))."\t";

//===========Location=========
	$contents.=$alro[3]."\t";

//=========================000000
if($row[15]=='Done' or $row[16]=='Done'){ $stau="Closed";}
else if($row[15]=='onhold'){  $stau="On Hold";}
else if($row[15]=='Rejected'){  $stau="Rejected";}
else {  $stau="Still Open";}

$contents.=$stau. "\t";
$qrytime=mysqli_query($con1,"select feed_date from eng_feedback where `alert_id`='".$row[0]."' order by id ASC LIMIT 1");

$qrytime1=mysqli_fetch_row($qrytime);
$contents.=$qrytime1[0]."\t";

$contents.=$row[31]."\t";
$contents.=$row[24]."\t";
$contents.=$row[18]."\t";


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

<?php CloseCon($con1); ?>
