<?php

session_start();
include('config.php');

$oldeng=$_POST['oldengg'];
$newid=$_POST['neweng'];
$user = $_SESSION['user'];



$qry=mysqli_query($con1,"update engg_site_mapping_warr set engg_id= '".$newid."' where engg_id='".$oldeng."' ");
$qry2=mysqli_query($con1,"update engg_site_mapping set engg_id= '".$newid."' where engg_id='".$oldeng."' ");

if($qry && $qry2 )
{
	?>
<script type="text/javascript">
alert("Engineer has been Edited successfully");
window.onunload = refreshParent;
        function refreshParent() {
           window.opener.location.reload();
        }
		window.close(); 
</script>
<?php	
}
else
echo "Error in Updating ";
?>