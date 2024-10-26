<?php
 require_once("config.php");
 $params = $columns = $totalRecords = $data = array();
 $params = $_REQUEST;
 $columns = array(
 0 => 'id',
 1 => 'atmid', 
 2 => 'customer'
 );
 
 $where_condition = $sqlTot = $sqlRec = "";
 
 if( !empty($params['search']['value']) ) {
 $where_condition .= " WHERE ";
 $where_condition .= " ( atmid LIKE '%".$params['search']['value']."%' ";    
 $where_condition .= " OR customer LIKE '%".$params['search']['value']."%' )";
 }
 
 $sql_query = " SELECT * FROM rnm_fund ";
 $sqlTot .= $sql_query;
 $sqlRec .= $sql_query;
 
 if(isset($where_condition) && $where_condition != '') {
 
 $sqlTot .= $where_condition;
 $sqlRec .= $where_condition;
 }
 
 $sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";
 
 $queryTot = mysqli_query($con, $sqlTot) or die("Database Error:". mysqli_error($con));
 
 $totalRecords = mysqli_num_rows($queryTot);
 
 $queryRecords = mysqli_query($con, $sqlRec) or die("Error to Get the Post details.");
 
 while( $row = mysqli_fetch_row($queryRecords) ) { 
 $data[] = $row;
 } 
 
 $json_data = array(
 "draw"            => intval( $params['draw'] ),   
 "recordsTotal"    => intval( $totalRecords ),  
 "recordsFiltered" => intval($totalRecords),
 "data"            => $data
 );
 
 echo json_encode($json_data);
?>