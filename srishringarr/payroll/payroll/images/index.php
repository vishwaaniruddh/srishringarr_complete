<? include("header.php"); 
   include("functions.php"); 

?>

<h3>Enterprise Payroll System</h3>
<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td valign="top"> 
      <p>CLOCK SYSTEM</p>
      <ul>
        <li><a href="startwork.php">Start Work</a></li>
        <li><a href="stopwork.php">Stop Work</a></li>
      </ul>
      <p>ACCOUNT MANAGER</p>
      <ul>
        <li><a href="login.php">Login to Account Manager</a></li>
        <li><a href="logout.php">Logout from Account Manager</a></li>
      </ul>
    </td>
    <td valign="top"> 
      <p>Employees Currently Checked In</p>
      
<?


      	$query = "select empid,checkin,checkout from timesheet where checkout='' order by checkin;";
      	
       $result = MYSQL_QUERY($query);  

       if ($result>0) { $number = MYSQL_NUMROWS($result);}                       
       else {$number=0;}               
            
       $i = 0;

       if ($number == 0)
       {
               echo "<h2>No-one Checked in $deptname !<h2>";
       }
       elseif ($number > 0)
       {
    
          $i=0;
          echo "<table border=1>";
          
          while ($i < $number)
          {

                                    
                   $empid = mysql_result($result,$i,"empid");
                   $checkin= mysql_result($result,$i,"checkin");
                   $checkout= mysql_result($result,$i,"checkout");
                   
                   
                   $deptid = $deptid=genericget($empid,'empid','deptid','employee');
                   $deptname=genericget($deptid,'deptid','deptname','department');

                   list($inday,$intime)=explode(' ',$checkin);
                   
                   $empname=getempname($empid);

                   echo "<tr height=20>\n";
                   echo "<td>$empname</td>\n";
                   echo "<td>$intime</td>\n";
                   echo "<td>$deptname</td>\n";
                   echo "</tr>\n";   

                   $i++;
                   
          } // end while


          echo "</table>";

       } // end of else if number > 0





?>      
      
      
      
      <p>&nbsp;</p>
      </td>
  </tr>
</table>

<? include("footer.php"); ?>