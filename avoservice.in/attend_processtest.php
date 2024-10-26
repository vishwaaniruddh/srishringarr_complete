<?php
include('config.php');
$allbranch= $_POST['statewise'];
$branch= $_POST['branch_id'];
$engname= $_POST['engname'];
$attend= $_POST['attend'];
$mis_date=$_POST['mis_date'];
$edate1=date('Y-m-d',strtotime(str_replace("/","-",$mis_date)));
$ckbox=$_POST['eng_ckbox'];
$current_date=date('Y-m-d' ,time() + 86400);
//echo "<br>".strtotime($current_date) ;
//====Sunday get code=======
date_default_timezone_set('Asia/Kolkata');
$date_sunday=$edate1;		
$date1 = strtotime($date_sunday);
$date2 = date("l", $date1);		
$date3 = strtolower($date2);
//========================================Attendence insert in table here==============================================================	

	$today_date=strtotime($edate1); 
	$next_daty=strtotime($current_date);	
	
	if($today_date < $next_daty )
{						
		for($i=0;$i<count($ckbox);$i++)
{		
		
$att_date=mysqli_query($con1,"select `attend_date` from `avo_attendence` where `attend_date`='".$edate1."' and `branch_id`='".$allbranch."' and eng='".$engname[$i]."'");
	$att_date1=mysqli_num_rows($att_date);
	if($att_date1==0){
			if($date3 == "sunday"){
				//sunday  abailable			
				if($attend[$i]=='p'){					
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`, `present`,  `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','P','".$edate1."','".$allbranch."',1)");
		}	
	
	if($attend[$i]=='l'){	
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`, `onleave`, `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','L','".$edate1."','".$allbranch."',1)");		
	}	
	if($attend[$i]=='a'){		
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`,  `absent`,  `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','A','".$edate1."','".$allbranch."',1)");		
			}
		}else{
			//sunday not abailable
	if($attend[$i]=='p'){					
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`, `present`,  `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','P','".$edate1."','".$allbranch."',0)");
		}	
	
	if($attend[$i]=='l'){	
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`, `onleave`, `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','L','".$edate1."','".$allbranch."',0)");		
	}	
	if($attend[$i]=='a'){		
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`,  `absent`,  `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','A','".$edate1."','".$allbranch."',0)");		
			}		
			
			
			}
			}
//=========================================						
	/*		}else{
	if($date3 == "sunday"){
		//sunday  abailable				
		if($attend[$i]=='p'){				
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`, `present`,  `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','P','".$edate1."','".$branch."',1)");
		}	
	
	if($attend[$i]=='l'){		
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`, `onleave`, `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','L','".$edate1."','".$branch."',1)");
		
	}
	
	if($attend[$i]=='a'){		
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`,  `absent`,  `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','A','".$edate1."','".$branch."',1)");		
			}
		 //sunday close
		}else{
		//sunday not abailable	
	if($attend[$i]=='p'){				
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`, `present`,  `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','P','".$edate1."','".$branch."',0)");
		}	
	
	if($attend[$i]=='l'){		
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`, `onleave`, `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','L','".$edate1."','".$branch."',0)");
		
	}
	
	if($attend[$i]=='a'){		
	$sql=mysqli_query($con1,"INSERT INTO `avo_attendence`(`eng`,  `absent`,  `attend_date`, `branch_id`,`sunday`) VALUES ( '".$engname[$i]."','A','".$edate1."','".$branch."',0)");		
			}						
		}
	 }*/	
  }

 	 if($sql)
		{
		header('Location:add_attend.php?success= Attendence Inserted Successfully');
		}

} else {
	
	header('Location:add_attend.php?attend= You are Entering for Invalid date. Please select another date');
	}

	
?>