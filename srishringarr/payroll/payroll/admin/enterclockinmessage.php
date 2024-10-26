<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : enterclockinmessage.php
    // Description : This file allows user to enter a clock in message for an employee
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
  
  
          $empname=getempname($empid);
          
    
?>
<SCRIPT LANGUAGE="JavaScript" SRC="<? echo $siteaddress; ?>/calendar/calendar.js"></SCRIPT>

 <h3>Enter Clock In Message for Employee<? echo $empname; ?></h3>
 
<form name="enterdates" method="post" action="insertclockinmessage.php">
  <p>Please put the message you want <b><? echo $empname; ?></b> to see at Clockin</p>
  <table width="640" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="30"> 
        <div align="right">Message :</div>
      </td>
      <td height="30"> 
        <textarea name="cmessage" cols="40" rows="6" wrap="VIRTUAL"></textarea>
      </td>
    </tr>
    <tr> 
      <td height="30"> 
        <div align="right">No of Views :</div>
      </td>
      <td height="30"> 
        <select name="noviews">
          <option value="1" selected>1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
      </td>
    </tr>
  </table>
  <p>
    <input type=hidden name=empid value=<? echo $empid; ?>>
    <input type="submit" name="Submit" value="SubmitClock In  Message">
  </p>
</form> 
 
 
               
                                                      
                                
<? include("footer.php"); ?>