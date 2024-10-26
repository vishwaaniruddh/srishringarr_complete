<?php

//include("config.php");
$path_to_root="..";
$page_security = 'SA_OPEN';
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/data_checks.inc");
include_once($path_to_root . "/includes/ui.inc");
//include_once($path_to_root . "/reporting/includes/reports_classes.inc");

global $db, $transaction_level, $db_connections;

$con = mysqli_connect("localhost","satyavan_travels","Ritesh123*");
              mysqli_select_db("satyavan_milestravels",$con);
           $sid=$db_connections[$_SESSION["wa_current_user"]->company]['tbpref'];
$cid=substr($sid,0,-1);
?>

<?php
$qry='';
$frmdt='';
$todt='';
$str='';
$type='';
//echo $cid;
$cust=$_GET['cid'];
//echo $_GET['type'];
if($_GET['type']=='' || $_GET['type']=='all')
$type=" type IN ('10','12','13')";
else
$type=" type='".$_GET['type']."'";

//echo "type=".$type;
$today = strtotime(date('Y-m-d'));
 $expdate = strtotime("-2 days", $today);
 $dat=date('Y-m-d',$expdate);

if($cust=='load')
{
$qry=mysqli_query($con1,"select * from ".$cid."_debtor_trans where tran_date>='".$dat."' and tran_date<='".date('Y-m-d')."' and $type order by tran_date DESC,trans_no ASC");
 //echo "select * from ".$cid."_debtor_trans where tran_date>='".$dat."' and tran_date<='".date('Y-m-d')."' and ".$type."";
}
else	
{
//echo "hi<br>";
$frmdt='';
$todt='';

$fdate = str_replace('/', '-',$_GET['frmdt']);
$frmdt =date('Y-m-d', strtotime($fdate));
$tdate = str_replace('/', '-',$_GET['todt']);
$todt =date('Y-m-d', strtotime($tdate));
//$strfrmdt = explode("/",$_GET['frmdt']);
//$strtodt = explode("/",$_GET['todt']);
//echo $_GET['frmdt']." ".$_GET['todt']." ".strtotime($_GET['frmdt'])."<br>";
//echo date('Y-m-d',strtotime($_GET['frmdt']))." ".date('Y-m-d',strtotime($_GET['todt']))."<br>";
//$frmdt= date('Y-m-d',strtotime($_GET['frmdt'],'d/m/Y'));
//$frmdt=$strfrmdt[2]."-".$strfrmdt[1]."-".$strfrmdt[0];
//$todt=date('Y-m-d',strtotime($_GET['todt'],'d/m/Y'));
//echo $frmdt." ".$todt;

if($cust=='' && $_GET['frmdt']!='' && $_GET['todt']!='')
$str=" where  tran_date>='".$frmdt."' and tran_date<='".$todt."' and ".$type."";
elseif($cust!='' && $_GET['frmdt']!='' && $_GET['todt']!='')
$str=" where  tran_date>='".$frmdt."' and tran_date<='".$todt."' and debtor_no in(select pid from deptpeople where deptid='".$cust."') and ".$type."";
elseif($cust!='' && ($_GET['frmdt']=='' || $_GET['todt']==''))
$str=" where debtor_no in (select pid from deptpeople where deptid='".$cust."') and ".$type."";
elseif($cust=='' && $_GET['frmdt']=='' && $_GET['todt']=='')
$str="where ".$type."";
//else
//echo "Invalid Data";
//echo "select * from ".$cid."_debtor_trans $str order by tran_date DESC,trans_no ASC";
$qry=mysqli_query($con1,"select * from ".$cid."_debtor_trans $str order by tran_date DESC,trans_no ASC");
}
if(mysqli_num_rows($qry)>0)
{
function mb_abs($number) 
{ 
  return str_replace('-','',$number); 
} 

  $invoice=0;
$payment=0;
$crnote=0;
	$cnt=0;
	$counter=0;
	
	?>
    <form name="frmpay" action="processinvpay.php" method="post">
    <table border="1" cellspacing="0" cellpadding="0" style="background:#CCC; width:auto">
  <tr>
    <th scope="col">Sr. No.</th>
	<th scope="col">Book Date</th>
    <th scope="col" width="50px">Customer Name</th>
   <!-- <th scope="col">Address</th>-->
    <th scope="col">Transaction No.</th>
   <th scope="col">Type</th>
     <th scope="col">Supplier Name</th>
      
       <th scope="col">Airline</th>
        <th scope="col">Ticket Number</th>
        <th scope="col">PNR No.</th>
		 
		  <th scope="col">Invoice Amount</th>
		   <th scope="col">Payment Amount</th>
            <th scope="col">Refundable Amount</th>
    
    
  </tr>
  <?php
  while($row=mysqli_fetch_array($qry))
  {
$qry6ro='';
// echo "<br>Select * from sales where debt_ref='".$row[0]."'<br>";
  $cnt=$cnt+1;
 // echo "Select * from ".$cid."_debtor_trans where debtor_no='".$row[3]."' and tran_date='".$row[5]."'";
  //$qry3=mysqli_query($con1,"Select * from ".$cid."_debtor_trans where debtor_no='".$row[3]."' and tran_date='".$row[5]."'");
  //$row3=mysqli_fetch_row($qry3);
 //echo "select * from sales where prefix='".$cid."' and custid='".$row[3]."' and date='".$row[5]."' and status=0";
 //echo "<br>select * from sales where prefix='".$cid."' and custid='".$row[3]."' and crnote<>'2'<br>";
 if($row[1]=='10')
 {
  $qry6=mysqli_query($con1,"select * from sales where prefix='".$cid."' and debt_ref='".$row[0]."' and date<>'0000-00-00'");
  $qry6ro=mysqli_fetch_row($qry6);
  }
  if(!$qry3)
  echo "".mysqli_error();
 // echo $qry6ro[16];
  
  //echo "hello";
 // echo $row3[0];
//echo "select name from ".$cid."_debtors_master where debtor_no='".$row3[2]."'<br>";

  $qry2=mysqli_query($con1,"select name from ".$cid."_debtors_master where debtor_no='".$row[3]."'");
	  $row2=mysqli_fetch_row($qry2);
	$qry4=mysqli_query($con1,"select * from airline where id='".$qry6ro[7]."'");
	$row4=mysqli_fetch_row($qry4); 
	  if($qry6ro[18]=='credit')
	 {
		// echo "select ov_amount from ".$cid."_debtor_trans where type='10' and debtor_no='".$row[2]."'";
		//$bal=$row3[0];
		
		$today = strtotime($qry6ro[17]);
 $expdate = strtotime("+1 month", $today);
 $duedt=date('Y-m-d',$expdate);
	 }
	 else
	 {
		
		 $duedt=date('Y-m-d',strtotime($row[17]));
	 }
	// echo ($duedt<=date('d/m/Y'));
	//echo "select supp_name from ".$cid."_suppliers where supplier_id='$row3[23]'";
	$qry5=mysqli_query($con1,"select supp_name from ".$cid."_suppliers where supplier_id='$qry6ro[23]'");
	$row5=mysqli_fetch_row($qry5);
	//echo $row[1]."<br>";
	if($row[1]=='10')
	{
	
  ?>
  <tr <?php   if($duedt<=date('Y-m-d') && $qry6ro[18]=='credit'){ ?> style="background:#FF0000"  <?php  } ?>>
    <td>&nbsp;<?php echo $cnt;
	if($qry6ro[9]-$qry6ro[24]>0)
	{
	
	?>
  <input type="checkbox" name="salesid[<?php $counter; ?>]" id="salesid<?php echo $counter;?>" value="<?php echo $qry6ro[0]; ?>" onclick="increase('salesid<?php echo $counter;?>','bal<?php echo $counter;?>');"  /><input type="hidden" name="bal" id="bal<?php echo $counter;?>" value="<?php echo $qry6ro[9]-$qry6ro[24]  ?>" /> <input type="hidden" name="inv<?php echo $counter;?>" id="bal<?php echo $counter;?>" value="<?php echo $qry6ro[9]-$qry6ro[24]  ?>" />
    <?php
	$counter=$counter+1;
	}
	 ?></td>
	<td>&nbsp;<?php echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td>&nbsp;<?php echo $row2[0]; ?></td>
    <!--<td>&nbsp;<?php echo $row[0]; ?></td>-->
    <td>&nbsp;<?php if($row[1]=='10'){ echo  $qry6ro[26];} ?></td>
   <td>&nbsp;<?php if($row[1]=='10'){ echo "Invoice"; }elseif($row[1]=='12'){ echo "Payment"; } ?></td>
    <td>&nbsp;<?php if($row[1]=='10'){ echo $row5[0]; } ?></td>
   
    <td>&nbsp;<?php  if($row[1]=='10'){ echo $row4[1]; } ?></td>
     <td>&nbsp;<?php 
	 //echo $qry6ro[0]." ";
	 if($row[1]=='10'){ echo  $qry6ro[12];} ?></td>
      <td>&nbsp;<?php if($row[1]=='10'){ echo  $qry6ro[13];} ?></td>
	   
    <td align="right">&nbsp;<?php if($row[1]=='10') { echo $row[10];
	$invoice=($invoice+$row[10]);
	 } ?></td>
	 <td align="right">&nbsp;<?php if($row[1]=='12'){ echo $row[10]; 
	 $payment=($payment+$row[10]);
	 } ?></td><td>&nbsp;</td>
  
  </tr>
  
  <?php
  
  }
 else if($row[1]=='12')
	{
	
	
  ?>
  <tr <?php   if($duedt<=date('Y-m-d') && $qry6ro[18]=='credit'){ ?> style="background:#FF0000"  <?php  } ?>>
    <td>&nbsp;<?php
	
	 echo $cnt;
	
	 ?></td>
	<td>&nbsp;<?php echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td>&nbsp;<?php echo $row2[0]; ?></td>
    <!--<td>&nbsp;<?php echo $row[0]; ?></td>-->
    <td>&nbsp;<?php  echo $row[0]; ?></td>
   <td>&nbsp;<?php if($row[1]=='10'){ echo "Invoice"; }elseif($row[1]=='12'){ echo "Payment"; } ?></td>
    <td>&nbsp;<?php if($row[1]=='10'){ echo $row5[0]; } ?></td>
   
    <td>&nbsp;<?php  if($row[1]=='10'){ echo $row4[1]; } ?></td>
     <td align="right">&nbsp;<?php if($row[1]=='10'){ echo  $qry6ro[12];} ?></td>
      <td align="right">&nbsp;<?php if($row[1]=='10'){ echo  $qry6ro[13];} ?></td>
	   
    <td align="right">&nbsp;<?php if($row[1]=='10') { echo $row[10];
	$invoice=($invoice+$row[10]);
	 } ?></td>
	 <td align="right">&nbsp;<?php if($row[1]=='12'){ echo $row[10]; 
	 $payment=($payment+$row[10]);
	 } ?></td><td>&nbsp;</td>
  
  </tr>
  <?php
} 
elseif($row[1]=='13')
{
//echo "hello<br>".$row[1]." ".$row[0]." ---<br>";
 // echo $qry6ro[25];
 // echo "select * from sales where crtrans_ref='".$row[0]."' and crnote<>'2'";
//echo "here";
$sale=mysqli_query($con1,"select * from sales where crtrans_ref='".$row[0]."' and prefix='".$cid."' and status='1' and crnote<>'2'");

$salero=mysqli_fetch_row($sale);
 ?>
  
  <tr <?php   if($duedt<=date('Y-m-d') && $row[18]=='credit'){ ?> style="background:#FF0000"  <?php  } ?>>
    <td>&nbsp;<?php echo $cnt;
	
	 ?></td>
	<td>&nbsp;<?php echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td>&nbsp;<?php echo $row2[0]; ?></td>
    <!--<td>&nbsp;<?php echo $row[0]; ?></td>-->
    <td>&nbsp;<?php echo  $row[0]; ?></td>
   <td>&nbsp;<?php if($row[1]=='13'){ echo "Credit Note"; } ?></td>
    <td>&nbsp;<?php  if($row[1]=='10'){echo $row5[0];} ?></td>
   
    <td>&nbsp;<?php if($row[1]=='10'){ echo $row4[1];} ?></td>
     <td align="right">&nbsp;<?php  if($row[1]=='10'){ echo  $qry6ro[12]; } ?></td>
      <td align="right">&nbsp;<?php if($row[1]=='10'){ echo  $qry6ro[13]; }?></td>
	   
    <td align="right">&nbsp;<?php if($row[1]=='10') {// echo $row[10];
	//$invoice=($invoice+$row[10]);
	 } ?></td>
	 <td align="right">&nbsp;<?php if(mysqli_num_rows($sale)>0){  echo mb_abs($row[10]); } ?></td>
     <td align="right">&nbsp;<?php if(mysqli_num_rows($sale)>0){ ?> <a href="paycreditnote.php?sid=<?php echo $row[0]; ?>&amt=<?php  echo mb_abs($row[10]); ?>"><?php  echo mb_abs($row[10]); 
	 $crnote=$crnote+mb_abs($row[10]);?></a><?php } ?>
	 </a></td>
  
  </tr>
  <?php
 
  
  }
  }
  ?>
  <tr><td>&nbsp;</td><td>&nbsp;<b>Total</b></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
  <td>&nbsp;</td><td>&nbsp;<b><?php  echo $invoice;  ?></b></td><td>&nbsp;<b><?php  echo $payment;  ?></b></td><td>&nbsp;<?php echo $crnote; ?></td></tr>
 <?php if($_GET['type']=='' || $_GET['type']=='all' ){ ?> <tr><td>&nbsp;</td><td>&nbsp;<b>Outstanding</b></td><td colspan="10" align="right">&nbsp;<b><?php echo ($invoice-$payment-$crnote); ?></b></td></tr><?php }
 
  ?>
  <tr><td colspan="12">Receivable Amount :<input type="text" name="rcvamt" id="rcvamt" value="0" readonly="readonly" />
  <input type="hidden" name="cnt" id="cnt" value="<?php echo $cnt; ?>" />
  <input type="hidden" name="incr" id="incr" value="0" /><?php if($counter>0){ ?><input type="submit" name="btnsub" value="Make Payment" /> <?php  }  ?></td></tr>
</table>

</form>
<?php
}
else
echo "No Data to display";
?>