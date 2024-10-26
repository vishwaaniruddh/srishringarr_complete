<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "update login set status=0 where `id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location: userPassword.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

