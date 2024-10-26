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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
<HEAD>
	
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=utf-8">
	<TITLE></TITLE>
	
	
	<STYLE>
		<!-- 
		BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Arial"; font-size:x-small }
		 -->
	</STYLE>
	
</HEAD>

<BODY TEXT="#000000">
<TABLE CELLSPACING="0" COLS="7" BORDER="0">
	<COLGROUP WIDTH="303"></COLGROUP>
	<COLGROUP WIDTH="88"></COLGROUP>
	<COLGROUP SPAN="2" WIDTH="75"></COLGROUP>
	<COLGROUP WIDTH="90"></COLGROUP>
	<COLGROUP WIDTH="82"></COLGROUP>
	<COLGROUP WIDTH="110"></COLGROUP>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3>TAX INVOICE</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
<?php $pieces = explode(" ", $debtro[3]); ?>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>TO,</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $pieces[0].' '.$pieces[1].' '.$pieces[2].' '.$pieces[3].' '.$pieces[4]; ?></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>INVOICE NO.         :</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $transno; ?></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $pieces[5].' '.$pieces[6].' '.$pieces[7].' '.$pieces[8]; ?>  </FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>INVOICE DATE      :</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDVAL="41830" SDNUM="16393;0;DD/MM/YYYY"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $row[5]; ?></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $pieces[9].' '.$pieces[10].' '.$pieces[11]; ?></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="20" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $pieces[12].' '.$pieces[13].' '.$pieces[14].' '.$pieces[15]; ?></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;DD/MM/YYYY"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
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
 //echo "select `long_description` from `14_stock_master` where `stock_id`='".$row2[6]."'";
$des=mysql_query("select `long_description`,`dimension_id`,`tax_type_id`,`units` from `14_stock_master` where `stock_id`='".$row2[6]."'");
$des1=mysql_fetch_row($des);
//echo "dis=".$des1[0];

$dimen=mysql_query("select `name` from `14_dimensions` where `id`='".$des1[1]."'");
$dimen1=mysql_fetch_row($dimen);
 
?>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="33" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3>Description</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3>Batch No.</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3>Expiry Dt.</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3>M.R.P. </FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3>Quantity</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3>Rate </FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3>Amount (in Rs.)</FONT></B></TD>
	</TR>



	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="24" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3>Total Amt.</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3>Per unit</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" VALIGN=MIDDLE><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="20" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $row2[5]; ?></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $des1[0]; ?></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;MM/YY"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $dimen1[0]; ?></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDVAL="75" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $row2[1]; ?></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDVAL="500" SDNUM="16393;0;0;[RED]0"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $row2[2]; ?></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDVAL="58.85" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><?php $tot=$row2[1]*(1-$row2[8]); echo $tot; ?></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDVAL="29425" SDNUM="16393;0;#,##0.00;[RED]#,##0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo $row2[2]*$tot; ?></FONT></B></TD>
	</TR>
	
	<TR>
		<TD STYLE="border-right: 1px solid #1a1a1a" HEIGHT="17" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>FREE</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;MM/YY"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>10X10'S PENTAMED TAB.40MG.</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3>MNT/608</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;MM/YY"><B><FONT FACE="Bookman Old Style" SIZE=3>FEB'16</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0;[RED]0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDNUM="16393;0;#,##0.00;[RED]#,##0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>9X100ML COFCURE EXPECT.</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3>MNL/263</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;MM/YY"><B><FONT FACE="Bookman Old Style" SIZE=3>FEB'16</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><FONT FACE="Times New Roman" SIZE=3><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3> SUB TOTAL : </FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDVAL="64663.8" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3> <?php echo $row2[2]*$tot; ?>  </FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>9X100ML COFCURE EXPECT.</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3>MNL/263</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;MM/YY"><B><FONT FACE="Bookman Old Style" SIZE=3>FEB'16</FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><FONT FACE="Times New Roman" SIZE=3><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3> LESS : DISC. 10%  </FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDVAL="6466.38" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo  $row2[2]*$tot*0.1;  ?></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><FONT FACE="Times New Roman" SIZE=3><BR></FONT></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3> SUB TOTAL : </FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDVAL="58197.42" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo ($row2[2]*$tot)-($row2[2]*$tot*0.1); ?></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="21" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman" SIZE=3><BR></FONT></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3> VAT </FONT></B></TD>
