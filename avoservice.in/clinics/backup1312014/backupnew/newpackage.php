<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Package</title>
<script type="text/javascript">
function validate()
{
if(document.getElementById('pname').value=='')
{
alert("Please Enter Package Name");
document.getElementById('pname').focus();
return false;
}
if(document.getElementById('pname').value!='')
{
if(isNaN(document.getElementById('pname').value))
{
alert("Duration can be integer value only");
document.getElementById('pname').value='';
document.getElementById('pname').focus();
return false;
}
}
if(document.getElementById('dur').value=='')
{
alert("Please select Duration");
document.getElementById('dur').focus();
return false;
}
if(document.getElementById('pamt').value=='')
{
alert("Please Enter Amount for this package");
document.getElementById('pamt').focus();
return false;
}
if(document.getElementById('pamt').value!='')
{
if(isNaN(document.getElementById('pamt').value))
{
alert("Amount Invalid");
document.getElementById('pamt').value='';
document.getElementById('pamt').focus();
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
	//alert(opener+" "+field+" "+id+" "+name);
  opener.setmsg(field,id,name,amt);
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
if(isset($_POST['cmdpack']))
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

$qry=mysql_query("Insert into package(`desc`,`amt`,`nom`) Values('".$_POST['pname']." ".$_POST['dur']."','".$_POST['pamt']."','')");
$id=mysql_insert_id();
if(!$qry)
echo "failed ".mysql_error();
else
{
?>
<script type="text/javascript">
alert("Package added successfully");
sendmsg('<?php echo $_POST['field']; ?>','<?php echo $id; ?>','<?php echo $_POST['pname']." ".$_POST['dur']; ?>','<?php echo $_POST['pamt'] ?>');
</script>
<?php
}
}
?>
<form method="post" name="frmpackage" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="return validate();">
<table border="0">
<tr><td colspan="2" align="center"><h2>New Package</h2></td></tr>
<tr><td>Package Name:</td><td><input type="text" name="pname" id="pname" placeholder="value in number" />
<select name="dur" id="dur"><option value="">-Duration-</option>
<option value="days">-days-</option>
<option value="week">-week-</option>
<option value="month">-month-</option>
<option value="year">-year-</option>
</select>
</td></tr>
<!--<tr><td>Number of Month:</td><td><input type="text" name="nom" id="nom" /></td></tr>-->
<tr><td>Amount:</td><td><input type="text" name="pamt" id="pamt" /></td></tr>
<tr><td colspan="2" align="center">
<input type="hidden" name="field" id="field" value="<?php if(isset($_GET['field'])){ echo $_GET['field']; } ?>" />
<input type="submit" name="cmdpack" id="cmdpack" value="Add Package>>" style="width:110px; height:40px" /><input type="button" name="cmdcanc" id="cmdcanc" onclick="window.close()" value="cancel" style="width:100px; height:40px"  /></td></tr>
</table>
</form>
</body>
</html>
