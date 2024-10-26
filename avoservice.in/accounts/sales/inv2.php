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
//echo "select * from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10'";
$qry=mysql_query("select * from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10'");
$row=mysql_fetch_row($qry);
$cat=array();
//echo "select distinct(i.category_id),c.description from ".$cid."_stock_category c,".$cid."_debtor_trans_details t,".$cid."_item_codes i where i.stock_id=t.stock_id and c.category_id=i.category_id and t.debtor_trans_type='10' and t.debtor_trans_no='".$transno."'";
$qry2=mysql_query("select distinct(i.category_id),c.description from ".$cid."_stock_category c,".$cid."_debtor_trans_details t,".$cid."_item_codes i where i.stock_id=t.stock_id and c.category_id=i.category_id and t.debtor_trans_type='10' and t.debtor_trans_no='".$transno."'");
while($row2=mysql_fetch_row($qry2))
{

$cat[]=$row2[0];
$desc[]=$row2[1];

}
$catogory=array();

//$cat=mysql_query("select c.description from ".$cid."_stock_category c,".$cid."_debtor_trans_details t,".$cid."_item_codes i where i.stock_id=t.stock_id and c.category_id=i.category_id and t.debtor_trans_type='10' and t.debtor_trans_no='".$transno."'");

//echo print_r($desc);
//sort($desc);
//echo "select * from ".$cid."_debtors_master where debtor_no=(select debtor_no from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10')";
 $debt=mysql_query("select * from ".$cid."_debtors_master where debtor_no=(select debtor_no from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10')");
$debtro=mysql_fetch_row($debt);
//echo "select tax_group_id from ".$cid."_cust_branch where debtor_no='".$debtro[0]."'";
$tax=mysql_query("select tax_group_id from ".$cid."_cust_branch where debtor_no='".$debtro[0]."'");
$taxro=mysql_fetch_row($tax);
//echo "select factor from ".$cid."_sales_types where id='".$debtro[6]."'";
$stype=mysql_query("select factor from ".$cid."_sales_types where id='".$debtro[6]."'");
$stypero=mysql_fetch_row($stype);
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

