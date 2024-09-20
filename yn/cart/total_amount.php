<? include($_SERVER['DOCUMENT_ROOT'].'/config.php');

mysqli_query($conn,"delete from cart where user_id=0");

$sql_update="update cart set total_amt=qty*product_amt";

    if(mysqli_query($conn,$sql_update)){

       echo $sql_update;
    }
    else{
        echo -1;
    }


?>