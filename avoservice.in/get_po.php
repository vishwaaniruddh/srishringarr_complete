<?php
session_start();
include('config.php');

$cust=$_GET['cust'];
$br2='';
$br=$_SESSION['branch'];
if($_SESSION['branch']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con1,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}
  ?>
 
<select name="po" id="po" onchange="assets();">
<option value="0">select</option>
<?php 
$str="SELECT DISTINCT po FROM `atm`  where cust_id='$cust'";
if($_SESSION['branch']!='all')
{
$str.=" and state in($br2)";

}
$str.=" order by po ASC";
			$result4=mysqli_query($con1,$str);
			while ($row4=mysqli_fetch_row ($result4))
				{ ?>

            <option value="<?php echo $row4[0];?>"><?php echo $row4[0];?></option>
            <?php } ?>
</select>