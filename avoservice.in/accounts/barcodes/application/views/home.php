<?php $this->load->view("partial/header"); ?>
<br />
<h3><?php echo $this->lang->line('common_welcome_message'); ?></h3>
<?php $ab=mysql_query("SELECT count(*) FROM `phppos_order` WHERE status='pending'");
$ro=mysql_fetch_row($ab);?>
<p><a href="application/views/sales/pending_order.php" style="text-decoration:none;">Total Pending Order's &nbsp;&nbsp; <?php echo $ro[0]; ?></a></p>


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