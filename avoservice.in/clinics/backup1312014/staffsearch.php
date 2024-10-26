<?php
include('config.php');
$name=$_POST['name'];

if($name==""){
	$sql="select * from staff";
}
else
{
$sql="select * from staff where name like '$name%'";
}
$result=mysql_query($sql);

$out='<table border="1" style="border:2px #ac0404 solid; text-align:left;">';
		  
  $out =$out.'<th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Full Name</th>';
    $out =$out.'<th width="40" style="color:#ac0404; font-size:14px; font-weight:bold;">Gender</th>';
    $out =$out.'<th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Age</th>';
     $out =$out.'<th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact </th>';
       $out =$out.'<th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Address </th>';
        $out =$out.'<th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Post </th>';
         $out =$out.'<th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Daily Hours</th>';
         $out =$out.'<th width="100" style="color:#ac0404; font-size:14px; font-weight:bold;">Basic Salary</th>';
         $out =$out.'<th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Edit</th>';
         $out =$out.'<th width="50" style="color:#ac0404; font-size:14px;font-weight:bold;">Delete</th>';
                   
            while($row=mysql_fetch_row($result))
{  

	$out=$out.'<tr>
    <td>'.$row[0].'</td>
    <td>'.$row[3].'</td>
    <td>'.$row[1].'</td>
    <td>'.$row[5].'</td>
    <td>'.$row[4].'</td>
	<td>'.$row[15].'</td>
	<td>'.$row[14].'</td>
	<td>'.$row[16].'</td>
	<td><a href="edit_staff.php?id='.$row[20].'"> Edit </a></td>
    <td> <a href="javascript:confirm_deletestaff('.$row[20].');"> Delete</a></td>
	<?php } ?>
    </tr>';
 }
$out=$out.'</table>';
echo $out;
?>