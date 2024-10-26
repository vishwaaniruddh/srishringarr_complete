<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from medicine where `med_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:view_dosage.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

