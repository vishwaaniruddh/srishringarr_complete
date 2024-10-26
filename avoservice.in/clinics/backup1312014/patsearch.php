<?php
include('config.php');
$name=$_POST['name'];

if($name==""){
$sql="select * from opdwait";
}
else{
$sql="select * from opdwait where name like '$name%'";
}
$result=mysql_query($sql);
$out=$out.'<table width="925"  border="1" id="results" cellpadding="4" cellspacing="0" style="font-size:13px;">';
               
                $out=$out.'<th style="color:#ac0404; font-size:14px; font-weight:bold;"> ID </th>';
                $out=$out.'<td width="172" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient Name</td>';
                $out=$out.'<td width="87" style="color:#ac0404; font-size:14px; font-weight:bold;">App_Date</td>';
                $out=$out.'<td width="58" style="color:#ac0404; font-size:14px; font-weight:bold;">Timing</td>';
				$out=$out.'<td width="71" style="color:#ac0404; font-size:14px; font-weight:bold;">Type</td>';
				$out=$out.'<td width="210" style="color:#ac0404; font-size:14px; font-weight:bold;">Hospital</td>';
				$out=$out.'<td width="106" style="color:#ac0404; font-size:14px; font-weight:bold;">Confirmed</td>';
				$out=$out.'<td width="54" style="color:#ac0404; font-size:14px; font-weight:bold;">History</td>';
				$out=$out.'<th width="43" style="color:#ac0404; font-size:14px; font-weight:bold;" >Delete</th>';
                   
            while($row=mysql_fetch_row($result))
{  

$result2=mysql_query("select * from patient where name='$row[1]'");
$row2=mysql_fetch_row($result2);

	

	$out=$out.'<tr>
    <td>'.$row2[2].'</td>
    <td>'.$row2[2].'</td>
	<td  width='172'>'.$row[1].'</td>
    <td  width='87'>'.if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])).'</td>
    <td width="58">'.$row[2].'</td>
	<td width="71">'.$row[7].'</td>
    <td  width='210'>'.$row[8].'</td>
    <td width="106" align="center"><input type="button" value="Confirm" onClick="window.location.href="confirm_pat.php?id='.$row[11].'"" style="width:75px;" /> </td>
    <td width="54" align="center"><a href="Timeline/horizontal.php?id='.$row[10].'" target="_blank" >History</a> </td>
    <td height="27"> <a href="javascript:confirm_deleterecord('.$row[11].');"> Delete </a></td>
    </tr>';
 }
$out=$out.'</table>';
echo $out;
?>