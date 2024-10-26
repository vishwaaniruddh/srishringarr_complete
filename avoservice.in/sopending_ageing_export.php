<?php
include('config.php');
$typenew=$_POST['type'];


		$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));
		$todt1=$todt.' 23:59:59';	
 $contents='';
 $contents.="S.N. \t Customer \t < 1 Days \t < 2 Days \t < 3 Days \t < 5 Days \t Above 5 Days  \t";

$tot1=0;
$tot2=0;
$tot3=0;
$tot4=0;
$tot5=0;
$totm5=0;
if($_POST['type']=='cwise'){
	
    $cust_sql=mysqli_query($con1,"select cust_id,cust_name from customer");
    $cnt=0;
    while($custrow=mysqli_fetch_row($cust_sql))
    {
$cnt1d=0;
$cnt2d=0;
$cnt3d=0;
$cnt5d=0;
$cntm5d=0;
    $cnt++;
		//$todt=$_POST['todt'];	
		//echo "select entry_date from pending_installations where status=0 and entry_date<='".$todt1."' and cust_id='".$custrow[0]."'";
			$soq=mysqli_query($con1,"select entry_date from pending_installations where status=0 and entry_date<='".$todt1."' and cust_id='".$custrow[0]."'");
			while($sorow=mysqli_fetch_array($soq))
{

$date1 = new DateTime($sorow[0]);
//echo $date1;

$dttody=date("Y-m-d H:i:s");
$date2 = new DateTime($dttody);
//echo $date2;
$days= $date2->diff($date1)->format("%a");
//echo $sorow[0]."-----".$days."<br>";
if($days==1)
{
$cnt1d++;
}

if($days==2)
{
$cnt2d++;
}
if($days==3)
{
$cnt3d++;
}
if($days==5)
{
$cnt5d++;
}
if($days>5)
{
$cntm5d++;
}





}
		
$tot1=$tot1+$cnt1d;
$tot2=$tot2+$cnt2d;
$tot3=$tot3+$cnt3d;
$tot5=$tot5+$cnt5d;
$totm5=$totm5+$cntm5d;
	
$contents.="\n".$cnt."\t";

//================Customer name========
$contents.=$custrow[1]."\t";

$contents.=$cnt1d."\t";

$contents.=$cnt2d."\t";

$contents.=$cnt3d."\t";
$contents.=$cnt5d."\t";
$contents.=$cntm5d."\t";

}


$tot1=$tot1+$cnt1d;
$tot2=$tot2+$cnt2d;
$tot3=$tot3+$cnt3d;
$tot5=$tot5+$cnt5d;
$totm5=$totm5+$cntm5d;

$contents.="\n".""."\t";
$contents.="Total \t";
$contents.=$tot1." \t";
$contents.=$tot2." \t";
$contents.=$tot3." \t";
$contents.=$tot5." \t";
$contents.=$totm5." \t";


 }
 else{
  	
    $br_sql=mysqli_query($con1,"select id,name from avo_branch");
    $cnt=0;
    while($brrow=mysqli_fetch_row($br_sql))
    {
    $cnt++;

    $cnt1d=0;
$cnt2d=0;
$cnt3d=0;
$cnt5d=0;
$cntm5d=0;

		//$todt=$_POST['todt'];	
		$tags='';
	   $atmsql=mysqli_query($con1,"select track_id as id from atm where branch_id='".$brrow[0]."' union select amcid from Amc where branch='".$brrow[0]."'");
	                while ($atmrow = mysqli_fetch_row($atmsql)) {
    // concatenate all the tags into one string
                   $tags .= $atmrow[0].',';
                    }

//echo "select entry_date  from pending_installations where status=0 and entry_date<='".$todt1."' and atmid in(".$tags.")";
                   $tags = substr($tags,0,-1); //echo $tags.'<br>';
			$soq=mysqli_query($con1,"select entry_date  from pending_installations where status=0 and entry_date<='".$todt1."' and atmid in(".$tags.")");
			while($sorow=mysqli_fetch_array($soq))
{

$date1 = new DateTime($sorow[0]);
//echo $date1;

$dttody=date("Y-m-d H:i:s");
$date2 = new DateTime($dttody);
//echo $date2;
$days= $date2->diff($date1)->format("%a");
//echo $sorow[0]."-----".$days."<br>";
if($days==1)
{
$cnt1d++;
}

if($days==2)
{
$cnt2d++;
}
if($days==3)
{
$cnt3d++;
}
if($days==5)
{
$cnt5d++;
}
if($days>5)
{
$cntm5d++;
}
}

$tot1=$tot1+$cnt1d;
$tot2=$tot2+$cnt2d;
$tot3=$tot3+$cnt3d;
$tot5=$tot5+$cnt5d;
$totm5=$totm5+$cntm5d;


$contents.="\n".$cnt."\t";

$contents.=$brrow[1]."\t";

$contents.=$cnt1d."\t";

$contents.=$cnt2d."\t";

$contents.=$cnt3d."\t";
$contents.=$cnt5d."\t";
$contents.=$cntm5d."\t";


}



$contents.="\n".""."\t";
$contents.="Total \t";
$contents.=$tot1." \t";
$contents.=$tot2." \t";
$contents.=$tot3." \t";
$contents.=$tot5." \t";
$contents.=$totm5." \t";

}
$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
 header("Content-Disposition: attachment; filename=PendingSOreport.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
?>