<?php

class insert
{
    private $column_count;
    private function column_string_builder($arr_columns)
    {
        $string_columns = "";
        $this->column_count = count($arr_columns);
        for ($i = 0; $i < $this->column_count; $i++) {
            if ($i < $this->column_count - 1) {
                $string_columns = $string_columns . "" . $arr_columns[$i] . ",";
            } else {
                $string_columns = $string_columns . "" . $arr_columns[$i] . "";
            }
        }
        return $string_columns;
    }

    private function value_string_builder($arr_values)
    {
        $string_values = "";
        $value_count = count($arr_values);
        if ($this->column_count == $value_count) {
            for ($i = 0; $i < $this->column_count; $i++) {
                if ($i < $this->column_count - 1) {
                    $string_values = $string_values . "'" . $arr_values[$i] . "',";
                } else {
                    $string_values = $string_values . "'" . $arr_values[$i] . "'";
                }
            }
            return $string_values;
        } else {
            return false;
        }
    }

    public function insert_into($server_name, $db_username, $db_password, $db_name, $table_name, $arr_columns, $arr_values)
    {
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection($server_name, $db_username, $db_password, $db_name);
        $string_columns = $this->column_string_builder($arr_columns);
        $string_values = $this->value_string_builder($arr_values);
        if ($string_values) {
            if ($string_columns == '*') {
                $bool = mysqli_query($conc,"insert into $table_name() values ($string_values)");
                $con_obj->close_connection();
                if ($bool) {
                    return true;
                } else {
                    return false;
                }

            } else {
                $bool = mysqli_query($conc,"insert into $table_name($string_columns) values ($string_values)");
                $con_obj->close_connection();
                if ($bool) {
                    return true;
                } else {
                    return false;
                }

            }
        } else {

            return false;
        }

    }
}
