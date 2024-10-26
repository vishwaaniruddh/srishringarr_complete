<?php 
include('config.php');
$itmname=$_GET['itmname'];
 
  $qry="SELECT * FROM `order_detail` where `item_id`='$itmname' and bill_id in(SELECT bill_id  FROM `phppos_rent` WHERE `pick_date` >= now() AND `delivery_date` >= now() ORDER BY `phppos_rent`.`pick_date` ASC) group by bill_id";

$res=mysql_query($qry);                
$num=mysql_num_rows($res);
if($num>0){	
$i=1;					 				 
?>

<table border="1"  width="43%" align="center">
<tr><td align="center" colspan="6"><?php echo "<b>Item Name : ".strtoupper($itmname)."</b>";?></td></tr>

	<tr><th width="61">Sr. No</th><th width="97">Bill No.</th><th width="200">Name</th><th width="200">Description</th><th width="125">Mobile No</th><th width="125">Pick Date</th><th width="193">Delivery Date</th></tr>

	<?php while($row=mysql_fetch_row($res)){
		$qryrent=mysql_query("Select pick_date, delivery_date,cust_id from phppos_rent where bill_id='$row[0]'");
		$resrent=mysql_fetch_row($qryrent);
		
		$abc=mysql_query("select first_name,last_name,phone_number from phppos_people where person_id='".$resrent[2]."'");
		$abcfetch=mysql_fetch_array($abc);
		?>
        <tr align="center"><td><?php echo $i;?>
	        </td><td><?php echo $row[0];?></td>
	        <td><?php echo $abcfetch[0].' ' .$abcfetch[1];?></td>
	        <td><?php echo $row[7];?></td>
	        
	        
	        <td><?php echo $abcfetch[2];?></td>
	        <td><?php echo date('d-m-Y',strtotime($resrent[0]));?></td>
	        <td><?php echo  date('d-m-Y',strtotime($resrent[1]));?></td>
        </tr>
        <?php $i+=1;}?>
</table>
			  
               
		<?php }
		else
		echo "<b style='color:red;'>No Bookings</b>"; ?>