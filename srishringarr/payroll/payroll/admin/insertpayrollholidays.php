<?

   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : insertpayrollholidays.php
    // Description : This file insert payroll holidays into database
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
    $queryinsert="INSERT INTO holidays (holid, empid, datehols, payment, note) VALUES (null, '$empid', '$datehol', '$holpayment', '$holdesc')";
    
    
    // Esecute Query 
    $result = MYSQL_QUERY($queryinsert) or die("SQL Error Occured : ".mysql_error().':'.$queryinsert); 

    echo "<h3>Holiday Information Successfully Recorded</h3>";   
    
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
        <div align="right">Holiday Date :</div>
      </td>
      <td height="30" width="503"><font color="#000099"><b><? echo $datehol; ?></b></font></td>
    </tr>
    <tr> 
      <td height="30" width="137"> 
        <div align="right">Payment for Holiday :</div>
      </td>
      <td height="30" width="503"><font color="#000099"><b>$<? echo $holpayment; ?></b></font></td>
    </tr>
    <tr> 
      <td height="30" width="137"> 
        <div align="right">Description :</div>
      </td>
      <td height="30" width="503"><font color="#000099"><b><? echo $holdesc; ?></b></font></td>
    </tr>
  </table>
  




<? include("footer.php"); ?>