<?

   $se=n;
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : adminviewempinfo.php
    // Description : This file allows admin to view/edit employee info
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : searchemployee.php,browseemployee.php
    
?>


<?

       // Query to get employee data based on employee id
       $query = "select * from employee where empid='$empid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
            
          echo "<h3>This employee does not exist. </h3>"; 
       }
       else if ($number>0)
       {

           $empid=mysql_result($result,0,"empid"); 
           $deptid=mysql_result($result,0,"deptid");
           $jobid=mysql_result($result,0,"jobid");
           $parentid=mysql_result($result,0,"parentid");
           $typeid=mysql_result($result,0,"typeid");
           $catid=mysql_result($result,0,"catid");
           $salutation=mysql_result($result,0,"salutation");
           $lastname=strtoupper(mysql_result($result,0,"lastname"));
           $firstname=ucwords(mysql_result($result,0,"firstname"));
           $minit=mysql_result($result,0,"minit");
           $ssn=mysql_result($result,0,"ssn");
           if ($ssn=="") $ssn="none";
           $dob=mysql_result($result,0,"dob");
           $gender=mysql_result($result,0,"gender");
           $race=mysql_result($result,0,"race");
           $marital=mysql_result($result,0,"marital");
           $address1=mysql_result($result,0,"address1");
           $address2=mysql_result($result,0,"address2");
           $city=mysql_result($result,0,"city");
           $state=mysql_result($result,0,"state");
           $zipcode=mysql_result($result,0,"zipcode");
           $country=mysql_result($result,0,"country");
           $email=mysql_result($result,0,"email");
           $webpage=mysql_result($result,0,"webpage");
           if ($webpage=="") $webpage="none";
           $homephone=mysql_result($result,0,"homephone");
           if ($homephone=="") $homephone="none";
           $officephone=mysql_result($result,0,"officephone");
           if ($officephone=="") $officephone="none";
           $cellphone=mysql_result($result,0,"cellphone");
           if ($cellphone=="") $cellphone="none";
           $regularhours=mysql_result($result,0,"regularhours");
           $login=mysql_result($result,0,"login");
           $password=mysql_result($result,0,"password");
           $admin=mysql_result($result,0,"admin");
           $superadmin=mysql_result($result,0,"superadmin");
           $numlogins=mysql_result($result,0,"numlogins");
           $lastlogindate=mysql_result($result,0,"lastlogindate");
           $loginip=mysql_result($result,0,"loginip");
           $datesignup=mysql_result($result,0,"datesignup");
           $ipsignup=mysql_result($result,0,"ipsignup");
           $dateupdated=mysql_result($result,0,"dateupdated");
           $ipupdated=mysql_result($result,0,"ipupdated");
           $lastproject=mysql_result($result,0,"lastproject");
           $active=mysql_result($result,0,"active");
           
           $deptname=genericget($deptid,'deptid','deptname','department');
           $jobtitle=genericget($jobid,'jobid','jobtitle','jobtitle');
           $emptype=genericget($typeid,'typeid','typename','employeetype');
           $empcat=genericget($catid,'catid','catname','empcategory');
           $managerid=genericget($deptid,'deptid','managerid','department');
           $managername=getempname($managerid);
           if ($managername=="") { $managername="none yet"; }
 
           $haspic=checkemppicture($empid);





?>

<h2><font face="Verdana, Arial, Helvetica, sans-serif" color="#000066">Employee 
  Record</font></h2>
<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="180" valign="top"> 
      <p>&nbsp;</p>
      <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" bordercolordark="#CCCCCC" bordercolorlight="#CCCCCC" bgcolor="#F2F2F2">
        <tr bgcolor="#F4F4F4"> 
          <td height="30" width="26%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">EMPID 
              :</font></div>
          </td>
          <td height="30" width="74%"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><b><? echo $empid; ?></b></font></td>
        </tr>
        <tr bgcolor="#F4F4F4"> 
          <td height="30" width="26%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">ID 
              :</font></div>
          </td>
          <td height="30" width="74%"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><b><? echo $ssn; ?></b></font></td>
        </tr>
        <tr bgcolor="#F4F4F4"> 
          <td height="30" width="26%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Name 
              :</font></div>
          </td>
          <td height="30" width="74%"> 
            <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><b><? echo "$salutation $firstname $minit $lastname"; ?></b></font></p>
          </td>
        </tr>
        <tr bgcolor="#F4F4F4"> 
          <td height="30" width="26%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Dept 
              :</font></div>
          </td>
          <td height="30" width="74%"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><b><? echo $deptname; ?></a></b></font></td>
        </tr>
        <tr bgcolor="#F4F4F4"> 
          <td height="30" width="26%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Job 
              :</font></div>
          </td>
          <td height="30" width="74%" bgcolor="#F4F4F4"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b><font color="#000066"><? echo $jobtitle; ?></font></b></font></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </td>
    <td align="center" valign="top" width="300" height="180"> 
      <div align="right"> 
        <p><font color="#990000" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Employee 
          Picture</b></font> </p>
      </div>
      <table width="80%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td> 
            
                <?
                 
                 if ($haspic==1)
                 {
            
                     echo "<a href=\"$siteaddress/viewemppic.php?empid=$empid\"><img src=\"$siteaddress/viewemppic.php?empid=$empid\" alt=\"$firstname $lastname\" width=150 height=150 border=1></a></div>";
                
                 }
                 else if ($haspic==0)
                 {
                 
                      echo "No Picture Available";
                 
                 
                 }
            
               ?>
            
            
            
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr valign="top"> 
    <td height="30"> 
      <p><font color="#660000"><b><font color="#990000" size="-1" face="Verdana, Arial, Helvetica, sans-serif">Contact 
        Information</font></b></font></p>
      <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#F4F4F4" bordercolorlight="#CCCCCC" bordercolordark="#CCCCCC">
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Email 
              :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><a href="mailto:<? echo $email; ?>"><? echo $email; ?></a></font></td>
        </tr>
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Webpage 
              :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><a href="<? echo $webpage; ?>"><? echo $webpage; ?></a></font></td>
        </tr>
      </table>
      <p><font face="Verdana, Arial, Helvetica, sans-serif" size="-1"><b><font color="#990000">Phone</font></b></font></p>
      <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#F4F4F4" bordercolorlight="#CCCCCC" bordercolordark="#CCCCCC">
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Home 
              Phone:</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $homephone; ?></font></td>
        </tr>
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Cell 
              Phone :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $cellphone; ?></font></td>
        </tr>
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Office 
              Phone :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $officephone; ?></font></td>
        </tr>
      </table>
      <p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#990000">Address</font></b></p>
      <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#F4F4F4" bordercolorlight="#CCCCCC" bordercolordark="#CCCCCC">
        <tr valign="top"> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Address 
              :</font></div>
          </td>
          <td width="66%" height="30"> <font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066">
          
          <? echo "$address1<br>$address2<br>$city, $state<br>$country<br>"; ?> 
           
           </font>
          </td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </td>
    <td> 
      <p align="right"><font color="#990000" size="-1" face="Verdana, Arial, Helvetica, sans-serif"><b>Work 
        Information</b></font></p>
      <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#F4F4F4" bordercolorlight="#CCCCCC" bordercolordark="#CCCCCC">
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Type  :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $emptype; ?></font></td>
        </tr>
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Category 
              :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $empcat; ?></font></td>
        </tr>
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Dept 
              :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo "<a href=\"$siteaddress/viewdeptinfo.php?deptid=$deptid\">$deptname</a>"; ?></font></td>
        </tr>
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Manager 
              :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo "<a href=\"$siteaddress/viewempinfo.php?empid=$managerid\">$managername</a>"; ?></font></td>
        </tr>
        <tr> 
          <td width="34%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Reg 
              Hours :</font></div>
          </td>
          <td width="66%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $regularhours; ?>   Hours</font></td>
        </tr>
      </table>
      <p align="right"><font color="#660000"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#990000">BIO 
        Data </font></b></font></p>
      <table width="90%" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#F4F4F4" bordercolorlight="#CCCCCC" bordercolordark="#CCCCCC">
        <tr> 
          <td width="40%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Race 
              :</font></div>
          </td>
          <td width="60%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $race; ?></font></td>
        </tr>
        <tr> 
          <td width="40%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Marital 
              Stat :</font></div>
          </td>
          <td width="60%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $marital; ?></font></td>
        </tr>
        <tr> 
          <td width="40%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Gender 
              :</font></div>
          </td>
          <td width="60%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $gender; ?></font></td>
        </tr>
        <tr> 
          <td width="40%"> 
            <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1">Date of Birth :</font></div>
          </td>
          <td width="60%" height="30"><font face="Verdana, Arial, Helvetica, sans-serif" size="-1" color="#000066"><? echo $dob; ?></font></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr valign="top"> 
    <td height="30" colspan="2"> 
      
    </td>
  </tr>
</table>

<?

  } // end of else $number>0

?>

<? include("footer.php"); ?>
