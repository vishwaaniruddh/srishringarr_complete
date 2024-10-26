<?php
//ini_set( "display_errors", 0);
include('config.php');
include('wordtonumber.php');
$qty1=0;
$cid=$_POST['cid'];
$phoneNo=$_POST['phoneNo'];
$address=$_POST['tp'];
//$billdate=$_POST['bill_date'];
$gwr=$_POST['gwr'];
$dwr=$_POST['dwr'];
$mkr=$_POST['mkr'];
//$csr=$_POST['csr'];
$amountTotal=$_POST['amountTotal'];
//$acc=$_POST['acc'];
$design=$_POST['design'];
$barc=$_POST['barc'];
//$amt=$_POST['amt'];
	// $resultname = mysql_query("SELECT * FROM  `phppos_people` where person_id='$cid'");
	//$rowname = mysql_fetch_row($resultname);
$prz=$_POST['prz'];
$d=count($design);
if(isset($_POST['dis']))
$dis=$_POST['dis'];
else
$dis=0;
//$disper=$_POST['disper'];
$note=$_POST['note'];
$odate=$_POST['bill_date'];
/*if($by=="QUOTATION")
{
$bs='S';
}else{
$bs='A';
}*/
$myflag=true;$dname="";$dqty=0;$bqty=0;
/*for($i=0;$i<$d;$i++)
{
$a=$prz[$i].".00";
// $sq="SELECT quantity FROM phppos_items WHERE name='$design[$i]'";
$res2 = mysql_query($sq);
$det = mysql_fetch_row($res2);

if($a>$det[0])
{
 $dname=$design[$i];
 $dqty=$a;
 $bqty=$det[0];
 $myflag=false;
 break;
	}
}*/
/*
if(!$myflag){
            echo "<br><br><br><center>You don't have enough quantity for ".$dname.", required  ".$dqty.", in Stock  (".$bqty;
            echo "). Go back and try again</center>";
            
}*/
mysql_query("BEGIN;");
//	if($myflag){
	 $t1=mysql_query("insert into `1_debtors_master`(name,debtor_ref,address,curr_code,sales_type,inactive) values('$cid','$cid','$address','INR','1','0')");
 	//echo "insert into `14_debtors_master`(name,debtor_ref,address,curr_code,sales_type,inactive) values('$cid','$cid','$address','INR','1','0')";
	 $result1 = mysql_query("SELECT max(debtor_no) FROM  `14_debtors_master`");  
	 $custno = mysql_fetch_row($result1);
	$t11=mysql_query("insert into `1_crm_persons`(ref,name,address,phone,inactive) values('$cid','$cid','$address','$phoneNo','0')");
//	echo "insert into `14_crm_persons`(ref,name,address,phone,inactive) values('$cid','$cid','$address','$phoneNo','0')";
	if($t11){
		mysql_query("insert into `1_cust_branch`(debtor_no,branch_ref,br_name,br_address,tax_group_id,sales_discount_account,receivables_account,payment_discount_account,inactive) values('$custno[0]','$cid','$cid','$address','1',4510,1200,4500,'0')");
		
	//	echo "insert into `14_cust_branch`(debtor_no,branch_ref,br_name,br_address,tax_group_id,sales_discount_account,receivables_account,payment_discount_account,inactive) values('$custno[0]','$cid','$cid','$address','1',4510,1200,4500,'0')";
	}
	
		$result2 = mysql_query("SELECT max(branch_code) FROM  `1_cust_branch` where branch_ref='".$cid."'");  
	 $brno = mysql_fetch_row($result2);
        $result3 = mysql_query("SELECT max(trans_no) FROM  `1_debtor_trans` where type=10");
		  $trno = mysql_fetch_row($result3);
		  $trnew=$trno[0]+1;
		  $refnew=$trno[0]+1;
	$t2=mysql_query("insert into `1_debtor_trans`(trans_no,type,version,debtor_no,branch_code,tran_date,due_date,reference,tpe,order_,ov_amount,ov_discount,payment_terms) values('$trnew','10','1','$custno[0]','$brno[0]',STR_TO_DATE('$odate','%d/%m/%Y'),STR_TO_DATE('$odate','%d/%m/%Y'),$trnew,1,$trnew,$amountTotal,$dis,4)");
	//echo "insert into `14_debtor_trans`(trans_no,type,version,debtor_no,branch_code,tran_date,due_date,reference,tpe,order_,ov_amount,ov_discount,payment_terms) values('$trnew','10','1','$custno[0]','$brno[0]',STR_TO_DATE('$odate','%d/%m/%Y'),STR_TO_DATE('$odate','%d/%m/%Y'),$trnew,1,$trnew,$amountTotal,$dis,4)"; 
 // $result = mysql_query("SELECT * FROM  `phppos_people` where person_id='$cid'");
