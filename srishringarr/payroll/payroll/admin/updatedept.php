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

$deptparentname=genericget($parentdeptid,'deptid','deptname','department');

$queryupdept="update department set deptparentid='$parentdeptid',deptname='$deptname',location='$location',deptdesc='$deptdesc',messaging='$messaging',mandaworkdesc='$mandawork' where deptid='$deptid';";

$result = MYSQL_QUERY($queryupdept) or die("SQL Error Occured : ".mysql_error().':'.$queryupdept);

echo "<br><h2>Department information has been successfully updated :- </h2>";

?>

<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Department Name :</b></div>
    </td>
    <td height="30" width="467"><? echo $deptname; ?></td>
  </tr>
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Parent Dept :</b></div>
    </td>
    <td height="30" width="467"><? echo $deptparentname; ?></td>
  </tr>
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Location :</b></div>
    </td>
    <td height="30" width="467"><? echo $location; ?></td>
  </tr>
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Descriptions :</b></div>
    </td>
    <td height="30" width="467"><? echo $deptdesc; ?></td>
  </tr>
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Mandatory Desc :</b></div>
    </td>
    <td height="30" width="467"><? echo $mandawork; ?></td>
  </tr>
  <tr> 
    <td height="30" width="173"> 
      <div align="right"><b>Allow Messaging :</b></div>
    </td>
    <td height="30" width="467"><? echo $messaging; ?></td>
  </tr>
</table>

<?

echo "<h3>Click <a href=\"index.php\">here</a> to go back to admin main page.</h3>";



?>



<? include("footer.php"); ?>