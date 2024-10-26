<?php include("access.php"); 
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
    window.onunload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
</script>


<script>

function validate()
{
var form=document.getElementById('form');
with(form)
{

if(app_rem.value=='')
{
alert("Please Write something for Rejection");
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
<h2>Reject Claim</h2>
<div id="header">

<?php
$id=$_GET['id'];

$abc=mysqli_query($con1,"select * from daily_expenses where id = '".$id."' ") ;

$row=mysqli_fetch_row($abc);
?>
<form action="process_reject_claim.php" method="post" name="form" id="form" enctype="multipart/form-data">
<table>
<tr>
<td width="100" height="25">Name: </td>
<td width="100">

<?php
$qry=mysqli_query($con1,"select engg_id, engg_name,loginid from area_engg where engg_id='".$row[1]."'");
$name=mysqli_fetch_row($qry);

 echo $name[1]; ?></td>

<td width="100" height="25">Branch: </td>
<td width="100">
<?php
$br=mysqli_query($con1,"select id, name from avo_branch where id='".$row[2]."'");
$branch=mysqli_fetch_row($br);
?>
<?php echo $branch[1]; ?></td>
</tr>

<tr>
    <td width="100" height="25">Date: </td>
    <td width="100" height="25"> <?php echo $row[3]; ?></td>
    <td width="100" height="25">Claimed Amount: </td>
    <td width="100" height="25"><?php echo $row[19]; ?> </td>
</tr>

<tr>
<td height="35" colspan="1" >Reject Remarks</td>
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
<center><button onclick="goBack()">Keep Pending >>> GO BACK</button></center>

<script>
function goBack() {
  window.close();
}
</script>


</center>
</body>
</html>