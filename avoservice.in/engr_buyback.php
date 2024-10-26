<?php
session_start();
include('config.php');

$alert_id=$_GET['id']; // alert id
        ?>
<html>
    <head>
<script type='text/javascript' src='jquery-1.6.2.min.js'></script>
<script type='text/javascript' src='jquery-ui-1.8.14.custom.min.js'></script>
    
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>


<body>

<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >

<?php

$sqlqry = mysqli_query($con1,"SELECT * from buyback_engg where alert_id='".$alert_id."'");

//echo "SELECT * frm buyback_engg where alert_id='".$alert_id."'";


$coll=mysqli_fetch_row($sqlqry);
?>
<tr><th width="10%">Buyback Available</th><td> <? echo $coll[4]; ?> </td></tr>
<tr><th width="10%"> Is Buyback Collected</th><td> <? echo $coll[8]; ?> </td></tr>


<tr>
<th width="10%">Product</th>
<th width="10%">Model</th>
<th width="10%">Qty</th> 
</tr>
<?

$result = mysqli_query($con1,"SELECT * from buyback_engg where alert_id='".$alert_id."'");
while ($row = mysqli_fetch_array($result)){ ?>

<tr>
<td><?php echo $row[5]; ?></td>
<td><?php echo $row[6]; ?></td>
<td><?php echo $row[7]; ?></td>

</tr>
<? } ?>
</table>

<center><button onclick="goBack()">Close </button></center>

<script>
function goBack() {
 window.close();

}
</script>
</body>
</html>
 