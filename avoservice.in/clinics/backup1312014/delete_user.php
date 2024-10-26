<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from login where `username`='".$id."'";

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

