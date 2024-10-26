<?php include 'config.php';

$pname=$_GET['pname'];
$adate=$_GET['adate'];
//$city=$_GET['city'];


if ($adate=="")
{
	$s="select * from new_patient where fname like('".$pname."%')";
}
else if($pname=="")
{
	$s="select * from new_app where app_date like('".$adate."%')";
} 

else 
$s="select * from new_app where pname like('".$pname."%') and adate like('".$adate."%')";

$result = mysqli_query($con,$s);
$out="";
$out=$out."<table border='1' >";

while($row=mysqli_fetch_row($result))

{
$result1 = mysqli_query($con,"select * from new_app where patient_id='$row[1]'");
$row1=mysqli_fetch_row($result1);
$result2 = mysqli_query($con,"select * from new_app");
$row2=mysqli_fetch_row($result2);
$out=$out."	<tr>
    
	<td width='92'> $row[1]</td>
    <td width='103'> $row2[2]</td>
    <td width='61'> $row2[3]</td>
    <td width='90'> $row2[4]</td>
    <td width='81'> $row2[5] </td>
	<td width='81'> $row2[7] </td>
    <td> <a href='edit_doc.php?id=$row[0]'> Edit </a></td>
    <td> <a href='javascript:confirm_delete4($row[0]);'> Delete </a></td>
   
</tr>";

 } 
 
 $out=$out."</table>";
 echo $out;
 ?>
 