<?php
include("../config.php");
$app=array();
$sql4="select  type from apptype where type<>'' order by type ASC";
$result4 = mysql_query($sql4);
while($row4=mysql_fetch_row($result4)) {
$app[] = array( 'apptype' => $row4[0]);
  } 
  
    echo json_encode($app);
?>