<?php
require('config.php');
$supp=$_POST['supp_id'];
$outstand=$_POST['outstand'];

$qryinsert=mysql_query("INSERT INTO `vendor_openbal`(`id`, `v_id`, `outstanding`, `date`) VALUES ('','$supp','$outstand',now())");
if($qryinsert)
{
	?>
	<script>alert('Outstanding Added successfully.');
    		window.close();
    </script>
	<?php	
}
else
{
	?>
	<script>alert('Inserting Failed. Please Try Again');
    		window.close();
    </script>
	<?php
}
?>