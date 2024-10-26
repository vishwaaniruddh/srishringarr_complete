<?php
$path_to_root="..";
$page_security = 'SA_OPEN';
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/data_checks.inc");
include_once($path_to_root . "/includes/ui.inc");
global $db, $transaction_level, $db_connections;

/*$con = mysql_connect("localhost","satyavan_accounts","Ritesh123*");
              mysql_select_db("satyavan_accounts",$con);*/
           $sid=$db_connections[$_SESSION["wa_current_user"]->company]['tbpref'];
$cid=substr($sid,0,-1);
 //echo $cid;

if(isset($_POST['submit']))
{
if($_POST['category']=='' || $_POST['meters']=='')
{
echo "<h2>Category and Quantity are mandatory fields. Please go back and fill the form again </h2>";
}
else
{
$piece=array();
$meters=$_POST['meters'];
echo $cnt=$_POST['count'];
$cat=$_POST['category'];
for($i=0;$i<$cnt;$i++)
{
//echo $i."<br>";
 $piece[]=$_POST['piece'][$i];

}
$j=0;
//echo "INSERT INTO `cutmaterial` (`cutid`, `prefix`, `rawid`, `catid`, `28`, `30`, `32`, `34`, `36`, `38`, `40`, `42`, `44`, `46`, `48`, `50`) VALUES (NULL, '".$cid."', '".$meters."', '".$cat."', '".$piece[$j]."', '".$piece[$j+1]."', '".$piece[$j+2]."', '".$piece[$j+3]."', '".$piece[$j+4]."', '".$piece[$j+4]."', '".$piece[$j+5]."', '".$piece[$j+6]."', '".$piece[$j+7]."', '".$piece[$j+8]."', '".$piece[$j+9]."', '".$piece[$j+10]."')";
$qry=mysql_query("INSERT INTO `cutmaterial` (`cutid`, `prefix`, `rawid`, `catid`, `28`, `30`, `32`, `34`, `36`, `38`, `40`, `42`, `44`, `46`, `48`, `50`) VALUES (NULL, '".$cid."', '".$_POST['rawid']."', '".$cat."', '".$piece[$j]."', '".$piece[$j+1]."', '".$piece[$j+2]."', '".$piece[$j+3]."', '".$piece[$j+4]."', '".$piece[$j+4]."', '".$piece[$j+5]."', '".$piece[$j+6]."', '".$piece[$j+7]."', '".$piece[$j+8]."', '".$piece[$j+9]."', '".$piece[$j+10]."')");


$qr=mysql_query("update rawmaterial set status='1' where rawid='".$_POST['rawid']."' and prefix='".$cid."'");
if(!$qry)
echo "Some Error Occurred";
else
{
header('location:viewcuttingfrm.php');
}}
}
?>