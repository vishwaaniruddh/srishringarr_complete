<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme;//.' limit 400';
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);
//echo mysqli_num_rows($table);

$contents='';
 $contents.="Sr. No.\t Complaint ID\t Call Request Type\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t City\t Area\t Address\t State\t Branch\t Problem\t Alert Date\t Contact Person\t Phone\t Engineer Name\t Call Type\t Customer Status\t Response Time\t Call close time\t Last FeedBack\t Engineers FeedBack\t  Approved By\t Approval Remarks\t Tempcall Reason\t Tempcall Remarks\t ";
// echo $contents;
 $cnt=0;
 
while($row=mysqli_fetch_row($table))
{
$cnt++;

	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
       
	
	
	if (mysqli_num_rows($atm)>0)
	{
	$atmrow=mysqli_fetch_row($atm);
	$atmid= $atmrow[0];
	} 
	else { $atmid= $row[2]; }

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC"); //taking time
	$row1=mysqli_fetch_row($tab);
//echo "select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$row[0]."')<br>";
        $oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC limit 1");
        $getold=mysqli_fetch_row($oldeng);
      //  $getold[0]=1;
	$engr=mysqli_query($con1,"select engg_name, phone_no1 from area_engg where engg_id='".$getold[0]."'");
	$engro=mysqli_fetch_row($engr);
	
	//===========
	
	 $contents.="\n".$cnt."\t";
	 $contents.=$row[25]."\t";
	 $contents.=$row[30]."\t";
	 $contents.=$custrow[0]."\t";

       $contents.=$row[2]."\t";
   	  //$contents.=$atmid."\t";   // ATM ID
   	 
	
	 $contents.=trim(preg_replace('/\s+/', ' ', $row[3]))."\t";// End User
	 $contents.=trim(str_replace("\n","",preg_replace('/\s+/', '', $row[6])))."\t";
	 $contents.=trim(preg_replace('/\s+/', ' ', addslashes($row[4])))."\t";
     $contents.=trim(preg_replace('/\s+/', ' ', addslashes($row[5])))."\t";
	
	 $contents.=$row[27]."\t";  // State
 
 $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
        $contents.=$branchro[0]."\t"; // Branch
	
     $contents.=preg_replace('/\s+/', ' ', $row[9])."\t";
     $contents.= date('d/m/Y H:i:s',strtotime($row[10])); //Alert Date
     $contents.="\t";
//======= Contact Person  ======
     $contents.=trim(preg_replace('/\s+/', ' ', $row[12]))."\t";
//======= Phone ======
     $contents.=trim(preg_replace('/\s+/', ' ', $row[13]))."\t";
//=======Engineer Name ======
     $contents.=trim($engro[0])." (". $engro[1].")"."\t";
//=======Call Type ======
     
     if($row[17]=='new temp') $contents.="Service"."\t";
     if($row[17]=='temp_dere') $contents.="Reinstall"."\t";
     if($row[17]=='temp_pm') $contents.="PM Call"."\t";
     
    //===== Customer Status ===========    
    if(0 === strpos($row[2], 'temp'))  
    {
  
$atm=mysqli_query($con1,"select type from tempsites where atmid='".$row[2]."' and custid='".$row[1]."'");
        $ress=mysqli_fetch_row($atm);
        if($ress[0]=="addon")$contents.="ADDON"."\t";
        elseif ($ress[0]=="U/W issue")$contents.="U/W issue"."\t";
        elseif ($ress[0]=="pcb")$contents.="Chargeable"."\t"; 
        elseif ($ress[0]=="amc")$contents.="AMC Not Find"."\t";
        else
	$contents.="PCB"."\t";
       
	}
	else
 	if($row[21]=='' || $row[21]=='site'){ $contents.="Under Warranty"."\t"; }
 	
 	else if($row[21]=='amc'){ $contents.="AMC"."\t"; }else{ $contents.="PCB"."\t"; }

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
 //=======Engineers FeedBack  ============
 $fdate;
 
$a2=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$row[0]."' order by id ASC ");
while($alro2=mysqli_fetch_row($a2))
{
	$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $alro2[0])).",";
$fdate=$alro2[1];
}
	$contents.="\t";


$contents.=trim(preg_replace('/\s+/', ' ', $row[22]))."\t";
$contents.=trim(preg_replace('/\s+/', ' ', $row[23]))."\t";


$db=mysqli_query($con1,"select * from tempcall_status1 where alert_id='".$row[0]."' ");
$erow=mysqli_fetch_row($db);
$contents.=trim(preg_replace('/\s+/', ' ', $erow[2]))."\t"; 
$contents.=trim(preg_replace('/\s+/', ' ', $erow[3]))."\t"; 
  
} 

$contents = strip_tags($contents); 


   header("Content-Disposition: attachment; filename=mis.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
 
?>