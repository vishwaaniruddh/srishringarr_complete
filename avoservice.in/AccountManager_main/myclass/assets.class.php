<?php
Class Service
{
	private $assets;
	private $spec;
	private $cmp;
	private $errors;
	
	public function __construct()
	{
		
		
		$this->assets=$_POST['assets'];
		$this->spec=$_POST['spec'];
		$this->cmp=$_POST['cmp'];
		
		
	}
	
	public function Process()
	{
		if($this->Isvalid() && $this->Execute())
		{
		}
		
		return(count($this->errors)?0:1);
	}
	
	public function ShowErrors()
	{
		echo "<h2>Errors</h2>";
		foreach($this->errors as $key=>$values)
		echo $values."<br>";
	}
	
	public function Isvalid()
	{
		
		if(empty($this->assets))
		$this->errors[]="Please Enter Assets Name.";
		if(empty($this->spec))
		$this->errors[]="Please Enter Assets Specification.";
		if(empty($this->cmp))
		$this->errors[]="Please Enter Company Name of Assets.";
		
		
	return (count($this->errors)?0:1);
	}
	
	public function Execute()
	{
		$dt=date("Y-m-d H:m:s");
		//print_r($this->assets);
	///echo $this->assets;
//	echo $asst[0]."<br>%%<br>".$asst[1]."<br>";
	//echo $this->cust."<br>".$this->po."<br>".count($this->assets)."<br>".$this->assets."<br>";
$sql = mysql_query("INSERT INTO `assets_specification` (`assets_id`, `name`,`company_name`) VALUES ('".$this->assets."',  '".$this->spec."', '".$this->cmp."')");
	// 	 	echo count($this->assets);
	$row=mysql_insert_id();
	
		return true;
	}
	
}
?>