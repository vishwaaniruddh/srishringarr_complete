<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center><?php include("menubar.php"); ?>
<h2>Delegate Alert</h2>
<div id="header">
<form action="process_delegation_andi.php" method="post" name="form" >
<table>
<?php
include_once('class_files/select.php');
include('config.php');
 $req=$_GET['req'];
 $atm=$_GET['atm'];
 //$city=$_GET['city'];
 $br=$_GET['br'];
$bran=array();
if($_GET['br']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con1,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}

//echo $_GET['br'];
//$engg=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("engg_id","engg_name"),"area_engg","city",$city,array(""),"y","engg_name","a");
//echo "select engg_id,engg_name,area from area_engg where area IN (".$br1.") and status=1";
//echo "select engg_id,engg_name,area from area_engg where area IN (".$br1.") and status=1";
if($_GET['br']=='all')
$sql="select engg_id,engg_name,area,city from area_engg where status=1";
else
$sql="select engg_id,engg_name,area,city from area_engg where area IN (".$br1.") and status=1";

$engg=mysqli_query($con1,$sql);
if(!$engg)
echo "failed".mysqli_error();
?>
<tr>
<td height="35">Engineer : </td>
<td>
<select name="eng" id="eng" >
<option value="0">select</option>
<?php
while($row=mysqli_fetch_row($engg)){ 
//echo "select city from cities where city_id='".$row[2]."'";
$q=mysqli_query($con1,"select state from state where state_id='".$row[2]."'");
$r=mysqli_fetch_row($q);
$q2=mysqli_query($con1,"select city from cities where city_id='".$row[3]."'");
$r2=mysqli_fetch_row($q2);
?>
<option value="<?php echo $row[0]; ?>"><?php echo $row[1]." (".$r[0]."-".$r2[0].")"; ?></option>
<?php
}
?>
</select>
</td>
</tr>

<tr>
<td height="35">
<input type="hidden" name="req" value="<?php echo $req ?>" readonly /><input type="hidden" name="atm" value="<?php echo $atm?>" /><input type="hidden" name="br" value="<?php echo $br ?>" />
<input type="submit" value="submit" class="readbutton" name="delegate" /></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>