<?php

class drop
{
    public function drop_table($server_name, $db_username, $db_password, $db_name, $table_name)
    {
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection($server_name, $db_username, $db_password, $db_name);
        $bool = mysqli_query($conc,"drop table $table_name");
        if ($bool) {
            return true;
        } else {
            return false;
        }

        $con_obj->close_connection();
    }
}
