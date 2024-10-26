<?php
// include('config.php');
include('db_connection.php');
$con1 = OpenCon1();

$sqlme=$_POST['qr'];
$sqlme=$sqlme.' limit 500';
$site=$_POST['site'];
$engg_id=$_POST['engg'];

$engqry2=mysqli_query($con1,"select engg_name, engg_desgn from area_engg where engg_id='".$engg_id."'");
$engg=mysqli_fetch_row($engqry2);


$table=mysqli_query($con1,$sqlme);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/s', ' ', $string); 
  
   return preg_replace('/-+/', '-', $string); 
}

$contents='';
 $contents.="Sr. No.\t Engineer Name\t Designation\t Branch\t Vertical-Client Name\t Site/Sol/ATM ID\t End User\t Address\t Site Type\t Distance\t Last Call Closed\t ";
// echo $contents;
$cnt=0;
while($row=mysqli_fetch_row($table))
{
$cnt++;
$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[3]."'");
$branch=mysqli_fetch_row($qry2);
$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[2]."'");
$cust=mysqli_fetch_row($custqry);
 
$alerqry=mysqli_query($con1,"select date(close_date) from alert where atm_id='".$row[0]."' and (status='Done' or call_status='Done') and call_status !='Rejected' order by alert_id DESC ");
$alert=mysqli_fetch_row($alerqry);

	 $contents.="\n".$cnt."\t";
	 $contents.=$engg[0]."\t";
	 $contents.=$engg[1]."\t";
	 $contents.=$branch[0]."\t";
	 $contents.=$cust[0]."\t";
	 $contents.=$row[1]."\t";

	 $contents.=clean(trim($row[4]))."\t";
	 $contents.=clean(trim($row[5]))."\t";
	 $contents.=$site."\t";
     $contents.=$row[8]."\t";
    $contents.=$alert[0]."\t";

 
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
