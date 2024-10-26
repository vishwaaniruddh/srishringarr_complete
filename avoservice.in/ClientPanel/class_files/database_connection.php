<?php

class database_connection
{
    private $con;
    public function open_connection($server_name, $db_username, $db_password, $db_name)
    {
        //    $this->con = mysqli_connect($server_name,$db_username,$db_password);
        $this->con = mysqli_connect("localhost", "satyavan_acc", "Myaccounts123*");
        mysqli_select_db("satyavan_accounts");
    }

    public function close_connection()
    {
        mysqli_close($this->con);
    }
}
