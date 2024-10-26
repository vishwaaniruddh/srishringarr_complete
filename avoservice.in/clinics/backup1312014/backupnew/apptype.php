<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>New Appointment Type</title>
<script type="text/javascript">
function validate()
{
if(document.getElementById('type').value=='')
{
alert("Please Enter type of Appointment");
document.getElementById('type').focus();
return false;
}
if(document.getElementById('duration').value=='')
{
alert("Please Enter Duration for this session");
document.getElementById('duration').focus();
return false;
}
if(document.getElementById('duration').value!='')
{
if(isNaN(document.getElementById('duration').value))
{
alert("Number of month can be integer value only and it should be in minutes");
document.getElementById('duration').value='';
document.getElementById('duration').focus();
return false;
}
}

return true;
}
</script>
<script>
function sendmsg(field,id,name,amt){
 var field= field;
 var id=id;
 var name=name;
 var amt=amt;
 //alert(oo);
 var opener = null;
 if (window.dialogArguments) // Internet Explorer supports window.dialogArguments
        { 
            opener = window.dialogArguments;
        } 
        else // Firefox, Safari, Google Chrome and Opera supports window.opener
        {        
            if (window.opener) 
            {
                opener = window.opener;
				//return true;
            }
        }       
	alert(opener+" "+field+" "+id+" "+name);
  opener.settypemsg(field,id,name,amt);
  window.close();
}

/*function setmsg(obj)
{
 //alert("Child "+obj);
 document.getElementById("xyz1").value=obj;
}*/
</script>

</head>

<body>
<?php
if(isset($_POST['cmdtype']))
{
include("config.php");
if($_POST['field']=='')
{
?>
<script type="text/javascript">
alert("You are not allowed to use this script directly");
window.close();
</script>
<?php
}

$qry=mysql_query("Insert into apptype(`type`,`duration`) Values('".$_POST['type']."','".$_POST['duration']."')");
$id=mysql_insert_id();
if(!$qry)
echo "failed ".mysql_error();
else
{
?>
<script type="text/javascript">
alert("Appointment Type has been added successfully");
sendmsg('<?php echo $_POST['field']; ?>','<?php echo $id; ?>','<?php echo $_POST['type'] ?>','<?php echo $_POST['duration'] ?>');
</script>
<?php
}
}
?>
<form name="frmtype" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return validate();">
<table width="80%" align="center"><tr><th colspan="2" align="center"><h2>New Appointment Type</h2></th></tr>
<tr><th>Type :</th><td><input type="text" name="type" id="type" /></td></tr>
<tr><th>Session of this type :(should be in minutes)</th><td><input type="text" name="duration" id="duration" /></td></tr>
<tr><td colspan="2">
<input type="hidden" name="field" id="field" value="<?php if(isset($_GET['field'])){ echo $_GET['field']; } ?>" />
<input type="submit" name="cmdtype" value="Create Type>>" style="width:110px; height:40px" />&nbsp;&nbsp;
<input type="button" name="cmdcanc" id="cmdcanc" onclick="window.close()" value="cancel" style="width:100px; height:40px"  />
</td></tr>
</table>
</form>
</body>
</html>
