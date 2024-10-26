<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from city where `city_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:viewcity.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

