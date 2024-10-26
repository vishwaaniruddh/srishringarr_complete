<?

   $se=n;
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>
<?
    // FILE DOCUMENTATION
    // Filename    : addpayrollholidays.php
    // Description : This file allows admin to add a new holiday to employee payroll
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

<SCRIPT LANGUAGE="JavaScript" SRC="<? echo $siteaddress; ?>/calendar/calendar.js"></SCRIPT>

<h3>Add New Time Record for <? echo $empname; ?></h3>
  <form name="addts" method="post" action="updatetimerecord.php">
    <table width="640" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Employee Name :</div>
        </td>
        <td height="30" width="509"><font color="#003399"><b><? echo $empname; ?></b></font></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"><b><font color="#660033">Check IN</font></b></div>
        </td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Date :</div>
        </td>
        <td height="30" width="509"> 
          <input type="text" name="inday1" size="16">
          
          <A HREF="javascript:doNothing()" onClick="setDateField(document.addts.inday1);top.newWin = window.open('<? echo $siteaddress; ?>/calendar/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')"><IMG SRC="<? echo $siteaddress; ?>/calendar/calendar.gif" BORDER=0></A>
          
          
          <b><i> (YYYY-MM-DD) </i></b></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Time :</div>
        </td>
        <td height="30" width="509"> 
          <input type="text" name="intime1" size="16">
          <b><i> (hh:mm:ss) </i></b></td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"></div>
        </td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"><b><font color="#660033">Check Out</font></b></div>
        </td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Date :</div>
        </td>
        <td height="30" width="509"> 
          <input type="text" name="outday1" size="16">
          
                    <A HREF="javascript:doNothing()" onClick="setDateField(document.addts.outday1);top.newWin = window.open('<? echo $siteaddress; ?>/calendar/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')"><IMG SRC="<? echo $siteaddress; ?>/calendar/calendar.gif" BORDER=0></A>
          
          <b><i> (YYYY-MM-DD)</i></b> </td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Time :</div>
        </td>
        <td height="30" width="509"> 
          <input type="text" name="outtime1" size="16">
          <b><i> (hh:mm:ss) </i></b> </td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right"></div>
        </td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131">&nbsp;</td>
        <td height="30" width="509">&nbsp;</td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Work Done :</div>
        </td>
        <td height="30" width="509"> 
          <textarea name="workdesc" cols="30" rows="4" wrap="VIRTUAL"></textarea>
        </td>
      </tr>
      <tr> 
        <td height="30" width="131"> 
          <div align="right">Project Worked :</div>
        </td>
        <td height="30" width="509">
        
                     <? 
                     echo "<select name=\"projectid\">\n";
                      projectdropdown($deptid);
              
                     echo "</select>\n";
             ?>
         </td>
      </tr>
    </table>
    <p>
      <input type=hidden name=empid value="<? echo $empid; ?>">
      <input type=hidden name=action value=a>
      <input type="submit" name="Submit" value="Update Time Sheet Record">
    </p>
  </form>

<? include("footer.php"); ?>