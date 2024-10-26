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
	//if(isset($uname)){
	//$login = clean($_GET['uname']);
	//$password = clean($_GET['pass']);
	$login = 'Boopathy2099';
	$password = 'Boopathy2099123';
	//}
//	else{
//	if(isset($macid)){
        $macid=$_GET['macid']; //echo "mac:".$macid;
	//Create query	
	$resultx=mysql_query("select logid from notification_tble where mac_id='".$macid."'");
	$rowx=mysql_fetch_row($resultx);
	$resultx1=mysql_query("select username,password from login where srno='".$rowx[0]."'");
	$rowx1=mysql_fetch_row($resultx1);
	$login=$rowx1[0];
	$password=$rowx1[1];
	$login = 'Boopathy2099';
	$password = 'Boopathy2099123';
//	  }
//	}
	$qry="SELECT * FROM login WHERE username='".$login."' AND password='".$password."' and designation='4' and status='1'";
	
	//echo $qry;
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result)
	{//echo mysql_num_rows($result);
		if(mysql_num_rows($result) == 1)
		 {
		 $str=array();
		
			//Login Successful
			//session_regenerate_id();
			$eng= mysql_fetch_row($result);
			
		 $br=$eng[3];
		 $desig=$eng[4];
		 
		 
		 
			$qr=mysql_query("select srno from login where username='".$login."'");
	$row=mysql_fetch_row($qr);
	//echo $row[0];
	//echo "select engg_id from area_engg where loginid='".$row[0]."'";
	$qry2=mysql_query("select engg_id from area_engg where loginid='".$row[0]."'");
	$ro=mysql_fetch_row($qry2);	
	//echo "Select * from alert_delegation where engineer='".$row2[0]."' and alert_id in (select alert_id from alert where call_status<>'Done')";
	
	$sql1=mysql_query("Select * from alert_delegation where engineer='".$ro[0]."' and call_close_status=0 and status=0 and alert_id in (select alert_id from alert where ( call_status<>'Rejected' and status<>'Done' and call_status<>'Done'))");
//$sql1=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("alert_id"),"alert_delegation","engineer",$row[0],array(""),"y","","");


while($row1=mysql_fetch_row($sql1)) {
	$atmrow='';
	$atmid='';
	$sql2=mysql_query("select * from alert where alert_id='".$row1[3]."'");	//$sql2=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("*"),"alert","alert_id",$row1[0],array(""),"y","","");
	$row2=mysql_fetch_row($sql2);
if(($row2[17]=='service' || $row2[17]=='new' || $row2[17]=='pm') &&  $row2[21] ==  'amc')
    $atm=mysql_query("select atmid from Amc where amcid='".$row2[2]."'");
	elseif(($row2[17]=='service' || $row2[17]=='new') &&  $row2[21] == 'site')
	$atm=mysql_query("select atm_id from atm where track_id='".$row2[2]."'");

	
	echo $row2[2];echo '-'.$row2[17];

	  /*if(($row2[17]=='new' && ($row2[21]=='site') &&  $row2[30]!='New Installation Call') || $row2[17]=='new temp' || $row2[17]=='temp_pm' || $row2[17]=='temp_dere' || $row2[17]=='temp_servi' || $row2[17]=='temp_w2pcb'){ $atmid=$row2[2]; }*/
	  if($row2[17]=='new temp' || $row2[17]=='temp_pm' || $row2[17]=='temp_dere' || $row2[17]=='temp_servi' || $row2[17]=='temp_w2pcb'){ $atmid=$row2[2]; }else {  
  $atmrow=mysql_fetch_row($atm);
   $atmid=$atmrow[0];  }
   
  if($row2[9]!='')
  $problem=$row2[9];
  else
  $problem=$row2[17];






	$cl=mysql_query("select cust_id,cust_name from customer where cust_id='".$row2[1]."' ");
        $clro=mysql_fetch_array($cl);




	 
	 if($row2[15]!='Done')
	 $engstat="Pending";
	 else
	 $engstat="Done";
	/* $str.=$row2[25]."/*_";
 if($row2[17]=='new' || $row2[17]=='new temp'){ $atmid=$row2[2]."/*_";}else{ atmid= $atmrow[0]."/*_"; } 
 $str.=$row2[5]."/*_"; 
$str.=$row2[0]."*****";*/
	 $str[]=array( 'compid' => $row2[25],'atmid'=>$atmid,'address'=>$row2[5],'callid'=>$row2[0],'engid'=>$row[0],'engstat'=>$engstat,'contactperson'=>$row2[12],'phone'=>$row2[13],'bank'=>$row2[3],'problem'=>$problem,'eta'=>$row2[31],'customerName'=>$clro[1]);	
	
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