<?php
$path_to_root="..";
$page_security = 'SA_OPEN';
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/data_checks.inc");
include_once($path_to_root . "/includes/ui.inc");
global $db, $transaction_level, $db_connections;

/*$con = mysql_connect("localhost","satyavan_accounts","Ritesh123*");
              mysql_select_db("satyavan_accounts",$con);*/
           $sid=$db_connections[$_SESSION["wa_current_user"]->company]['tbpref'];
$cid=substr($sid,0,-1);
 //echo $cid;
 $transno=$_GET['transno'];
 $desc=array();
 
function mb_abs($number) 
{ 

  return str_replace('-','',$number); 
} 

$cnt=0;

$t28=0;
$t42=0;$t44=0;$t46=0;
$qry=mysql_query("select * from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10'");
$row=mysql_fetch_row($qry);
$qry2=mysql_query("select * from ".$cid."_debtor_trans_details where debtor_trans_no='".$transno."' and debtor_trans_type='10'");
while($row2=mysql_fetch_row($qry2))
{

$item=split('-',$row2[4]);
$item=trim($item[0]);

if (in_array($item, $desc))
{
//echo "match found<br>";
}
else
{
$desc[]=$item;

}



}
//echo print_r($desc);

 $debt=mysql_query("select * from ".$cid."_debtors_master where debtor_no=(select debtor_no from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10')");
$debtro=mysql_fetch_row($debt);
//print_r($desc);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
.cenr{text-align:center;}
h1,h2,h3,h6,h5,h4{text-align:center; vertical-align:top; line-height:1em;}
p{text-align:left; font-size:14px;}
div span b{text-align:center; v:top;}

