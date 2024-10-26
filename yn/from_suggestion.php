<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css" integrity="sha512-c7jR/kCnu09ZrAKsWXsI/x9HCO9kkpHw4Ftqhofqs+I2hNxalK5RGwo/IAhW3iqCHIw55wBSSCFlm8JP0sw2Zw==" crossorigin="anonymous" referrerpolicy="no-referrer">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider-min.js" integrity="sha512-BmoWLYENsSaAfQfHszJM7cLiy9Ml4I0n1YtBQKfx8PaYpZ3SoTXfj3YiDNn0GAdveOCNbK8WqQQYaSb0CMjTHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php

include('config.php');


$cid=$_POST['cid'];
$sid=$_POST['sid'];

echo $cid;echo $sid;

$sql="select * from `jewel_subcat` where subcat_id='$cid'";
$result = mysqli_query($con,$sql);
$row=mysqli_fetch_row($result);

$sql2="select * from  `subcat1`  where maincat_id='$cid' and subcat_id='$sid' ";
$result2 = mysqli_query($con,$sql2);
$row2=mysqli_fetch_row($result2);
$sq="select * from  `product` where subcat_id='$sid' order by product_code ASC";
echo $sq;

?>