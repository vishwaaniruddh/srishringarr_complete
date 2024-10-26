<? session_start(); 

$_SESSION['delivery'] = $_POST['delivery'];
$_SESSION['pickup'] = $_POST['pickup'];
$_SESSION['total_rental'] = $_POST['total_rental'];        


?>
<script>
    window.location.href="pay.php";
</script>