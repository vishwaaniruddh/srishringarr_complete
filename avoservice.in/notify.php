<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// print_r($_SESSION['branch']);
include("config.php");
if(isset($_POST['cmdsubmit']))
{
//echo $_POST['alert'];
 $req=$_POST['alert'];
//$city=$_POST['city'];
$br=$_POST['br'];
$cdate = date('Y-m-d H:i:s');
if(isset($_POST['tp']) && $_POST['tp']=='wait')
$stat=2;
else
$stat="Done";



$prob=array();
if(isset($_POST['prob']))
{
for($i=0;$i<count($_POST['prob']);$i++)
{
//echo "Insert into siteproblem(alertid,probid) Values('".$req."','".$_POST['prob'][$i]."')";
$qry=mysqli_query($con1,"Insert into siteproblem(alertid,probid) Values('".$req."','".$_POST['prob'][$i]."')");
}
}
//echo "select call_status,caller_email from alert where alert_id='".$req."'";

//echo $qrro[0];
if($qrro[0]=='2')
$tab1=("update alert set call_status='$stat' where alert_id='".$req."'");
else
$tab1=("update alert set call_status='$stat',close_date='".$cdate."' where alert_id='".$req."'");

$tab2=mysqli_query($con1,$tab1);
if($tab1)
{
if($stat!='2')
{
$qr=mysqli_query($con1,"select call_status,caller_email from alert where alert_id='".$req."'");
$qrro=mysqli_fetch_row($qr);
$to = $qrro[0];
			
			$subject = 'Task Completed';
			
			$headers = "From: " .AVOUPS. "\r\n";
			//$headers .= "Reply-To: ".dfdf . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$message="Update Time : ".date("Y-m-d H:i:s")."<br><br>Update : Your Complain number ".$qrro[1]." has been successfully resolved.";
			
		mail($to, $subject, $message, $headers);
}
	header('Location:view_alert.php');
}
else
echo "Error in Notifying Callers";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function validate()
{
//alert("hi");
if(document.getElementById("feed").value=='')
{
alert("Please Enter some Feedback");
return false;
}
if(document.getElementById("close").checked==true || document.getElementById("stand").checked==true)
{
if(document.getElementById("serial").value=='')
{
alert("Please Enter serial number of UPS");
return false;
}
}


}
</script>
</head>

<body>
<center>
<?php  include("menubar.php"); ?>
<h2>Close Call</h2>
<div id="header">


<?php
 $alert=$_GET['req'];
$type=$_GET['type'];
$br=$_GET['br'];
?>

<form method="post" name="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"  >
<input type="hidden" name="alert" id="alert" value="<?php if(isset($_POST['alert'])){ echo $_POST['alert'];}else{ echo $alert; } ?>" />
<input type="hidden" name="tp" id="tp" value="<?php if(isset($_POST['tp'])){ echo $_POST['tp'];}else{ echo $type; } ?>" />
<input type="hidden" name="br" id="br" value="<?php if(isset($_POST['br'])){ echo $_POST['br']; }else{ echo $br; } ?>" />
<table width="394">

<?php
$getprob=mysqli_query($con1,"select probid from siteproblem where alertid='".$alert."'");
if(mysqli_num_rows($getprob)>0)
{
}
else
{
?>
<tr><td colspan="2" align="center"><h3>Select Types of Problem Occurred</h3></td></tr>
<?php
echo "Select * from problemtype where type='".$_GET['ctp']."' order by problem ASC";
$prob=mysqli_query($con1,"Select * from problemtype where type='".$_GET['ctp']."' order by problem ASC");
if(!$prob)
echo mysqli_error();
while($probro=mysqli_fetch_array($prob))
{

?>
<tr><td align="right"><input type="checkbox" name="prob[]" id="prob" value="<?php  echo $probro[0]; ?>" /></td><td align="left"><?php  echo $probro[1]; ?></td></tr>
<?php
}
}
?>

<tr>
<td height="35">
<input type="hidden" name="alert" value="<?php echo $alert; ?>" readonly /><input type="hidden" name="eng_id" value="<?php echo $eng_id; ?>" />
<input type="submit" value="Close This Call" class="readbutton" name="cmdsubmit"/>
</td>
<td>
<input type="button" value="Cancel" class="readbutton" onclick="Javascript:location.href='eng_alert.php'"/>
</td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
