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
		document.location="delete_areahead.php?id="+id;
	}
	
}
</script>
</head>

<body>
<center>
<h2>View Area Head</h2>
<div id="header">
<table width="590" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;">
<th width="50">Name</th>
<th width="111">City</th>
<th width="70">Area</th>
<th width="68">Email</th>
<th width="79">Contact</th>
<th width="40">Edit</th>
<th width="45">Delete</th>

<?php
include_once('class_files/select.php');
$sel_obj=new select();
$city_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_head","","",array(""),"y","head_name","a");
while($row=mysqli_fetch_row($city_head))
{
	
?>
<tr>
<td><?php echo $row[1]; ?></td>
<td><?php echo $row[3]; ?></td>
<td><?php echo $row[2]; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php echo $row[5]; ?></td>
<td width="40" height="31"> <a href='edit_areahead.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
<td width="45" height="31">  <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);"> Delete </a></td>
</tr>
<?php } ?>
</table>
</div>
</center>
</body>
</html>