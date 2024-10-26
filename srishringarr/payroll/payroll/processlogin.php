<?
   session_start();
   include("header.php"); 
   include("functions.php");

?>


<?
    // FILE DOCUMENTATION
    // Filename    : processlogin.php
    // Description : This file accepts a login and a password from the form
    //               in login.php. It compares the login and password against
    //               employee records in the employee table. If there is a match
    //               it authenticates the user and set session variables for this
    //               admin session
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : logininc.php,personalpageinc.php,login.php
    
?>



<?

$r=getenv(http_referer);

// If user is not logged in and accesses processlogin.php 
// directly without being called from login.php then,
// Display login Screen
//
// $_SESSION[auth]= x {x=1 : Loggged in | x=0 Not Logged in }

/*
if (($r=="") and ($_SESSION[auth]!=1))
{

       include("logininc.php");

}
*/
// Otherwise if user is not logged in
// and processlogin has been accesed from another script

if ($_SESSION[auth]!=1)
{

       // Query to get employee informatiob based on login and password entered
       
       $query = "select empid,login,password,firstname,lastname,email,admin,superadmin,deptid,parentid from employee where login='".$_POST['formlogin']."'";
// echo $query;
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
 
       $number = MYSQL_NUMROWS($result);


       $_SESSION['auth']=0;
       $_SESSION['admin']=0;
       $_SESSION['superadmin']=0;
 
       if ($number==0)
       {
 
             echo "<h3>Error !!</h3><br><h4>No such login exist in our system.</h4><br>$back<br>";

             $_SESSION['auth']=0;
             $_SESSION['admin']=0;
             $_SESSION['superadmin']=0;
             $_SESSION['login']=$loginch;
             $_SESSION['starttime']=date("Y-m-d H:i:s"); 
            // session_register("session");    
 
       }
       else if ($number>0)
       {
 
             $loginch = mysql_result($result,0,"login");
             $passwordch = mysql_result($result,0,"password");
             $empid=mysql_result($result,0,"empid");
             $admin=mysql_result($result,0,"admin");
             $superadmin=mysql_result($result,0,"superadmin");
             $firstname=mysql_result($result,0,"firstname");
             $lastname=mysql_result($result,0,"lastname");
             $deptid=mysql_result($result,0,"deptid");
             $parentid=mysql_result($result,0,"parentid");
             $email=mysql_result($result,0,"email");
 
 
             // Checking if password entered matches database password
             // If passwords do not march, display error message
             if ($_POST['formpassword']!=$passwordch)
             {
  
                 echo "<h2>Wrong Password ! $back <br></h2>";
                 $_SESSION['auth']=0;
                // session_register("session");
 
             }
             // If passwords match
             // Then Authentification is allright
             // Set Session Variables to authenticate user
             else if ($_POST['formpassword']==$passwordch)
             {
             
                 // Setting Session Variables
                 // These session variables can be used from any page
                 // where a session is started. Syntax for session variable use
                 //    $_SESSION[variable]
                 // where variable can be ny one of the following
                 //
                 // auth       { 1, Authenticated | 0, Not authenticated}
                 // login      { login of the user }
                 // startime   { time the user started this session }
                 // empid      { Employee ID }
                 // deptid     { Department ID }
                 // parentid   { Parent (Boss) of this employee, another employee }
                 // lastname   { Employee Last Name } 
                 // firstname  { Employee First Name }
                 // email      { Employee Email Address }
                 // admin      { 0, No Admin Access | 1, Admin Access }  
                 // superadmin { 0, No SuperAdmin Access | 1, Super Admin Access }
                  
                 $_SESSION['auth']=1; 
                 $_SESSION['login']=$loginch;
                 $_SESSION['starttime']=date("Y-m-d H:i:s");
                 $_SESSION['empid']=$empid;
                 $_SESSION['deptid']=$deptid;
                 $_SESSION['parentid']=$parentid;
                 $_SESSION['lastname']=$lastname;
                 $_SESSION['firstname']=$firstname;             
                 $_SESSION['email']=$email;
             
                 // User has Super Admin Privileges
                 if ($superadmin==1)
                 {
                 
                     $_SESSION['superadmin']=1;
                     $_SESSION['admin']=1;
                     
                     echo "<h2>Admin User</h2>";
                     
                 }
                 // User had regular Admin Privileges
                 else if ($admin==1)
                 {
                     
                     $_SESSION['superadmin']=0;
                     $_SESSION['admin']=1;
                     
                     echo "<h2>Admin User</h2>";
                     
                 }
                 // User is a Regular user
                 else
                 {
                 
                     $_SESSION['superadmin']=0;
                     $_SESSION['admin']=0;
                     
                     
                     echo "<h2>Regular User</h2>";

                 }

                 // Saving Session Variabls to Server
                // session_register("session");

                 // Query to update employee login data
                 $queryu="update employee set numlogins=numlogins+1,lastlogindate='$datetime',loginip='$ipaddress' where empid='$empid';"; 

                 $resultu = MYSQL_QUERY($queryu) or die("SQL Error Occured : ".mysql_error().':'.$queryu);

                    // If user has superadmin status
   // then display super admin Home Page   
   if ($superadmin==1)
   {//echo "Hi superadmin".$_SESSION['superadmin'];
   	
       echo "<meta http-equiv=\"Refresh\" content=\"2; url=$siteaddress/admin/index.php\">\n\n<br><br><h3>You will now be transported to the Administrator Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/admin/index.php\">here</a> to continue. Thanks.</h3>";	
     
   }
   // If user has Admin status
   // then display Admin Home Page   
   else if ($admin==1)
   {
//echo "Hi admin";
       echo "<meta http-equiv=\"Refresh\" content=\"2; url=$siteaddress/admin/index.php\">\n\n<br><br><h3>You will now be transported to the Administrator Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/admin/index.php\">here</a> to continue. Thanks.</h3>";	
     
   }
   // If user has no admin privileges
   // then display regular user Home Page 
   else
   {
       echo "<meta http-equiv=\"Refresh\" content=\"2; url=$siteaddress/accountmanager.php\">\n\n<br><br><h3>You will now be transported to your Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/accountmanager.php\">here</a> to continue. Thanks.</h3>";		 
   }




                 

              } // end of else if ($formpassword==$passwordch)
              
 
       } // else if number > 0 


}//end if session[auth]!=1
// User is already logged on
// So no need for further authentification
// Just transport to user home page
else
{
 
    // User is already logged in
    // Just Transport them to their home page
      // If user has superadmin status
   // then display super admin Home Page   
   if ($_SESSION['superadmin']==1)
   {
   	
       echo "<meta http-equiv=\"Refresh\" content=\"1; url=$siteaddress/admin/index1.php\">\n\n<br><br><h2>You are already logged in</h2><h3>You will now be transported to your Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/admin/index.php\">here</a> to continue. Thanks.</h3>";	
     
   }
   // If user has Admin status
   // then display Admin Home Page   
   else if ($_SESSION['admin']==1)
   {

       echo "<meta http-equiv=\"Refresh\" content=\"1; url=$siteaddress/admin/index1.php\">\n\n<br><br><h2>You are already logged in</h2><h3>You will now be transported to your Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/admin/index.php\">here</a> to continue. Thanks.</h3>";	
     
   }
   // If user has no admin privileges
   // then display regular user Home Page 
   else
   {
       echo "<meta http-equiv=\"Refresh\" content=\"1; url=$siteaddress/index1.php\">\n\n<br><br><h2>You are already logged in</h2><h3>You will now be transported to your Account Management Page.If nothing happens or your browser does not support Refresh Meta Tags, please click <a href=\"$siteaddress/index1.php\">here</a> to continue. Thanks.</h3>";		   
   }                                  
 
} // end of else

?>


<? include("footer.php"); ?>