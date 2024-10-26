<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Current Rates</title>
</head>

<body bgcolor="#CCFF33">
<center><h1>CURRENT RATES</h1>
<BR /><BR />
<?php 
include('config.php');

if(isset($_POST['done'])){
	$inqry=mysql_query("update current_rates set gold=".$_POST['gold'].",diamond=".$_POST['diamond']);
     //  echo "update current_rates set gold=".$_POST['gold'].",diamond=".$_POST['diamond'];
	if($inqry)
	{
		echo "Data insert successfully";
	}
	else
	{
		echo "Some error occured, Please try again";
	}	
}

$sql=mysql_query("select * from current_rates");
$rates=mysql_fetch_row($sql);
?>
<form action="current_rates.php" method="post" >
<TABLE >
<TR><TD>GOLD</TD><TD><input type="text" name="gold" value="<?php echo $rates[0]; ?>" /></TD></TR>
<TR><TD>DIAMOND</TD><TD><input type="text" name="diamond" value="<?php echo $rates[1]; ?>" /></TD></TR>
<tr><td colspan="2" align="center" ><input type="submit" name="done" /></td></tr>
</TABLE>
<a href="./" >back</a>
</form>
</center>
</body>
</html>