.mytable table tbody{border:1px solid #F00; width:90%;; margin-left:auto; margin-right:auto; border-collapse:collapse;}
.mytable table tbody tr td{border:1px solid #333; padding:5px; }
background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;
.td_bg_col{background-color:#CCC;}
img{}
p span{font-size:14px; text-align:center;}

#mytable th{background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;}
.tab{
    padding: 0 110px 0 0; /* Or desired space*/
}
</style>
</head>

<body>
<table class="mytable" border="1" style="border-collapse:collapse">
<tbody>

<tr>
<td  colspan="4" valign="top" ><div class="cenr">
<h2> SAVERA </h2> <h2>  ENTERPRISES</h2>
  <hr />
<p style="float:left"><pre>
SHOP/116 GAGAN MARVEL CO-OP, 
HOUSING SOCIETY LTD, VASANT,
NAGARI NALASOPARA LINK ROAD,
VASAI (E),Phone 07710005573.
</pre></p></div></td> 

<td  colspan="3" valign="top" >
<div class="cenr"><b> TO,</b><br /><?php echo $debtro[1]."<br>".$debtro[3]; ?>
<hr />
<p> <!--DL No.MH-T23786754,DL No.MH-T23786754,DL No.MH-T23786754--></p>
</div></td> 

<td colspan="3">
<table width="100%" class="mytable" style="border-collapse:collapse;">
<tr><td colspan="2"><b>Tax Invoice No :  <?php echo $transno  ;  ?></b></td> </tr>
<tr><td colspan="2"><b>Invoice Date : <?php echo date("dmY",strtotime($row[5])); ?></b></td> </tr>


<tr><td colspan="3"><b>Due Date :</b></td></tr>
<tr><td colspan="3"><b>Sales Rep: </b></td></tr>

</table >
</td>
</tr>



<tr>
<td width="5%"><b>CODE</b></td>
<td width="5%"><b> QTY</b></td>
<td width="8%" align="center"><b>PKG</b></td>
<td width="25%" align="center"><b>PRODUCT NAME</b></td>
<td width="10%" align="center"><b>EXP.</b></td>
<td width="10%" align="center"><b>BATCH.</b></td>
<td width="10%" align="center"> <b>M.R.P.</b></td>
<td width="10%" align="center"><b>RATE</b></td>
<td width="10%" align="center"><b>VAT</b></td>
<td width="10%" align="center"><b>Amount</b></td>
</tr>

<?php
$mrp=0;
$rate=0;
$amt=0;
$i=0;
$finaldis=0;
$finaldis=$row[12];
//echo count($desc);
$cnt=0;
for($i=0;$i<count($desc);$i++)
{
$s28=0;
$s42=0;$s44=0;$s46=0;
$mp=0;$rt=0;$at=0;
$dis=0;
$j=0;
//echo "select t.description,t.unit_price,t.quantity,t.unit_price,t.stock_id from ".$cid."_debtor_trans_details t,".$cid."_item_codes c where  t.debtor_trans_no ='".$transno."' and t.debtor_trans_type ='10' and t.stock_id =c.stock_id and c.category_id='".$cat[$i]."' order by t.description,c.category_id ASC";

$qry2=mysql_query("select t.description,t.unit_price,t.quantity,t.unit_price,t.stock_id,c.description,c.item_code,t.quantity,t.discount_percent from ".$cid."_debtor_trans_details t,".$cid."_item_codes c where  t.debtor_trans_no ='".$transno."' and t.debtor_trans_type ='10' and t.stock_id =c.stock_id and c.category_id='".$cat[$i]."' order by t.description,c.category_id ASC");
//echo mysql_num_rows($qry2);
$cnt=0;
while($row2=mysql_fetch_row($qry2))
{
//echo "<br>select price from ".$cid."_prices where stock_id='".$row2[3]."' and sales_type_id='1'";
//$mrp=mysql_query("select price from ".$cid."_prices where stock_id='".$row2[3]."' and sales_type_id='1'");
//$mrp2=mysql_fetch_row($mrp);

$item=split('-',$row2[0]);

?>

<?php  
//echo $item[1]."<br> ";
if($item[1]>='28' && $item[1]<='40')
 {
 //echo $row2[7]."-";
  $s28=$s28+$row2[2]; //echo "-";
 $t28=$t28+$row2[2];
 $m28=$row2[3];
 $r28=$row2[1];
 $at=$at+($row2[2]*$r28);
//echo "<br>";
 } 
  
 if($item[1]=='42')
 { 
 //echo $row2[7]."-";
  $s42=$s42+$row2[2]; //echo "-";
 $t42=$t42+$row2[2];
 $m42=$row2[3];
 $r42=$row2[1];
 $at=$at+($row2[2]*$r42);
//echo "<br>";
 }   
 if($item[1]=='44')
 { 
 //echo $row2[7]."-";
  $s44=$s44+$row2[2]; //echo "-";
  $t44=$t44+$row2[2];
  $m44=$row2[3];
  $r44=$row2[1];
 $at=$at+($row2[2]*$r44);
//echo "<br>";
 }
    
 if($item[1]>='46' && $item[1]<='50')
 { 
 //echo $row2[7]."-";
 $s46=$s46+$row2[2]; //echo "-";
 $t46=$t46+$row2[2];
 $m46=$row2[3];
 $r46=$row2[1];
 $at=$at+($row2[2]*$r46);
//echo "<br>";
 }   
  $mp=$row2[4]; //echo  number_format(($row2[5]), 2, '.', ',');
 $mrp=$mrp+$row2[3];
   $rt=$row2[2]-((1-$stypero[0])*$row2[1]); //echo number_format(($row2[5]), 2, '.', ',');
 $rate=$rate+$rt;
   //$at=$j*$row2[5]; //echo number_format((($j*$row2[5])), 2, '.', ',');
   //$at=$j*$rt;
 //$finaldis=$finaldis+($row2[5]*$row2[8]);
  

//echo "<br>";
  //$at=$a28+$a42+$a44=$a46;
 $amt=$amt+$at; //echo $amt."-".$at."<br>";
 
 
?>
<tr>
<?php 
//echo "select `long_description` from `14_stock_master` where `stock_id`='".$row2[6]."'";
$des=mysql_query("select `long_description`,`dimension_id`,`tax_type_id`,`units` from `14_stock_master` where `stock_id`='".$row2[6]."'");
$des1=mysql_fetch_row($des);
//echo "dis=".$des1[0];

$dimen=mysql_query("select `name` from `14_dimensions` where `id`='".$des1[1]."'");
$dimen1=mysql_fetch_row($dimen);
?>
<!--code no-->
<td><?php echo $row2[6]; ?></td>
<!--Qty-->
<td><?php echo $row2[2]; ?></td>
<!--package-->
<td align="center"><?php echo $des1[3]; ?></td>
<!--Poduct name-->
<td align="center"><?php echo $row2[5]; ?></td>
<!--Expr -->


<td align="center"><?php echo $dimen1[0]; ?></td>
<!--Batch -->

<td align="center"><?php echo $des1[0]; ?></td>
<!--MRP-->
<td align="center"><?php echo $row2[1]; ?></td>
<!--Rate-->
<td align="right"><?php 
//echo $row2[7]."<br>"; //qty
//echo  $tdis=$row2[8]."<br>"; //discount
//echo $row2[1]."<br>"; //tamout

$tot=$row2[1]*(1-$row2[8]);
echo $tot ?></td>
<!--Vat-->
<td align="right">
<?php 
$vat=mysql_query("select `name` from `14_item_tax_types` where `id`='".$des1[2]."'");
$vat1=mysql_fetch_row($vat);
echo number_format($vat1[0],2); ?></td>

<!--Amount-->
<td align="right"><?php echo number_format($amt=$row2[7]*$tot , 2, '.', ',');   $totamt+=$amt ;  $vatamt+=$amt*$vat1[0]/100; ?></td>
</tr>



<?php
  $cnt++; 
	}
	
}
?>

<!--<tr>
<td colspan="2"><b> Total(a)</b></td>
<td align="center"><b><?php echo $t28; ?></b> </td>
<td align="center"><b><?php echo $t42; ?></b></td>
<td align="center"><b><?php echo $t44; ?></b></td>
<td align="center"><b><?php echo $t46; ?></b></td>
<td align="center"><b><?php echo $t28+$t42+$t44+$t46; ?></b></td>
<td><b><?php //echo $mrp; ?></b></td><td><b><?php //echo $finaldis; ?></b></td>
<td align="right"><b><?php echo number_format(($amt), 2, '.', ','); ?></b></td>
</tr>-->







 
<tr><td colspan="7"> 
<table width="100%" style="border-collapse:collapse;" class="mytable"><tr>
<td width="50%"><br /><br /><br /><br />

<b>Customer Sign & Stamp.</b></td>  
<td width="25%">
<!--<p>Dr.No:</p> 
<p>Dr.Amount:</p>
<p>Total Qty:</p>
<p>No.of Prod:</p>-->
</td>  
<td width="25%">
<!--<p>SCH Amount.</p> 
<p>CD Amt :</p>
<p>CN Ref :</p>
<p>CNAmt  :</p>-->
</td> 
</tr>
</table></td>

<td colspan="3">

<p><b>Gross Amt :</b> <b><b><?php echo number_format(($totamt), 2, '.', ','); ?></b></b></p>
<!--<p><b>Less Amt :</b> <b><?php  ?></b></p>-->
<!--<p><b>Add Amt :</b> <b><?php  ?></b></p>-->
<p><b>VAT Amt :</b> <b>
<?php echo  $vatamt ; ?>
</b></p>
<p><b>To Pay Amt :</b> <b><?php echo number_format(($totamt+$vatamt), 2, '.', ','); ?></b></p>


</td>


 
</tr>

<tr><td colspan="7">
<br /><br />

<b class="tab">Prep. By</b>  <b class="tab">Pckd. By</b>  <b class="tab">Chkd. By</b> <b class="tab">Delv. By</b> <b >E.& O.E.</b>

</td>
<td colspan="3"><div class="cenr"><b>For SAVERA  ENTERPRISES <br /><br />Authorised Signatory</b></div></td></tr>
</tbody>



</table>

</body>
</html>



