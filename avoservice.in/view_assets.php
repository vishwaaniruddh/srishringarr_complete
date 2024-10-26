<?php
include("access.php");
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

</head>

<body>
<center>
<?php include("menubar.php"); 
include('config.php');
?>



<h2>View Assets</h2>
<div id="header">
<table  border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;border:1px #fff solid" class="se">
<tr>
<th>Sr. No.</th>
<th>Assets Name</th>
<th>Specification</th>
<th>Company Name</th>
<th>Edit</th>
</tr>

<?php
$count=0;
$i=1;
$qry=mysqli_query($con1,"SELECT * FROM  `assets_specification`order by assets_id ASC ");
while($row=mysqli_fetch_row($qry)){
$count=$count+1;
$qry1=mysqli_query($con1,"select * from assets where assets_id='$row[1]'");
$row1=mysqli_fetch_row($qry1);
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $i++; ?></td>
<td><?php echo $row1[1];?></td>
<td><?php echo $row[2];?></td>
<td><?php echo $row[3];?></td>
<td><a href="edit_assetspec.php?id=<?php echo $row[0];?>" >Edit</a></td>
</tr>
<?php } ?>
</table></div>
</center>
</body>
</html>