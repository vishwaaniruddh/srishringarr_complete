<?php
session_start();
if(!isset($_SESSION['user']))
echo "0";
else
{
include("config.php");
$cid=$_GET['cust'];
//echo "select distinct(bank_name) from atm where cust_id='".$cid."' union select distinct(bankname) from Amc where cid='".$cid."'";
//$bnk=mysqli_query($con1,"select distinct(bank_name) from atm where cust_id='".$cid."' union select distinct(bankname) from Amc where cid='".$cid."'");
$bnk=mysqli_query($con1,"select * from `whatsapp_groupname` where cust_id='".$cid."'");
?>
<!--<option value="">Select</option> -->
<?php
while($bnkro=mysqli_fetch_array($bnk))
{
?>
<option value="<?php echo $bnkro[0]; ?>"><?php echo $bnkro[2]."-".$bnkro[3]; ?></option>
<?php
}
}
?>