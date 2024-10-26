<?php
 $city=$_GET['city'];
 include("config.php");
// echo "select state_id from cities where city_id='".$city."'";
 $qry=mysqli_query($con1,"select state_id from cities where city_id='".$city."'");
 $row=mysqli_fetch_row($qry);
 //echo "select state from state where state_id='".$row[0]."'";
 $qry2=mysqli_query($con1,"select * from state where state_id='".$row[0]."'");
 $row2=mysqli_fetch_row($qry2);
 $qry3=mysqli_query($con1,"select name from avo_branch where id='".$row2[3]."'");
 $row3=mysqli_fetch_row($qry2);
			  
$out="<select name='area' id='area'>
<option value='0'>select area</option>";

	$out.="<option value='$row2[3]'>$row3[0]</option>";
	
 
$out=$out."</select>";
echo $out;  
//$conn->close_connection();
?>