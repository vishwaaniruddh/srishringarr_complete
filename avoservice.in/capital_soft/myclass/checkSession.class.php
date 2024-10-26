<?php
class checkSession
{
    private $user;
    private $branch;
    private $designation;
    private $errors;
    public function __construct()
    {
        $this->errors = array();
        $this->user = $_SESSION['user'];
        $this->branch = $_SESSION['branch'];
        $this->designation = $_SESSION['designation'];

    }

    public function process()
    {
        if ($this->valid_data()) {
            $this->chkSession();
        }

        return count($this->errors) ? 0 : 1;
    }

    public function filter($var)
    {
        return preg_replace('/[^a-zA-Z0-9@.]$/', '', $var);
    }

    public function chkSession()
    {
        //include("include/config.php");
        //$qry=mysqli_query($conc,"Select * from orgadmin_login where orglogid='$this->username' and password= '$this->password' LIMIT 1");
        if (!($_SESSION['user'] || $_SESSION['branch'] || $_SESSION['designation'])) {
            session_destroy();
            $this->errors[] = "Some Error Occurred. Please login again";

        } else {
            session_start();
        }

    }

    public function showErrors()
    {
        echo "<div class='error' align='center' style='display:block; backgroung=white'><h3>Error :</h3><h4>";
        foreach ($this->errors as $keys => $values) {
            echo $values . "<br>";
        }

        echo "</div>";
        ?>
        </div>
	<?php }

    public function valid_data()
    {
        if (empty($this->user) || empty($this->branch) || empty($this->designation)) {
            $this->errors[] = "Invalid Login";
        }

        return count($this->errors) ? 0 : 1;
    }

}

?>