<?php 

include($_SERVER["DOCUMENT_ROOT"]."/CRM/config.php"); 

$id=$_GET['id'];

$sql = "UPDATE customer SET status=0 WHERE id='".$id."'";


if ($conn->query($sql) === TRUE) { ?>
    <script>
setTimeout(function() { 
   window.history.back();
}, 1000);
    	alert('successfully deleted !!');
    	
</script>
    
<?php  } else { ?>
    <script>alert('Error in updation !!')</script>

<?php }


$conn->close();
 ?>



