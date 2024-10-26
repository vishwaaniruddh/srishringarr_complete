<?php
include('config.php');
$name=$_POST['name'];

if($name==""){
$sql="select * from advise";
}
else{
$sql="select * from advise where name like '$name%'";
}
$result=mysql_query($sql);
$out=$out.'<table width="499" border="1">';
                
                $out=$out.'<th style="color:#ac0404; font-size:14px; font-weight:bold;" height="27">ID</th>';
                $out=$out.'<th style="color:#ac0404; font-size:14px; font-weight:bold;" height="27">Name</th>';
                $out=$out.'<th width="53" style="color:#ac0404; font-size:14px; font-weight:bold;" height="27">Edit</th>';
                $out=$out.'<th width="59" style="color:#ac0404; font-size:14px; font-weight:bold;" height="27">Delete</th>';
                   
            while($row=mysql_fetch_row($result))
{  

	$out=$out.'<tr>
    
    <td width="48" height="27">'.$row[0].'</td>
	<td width="311" height="27">'.$row[1].'</td>
    <td height="27"> <a href="edit_advise.php?id='.$row[0].'"> Edit </a></td>
    <td height="27"> <a href="javascript:confirm_deleteadvise('.$row[0].');"> Delete </a></td>
    </tr>';
 }
$out=$out.'</table>';
echo $out;
?>