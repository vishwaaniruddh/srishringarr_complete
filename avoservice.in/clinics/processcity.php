<?php

include('config.php');

$name=$_POST['city'];
 $field=$_POST['field'];
if($field=='area')
$res=mysql_query("insert into area(name) values('$name')");
else
$res=mysql_query("insert into city(name) values('$name')");
if(!$res)
echo "failed".mysql_error();
else
{
?>
<script type="text/javascript">
alert("Data added successfully");
window.close();
</script>
<?php
}
?>


