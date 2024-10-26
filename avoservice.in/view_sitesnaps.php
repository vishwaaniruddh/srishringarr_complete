<!--<img src="AvologoFinals.jpg"/>-->
<?php
include('config.php');
$alertid=$_GET['aid'];
$sql=mysqli_query($con1,"select imgname from site_images where id=$alertid");
//echo "select imgname from site_images where id=$alertid";
while($sqlimg=mysqli_fetch_array($sql)){
//echo $sqlimg[0];
$sitefile='andi/img/'.$sqlimg[0];
//echo $sitefile;
?>
<img src="<?php echo $sitefile; ?>" alt="Smiley face" height="500" width="400" align="center">
<?php } ?>

