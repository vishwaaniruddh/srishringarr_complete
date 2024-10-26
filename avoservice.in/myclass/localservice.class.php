<?php
Class Service
{
	private $cust;
	private $po;
	private $ref;
	private $pcb;
	private $assets;
	private $atm;
	private $prblm;
	private $bank;
	private $area;
	private $pin;
	private $add;
	private $state;
	private $city;
	private $alertdt;
	private $caller;
	private $con;
	private $email;
	private $appby;
	private $cnt;
	private $how;
	private $assid;
	private $type;
	private $crby;
	private $sub;
	private $doc;
	//private $atm
	
	private $errors;
	
	public function __construct()
	{
		$this->errors=array();
		$this->assets=array();
		$this->pcb=array();
		$this->assid=array();
		$this->sub=$_POST['sub'];
		$this->doc=$_POST['docket'];
		$this->atm=$_POST['ref'];
		 $this->type=$_POST['type'];
		$this->cust=$_POST['cust'];
		$this->caller=$_POST['cname'];
		$this->con=$_POST['cphone'];
		$this->email=$_POST['cemail'];
		$this->po=$_POST['po'];
		 $this->ref=$_POST['ref'];
		$this->prblm=$_POST['prob'];
		$this->cnt=$_POST['cnt'];
		$this->crby=$_POST['crby'];
		//echo count($_POST['assets'];
		for($i=0;$i<$this->cnt;$i++)
		{
			//echo $_POST['assid'][$i]."<br>";
//echo			$i."- ".$_POST['assets'][$i];
			//echo "asset ".$_POST['pcb'][$i];
			//echo "hello";
			//echo $_POST['assets'][$i];
			if(isset($_POST['assets'][$i]) && $_POST['assets'][$i]=='on')
			{
			//echo "hi";
		 $this->assets[]=$_POST['assets'][$i];
	 $this->pcb[]=$_POST['pcb'][$i];
	
	 $this->assid[]=$_POST['assid'][$i];
			}
		}
		$this->bank=$_POST['bank'];
		$this->area=$_POST['area'];
		$this->state=$_POST['state'];
		$this->city=$_POST['city'];
		//$this->alertdt=$_POST['adate'];
		$this->appby=$_POST['appby'];
		$this->how=$_POST['how'];
		$this->add=$_POST['add'];
		//$this->atm=$_POST['atm'];
		
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
		$s=0;
		$t=0;
		$s2=0;
		$t2=0;
		if(empty($this->cust))
		$this->errors[]="Please select Your customer";
		if(empty($this->po))
		$this->errors[]="Please Select PO for this customer";
		if(empty($this->ref))
		$this->errors[]="Atm Cannot be left Blank";
		if(empty($this->atm))
		$this->errors[]="Atm Cannot be left Blank";
		for($i=0;$i<$this->cnt;$i++)
		{
			
			if(isset($_POST['assets'][$i]))
			{
		if($this->pcb[$i]=='pcb')
		{
			if(empty($this->appby))
				$s=1;
				if(empty($this->how))
				$t=1;
		}
			}
		}
		for($j=0;$j<$this->cnt;$j++)
		{
			
			if(isset($_POST['assets'][$j]))
			{
		$s2=1;
			}
		}
		
		if(empty($this->caller))
		$this->errors[]="Please Enter Caller Name";
		if(empty($this->con))
		$this->errors[]="Please Enter Contact number of caller";
		if(empty($this->email))
		$this->errors[]="Please enter email ID of caller";
		if($s2==0)
		{
	$this->errors[]="Please select atlease 1 asset";
		}
		if($s==1)
		{
	$this->errors[]="Approval by field cannot be left blank";
		}
		if($t==1)
		{
	$this->errors[]="Reference by field cannot be left blank";
		}
		
		
	return (count($this->errors)?0:1);
	}
	
	public function Execute()
	{
		$dt=date("Y-m-d H:i:s");
		//print_r($this->assets);
	//$asst=	explode("####",$this->po);
//	echo $asst[0]."<br>%%<br>".$asst[1]."<br>";
	//echo $this->cust."<br>".$this->po."<br>".count($this->assets)."<br>".$this->assets."<br>";
	//echo "INSERT INTO `satyavan_accounts`.`alert` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `standby`, `po`, `assetstatus`, `appby`, `appref`) VALUES (NULL, '".$this->cust."','".$this->atm."' , '".$this->bank."', '".$this->area."', '".$this->add."', '".$this->city."', '".$this->state."', '".$this->pin."', '".$this->prblm."', '".$dt."', '".$this->alertdt."', '".$this->caller."', '".$this->con."', '".$this->email."', 'Pending', 'Pending', 'service', '', '', '".$this->po."','".$this->type."', '".$this->appby."', '".$this->how."')";
	$qry2=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
$qry2ro=mysqli_fetch_row($qry2);
	//echo "<br>select * from alert where entry_date LIKE ('".date('Y-m-d')."%')";
	$qrr=mysqli_query($con1,"select * from alertlocal where entry_date LIKE ('".date('Y-m-d')."%')");
	$num=mysqli_num_rows($qrr);
	$num2=$num+1;
	if($num2>0 && $num2<=9)
	$num3="0".$num2;
	else
	$num3=$num2;
	
	//echo $num3;
	//echo "hi";
	
	
	$sql = mysqli_query($con1,"INSERT INTO `alertlocal` (`alert_id`, `cust_id`,`atm_id`, `bank_name`, `area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `standby`, `po`, `assetstatus`, `appby`, `appref`,`state1`,`createdby`,`subject`,`custdoctno`) VALUES (NULL, '".$this->cust."','".$this->atm."' , '".$this->bank."', '".$this->area."', '".$this->add."', '".$this->city."', '".$this->state."', '".$this->pin."', '".$this->prblm."', '".$dt."', '".$this->alertdt."', '".$this->caller."', '".$this->con."', '".$this->email."', 'Pending', 'Pending', 'service', '', '', '".$this->po."','".$this->type."', '".$this->appby."', '".$this->how."','".$this->state."','".$qry2ro[0]."_".date("Ymd").$num3."','".$this->sub."','".$this->doc."')");
	// 	 	echo count($this->assets);
	$row=mysqli_insert_id($con1);
	//echo "Update alert set createdby='".$this->crby."_".date("Ymd").$num3."' where alert_id='".$row."'";
	//$qry4=mysqli_query($con1,"Update alert set createdby='".$this->crby."_".date("Ymd").$num3."' where alert_id='".$row."'");
	//echo "Update alert_id set createdby='".$this->crby."_".$row."' where alert_id='".$row."'";
	if(!$qry4)
	echo "".mysqli_error();
	if(!$sql)
	echo "failed".mysqli_error();
	//echo count($this->assid);
	for($i=0;$i<count($this->assid);$i++)
		{
			
			if($this->assid[$i]!="")
			{
			if($this->type=='amc')
			$ini="select assets_name,assetspecid from amcassets where id='".$this->assid[$i]."'";
			elseif($this->type=='site')
			$ini="select assets_name,assets_spec  from site_assets where site_ass_id='".$this->assid[$i]."'";
			
			//echo $ini;
			$iniqr=mysqli_query($con1,$ini);
			$iniro=mysqli_fetch_row($iniqr);
			//echo "<br>select * from assets_specification where ass_spc_id='".$iniro[1]."'";
			$qry2=mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$iniro[1]."'");
				$row2=mysqli_fetch_row($qry2);
				//echo "Select * from assets where assets_id='".$row2[1]."'<br>";
				$qry3=mysqli_query($con1,"Select * from assets where assets_id='".$row2[1]."'");
				$row3=mysqli_fetch_row($qry3);
				$assets=$row3[1]." (".$row2[2].")";
		$qry=mysqli_query($con1,"Insert into alert_assetslocal(`alert_id`,`po`,`assets`,`qty`) Values('".$row."','".$asst[0]."','".$assets."','1')");
		//echo "Insert into alert_assets(`alert_id`,`po`,`assets`,`qty`) Values('".$row."','".$asst[0]."','".$assets."','1')";
		if(!$qry)
		echo "Failed".mysqli_error();
			}
			
		}
		
		
		if($sql)
		{
		$message2="";
		//echo "Select state_id from state where state='".$this->state."'";
		$qry1=mysqli_query($con1,"Select state_id from state where state='".$this->state."'");
		if(mysqli_num_rows($qry1)>0)
		{
		$resltrow=mysqli_fetch_row($qry1);
		$message2="You have  New Alerts";
			$qry2=mysqli_query($con1,"Select * from login where designation='3'");
			$srno=array();
			while($max1=mysqli_fetch_row($qry2))
				{
				//echo $max1[3]."<br>";
				$br=explode(",",$max1[3]);
				for($i=0;$i<count($br);$i++)
				{
				//echo "<br>br=".($br[$i])."<br>";
					if($br[$i]==$resltrow[0])
					{
					$srno[]=$max1[0];
					break;
					}
				}
					
				
				}
				$logid=implode(",",$srno);
				//echo "Select gcm_regid from notification_tble where logid in($logid)";
				$qryreslt=mysqli_query($con1,"Select gcm_regid from notification_tble where logid in($logid)");
				if(mysqli_num_rows($qryreslt)>0)
				{
				$str2=array();
						while($maxnew=mysqli_fetch_row($qryreslt))
						{
							$str2[]=$maxnew[0];
						
						}
						//$maxnew=mysqli_fetch_row($qryreslt);
						//$str2=$maxnew[0];
				//print_r($str2);
				
						 $gcm = new GCM();
							//$registatoin_ids = $str2;
							// echo $str2." ".$message2;
							$message = array("alert" => $message2);
						
							$result = $gcm->send_notification($str2, $message);
				}
		}
		}
		
		 ?>
   <script type="text/javascript">
   alert("Service Alert created successfully. Complain Id is <?php echo $qry2ro[0]."_".date("Ymd").$num3; ?>");
  window.location="service.php";
   </script>
   <?php 
	}
	
}
?>