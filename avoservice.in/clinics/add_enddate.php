<?php 
include('config.php');
$id=$_REQUEST['id'];
mysql_query("BEGIN");
$errors=0;
$dt=mysql_query("select * from patient_package where patientid='".$id."' and status=0 order by id DESC limit 1");
if(mysql_num_rows($dt)>0)
{
	$dtro=mysql_fetch_row($dt);
	$qry=mysql_query("update patient_package set expdt=ADDDATE(expdt, INTERVAL ".$_REQUEST['num']." ".$_REQUEST['add_type'].") where id='".$dtro[0]."'");
	//echo "INSERT INTO `ref_paid`(`patient_package_id`, `num`, `add_type`, `patientid`, `entrdt`) VALUES ('".$dtro[0]."','".$_REQUEST['num']."','".$_REQUEST['add_type']."','".$id."','".date('Y-m-d H:i:s')."')";
	$ref_qry=mysql_query("INSERT INTO `ref_paid`(`patient_package_id`, `num`, `add_type`, `patientid`, `entrdt`) VALUES ('".$dtro[0]."','".$_REQUEST['num']."','".$_REQUEST['add_type']."','".$id."','".date('Y-m-d H:i:s')."')");
	$ref_id=mysql_insert_id();
	$pat_qry=mysql_query("select srno from patient where REFERENCE='".$id."' and REFERENCE1 is null");
	while($pat_row=mysql_fetch_array($pat_qry))
	{
		$ref_details_qry=mysql_query("INSERT INTO `ref_paid_details`(`ref_paid_id`, `patientid`) VALUES ('".$ref_id."','".$pat_row[0]."')");
		//echo "update patient set REFERENCE1='Y' where srno ='".$pat_row[0]."'<br/>";
		$pat_updt=mysql_query("update patient set REFERENCE1='Y' where srno ='".$pat_row[0]."'");
		if(!$pat_updt || !$ref_details_qry)
		$errors++;
	}
	if($qry && $ref_qry && $errors==0)
	{
		mysql_query("COMMIT");
		echo "1";
	}
	else
	{
		mysql_query("ROLLBACK");
		echo mysql_error();
	}
}
else
echo "No rows in patient_package.";
?>