<?php include("access.php"); 

// if($_SESSION['user']=='masteradmin' || $_SESSION['designation']=="3" || $_SESSION['designation']=="7")

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script>


function validate()
{
var form=document.getElementById('form');
with(form)
{
//alert("hello");

if(app_amt.value=='0')
{
alert("Alert !!  Please Check Approved Amount !! ");
app_amt.focus();
return;
}

if(app_rem.value=='')
{
alert("Please Write something on Approval justification");
app_rem.focus();
return;
}


form.submit();
}
}



</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2>Expense Approval</h2>
<div id="header">

<?php
$id=$_GET['id'];

$abc=mysqli_query($con1,"select * from daily_expenses where id = '".$id."' ") ;

//echo $abc;

$row=mysqli_fetch_row($abc);
?>


<form action="process_exp_claim.php" method="post" name="form" id="form" enctype="multipart/form-data">
<table>

<tr>
<td width="100" height="25">Name: </td>
<td width="100">

<?php
$qry=mysqli_query($con1,"select engg_id, engg_name,loginid from area_engg where engg_id='".$row[1]."'");
//echo "select engg_id, engg_name from area_engg where engg_id='".$row[1]."'";
$name=mysqli_fetch_row($qry);
?>
<?php echo $name[1]; ?></td>


<td width="100" height="25">Branch: </td>
<td width="100">
<?php
$br=mysqli_query($con1,"select id, name from avo_branch where id='".$row[2]."'");
$branch=mysqli_fetch_row($br);
?>
<?php echo $branch[1]; ?></td>
</tr>

<tr>
<td height="25">Calls Attend as per Engineer: </td>
<td><?php echo $row[4];  ?></td>


<td>Calls As per portal </td>

<? 
$result = mysqli_query($con1,"SELECT COUNT(responsetime) AS `count` FROM `alert_progress` where engg_id='".$name[2]."' and date(responsetime)='".$row[3]."' and responsetime !='0000-00-00 00:00:00'");

$calls = mysqli_fetch_assoc($result);
$cnt1 = $calls['count']; 
?>

<td><input type="hidden" name="pcall" id="pcall" readonly="readonly" value="<?php echo $cnt1; ?>"/><?php echo $cnt1; ?></td>
<td><a style="color:red; font-size:15px; font-weight:bold;" href="check_alert.php?eid=<?php echo $name[2]; ?>&date=<?php echo $row[3]; ?>" target="_new">Show Calls</a></td>

</tr>


<tr>
<td height="25">Other Visits Made: </td>

<td><?php echo $row[5]; ?></td>


<td height="35">Purpose for other visits</td>

<td><?php echo $row[21]; ?></td>

</tr>

<tr>
<td height="25">Travelled KM: </td>

<td><?php echo $row[18]."KMs + Company Vehicle<br>".$row[20]."KMs"; ?></td>

<td> <a style="color:red; font-size:15px; font-weight:bold;" href="travellingmap.php?eid=<?php echo $row[1]; ?>&date=<?php echo $row[3]; ?>" target="_new">Approx Portal KM</a></td>
<? 
$dist= mysqli_query ($con1,"select * from  engg_distances where eng_id='".$row[1]."' and date(dis_date)='".$row[3]."'");
$dis=mysqli_fetch_row($dist);

$timestamp = strtotime($row[3]);
$date = date('d/m/Y', $timestamp);

//$date=date_format($row[3],"d/m/Y");

?>
<td><input type="hidden" name="port_km" id="port_km" readonly="readonly" value="<?php echo $dis[4]; ?>"/><?php echo $dis[4]; ?></td>
<td><a style="color:red; font-size:15px; font-weight:bold;" href="test_distance3.php?id=<?php echo $row[1]; ?>&date=<?php echo $date; ?>" target="_new">View in Map</a></td>
</tr>

<tr>
<td height="25">Total Expense Claim: </td>

<td><?php echo $row[19]; ?></td>


<td height="35">Approved Amount</td>

<td><input type="number" min="0" max="15000" name="app_amt" id="app_amt" onkeyup="if(parseInt(this.value)>15000){ this.value =0; return false; }" placeholder="max:15000"/></td>

</tr>


<tr>
<td height="35" colspan="1" >Approval Remarks</td>
<td width="180">
<textarea  input type="text" colspan="4" name="app_rem" id="app_rem" maxlength="100" ></textarea>
</td>

<td height="35" colspan="4">
<input type="hidden" name="id" value="<?php echo $row[0]; ?>" />
<input type="button" value="submit" class="readbutton" onclick="validate();"/></td>
</tr>
</table>
</form>
</div>
<center><button onclick="goBack()">Keep Pending >> GO BACK</button></center>

<script>
function goBack() {
  window.close();
}
</script>


</center>
</body>
</html>