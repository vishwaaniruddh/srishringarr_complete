<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript">
function sendmsg(var1,var2){
//alert("hi");
 var oo =var1 ;
 var field=var2;
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
//		alert(opener);
  opener.setmsg(oo,field);
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
<center>
<?php
if(isset($_POST['tempsub']))
{
if(($_POST['tname'])=='' || ($_POST['comp'])=='' || ($_POST['note'])=='')
{
echo "<tr><th colspan=2 align=center>All fields are compulsory</th></tr>";
}
else
{
include("config.php");
if($_POST['field']=='examtemp')
$qry=mysql_query("Insert into templa(`name`,`complaint`,`note`) Values('".$_POST['tname']."','".$_POST['comp']."','".$_POST['note']."')");
elseif($_POST['field']=='opdtemp')
$qry=mysql_query("INSERT INTO `templa1` (`heading`, `complaint`, `note`, `diagnosis`, `advise`) VALUES ('".$_POST['tname']."','".$_POST['comp']."','".$_POST['note']."','".$_POST['diag']."','".$_POST['adv']."')");
if($qry)
{
?>
<script type="text/javascript">
//alert("done");
sendmsg('<?php echo $_POST['tname']; ?>','<?php echo $_POST['field']; ?>');
</script>
<?php
}
else
echo "<tr><th colspan=2 align=center>Some Error occurred".mysql_error()."</th></tr>";
}
}
?>
<form name="template" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<table border="0">
<tr style="background:#00CCCC"><th colspan="2" align="center"> Add new Template</th></tr>


<tr><th>Name :</th><td><input type="text" name="tname" id="tname" /></td></tr>
<tr><th>Complaint :</th><td><textarea name="comp" id="comp" cols="25" rows="7" /></textarea></td></tr>
<tr><th>Note :</th><td><textarea name="note" id="note" cols="25" rows="7" /></textarea></td></tr>
<?php
if(isset($_GET['field']) && $_GET['field']=='opdtemp')
{
?>
<tr><td>Diagnosis :</td><td><textarea name="diag" id="diag" cols="25" rows="7" /></textarea></td>
<tr><td>Advice :</td><td><textarea name="adv" id="adv" cols="25" rows="7" /></textarea></td>
<?php
}
?>
<tr><th colspan="2" align="center"><input type="hidden" name="field" id="field" value="<?php if(isset($_GET['field'])){ echo $_GET['field']; } ?>" /> <input type="submit" name="tempsub" value="Create Template" style="background:#CCCCCC; height:40px; width:150px" />
&nbsp;&nbsp;&nbsp;<input type="button" name="canc" value="Cancel" style="background:#CCCCCC; height:40px; width:150px" onclick="window.close()" />
</th></tr>

</table>

</form></center>
</body>
</html>
