<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from keyword where `keyword_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:view_diagkey.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>