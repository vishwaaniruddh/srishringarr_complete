<?php
include("config.php");
$id=$_GET['id'];
//echo "select * from opd_collection where patientid='".$id."'";
$qry=mysql_query("select * from opd_collection where patientid='".$id."'");
if(!$qry)
echo mysql_error();
if(mysql_num_rows($qry)>0)
{
?>
<div id="nottoprint">
<?php
while($row=mysql_fetch_array($qry))
{
//echo $row[2];
?>
<a href="#" onclick="payment('<?php echo $id; ?>','<?php echo $row[0]; ?>');" title='View Receipt of this Day'><?php echo date("d/m/Y",strtotime($row[3])); ?></a><br>
<?php
}
?></div>
<div id="receipt"></div>
<?php
}
else
echo "No records Found";
?>