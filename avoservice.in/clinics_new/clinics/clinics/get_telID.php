<?php include('config.php');

$tname=$_GET['tname'];
$tcon=$_GET['tcon'];

if ($tcon=="")
{
    $s="select * from tel_directory where name like('".$tname."%')";
} 
else if($tname=="")
{
	$s="select * from tel_directory where contact like('".$tcon."%')";
} 
else 
$s="select * from tel_directory where contact like('".$tcon."%') and name like('".$tname."%')";

$result = mysql_query($s);
$out="";
$out=$out."<table border='1' >";

            while($row=mysql_fetch_row($result))
{  

$out=$out."	<tr>
    
	<td  width='92'> $row[1]</td>
    <td  width='42'> $row[2]</td>
    <td  width='103'> $row[3]</td>
    <td  width='61'> $row[4]</td>
    <td  width='90'> $row[5]</td>
    <td> <a href='edit_teldir.php?id=$row[0]'> Edit </a></td>
    <td> <a href='javascript:confirm_delete2($row[0]);'> Delete </a></td>

</tr>";

 } 
 
 $out=$out."</table>";
 echo $out;



 ?>