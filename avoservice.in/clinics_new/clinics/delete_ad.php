<?php

include 'config1.php';



try{

  		$id = $_GET['id'];

		$sql = "delete from admission where `ad_id`='".$id."'";

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

