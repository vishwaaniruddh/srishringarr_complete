<?


   include("header.php"); 
   include("functions.php");

?>


<?
    // FILE DOCUMENTATION
    // Filename    : enterdates.php
    // Description : This file allows user to put a startdate and an enddate\
    //               and then submits to script $scriptname for processing
    //               variables passed are $startdate and $enddate
    //   
    // License : GPL
    // Date    : 11/04/2001
   
    
?>

<SCRIPT LANGUAGE="JavaScript" SRC="<? echo $siteaddress; ?>/calendar/calendar.js"></SCRIPT>



<form name="enterdates" method="POST" action="<? echo $scriptname; ?>">
  <p><font face="Arial,helvetica"><b>Start Date : <input type="text" name="startdate" size="20"></b>

 <A HREF="javascript:doNothing()" onClick="setDateField(document.enterdates.startdate);top.newWin = window.open('calendar/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')">
<IMG SRC="<? echo $siteaddress; ?>/calendar/calendar.gif" BORDER=0></A>
</p>

  <p><font face="Arial,helvetica"><b>End Date : <input type="text" name="enddate" size="20"></b>

 <A HREF="javascript:doNothing()" onClick="setDateField(document.enterdates.enddate);top.newWin = window.open('calendar/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')">
<IMG SRC="<? echo $siteaddress; ?>/calendar/calendar.gif" BORDER=0></A>

</p>

  <p><font face="Arial"><b><input type="submit" value="Submit" name="B1"><input type="reset" value="Reset" name="B2"></b></font></p>
</form>



<? include("footer.php"); ?>
