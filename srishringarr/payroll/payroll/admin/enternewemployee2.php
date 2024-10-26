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
	
	echo "You have to choose a department to be able to add a new employee.<br>";
	
	echo $back;
	
}
else
{
	
	$deptname=genericget($deptid,'deptid','deptname','department');
	
	echo "<p><b>You are about to enter a new employee for the department of <font color=red>$deptname</font></b></p>";
	

?>

<table width="100%" border="0">
  <tr>
    <td> 
      <p>Please enter employee information here. Note that the fields marked with 
        a <font face="Verdana, Arial, Helvetica, sans-serif" 
                  size=-1><b><font color=red 
                  size=+1>*</font></b> </font> are mandatory and have to be filled. 
        Not filling them wont allow you to move forward.</p>
        <form method="post" action="insertemployee.php" enctype="multipart/form-data">
        <p><b>Employee Information</b></p>
        <table width="80%" align=center border=0>
        

         <tr> 
            <td width=200> 
              <div align="right"><b>Type : </b></div>
            </td>
            <td> 
                <select name="typeid">
                
                   <? 
                      // making drop down list for all categories
                      makedropdown('typeid','typename','employeetype') 
                      
                   ?>
                
              </select> <? echo $star; ?>
            </td>
          </tr>
          
         <tr> 
            <td width=200> 
              <div align="right"><b>Category : </b></div>
            </td>
            <td> 
               <select name="catid">
                
                   <? 
                      // making drop down list for all categories
                      makedropdown('catid','catname','empcategory') 
                      
                   ?>
                
              </select> <? echo $star; ?>
            </td>
          </tr>                  
          
         <tr> 
            <td width=200> 
              <div align="right"><b>Job Title : </b></div>
            </td>
            <td> 
               <select name="jobid">
                
                   <? 
                      // making drop down list for all categories
                      makedropdown('jobid','jobtitle','jobtitle') 
                      
                   ?>
                
              </select>
            </td>
          </tr>  
          
          <tr> 
            <td width=200 valign=top> 
              <div align="right"><b>Regular Hours (/week) :</b></div>
            </td>
            <td> 
              <input type=text name=regularhours size=5> hours <? echo $star; ?><br>
              <i>Regular Hours is the normal number of hours employee is supposed to work in a week</i>
             </td>
          </tr>
          
           <tr> 
            <td width=200 valign=top> 
              <div align="right"><b>Hourly Payrate :</b></div>
            </td>
            <td> 
              <input type=text name=hourlypay size=5><br>
              
             </td>
          </tr>
          
        
           <tr> 
            <td width=200>&nbsp; 
              
            </td>
            <td>&nbsp; 
               
            </td>
          </tr>
 
        
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
              <select name="year">
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
            
          
              <input type="hidden" name="race" value="Indian" >
                              
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
              <div align="right"><b>Office Phone Number ::</b></div>
            </td>
            <td height="31"> 
              <input type=text name=ophone size=20>
            </td>
          </tr>
          </tbody> 
        </table>

        <p><b>Employee Picture</b></p>
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


        <p>
          <input type="hidden" name=deptid value="<? echo $deptid; ?>">
          <input type="submit" name="Submit" value="Enter New Employee">
        </p>
      </form>

      </td>
  </tr>
</table>

<?


 } // end else deptid==""


?>

<? include("footer.php"); ?>
