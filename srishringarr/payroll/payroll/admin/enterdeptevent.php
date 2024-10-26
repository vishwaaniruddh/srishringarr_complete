<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : enterdeptevent.php
    // Description : This file allows user to enter a dept event
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
  
  
          $deptname=genericget($deptid,'deptid','deptname','department');
    
?>
<SCRIPT LANGUAGE="JavaScript" SRC="<? echo $siteaddress; ?>/calendar/calendar.js"></SCRIPT>
 
<h3>Enter Message for <? echo $deptname; ?> Department</h3>
<form name="enterdates" method="post" action="insertdeptmessage.php">
  <p>Please put the message you want to be displayed on employee login screens 
    for the department of <? echo $deptname; ?></p>
  <table width="640" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td height="30">Message :</td>
      <td height="30">
        <textarea name="deptmessage" cols="40" rows="6" wrap="VIRTUAL"></textarea>
      </td>
    </tr>
    <tr> 
      <td height="30">Message Expirty Date :</td>
      <td height="30">
        <input type="text" name="expdate">
        <A HREF="javascript:doNothing()" onClick="setDateField(document.enterdates.expdate);top.newWin = window.open('<? echo $siteaddress; ?>/calendar/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')">
<IMG SRC="<? echo $siteaddress; ?>/calendar/calendar.gif" BORDER=0></A>
        
        (YYYY-MM-DD) </td>
    </tr>
  </table>
  <p>
    <input type=hidden name=deptid value=<? echo $deptid; ?>>
    <input type="submit" name="Submit" value="Submit Departmental Message">
  </p>
</form>
                
                                                      
                                
<? include("footer.php"); ?>