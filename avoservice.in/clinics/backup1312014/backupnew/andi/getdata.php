<?php
include("../config.php");
//echo $apptype=$name=str_replace(" ",'_',$_GET['apptype']);
if(isset($_GET['apptype']) && isset($_GET['appdate']) && isset($_GET['branch']))
{
 $apptype=$name=str_replace('_'," ",$_GET['apptype']);
  $appdate=$_GET['appdate'];
  $center=$_GET['branch'];
$str='';
$time=array();
//echo "SELECT * FROM `slot` where `app_date`=STR_TO_DATE('".$appdate."','%d/%m/%Y') and `center`='".$center."' and `hospital`='".$apptype."'";
$qry="SELECT * FROM `slot` where `app_date`=STR_TO_DATE('".$appdate."','%d/%m/%Y') and `center`='".$center."' and `hospital`='".$apptype."'";
//echo $qry;
$res=mysql_query($qry);
if(mysql_num_rows($res)>0)
{
$row=mysql_fetch_row($res);
$str.=$frmtime=$row[3];
$str.='_';
$str.=$totime=$row[4];
$str.='_';
$dur=mysql_query("select duration from apptype where type='".$apptype."'");
$durro=mysql_fetch_row($dur);
$str.=$durro[0];

$str.='_';
$qry1="SELECT slot FROM `appoint` where hospital='$apptype' and cancstat=0 and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";

$res1=mysql_query($qry1);
while($row1=mysql_fetch_row($res1)){
$str.=$row1[0]."@";
}

$str.='_';
$time = strtotime($row[3]);
//echo "<br>".$time;
$str.=$startTime = date("h:i a",$time);
//echo "<br>".$startTime;
$str.='_';
 //echo "<br>".$row[4];
//echo "<br>".$startTime;
$arr = explode(":", $row[4]);
//echo "<br>".$arr[0]." ".$arr[1];
$m=$arr[0] * 60 + $arr[1] ;//. " minutes";
$arr1 = explode(":", $row[3]);
$m1=$arr1[0] * 60 + $arr1[1];// . " minutes";
//echo "<br>".$m." ".$m1." ".$durro[0];
if($m<$m1) { $diff=$m1-$m;
            $netdiff = 1440-$diff;
	     $str.=$netdiff/$durro[0];
		//echo $diff." ".$netdiff;
}
else  $str.=($m-$m1)/$durro[0];

$str.='_';
$str.=$row[0];
echo json_encode($str);
}
else
{
$str.="No Slot Found";
//echo json_encode($str);
}

}
?>