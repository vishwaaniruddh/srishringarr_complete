<?php

include('config.php');



try{

  		$id = $_GET['id'];

		$sql = "delete from patient where `srno`='".$id."'";

		$result = mysql_query($sql);

		if($result)

		{	

		 header('Location:view_patient1.php');

		}

		else

		echo "error deleting data";

		}

		catch(Exception $e)

		{

		 echo "Exception ".$e->getMessage();

		 }

?>

