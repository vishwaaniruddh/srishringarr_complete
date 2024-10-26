<?php
 include('config.php');

function get_engg($engg_id) {
  
  global $con1;
  $engr=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engg_id."'");
	
	$engro=mysqli_fetch_row($engr);

   return $engro[0]; 
}


$sqlme= "Select a.*, b.eng_old,b.eng_new from alert a, alert_redelegation b where a.alert_id=b.alert_id and date(a.entry_date) between '2024-04-01' and '2024-04-30' and b.eng_old=672 ";


$table=mysqli_query($con1,$sqlme);


function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}

$contents='';
 $contents.="Sr. No.\t Complaint ID\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t City\t Area\t Address\t State\t Branch\t Problem\t Alert Date\t First Delegated Engr\t Call Attended Engr\t Call Type\t Customer Status\t Call close time\t"; 

 $cnt=0;
 
while($row=mysqli_fetch_array($table))
{
    

$cnt++;

	if($row[21] ==  'amc') {
        $atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
        $atmrow=mysqli_fetch_row($atm);
        $atm_id = $atmrow[0];
        
	} elseif($row[21] == 'site')	
        {
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	$atmrow=mysqli_fetch_row($atm);
	$atm_id = $atmrow[0];
		} 
		
		else {
		     $atm_id=$row[2];
		}


//echo "select cust_name from customer where cust_id='".$row[1]."'";
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);

      
	 $contents.="\n".$cnt."\t";
	 $contents.=$row[25]."\t";
	// $contents.=$row[30]."\t";
	 $contents.=$custrow[0]."\t";

	 $contents.=clean(trim($atm_id))."\t";
//	 $contents.=trim($atm_id)."\t";
	 
	
	 $contents.=trim($row[3])."\t";
	 $contents.=trim($row[6])."\t";
	 $contents.=trim($row[4])."\t";
     $contents.=clean(trim(addslashes($row[5])))."\t";
   //  $contents.=trim(addslashes($row[5]))."\t";
     
	$contents.=trim($row[27])."\t";
    $branch=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
    $branchro=mysqli_fetch_row($branch);    
        $contents.=$branchro[0]."\t";
	
     $contents.=clean($row[9])."\t"; //==== Problem
  
     $contents.= $row[10]; //=====Entry Date
     $contents.="\t";

//=======First Dele Engineer Name ======
    $contents.=get_engg($row[46])."\t";
   //  $contents.= $row[46]."\t";
    
  //========Call complete engr=======
   $delqry=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."'");
    $del=mysqli_fetch_row($delqry);     
 
  //  $contents.=$del[0]."\t";
     $contents.=get_engg($del[0])."\t";

//=======Call Type ======
if($row[17]=='service' or $row[17]=='new temp'){ $ctyp="Service";}
if($row[17]=='pm' or $row[17]=='temp_pm'){ $ctyp="PM Call";}
if($row[17]=='dere' or $row[17]=='temp_dere'){ $ctyp="De-Re";}
if($row[17]=='new'){ $ctyp="Inst";}
     $contents.=$ctyp."\t";
//===== Customer Status ===========    
  
  	if($row[21]=='' || $row[21]=='site'){ $contents.="Under Warranty"."\t"; }
 	
 	else if($row[21]=='amc'){ $contents.="AMC"."\t"; }else{ $contents.="PCB"."\t"; }

//========Call close Time========
	$contents.=$row[18]."\t";

if($row[15]=='Done') { $stat="Closed By Engg"; }
else if($row[16]=='Done') { $stat="Closed By Branch"; }
else if($row[16]=='Rejected') { $stat="Rejected by Branch"; }
else if($row[16]=='onhold') { $stat="Call on Hold"; }
else { $stat="Pending"; }
	 $contents.=$stat. "\t";
	 


if($row[43] !='') { $dis= "Repeated Call";} else $dis="";

$contents.=$dis. "\t";
//=========approved========
$contents.=clean($row[22]). "\t";
$contents.=clean($row[23]). "\t";

}
$contents = strip_tags($contents); 
  header("Content-Disposition: attachment; filename=calls.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;

?>
