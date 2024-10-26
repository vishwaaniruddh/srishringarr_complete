<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from ins1 where `ins_id`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:view_instruction.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

