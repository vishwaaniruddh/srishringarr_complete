<?php
include '../config.php';
$track_id = $_GET['id'];

//$sql="DELETE FROM `atm` WHERE  `track_id`='".$track_id."'";
$sql = "DELETE FROM `pending_installations` WHERE `atmid`='" . $track_id . "' and status=0";
//echo $sql;
$result = mysqli_query($con1, $sql);
if ($result) {
    header("Location:pending_site.php?success=Your Call Deleted Successfully");
}
