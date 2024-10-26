<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from opd where `opd_real_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:view_opd.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

