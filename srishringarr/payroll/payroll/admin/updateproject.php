<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : updateproject.php
    // Description : This file updates project information
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : editproject.php
    
?>


<?

$deptname=genericget($deptid,'deptid','deptname','department');

$queryupdept="update project set projecttitle='$ptitle',projectdesc='$pdesc' where projectid='$projectid';";

$result = MYSQL_QUERY($queryupdept) or die("SQL Error Occured : ".mysql_error().':'.$queryupdept);

echo "<br><h2>Project information has been successfully updated :- </h2>";

?>

<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Project Title :</b></div>
    </td>
    <td height="30" width="467"><font color="#990033"><? echo $ptitle; ?></font></td>
  </tr>
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Department :</b></div>
    </td>
    <td height="30" width="467"><font color="#990033"><? echo $deptname; ?></font></td>
  </tr>
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Description :</b></div>
    </td>
    <td height="30" width="467"><font color="#990033"><? echo $pdesc; ?></font></td>
  </tr>
</table>

<?

echo "<h3>Click <a href=\"index.php\">here</a> to go back to admin main page.</h3>";



?>



<? include("footer.php"); ?>