<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : emaildept.php
    // Description : This file sends email to all employees from the dept
    //               where Employee Employee ID works
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : resultssearch.php
    
?>
<?

       $query="select firstname,lastname,email from employee where deptid='$session[deptid]'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 


       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
        
          echo "<h2>Error - There are no employees in your department </h2>";
          
       }
       else if ($number>0)
       {
         
          echo "<br><br><h2>Sendings Email now</h2>"; 
          $emailfrom="From: $session[lastname] $session[firstname]<$session[email]>";
          $subject="Mail from EPayroll : ".$subject;
          $emailbody=$emailbody."\n\nThis email was sent from IP Address $ipaddress\n\n";

         $i=0;
         while ($i<$number)
         {
 
              $firstname=ucwords(mysql_result($result,$i,"firstname")); 
              $lastname=ucwords(mysql_result($result,$i,"lastname")); 
              $email=mysql_result($result,$i,"email"); 
              
              
              $mailto="$email";

              echo "<i>Mailing to <b><font color=red>$firstname $lastname</b></font></i><br>";
    
              mail($mailto,$subject,$emailbody,"$emailfrom");
          
          
            $i++;
              
         }


           
       }

echo "<p>Your email has been sent to all employees of your department. Please do not reload this page or email will be sent again.</p><br>";

echo "Click <a href=\"accountmanager.php\">here</a> to go back to your account Manager.";

?>


<? include("footer.php"); ?>