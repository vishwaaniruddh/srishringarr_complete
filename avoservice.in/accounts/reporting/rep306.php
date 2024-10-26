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
$qry=mysql_query("select * from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10'");
$row=mysql_fetch_row($qry);
$desc=array();

$s28=0;
$s30=0;
$s32=0;
$s34=0;
$s36=0;
$s38=0;
$cnt=0;
$s40=0;$s42=0;$s44=0;$s46=0;$s48=0;$s50=0;
$t28=0;
$t30=0;
$t32=0;
$t34=0;
$t36=0;
$t38=0;
$ct=0;
$stock=array();
//$item=array();
$t40=0;$t42=0;$t44=0;$t46=0;$t48=0;$t50=0;
$qry2=mysql_query("select * from ".$cid."_stock_master");
while($row2=mysql_fetch_row($qry2))
{

$item=split('-',$row2[0]);
$item=trim($item[0]);
$st=split('-',$row2[3]);
$stck=trim($st[0]);
if (in_array($stck, $desc))
{
//echo "match found<br>";
}
else
{
$desc[]=$stck;
 $stock[]=$item;
}



}

//echo count($desc);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Stock List</title>
<style>
.cenr{text-align:center;}
h1,h2,h3,h6,h5,h4{text-align:center; vertical-align:top;}
p{text-align:center; font-size:14px;}
div p{text-align:center; vertical-align:central;}

