<?php
 

include('config.php');
$code = $_POST['code'];
$search=$_POST['patsearch'];

if($code==null ){
	
$result = mysql_query("select * from new_patient");
}
else if($search=="contact"){
$result = mysql_query("select * from new_patient where contact='$code'");

}else if($search=="fname") {
       $result = mysql_query("select * from new_patient where fname='$code'");
}
 
	$out="";
	$out="<table border='1' style='border:2px #ac0404 solid;'> ";		
	

$out=$out."<a href='#' class='close'><img src='images/close_pop.png' class='btn_close' title='Close Window' alt='Close' /></a>
        
          
          
          <th width='110' style='color:#ac0404; font-size:14px; font-weight:bold;'>patient_id</th>
          <th width='40' style='color:#ac0404; font-size:14px; font-weight:bold;'>fname</th>
		  <th width='40' style='color:#ac0404; font-size:14px; font-weight:bold;'>Age</th>
          <th width='130' style='color:#ac0404; font-size:14px;font-weight:bold;'>Gender</th>
          <th width='70' style='color:#ac0404; font-size:14px; font-weight:bold;'>Contact</th>
          <th width='100' style='color:#ac0404; font-size:14px; font-weight:bold;'>Address </th>
		  <th width='130' style='color:#ac0404; font-size:14px;font-weight:bold;'>Bloodgroup</th>
		  <th width='40' style='color:#ac0404; font-size:14px; font-weight:bold;'>Marital Status</th>
          <th width='70' style='color:#ac0404; font-size:14px;font-weight:bold;'>Edit</th>
          <th width='70' style='color:#ac0404; font-size:14px;font-weight:bold;'>Delete</th>
";



 while($row=mysql_fetch_row($result))
{  	 
$out=$out."

	<tr>
    <td>  $row[0]</td>
	<td width='110'> $row[1] </td>
    <td width='105'> $row[3]</td>
    <td>  $row[4] </td>
    <td> $row[5] </td>
	<td> $row[6] </td>
	<td> $row[7] </td>
	<td> $row[8] </td>
    <td> <a href='edit_patient.php?id= $row[0]'> Edit </a></td>
    <td> <a href='delete_patient.php?id= $row[0];'> Delete </a></td>
    </tr>";

} 





			 
$out=$out."</table>";			  
echo $out;  
?>