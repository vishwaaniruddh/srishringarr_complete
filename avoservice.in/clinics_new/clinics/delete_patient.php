<?php

include 'config.php';



try{

  		$id = $_GET['id'];

		$sql = "delete from new_patient where `patient_id`='".$id."'";

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

