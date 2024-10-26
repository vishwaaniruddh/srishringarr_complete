<?php 
include('config.php');
$br1=$_GET['brid'];

$sql="select `engg_id`,`engg_name`,`area`,`city` from `area_engg` where `area`= '".$br1."' and `status`=2 order by engg_name ASC";
//echo $sql;
$engg=mysqli_query($concs,$sql);
?>

<select name="eng" id="eng" >
<option value="0">select</option>
<?php
while($row=mysqli_fetch_row($engg)){ 

$q=mysqli_query($concs,"select state from state where state_id='".$row[2]."'");
$r=mysqli_fetch_row($q);

$q2=mysqli_query($concs,"select city from cities where city_id='".$row[3]."'");
$r2=mysqli_fetch_row($q2);
?>

<option value="<?php echo $row[0]; ?>"><?php echo $row[1]." (".$r2[0].")"; ?></option>
<?php
}
?>
</select>