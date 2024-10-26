<?php $this->load->view("partial/header"); ?>
<br />
<form name="frm1" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
Select Delivery :<select name="return" id="return"><option value="">--Select--</option>
<?php
$qry=mysql_query("select distinct(delivery) from phppos_rent order by delivery ASC");
while($qrro=mysql_fetch_array($qry))
{
    if($qrro[0]!=""){
?>
<option value="<?php echo $qrro[0]; ?>"><?php echo $qrro[0]; ?></option>
<?php
}}
?>
</select>
<input type="submit" name="cmdret" value="GO>>" />
</form>
<?php
$currentdate=Date("Y-m-d");
$a=date('Y-m-d', strtotime($currentdate. ' + 1 days'));
$b=date('Y-m-d', strtotime($currentdate. ' + 2 days'));
$c=date('Y-m-d', strtotime($currentdate. ' + 10 days'));
//echo $c;
////echo "SELECT * FROM `phppos_rent` where  booking_status<>'Delivered' and delivery_date='$a' or delivery_date='$b' or delivery_date='$currentdate'   order by delivery_date ASC";
$day=date('d');
//echo "SELECT * FROM `phppos_rent` where (booking_status<>'Returned' or booking_status='Picked') order by delivery_date ASC";
if(isset($_POST['cmdret']))
$r=mysql_query("SELECT * FROM `phppos_rent` where (booking_status='NULL' or booking_status='Picked') and delivery='".$_POST['return']."' order by bill_id DESC");
else
$r=mysql_query("SELECT * FROM `phppos_rent` where (booking_status='NULL' or booking_status='Picked') order by bill_id DESC");
$num=mysql_num_rows($r);


//echo "SELECT * FROM `phppos_rent` where  (delivery_date='$a' and (booking_status='' or booking_status='Picked')) or (delivery_date='$b' and (booking_status='' or booking_status='Picked')) or (delivery_date='$currentdate' and (booking_status='' or booking_status='Picked'))  order by delivery_date ASC";
	
$r1=mysql_query("SELECT * FROM `phppos_rent` where  (pick_date<'$c' and  booking_status='Booked') or (pick_date='$currentdate' and  booking_status='Booked') order by pick_date ASC");
$num=mysql_num_rows($r1);	

?>

<table width="930">
  <tr><td width="454" valign="top">
<table width="425" border="1" cellpadding="0" cellspacing="0">
<tr>
<th width="87">Bill No. </th>
<th width="110">Return By </th>
<th width="110">Return Date </th>
<th width="116">Name </th>
<th width="102">Item--Qty</th>

</tr>	
<h3><font size="-1" color="#FF0000" face="Georgia, Times New Roman, Times, serif">  Alert : Return Date </font></h3>
<?php 
$qty[]=array();
while($r2=mysql_fetch_row($r)){

$cust=$r2[1];
//echo $cust."hi";
$customer=mysql_query("SELECT * FROM `phppos_people` where person_id='$cust'");
$cust1=mysql_fetch_row($customer);

$bill=mysql_query("SELECT * FROM `order_detail` where  bill_id='$r2[0]'");
//$bill11=mysql_fetch_row($bill);

$bill1=mysql_query("SELECT * FROM `order_detail` where  bill_id='$r2[0]'");
$bill11=mysql_fetch_row($bill1);
if($bill11[0]!='')
{
?>

<tr>
<td><a href="application/views/reports/rent_report_detail.php?id=<?php echo $bill11[0]; ?>" target="_blank"><?php echo $bill11[0]; ?></a></td>
<td><?php echo $r2[7]; ?></td>
<td><?php if(isset($r2[12]) and $r2[12]!='0000-00-00') echo date('d/m/Y',strtotime($r2[12]))." ".$r2[22]; ?></td>
<td><?php echo $cust1[0]." ".$cust1[1]; ?></td>
<td>

<?php while($bill1 = mysql_fetch_row($bill)){
$item=$bill1[1];
$item1=mysql_query("SELECT * FROM `phppos_items` where name='$item'");
$item2=mysql_fetch_row($item1);?>
<?php echo $item2[0]."--".$bill1[9]."<br>"; } ?></td>

</tr>

<?php }} ?>
</table></td>

<td width="464" valign="top">
<table width="425" border="1" cellpadding="0" cellspacing="0">
<tr>
<th width="72">Bill No. </th>
<th width="100">Pick By </th>
<th width="100">Pick Date </th>
<th width="117">Name </th>
<th width="126">Item--Qty</th>
<th width="102">Picked</th>
</tr>	
<h3><font size="-1" color="#FF0000" face="Georgia, Times New Roman, Times, serif">  Alert : Pick Date</font></h3>
<?php while($r3=mysql_fetch_row($r1)){

$cust=$r3[1];
//echo $cust."hi";
$customer=mysql_query("SELECT * FROM `phppos_people` where person_id='$cust'");
$cust1=mysql_fetch_row($customer);

$bill=mysql_query("SELECT * FROM `order_detail` where  bill_id='$r3[0]'");
//$bill11=mysql_fetch_row($bill);

$bill1=mysql_query("SELECT * FROM `order_detail` where  bill_id='$r3[0]'");
$bill11=mysql_fetch_row($bill1);
?>

<tr>
<td><a href="application/views/reports/rent_report_detail.php?id=<?php echo $bill11[0]; ?>" target="_blank"><?php echo $bill11[0]; ?></a></td>
<td><?php echo $r3[6]; ?></td>
<td><?php if(isset($r3[11]) and $r3[11]!='0000-00-00') echo date('d/m/Y',strtotime($r3[11])); ?></td>
<td><?php echo $cust1[0]." ".$cust1[1]; ?></td>
<td>

<?php while($bill1 = mysql_fetch_row($bill)){
$item=$bill1[1];
$item1=mysql_query("SELECT * FROM `phppos_items` where name='$item'");
$item2=mysql_fetch_row($item1);?>
<?php echo $item2[0]."--".$bill1[9]."<br>"; } ?></td>
<td>

<?php
$p=0;
$bill2=mysql_query("SELECT * FROM `order_detail` where  bill_id='$r2[0]'");
while($bill12=mysql_fetch_row($bill2)){

$qt=mysql_query("select * from phppos_items where name='$bill12[1]'");
$qt1=mysql_fetch_row($qt);
///echo $qt1[7];
if($qt1[7]<=0){
$p=1;
}
}
////echo "<br/>".$p;

?><input type="button" value="Picked" onclick="window.location='application/views/reports/deliver.php?bid=<?php echo $bill11[0]; ?>'" <?php if($p==1){ ?>disabled="disabled" <?php } else { } ?>/>
<?php ?>
</tr>

<?php } ?>
</table>
</td></tr></table><br>

<h3><?php echo $this->lang->line('common_welcome_message'); ?></h3>
<div id="home_module_list">
	<?php
	foreach($allowed_modules->result() as $module)
	{
	?>
	<div class="module_item">
		<a href="<?php echo site_url("$module->module_id");?>">
		<img src="<?php echo base_url().'images/menubar/'.$module->module_id.'.png';?>" border="0" alt="Menubar Image" /></a><br />
		<a href="<?php echo site_url("$module->module_id");?>"><?php echo $this->lang->line("module_".$module->module_id) ?></a>
		 - <?php echo $this->lang->line('module_'.$module->module_id.'_desc');?>
	</div>
	<?php
	}
	?>
</div>
<?php $this->load->view("partial/footer"); ?>