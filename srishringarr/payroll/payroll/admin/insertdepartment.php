<?


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

 
   $error=0;

   if ($deptname=="") 
   {
       echo "Department Name Field is Mandatory. You have to put something in that field<br><br>";
       $error=1;
   }
  


   if ($parent=="y")
   {

      if ($deptid=="")
      {  
            echo "You have chosen for this department to have a parent department, but you have not chosen which department it is.<br><br>";
            $error=1;
      }
      
      
   }
   else if ($parent=="n")
   {
       $deptid="-1";
   }


   if ($error==0)
   {
   	
       $querydept = "INSERT INTO department (deptid, managerid, deptparentid, deptname, location, deptdesc, mandaworkdesc, messaging) VALUES (null, '', '$deptid', '$deptname', '$location', '$deptdesc', '$mandawork', '$messaging')";
     
       $resultdept = MYSQL_QUERY($querydept) or die("SQL Error Occured : ".mysql_error().':'.$querydept);
       
       $deptid=mysql_insert_id();
              
?>



<h3>Select a Manager for the department of <? echo $deptname; ?></b></h3>

<form name="form1" method="post" action="searchdeptmanager.php">

  <p>Please put the name of the manager in the textbox below and the program will 
    search the database for names matching ur entry. The program will locate employees whose name match your query.</p>
  <p>Manager Name (Keyword) : 
    <input type="text" name="keyword">
  </p>
  <p>
  
    <input type="hidden" name=deptname value="<? echo $deptname; ?>">
    <input type="hidden" name=deptid value="<? echo $deptid; ?>">
    <input type="submit" name="Submit" value="Search Database for Manager">
  </p>
</form>

  <p>You can add a manager at a later time for this department if you wish to. 
    Just press the Search Button without anything if you dont wish to select a 
    manager now.</p>


<?


}
else if ($error==0)
{
	

echo "ERROR , $back";	
	
}

?>





<? include("footer.php"); ?>