<?

   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : insertpayrollbonus.php
    // Description : This file insert payroll bonus into database
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files :
    
?>
<?
  
     // Get Employee Name and Department
     $empname=getempname($empid);
     $deptid=genericget($empid,'empid','deptid','employee');
     $deptname=genericget($deptid,'deptid','deptname','department');
     
?>
<?
    // Insert Query to put data in tables
    $queryinsert="INSERT INTO bonus (bonusid, empid, datebonus, bonuspayment, note) VALUES (null, '$empid', '$datebon', '$bonpayment', '$bondesc')";
 
    
    // Esecute Query 
    $result = MYSQL_QUERY($queryinsert) or die("SQL Error Occured : ".mysql_error().':'.$queryinsert); 

    echo "<h3>BONUS Information Successfully Recorded</h3>";   
    
?>

<table width="640" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="30" width="137"> 
        <div align="right">Employee Name :</div>
      </td>
      <td height="30" width="503"><font color="#000099"><b><? echo $empname; ?></b></font></td>
    </tr>
    <tr> 
      <td height="30" width="137"> 
        <div align="right">Bonus Date :</div>
      </td>
      <td height="30" width="503"><font color="#000099"><b><? echo $datebon; ?></b></font></td>
    </tr>
    <tr> 
      <td height="30" width="137"> 
        <div align="right">Bonus Amount :</div>
      </td>
      <td height="30" width="503"><font color="#000099"><b>$<? echo $bonpayment; ?></b></font></td>
    </tr>
    <tr> 
      <td height="30" width="137"> 
        <div align="right">Description :</div>
      </td>
      <td height="30" width="503"><font color="#000099"><b><? echo $bondesc; ?></b></font></td>
    </tr>
  </table>
  




<? include("footer.php"); ?>