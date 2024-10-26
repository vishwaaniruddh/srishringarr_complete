<? include('config.php');
$id = $_REQUEST['id'];
  mysqli_query($con,"delete from garment_product where gproduct_id='".$id."'");
?>
<script>
    window.location.href="productclass.php";
</script>