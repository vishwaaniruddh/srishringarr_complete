<?php
include("config.php");
$id=$_GET['id'];
//echo "select id from patient_package where patientid='".$id."'" ."<br>";
$qry1=mysql_query("select id from patient_package where patientid='".$id."' ");
if(mysql_num_rows($qry1)>0)
{

while($result=mysql_fetch_row($qry1))
{

?>
<a href="#" onclick="payment_edit('<?php echo $id; ?>','<?php echo $result[0];?>');" title='Edit Receipt of this Day'><?php echo $result[0]; ?></a><br>
<?php
}
}
else
{
echo "No Records.";
}
?></div>
<div id="receipt"></div>
<?php

?>