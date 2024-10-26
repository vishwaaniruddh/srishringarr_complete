<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "update`appoint` set cancstat='1' where `app_real_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:View_app.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

