<?php
include("access.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Factory</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script src="popup.js" type="text/jscript" language="javascript"> </script>

<body>
<center>
<?php include("menubar.php"); ?>

<h2>View Factories</h2>
<div id="header"><button id="myButtonControlID" onClick="tableToExcel('custtable', 'Table Export')">Excel</button>


<form name="frm1" method="post" >

<table width="590" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable">
<tr>
<th width="10">S.No</th>
<th width="100">Product Master</th>
<th width="100">Product Specs</th>

</tr>

<?php

$count=0;
include("config.php");

$str="select * from factory_productlist order by prod_id ASC";

//echo $str;
$table=mysqli_query($con1,$str);

$Num_Rows = mysqli_num_rows ($table);
?>
 <div align="center">Total Number Of Records := <?php echo $Num_Rows; ?> </div>
 <?php
//echo $str ;

$qry=mysqli_query($con1,$str);

while($row=mysqli_fetch_row($qry))
{
$count=$count+1;

$prodqry=mysqli_query($con1,"select * from factory_product_master where prod_id='".$row[1]."'");
$prod=mysqli_fetch_row($prodqry);

?>


<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
    
<td><?php echo $count; ?></td>
<td><?php echo $prod[1]; ?></td>
<td><?php echo $row[2]; ?></td>

<?php }  ?>
</tr>

</table>
</div>
</form>
</center>
</body>
</html>