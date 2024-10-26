<?php
include('config.php');

$ch=$_GET['ch'];
$id=$_GET['id'];

for($i=0;$i<count($ch);$i++){
//echo $ch[$i];
$sdate[]="";
$edate[]="";
$tab=mysql_query("select * from slot where block_id='$ch[$i]'");
$t=mysql_fetch_row($tab);

$sdate[$i]=$t[3];
$edate[$i]=$t[4];
}

//$sd1=$sdate[0];
//$ed1=$edate[0];

//$sd2=$sdate[1];
//$ed2=$edate[1];
//echo $ch[1];

$tab1=mysql_query("update slot set start_time='".$sdate[0]."', end_time='".$edate[0]."' where block_id='".$ch[1]."'");
$tab2=mysql_query("update slot set start_time='".$sdate[1]."', end_time='".$edate[1]."' where block_id='".$ch[0]."'");

if($tab1 && $tab2)
{
//echo "done";
	header("location: View_app.php");

}
else
echo "error exchanging slot";
?>