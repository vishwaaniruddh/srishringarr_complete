<?php
include('config.php');
$alert=$_POST['alert'];
 $eng_id=$_POST['eng_id'];
$feed=$_POST['feed'];


if(isset($_POST['close']))
$close="Done";
else
$close='Delegated';

if(isset($_POST['stand']))
{
$stand=$_POST['stand'];
$close="Done";
}
//echo $close." ".$stand;
$st='';
if (preg_match('/[\'^�$%&*()}{@#~?><>,|=_+�-]/', $feed))
{
   $st=str_replace("'","\'",$feed);
}
else
$st=str_replace("'","\'",$feed);
/*$prob=array();
if(isset($_POST['prob']))
{
for($i=0;$i<count($_POST['prob']);$i++)
{
$qry=mysqli_query($con1,"Insert into siteproblem(alertid,probid) Values('".$alert."','".$_POST['prob'][$i]."')");
}
}*/
/*require_once('class_files/insert.php');
$in_obj=new insert();
$tab=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','eng_feedback',array("engineer","alert_id","feedback","standby"),array($eng_id,$alert,$feed,$stand));
*/

//echo "select * from alert where alert_id='".$alert."'";
$qry=mysqli_query($con1,"select * from alert where alert_id='".$alert."'");
$qryro=mysqli_fetch_row($qry);
if($qryro[17]=='service')
{
//echo "update amcassets set serialno='".$_POST['serial']."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''";
$qry2=mysqli_query($con1,"update amcassets set serialno='".$_POST['serial']."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''");
}
elseif($qryro[17]=='new')
{
//echo $qryro[2];
$at=(explode("_",$qryro[2]));
//echo "<br>".$at[0]."<br>";
if($at[0]!='temp')
{
$qry3=mysqli_query($con1,"select * from atm where atm_id='".$qryro[2]."'");
$row3=mysqli_fetch_row($qry3);

$qry1=mysqli_query($con1,"update site_assets set serialno='".$_POST['serial']."' where siteid='".$row3[0]."' and assets_name='UPS' and serialno=''");
//echo "update site_assets set serialno='".$_POST['serial']."' where siteid='".$row3[0]."' and assets_name='UPS' and serialno=''";
}
else
{
//$qry3=mysqli_query($con1,"select * from tempsites where atmid='".$qryro[2]."'");
//$row3=mysqli_fetch_row($qry3);
$qry1=mysqli_query($con1,"update tempsites set serialno='".$_POST['serial']."' where atmid='".$qryro[2]."' and serialno=''");
}
}
//echo "Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`standby`) Values('".$eng_id."','".$alert."','".$feed."','".$stand."')";
$sql=mysqli_query($con1,"Insert into eng_feedback(`engineer`,`alert_id`,`feedback`,`standby`) Values('".$eng_id."','".$alert."','".$st."','".$stand."')");
//include_once('class_files/update.php');
//$up=new update();
//$tab1=$up->update_table('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert',array("status","standby"),array("Done",$stand),"alert_id",$alert);
//echo "update alert set status='Done', standby='".$stand."' where alert_id='".$alert."'";
//echo "update alert set status='Done', standby='".$stand."' where alert_id='".$alert."'";
$tab1=mysqli_query($con1,"update alert set status='".$close."', standby='".$stand."' where alert_id='".$alert."'");
if(!$tab1)
echo "failed".mysqli_error();
if($sql && $tab1)
{
	header('Location:eng_alert.php');
}
else
echo "Error Updating Alert";
?>