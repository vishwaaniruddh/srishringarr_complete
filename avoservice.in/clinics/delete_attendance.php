<?php

include('config.php');



try{

  		$id = $_GET['atdate'];

		$sql = "delete from attend where `atdate`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:viewattendence.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

