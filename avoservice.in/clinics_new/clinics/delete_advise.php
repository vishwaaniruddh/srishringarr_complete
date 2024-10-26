<?php

include 'config.php';



try{

  		$id = $_GET['id'];

		$sql = "delete from advise where `advise_id`='".$id."'";

		$result = mysqli_query($con,$sql);

		if($result)

		{	

		 header('Location:home.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

