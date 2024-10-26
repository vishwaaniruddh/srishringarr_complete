<? include('config.php');

$id = $_REQUEST['id'];

$update = "update blogs set status=0 where id='".$id."'" ; 
if(mysqli_query($con,$update)){
    echo 'Blog deleted Successfully !'    ;
}else{
    echo 'Some error Occured !' ; 
}




?>

<br>
<a href="allblogs.php">Go Back</a>