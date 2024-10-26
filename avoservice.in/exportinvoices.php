<?php
include('config.php');
$sqlme=$_POST['qr'];
$sqlme=$sqlme." order by inv_date DESC";
//echo $sqlme;
$table=mysqli_query($con1,$sqlme);
//echo mysqli_num_rows($table);

function clean($string) {
   $string = str_replace(' ', ' ', $string); 
   $string = preg_replace('/[^A-Za-z0-9ĞİŞığşçö\-]/', ' ', $string); 

   return preg_replace('/-+/', '-', $string); 
}



$contents='';
 $contents.="S.N.\t Invoice No\t Invoice Date\tInvoice Value\tVertical Customer\tEnd User\tAddress\tBranch\tSite/Sol/ATM ID\tCredit Note No\t Credit Note Date\tCredit Note Amount\tCourier\tDocket No.\tEstimated Delivery Date\tDispatch Date\tDelivery Date\tInvoice Submission Date \tCall Docket No. \tCall Status \tSO Date and time\t Invoice Upload Time\tEngineer Name-Number\tLast Update\tLast Update Date\t Pre Invoice Update\t Post Invoice Update \t PO Number \t Asset Details\t";

$i=0;
 while($row= mysqli_fetch_row($table))
{
 $xx=0; $yy=0; $zz=0;$add=0;


//$pono=mysqli_query($con1,"select atmid,type from pending_installations where id='".$row[1]."'");
$pono=mysqli_query($con1,"select atmid,type,alert_id,cust_id,id,status,entry_date,po from pending_installations where id='".$row[1]."'");
$pon=mysqli_fetch_row($pono);
	//echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where po='".$pon[0]."'";
	if($pon[1]=="AMC")
{
$nm="select bankname,atmid,cid,area,city,address,state,pincode,branch from Amc where amcid='".$pon[0]."'";


            $atm=mysqli_query($con1,$nm);	
}
	else{
	//echo "select  bank_name,cid,area,city,address,state1 from atm where atm_id='".$row[1]."'";
	//echo "select  bank_name,atm_id,cust_id,area,city,address,state1 from atm where po='".$pon[0]."'";
$nm="select  bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id from atm where track_id='".$pon[0]."'";
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
           if($_POST['atmid']==$atmdet[1]){}
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
if(mysqli_num_rows($qry)>0){
	$custrow=mysqli_fetch_row($qry);
}
	
	$brqry=mysqli_query($con1,"select name from avo_branch where id='".$atmdet[8]."'");
if(mysqli_num_rows($brqry)>0){
	$brrow=mysqli_fetch_row($brqry);
	}

        //$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."'");	
	//$row1=mysqli_fetch_row($tab)
	//echo "eng stat".$row[15];


 $contents.="\n".++$i."\t";

$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[2]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[3]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[4]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $custrow[0]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $atmdet[0]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', trim($atmdet[5], '"')))."\t";

$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $brrow[0]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', trim($atmdet[1],'"')))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[12]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[13]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[14]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[5]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[6]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[7]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[8]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[9]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[10]))."\t";
if($pon[5]=="2"){

$qry=mysqli_query($con1,"select createdby,status,call_status from alert where alert_id='".$pon[2]."'");
$n6=mysqli_num_rows($qry);
if($n6>0){
$qryr=mysqli_fetch_row($qry);
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $qryr[0]))."\t";
}else{
$contents.=" "."\t";
}
}else{
$contents.="Not Generated"."\t"; }

if($pon[5]=="2"){
if($qryr[1]=="Done" or $qryr[2]=="Done")$contents.="Closed"."\t";
else if($qryr[1]=="Delegated")$contents.="Delegated"."\t";
else if($qryr[1]=="Pending")$contents.="Not Delegated"."\t";

}
else{
$contents.="Not Generated"."\t"; }

$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $pon[6]))."\t";

if($row[18]!="0000-00-00 00:00:00")
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $row[18]))."\t";
else
$contents.="NA"."\t";

if($pon[5]=="2"){
$qry=mysqli_query($con1,"select a.engg_name,a.phone_no1 from area_engg a,alert_delegation b where a.engg_id=b.engineer and b.alert_id='".$pon[2]."'");
if( mysqli_num_rows($qry)>0){
$qryr=mysqli_fetch_row($qry);
$contents.=$qryr[0].'-'.$qryr[1]."\t";
}else{
$contents.="NA"."\t";
}

}else{
$contents.="NA"."\t"; }

