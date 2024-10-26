<?php 
include('config.php');
session_start();

$id=$_GET['id'];
$sql="select * from login where username='$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

?>
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<link href="view_master_edit.css" rel="stylesheet" type="text/css" />
<link href="view_master.css" rel="stylesheet" type="text/css" />
<style>

</style>



	<div id="site_title_bar">
    
   	 
        
             <?php include("header_clinic.php")?>  <!--end of site title-->

       
        <h2>Edit User Password</h2>
        
          <form method="post" class="" action="update_user.php" >
                <fieldset>
                
                
            	<label>
                User Password:
                <input id="act" name="act" type="text" value="<?php echo $row[1]; ?>">
                </label>
                
                
                
                <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
                
                <button class="submit formbutton" type="submit">Submit</button>
                <button class="submit formbutton" type="button" onClick="javascript:location.href = 'userPassword.php';">Cancel</button>
                       
                </fieldset>
          </form>
</div> 
	<!-- end of site_title_bar  -->
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>