table{border:px solid #F00; width:90%;; margin-left:auto; margin-right:auto; border-collapse:collapse;}
table tr td{border:1px solid #333; padding:5px; }
background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;
.td_bg_col{background-color:#CCC;}
img{}
p span{font-size:14px; text-align:center;}

th{background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;}

</style>

</head>

<body>
<table>
<caption align="bottom"><div class="cenr"><b>SUBJECT TO MUMBAI JURISDICTION <br />This is a computer Generaterd Invoice </b></div></caption>

<thead>
<tr>
<th colspan="10"> <h1>SCOT APPARELS</h1></th>
</tr>
</thead>

<tbody>
<tr><td colspan="10"><div class="cenr"><b>Gala No F-12,Plot No.1,Pankaj Building Behind Ice Factory, Chandivali, Off Saki Vihar Road Andheri(East)Mumbai 400072    Telno: (022) 28573254</b></div></td></tr>
<tr><td colspan="10"><div class="cenr"><b>TAX INVOICE</b></div></td></tr>
<tr><td colspan="5"><div class="cenr">VAT TIN NO.:- <b>27310272202V w.e.f 1.4.2006</b></div></td>
   <td colspan="5"><div class="cenr">CST NO.:- <b>27310272202V w.e.f 1.4.2006</b></div></td></tr>
            


<tr><td  colspan="6" valign="top" ><div class="cenr"><b> Name & Address of Consignee</b><br /><?php echo $debtro[1]."<br>".$debtro[3]; ?></div></td> 

<td colspan="4">
<table>
<tr><td colspan="2"><b>Tax Invoice No. <?php echo $transno; ?></b></td> <td><b>Date</b></td></tr>
<tr><td colspan="2"><b>Challan No. <?php echo date("dmY",strtotime($row[5])); ?></b></td> <td><b>Date</b></td></tr>
<tr><td colspan="2"><b>L.R.R.No.</b></td> <td><b>L.R.Date</b></td></tr>

<tr><td colspan="3"><b>Destination</b></td></tr>
<tr><td colspan="3"><b>espatached throught:-</b></td></tr>
<tr><td colspan="3"><b>AGENT:-</b></td></tr>
</table>
</td>
</tr>

<tr><td colspan="10"><b>TIN N :-</b></td></tr>

<tr><td width="5%"><p>Sr.No.</b></td><td width="15%"><b> &nbsp;&nbsp;&nbsp;&nbsp;</b></td><td width="10%" align="center"><b>28To40</b></td><td width="10%" align="center"><b>42</b></td><td width="10%" align="center"><b>44</b></td><td width="10%" align="center"><b>46-50</b></td><td width="10%" align="center"> <b>Total Quantity</b></td><td width="10%" align="center"><b>MRP Per PC</b></td><td width="10%" align="center"><b>Rate Per PC</b></td><td width="10%" align="center"><b>Amount</b></td></tr>

<?php
$mrp=0;
$rate=0;
$amt=0;
$i=0;
$finaldis=0;
//echo count($desc);
for($i=0;$i<count($desc);$i++)
{
$s28=0;
$s42=0;$s44=0;$s46=0;
$mp=0;$rt=0;$at=0;
$dis=0;
$j=0;
//echo "select * from ".$cid."_debtor_trans_details where description like '".$desc[$i]."%'";
$qry2=mysql_query("select * from ".$cid."_debtor_trans_details where description like '".$desc[$i]."%' and debtor_trans_no ='".$transno."'");
while($row2=mysql_fetch_row($qry2))
{

//$i=$i+1;
$qry3=mysql_query("select * from ".$cid."_item_codes where stock_id='".$row2[3]."'");
$row3=mysql_fetch_row($qry3);
//echo $row3[3];
$item=split('-',$row3[3]);
//echo $item[0]." =====".$item[1];
?>

<?php  
//echo $item[1]."<br> ";
if($item[1]>='28' && $item[1]<='40')
 {
 $s28=$s28+$row2[7]; 
 $t28=$t28+$row2[7];
 $j=$j+$row2[7];
 } 
  
 if($item[1]=='42')
 { $s42=$s42+$row2[7]; 
 $t42=$t42+$row2[7];
 $j=$j+$row2[7];
 }   
 if($item[1]=='44')
 { $s44=$s44+$row2[7]; 
  $t44=$t44+$row2[7];
  $j=$j+$row2[7];
 }
    
 if($item[1]>='46' && $item[1]<='50')
 { $s46=$s46+$row2[7]; 
 $t46=$t46+$row2[7];
 $j=$j+$row2[7];
 }   
  $mp=$row2[5]; //echo  number_format(($row2[5]), 2, '.', ',');
 $mrp=$mrp+$row2[5];
   $rt=$row2[5]; //echo number_format(($row2[5]), 2, '.', ',');
 $rate=$rate+$row2[5];
   $at=$j*$row2[5]; //echo number_format((($j*$row2[5])), 2, '.', ',');
 $finaldis=$finaldis+($row2[5]*($row2[8]/100.00));
  
}
$amt=$amt+$at;
?>
<tr><td><?php echo $i+1; ?></td><td><?php echo $desc[$i]; ?></td><td align="center"><?php echo $s28; ?></td><td align="center"><?php echo $s42; ?></td><td align="center"><?php echo $s44; ?></td><td align="center"><?php echo $s46; ?></td>
<td align="center"><?php echo $j; ?></td>
<td align="right"><?php echo $mp; ?></td><td align="right"><?php echo $rt; ?></td><td align="right"><?php echo $at; ?></td>
</tr>
<?php
}
?>
<tr><td height="200"><b></b></td><td><b> &nbsp;&nbsp;&nbsp;&nbsp;</b></td><td><b></b></td><td><b></b></td><td><b></b></td><td><b></b></td><td><b></b></td><td><b></b></td><td><b></b></td><td><b></b></td></tr>

<tr><td colspan="2"><b> Total(a)</b></td><td align="center"><b><?php echo $t28; ?></b> </td><td align="center"><b><?php echo $t42; ?></b></td><td align="center"><b><?php echo $t44; ?></b></td><td align="center"><b><?php echo $t46; ?></b></td>
<td align="center"><b><?php echo $t28+$t42+$t44+$t46; ?></b></td><td><b><?php //echo $mrp; ?></b></td><td><b><?php //echo $finaldis; ?></b></td><td align="right"><b><?php echo number_format(($amt), 2, '.', ','); ?></b></td></tr>

<tr><td colspan="8"><b>NOTE</b></td><td><b>Total(a)</b></td><td align="right"><b><?php echo number_format(($amt), 2, '.', ','); ?></b></td></tr>

<tr><td colspan="2"><b>Amount Chargeable(In words)</b></td><td colspan="6"><b>Rupees <?php

include('wordtonumber.php');
$amt=$amt-$finaldis;
 $vat=(($amt*0.05));
$gtot=($amt+$vat);
echo convert_number_to_words($gtot);
?> only</strong></b></td><td><b>Discount(a)</b></td><td align="right"><b><?php echo number_format(($finaldis), 2, '.', ','); ?></b></td></tr>

<tr><td colspan="2"><b>Company's Account In:-</b></td><td colspan="2">AXIS BANK LTD</td><td colspan="3">Branch:- Andheri (East),Mumbai</td><td colspan="2">Gross Amount</td><td colspan="0" align="right"><b><?php echo number_format(($amt), 2, '.', ','); ?></b></td></tr>
<tr><td colspan="2"><p><strong>Account No.</strong></p></td><td colspan="2"><b>328010200005753</b></td><td colspan="3"><b>IFSC CODE-UTIB0000328</b></td><td colspan="2"><b>Vat/C.S.T@5%</b></td><td colspan="0" align="right"><b><?php 
echo number_format(($vat), 2, '.', ',');
 ?></b></td></tr>
<tr><td colspan="7"><b>All Payment by CROSSED CHEQUE/DRAFT in favour of "SCOT APPARELS" <br /> We Declare that this Invoice Shows the actual price of the goods described and that all particulars are true & correct</b></td>
<td colspan="2"><b>Grand Total :</b></td>
<td align="right"><b><?php  
echo number_format(($gtot), 2, '.', ',');
 ?></b></td> 
</tr>

<tr><td colspan="7">
<b>Declarations</b><br />
"I/We hereby certify that my/our registration certificate under Maharashtra Value Added Tax Act,2002 is in force on the date on which the sales of the goods 
specified in this tax invoice is made by me/us and that the transaction of sale covered by this tax invoice has been effected by me/us in the
 turnover of sales while filing of return and due tax if any payable on the sales has been paid or shall be paid"

</td>
<td colspan="3"><div class="cenr"><b>For SCOT APPARELS<br /><br /><br /><br />Authorised Signatory</b></div></td></tr>
</tbody>



</table>

</body>
</html>


