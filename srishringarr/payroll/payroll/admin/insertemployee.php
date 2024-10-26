<?

   $se=n;
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : insertdepartment.php
    // Description : This file inserts data from enternewdepartment in the database
    //               and asks user to put a search keyword for a manager for that 
    //               department
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewdepartment.php, searchdeptmanager.php
    
?>


<?

       // NO ERRORS
       // $error=0
       // if $error, then error=1
       $error=0;
 
       // Checking if Employee Type is set
       if ($typeid=="")
       {
           echo "<ul><li>Employee Type Not Set.</li></ul>";
           $error=1;	
       }
 
        // Checking if Employee Category is set
       if ($catid=="")
       {
              echo "<ul><li>Employee Category Not Set.</li></ul>";
             $error=1;	
       }
       
        // Checking if Regular Hours field has been filled
       if (($regularhours<0) or ($regularhours>150))
       {
             echo "<ul><li>Your entry for Regular Hours is Wrong. Regular Hours has to be between 0 and 150</li></ul>";
             $error=1;	
       }
 
 
 
       // Checking if First name field has been filled
       if ($fname=="")
       {
             echo "<ul><li>First Name is a Mandatory Field.</li></ul>";
             $error=1;	
       }
 
       // Checking if Last name field has been filled
       if ($lname=="")
       {
             echo "<ul><li>Last Name is a Mandatory Field.</li></ul>";
             $error=1;	
       }
 
       // Checking if Month, Day and Year fields have been filled
       if (($month=="") or ($day=="") or ($year==""))
       {
             echo "<ul><li>Date of Birth is a Mandatory Field.</li></ul>";
             $error=1;	
       }
 
       // Checking if Email field has been filled
       if ($email=="")
       {
             echo "<ul><li>Email Address is a Mandatory Field.</li></ul>";
             $error=1;	
       }
 
 
       // Checking if Address1 field has been filled 
       if ($address1=="")
       {
             echo "<ul><li>Address1 is a Mandatory Field.</li></ul>";
             $error=1;	
       }
 
       // Checking if City field has been filled 
       if ($city=="")
       {
             echo "<ul><li>City is a Mandatory Field.</li></ul>";
             $error=1;	
       }
 
 
       // Checking if Country field has been filled
       if ($country=="")
       {
             echo "<ul><li>Country is a Mandatory Field.</li></ul>";
             $error=1;	
       }
 
 
       // If there was any error, display error
       // and dispaly a back button 
       if ($error==1)
       {
       	
       	    echo "<h3>ERROR</h3>";
       	    echo "You have missed some mandatory fields in the previous form.<br>";
       	    echo $back;
       	
       }
       // if there is no error
       // insert employee record in dvb
       else if ($error==0)
       {
       	
       	
       	    // Generating Temporary Login for user
       	    $login=makelogin($lname);
       	    
       	    // Generating Temporary Password for user
       	    $password=mknewpasswd();
       	
       	    // Concatenating Month, Day and Year
       	    // for MySQL type Date (YYYY/MM/DD)
       	    $dob=$year."/".$month."/".$day;
       	
       	
       	    // Query to insert employee details in Employee table 
       	    $queryemp="INSERT INTO employee (empid, deptid, jobid, parentid, typeid, catid, salutation, lastname, firstname, minit, ssn, dob, gender, race, marital, address1, address2, city, state, zipcode, country, email, webpage, homephone, officephone, cellphone, regularhours, login, password, admin, superadmin, numlogins, datesignup, ipsignup, lastlogindate, loginip, dateupdated, ipupdated, lastproject, active) VALUES (null, '$deptid', '$jobid', '', '$typeid', '$catid', '$salutation', '$lname', '$fname', '$minit', '$ssn', '$dob', '$gender', '$race', '$marital', '$address1', '$address2', '$city','$state', '$zip', '$country', '$email', '$webpage', '$hphone', '$ophone', '$cphone','$regularhours', '$login', '$password', '0', '0', '0', '$today', '$ipaddress', '', '', '$dt', '$ipaddress', '', 'y')";
       	            
       	    $resultemp = MYSQL_QUERY($queryemp) or die("SQL Error Occured : ".mysql_error().':'.$queryemp);
       
       
       
       
            // Getting the employee id of the record just inserted 
            $empid=mysql_insert_id();
            
            
            $queryhourly="INSERT INTO hourly (hourid, empid, hourlyrate, note) VALUES (null, '$empid', '$hourlypay', '')";
            $resulthourly = MYSQL_QUERY($queryhourly) or die("SQL Error Occured : ".mysql_error().':'.$queryhourly);
            
            // Generating Email Body to send to user
            $emailbody="Hi $fname $lname,\n\nAn Account has been created for you on $sitename\n\nLogin : $login\n\nPassword : $password\n\n This login and password have been automatically generated and are just temporary. Please log in your account manager and change it to your convenience.\n\n$emailend";
            
            // Email Subject            
            $emailsubject="New Account Created on $sitename";
            
            // Sending Email to inform user of their account creation
            mail($emailbody,$emailsubject,$email,$from);
            
           $deptname=genericget($deptid,'deptid','deptname','department');
           $jobtitle=genericget($jobid,'jobid','jobtitle','jobtitle');
           
            
?>

<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b>Employee Name :</b></div>
    </td>
    <td height="32" width="480"><? echo "$salutation $fname $minit $lname"; ?></td>
  </tr>
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b>ID :</b></div>
    </td>
    <td height="32" width="480"><? echo $ssn; ?></td>
  </tr>
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b>Email :</b></div>
    </td>
    <td height="32" width="480"><? echo $email; ?></td>
  </tr>
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b><b></b></b></div>
    </td>
    <td height="32" width="480">&nbsp;</td>
  </tr>
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b>Department :</b></div>
    </td>
    <td height="32" width="480"><? echo $deptname; ?></td>
  </tr>
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b>Job Title :</b></div>
    </td>
    <td height="32" width="480"><? echo $jobtitle; ?></td>
  </tr>
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b>Regular Hours :</b></div>
    </td>
    <td height="32" width="480">20</td>
  </tr>
  <tr> 
    <td height="32" width="160">&nbsp;</td>
    <td height="32" width="480">&nbsp;</td>
  </tr>
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b>Generated Login :</b></div>
    </td>
    <td height="32" width="480"><? echo $login; ?></td>
  </tr>
  <tr> 
    <td height="32" width="160"> 
      <div align="right"><b>Generated Password :</b></div>
    </td>
    <td height="32" width="480"><? echo $password; ?></td>
  </tr>
  
  
</table>




<?        
               
        
            // Checking if there was any input for the employee picture field
            // if input, then read the file and insert it as binary data in 
            // the emppicture table
            if ($photo1!="none")
            {
            	
        	 // Reading uploaded picture into variable $picdata1
                 $picdata1 = addslashes(fread(fopen($photo1, "r"), filesize($photo1)));

                 // Inserting binary data into picture
                 $querypic="INSERT INTO emppicture (picid, linkid, type, filename, filesize, filetype, picture) VALUES (null, '$empid', 'e', '$photo1_name', '$photo1_size', '$photo1_type', '$picdata1')";
  
                 $resultpic = MYSQL_QUERY($querypic) or die("SQL Error Occured : ".mysql_error().':'.$querypic);
                 
                 echo "<br><b>Uploaded Picture</b><br>";
                 echo "<img src=\"$siteaddress/viewemppic.php?empid=$empid\" height=200 width=200><br>";

            }
            else
            {
                 echo "<b>No Picture has been uploaded for employee</b><br>";

            } 
       
        
        
       	
       	
       }

              
?>


<? include("footer.php"); ?>