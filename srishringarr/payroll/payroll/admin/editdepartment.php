<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : editdepartment.php
    // Description : This file allows user to edit department info
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : updatedepartment.php
    
?>


<?


       // Query to get department info 
       $query = "select * from department where deptid='$deptid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
            
          echo "<h3>No Such Department </h3>"; 
       }
       else if ($number>0)
       {
           
       
           $deptid=mysql_result($result,0,"deptid");
           $managerid=mysql_result($result,0,"managerid");
           $deptparentid=mysql_result($result,0,"deptparentid");
           $deptname=mysql_result($result,0,"deptname");
           $location=mysql_result($result,0,"location");
           $deptdesc=mysql_result($result,0,"deptdesc");
           $mandaworkdesc=mysql_result($result,0,"mandaworkdesc");
           $messaging=mysql_result($result,0,"messaging");

           
?>



     <p><b><font color="#000066"><h3>Edit <? echo $deptname; ?> Department</h3></font></b></p>
      <blockquote>
        <p>Please enter the details for a new department that you want to create.</p>
      </blockquote>
      <form method="post" action="updatedept.php">
        <table width="600" border=0>
          <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Department Name :</b></div>
            </td>
            <td height="40" width="691"> 
              <input type="text" name="deptname" size="45" value="<? echo $deptname; ?>"> <? echo $star; ?>
            </td>
          </tr>
          <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Location :</b></div>
            </td>
            <td width="691" height="50"> 
              <p> 
                <input type="text" name="location" size="30" value="<? echo $location; ?>">
              <br><i><font color="#660033">Location is the Physical location of 
                the department (e.g Building Name, Room No etc..)</font></i><br><br></p>
            </td>
          </tr>
 
          <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Deparment Parent :</b></div>
            </td>
            <td height="50" width="691"> 
              <p> 
              

                  <select name=parentdeptid>
                  
                  
                  <?
                  
                     if ($deptparentid>0)
                     { 
                  
                         $deptparentname=genericget($deptparentid,'deptid','deptname','department');
                         echo "<option value=\"$deptparentid\" selected>$deptparentname</option>";
                  
                     }
 
                     makedropdown('deptid','deptname','department'); 
                     
                   ?>
  
                   </select> 
              
             
              
              <br><br></p>
            </td>
          </tr>
          <tr valign="top"> 
            <td width=209 height="134"> 
              <div align="right"><b>Description :</b></div>
            </td>
            <td width="691" height="134"> 
              <p>
                <textarea name="deptdesc" wrap="VIRTUAL" rows="4" cols="40"><? echo $deptdesc; ?></textarea>
              
              <br><i><font color="#660033">Brief description of what this department 
                does and main tasks</font></i><br><br></p>
            </td>
          </tr>


          <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Clock Out Option :</b></div>
            </td>
            <td width="691"> 
              <p> 
                <b><font color="blue">Do you to make it mandatory for employees of this department to put a text description of what they have worked when they clock out?</font></b><br><br>
              
              <?
              
                if ($mandaworkdesc=="y")
                {
                
                     $mandaworky="checked";
                     	
                }
                else
                {
                	
                    $mandaworkn="checked"; 	
                	
                }
             
              ?>
               
              
              
                <input type="radio" name="mandawork" <? echo $mandaworky; ?> value="y">
                <b>Yes</b> 
                <input type="radio" name="mandawork" <? echo $mandaworkn; ?> value="n">
                <b> No</b>
              <br><br></p>
            </td>
          </tr>

           <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Messaging :</b></div>
            </td>
            <td width="691"> 
              <p> 
                <b><font color="blue">Do you to want to allow employees of this department to be able to message each other?</font></b><br><br>
              
             <?
              
                if ($messaging=="y")
                {
                
                     $mesgy="checked";
                     	
                }
                else
                {
                	
                    $mesgn="checked"; 	
                	
                }
             
              ?>                
              
              
              
              
                <input type="radio" name="messaging" <? echo $mesgy; ?> value="y">
                <b>Yes</b> 
                <input type="radio" name="messaging" <? echo $mesgn; ?> value="n"> <b>No</b>
                
                <br><i><font color="#660033">Employees would be able to post messages for other employees and they would get their messages when they clock in for work.</font></i><br><br></p>
            </td>
          </tr>
        </table>
        <p> 
          <input type="hidden" name="deptid" value="<? echo $deptid; ?>">
          <input type="submit" name="Submit" value="Update Department Info">
        </p>
      </form>
<?

} // end of else number>0


?>


<? include("footer.php"); ?>