//	$row = mysql_fetch_row($result);
	$sum2=0;
	$total22=0;
 for($j=0;$j<$d;$j++)
{
$t3=mysql_query("insert into `1_debtor_trans_details`(debtor_trans_no,debtor_trans_type,stock_id,unit_price,quantity) values('$trnew','10','$barc[$j]','$prz[$j]','1')");
$t4=mysql_query("insert into `sales_details` values('$trnew','$barc[$j]','$gwr[$j]','$dwr[$j]','$mkr[$j]','$csr[$j]')");
// $sq22="SELECT * FROM phppos_items WHERE name='$design[$j]'";
//$res22 = mysql_query($sq22);
//$num22=mysql_num_rows($res22);
//$row12=mysql_fetch_row($res22);

//$total22=$row12[6]*$prz[$j];

//$sum2+=$total22;
}	

///echo $sum2;
//$c=$dis/$sum2;
//$b=$c*100
//echo $sum."/".$b."<br/>";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mulakaat Jewellers</title>
</head>
<script type="text/javascript" src="paging.js"></script>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('bill');
           divToPrint.style.fontSize = "10px";
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
		function rollback(){
			document.getElementById("bdy").innerHTML="Transaction is rolled back, keeping the data secure. Please refresh this page to complete the transaction!";
			}
       
     </script>
<body id="bdy">

<div id="bill" style="font-size:12px;">
<table width="787" border="0" align="center" style="
    margin-top: 160px;
">
<tr>
    <td width="781" height="42">
    
    <table width="780" >
       <tr>
        <td colspan="3" align="center" >
          <font size="2">
            <B><U>TAX INVOICE  </U></B></font></td>
         </tr>            
  <tr>
  
    
    
    </tr>
    
  <tr>
    <td colspan="2" ></td>
    </tr>
    
  <tr>
    <td height="21" colspan="2"><font size="3" >M/s.&nbsp;:&nbsp;&nbsp;<b><?PHP echo $cid; ?></b></font></td><td width="128"><font size="2" >Invoice Date: </font><b><?php echo $odate; ?></b></td>
    </tr>
    
  <tr>
    <td colspan="2" height="23" valign="top"><font size="3" >Address</font><font size="2" >.: &nbsp;&nbsp;&nbsp;
      <b><?php echo $address; ?><br/><?php echo $row[6]; ?><?php echo $row[8]; ?>
      <?php echo $row[9]; ?></b></font></td>
    <td><font size="3" >Invoice No:</font><b><?php echo $trnew; ?></b></td></tr>
    <tr>
    <td><font size="3" >Contact No.: &nbsp;&nbsp;&nbsp; <b><?php echo $phoneNo; ?></b></font></td><td width="290"></td></tr>
  </table><font size="2" >
    <table width="780" height="550" border="1" cellpadding="4" cellspacing="0" id="results">
  <tr height=20>
  <th width="30"><font size="2" >Sr.No.</font></th>
    <th width="219"><font size="2" >Item</font></th>
   <th width="40">Purity</th>    
    <th width="40"><font size="2" >Gold Wt.</font></th>
    <th width="40"><font size="2" >Net Wt.</font></th>
     <th width="40"><font size="2" >G Rate</font></th>
	    <th width="40"><font size="2" >Dia.CT</font></th>
        <th width="40"><font size="2" >D Rate</font></th>   	    
	    <th width="40"><font size="2" >Making</font></th>
	    
        <th width="73"><font size="2" >Amount</font></th>
    
  </tr>
  <?php
  $j=1;
  $total=0;
  $s2=0;
  ///$ds=$dis/$d;
  for($i=0;$i<$d;$i++)
{
//$total=0;

/////discount no

//echo "update  phppos_items  set quantity=quantity-$a WHERE name=".$design[$i];

// $t3=mysql_query("update `phppos_items` set quantity=quantity-$a WHERE name='".$design[$i]."'");
 
 
 

///echo $ds."/ ".$design[$i]." / ".$prz[$i]." / ".$p."<br/>";

$itmqry=mysql_query("select * from item_details where item_code='$barc[$i]'");

// $t4=mysql_query("insert into approval_detail(bill_id,item_id,qty,discount,dis_amount,amount,item_per) values('$rowordno[0]','$design[$i]','$prz[$i]','$ds','$p','$sum','$itemper')");

$itmrow=mysql_fetch_row($itmqry);

 // echo $p." / ". $sum."<br/>";
  ?>
  <tr height="20">
  <td><font size="2" ><?php echo $j++; ?></font></td>
    <td align="center"><font size="2" ><b><?php echo $design[$i]; ?></b></font></td>
    <td align="center"><font size="2" ><b><?php echo $itmrow[1]; ?></b></font></td>
    <td align="center"><font size="2" ><b><?php echo $itmrow[2]; ?></b></font></td>
    <td align="center"><font size="2" ><b><?php echo $itmrow[3]; ?></b></font></td>
    <td align="center"><font size="2" ><b><?php echo $gwr[$i]; ?></b></font></td>
    <td align="center"><font size="2" ><b><?php echo $itmrow[4]; ?></b></font></td>
    <td align="center"><font size="2" ><b><?php echo $dwr[$i]; ?></b></font></td>    
    <td align="center"><font size="2" ><b><?php echo $mkr[$i]; ?></b></font></td>    
     <td align="center"><font size="2" ><b><?php $total+=$prz[$i]; echo round($prz[$i],2); ?></b></font></td>
  </tr> <?php }
	 $vat=round(($total-$dis)*0.012,2);
	 $netamt=$total-$dis+$vat;
	 while($j<=18){
	  ?><tr height="20"></tr><?php $j++; } ?>    	
