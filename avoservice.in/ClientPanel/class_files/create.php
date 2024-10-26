<?php

class create
{
    public function create_table($server_name, $db_username, $db_password, $db_name, $table, $arr_column_and_datatype)
    {
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection($server_name, $db_username, $db_password, $db_name);
        include_once 'string_builder.php';
        $string_builder_obj = new string_builder();
        $column_and_datatype_string = $string_builder_obj->string_with_commas($arr_column_and_datatype);
        $bool = mysqli_query($conc,"create table $table($column_and_datatype_string)");
        if ($bool) {
            return true;
        } else {
            return false;
        }

        $con_obj->close_connection();
    }
}
