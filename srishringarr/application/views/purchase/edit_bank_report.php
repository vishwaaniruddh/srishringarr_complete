<?php
include('config.php');
$qry=mysql_query("update bank_transaction set trans_memo='".addslashes($_REQUEST['rem'])."' where trans_id='".$_REQUEST['id']."'");
if($qry)
echo "1";
else
echo "0";
?>