<tr>
<td colspan="6"><font size="2" ><b>Total Rupees : <?php echo convert_number_to_words($netamt)." only"; ?></b></font></td>
<td colspan="2"><font size="2" ><b>Net Amount:</b><br /><br /><b>Discount :</b><br /><br /><b>VAT (1.2%):</b><br /><br /><b>Total Amount:</b></font></td>
         <td colspan="2" align="right"><font size="2" ><b><?php echo $total;  ?></b><br><br><b><?php echo $dis;  ?></b><br><br><b>
		 <?php echo $vat;  ?></b><br><br><b><?php  echo $netamt;  ?></b><br><br></font></td></tr>
</tr>
</table></font>

    
    </td>
    </tr>
     <tr><td>    
    <span style="font-size:10px;">I/We hereby certify that my/our Registration certificate under the Maharashtra Value Added tax Act 2002 is in force on the date on which the sale specified in this invoice
    is made by me/us and that the transaction of sale covered by this tax Invoice has been effected by me/us and it shall be accounted for in the turnover of sales while filling of Return 
    and subject to Mumbai Jurisdiction.</span>         
    

  <hr/>
  <table width="784" border="0">
  <tr>
    <td width="419" valign="top"><ul>
      <li ><font size="2">VAT TIN NO.: 27641156905V </font></b></li>
      <li> <font size="2">CST TIN NO.: &nbsp;27641156905C </font></li></ul></td>

    <td width="355" valign="top"align="right">
               E & O.E.
      <br/>
      <font>For Mulakaat Jewels Pvt. Ltd.</font>&nbsp;</td>
  </tr>
  <tr>
    <td width="419" valign="top">
    <table width="419" border="1"><tr>
      <td><font size="2">Verified & Received</font></td></tr>
      <tr><td><font size="2">Signature Of Receiver</font></td></tr>
      <tr><td> <font size="2">Mobile No.</font></td></tr>
      </table></td>

    <td width="355" valign="top"align="right">
               
      <br/>
      <font></font>&nbsp;</td>
  </tr>
  <tr>
    <td width="419" valign="top"><ul>
      <!--<li ><font size="2">Subject to Mumbai jurisdiction</font> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font size="2">E. & O . E</font></b></li>-->
      <!--<li> <font size="2">Time 11 a.m. to 6 p.m.</font></li>--></ul></td>

    <td width="355" valign="top"align="right">
               <p></p>
      <!--<img src="shringaar.png" width="163" height="57"/>-->
      <br/>
      <font>Authorised Signatory</font>&nbsp;</td>
  </tr>
</table>

  </td></tr>
</table>

</div><br/><br/><div id="pageNavPosition"></div>
<center><a href="#" onclick='PrintDiv();'>Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://localhost/accounts/sales/wholesaleinvoice.php">Back</a></center>

</body>
</html><?php  //echo $t1."-".$t2."-".$t3."-".$t4; 
//}
if($d>0){
if($t2 && $t3 && $t4){
	mysql_query("COMMIT;");
	}
	else{
	      
		mysql_query("ROLLBACK;");
		echo "<script> rollback(); </script>";
		} 
	}
	else
	mysql_query("COMMIT;");
	?>