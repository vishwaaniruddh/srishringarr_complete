<?php
include('config.php');
$name=$_POST['name'];

if($name==""){
$sql="select * from treat1";
}
else{
$sql="select * from treat1 where name like '$name%'";
}
$result=mysql_query($sql);
$out=$out.'<table width="549" border="1" id="results" style="font-size:13px; text-transform:uppercase;">';
               
                
                $out=$out.'<th style="color:#ac0404; font-size:14px; font-weight:bold;">Name</th>';
                $out=$out.'<th width="54" style="color:#ac0404; font-size:14px; font-weight:bold;">Edit</th>';
                $out=$out.'<th width="63" style="color:#ac0404; font-size:14px; font-weight:bold;">Delete</th>';
                   
            while($row=mysql_fetch_row($result))
{  

	$out=$out.'<tr>
    
    
	<td width="336">'.$row[0].'</td>
    <td> <a href="edit_complaint.php?id='.$row[1].'"> Edit </a></td>
    <td> <a href="javascript:confirm_deletecomp('.$row[1].')"> Delete </a></td>
    </tr>';
 }
$out=$out.'</table>';
echo $out;
?>