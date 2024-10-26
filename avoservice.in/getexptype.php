<?php
session_start();
if(!isset($_SESSION['user']))
echo "0";
else
{
include("config.php");
$head=$_GET['brid'];
?>
<select name="exptype" id="exptype">
<option value="">select</option>
<?
//echo "select * from `br_exptype` where exp_headid='".$head."'" ;
$bnk=mysqli_query($con1,"select * from `br_exptype` where exp_headid='".$head."'");

while($bnkro=mysqli_fetch_array($bnk)) { ?>
<option value="<?php echo $bnkro[0]; ?>"><?php echo $bnkro[2]; ?></option> 
<?php } ?>
</select>
<? }  ?>

