<?

   // Dont start session on this page
   $se="n";
   include("header.php"); 
   include("functions.php");

?>


<?
    // FILE DOCUMENTATION
    // Filename    : precheckout.php
    // Description : After user put login and password, this script retreives dept
    //               which employee is from and displays all the projects for this 
    //               particular dept and allow user to put free word desc of work done
    //   
    // License : GPL
    // Date    : 11/09/2001
    // Related Files : checkout.php,stopwork.php
    
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
	
	echo "$precheckout1 $back";

}
// If Login Exists in databsae, proceed
else if ($exists==1)
{
	
      // If password entered does not match database password
      // associated with the login, print error message	
      if ($passwordok==0)
      {
      	
      	
      	  echo "$precheckout2 $back<br>";
      	
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
      	
      	      
      	      if ($loggedin==0)
      	      {
      	      	
      	      	
      	      	   echo "$precheckout3";
      	      	
      	      	
      	      }
      	      else if ($loggedin==1)
      	      {     
      	             
      	 

                      $deptid=genericget($empid,'empid','deptid','employee');
                      $deptname=genericget($deptid,'deptid','deptname','department');
                      $empname=getempname($empid);
                      $eid=genericget($formlogin,'login','empid','employee');
                                           
              
                      echo "<form method=\"POST\" action=\"checkout.php\">";
              
                      echo "<b>$empname</b>, $precheckout4<br><br>";
              
                      echo "<table>";
                      echo "<tr>";
              
                      echo "<td>$precheckout5<b>$deptname</b> : </td>";
                      echo "<td><select name=\"projectid\">\n";
                      
                                 getlastproject($empid);   
                                 projectdropdown($deptid);
              
                      echo "</select></td>\n";
              
                      echo "</tr><tr>";

                      echo "<td>$precheckout6 </td>";
                      echo "<td><textarea rows=4 name=workdone cols=30></textarea></td>";
                      echo "</tr>";
              
                      echo "</table>";
              
              
                      echo "<input type=hidden name=formlogin value=\"$formlogin\">";
                      echo "<input type=hidden name=employeeid value=\"$eid\">";
                      echo "<p><input type=submit value=\"$precheckout7\" name=B1><input type=reset value=\"$precheckout8\" name=B2></p>";
              
                      echo "</form>";
                      
              }


          } // end of else if goodip==1
         

      } // end of else if passwordok==1



}   // end of else if exists==1

?>

<?

include("footer.php");

?>
