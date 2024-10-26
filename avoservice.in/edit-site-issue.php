<?php
include("access.php");
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Avoups</title>
<style>
input[type=text] {
    width: 70%;
	height:50px;
    
    margin-bottom: 10px;
    background-color: #fff;
}
}
</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

</head>

<body>
<center>
<?php include("menubar.php"); ?>
<h2>Edit Site Issue </h2>
<div id="">
<form action="edit-siteprocess.php" method="get" name="siteform" enctype="multipart/form-data" id="siteform" onsubmit="">
<table style="width:40%;" >
<tr>

<?php 
$id=$_GET['id'];
$qry=mysqli_query($con1,"select * from `problemtype` where `probid`='".$id."'");
$qry1=mysqli_fetch_row($qry);
?>
<td width="30%">Problem : </td>
<td width="70%"><input type="text" name="ptype" id="ptype"  value="<?php echo $qry1[1];?>" /></td>
</tr>
<!--<tr><td colspan="2" align="center" height='35'> <h2>Questions</h2></td></tr>

<?php
for($i=1;$i<=5;$i++)
{

?>
<tr><td>Q.<?php echo $i ; ?> </td> <td align="right"><input type="text" name="quen[]" id="quen" value="" /></tr>

<?php
}

?>
-->


<tr>
<td colspan="2">
<input type="hidden" name="id" id="id"  value="<?php echo $qry1[0];?>" />
<input  type="submit" value="submit" class="readbutton" onclick=""/></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>