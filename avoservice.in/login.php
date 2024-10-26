<?php
	//Include database connection details
	include('config.php');
	
	//Array to store validation errors
	function clean($str2) 
	{
		$str = @trim($str2);
		if(get_magic_quotes_gpc()) 
		{
			$str2 = stripslashes($str2);
		}
		return mysqli_real_escape_string($str2);
	}
	$response=array();
	
	$login = clean($_GET['uname']);
	$password = clean($_GET['pass']);
	//$res='';

	//Create query
	
	$qry="SELECT * FROM login WHERE username='$login' AND password='".$password."' and designation='4' and status='1'";
	
	//echo $qry;
	$result=mysqli_query($con1,$qry);
	
	//Check whether the query was successful or not
	if($result)
	{
		if(mysqli_num_rows($result) == 1)
		 {
		 $str=array();
		
			//Login Successful
			//session_regenerate_id();
			$eng= mysqli_fetch_row($result);
			
		 $br=$eng[3];
		 $desig=$eng[4];
		 
		 
		 
			$qr=mysqli_query($con1,"select srno from login where username='".$login."'");
	$row=mysqli_fetch_row($qr);
	//echo $row[0];
	//echo "select engg_id from area_engg where loginid='".$row[0]."'";
	$qry2=mysqli_query($con1,"select engg_id from area_engg where loginid='".$row[0]."'");
	$ro=mysqli_fetch_row($qry2);	
	//echo "Select * from alert_delegation where engineer='".$row2[0]."' and alert_id in (select alert_id from alert where call_status<>'Done')";
	
	$sql1=mysqli_query($con1,"Select * from alert_delegation where engineer='".$ro[0]."' and alert_id in (select alert_id from alert where call_status<>'Done')");

while($row1=mysqli_fetch_row($sql1)) {
	$atmrow='';
	$atmid='';
	$sql2=mysqli_query($con1,"select * from alert where alert_id='".$row1[3]."'");	
	$row2=mysqli_fetch_row($sql2);
if($row2[17]=='service')
{
	$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row2[2]."'");
	$atmrow=mysqli_fetch_row($atm);
}
	
	 if($row2[17]=='new' || $row2[17]=='new temp')
	$atmid=$row2[2];
	 else
	 $atmid=$atmrow[0];
	 

	 $str[]=array( 'compid' => $row2[25],'atmid'=>$atmid,'address'=>$row2[5],'callid'=>$row2[0],'engid'=>$ro[0]);
	 
	
	}
	    
		echo json_encode($str);
		}
		else 
		{
			//Login failed
			$str=-1;
			echo json_encode($str);
		}
	}
	else
	{
	$str=-1;
	echo json_encode($str);
	}
	//$res="uname = ".$_POST['uname']." password".$_POST['pass'];
	
	
?>