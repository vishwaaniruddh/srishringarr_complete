<?php
include('config.php');

$po=$_GET['po'];
$out="";
$qry="SELECT * FROM atm where po='$po'";
$res=mysqli_query($con1,$qry);

?>
<select name="ref_id" id="ref_id" onchange="atmid();">
<option value="0">select</option>
<?php
while($atmrow=mysqli_fetch_row($res)){ 
?>
<option value="<?php echo $atmrow[1]; ?>"><?php echo $atmrow[1]; ?></option>
<?php
}
?>
</select>