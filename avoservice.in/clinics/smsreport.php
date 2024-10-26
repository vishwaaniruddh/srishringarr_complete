<?php 
include('config.php');
include('template_clinic.html');
//till here
$sq=mysql_query("select * from `sms` order by sid desc");
?>
<br><br><br><br><br>
<center>
<div  style="width:1200px;" align="center">  <!--overflow:scroll;-->
<table border="1" >
 
       <thead>
         <tr>		
	  <th width="150">Result</th>
          <th width="100">Date</th>
          <th width="800">Message</th>
          <th width="150">Receiver</th>          
</tr>
</thead>
<tbody>
<?php
while($max=mysql_fetch_row($sq)){
?>
<tr>
<td width="150"><?php echo $max[0]; ?></td><td width="50"><?php echo $max[1]; ?></td><td width="450"><?php echo $max[2]; ?></td><td width="150"><?php echo $max[3]; ?></td>
</tr>
<?php
}	
?>
</tbody>
</table>
</div>
</center>