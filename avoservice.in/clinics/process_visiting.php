<?php

include('config.php');
$id=$_POST['id'];
$doc=$_POST['doc'];
$remark=$_POST['remark'];
$adid=$_POST['ad'];

mysql_query("insert into doc_visit(pid,admit_id,doc_id,remark) values('$id','$adid','$doc','$remark')");

header('location:home.php');


?>