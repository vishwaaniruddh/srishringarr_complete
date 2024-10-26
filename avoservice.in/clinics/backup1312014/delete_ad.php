<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from admission where `ad_real_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:viewipd.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

