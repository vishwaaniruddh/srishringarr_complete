<?php 
require('config.php');
$item= $_GET['item_id'];
$frmdate=$_GET['frmdate'];
$todate=$_GET['todate'];
if($frmdate==""){
$qryitems=mysql_query("select * from `approval_detail` where `item_id`='$item' and `bill_id` in( select bill_id from approval where status='s' )	 ");
}
else
{
$qryitems=mysql_query("select * from `approval_detail` where `item_id`='$item' and `bill_id` in( select bill_id from approval where status='s' and (`bill_date` between STR_TO_DATE('".$frmdate."','%d/%m/%Y') and STR_TO_DATE('".$todate."','%d/%m/%Y')) )	 ");	
}
echo "<table align='center' border='1' width='80%'><tr><th align='center' colspan='7'> Item Name : $item </th></tr>";
echo "<tr><th>Sr No.</th><th> Customer Name</th><th>Phone No.</th><th>Bill No</th><th>Bill Date</th><th>Qty</th><th>Amount</th></tr>";
$i=0;
while($resitems=mysql_fetch_row($qryitems))
{
		$resbill=mysql_fetch_row(mysql_query("select `cust_id`,`bill_date` from `approval` where bill_id ='$resitems[0]' "));
		$rescust=mysql_fetch_row(mysql_query("Select * from `phppos_people` where `person_id`='$resbill[0]'"));
		
echo "<tr><td align='center'>".++$i."</td><td>".$rescust[0]."-".$rescust[1]."</td><td>".$rescust[2]."</td><td align='center'>".$resitems[0]."</td><td align='center'>  ".date('d/m/Y',strtotime($resbill[1]))."</td><td align='right'>".$resitems[2]."</td><td align='right'>".$resitems[7]."</td></tr>";	
}
echo "</table>";
?>