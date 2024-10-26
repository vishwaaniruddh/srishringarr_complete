<?php

include('config1.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from admission where `ad_id`='".$id."'";

		$result = mysql_query($sql);

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

