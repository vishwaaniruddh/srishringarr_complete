<?php
include("config.php");
if(isset($_POST['submit']))
{
function begin()
{
mysql_query("BEGIN");
}

function commit()
{
mysql_query("COMMIT");
}

function rollback()
{
mysql_query("ROLLBACK");
}

$id=$_POST['patid'];
$ini=explode("-",$id);
$branch='';
if($ini[0]=='B')
$branch='Borivali';
elseif($ini[0]=='M')
$branch='Malad';
 $pack=$_POST['pack'];
$amt=$_POST['packamt'];
$stdt=str_replace("/","-",$_POST['stdt']);
$stdt2=date('Y-m-d', strtotime($stdt));
//echo "select * from package where packid='".$_POST['pack']."'";
$pack=mysql_query("select * from package where packid='".$_POST['pack']."'");
$packro=mysql_fetch_row($pack);
$expdt=date('Y-m-d', strtotime($stdt .' +'.$packro[1]));
$dis=($packro[2]-$amt);

$sql=("Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`,`center`) Values('".$id."','".$packro[1]."','".$stdt2."','".$expdt."','".$amt."','".$dis."','".$branch."')");
//echo $sql;
begin(); // transaction begins

$result = mysql_query($sql);

if(!$result)
{
rollback(); // transaction rolls back
echo "transaction rolled back";
exit;
}
else
{
commit(); // transaction is committed
header('location:renew.php');
}

}
?>