<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from doctor_ref where `ref_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:newrefdoc.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

