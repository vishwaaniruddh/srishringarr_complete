<?
   session_start();
   include("header.php"); 
   include("functions.php");

?>
<?
// Checkin session ID to see if user is already logged in
if ($_SESSION['auth']!=1)
{ //echo "HI".$_SESSION['auth'];
	echo "<h2>YOU ARE NOT LOGGED IN</h2>";
	echo "<h3>You have to be logged in to have acesss to this page</h3>";
	echo "<br>Please click <a href=\"../login.php\">here</a> to login<br><br>";
}
else if ($_SESSION['auth']==1)
{


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

<p>Admin Pages</p>
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="320" valign="top"> 
      <p><font face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#003366">General Administration</font></b></font></p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="enternewdepartment.php">Add a New Department</a></font> 
          <ul>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=enternewproject.php&what=Add%20a%20new%20Project">Add a New Project for Dept</a></font></li>
	     <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=enternewcategory.php&what=Add%20a%20new%20Project">Add a New Project Category for Dept</a></font></li>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=enteripaddress.php&what=Add%20a%20new%20IP%20Restriction">Add an IP Restriction for Dept</a></font></li>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=enterdeptevent.php&what=Add%20a%20new%20Department%20Login Message">Add an Event for Department</a></font></li>
          </ul>
        </li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="listalldept.php">Browse (Edit/Delete) Departments</font></li></a>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listprojectbydept.php&what=browse%20projects">Browse (Edit/Delete) Projects</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listipaddbydept.php&what=browse%20IP%20Access%20Rules">Browse  (Edit/Delete) Dept IP Access Rules</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listeventsbydept.php&what=browse%20Departmental%20Events">Browse (Edit/Delete) Dept Events</a></font></li>
      </ul>
      <p>&nbsp;</p>
    </td>
    <td width="320" valign="top"> 
      <p><font face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#003366">Employee Account Administration</font></b></font></p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="enternewemployee1.php">Add New Employee</a></font> 
          <ul>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=enterclockinmessage.php&what=Add%20ClockIn%20Message">Add a Clock in Message</a></font></li>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=enteremplock.php&what=Add%20Employee%20Lock">Add an Employee Lock</a></font></li>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=enteripaddress1.php&what=Add%20a%20new%20Employee%20IP%20Restriction">Add IP Restriction on Employee</a></font></li>
          </ul>
        </li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="searchemployee.php">Power Search Employee Record</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=enterdates1.php&datescript=listempbydepthours.php&what=View%20Employees%20">Browse (Edit/Delete) Employee Record</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=listmesgbyemp.php&scriptname3=edittimesheet.php&what=View/Edit%20Messages%20">Browse (Edit/Delete) Emp Messages</font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=listlocksbyemp.php&scriptname3=edittimesheet.php&what=View/Edit%20Locks%20">Browse (Edit/Delete) Emp Locks</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=listipaddbyemp.php&what=browse%20IP%20Access%20Rules">Browse (Edit/Delete) Emp IP Restrictions</a></font></li>
      </ul>
    </td>
    <td width="320" valign="top"> 
  <!--    <p><font face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#003366">Student Account Administration</font></b></font></p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="enternewstudent1.php">Add New Student</a></font> 
        </li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="searchstudent.php">Power Search Student Record</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="liststudents.php">Browse (Edit/Delete) Student Record</a></font></li>
      </ul>-->
    </td>

  </tr>
  <tr> 
    <td valign="top"> 
      <p><font face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#003366">Reports</font></b></font></p>
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Employee Reports</b></font></p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="listallemployees.php">View list of ALL EMPLOYEES</a></font> 
          <ul>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="chooseemptype.php?scriptname=listempbytype.php">by Type</a></font></li>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="chooseempcat.php?scriptname=listempbycat.php">by Category</a></font></li>
            
          </ul>
        </li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="chooseemptype.php?scriptname=listempbytotal.php">Total Hours Worked</a></font></li>

      </ul>
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Department Reports</b></font></p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=enterdates1.php&datescript=listempbydepthours.php&what=View%20Hours%20Worked%20by%20Department">Employee Hours by Department</a></font></li>
        
      
        
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listprojectbydept1.php&what=browse%20projects">Projects Worked by Department</a></font> 
          <ul>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listprojectbydept.php&what=List%20Project%20Hours">Hours on Project</a></font></li>
          </ul>
        </li>
        
      </ul>
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Project Reports</b></font></p>
      <ul>
      
     
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listprojectbydept2.php&scriptname2=employeesproject.php&what=browse%20projects">View Employees Working on a Project</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listprojectbydept.php&what=List%20Project%20Hours">View Project Hours</a></font> 
          <ul>
            <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listprojectbydept2.php&scriptname2=employeesproject.php&what=View%20All%20Work%20Description">View all Work Description for a Project</a></font></li>
          </ul>
        </li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="listactiveprojects.php">List of all active Projects</a></font></li>
         <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=listprojectbydept.php&what=browse%20projects">List Projects by Department</a></font></li>

        
      </ul>
      
     
    </td>
    <td valign="top"> <font face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#003366">Payroll Administration</font></b></font> 
      <ul>
    <!--    <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=enterdates.php&scriptname3=edittimesheet.php&what=Edit%20TimeSheet%20">Edit TimeSheet Record</a></font></li>-->
       <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="upload_punch.php">Upload TimeSheet Record</a></font></li>
       <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="editTimesheet.php">Edit TimeSheet Record</a></font></li>
    <!--    <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=addtimesheet.php&what=Add%20TimeSheet%20Record">Add New TimeSheet Record</font></li>-->
      <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="addPunches.php">Add New TimeSheet Record</font></li>
     <!--   <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=enterdates1.php&datescript=pregeneratepayroll.php&what=Generate%20Payroll%20">Generate Payroll Report</a></font></li>-->
     <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="generatePayroll.php">Generate Payroll Report</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=enterdates1.php&datescript=choosedeptemp.php&scriptname2=checktimesheet.php&what=Check%20Timesheets%20">Check TimeSheets</a></font></li>
      </ul>
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Payroll Maintenance </b></font></p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=addpayrolldeduction.php&what=Add%20Payroll%20Deduction">Add a Payroll Deduction</a></font></li>
     <!--   <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=addpayrollholidays.php&what=Add%20Payroll%20Holiday">Add Holiday for an Employee</a></font></li>-->
     <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="addHoliday.php" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" >Add Holiday</a></font></li>
<li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="addSalary.php" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" >Add/Edit Employee Salary</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=addpayrollbonus.php&what=Add%20Payroll%20Bonus">Add a Bonus for an employee</a></font></li>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=addpayrollsickday.php&what=Add%20Payroll%20SickDay">Add Employee Sick Day</a></font></li>
      </ul>
      <p>&nbsp;</p>
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Employee 
        Payroll Maintenance </b></font> </p>
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="choosedept.php?scriptname=choosedeptemp.php&scriptname2=browsepayroll.php&what=Browse%20Payroll%20Records">View Employee Payroll Info</a></font></li>

      </ul>
    </td>
<td valign="top"><!-- <font face="Verdana, Arial, Helvetica, sans-serif"><b><font color="#003366">Fees Administration</font></b></font> 
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="viewallpayments.php">View All Payments</a></font></li>
      
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="newpayment.php">Add New Payment</font></li>
      
      </ul>
       <p>&nbsp;</p>
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b>Costumes and Events </b></font> </p> 
      <ul>
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="createcostumes.php">Create Costumes Invoice</a></font></li>
      
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="createevents.php">Create Events Invoice</font></li>
            
       <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="viewcostumes.php">View Costume Invoices</a></font></li>
      
        <li><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><a href="viewevents.php">View Events Invoices</font></li>
            </ul>-->
          </td>

  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<h3><a href="<? echo $siteaddress; ?>/logout.php">Log Out from Account Manager</a></h3>
<h3><a href="<? echo $siteaddress; ?>/changepassword.php">Change Password for Account Manager</a></h3>

<?

} // end of else if session == 1

?>
<? include("footer.php"); ?>