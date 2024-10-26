<?

   $se="n";
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : enternewemployee2.php
    // Description : After user chooses a department, this form allow
    //               them to fill in employee information
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewemployee.php,insertemployee.php
    
?>

<?


if ($deptid=="")
{
	
	echo "<h3>Error - No Department Chosen</h3>";
	
	echo "You have to choose a department to be able to add a new student.<br>";
	
	echo $back;
	
}
else
{
	
	$deptname=genericget($deptid,'deptid','deptname','department');
	
	echo "<p><b>You are about to enter a new student for the department of <font color=red>$deptname</font></b></p>";
	

?>

<table width="100%" border="0">
  <tr>
    <td> 
      <p>Please enter student information here. Note that the fields marked with 
        a <font face="Verdana, Arial, Helvetica, sans-serif" 
                  size=-1><b><font color=red 
                  size=+1>*</font></b> </font> are mandatory and have to be filled. 
        Not filling them wont allow you to move forward.</p>
        <form method="post" action="insertstudent.php" enctype="multipart/form-data">
        <p><b>Student Information</b></p>
        <table width="80%" align=center border=0>
        

          
        
          <tr> 
            <td width=200> 
              <div align="right"><b>Identification No (SSN) : </b></div>
            </td>
            <td> 
              <input type=text name=ssn size=15>
            </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"></div>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tbody> 
          
          <tr> 
            <td width=200> 
              <div align="right"><b>Salutation :</b></div>
            </td>
            <td> 
                   <select size=1 name=salutation>
                       <option value=Mr selected>Mr</option>
                       <option value=Mrs>Mrs</option>
                       <option value=Miss>Miss</option>
                       <option value=Master>Master</option>
                       <option value=Baby>Baby</option>
                       <option value=Dr>Dr</option>
                       <option value=Prof>Prof</option>
                 </select>
              </td>
          </tr>          
          
          
          
          
          <tr> 
            <td width=200> 
              <div align="right"><b>First Name :</b></div>
            </td>
            <td> 
              <input type=text name=fname size=25> <? echo $star; ?>
             </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Middle Initials :</b></div>
            </td>
            <td> 
              <input type=text name=minit size=10>
              </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Last Name :</b></div>
            </td>
            <td> 
              <input type=text name=lname size=25> <? echo $star; ?>
              </td>
          </tr>
          </tbody> 
        </table>
        <p><b>Bio Data</b></p>
        <table width="80%" align=center border=0>
          <tbody> 
          <tr> 
            <td width=200 height="20"> 
              <div align="right"><b>Date of Birth :</b></div>
            </td>
            <td height="20"> 
              <select name="month">
                <option value="" SELECTED>Month</option>
                <option value=01>January</option>
                <option value=02>February</option>
                <option value=03>March</option>
                <option value=04>April</option>
                <option value=05>May</option>
                <option value=06>June</option>
                <option value=07>July</option>
                <option value=08>August</option>
                <option value=09>September</option>
                <option value=10>October</option>
                <option value=11>November</option>
                <option value=12>December</option>
              </select>
              <select name="day">
                <option value="" SELECTED>Day</option>
                <option value=01>01</option>
                <option value=02>02</option>
                <option value=03>03</option>
                <option value=04>04</option>
                <option value=05>05</option>
                <option value=06>06</option>
                <option value=07>07</option>
                <option value=08>08</option>
                <option value=09>09</option>
                <option value=10>10</option>
                <option value=11>11</option>
                <option value=12>12</option>
                <option value=13>13</option>
                <option value=14>14</option>
                <option value=15>15</option>
                <option value=16>16</option>
                <option value=17>17</option>
                <option value=18>18</option>
                <option value=19>19</option>
                <option value=20>20</option>
                <option value=21>21</option>
                <option value=22>22</option>
                <option value=23>23</option>
                <option value=24>24</option>
                <option value=25>25</option>
                <option value=26>26</option>
                <option value=27>27</option>
                <option value=28>28</option>
                <option value=29>29</option>
                <option value=30>30</option>
                <option value=31>31</option>
              </select>
              <select name="year" onchange="checkAge();" >
              <option value="" Selected>Year</option>
              <?
              
                    for ($yy=1900;$yy<=2010;$yy++)
                    {
                       
                        echo "<option value=$yy>$yy</option>\n";
                    	
                    }
              ?>
 
                

              </select>
              <? echo $star; ?>
              </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Age in years : </b></div>
            </td>
            <td> 
              <input type=text name="age" size=15>
            </td>
          </tr>

                    <tr> 
            <td width=200> 
              <div align="right"><b>Marital Status :</b></div>
            </td>
            <td> 
              <select name="marital">
                <option SELECTED value=""> Select One </option>
                <option value="Single"> Single </option>
                <option value="Married"> Married </option>
                <option value="Sep/Div"> Separated/Divorced </option>
                <option value="Widowed"> Widowed </option>
              </select>
            </td>
          </tr>
          <tr> 
            <td width=200 height="21"> 
              <div align="right"><b>Gender : </b></div>
            </td>
            <td height="21"> 
              <input type=radio CHECKED value=m name=gender>
              Male 
              <input type=radio value=f name=gender>
              Female </td>
          </tr>
          <tr> 
            <td width=200 height="21"> 
              <div align="right"><b>Blood Group : </b></div>
            </td>
            <td height="21"> 
              <select name="bg">
                <option SELECTED value=""> Select One </option>
                <option value="A+"> A+ </option>
                <option value="B+"> B+ </option>
                <option value="AB+"> AB+ </option>
                <option value="O+"> O+ </option>
                <option value="A-"> A- </option>
                <option value="B-"> B- </option>
                <option value="AB-"> AB- </option>
                <option value="O-"> O- </option>
              </select>
          </td>
          </tr>

          </tbody> 
        </table>
        <p><b>Electronic Contact</b></p>
        <table width="80%" align=center border=0>
          <tbody> 
          <tr> 
            <td width=200 height="20"> 
              <div align="right"><b>Email Address :</b></div>
            </td>
            <td height="20"> 
              <input type=text name=email size=35> <? echo $star; ?>
            </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Webpage :</b></div>
            </td>
            <td> 
              <input type=text name=webpage size=35>
             </td>
          </tr>
          </tbody> 
        </table>
        <p><b>Address</b></p>
        <table width="80%" align=center border=0>
          <tbody> 
          <tr> 
            <td width=200 height="20"> 
              <div align="right"><b>Address 1 :</b></div>
            </td>
            <td height="20"> 
              <input type=text name=address1 size=40><? echo $star; ?>
              </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Address 2 :</b></div>
            </td>
            <td> 
              <input type=text name=address2 size=40>
            </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>City :</b></div>
            </td>
            <td> 
              <input type=text name=city> <? echo $star; ?>
             </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>State :</b></div>
            </td>
            <td> 
              <input type=text name=state size=20>
              </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Zipcode :</b></div>
            </td>
            <td> 
              <input type=text name=zip size=10>
            </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Country :</b></div>
            </td>
            <td> 
              <input type=text name=country size=30>
              <b><font color=red>*</font></b></td>
          </tr>
          </tbody> 
        </table>
        <p><b>Phone Information</b></p>
        <table width="80%" align=center border=0>
          <tbody> 
          <tr> 
            <td width=200 height="20"> 
              <div align="right"><b>Home Phone Number :</b></div>
            </td>
            <td height="20"> 
              <input type=text name=hphone size=20>
            </td>
          </tr>
          <tr> 
            <td width=200> 
              <div align="right"><b>Cell Phone Number :</b></div>
            </td>
            <td> 
              <input type=text name=cphone size=20>
            </td>
          </tr>
          <tr> 
            <td width=200 height="31"> 
              <div align="right"><b>Office Phone Number :</b></div>
            </td>
            <td height="31"> 
              <input type=text name=ophone size=20>
            </td>
          </tr>
          </tbody> 
        </table>

        <p><b>Student Picture</b></p>
        <table width="80%" align=center border=0>
          <tbody> 
          <tr> 
            <td width=200 height="20"> 
              <div align="right"><b>Picture :</b></div>
            </td>
            <td height="20"> 
              <input type=file name=photo1>
            </td>
          </tr>
         
          </tbody> 
        </table>

         <p><b>Student Fees</b></p>
        <table width="80%" align=center border=0>
          <tbody> 
          <tr> 
            <td width=200 height="20"> 
              <div align="right"><b>Course Fees :</b></div>
            </td>
            <td height="20"> 
              <input type=text name=total>
            </td>
            <td width=200 height="20"> 
              <div align="right"><b>Registration Fees :</b></div>
            </td>
            <td height="20"> 
              <input type=text name=rfees value=250>
            </td>
          </tr>
          <tr> 
            <td width=200 height="20"> 
              <div align="right"><b>Discount :</b></div>
            </td>
            <td height="20"> 
              <input type=text name=dis value=0>
            </td>
            <td width=200 height="20"> 
              <div align="right"><b>Mode :</b></div>
            </td>
            <td height="20"> 
              <select size=1 name=mode>
                       <option value=onetime selected>One Time</option>
                       <option value=monthly>Monthly</option>
              </select>         
            </td>

          </tr>

          <tr> 
            <td width=200 height="20"> 
              <div align="right"><b>Fees Paid:</b></div>
            </td>
            <td height="20"> 
               <input type=text name=paid>              
            </td>
          </tr>
         
          </tbody> 
        </table>
        
        <p><b>Questionaire: Please spend some time to answer these questions.</b></p>
        <table width="80%" align=center border=0>
          <tbody> 
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>What is Dance/Acting for you?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q1 size=200>
            </td>
          </tr>
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>Your favourite performing arts.Why?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q2 size=200>
            </td>
          </tr>
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>Do you Aspire to take your talent to a next level?Why?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q3 size=200>
            </td>
          </tr>
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>If given an oppurtunity would you want to make a career in Arts Industry?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q4 size=200>
            </td>
          </tr>
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>Do you have it in you to become an international Performer?Why?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q5 size=200>
            </td>
          </tr>
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>What is QARMA for you?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q6 size=200>
            </td>
          </tr>
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>How aspired are you to join QARMA as a professional?Why?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q7 size=200>
            </td>
          </tr>
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>Rate them accordingly: Hardwork, Loyalty, Dedication</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q8 size=200>
            </td>
          </tr>
          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>Do you believe QARMA can help you fulfil your dreams?Why?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q9 size=200>
            </td>          </tr>
          <tr>
            <td width=600 height="20"> 
              <div align="left"><b>Your career should have:(pick your preferences)</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=checkbox name="career[]" value="money" >Money
              <input type=checkbox name="career[]" value="naf" >Name and Fame
              <input type=checkbox name="career[]" value="satisfaction" >Satisfaction
            </td>          </tr>

          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>Your Life's motto and aim?</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q10 size=200>
            </td>
          </tr>

          <tr> 
            <td width=600 height="20"> 
              <div align="left"><b>Few lines for QARMA</b></div>
            </td></tr><tr>
            <td height="20" width=600> 
              <input type=text name=q11 size=200>
            </td>
          </tr>

          </tbody> 
        </table>

        <p>
          <input type="hidden" name=deptid value="<? echo $deptid; ?>">
          <input type="submit" name="Submit" value="Enter New Student">
        </p>
      </form>

      </td>
  </tr>
</table>

<?


 } // end else deptid==""


?>

<? include("footer.php"); ?>
<script language="javascript" >

function checkAge(){ 
var today = new Date(); 
var day = document.forms[0].day.value;
var month = document.forms[0].month.value;
var year = document.forms[0].year.value;

var byr = parseInt(year); 
var nowyear = today.getFullYear();

var bmth = parseInt(month)-1;   // radix 10!

var bdy = parseInt(day);   // radix 10!
var dim = daysInMonth(bmth+1,byr);
if (bdy > dim) {  // check valid date according to month
showMessage();
return false;
}

var age = nowyear - byr;
var nowmonth = today.getMonth();
var nowday = today.getDate();
if (bmth > nowmonth) {age = age - 1}  // next birthday not yet reached
else if (bmth == nowmonth && nowday < bdy) {age = age - 1}

//alert('You are ' + age + ' years old'); 
//if (age <= 15) {
//alert ("You are 15 years old or less!");  
//}
document.forms[0].age.value=age;
}

function showMessage() {
if (document.forms[0].day.value != "") {
alert ("Invalid date format or impossible year/month/day of birth - please re-enter ");
}
}

function daysInMonth(month,year) {  // months are 1-12
var dd = new Date(year, month, 0);
return dd.getDate();
} 

</script>