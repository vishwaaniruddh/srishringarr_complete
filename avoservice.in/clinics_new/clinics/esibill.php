<?php

    include 'config.php';
?>

<DIV ALIGN=CENTER><H2> INVOICES</H2>
<TABLE><TR><TH>ID</TH><TH>CUSTOMER NAME</TH><TH>DATE</TH></TR>
<?php
$con = mysqli_connect("localhost","root","","sarmicro_clinicmgt");
//mysqli_select_db("simple_invoices",$con);
$result=mysqli_query($con,"select * from si_invoices");
if(isset($row)){
while($row=mysqli_fetch_row($result))
{ $result1=mysqli_query($con,"select * from si_customers");
$row1=mysqli_fetch_row($result1);
?>
<tr><td><?php echo $row[0]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[8]; ?></td></tr><?php }} ?>
</table></div>