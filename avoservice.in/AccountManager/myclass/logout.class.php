<?php
class Logout
{
		
	public function __construct()
	{
		
		
		
	}
	public function process()
	{
		
	if($this->valid_data())
	$this->logout();
	
	return count($this->errors)?0:1;
	}
	
	public function filter($var)
	{
		return preg_replace('/[^a-zA-Z0-9@.]$/','',$var);
	}
    public function valid_email($var)
	{
		return filter_var($var, FILTER_VALIDATE_EMAIL);
	}
   
	
	public function logout()
	{
		
		if(session_destroy())
		return true;
		
	}
	
	public function show_errors()
	{
		echo "<div style='background-color:white' align='center'><h2><font color='red'>Errors :</font></h2><h4>";
		foreach($this->errors as $keys=>$values)
		echo "<div style='background-color:white' align='center'><font color='black'>".$values."</font></div><br>";
	
echo "</h4></div>";
		
	}
	
	public function valid_data()
	{
		return true;
	
		
		//echo count($this->errors)?0:1;
		return count($this->errors)?0:1;
	}
	
	}
?>