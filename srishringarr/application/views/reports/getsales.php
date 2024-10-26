<?php
include('config.php');
$frmdate=$_GET['frmdate'];
$todate=$_GET['todate'];
$frmdate=str_replace('/','-',$frmdate);
$todate=str_replace('/','-',$todate);
if($frmdate=="")
$frmdate=date('Y-m-d',strtotime('today'));
else
$frmdate=date('Y-m-d',strtotime($frmdate));
if($todate=="")
$todate=date('Y-m-d',strtotime('today'));
else
$todate=date('Y-m-d',strtotime($todate));

//echo "select `cust_id`  from `approval` where `bill_date` between '".$frmdate."' and '".$todate."'  group by `cust_id` DESC";

 //$qryapp=mysql_query("select `cust_id`  from `approval` where `bill_date` between '".$frmdate."' and '".$todate."'  group by `cust_id` DESC");
	 //echo "select * from phppos_people where person_id in (select distinct (`cust_id`) from `approval` where `bill_date` between '".$frmdate."' and '".$todate."') order by last_name";
 
 $qrts="select * from phppos_people where person_id in (select distinct (`cust_id`) from `approval` where `bill_date` between '".$frmdate."' and '".$todate."') order by last_name";
 
 
 if($_GET["billid"]!="")
 {
     
     $qrts="select * from phppos_people where person_id in (select distinct (`cust_id`) from `approval` where `bill_id`='".$_GET["billid"]."') order by last_name";
 
 }
 
 
 
  $qryapp = mysql_query($qrts); ?>
     
     <table border="1" id="tbl">
     <tr><th colspan="7" align="center"> Sales Report Customer Wise</th></tr>
     <tr><th>Sr. No.</th><th>Customer Name</th><th>Last Name</th><th>Contact No.</th><th>Address</th><th>Total Approved</th><th>Total Sold</th></tr>
     <?php $i=1; $appttl=0;$soldttl=0;
	 while($app=mysql_fetch_row($qryapp)){
	  //echo "SELECT * FROM  `phppos_people` where person_id='$app[0]' order by `first_name` ASC ";
		// $result = mysql_query("SELECT * FROM  `phppos_people` where person_id='$app[0]'");
	  //$row1 = mysql_fetch_row($result);
	  if($app[0]=="")
	  continue;
	 ?>
     <tr><td><?php echo $i;?></td>
     <td><?php echo $app[0]."   ". $app[1]; ?> </td><td><?php echo  $app[1]; ?> </td><td ><?php echo $app[2]?></td><td><?php echo $app[4]?></td><td align="right"><?php $qrybal=mysql_query("SELECT qty,return_qty,amount FROM `approval_detail` where `bill_id`in( select `bill_id` from `approval` where `cust_id`='$app[11]' and status='a' and ( `bill_date` between '".$frmdate."' and '".$todate."'))");
//$row=mysql_fetch_row($qrybal);
$appd=0;
while($row=mysql_fetch_row($qrybal)){
$appd+=($row[0]-$row[1])*$row[2]/$row[0];
}
$appttl+=$appd;
echo "<a href='#'  onclick='popup(".$app[11].")' >".$appd."</a>";?></td>

<td align="right"><?php $qrybal=mysql_query("SELECT qty,return_qty,amount FROM `approval_detail` where `bill_id`in( select `bill_id` from `approval` where `cust_id`='$app[11]' and status='s' and ( `bill_date` between '".$frmdate."' and '".$todate."'))");
$sold=0;
while($row=mysql_fetch_row($qrybal)){
$sold+=($row[0]-$row[1])*$row[2]/$row[0];
}
$soldttl+=$sold; 
echo "<a href='#'  onclick='popup(".$app[11].")' >".$sold."</a>";?></td>
</tr>
       <?php $i++;}
	   echo "<tr><td colspan='4' align='right'> <font color='RED'></font></td><td align='right'><font color='RED'>Total :&nbsp;&nbsp;</font></td><td align='right'><font color='RED'>".$appttl."</font></td><td align='right'><font color='RED'>".$soldttl."</font></td></tr>";
	    ?>
           </table>
           
           