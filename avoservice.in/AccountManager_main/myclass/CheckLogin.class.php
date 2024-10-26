<?php
Class CheckLogin
{
	private $user;
	private $pwd;
	 private $errors;
	 public function __construct()
	 {
		 $this->errors=array();
		 $this->user=$this->Filter($_POST['uname']);
		 $this->pwd=$_POST['password'];
	 }
	 
	 public function Filter($var)
	{
	return preg_replace('/[^a-zA-Z0-9@.]$/','',$var);
	}
	 
	 public function Process()
	 {
		 if($this->ValidData())
		{
	$this->logchk();
		
		}
		
				return count($this->errors)?0:1;
	 }
	 public function ShowErrors()
	 {
		 echo "<h3>Errors :</h3><div class='error' align='center' style='display:block; color:red'>";
		 foreach($this->errors as $values=>$value)
			 echo $value."<br>";
			 
			 echo "</div>";
	 }
	 public function logchk()
	 {
		 include("config.php");
		//echo "select * from login where username='$this->user' and password='$this->pwd' and status=1 ";
		 $result = mysql_query("select * from login where username='".$this->user."' and password='".$this->pwd."' and status='1' ");
//echo mysql_num_rows($result);
if(mysql_num_rows($result)>0)
   {
   $row=mysql_fetch_row($result);   
   session_start();
   $_SESSION['user']=$this->user;
   if($row[3]=='')
   $_SESSION['branch']="all";
   else
   $_SESSION['branch']=$row[3];
   
   if($row[4]=='')
   $_SESSION['designation']='all';
   else
   $_SESSION['designation']=$row[4]; 
  
  $_SESSION['logid']=$row[0];
   }
else{
$this->errors[]="Invalid Login";}
	 }
	 
	 public function ValidData()
	 {
		 if(empty($this->user) || empty($this->pwd))
		 $this->errors[]="All fields are compulsory";
		
		
		 return count($this->errors)?0:1;
	 }
}

?>