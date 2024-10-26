<?php
include("config.php");

$var_table=$_POST['tbl'];
$var_atmid=$_POST['atmid'];
$var_cust=$_POST['cust'];
$var_bank=$_POST['bank'];
$var_add=$_POST['add'];
$var_state=$_POST['state'];
$error='0';

$checkamc=mysqli_query($con1,"select ATMId from Amc where ATMId='".$var_atmid."'");
$amcrow=mysqli_num_rows($checkamc);
//echo $amcrow;
$checkatm=mysqli_query($con1,"select atm_id from atm where atm_id='".$var_atmid."'");
$atmrow=mysqli_num_rows($checkatm);
//echo $atmrow;
$checktempsites=mysqli_query($con1,"select atmid from tempsites where atmid='".$var_atmid."'");
$tempsiterow=mysqli_num_rows($checkatm);

$checktempsites_pm=mysqli_query($con1,"select atmid from tempsites_pm where atmid='".$var_atmid."'");
$tempsiterow=mysqli_num_rows(checktempsites_pm);


//if($var_cust=="" )
if($amcrow >0 || $atmrow>0 || $tempsiterow >0 || $tempsiterow>0)
{

if($var_table!="")
{
if($var_table=="Amc")
{

$qryinsert6=mysqli_query($con1,"Update Amc set BANKNAME='".$var_bank."',ADDRESS='".$var_add."',STATE='".$var_state."' where ATMId='".$var_atmid."'") ;
//echo "Update Amc set BANKNAME='".$var_bank."',ADDRESS='".$var_add."',STATE='".$var_state."' where ATMId='".$var_atmid."'";
if(!$qryinsert6)
{
$error++;
}
}
if($var_table=="atm")
{
$qryinsert7=mysqli_query($con1,"Update atm set bank_name='".$var_bank."',address='".$var_add."',state1='".$var_state."' where  atm_id='".$var_atmid."'");
if(!$qryinsert7)
{
$error++;
}
}
if($var_table=="tempsites")
{
$qryinsert8=mysqli_query($con1,"Update tempsites set custid='".$var_cust."',bankname='".$var_bank."',state='".$var_state."',address='".$var_add."' where atmid='".$var_atmid."'");
if(!$qryinsert8)
{
$error++;
}
}
if($var_table=="tempsites_pm")
{
$qryinsert9=mysqli_query($con1,"insert into tempsites_pm(custid='".$var_cust."',bankname='".$var_bank."',state='".$var_state."',address='".$var_add."' where atmid='".$var_atmid."'");
if(!$qryinsert9)
{
$error++;
}
}

}
else
{
echo ("please select table!");
$error++;
}
}else 

{
if($var_table!="" )
{
if($var_table=="Amc") //for insert
{
$qryinsert=mysqli_query($con1,"insert into Amc(ATMId,BANKNAME,ADDRESS,STATE) values ('".$var_atmid."','".$var_bank."','".$var_add."','".$var_state."')");
if(!$qryinsert)
{
$error++;
}
}
if($var_table=="atm")
{
$qryinsert1=mysqli_query($con1,"insert into atm(atm_id,bank_name,address,state1) values ('".$var_atmid."','".$var_bank."','".$var_add."','".$var_state."')");
if(!$qryinsert1)
{
$error++;
}
}
if($var_table=="tempsites")
{
$qryinsert2=mysqli_query($con1,"insert into tempsites(custid,atmid,bankname,state,address)values('".$var_cust."','".$var_atmid."','".$var_bank."','".$var_state."','".$var_add."')");
if(!$qryinsert2)
{
$error++;
}
}
if($var_table=="tempsites_pm")
{
$qryinsert3=mysqli_query($con1,"insert into tempsites_pm(custid,atmid,bankname,state,address)values('".$var_cust."','".$var_atmid."','".$var_bank."','".$var_state."','".$var_add."')");
if(!$qryinsert3)
{
$error++;
}
}
}
else
{
echo ("please select table!");
$error++;
}

}


if($error==0)
{?>
<script type="text/javascript">
alert("Site has been Edited successfully");

		
		window.opener.location.reload();
		window.close(); 
		</script>
<?php }
else
{
?>
<script type="text/javascript">
alert("error!!");

		window.close(); </script>
		
<?php
}

?>



