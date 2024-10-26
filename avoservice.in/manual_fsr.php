<?php
session_start();
include("access.php");
include("config.php");

?>

<html>
<head>
<title>AVOUPS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript">
    
function validate(form){
 with(form)
 {

if(fsrfile.value=='')
{
    alert("You Forgot to select FSR File to upload");
     return false;
}
 }
 return true;
 }
    
</script>



</head>
<body>
<form name="form" id="form" action="process_manual_fsr.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)">

<div align="center" style="padding:10px">


<input type="hidden" name="alert_id" id="alert_id" value="<?php echo $_GET['id']; ?>" >

<h3>Attach FSR</h3>
<table>
<tr>
  <td>
  Attach FSR / Installation Report
  </td>
  
  <td>
  <input type="file" name="fsrfile" id="fsrfile" />
  </td>
</tr>


<tr>
  <td colspan="2" align="center">
  <input type="submit" name="subs" value="submit" />
  </td>
</tr>


</table>
<!--<br>
<a href="view_alert.php" >BACK</a> -->
</div>
</form>
</body>