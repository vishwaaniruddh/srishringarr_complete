<?php
include('config.php');
$alert=$_POST['alert'];
//echo "select valid from alert_assets where alert_id='$alert'";
//$qryval=mysqli_query($con1,"select valid from alert_assets where alert_id='$alert'");
 $eng_id=$_POST['eng_id'];
$feed=$_POST['feed'];
$upssrno=$_POST['txt1ups'];
//print_r($upssrno);

$upsspec=$_POST['assetsups'];
//print_r($upsspec);

$assetme=$_POST['assetsme'];
$dt=date('Y-m-d');
//print_r($assetme);

if(isset($assetme))
{
	$str=array();
//echo"Select valid from alert_assets where alert_id='$alert' and assets not like '%".UPS."%'";
$qryval=mysqli_query($con1,"Select valid from alert_assets where alert_id='$alert' and assets not like '%".UPS."%'");

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
//echo "insert into installed_sitesme(assets,qty,alert_id,startdt,expdt)values('".$asstre."','".$qtyre."','".$alert."','".$dt."','$expdt')";
$tab1=mysqli_query($con1,"insert into installed_sitesme(assets,qty,alert_id,startdt,expdt)values('".$asstre."','".$qtyre."','".$alert."','".$dt."','$expdt')");
}
}


if(isset($upsspec))
{
	$str=array();
//echo"Select valid from alert_assets where alert_id='$alert' and assets like '%".UPS."%'";
$qryval=mysqli_query($con1,"Select valid from alert_assets where alert_id='$alert' and assets like '%".UPS."%'");
$resval=mysqli_fetch_row($qryval);
$str=$resval[0];
	
	//print_r($str);
	$valres=str_replace(",","",$str);
	//echo $valres;
for($i=0;$i<count($upsspec);$i++)
{
	$expdt=date('Y-m-d', strtotime($dt .' +'.$valres));
	//echo $expdt;
	/*$strhy=explode("-",$upsspec[$i]);
	 $asstre = $strhy[0];
	$qtyre = $strhy[1]-1;*/
//echo "<br>".$asstre."<br>".$qtyre;
//echo "insert into installed_sitesme(assets,qty,alert_id,upssrno,startdt,expdt)values('".$upsspec[$i]."','1','".$alert."',$upssrno[$i],,'".$dt."','$expdt')";
$tab1=mysqli_query($con1,"insert into installed_sitesme(assets,qty,alert_id,upssrno,startdt,expdt)values('".$upsspec[$i]."','1','".$alert."',$upssrno[$i],'".$dt."','$expdt')");
//$tab1=$in_obj->insert_into('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts','installed_sitesme',array("assets","qty"),array($asstre,$qtyre));
}
}
else
echo "hi";
if(!$tab1)
echo "failed".mysqli_error();
/*$qryatm=mysqli_query($con1,"select atm_id from alert where alert_id='".$alert."'");
$resatm=mysqli_fetch_row($qryatm);*/

?>