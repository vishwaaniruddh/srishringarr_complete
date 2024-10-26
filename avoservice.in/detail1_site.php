<?php
include("access.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Amc Detail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<script src="jquery-1.8.3.js"></script>
<script>
$(document).ready(function(){
console.log('hi');
$('#successa').hide();
$('#successd').hide();
var hiddenid = $('#hiddenid').val();
console.log(hiddenid);
$('#activate').click(function(){
if (confirm('Are you sure you want to activate this site?')){
$.post('activate.php',{'hiddenid':hiddenid});
$("#successa").fadeIn('slow'); 
$('#successa').fadeOut('fast');
}
});

$('#deactivate').click(function(){
if (confirm('Are you sure you want to deactivate this site?')){
$.post('deactivate.php',{'hiddenid':hiddenid});
$("#successd").fadeIn('slow'); 
$('#successd').fadeOut('fast');
}
});

});

</script>
</head>

<body >
<center>
<?php  
include("config.php");

$id=$_GET['id'];
//echo "select * from Amc where amcid='$id'";
$qry=mysqli_query($con1,"select * from Amc where amcid='$id'");
$row=mysqli_fetch_row($qry);

///echo "select * from customer where cust_id='$row[2]'";
$qry1=mysqli_query($con1,"select * from customer where cust_id='$row[1]'");
$crow=mysqli_fetch_row($qry1);
?>


<h2> Site Detail </h2>
<div id="header">
<table  border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="se">
<tr>
<td width="377">Customer Name:&nbsp;<b><?php echo $crow[1]; ?></b></td>
<td width="474">Purchase Order:&nbsp;<b><?php echo $row[2]; ?></b></td>
</tr>
<tr><td height="103" colspan="2">

<table width="100%" border="1" cellpadding="4" cellspacing="0"><tr><th width="84">ATM Id</th>
<th width="155">Bank Name</th>
<th width="81">Area</th>
<th width="92">Pincode</th>
<th width="79">City</th>
<th width="78">State</th>
<th width="98">Address</th>
<th width="108">Ref_id</th>
<th width="230">Active/Deactive</th>
</tr>
<?php 
///echo "select * from atm where cust_id='$row[2]' and po='$row[11]'";
$qry2=mysqli_query($con1,"select * from Amc where amcid='".$id."'");
$detail=mysqli_fetch_row($qry2);
?>
<tr>
<td><?php echo $detail[3]; ?></td>
<td><?php echo $detail[4]; ?></td>
<td><?php echo $detail[5]; ?></td>
<td><?php echo $detail[6]; ?></td>
<td><?php echo $detail[7]; ?></td>
<td><?php echo $detail[12]; ?></td>
<td><?php echo $detail[9]; ?></td>
<td><?php echo $detail[10]; ?></td>
<td>
<?php if($detail[20]=='N'){ ?>
<input type=button name="activate" id="activate" value="Activate">
<?php }if($detail[20]=='Y') {?>
<input type=button name="deactivate" id="deactivate" value="Deactivate">
<?php } ?>
</td>
</tr>

</table>
</td>

</tr>
<tr><td align="right" colspan="2"><a href="#" onClick="window.open('addmoreasset.php?id=<?php echo $id; ?>&type=amc','addmoreasset','width=400px,height=300,left=200,top=40')">Add Asset</a></td></tr>
<tr>

<td height="119" colspan="2" valign="top">

<form method="post" action="process_editassets_amc.php"> 
<table width="100%"><tr><th width="60">Sr No.</th>
<th width="233">Assets Name</th>
<th width="200">Assets Specification</th>
<th width="344">Start Date </th>
<th width="344">End Date </th>

</tr>
<?php 
$i=1;
//echo "select * from amcassets where `siteid`='$id'";
$qry2=mysqli_query($con1,"select * from amcassets where `siteid`='$id'");
while($detail1=mysqli_fetch_row($qry2)){
//echo "select * from assets_specification where ass_spc_id='$detail1[2]'";
$qry3=mysqli_query($con1,"select * from assets_specification where ass_spc_id='$detail1[2]'");
$row3=mysqli_fetch_row($qry3);

$qry4=mysqli_query($con1,"select * from assets where assets_id='$row3[1]'");
$row4=mysqli_fetch_row($qry4);

$qry5=mysqli_query($con1,"select * from `amcpurchaseorder` where amcsiteid='".$id."'");
$row5=mysqli_fetch_row($qry5);

?>
<tr>
<!--========Sr No.=========-->
<td><?php echo $i++; ?></td>
<!--========Assets Name=========-->
<td><?php echo $row4[1]; ?></td>
<!--========Assets Spe=========-->
<td><?php  //echo $row3[2]; ?>
		<select name="assets[]" >
				<?php
                 
                $qry3=mysqli_query($con1,"select * from assets_specification where assets_id='".$row3[1]."'");	
                while($assets_spec=mysqli_fetch_array($qry3)){
            
                ?>
                <option value="<?php echo $assets_spec[0];  ?>" <?php if($row3[2]== $assets_spec[2]){ echo "selected"; } ?>> <?php echo $assets_spec[2]; ?> </option>		
                <?php } ?>
		</select>
</td>
<!--========Date=========-->
<td><?php 
 if($row5[3]!='0000-00-00'){ echo date('d/m/Y',strtotime($row5[3]));} ?></td>

<!--========Date=========-->
<td><?php if($row5[4]!='0000-00-00'){ echo date('d/m/Y',strtotime($row5[4]));} ?></td>

</tr>
<input type="hidden" name="site_id[]" id="site_id" value="<?php echo $detail1[0]; ?>" />
<?php } ?>
<tr><td colspan="5" align="center"> 
<input type="hidden" name="cust" id="cust" value="<?php echo $row[2]; ?>" />
<input type="hidden" name="po" id="po" value="<?php echo $row[11]; ?>" />
<input type="hidden" name="hiddenid" id="hiddenid" value="<?php echo $id; ?>" />

<input type="submit" name="submit" value="submit" /></td></tr>
</table>
</form>
</td></tr>
</table>

</div>
<p id="successa">Sucessfully activated</p>
<p id="successd">Sucessfully Deactivated</p>
</center>
</body>
</html>