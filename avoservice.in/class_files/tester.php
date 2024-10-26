<?php
class tester{
function test(){
		include('insert.php');
		include('update.php');
		include('delete.php');
		include('select.php');
		include('create.php');
		include('drop.php');
		$io=new insert();
		$uo=new update();
		$do=new delete();
		$so=new select();
		$co=new create();
		$dro=new drop();
		//$bool=$co->create_table("localhost","abc","abc","assign","mytable",array("id int","name varchar(20)"));
		//if($bool) echo "Success<br>";
		//else echo "Failure<br>";
		//$bool1=$io->insert_into("localhost","abc","abc","assign","mytable",array("id","name"),array("3","Mamta"));
		//if($bool1) echo "inserted"; else echo "not inserted<br>";
		//$bool2=$io->insert_into("localhost","abc","abc","assign","mytable",array("id","name"),array("2","Arun"));
		//if($bool2) echo "inserted2"; else echo"not inserted2<br>";
		//$bool3=$uo->update_table("localhost","abc","abc","assign","mytable","name","Vishal","id","2");
		//if($bool3) echo "updated"; else echo "not updated<br>";
		//$so->select_rows("localhost","abc","abc","assign",array("id","name"),"mytable","","",array("ID","NAME"),"n","name","d");
		$bool=$dro->drop_table("localhost","abc","abc","assign","temp");
		if($bool) echo "Dropped";
		else echo "Could not drop";
}
}
$test_obj=new tester();
$test_obj->test();
