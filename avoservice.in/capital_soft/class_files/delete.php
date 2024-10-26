<?php

class delete
{
    public function delete_from($server_name, $db_username, $db_password, $db_name, $table_name, $ref_col_name, $ref_col_value)
    {
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection($server_name, $db_username, $db_password, $db_name);
        $check_query = mysqli_query($conc,"select * from $table_name where $ref_col_name = '$ref_col_value'");
        if (mysqli_num_rows($check_query) > 0) {
            $bool = mysqli_query($conc,"delete from $table_name where $ref_col_name = '$ref_col_value'");
            if ($bool) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }

        $con_obj->close_connection();
    }
}
