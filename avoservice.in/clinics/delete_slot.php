<?php

include('config.php');



try{

  		$slot_id = $_GET['slot_id'];

		$sql = "delete from slot where `block_id`='".$slot_id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:view_slot.php');

		}

		else

		echo "error deleting slot";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

