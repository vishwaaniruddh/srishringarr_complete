<?php
include('config.php');

$id=$_POST['attend_id'];
//echo "id=".$id;
$_POST['eng_ckbox'];
$attend= $_POST['attend'];
//echo $attend;


//========================================Attendence insert in table here==============================================================
				
	if($attend=='p'){		
		//echo "<br> update `avo_attendence` set `present`= 'P', `onleave`= '', `absent`= ''  where `id` = '".$id."'";	
	$sql=mysqli_query($con1,"update `avo_attendence` set `present`= 'P', `onleave`= '', `absent`= ''  where `id` = '".$id."'");
		}
	elseif($attend=='l'){
		
		//echo "<br> update `avo_attendence` set `onleave`= 'L' , `present`= '' ,`absent`= '' where `id` = '".$id."' ";
	$sql=mysqli_query($con1,"update `avo_attendence` set `onleave`= 'L' ,`present`= '' ,`absent`= '' where `id` = '".$id."'");
		
	}
	
	elseif($attend=='a'){
		
		//echo "<br> update `avo_attendence` set `absent`= 'A', `present`= '' , `onleave`= '' where `id` = '".$id."'";
	$sql=mysqli_query($con1,"update `avo_attendence` set `absent`= 'A', `present`= '' , `onleave`= '' where `id` = '".$id."'");
		
	}else{
		
		header('Location:view_attend.php?nochange= In Attendence You are not changing anything');
		}
	
 
 	 if($sql)
		{
		header('Location:view_attend.php?success= Attendence Updated Successfully');
		}



?>