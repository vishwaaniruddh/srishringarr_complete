<?php

include 'config.php';



try{

  		$id = $_GET['id'];

		$sql = "delete from diagnose where `d_id`='".$id."'";

		$result = mysqli_query($con,$sql);

		if($result)

		{	

		 header('Location:view_diag.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>
