<?php include('config.php');

$type=$_GET['type'];
$head=$_GET['head'];
//$city=$_GET['city'];


if ($type=="")
{
	$s="select * from surgery where surgery_head like('".$head."%')";
}
else if($head=="")
{
	$s="select * from surgery where type like('".$type."%')";
} 

else 
$s="select * from surgery where type like('".$type."%') and head like('".$head."%')";

$result = mysql_query($s);
$out="";
$out=$out."<table border='1' >";

while($row=mysql_fetch_row($result))

{
$result1 = mysql_query("select * from new_patient where patient_id='$row[1]'");
$row1=mysql_fetch_row($result1);
$out=$out."	<tr>
    
	<td  width='92'> $row1[1]</td>
    <td  width='103'> $row[3]</td>
    <td  width='61'> $row[4]</td>
    <td  width='90'> $row[7]</td>
    <td width='81'> $row[8] </td>
	<td width='81'> $row[9] </td>
	<td width='81'> $row[30] </td>
    <td> <a href='edit_doc.php?id=$row[0]'> Edit </a></td>
    <td> <a href='javascript:confirm_delete4($row[0]);'> Delete </a></td>
   
</tr>";

 } 
 
 $out=$out."</table>";
 echo $out;
 ?>
 