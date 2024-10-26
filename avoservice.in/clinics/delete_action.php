<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from action where `action_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:viewaction.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

