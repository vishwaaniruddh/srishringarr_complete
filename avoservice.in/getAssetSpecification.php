<?php
include('config.php');
?>
<!--<option value="">Select Model</option>-->
<?php
    $asset_id = $_POST['asset_id'];
    $sql_assets_specification = mysqli_query($con1,"select * from assets_specification where assets_id = '".$asset_id."' ");
    while ($row = mysqli_fetch_assoc($sql_assets_specification)) {
    ?>
        <option value="<?php echo $row["ass_spc_id"]; ?>"><?php echo $row["name"]; ?></option>
    <?php   } ?>



