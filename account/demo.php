<?

$referer = $_SERVER['HTTP_REFERER'];


?>

<script>
    window.location.href="d.php?referer=<? echo $referer; ?>" ; 
</script>