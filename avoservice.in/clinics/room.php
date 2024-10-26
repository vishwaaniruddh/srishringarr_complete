<?php
   include('config.php');
	$disdate = $_GET['disdate'];
	$addate=$_GET['addate'];
	if($disdate==''){
	$qry="SELECT * FROM admission WHERE admit_date= STR_TO_DATE('".$addate."','%d/%m/%Y')";
	}else{
	$qry="SELECT * FROM admission WHERE admit_date<= STR_TO_DATE('".$addate."','%d/%m/%Y') AND dis_date>= STR_TO_DATE('".$disdate."','%d/%m/%Y')";
	}
	
	
	$result=mysql_query($qry);
	$num=mysql_num_rows($result);
		
$out="";
$out=$out."<select name='room'>";
$row=mysql_fetch_row($result);
	if($num==0){
	$res=mysql_query("select * from room");
	}else{
		$res=mysql_query("select * from room where no!=$row[6]");
	}
	while($row1=mysql_fetch_row($res)){
	
$out=$out."<option value='$row1[0]'>$row1[0] ( $row1[1] ) </option>";	
}

$out=$out."</select>";
echo $out;	
	
?>