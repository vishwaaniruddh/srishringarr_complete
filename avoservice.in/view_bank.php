<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_bank.php?id="+id;
	}
	
}
</script>
</head>

<body>
<center>
<h2>View Banks</h2>
<div id="header">
<table width="506" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;">
<th width="209">Name</th>
<th width="170">Edit</th>
<th width="107">Delete</th>

<?php
include_once('class_files/select.php');
$sel_obj=new select();
$city_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"bank","","",array(""),"y","bank_name","a");
while($row=mysqli_fetch_row($city_head))
{
	
?>
<tr>
<td><?php echo $row[1]; ?></td>
<td width="170" height="31"> <a href='edit_bank.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
<td width="107" height="31">  <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);"> Delete </a></td>
</tr>
<?php } ?>
</table>
</div>
</center>
</body>
</html>