if($pon[5]=="2"){
$qry=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$pon[2]."' order by id desc limit 1");
if(mysqli_num_rows($qry)>0){
$qryr=mysqli_fetch_row($qry);
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $qryr[0]))."\t";
if($qryr[1]!="0000-00-00 00:00:00"){
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $qryr[1]))."\t";
}else{
$contents.="NA"."\t";
}

}else{
$contents.="NA"."\t";
$contents.="NA"."\t";
}


}else {
$contents.="NA"."\t"; 
$contents.="NA"."\t"; 
}


// by anand show Pre and Post Invoice



$qryupdate=mysqli_query($con1,"select * from SO_Update where po_id='".$row[1]."' and remarks_type='1' ");	
$n=mysqli_num_rows($qryupdate);

if($n>0){

while($rowUpdate=mysqli_fetch_array($qryupdate)){
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $rowUpdate[3]))."\t";
}

}else{
$dataaa="";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $dataaa))."\t";
}



$qryupdate2=mysqli_query($con1,"select * from SO_Update where po_id='".$row[1]."' and remarks_type='2' ");	
$n2=mysqli_num_rows($qryupdate2);

if($n2>0){

while($rowUpdate2=mysqli_fetch_array($qryupdate2)){
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $rowUpdate[3]))."\t";
}

}else{
$dataaa2="";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $dataaa2))."\t";
}


$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $pon[7]))."\t";




// by anand Show Asset

$daata=array();
$qrytrackid=mysqli_query($con1,"SELECT track_id FROM  `atm` WHERE  `atm_id`='".$atmdet[1]."'");
$fetch_trackid=mysqli_fetch_row($qrytrackid);

$qrypending_installations=mysqli_query($con1,"SELECT type,atmid FROM  `pending_installations` WHERE  `atmid` ='".$fetch_trackid[0]."'");
$fetch_qrypending_installations=mysqli_fetch_row($qrypending_installations);

$datafetch= $fetch_qrypending_installations[0];


if($datafetch=='sales'){
$flag='atm';
//$sqltest="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atm_id from pending_installations a,atm b where a.status=0 and a.type='sales' and a.del_type='site_del'and a.atmid='$fetch_qrypending_installations[1]'  and a.atmid=b.track_id";
$sqltest="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atm_id from pending_installations a,atm b where  a.del_type='site_del'and a.type='sales' and a.atmid='$fetch_qrypending_installations[1]'  and a.atmid=b.track_id";

}
else
{
$flag='amc';

//$sqltest="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atmid from pending_installations a,Amc b where a.status=0 and a.type='AMC' and a.del_type='site_del'  and a.atmid=b.amcid";
$sqltest="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atmid from pending_installations a,Amc b where  a.del_type='site_del' and a.atmid='$fetch_qrypending_installations[1]'  and a.atmid=b.amcid";

}
//echo $sqltest;
$tabletest=mysqli_query($con1,$sqltest);

while($rowtest= mysqli_fetch_row($tabletest)){


if($flag=="amc"){
  // $tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback from amcassets where assets_name='UPS' and callid='".$rowtest[8]."'");	
	
  $tab=mysqli_query($con1,"select assetspecid,quantity,rate,assets_name,buyback from amcassets where callid='".$rowtest[8]."'");	
	//$rowtest1=mysqli_fetch_row($tab);
	//$qrytest=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$rowtest1[0]."'");	
	//$rowe=mysqli_fetch_row($qrytest);
	//$bb=$rowtest1[4];
}
else{
   // $tab=mysqli_query($con1,"select assets_spec,quantity,rate from site_assets where po='".$rowtest[1]."' and assets_name='UPS' and callid='".$rowtest[8]."'");	

    $tab=mysqli_query($con1,"select assets_spec,quantity,rate,assets_name from site_assets where po='".$rowtest[1]."'  and callid='".$rowtest[8]."'");	
	//$rowtest1=mysqli_fetch_row($tab);
	//$qrytest=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$rowtest1[0]."'");	
	//$rowe=mysqli_fetch_row($qrytest);
	//$bb=0;
}


if(mysqli_num_rows($tab)>0){
while($rowtest1=mysqli_fetch_array($tab)){
$qrytest=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$rowtest1[0]."'");	
if(mysqli_num_rows($qrytest)>0){
$rowe=mysqli_fetch_row($qrytest);

$daata[]=$rowtest1[3].' , '.$rowe[0].' , '.$rowtest1[1] .' , '.$rowtest1[2];

}else{
$daata[].=" "."\t";
}

}
//$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $rowtest1[3].' , '.$rowe[0].' , '.$rowtest1[1] .' , '.$rowtest1[2]))."\t";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $daata[0]))."\t";

}

else{
$dataaa3="";
$contents.=str_replace("\n","  ",preg_replace('/\s+/', ' ', $dataaa3))."\t";



}
}


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