<?php

class filter
{
    public function filter_by($server_name, $db_username, $db_password, $db_name, $arry_final_columns, $table, $array_filtbycol, $array_filtbyval, $order_by_col, $order_by_a_d)
    {
        //echo "i am in filter_by";
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection($server_name, $db_username, $db_password, $db_name);
        include_once 'string_builder.php';
        $str_obj = new string_builder();
        $final_col_str = $str_obj->string_with_commas($arry_final_columns);
        $where_str = "";
        if (count($array_filtbycol) == count($array_filtbyval)) {

            for ($i = 0; $i < count($array_filtbycol); $i++) {
                if ($i < count($array_filtbycol) - 1) {
                    $where_str .= $array_filtbycol[$i] . "='" . $array_filtbyval[$i] . "' and ";
                } else {
                    $where_str .= $array_filtbycol[$i] . "='" . $array_filtbyval[$i] . "'";
                }
            }

        }
        //echo $where_str;
        if ($order_by_a_d == "") {
            //echo "select $final_col_str from $table where $where_str";
            $result = mysqli_query($conc,"select $final_col_str from $table where $where_str");
            $con_obj->close_connection();
        } else if ($order_by_a_d == "a") {
            $result = mysqli_query($conc,"select $final_col_str from $table where $where_str order by $order_by_col asc");
            $con_obj->close_connection();
        } else if ($order_by_a_d == "d") {
            $result = mysqli_query($conc,"select $final_col_str from $table where $where_str order by $order_by_col desc");
            $con_obj->close_connection();
        } else {
            return false;
        }

        return $result;

    }
}

//Testing:
//$ob=new filter();
//$obj=$ob->filter_by('localhost','site','site','atm_site',array("*"),'atm',array("city","pincode"),array("Mumbai","400092"),"bank_name","d");
//
//include_once('table_formation.php');
//$format=new table_formation();
//$format->table_forming(array("","","","","",""),$obj,'n');
