<?php
Class NewCustomer
{
	private $cust;
	private $ph1;
	private $ph2;
	private $email;
	private $conper;
	private $percon;
	private $add;
	private $city;
	private $state;
	private $pin;
	
	private $errors;
	
	public function __construct()
	{
		$this->errors=array();
		$this->cust=$_POST['cust'];
		$this->ph1=$_POST['ph1'];
		$this->ph2=$_POST['ph2'];
		$this->add=$this->Replace($_POST['add']);
		$this->email=$_POST['email'];
		$this->conper=$_POST['conper'];
		$this->percon=$_POST['percon'];
		$this->city=$_POST['city'];
		$this->state=$_POST['state'];
		$this->pin=$_POST['pin'];
	}
	
	function isValidInetAddress($data, $strict = false) 
{ 
  $regex = $strict? 
      '/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i' : 
       '/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i' 
  ; 
  if (preg_match($regex, trim($data), $matches)) { 
    return array($matches[1], $matches[2]); 
  } else { 
    return false; 
  } 
}
	
	public function Replace($var)
	{
		return(str_replace("'","/'",$var));
	}
	
	public function Process()
	{
		if($this->ValidData() && $this->Execute())
		{
		////header("location:../newsite.php");
		}
		
		return ($this->errors)?0:1;
	}
	
	public function ValidData()
	{
		if(empty($this->cust))
		$this->errors[]="Please Enter Customer Name";
		if(empty($this->ph1))
		$this->errors[]="Please Enter phone1";
		if(empty($this->email))
		$this->errors[]="Please Enter EmailID of Customer";
		if(empty($this->conper))
		$this->errors[]="Please Enter Contact Person Name";
		if(empty($this->percon))
		$this->errors[]="Please Enter Contact Number of Contact Person";
		if(empty($this->city))
		$this->errors[]="Please Enter City Name";
		if(empty($this->state))
		$this->errors[]="Please Enter State Name";
		if(empty($this->pin))
		$this->errors[]="Please Enter Pincode";
	
	return ($this->errors)?0:1;
	}
	
	public function ShowErrors()
	{
		echo "<div id='err' align='center' style='background:red; color:white'>";
		foreach($this->errors as $key=>$values)
		echo $values."<br>";
		
		echo "</div>";
	}
	
	public function Execute()
	{
		
		$qry=mysql_query("INSERT INTO customer ( `cust_name`, `email_id`, `phone_no1`, `phone_no2`, `conpername`, `contactno`, `address`, `city`, `state`, `pincode`) VALUES ('".$this->cust."', '".$this->email."', '".$this->ph1."', '".$this->ph2."', '".$this->conper."', '".$this->percon."', '".$this->add."', '".$this->city."', '".$this->state."', '".$this->pin."')");
	
	if($qry){
	?>
	<script type="text/javascript">
	window.location="newsite.php";
	</script>
	<?php
	}
	}
}
?>