<?php
	//Include database connection details
	include('../config.php');
	
	//Array to store validation errors
	function clean($str2) 
	{
		$str = @trim($str2);
		if(get_magic_quotes_gpc()) 
		{
			$str2 = stripslashes($str2);
		}
		return mysql_real_escape_string($str2);
	}
	$response=array();
	
	$login = clean($_GET['uname']);
	$password = clean($_GET['pass']);
	$status1 = clean($_GET['stat1']);
	$status2 = clean($_GET['stat2']);
	//$res='';
	
	//Create query
	//echo "SELECT * FROM login WHERE username='$login' AND password='".$password."' and designation='3' and status='1'";
	$qry="SELECT * FROM login WHERE username='$login' AND password='".$password."' and designation='3' and status='1'";
	
	//echo $qry;
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result)
	{
		if(mysql_num_rows($result) == 1)
		 {
		 $str=array();
		
			//Login Successful
			//session_regenerate_id();
			$eng= mysql_fetch_row($result);
			
		 $br=$eng[3];
		 $desig=$eng[4];
		 $bran=array();
		if($br!="") 
	{
	$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
	$br1="'".$br1."'";
	//echo "select state from state where state_id in (".$br1.")";
	$src=mysql_query("select state from state where state_id in (".$br1.")");
	
	while($srcrow=mysql_fetch_array($src))
	{
		$bran[]=$srcrow[0];
	}
	$br3=implode(",",$bran);
	$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
	$br2="'".$br2."'";
	}
	
		// echo "select * from alert where state in ($br2) and status='Pending'and call_status='Pending'";
			
	
	//$qry2=mysql_query("select engg_id from area_engg where loginid='".$row[0]."'");
	//$ro=mysql_fetch_row($qry2);	
	
	if($status1=='Delegated')
	//$sql1=mysql_query("Select * from alert_delegation where engineer='".$ro[0]."' and alert_id in (select alert_id from alert where call_status<>'Done')");
$sq="select * from alert where state in ($br2) and status='Delegated' and call_status<>'Done'";
	else
	 //$sq="select * from alert where state in ($br2) and status='Pending'";
	 $sq="select * from alert where state in ($br2) and status='Pending' and (call_status = 'Pending' or call_status='1' or call_status='2')";
	
$sql2=mysql_query($sq);
while($row2=mysql_fetch_row($sql2)) {
	$atmrow='';
	$atmid='';
	//$sql2=mysql_query("select * from alert where alert_id='".$row1[3]."'");	//$sql2=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"alert","alert_id",$row1[0],array(""),"y","","");
	//$row2=mysql_fetch_row($sql2);
if($row2[17]=='service' &&  $row2[21] ==  'amc')
$atm=mysql_query("select atmid from Amc where amcid='".$row2[2]."'");
if($row2[17]=='service' &&  $row2[21] == 'site')
$atm=mysql_query("select atm_id from atm where track_id='".$row2[2]."'");
	
	$atmrow=mysql_fetch_row($atm);
	
	$qrycust=mysql_query("select cust_name from customer where cust_id='".$row2[1]."'");
	
	$qrycustrst=mysql_fetch_row($qrycust);

	
	 if($row2[17]=='new' || $row2[17]=='new temp')
	$atmid=$row2[2];
	 else
	 $atmid=$atmrow[0];
	 
	 if($row2[15]!='Done')
	 $engstat="Pending";
	 else
	 $engstat="Done";
	/* $str.=$row2[25]."/*_";
 if($row2[17]=='new' || $row2[17]=='new temp'){ $atmid=$row2[2]."/*_";}else{ atmid= $atmrow[0]."/*_"; } 
 $str.=$row2[5]."/*_"; 
$str.=$row2[0]."*****";*/
	 $str[]=array('compid' => $row2[25],'atmid'=>$atmid,'address'=>$row2[5],'callid'=>$row2[0],'engid'=>0,'engstat'=>0,'contactperson'=>$row2[12],'phone'=>$row2[13],'bank'=>$row2[3],'branch'=>$br,'srno1'=>$eng[0],'alertid'=>$row2[0],'cust'=>$qrycustrst[0]);
	 
	
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