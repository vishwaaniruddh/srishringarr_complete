<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from area where `area_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:viewarea.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