table{border:px solid #F00; width:90%;; margin-left:auto; margin-right:auto; border-collapse:collapse;}
table tr td{border:1px solid #333; padding:0px; }

.td_bg_col{background-color:#CCC;}
img{}
p span{font-size:14px; text-align:center;}

th{background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;}
background:url(red-cross14.png) left no-repeat scroll; height:10px; width:10px;

b{font-size:16px;}

ul li{list-style-type:decimal; list-style-position:outside;}

.bgimg{border:1px solid #000; border-radius:10px; height:50px; width:100px; margin-left:auto; margin-right:auto;}
</style>

</head>

<body>
<table>

<thead>
<tr><th colspan="16"><h1>SCOT APPARELS</h1></th></tr>
</thead>


<tbody>
<?php $debt=mysql_query("select * from ".$cid."_debtors_master where debtor_no=(select debtor_no from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10')");
$debtro=mysql_fetch_row($debt);
$debttrans=mysql_query("select * from ".$cid."_debtor_trans where trans_no='".$transno."' and type='10'");
$debttransro=mysql_fetch_row($debttrans);
//echo $debtro[1];
?>
<tr><td colspan="16"><div class="cenr"><b>Gala No F-12, Plot No.1, Pankaj Building Behind Ice Factory, Chandivali, Off Saki Vihar Road Andheri(East) Mumbai 400-072  Tel No:(022) 28573254</b></div></td></tr>
<tr><td colspan="16"><div class="cenr"> <b>Stock List</b></div></td></tr>

<tr><td colspan="10"><b></b></td>    
<td colspan="6"> </td></tr>

<tr><td colspan="10"> <b></b> <br /> <br /> AGENT:-CHETAN PAREKH</td>    <td colspan="6">Date: <b><?php echo date("d/m/Y"); ?></b> </td></tr>

<tr><td width="5%"><b>SR NO.</b></td><td width="10%"><b>Description</b></td><td width="10%"><b>Shade</b></td><td width="5%"><b>28</b></td><td width="5%"><b>30</b></td><td width="5%"><b>32</b></td><td width="5%"><b>34</b></td><td width="5%"><b>36</b></td><td width="5%"><b>38</b></td><td width="5%"><b>40</b></td><td width="5%"><b>42</b></td><td width="5%"><b>44</b></td><td width="5%"><b>46</b></td><td width="5%"><b>48</b></td><td width="5%"><b>50</b></td><td width="10%"><b>Total Quantity</b></td></tr>
<?php
$tot=0;
for($i=0;$i<count($stock);$i++)
{


//echo "Select description,long_description,stock_id from ".$cid."_stock_master where stock_id like '".$stock[$i]."%'";
$scot=mysql_query("Select description,long_description,stock_id from ".$cid."_stock_master where stock_id like '".$stock[$i]."%'");
while($scotro=mysql_fetch_row($scot))
{
//echo $scotro[2];
//echo "select sum(qty) from ".$cid."_stock_moves where stock_id='".$stock[$i]."-".$scotro[1]."'";
//$size=split("-",$scotro[1]);
//echo $size[0]." ".$size[1]."<br>";
$qr=mysql_query("select sum(qty) from ".$cid."_stock_moves where stock_id='".$stock[$i]."-".$scotro[1]."'");
$ro=mysql_fetch_row($qr);
if($scotro[2]=='102')
echo $ro[0]."<br>";
if($scotro[1]=='28')
{
$s28=$s28+$ro[0];
$t28=$t28+$ro[0];
}
if($scotro[1]=='30')
{
$s30=$s30+$ro[0];
$t30=$t30+$ro[0];
}
if($scotro[1]=='32')
{
 $s32=($s32+$ro[0]);
$t32=($t32+$ro[0]);
}
if($scotro[1]=='34')
{
$s34=$s34+$ro[0];
$t34=$t34+$ro[0];
}
if($scotro[1]=='36')
{
$s36=$s36+$ro[0];
$t36=$t36+$ro[0];
}
if($scotro[1]=='38')
{
$s38=$s38+$ro[0];
$t38=$t38+$ro[0];
}
if($scotro[1]=='40')
{
$s40=$s40+$ro[0];
$t40=$t40+$ro[0];
}
if($scotro[1]=='42')
{
$s42=$s42+$ro[0];
$t42=$t42+$ro[0];
}
if($scotro[1]=='44')
{
$s44=$s44+$ro[0];
$t44=$t44+$ro[0];
}
if($scotro[1]=='46')
{
$s46=$s46+$ro[0];
$t46=$t46+$ro[0];
}
if($scotro[1]=='48')
{
$s48=$s48+$ro[0];
$t48=$t48+$ro[0];
}
if($scotro[1]=='50')
{
$s50=$s50+$ro[0];
$t50=$t50+$ro[0];
}

}
//break;
?>
<tr><td width="5%"><b><?php echo $i+1; ?></b></td><td width="10%"><b><?php echo $scotro[1]."<br>".$desc[$i];  ?></b></td><td width="10%"><b><?php
$shade=split(" ",$desc[$i]);
 $sh=count($shade);
echo $shade[$sh-1];
/*for($k=count($shade);$k<=count($shade);$k--)
echo $shade[$k];*/
?>
</b></td><td width="5%"><b><?php echo $s28;  ?></b></td><td width="5%"><b><?php echo $s30;  ?></b></td><td width="5%"><b><?php echo $s32;  ?></b></td><td width="5%"><b><?php echo $s34; ?></b></td><td width="5%"><b><?php echo $s36; ?></b></td><td width="5%"><b><?php echo $s38; ?></b></td><td width="5%"><b><?php echo $s40; ?></b></td><td width="5%"><b><?php echo $s42; ?></b></td><td width="5%"><b><?php echo $s44; ?></b></td><td width="5%"><b><?php echo $s46; ?></b></td><td width="5%"><b><?php echo $s48; ?></b></td><td width="5%"><b><?php echo $s50; ?></b></td>
<td width="10%"><b><?php echo $s28+$s30+$s32+$s34+$s36+$s38+$s40+$s42+$s44+$s46+$s48+$s50;
 $tot=$tot+$s28+$s30+$s32+$s34+$s36+$s38+$s40+$s42+$s44+$s46+$s48+$s50;

 ?></b></td></tr>
<?php
$s28=0;
$s30=0;
$s32=0;
$s34=0;
$s36=0;
$s38=0;

$s40=0;$s42=0;$s44=0;$s46=0;$s48=0;$s50=0;
}

?>

<tr>


</tr>
<tr><td></td><td><b>Total:-</b></td><td><b></b></td><td><b><?php echo $t28; ?></b></td><td><b><?php echo $t30; ?></b></td><td><b><?php echo $t32; ?></b></td><td><b><?php echo $t34; ?></b></td><td><b><?php echo $t36; ?></b></td><td><b><?php echo $t38; ?></b></td><td><b><?php echo $t40; ?></b></td><td><b><?php echo $t42; ?></b></td><td><b><?php echo $t44; ?></b></td><td><b><?php echo $t46; ?></b></td><td><b><?php echo $t48; ?></b></td><td><b><?php echo $t50; ?></b></td><td><b><?php echo $tot; ?></b></td></tr>


<tr><td colspan="5"><p class="bgimg"><b>Prepared By</b></p></td><td colspan="5"><p class="bgimg"><b>Checked By</b></p></td><td colspan="6"><p class="bgimg"><b>Security Out</b></p></td></tr>

<tr><td colspan="16">
<b>Note:</b>
<ul>
<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It is requested that the Goods should be examined on delivery & Claims for any Shortage or Rejection should be notified immediately, failing to which no claimed would be entertained.Please return the duly signed & Stamped copy.</li>

<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Every care has been taken for discrepencies, however if any discrepencies\shortages found (either in Goods or in Invoice & Challan) should be notified within 24 hours of receipt of goods \ Invoice.	</li>

<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company"M\s Scot Apparels" reserves the right for entertaining the claim & such changes are at the Sole discretion of the company.	</li>
</ul>

</p>

</td></tr>
</tbody>
</table>


</body>
</html>