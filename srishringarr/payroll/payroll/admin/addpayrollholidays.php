<?
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



<h3>Add a Holiday for <? echo $empname; ?></h3>
  <h3>Department : <? echo $deptname; ?></h3>
  <font color="#990033"></font> 
  <form name="addts" method="post" action="insertpayrollholidays.php">
    <table width="640" border="0" cellspacing="0" cellpadding="0">
      <tr valign="top"> 
        <td height="30" width="149"> 
          <div align="right">Date of Holidays :</div>
        </td>
        <td height="30" width="491"> 
          <input type="text" name="datehol"> <A HREF="javascript:doNothing()" onClick="setDateField(document.addts.datehol);top.newWin = window.open('<? echo $siteaddress; ?>/calendar/calendar.html','cal','dependent=yes,width=210,height=230,screenX=200,screenY=300,titlebar=yes')">
<IMG SRC="<? echo $siteaddress; ?>/calendar/calendar.gif" BORDER=0></A>
        </td>
      </tr>
      <tr valign="top"> 
        <td height="30" width="149"> 
          <div align="right">Holidays Payment :</div>
        </td>
        <td height="30" width="491"> 
          <p><b> $</b> 
            <input type="text" name="holpayment">
          </p>
          <p><i>This is the amount that employee will be paid for, for this holiday. 
            (e.g If it is equivalent to one day's work, please put the amount 
            here) </i></p>
        </td>
      </tr>
      <tr valign="top"> 
        <td height="30" width="149"> 
          <div align="right">Description :</div>
        </td>
        <td height="30" width="491"> 
          <textarea name="holdesc" rows="3" cols="30" wrap="VIRTUAL"></textarea>
        </td>
      </tr>
    </table>
    <p>
      <input type=hidden name=empid value="<? echo $empid; ?>">
      <input type="submit" name="Submit" value="Add a Holiday">
    </p>
    <p><font color="#990033"><b></b></font> </p>
  </form>




<? include("footer.php"); ?>