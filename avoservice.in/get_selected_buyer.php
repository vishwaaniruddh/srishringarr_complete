<? include('config.php');

$customer_vertical = $_POST['customer_vertical'];

	$sql_buyer = mysqli_query($con1,"select * from buyer where status = 1 and buyer_vertical='".$customer_vertical."' ");

	while($result = mysqli_fetch_assoc($sql_buyer)){ 

        $buyer_name=$result['buyer_name'];
        $buyer_id=$result['buyer_ID'];;						
    						
        echo '<option value="'.$buyer_name.'" data-value="'.$buyer_id.'"></option>';
	    					
    } 

?>


