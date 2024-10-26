
<?

   echo "<h2>Welcome ADMIN User</h2>";

   $query = "select * from employee where empid='$session[empid]'";
   $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);
 
   $number = MYSQL_NUMROWS($result);

   if ($number == 0) 
   {
         echo "<h2>Error ! Member not found with login $session[login]</h2>";
   }
   elseif ($number > 0)
   {
   
          $empid=mysql_result($result,0,"empid");
          $deptid=mysql_result($result,0,"deptid");
          $jobid=mysql_result($result,0,"jobid");
          $parentid=mysql_result($result,0,"parentid");
          $lastname=mysql_result($result,0,"lastname");
          $firstname=mysql_result($result,0,"firstname");
          $minit=mysql_result($result,0,"minit");
          $ssn=mysql_result($result,0,"ssn");
          $dob=mysql_result($result,0,"dob");
          $gender=mysql_result($result,0,"gender");
          $race=mysql_result($result,0,"race");
          $marital=mysql_result($result,0,"marital");
          $address1=mysql_result($result,0,"address1");
          $address2=mysql_result($result,0,"address2");
          $city=mysql_result($result,0,"city");
          $state=mysql_result($result,0,"state");
          $zipcode=mysql_result($result,0,"zipcode");
          $country=mysql_result($result,0,"country");
          $email=mysql_result($result,0,"email");
          $webpage=mysql_result($result,0,"webpage");
          $homephone=mysql_result($result,0,"homephone");
          $officephone=mysql_result($result,0,"officephone");
          $cellphone=mysql_result($result,0,"cellphone");
          $regularhours=mysql_result($result,0,"regularhours");
          $login=mysql_result($result,0,"login");
          $password=mysql_result($result,0,"password");
          $admin=mysql_result($result,0,"admin");
          $superadmin=mysql_result($result,0,"superadmin");
          $numlogins=mysql_result($result,0,"numlogins");
          $loginip=mysql_result($result,0,"loginip");
          $lastlogindate=mysql_result($result,0,"lastlogindate");
          $datesignup=mysql_result($result,0,"datesignup");
          $ipsignup=mysql_result($result,0,"ipsignup");
          $dateupdated=mysql_result($result,0,"dateupdated");
          $ipupdated=mysql_result($result,0,"ipupdated");
          $active=mysql_result($result,0,"active");
          
      }




$pagedate=date("l dS F Y");

echo "Date : $pagedate<br>";

echo "Welcome back <h1>$firstname $lastname</h1><br>";


?>
