<?php
 
class DB_Connect {
 
    // constructor
    function __construct() {
 
    }
 
    // destructor
    function __destruct() {
        // $this->close();
    }
 
    // Connecting to database
    public function connect() {
        // require_once 'config.php';
        require_once 'db_conn.php';
        // connecting to mysql
        $conapp = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
        // selecting database
        mysqli_select_db(DB_DATABASE);
     //   $con = mysqli_connect(DB_HOST , DB_USER , DB_PASSWORD ,DB_DATABASE);
        // return database handler
        return $con;
    }
 
    // Closing database connection
    public function close() {
        mysqli_close();
    }
 
} 
?>