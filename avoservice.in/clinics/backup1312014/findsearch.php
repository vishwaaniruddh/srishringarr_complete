<?php
include('config.php');
$name=$_POST['name'];

if($name==""){
$sql="select * from finding";
}
else{
$sql="select * from finding where name like '$name%'";
}
$result=mysql_query($sql);
$out=$out.'<table width="652" border="1">'; 
               
               $out=$out.' <th style="color:#ac0404; font-size:14px; font-weight:bold;" height="27"> ID </th>';
                $out=$out.'<th style="color:#ac0404; font-size:14px; font-weight:bold;" height="27">Name</th>';
                $out=$out.'<th width="58" style="color:#ac0404; font-size:14px; font-weight:bold;" height="27">Edit</th>';
                $out=$out.'<th width="61" style="color:#ac0404; font-size:14px; font-weight:bold;" height="27">Delete</th>';
                   
            while($row=mysql_fetch_row($result))
{  

	$out=$out.'<tr>
    
    <td width="100" height="27">'.$row[1].'</td>
	<td width="405" height="27">'.$row[0].'</td>
    <td height="27"> <a href="edit_finding.php?id='.$row[1].'"> Edit </a></td>
    <td height="27"> <a href="javascript:confirm_deletefind('.$row[1].')"> Delete </a></td>
    </tr>';
 }
$out=$out.'</table>';
echo $out;
?>