<?php
 

include('config.php');
$code = $_POST['code'];
$search=$_POST['search'];

if($code==null ){
	
$result = mysql_query("select * from tel_directory");
}
else if($search=="contact"){
$result = mysql_query("select * from tel_directory where contact='$code'");

}else if($search=="pincode") {
       $result = mysql_query("select * from tel_directory where pincode='$code'");
}
 
	$out="";
	$out="<table border='1' style='border:2px #ac0404 solid;'> ";		
	

$out=$out."<a href='#' class='close'><img src='images/close_pop.png' class='btn_close' title='Close Window' alt='Close' /></a>
        
          
          
          <th width='110' style='color:#ac0404; font-size:14px; font-weight:bold;'>Name</th>
          <th width='40' style='color:#ac0404; font-size:14px; font-weight:bold;'>Address</th>
          <th width='100' style='color:#ac0404; font-size:14px; font-weight:bold;'>Contact </th>
          <th width='70' style='color:#ac0404; font-size:14px; font-weight:bold;'>Pincode</th>
          <th width='130' style='color:#ac0404; font-size:14px;font-weight:bold;'>Information For</th>
          <th width='70' style='color:#ac0404; font-size:14px;font-weight:bold;'>Edit</th>
          <th width='70' style='color:#ac0404; font-size:14px;font-weight:bold;'>Delete</th>
";



 while($row=mysql_fetch_row($result))
{  	 
$out=$out."

	<tr>
    <td>  $row[0]</td>
	<td width='110'> $row[1] </td>
    <td width='105'> $row[2]</td>
    <td>  $row[3] </td>
    <td> $row[4] </td>
    <td> <a href='edit_teldir.php?id= $row[0]'> Edit </a></td>
    <td> <a href='delete_teldir.php?id= $row[0];'> Delete </a></td>
    </tr>";

} 





			 
$out=$out."</table>";			  
echo $out;  
?>