<?php

class DB_Functions 
{

    private $db;

    //put your code here
    // constructor
    function __construct() 
	{
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() 
	{
        
    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($username,$gcm_regid,$mac_id,$name,$email) 
	{
	// $result = mysqli_query($conapp,"INSERT INTO notification_tble(gcm_regid,mac_id,username) VALUES('$gcm_regid','$mac_id','$username')");
    if($gcm_regid){
    $qry=mysqli_query($conapp,"Select * from login where username='".$username."'");
$cdate = date('Y-m-d H:i:s');
if(mysqli_num_rows($qry)>0)
{
	
	$str="";
	$qryrow=mysqli_fetch_row($qry);
	if($qryrow[4]=='4')
{
	$qry1=mysqli_query($conapp,"Select engg_id from area_engg where loginid='".$qryrow[0]."'");
	$max=mysqli_fetch_row($qry1);
	$str=$max[0];
}
elseif($qryrow[4]=='3')
{
	$qry1=mysqli_query($conapp,"Select head_id from branch_head where loginid='".$qryrow[0]."'");
	$max=mysqli_fetch_row($qry1);
	$str=$max[0];
}
$sqlx=mysqli_query($conapp,"select * from notification_tble where pid='".$str."'");
if(mysqli_num_rows($sqlx)>0)
{
 $result = mysqli_query($conapp,"update notification_tble set username='".$username."',logid='".$qryrow[0]."',mac_id='".$mac_id."',gcm_regid='".$gcm_regid."',name='".$name."',email='".$email."',updt='".$cdate."' where pid='".$str."'");
 $qry="update engg_current_location set mac_id='".$mac_id."' where engg_id='".$str."'";
 mysqli_query($conapp,$qry);

 if ($result) {
                 return true;
              }
         else {
                return false;
              }                
}
else{
 $result = mysqli_query($conapp,"INSERT INTO notification_tble(username, gcm_regid,mac_id,logid,pid,name,email,created_at) VALUES('$username', '$gcm_regid','$mac_id','$qryrow[0]','$str','$name','$email','".$cdate."')");

//$xxx="INSERT INTO notification_tble(username, gcm_regid,mac_id,logid,pid,name,email,created_at) VALUES('$username', '$gcm_regid','$mac_id','$qryrow[0]','$str','$name','$email','".$cdate."')";            
    
    
        if ($result) {
            // get user details
            $id = mysqli_insert_id(); // last inserted id
        $result = mysqli_query($conapp,"SELECT * FROM notification_tble WHERE id = '".$id."'") or die(mysqli_error());
            // return user details
            if (mysqli_num_rows($result) > 0) {
                
            $xyz="insert into engg_current_location(engg_id,mac_id) values('".$str."','".$mac_id."')";
            mysqli_query($conapp,$xyz);
                return true;//mysqli_fetch_array($result);
            } else { 
                return false;
            }
        } else { 
            return true;
        }
        
        
        }
        //return $store;
    }
}
else
return false;
	}
    /**
     * Get user by email and password
     */
    public function getUserByEmail($email) {
        $result = mysqli_query($conapp,"SELECT * FROM notification_tble WHERE email = '$email' LIMIT 1");
        return $result;
    }

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysqli_query($conapp,"select * FROM notification_tble");
        return $result;
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysqli_query($conapp,"SELECT email from notification_tble WHERE email = '$email'");
        $no_of_rows = mysqli_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }

}

?>