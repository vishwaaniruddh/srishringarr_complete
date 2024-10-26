<?php
include("config.php");

$actname=$_GET['nameact'];
$num=$_GET['num'];
//echo $actname;
?>

	
	<select name="nameact[<?php echo $num ;?>]" id="nameact_<?php echo $num ;?>"  class="name_activity">
              <option value="">Select Name Activity</option>
                 <?php 
					$sql=mysqli_query($con1,"select * from `activity` where `type`='".$actname."'");
							while($row=mysqli_fetch_row($sql)){												
							?>
                    <option value="<?php echo $row[0] ; ?>"> <?php echo$row[2] ; ?></option>
                        <?php } ?>
     </select>
	