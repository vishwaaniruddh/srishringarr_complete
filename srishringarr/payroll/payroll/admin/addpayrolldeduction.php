<?

   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : addpayrolldeduction.php
    // Description : This file allows admin to add a new payroll deduction
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>
<?
  
     // Get Employee Name 
     $empname=getempname($empid);

     $deptid=genericget($empid,'empid','deptid','employee');
     $deptname=genericget($deptid,'deptid','deptname','department');
     
?>

   <h3>Add a Payroll Deduction for <? echo $empname; ?></h3>
  <h3>Department : <? echo $deptname; ?></h3>
  <font color="#990033"></font> 
  <form method="post" action="insertpayrolldeductions.php">
    <table width="640" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" width="149"> 
          <div align="right">Deduction Type :</div>
        </td>
        <td height="30" width="491"> 
          <input type="text" name="deductype">
          <i> (tax,loan,etc.) </i></td>
      </tr>
      <tr> 
        <td height="30" width="149"> 
          <div align="right">Deduction Amount :</div>
        </td>
        <td height="30" width="491"> <b> $</b> 
          <input type="text" name="deducamount">
        </td>
      </tr>
      <tr> 
        <td height="30" width="149"> 
          <div align="right">Description :</div>
        </td>
        <td height="30" width="491"> 
          <textarea name="deducnote" rows="3" cols="30" wrap="VIRTUAL"></textarea>
        </td>
      </tr>
    </table>
    <p>
      <input type=hidden name=empid value="<? echo $empid; ?>">
      <input type="submit" name="Submit" value="Add Deduction">
    </p>
    <p><font color="#990033"><b><font color="#CC0033">IMPORTANT NOTE : Deductions 
      are recurring. So when you add a deduction, it will repeat for all pay periods. 
      </font></b></font> </p>
  </form>






<? include("footer.php"); ?>