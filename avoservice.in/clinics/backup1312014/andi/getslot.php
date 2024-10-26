<?php
include("../config.php");
//echo $apptype=$name=str_replace(" ",'_',$_GET['apptype']);
if(isset($_GET['apptype']) && isset($_GET['appdate']) && isset($_GET['branch']))
{
 $apptype=str_replace('_'," ",$_GET['apptype']);
 //$apptype=$_GET['apptype'];
  $appdate=$_GET['appdate'];
  $center=$_GET['branch'];
$str=array();
//echo "SELECT * FROM `slot` where `app_date`=STR_TO_DATE('".$appdate."','%d/%m/%Y') and `center`='".$center."' and `hospital`='".$apptype."'";
$qry="SELECT * FROM `slot` where `app_date`=STR_TO_DATE('".$appdate."','%d/%m/%Y') and `center`='".$center."' and `hospital`='".$apptype."'";
//echo $qry;
$res=mysql_query($qry);
if(mysql_num_rows($res)>0)
{
$row=mysql_fetch_row($res);
$str[]=array('slotid'=>$row[0]);
}
else
$str[]=array('slotid'=>"no record found");
}

echo json_encode($str);