<?php

class new_site
{
    public function drop_down($server_name, $db_username, $db_password, $db_name, $sel_id, $sel_table, $ref_col, $sel_value, $show_table, $show_col)
    {
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection($server_name, $db_username, $db_password, $db_name);
        $ref_table = mysqli_query($conc,"select $sel_id from $sel_table where $ref_col='$sel_value'");
        $ref_id = mysqli_fetch_row($ref_table);
        $show_table = mysqli_query($conc,"select $show_col from $show_table where $sel_id='$ref_id[0]'");
        $con_obj->close_connection();
        return $show_table;
    }

    public function create_new($atm_id, $cust_id, $bank_name, $pincode, $city, $state, $start_date, $address)
    {
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection("localhost", "satyavan_acc", "Myaccounts123*", "satyavan_accounts");
        $area_table = mysqli_query($conc,"select area from area where pincode = '$pincode'");
        $con_obj->close_connection();
        $area = mysqli_fetch_row($area_table);
        include_once 'insert.php';
        $ins_obj = new insert();
        $bool = $ins_obj->insert_into("localhost", "satyavan_acc", "Myaccounts123*", "satyavan_accounts", "atm", array("atm_id", "cust_id", "bank_name", "area", "pincode", "city", "state", "start_date", "address"), array($atm_id, $cust_id, $bank_name, $area[0], $pincode, $city, $state, $start_date, $address));
        //return $bool;
        if ($bool) {
            return true;
        } else {
            return false;
        }

    }

}
//e.g.: if i want a drop down of city column from city table when i select a state from state drop down from column state of state table i use the following function: Note that in place of "Maharashtra", use the variable giving selected value from drop down
//$ob=new new_site();
//$city_table=$ob->drop_down("localhost","site","site","atm_site","state_id","state","state","Maharashtra","city","city");
//nclude_once('table_formation.php');
//$tf_ob=new table_formation();
//$tf_ob->table_forming(array("City"),$city_table,"n");

//    //e.g.: if i want to enter site details in atm table, the following function should be used with variables for input fields:
//$bool=$ob->create_new("s655551","35","ICICI Bank","8237 avbf near sldij, street ajn","400092","Mumbai","Maharashtra",date("Y-m-d"));
//echo $bool;
//if($bool=="true") echo "Inserted";
//else echo "Failed to insert";
