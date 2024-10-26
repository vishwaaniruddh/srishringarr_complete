<?php
require_once ("secure_area.php");
require_once (APPPATH."libraries/ofc-library/open-flash-chart.php");
class Purchase extends Secure_area 
{	
	function __construct()
	{
		parent::__construct('purchase');
		$this->load->helper('purchase');
		//$this->load->lang('purchase');		
	}
	
	//Initial report listing screen
	function index()
	{
		$this->load->view("purchase/listing");	
	}
	
		
}
?>