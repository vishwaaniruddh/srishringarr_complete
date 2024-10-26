<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : enteremplock.ph
    // Description : This file allows user to enter an employee lock
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
  
  
          $empname=getempname($empid);
          
    
?>


 <h3>Enter a Clock Lock for Employee<? echo $empname; ?></h3>
 
<form name="enterdates" method="post" action="insertemplock.php">
  <p>Please put the lock message you want <b><? echo $empname; ?></b> when he/she tries to log in</p>
  <table width="640" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="30"> 
        <div align="right">Lock Message :</div>
      </td>
      <td height="30"> 
        <textarea name="lockmessage" cols="40" rows="6" wrap="VIRTUAL"></textarea>
      </td>
    </tr>
      </table>
  <p>
    <input type=hidden name=empid value=<? echo $empid; ?>>
    <input type="submit" name="Submit" value="Submit LOCK">
  </p>
</form> 
 
 
               
                                                      
                                
<? include("footer.php"); ?>