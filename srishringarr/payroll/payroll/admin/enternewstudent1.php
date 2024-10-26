<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : enternewemployee1.php
    // Description : This file asks user to choose a department in which to add
    //               a new employee
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewemployee2.php,enternewdepartment.php
    
?>

<Script Language="JavaScript">
<!-- Hide from old browsers
function openwindowlink() {
newwin = window.open("enternewdepartment.php","windowname","height=450,width=520,scrollbars,resizable")
}   
// end hiding --></Script> 


 <form method="post" action="enternewstudent2.php">
  <p><b>Add New Student</b></p>
  <blockquote>Please choose the department that you want to add an student for. 
    Every student need to be part of a department. If you do not have any department 
    yet, please<a href="enternewdepartment.php"> add a new department</a>, before 
    adding any new students. </blockquote>
  <p><b><font color="#000066">Choose Department</font></b></p>
  <p>Department : 
  <select name=deptid>

      <? makedropdown('deptid','deptname','department') ?>
  
  </select> [<b><a href="JavaScript: openwindowlink()">Add New Department</a></b>]
  </p>
  <p> 
    <input type="submit" name="Submit" value="Proceed">
    <input type="reset" name="Submit2" value="Reset">
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>

<? include("footer.php"); ?>
