<?php
include('config.php');
$alert=$_POST['alert'];
 $eng_id=$_POST['eng_id'];
$feed=$_POST['feed'];

$upssrno=$_POST['txt1ups'];
//print_r($upssrno);

$upsspec=$_POST['assetsups'];
//print_r($upsspec);

$assetme=$_POST['assetsme'];

$dt=date('Y-m-d');
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
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $feed))
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
$qry=mysqli_query($con1,"select * from alertlocal where alert_id='".$alert."'");
$qryro=mysqli_fetch_row($qry);
/*if($qryro[17]=='service')
{
//echo "update amcassets set serialno='".$_POST['serial']."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''";
$qry2=mysqli_query($con1,"update amcassets set serialno='".$_POST['serial']."' where siteid='".$qryro[2]."' and assets_name='UPS' and serialno=''");
}*/
if($qryro[17]=='new')
{
//echo $qryro[2];
//echo "<br>".$at[0]."<br>";
$qry3=mysqli_query($con1,"select * from local_site where track_id='".$qryro[1]."'");
$row3=mysqli_fetch_row($qry3);

if(isset($assetme))
{
	$str=array();
//echo"Select valid from alert_assets where alert_id='$alert' and assets not like '%".UPS."%'";
	$qryval=mysqli_query($con1,"Select valid from alert_assetslocal where alert_id='$alert' and assets not like '%".UPS."%'");

	while($resval=mysqli_fetch_row($qryval))
	{
	$str[]=$resval[0];
	//print_r($str);
	
	}
	//print_r($str);
	$valres=str_replace(",","",$str);
	//print_r($valres);
	// print_r($str);
	//print_r($str);
	for($i=0;$i<count($assetme);$i++)
	{
		
		$strhy=explode("-",$assetme[$i]);
		 $asstre = $strhy[0];
		$qtyre = $strhy[1];
		$expdt=date('Y-m-d', strtotime($dt .' +'.$valres[$i]));
		//echo $expdt;
	//echo "<br>".$asstre."<br>".$qtyre;
	//echo "<br/>insert into installed_sitesmelocal(assets,qty,alert_id,atm_id,startdt,expdt,assetstatus)values('".$asstre."','".$qtyre."','".$alert."','".$qryro[1]."','".$dt."','$expdt','".$qryro[21]."')";
	$tab1=mysqli_query($con1,"insert into installed_sitesmelocal(assets,qty,alert_id,atm_id,startdt,expdt,assetstatus)values('".$asstre."','".$qtyre."','".$alert."','".$qryro[1]."','".$dt."','$expdt','".$qryro[21]."')");
	if(!$tab1)
		//echo mysqli_error();
	
	//echo "<br/>insert into enginstalled_siteslocal(assets,qty,alert_id,atm_id,startdt,expdt,assetstatus,trackid)values('".$asstre."','".$qtyre."','".$alert."','".$qryro[1]."','".$dt."','$expdt','".$qryro[21]."','".$row3[0]."')";
	$tabeng=mysqli_query($con1,"insert into enginstalled_siteslocal(assets,qty,alert_id,atm_id,startdt,expdt,assetstatus,trackid)values('".$asstre."','".$qtyre."','".$alert."','".$qryro[1]."','".$dt."','$expdt','".$qryro[21]."','".$row3[0]."')");
	}
	if(isset($upsspec))
	{
		$str=array();
		//echo"Select valid from alert_assets where alert_id='$alert' and assets like '%".UPS."%'";
		$qryval=mysqli_query($con1,"Select valid from alert_assetslocal where alert_id='$alert' and assets like '%".UPS."%'");
		$resval=mysqli_fetch_row($qryval);
		$str=$resval[0];
			
		//print_r($str);
		$valres=str_replace(",","",$str);
		//echo $valres;
		for($i=0;$i<count($upsspec);$i++)
		{
			if(isset($upsspec[$i]))
			{
				$expdt=date('Y-m-d', strtotime($dt .' +'.$valres));
				//echo $expdt;
				/*$strhy=explode("-",$upsspec[$i]);
				 $asstre = $strhy[0];
				$qtyre = $strhy[1]-1;*/
				//echo "<br>".$asstre."<br>".$qtyre;
				//echo "insert into installed_sitesme(assets,qty,alert_id,upssrno,startdt,expdt)values('".$upsspec[$i]."','1','".$alert."',$upssrno[$i],,'".$dt."','$expdt')";
				//echo "<br/>insert into installed_sitesmelocal(assets,qty,alert_id,atm_id,upssrno,startdt,expdt,assetstatus)values('".$upsspec[$i]."','1','".$alert."','".$qryro[1]."','".$upssrno[$i]."','".$dt."','$expdt','".$qryro[21]."')";
				$tab1=mysqli_query($con1,"insert into installed_sitesmelocal(assets,qty,alert_id,atm_id,upssrno,startdt,expdt,assetstatus)values('".$upsspec[$i]."','1','".$alert."','".$qryro[1]."','".$upssrno[$i]."','".$dt."','$expdt','".$qryro[21]."')");
				//echo "<br/>insert into enginstalled_siteslocal(assets,qty,alert_id,atm_id,upssrno,startdt,expdt,assetstatus,trackid)values('".$upsspec[$i]."','1','".$alert."','".$qryro[1]."','".$upssrno[$i]."','".$dt."','$expdt','".$qryro[21]."','".$row3[0]."')";
				$tab1=mysqli_query($con1,"insert into enginstalled_siteslocal(assets,qty,alert_id,atm_id,upssrno,startdt,expdt,assetstatus,trackid)values('".$upsspec[$i]."','1','".$alert."','".$qryro[1]."','".$upssrno[$i]."','".$dt."','$expdt','".$qryro[21]."','".$row3[0]."')");
				//$tab1=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','installed_sitesme',array("assets","qty"),array($asstre,$qtyre));
			}
		}
	}	
//$qry1=mysqli_query($con1,"update site_assets set serialno='".$_POST['serial']."' where siteid='".$row3[0]."' and assets_name='UPS' and serialno=''");
//echo "update site_assets set serialno='".$_POST['serial']."' where siteid='".$row3[0]."' and assets_name='UPS' and serialno=''";
}
}
//echo "<br/>Insert into eng_feedbacklocal(`engineer`,`alert_id`,`feedback`,`standby`) Values('".$eng_id."','".$alert."','".$st."','".$stand."')";
$sql=mysqli_query($con1,"Insert into eng_feedbacklocal(`engineer`,`alert_id`,`feedback`,`standby`) Values('".$eng_id."','".$alert."','".$st."','".$stand."')");
//include_once('class_files/update.php');
//$up=new update();
//$tab1=$up->update_table('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','alert',array("status","standby"),array("Done",$stand),"alert_id",$alert);
//echo "<br/>update alertlocal set status='".$close."', standby='".$stand."' where alert_id='".$alert."'";
$tab1=mysqli_query($con1,"update alertlocal set status='".$close."', standby='".$stand."' where alert_id='".$alert."'");
if(!$tab1)
	echo "failed".mysqli_error();
if($sql && $tab1)
{
	header('Location:eng_alert_local.php');
}
else
echo "Error Updating Alert";
?>