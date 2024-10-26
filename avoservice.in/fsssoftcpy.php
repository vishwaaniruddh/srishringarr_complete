<?php
include("config.php");
 $sql=$_POST['qr'];
 $cid=$_POST['cid'];
$qry=mysqli_query($con1,$sql);
$contents='';
$contents.="S.No. \t Address (*) \t Bank Name \t ProjectID \t Onsite / Offsite (*) \t ATM ID(*) \t Billing cycle(*) \t Last bill paid (*) \t Site Code(*) \t Payment Mode \t Vendor Code/RR Code \t Consumer No.(*) \t Bill date(*) \t Due Date(*) \t Actual Date of Payment[(*)Except Bill Desk] \t Billing Period(From)[(*)Except Bill Desk] \t Billing Period(To)[(*)Except Bill Desk] \t Opening Units[(*)Except Bill Desk] \t Closing Units[(*)Except Bill Desk] \t Units Consumed[(*)Except Bill Desk] \t Electricity charges(*) \t Penalty Charges(*) \t Electricity Deposit \t Other Charges \t Total Electricity Payment (*) \t Service Tax(*) \t Service Charge(*) \t Total Payable(*) \t Remarks \t Invoices sent to Mumbai FSS ( Date) (*) \t  EB Invoice Number(*) \t  EB Invoice Date (*) \t EB Invoice Amount(*) \t Service Invoice Number (*) \t Service Invoice Date(*) \t Service Invoice Amount (*) \t AIM IONRefNumber ( For FSS Use)";
while($ro=mysqli_fetch_row($qry))
{
$srno=0;
$inv=mysqli_query($con1,"select * from send_bill_detail where send_id='".$ro[0]."' and status='0'");
while($invr=mysqli_fetch_array($inv))
{
$ebpay=mysqli_query($con1,"select Paid_Date from ebpayment where Bill_No='".$invr[20]."'");
$ebpayr=mysqli_fetch_row($ebpay);
$site=mysqli_query($con1,"select bank,site_type,atm_id1,atmsite_address,site_id,projectid from ".$ro[1]."_sites where trackerid='".$invr[2]."'");
$sitero=mysqli_fetch_row($site);
$ebill=mysqli_query($con1,"select Consumer_No from ".$ro[1]."_ebill where atmtrackid='".$invr[2]."'");
$ebillr=mysqli_fetch_row($ebill);
//echo "select bill_date,due_date,opening_reading,closing_reading from ebillfundrequests where req_no='".$invr['reqid']."'";
$ebfund=mysqli_query($con1,"select bill_date,due_date,opening_reading,closing_reading from ebillfundrequests where req_no='".$invr['reqid']."'");
$ebfr=mysqli_fetch_row($ebfund);
$srno=++$srno;
$contents.="\n".$srno."\t";

$contents.=preg_replace('/\s+/', ' ', $sitero[3])."\t";
$contents.=$sitero[0]."\t";
$contents.=$sitero[5]."\t";
$contents.=$sitero[1]."\t";
$contents.=$sitero[2]."\t";
$contents.="1 \t";
$contents.=date('d-M-y',strtotime($invr[7]))."\t";
$contents.=$sitero[4]."\t";
$contents.="Vendor Mode\t";
$contents.="C0002\t";
$contents.=$invr[5]."\t";

$contents.=$invr[6]."\t";
$contents.=date('d-M-y',strtotime($invr[7]))."\t";
$contents.=$invr[13]."\t";
$contents.=$invr[9]."\t";
$contents.=$invr[10]."\t";
$contents.=$ebfr[2]."\t";
$contents.=$ebfr[3]."\t";
$contents.=$invr[8]."\t";
//$contents.=$invr[10]."\t";
$contents.=$invr[12]."\t";
$contents.="0\t";
$contents.="0\t";
$contents.="0\t";
$contents.=$invr[12]."\t";
$contents.="-\t";
$contents.=$invr[15]."\t";
$contents.=($invr[12]+$invr[15])."\t";
$contents.="-\t";
$contents.="-\t";
$contents.=$ro[5]."\t";
$contents.=date("d-M-y",strtotime($ro[3]))."\t";
$contents.=$ro[4]."\t";
$contents.=$ro[9]."\t";
$contents.=date("d-M-y",strtotime($ro[3]))."\t";
$contents.=$ro[11]."\t";
$contents.="";
}


}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=fsssoftcopy.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
  
?>
