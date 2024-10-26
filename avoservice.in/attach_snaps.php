<?php
include("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AVO</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" src="scripts/upload.js"></script>

<script>
$(document).ready(function(){
    $('#image_file').on('change',function(){
        $('#upload_form').ajaxForm({           
            target:'#uploaded_images_preview',
            beforeSubmit:function(e){
                $('.file_uploading').show();
            },
            success:function(e){
                $('.file_uploading').hide();
            },
            error:function(e){
            }
        }).submit();
    });
});






<!--validation-->

//////////////////////////////site type function

function validate(form){
 with(form)
 {
//var x = document.forms["myForm"]["fname"].value;
if(userfile1.value=='')
{
    alert("You Forgot to select Snap-1 to upload");
     return false;
}

if(userfile3.value=='')
{
    alert("You Forgot to select an Snap-2 to upload");
     return false;
}
 }
 return true;
 }
 

</script>

</head>

<body>
<center>
<?php // include("menubar.php");
include("config.php"); ?>

<h2>Upload Snaps</h2>
<div id="header">

<form action="process_snapupload.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form" id="form">

<table>
<?
$alert_id=$_GET['id'];
$alerts=mysqli_query($con1,"select * from alert where alert_id ='".$alert_id."' ");
$alert=mysqli_fetch_row($alerts);


?>
<input type="hidden" name="alert_id" id="alert_id" value="<? echo $alert_id; ?>">
<tr>
<td width="207" height="35"> Customer Name: </td>
<?
 $custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$alert[1]."'");
$cust=mysqli_fetch_row($custqry);

?>
<td width="200"> <? echo $cust[0]; ?></td>

</tr>

<tr>
<td height="35">End User Name:</td>
<td width="200"> <? echo $alert[3]; ?></td>
</td>
</tr>

<tr>
<td height="35">Address:</td>
<td width="200"> <? echo $alert[5]; ?></td>
</tr>
<tr><th colspan="2" class="center" style="color:red; text-align:center; font-size:150%" height="35">Attach:</th> </tr>

<tr>
<td width="150" height="50"><b>Installed Asset Snap-1:</b></td>
<td width="200"><input type="file" name="userfile1" accept="image/*" id="userfile1" /></td>
</tr>

<tr>
<td width="150" height="50"><b>Installed Asset Snap-2:</b></td>
<td width="200"><input type="file" name="userfile3" accept="image/*" id="userfile3" /></td>
</tr>

<tr>
<td width="150" height="50"><b>Buyback Snap:</b></td>
<td width="200"><input type="file" name="userfile2" accept="image/*" id="userfile2" /></td>
</tr>

<tr>
<td height="35"  colspan="2"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>

</form>

</div>

</center>
</body>
</html>