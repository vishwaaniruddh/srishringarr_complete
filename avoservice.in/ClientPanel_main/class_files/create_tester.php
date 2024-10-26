<?php
include('create.php');
$create_obj=new create();
$bool=$create_obj->create_table("localhost","abc","abc","assign","miti",array("temp_id int","temp_name varchar(20)"));
if($bool)echo "Table created successfully!";
else echo "Could not create the table";
?>