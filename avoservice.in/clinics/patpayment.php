<?php
include("config.php");
$id=$_GET['id'];
//echo "select id from patient_package where patientid='".$id."'" ."<br>";
$qry1=mysql_query("select id from patient_package where patientid='".$id."' ");
if(mysql_num_rows($qry1)>1)
{

while($result=mysql_fetch_row($qry1))
{
//echo "select * from opd_collection where patientid='".$id."' and packid='".$result[0]."' ";
$qry=mysql_query("select * from opd_collection where patientid='".$id."' and packid='".$result[0]."' ");
if(!$qry)
echo mysql_error();

if(mysql_num_rows($qry)>0)
{
?>
<div id="nottoprint">
<?php
$row=mysql_fetch_array($qry)
?>
<a href="#" onclick="payment('<?php echo $id; ?>','<?php echo $row[0];?>','<?php echo $result[0];?>','<?php echo date("d/m/Y",strtotime($row[3])); ?>');" title='View Receipt of this Day'><?php echo date("d/m/Y",strtotime($row[3])); ?></a><br>
<?php
}
//else
//echo "No records Found";
}}
else{
  $result=mysql_fetch_row($qry1);
//echo "select * from opd_collection where patientid='".$id."' and packid='".$result[0]."' ";
$qry=mysql_query("select * from opd_collection where patientid='".$id."' and packid='".$result[0]."' ");
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
<a href="#" onclick="payment('<?php echo $id; ?>','<?php echo $row[0];?>','<?php echo $result[0];?>','<?php echo date("d/m/Y",strtotime($row[3])); ?>');" title='View Receipt of this Day'><?php echo date("d/m/Y",strtotime($row[3])); ?></a><br>
<?php
}
?></div>
<div id="receipt"></div>
<?php
}
//else
//echo "No records Found";

}

?></div>
<div id="receipt"></div>
<?php



?>