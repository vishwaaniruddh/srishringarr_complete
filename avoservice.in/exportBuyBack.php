<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme." order by inv_date DESC";

$table=mysqli_query($con1,$sqlme);


$contents='';
 $contents.="SS.N.\t Invoice No \t Invoice Date \t Invoice Value \t Customer\t Bank \t Address \t Branch\t ATM ID \t Remark \t BuyBack Condition \t Received \t material details \t BuyBack Date \t ";

$i=0;
 while($row= mysqli_fetch_row($table))
{


 $xx=0; $yy=0; $zz=0;$add=0;
//echo "select atmid,type,status,cust_id,id,status from pending_installations where id='".$row[1]."'";
//$pono=mysqli_query($con1,"select atmid,type,alert_id,cust_id,id,status,entry_date from pending_installations where id='".$row[1]."'");
//$pon=mysqli_fetch_row($pono);
	//echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where po='".$pon[0]."'";
	if($row[7]=="AMC")
{
$nm="select bankname,atmid,cid,area,city,address,state,pincode,branch from Amc where amcid='".$row[6]."'";


            $atm=mysqli_query($con1,$nm);	
}
	else{
	//echo "select  bank_name,cid,area,city,address,state1 from atm where atm_id='".$row[1]."'";
	//echo "select  bank_name,atm_id,cust_id,area,city,address,state1 from atm where po='".$pon[0]."'";
$nm="select  bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id from atm where track_id='".$row[6]."'";
	    $atm=mysqli_query($con1,$nm);
	

}



$atmdet=mysqli_fetch_row($atm);
	if(isset($_POST['cid']) && $_POST['cid']!='' )
         {
          if($_POST['cid']==$atmdet[2]){}
          else
             $xx=-1;
         }
         if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='' )
         {
           if($_POST['branch_avo']==$atmdet[8]){}
          else
             $yy=-1;
         }
         if(isset($_POST['atmid']) && $_POST['atmid']!='' )
         {
           //if($_POST['atmid']==$atmdet[1]){}
           if(startsWith($atmdet[1], $_POST['atmid'])){}
          else
             $zz=-1;
         }
 if(isset($_POST['address']) && $_POST['address']!='' )
         {
//echo $_POST['address'];
if (strpos($atmdet[5], $_POST['address']) !== false)
{}
          else
             $add=-1;
         }

      if($xx==0 and $yy==0 and $zz==0 and $add==0)
      {
      
      
      
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atmdet[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$brqry=mysqli_query($con1,"select name from avo_branch where id='".$atmdet[8]."'");
	$brrow=mysqli_fetch_row($brqry);



if($row[11]=="n"){ $AN="Not Available";}else if($row[11]=="y"){ $AN="Available";} else{$AN="";}
if($row[10]==""){ $NOyes= "NO";}else if($row[10]=="Yes"){ $NOyes= "YES";} else{$NOyes="";}
$na="NA";
 $contents.="\n".++$i."\t";
 $contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[0]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[1]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[2]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $custrow[0]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $atmdet[0]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $atmdet[5]))."\t";

$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $brrow[0]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $atmdet[1]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[4].' '.$row[5]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $AN))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $NOyes))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $na))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[8]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[9]))."\t";
// by anand Show Asset

//echo $sqltest;




///////////////////////////////////////////////
}
}


$contents = strip_tags($contents); 

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename="Invoices".xls");
   header("Content-Disposition: attachment; filename=Invoices.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
?>