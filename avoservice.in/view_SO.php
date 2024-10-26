<?php include("access.php");
include("config.php");
//include("search_pmalert_new.php");
$getdata=$_GET['id'];

//echo "hello : ".$getdata;

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<!--validation-->

</head>



<body>


<center>
<?php // include("menubar.php"); ?>
<h2>All Updates Remarks</h2>
<table>
<?php $qry=mysqli_query($con1,"select * from SO_Update where so_id='".$_GET['id']."' and remarks_type='".$_GET['typ']."'");
//echo "select * from SO_Update where po_id='".$_GET['id']."'"; 
?>
<th>sr.no.</th>
<th>Date</th>
<th>Remarks Update</th>
<?php 
$s=1;
while($data=mysqli_fetch_array($qry)){?>
<tr>
<td><?php echo $s; ?></td>
<td><?php echo $data[2]; ?></td>
<td><?php echo $data[3]; ?></td>
</tr>
<?php $s++; }?>
</table>
</form>
</div>
</center>
</body>
</html>