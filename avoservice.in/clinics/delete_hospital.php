<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from hospital where `hospital_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location: viewhospital.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

