<?php
include("config.php");
$med=$_GET['medid'];
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $med))
{
   $med=str_replace("'","\'",$med);
}
else
$med=$med;
$medid=mysql_query("select potency from medicine where name='".$med."'");
?>
<option value="">-select-</option>
<?php
while($row=mysql_fetch_array($medid))
{
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[0]; ?></option>
<?php
}
?>