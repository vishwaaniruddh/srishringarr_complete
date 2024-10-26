<?php
include "config.php";
class filter_new
{
    public function filter($atm_id, $cust_id, $bank_name, $area, $pincode, $city, $state, $from_date, $to_date)
    {

        $query_str = "select * from atm where 0=0 ";
        if ($atm_id != "") {
            $query_str .= "and atm_id like('$atm_id%')";
        }
        if ($cust_id != '') {
            /*echo "select * from customer where cust_id like('$cust_id%')";
            $qry1=mysqli_query($conc,"select * from customer where cust_name like('$cust_id%')");
            while($crow=mysqli_fetch_row($qry1)){
            echo $crow[0]."<br/>";*/

            $query_str .= "and cust_id like('$cust_id%')";

        }
        if ($bank_name != '') {
            $query_str .= "and bank_name like('$bank_name%')";
        }
        if ($area != '') {
            $query_str .= "and area like('$area%')";
        }
        if ($pincode != '') {
            $query_str .= "and pincode like('$pincode%')";
        }
        if ($city != '') {
            $query_str .= "and city like('$city%')";
        }
        if ($state != '') {
            $query_str .= "and state like('$state%')";
        }
        if ($from_date != '') {
            if ($to_date != '') {
                $query_str .= "and start_date between '$from_date' and '$to_date'";
            } else {
                $query_str .= "and start_date>='$from_date'";
            }
        } else {
            if ($to_date != '') {
                $query_str .= "and start_date<='$to_date'";
            }
        }
        //echo $query_str;

        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection('localhost', 'site', 'site', 'atm_site');
        $table = mysqli_query($query_str);
        $con_obj->close_connection();
        return $table;
    }

////////////filter
    public function filter1($atm_id, $cust_id, $bank_name, $area, $pincode, $city, $state, $from_date, $to_date)
    {

        $query_str = "select * from Amc where 0=0 ";
        if ($atm_id != "") {
            $query_str .= "and atmid like('$atm_id%')";
        }
        if ($cust_id != '') {
            $query_str .= "and cid like('$cust_id%')";
        }
        if ($bank_name != '') {
            $query_str .= "and bankname like('$bank_name%')";
        }
        if ($area != '') {
            $query_str .= "and area like('$area%')";
        }
        if ($pincode != '') {
            $query_str .= "and pincode like('$pincode%')";
        }
        if ($city != '') {
            $query_str .= "and city like('$city%')";
        }
        if ($state != '') {
            $query_str .= "and state like('$state%')";
        }
        /*if($from_date!=''){
        if($to_date!=''){
        $query_str.="and start_date between '$from_date' and '$to_date'";
        }
        else{
        $query_str.="and start_date>='$from_date'";
        }
        }
        else{
        if($to_date!=''){
        $query_str.="and start_date<='$to_date'";
        }
        }*/
        //echo $query_str;

        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection('localhost', 'site', 'site', 'atm_site');
        $table = mysqli_query($query_str);
        $con_obj->close_connection();
        return $table;
    }
}
//Testing:
/*$ob= new filter_new();
$tab=$ob->filter("","","Ba","","","","","","");
include_once('table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","","","","",""),$tab,"n");*/
