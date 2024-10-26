<?php
session_start();

include('config.php');
$id=$_REQUEST['id'];

$sql="delete from Pmcalls where Id='".$id."'";
//echo "$sql";
$que=mysqli_query($con1,$sql);


if($que){?>

<script>
alert("deleted Successfuly!!!");

window.open("pmcalls_new.php","_self");

</script>
<?php
}

?>