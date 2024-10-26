<?php
include("config.php");
$table=$_POST['table'];
$id=$_POST['id'];
$mob=$_POST['mobile'];
$email=$_POST['email'];
$city=$_POST['city'];
$name=$_POST['name'];
if($table=='socialajax')
$qry=mysql_query("update social set name='".$name."', mobile='".$mob."', email='".$email."', city='".$city."' where social_id='".$id."'");
elseif($table=='ngoajax')
$qry=mysql_query("update ngo set name='".$name."', mobile='".$mob."', email='".$email."', city='".$city."' where ngo_id='".$id."'");

if($qry)
{
?>
<script type="text/javascript">
alert("updated successfully");
window.close();
</script>
<?php
}
else
{
?>
<script type="text/javascript">
alert("Some error Occurred <?php echo mysql_error();  ?>");
window.location='editsocial.php?id=<?php echo $id; ?>&link=<?php echo $table ?>';
</script>
<?php
}
?>