<?php 
$vat=mysql_query("select `name` from `14_item_tax_types` where `id`='".$des1[2]."'");
$vat1=mysql_fetch_row($vat);

?>
		<TD ALIGN="RIGHT" SDVAL="0.05" SDNUM="16393;0;0.00%"><B><FONT FACE="Bookman Old Style" SIZE=3><?php echo number_format($vat1[0],2); ?></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDVAL="2909.871" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3> <?php echo $vat1[0]; ?></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="23" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;MM/YY"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="CENTER" SDNUM="16393;0;0.00;[RED]0.00"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman" SIZE=3><BR></FONT></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><FONT FACE="Bookman Old Style" SIZE=3> GRAND TOTAL : </FONT></B></TD>
		<TD STYLE="border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="RIGHT" SDVAL="61107.291" SDNUM="16393;0;_(* #,##0.00_);_(* \(#,##0.00\);_(* &quot;-&quot;??_);_(@_)"><B><U><FONT FACE="Bookman Old Style" SIZE=3> 61,107.29 </FONT></U></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>RUPEES SIXTY ONE THOUSAND ONE HUNDRED SEVEN AND PAISE TWENTY NINE ONLY.</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
<?php
  $cnt++; 
	}
	
}
?>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="22" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>Goods sent through : HAND DELIVERY</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>To : MUMBAI</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>Documents through : DIRECT</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>No.of packages:</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="20" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="20" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>Purchaser's Drug Lic.  Nos.</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>Purchaser's Registration Nos.</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="18" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>20 B ZONE 3/11/818</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>VAT / CST TIN No.</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="19" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>21 B ZONE 3/11/818</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3>27030361014V/27030361014C</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="20" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT" SDNUM="16393;0;0"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="26" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>D.L. No. 20 B CZ - 4/1551 Dt. 21-4-2011</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>VAT TIN 27440080119 V w.e.f. 1-4-06</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="20" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>D.L. No. 21 B CZ - 4/1437 Dt. 21-4-2011</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>CST TIN 27440080119 C w.e.f. 1-4-06</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="22" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="25" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>General warranty u/s 19(3) of the Drugs Acts, 1940</FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="22" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>We do hereby give the warranty that the goods herein described are sold by us &amp; do not </FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="22" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>contravene any way the provision of section 18 of the Drugs Act, 1940</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="17" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="24" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>I / we here by certify that my/our Registration certificate under the Maharashtra </FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-top: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>Value Added Tax Act, 2002 is in force on the  date on which the sale of the goods specified </FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="23" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>in this Tax invoice is made by me / us and that the transaction of sale covered </FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>by this Tax Invoice has been effected by me / us.</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>  For EVERCURE PHARMACEUTICALS</FONT></B></TD>
		<TD ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="24" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>subject to Mumbai Jurisdiction</FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
	<TR>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-left: 1px solid #1a1a1a" HEIGHT="21" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3>Interest @ 24% p.a. will be charged on the due accounts</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><FONT FACE="Times New Roman"><BR></FONT></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style">        Proprietor/Authorised Signatory</FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
		<TD STYLE="border-bottom: 1px solid #1a1a1a; border-right: 1px solid #1a1a1a" ALIGN="LEFT"><B><FONT FACE="Bookman Old Style" SIZE=3><BR></FONT></B></TD>
	</TR>
</TABLE>
<!-- ************************************************************************** -->
</BODY>

</HTML>