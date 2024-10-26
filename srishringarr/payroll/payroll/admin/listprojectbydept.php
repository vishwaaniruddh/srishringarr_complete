<?


   include("header.php"); 
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : listprojectbydept.php
    // Description : This file list all projects from one dept
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?

   // if department if is not set, do not proceed
   if (!isset($deptid))
   {
   	
   
         echo "<h3>Error - Department ID Not set</h3>";
         echo $back;
   	
   	
   }
   else
   {
   	
        // If $act==a then activate project with $projid	
       // Activate a Project	
       if ($act=="a")
       {	
       	
       	    // Calling function genericactivate with $act==a
       	    // to activate this project
       	    genericactivate($act,$projid,'projectid','project');	
       }
       elseif ($act=="i")
       {
       	    // Calling function genericactivate with $act==i
       	    // to Inactivate this project
       	    genericactivate($act,$projid,'projectid','project');
       }
   	
   
   
       // If $active variable is set
       // then add the active fieldname to the query also	
       if ($active=='y')
       {
       	
       	  $activesql=" and active='y'";
       	
       }	
       elseif ($active=='n')
       {
       	
       	  $activesql=" and active='n'";
       	
       }
       else
       {
       	
       	   $activesql="";
       	
       }

       // getting department name 
       $deptname=genericget($deptid,'deptid','deptname','department');

       echo "<h3>List All Project from $deptname</h3>";
       
       echo "<center>[<a href=\"listprojectbydept.php?deptid=$deptid&active=y\">View Only ACTIVE Projects</a>] [<a href=\"listprojectbydept.php?deptid=$deptid&active=n\">View Only INACTIVE Projects</a>] [<a href=\"listprojectbydept.php?deptid=$deptid\">View ALL Projects</a>]</center>";        
           
       // Query to get list of departments
       $query="select * from project where deptid='$deptid' $activesql order by active desc,projecttitle";

       $result = MYSQL_QUERY($query);
       $number = MYSQL_NUMROWS($result);

       $i = 0;
                
       // if query is empty                        
       if ($number == 0)
       {  
       	
       	      echo "<ul>";
       	     
              echo "<h3>Sorry, Query Returned No Results. Try Again</h3>";
             
              
              echo $back;
              
              echo "</ul>";
              
       }
       elseif ($number > 0) 
       {
            
            echo "<table width=\"100%\" border=0 cellspacing=0 cellpadding=0>";
            echo "<tr height=30 bgcolor=#EBEBEB><td>Project Name</td><td>Active</td><td>Project Hours</td><td>View</td><td>Edit</td><td>Activation</td></tr>";

              // For each result row, get data values 
              WHILE ($i < $number)
              {
              
                  $j=$i+1;

                  // Retreiving data from each row of the sql query result 
                  // and putting them in local variables                   
                  
                  $projectid=mysql_result($result,$i,"projectid");
                  $projecttitle=mysql_result($result,$i,"projecttitle");
                  $hoursworked=mysql_result($result,$i,"hoursworked");
                  $activepro=mysql_result($result,$i,"active");

                  

                  // making every other alternate row
                  // of a different color
                  $k=$i/2;
                  $k=substr($k,-1,1);
                  
                  // if row is odd, then make row background grey
                  if ($k=="5")
                  {
                  
                      echo "<tr bgcolor=\"#EBEBEB\">"; 	
                  	
                  }
                  else
                  {
                       echo "<tr>";
                  }
                  
                  echo "<td height=\"30\"><b>$projecttitle</b></td>";
                  echo "<td height=\"30\"><b>$activepro</b></td>";
                  echo "<td height=\"30\"><b>$hoursworked</b></td>";
                  echo "<td><a href=\"viewprojectinfo.php?projectid=$projectid\">View</a></td>";
                  echo "<td><a href=\"editproject.php?prid=$projectid\">Edit</a></td>";
                  echo "<td>";
       
                  // If project is active then display Inactivate           
                  if ($activepro=="y")
                  {                  
                          echo "<a href=\"listprojectbydept.php?deptid=$deptid&active=$active&act=i&projid=$projectid\">Inactivate</a>";
                  }
                  // Otherwise display Activate
                  elseif ($activepro=="n") 
                  {                  
                          echo "<a href=\"listprojectbydept.php?deptid=$deptid&active=$active&act=a&projid=$projectid\">Activate</a>";
                  }                          
                  
                  
                  echo "</td>";
                  echo "</tr>";
          

                 $i++; 
                                    
              } // end while
            
            
           echo "</table>";   
           echo "<center>[<a href=\"listprojectbydept.php?deptid=$deptid&active=y\">View Only ACTIVE Projects</a>] [<a href=\"listprojectbydept.php?deptid=$deptid&active=n\">View Only INACTIVE Projects</a>] [<a href=\"listprojectbydept.php?deptid=$deptid\">View ALL Projects</a>]</center>";

         
  
      } // end else if number>0

  } // end else if !isset deptid


?>

<? include("footer.php"); ?>