<?php
include("config.php");
$txt=$_GET['val'];
$what=$_GET['what'];
//echo $txt." -".$what."<br>";
if($what=='patient')
$qry=mysql_query("select * from patient where srno Like '%$txt%' or no Like '%$txt%' or name Like '%$txt%' or mobile Like '%$txt%' or email Like '%$txt%' or hospital Like '%$txt%'");
elseif($what=='doctor')
$qry=mysql_query("select * from doctor where doc_id Like '%$txt%' or name Like '%$txt%' or city Like '%$txt%' or category Like '%$txt%'");
elseif($what=='hospital')
$qry=mysql_query("select * from hospital where hospital_id Like '%$txt%' or name Like '%$txt%'");
if(mysql_num_rows($qry)>0)
{
while($row=mysql_fetch_array($qry))
{
if($what=='patient')
{
?>
<a href="patient_detail.php?id=<?php echo $row[3]; ?>"><?php echo $row[6]; ?></a><br>
<?php
}
elseif($what=='doctor')
{
?>
<a href="docsearch.php?id=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a><br>
<?php
}
elseif($what=='hospital')
{
?>
<a href="hossearch.php?id=<?php echo $row[8]; ?>"><?php echo $row[0]; ?></a><br>
<?php
}
}
}
else
echo "No Such Record";
?>