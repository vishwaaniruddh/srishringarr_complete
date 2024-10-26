<?php

class select
{
    private $column_count = "";

    private function columnlist_string_builder($array_columns)
    {
        $string_columns = "";
        $column_count = count($array_columns);
        for ($i = 0; $i < $column_count; $i++) {
            if ($i < $column_count - 1) {
                $string_columns = $string_columns . "" . $array_columns[$i] . ",";
            } else {
                $string_columns = $string_columns . "" . $array_columns[$i] . "";
            }
        }
        return $string_columns;
    }

    public function select_rows($server_name, $db_username, $db_password, $db_name, $array_columns, $table_name, $ref_column_name, $ref_column_value, $arr_table_head_row, $return_table_y_n, $orderby_col_name, $orderby_a_d)
    {
        include_once 'database_connection.php';
        $con_obj = new database_connection();
        $con_obj->open_connection($server_name, $db_username, $db_password, $db_name);
        $string_columns = $this->columnlist_string_builder($array_columns);
        $select_internal_obj = new select();
        $h = $arr_table_head_row;
        $r = $return_table_y_n;

        //without where clause:
        if ($ref_column_name == "" and $ref_column_value == "") {
            //order by
            if ($orderby_a_d == "a") {
                $table = mysqli_query($conc,"select $string_columns from $table_name order by $orderby_col_name asc");
                if ($table) {
                    $tab = $select_internal_obj->table_formation($h, $table, $r);
                    return $tab;
                } else {
                    return false;
                }

            } else if ($orderby_a_d == "d") {
                $table = mysqli_query($conc,"select $string_columns from $table_name order by $orderby_col_name desc");
                if ($table) {
                    $tab = $select_internal_obj->table_formation($h, $table, $r);
                    return $tab;
                } else {
                    return false;
                }

            } else {
                $table = mysqli_query($conc,"select $string_columns from $table_name");
                if ($table) {
                    $tab = $select_internal_obj->table_formation($h, $table, $r);
                    return $tab;
                } else {
                    return false;
                }

            }

        }
        //with where clause:
        else {
            //order by
            if ($orderby_a_d == "a") {
                $table = mysqli_query($conc,"select $string_columns from $table_name where $ref_column_name = '$ref_column_value' order by $orderby_col_name asc");
                if ($table) {
                    $tab = $select_internal_obj->table_formation($h, $table, $r);
                    return $tab;
                } else {
                    return false;
                }

            } else if ($orderby_a_d == "d") {
                $table = mysqli_query($conc,"select $string_columns from $table_name where $ref_column_name = '$ref_column_value' order by $orderby_col_name desc");
                if ($table) {
                    $tab = $select_internal_obj->table_formation($h, $table, $r);
                    return $tab;
                } else {
                    return false;
                }

            } else if ($orderby_a_d == "") {
                $table = mysqli_query($conc,"select $string_columns from $table_name where $ref_column_name = '$ref_column_value'");
                if ($table) {
                    $tab = $select_internal_obj->table_formation($h, $table, $r);
                    return $tab;
                } else {
                    return false;
                }

            }

        }
        $con_obj->close_connection();
    }

    private function table_formation($arr_table_head_row, $table, $return_table_y_n)
    {
        $r = $return_table_y_n;
        $h = $arr_table_head_row;
        $t = $table;
        if ($r == "n") {
            $column_count = count($h);
            echo "<table border = '1'>";
            echo "<tr>";
            foreach ($h as $arr_table_head) {
                echo "<th>" . $arr_table_head . "</th>";
            }
            echo "</tr>";
            //table contents
            echo "<tr>";
            while ($row = mysqli_fetch_row($table)) {
                echo "<tr>";
                for ($i = 0; $i < $column_count; $i++) {
                    echo "<td>" . $row[$i] . "</td>";
                }
                echo "</tr>";
            }
            echo "</tr>";
            echo "</table>";
        } else if ($r == "y") {
            return $t;
        } else {
            echo "Please enter correct arguments";
        }
    }
}
