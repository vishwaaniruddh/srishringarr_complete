<?php
include("config.php");
$patid=$_GET['id'];
$i=1;
//echo "select * from patient_package where patientid='".$patid."' and status=0";
$pat_pkg_qry=mysql_query("select * from patient_package where patientid='".$patid."' and status=0");
if(mysql_num_rows($pat_pkg_qry)>0)
{
?>
<b>Package ID -> Receipt No.</b><br/>
<?php
	while($pat_pkg=mysql_fetch_array($pat_pkg_qry))
	{
		$balamt=0;
		$opd_coln_qry=mysql_query("select sum(amt) from opd_collection where status=0 and packid='".$pat_pkg['id']."'");
		$opd_coln_amt=mysql_fetch_array($opd_coln_qry);
		$balamt=$pat_pkg['amt']-$opd_coln_amt[0];
		$opd_coln_row_qry=mysql_query("select * from opd_collection where status=0 and packid='".$pat_pkg['id']."'");
		while($opd_coln_row=mysql_fetch_array($opd_coln_row_qry))
		{
		?>
		<a href="#" onclick="payment_single('<?php echo $patid; ?>','<?php echo $opd_coln_row[0];?>','<?php echo $pat_pkg['id']; ?>');" title='View Receipt of this Day'><?php echo $pat_pkg['id']." -> ".$opd_coln_row[0]; ?></a><br>
		<?php			
			$i++;
		}
	}
}
else{
	echo "No package found.";
}
?>
<div id="receipt"></div>