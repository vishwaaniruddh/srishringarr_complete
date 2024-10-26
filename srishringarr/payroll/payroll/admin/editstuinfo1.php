<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : updatedepartment.php
    // Description : This file updates department information
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : editdepartment.php
    
?>


<?

//$deptparentname=genericget($parentdeptid,'deptid','deptname','department');

$queryupemp="update student set stid='$eid',ssn='$ssn',salutation='$sal',lastname='$lname',firstname='$firname',minit='$miname' where stid='$eid'";

$result = MYSQL_QUERY($queryupemp) or die("SQL Error Occured : ".mysql_error().':'.$queryupemp);

echo "<br><h2>Student information has been successfully updated :- </h2>";

?>

<?

echo "<h3>Click <a href=\"index.php\">here</a> to go back to admin main page.</h3>";



?>



<? include("footer.php"); ?>