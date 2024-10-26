<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : checkin.php
    // Description : This file accepts the arguments formlogin and formpassword
    //               from the script startwork.php and then processes it. It checks
    //               for validity of the data and then if everything is ok, it checks
    //               in employee in the payroll system
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : startwork.php
    
?>




<?

// Using Function Checklogin to get properties of the login and password entered
// The function checklogin takes $formlogin and $formpassword as variables
// and return a string of integers separated by the character '>'
//
// e.g of the string would be  'exists>lock>firstname>lastname>empid>passwordok>active'
//
// Exists : if the formlogin exists {0|1}
// Lock : checks whether user has any lock {0|1} (0 = no lock , 1 = lock)
// Firstname, Lastname : Self Explanatory 
// Empid : Employee ID
// Passwordok : If password matches  {0|1} (0 = no match , 1 = match)
// Active : If user account is active {0|1} (0 = not active , 1 = active)

$loginproperties=checklogin($formlogin,$formpassword);



// Breaking the string into its respective items
list($exists,$lock,$firstname,$lastname,$empid,$passwordok,$active)=explode('>',$loginproperties);


// If login does not exists in the database
// Print Error Message
if ($exists==0)
{
	
	echo "This login does not exist in our database. Please go $back and try again<br>";

}
// If Login Exists in databsae, proceed
else if ($exists==1)
{
	


      // If password entered does not match database password
      // associated with the login, print error message	
      if ($passwordok==0)
      {
      	
      	
      	  echo "Wrong Password ! Please try again. $back<br>";
      	
      }
      // Password match
      else if ($passwordok==1)
      {
 
 
         // Checking if User is allowed to check in from this IP ADDRESS
         // Function checkipaddress returns 1 if address is valid
         // else it returns 0
         $goodip=checkipaddress($ipaddress,$empid); 
 
       // If IP Addres is not good, print error message
       if ($goodip==0)
       {
            echo "You cannot checkin from this location ($ipaddress). You can only checkin from valid locations. Ask your Manager which locations are valid.";	
       }  
       // If ip address is good, proceed
       else if ($goodip==1)
       {
        
 
 
    	  // if account status is not active
      	  // print error message
      	  if ($active==0)
      	  {
      	  	
      	  
      	      echo "Your account is not active. Please contact your manager about it. $back<br>";
      	  	
      	  	
      	  }  // end if active==0
      	  
      	  // Account is active
      	  else if ($active==1)
      	  {

             // Check whether user has got any lock
             // If user has got any locks, retreive lock message from locks table
             // and display and do not proceed forward
             if ($lock==1)  
             {
          	
                // Query to check if this person has got any lock on his/her record
     	       $querylock = "select * from locks where empid='$empid'";
               $resultlock = MYSQL_QUERY($querylock) or die("SQL Error Occured : ".mysql_error().':'.$querylock);
       
               // Getting number of rows from Querylock
               $numberlock = MYSQL_NUMROWS($resultlock);  
               
               $lockno=0;
               
               echo "Sorry, you cannot login<br><br>";
               
               echo "There is $numberlock lock on your account :-<br><br>";
               
               // Printing Employee Lock Alert
               printlocks($empid);
                            
               echo "You have to clear these locks with the person who placed them before you can login.";
               echo "<br><br>";
               echo "Thanks";
          	
             }  // end of if ($lock==1)  
          
          
             // If there is no lock on the account
             else if ($lock==0)
             {

      	  	// Checking if user is already logged in
      	  	// Function checkifloggedin takes argument employee id
      	  	// and returns a string of properties separated by the '>' Character
      	  	// string e.g    loggedin>loggedindate>loggedintime
      	  	//
      	  	// loggedin : Whether user is already logged in or not {0|1} (0=not logged in, 1=logged in)
      	  	// loggeddate : date that user had last checked in
      	  	// loggedtime : time that user had last checked in
      	  	
      	  	$isloggedin=checkifloggedin($empid);
      	  	
      	  	list($loggedin,$loggedindate,$loggedintime)=explode('>',$isloggedin);
      	  	
      	  	if ($loggedin==1)
      	  	{
      	  	 
      	  	 
      	  	        echo "You are already logged in to the system. You cannot log in again. Please log off before you can log in again.<br>";
      	  	        
      	  	        echo "Login Date : ".$loggedindate."<br><br>";
      	  	        echo "Login Time : ".$loggedintime."<br><br>";
      	  	 
      	  	        echo $back; 
      	  	 
      	  	 
      	  	}
      	  	// User is not already checked in and not checked out
      	  	// So can proceed
      	  	else if ($loggedin==0)
      	  	{
      	  		
      	  		
     	  	        $querystart = "INSERT INTO timesheet (timeid, empid, projectid, checkin, checkout, rawtime, roundedtime, workdesc, ipcheckin, ipcheckout, checked) VALUES (null,'$empid', '', '$dt', '', '0', '0', '', '$ipaddress', '', 'n')";
                        $resultstart = MYSQL_QUERY($querystart) or die("SQL Error Occured : ".mysql_error().':'.$querystart);
                                                   	 
                        echo "<br>Thanks $firstname $lastname<br><br>";
                        echo "You have successfully checked in.<br><br>";
                        echo "<b>Checkin Information</b><br>";
                        echo "<ul><table><tr><td>Date :</td><td><b>$today</b></td></tr><tr><td>Time :  </td><td><b>$timenow</b></td></tr></table></ul>";
                        echo "Work Hard and do not forget to check out when u finish working.<br><br>";
                        echo "<a href=\"javascript:window.close();\">Close this Window</a><br>";
                        echo "<a href=\"login.php\">Log in to my Account Manager</a><br>";
                        echo "<hr>";
                               	  	
      	  	         // Checking if user has any departmental events
      	  	         $deptid=genericget($empid,'empid','deptid','employee');
      	  	         checkdeptmessages($deptid); 
      	  	
      	  	 
      	  	         // Checking if user has personal messages
      	  	         checkmessages($empid);
      	  	         
      	  	             	  	 

      	  	
 
                  
                  

                  
                } // end of else if loggedin==0  
      
              } // end of else if lock==0
        
          } // end else if active==1

        } // end else if goodip==1

      } // end of if password==1

} // end if exists==1




?>


<?

include("footer.php");
?>
