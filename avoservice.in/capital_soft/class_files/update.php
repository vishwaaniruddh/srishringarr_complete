<?php

class update
{
    public function update_table($server_name, $db_username, $db_password, $db_name, $table_name, $array_target_column_name, $array_new_value, $ref_column_name, $ref_column_value)
    {
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection($server_name, $db_username, $db_password, $db_name);
        $check_exists_query = mysqli_query($conc,"select * from $table_name where $ref_column_name = '$ref_column_value'");
        if (mysqli_num_rows($check_exists_query) > 0) {
            $set_str = "";
            if (count($array_target_column_name) == count($array_new_value)) {

                for ($i = 0; $i < count($array_target_column_name); $i++) {
                    if ($i < count($array_target_column_name) - 1) {
                        $set_str .= $array_target_column_name[$i] . "='" . $array_new_value[$i] . "',";
                    } else {
                        $set_str .= $array_target_column_name[$i] . "='" . $array_new_value[$i] . "'";
                    }
                }

            }
            //echo $set_str;
            $update_query = mysqli_query($conc,"update $table_name set $set_str where $ref_column_name = '$ref_column_value'");
            if ($update_query) {
                return true;
            } else {
                return false;
            }

            return true;
        } else {
            return false;
        }
        $con_obj->close_connection();
    }
}
