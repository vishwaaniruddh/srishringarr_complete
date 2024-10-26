<?php 
include('config.php');

function get_all_buyer(){
    $sql = mysql_query("select * from buyer where status = 1");
    $result = mysql_fetch_assoc($sql);
    return $result;
}

function get_all_customer(){
    $sql = mysql_query("select * from customer where status = 1");
    $result = mysql_fetch_assoc($sql);
    return $result;
}
function get_all_customers(){
    $sql = mysql_query("select * from assets where ");
    $result = mysql_fetch_assoc($sql);
    return $result;
}

function get_delivery_type(){
    $sql = mysql_query("select * from delivery_type where status = 1");
    //$result = mysql_fetch_assoc($sql);
    return $sql;
}

function get_modeOfSale(){
    $sql = mysql_query("select * from modeOfSale where status = 1");
    //$result = mysql_fetch_assoc($sql);
    return $sql;
}

?>