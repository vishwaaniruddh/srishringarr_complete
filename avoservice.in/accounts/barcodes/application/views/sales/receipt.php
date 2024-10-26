<?php $this->load->view("partial/header"); ?>
<?php
if (isset($error_message))
{
	echo '<h1 style="text-align: center;">'.$error_message.'</h1>';
	exit;
}
?>
<div id="receipt_wrapper">
<div id="receipt_header">
<table width="773">
  <tr>
    <td width="435" align="right"><div id="sale_receipt"><?php echo $receipt_title; ?></div></td><td width="326" align="right">Phone : <?php echo $this->config->item('phone'); ?></td>
  </tr></table>
<?php
$uid=$user_info->person_id;
if($uid!=1){
$sql1=mysql_query("select * from company_branches where user_id='$uid'");
$row1=mysql_fetch_row($sql1);	
//echo $row1[1];
	}
?>      
        <div id="company_name"><?php echo $this->config->item('company'); ?></div>
		<div id="company_address"><?php if($uid==1)echo nl2br($this->config->item('address')); else echo nl2br($row1[1]);?></div><hr />
		<div id="sale_time" style="float:right">Date : <?php echo $transaction_time ?></div>
  </div>
	
<div id="receipt_general_info">
		<?php $sid=substr($sale_id,4); if(isset($customer))
		{
		
		$sq=mysql_query("select customer_id from phppos_sales where sale_id='$sid'");
		$ro=mysql_fetch_row($sq);
		$sq1=mysql_query("select * from phppos_people where person_id='$ro[0]'");
		$ro1=mysql_fetch_row($sq1);
		?>
			<div id="customer"><?php echo $this->lang->line('customers_customer').": ".$customer; ?></div>
			<div id="custaddress"><?php echo "Address: ".$ro1[4]."<br>".$ro1[5]; ?></div>			
		<?php
		}
		?>
		<div id="sale_id"><?php echo $this->lang->line('sales_id').": ".$sale_id; ?></div>
		<div id="employee"><?php echo $this->lang->line('employees_employee').": ".$employee; ?></div>
</div><br>
<h6 align="center">Please recieve the following goods in good order & condition.</h6>
<table id="receipt_items" border="1">
	<tr>
	<th style="width:16%;text-align:center;"><?php echo $this->lang->line('sales_quantity'); ?></th>
	<th style="width:25%;"><?php echo $this->lang->line('sales_item_number'); ?></th>
	<th style="width:25%;"><?php echo $this->lang->line('items_item'); ?></th>
	<th style="width:17%;"><?php echo $this->lang->line('common_price'); ?></th>
	<th style="width:16%;text-align:center;"><?php echo $this->lang->line('sales_discount'); ?></th>
	<th style="width:17%;text-align:right;"><?php echo $this->lang->line('sales_total'); ?></th>
	</tr>
	<?php
	foreach($cart as $line=>$item)
	{
	?>
		<tr>
		<td style='text-align:center;'><?php echo $item['quantity']; ?></td>
		<td><?php echo $item['item_number']; ?></td>
		<td><span class='long_name'><?php echo $item['name']; ?></span><span class='short_name'><?php echo character_limiter($item['name'],10); ?></span></td>
		<td><?php echo to_currency($item['price']); ?></td>
		<td style='text-align:center;'><?php echo $item['discount']; ?></td>
		<td style='text-align:right;'><?php echo to_currency($item['price']*$item['quantity']-$item['price']*$item['quantity']*$item['discount']/100); ?></td>
		</tr>

	    <tr>
	    <td colspan="2" align="center"><?php echo $item['description']; ?></td>
		<td colspan="2" ><?php echo $item['serialnumber']; ?></td>
		<td colspan="2"><?php echo '&nbsp;'; ?></td>
	    </tr>

	<?php
	}
	?>
	<tr>
	<td colspan="4" style='text-align:right;border-top:2px solid #000000;'><?php echo $this->lang->line('sales_sub_total'); ?></td>
	<td colspan="2" style='text-align:right;border-top:2px solid #000000;'><?php echo to_currency($subtotal); ?></td>
	</tr>

	<?php foreach($taxes as $name=>$value) { ?>
		<tr>
			<td colspan="4" style='text-align:right;'><?php echo $name; ?>:</td>
			<td colspan="2" style='text-align:right;'><?php echo to_currency($value); ?></td>
		</tr>
	<?php }; ?>

	<tr>
	<td colspan="4" style='text-align:right;'><?php echo $this->lang->line('sales_total'); ?></td>
	<td colspan="2" style='text-align:right'><?php echo to_currency($total); ?></td>
	</tr>

    <tr><td colspan="6">&nbsp;</td></tr>

	<?php
		foreach($payments as $payment_id=>$payment)
	{ ?>
		<tr>
		<td colspan="2" style="text-align:right;"><?php echo $this->lang->line('sales_payment'); ?></td>
		<td colspan="2" style="text-align:right;"><?php echo  $payment['payment_type']    ?> </td>
		<td colspan="2" style="text-align:right"><?php echo  to_currency($payment['payment_amount'] * -1 )  ?>  </td>
	    </tr>
	<?php
	}
	?>

    <tr><td colspan="6">&nbsp;</td></tr>

	<tr>
		<td colspan="4" style='text-align:right;'><?php echo $this->lang->line('sales_change_due'); ?></td>
		<td colspan="2" style='text-align:right'><?php echo  $amount_change; ?></td>
	</tr>

	</table>
<h6>Goods once sold will not be taken back. </h6> 
<span style="float:right"> Receiver's Signature </span>

	<div id="sale_return_policy">
	<?php echo nl2br($this->config->item('return_policy')); ?>
	</div>
	<div id='barcode'>
	<?php echo "<img src='index.php?c=barcode&barcode=$sale_id&text=$sale_id&width=250&height=50' />"; ?>
	</div>
</div>
<?php $this->load->view("partial/footer"); ?>
<center><input type="button" value="Export" onclick="javascript:location.href='export_to_xml.php?sid=<?php echo $sid; ?>'"   style="width:100px;height:27px;"></center>
<?php if ($this->Appconfig->get('print_after_sale'))
{
?>

<script type="text/javascript">
$(window).load(function()
{
	window.print();
});
</script>
<?php
}
?>