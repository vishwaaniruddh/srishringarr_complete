<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : enternewdepartment.php
    // Description : This file allows user to add a new department to the database
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : insertdepartment.php
    
?>



     <p><b><font color="#000066"><h3>Enter a Department</h3></font></b></p>
      <blockquote>
        <p>Please enter the details for a new department that you want to create.</p>
      </blockquote>
      <form method="post" action="insertdepartment.php">
        <table width="600" border=0>
          <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Department Name :</b></div>
            </td>
            <td height="40" width="691"> 
              <input type="text" name="deptname" size="45"> <? echo $star; ?>
            </td>
          </tr>
          <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Location :</b></div>
            </td>
            <td width="691" height="50"> 
              <p> 
                <input type="text" name="location" size="30">
              <br><i><font color="#660033">Location is the Physical location of 
                the department (e.g Building Name, Room No etc..)</font></i><br><br></p>
            </td>
          </tr>
          <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Has Parent ? :</b></div>
            </td>
            <td width="691"> 
              <p> 
                <input type="radio" name="parent" value="y">
                <b>Yes</b> 
                <input type="radio" name="parent" checked  value="n">
                <b> No</b>
              <br><i><font color="#660033">Is this department the sub-department 
                of another department?</font></i><br><br></p>
            </td>
          </tr>
          <tr valign="top"> 
            <td width=209> 
              <div align="right"><b>Deparment Parent :</b></div>
            </td>
            <td height="50" width="691"> 
              <p> 
                  <select name=deptid>

                         <? makedropdown('deptid','deptname','department') ?>
  
                   </select> 
              
             
              
              <br><i><font color="#660033">If you have chosen <b>yes</b> in the 
                previous field, please choose another department to be the parent 
                for this department. If you chose <b>no</b> in the previous field, 
                you dont need to choose anything.</font></i><br><br></p>
            </td>
          </tr>
          <tr valign="top"> 
            <td width=209 height="134"> 
              <div align="right"><b>Description :</b></div>
            </td>
            <td width="691" height="134"> 
              <p>
                <textarea name="deptdesc" wrap="VIRTUAL" rows="4" cols="40"></textarea>
              
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
              
                <input type="radio" name="mandawork" checked value="y">
                <b>Yes</b> 
                <input type="radio" name="mandawork" value="n">
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
              
                <input type="radio" name="messaging" checked value="y">
                <b>Yes</b> 
                <input type="radio" name="messaging" value="n">
                
                <br><i><font color="#660033">Employees would be able to post messages for other employees and they would get their messages when they clock in for work.</font></i><br><br></p>
            </td>
          </tr>
        </table>
        <p> 
          <input type="submit" name="Submit" value="Enter New Department">
          <input type="reset" name="Submit2" value="Reset Fields">
        </p>
      </form>



<? include("footer.php"); ?>