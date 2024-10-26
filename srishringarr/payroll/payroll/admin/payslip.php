<?
   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");
?>
<?
                $empname=getempname($empid);
   
                // Adding time to the dates
                // Starting at 00:00 on the $startdate
                $startdate1=$startdate." 00:00:00";
          
                // Ending at 23:59:59 on the enddate
                $enddate1=$enddate." 23:59:59";

                // Query to find all checkins between $startdate and $enddate 
               $query = "select timeid,roundedtime,checked from timesheet where empid='$empid' and checkin >= '$startdate1' and checkout <= '$enddate1' order by checkin;";
               $result =  MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query);

               // Finding number of rows of SQL Query
               if ($result>0) { $number = MYSQL_NUMROWS($result); }
               else {$number=0;}   
 
               // If there is no timesheet record
               if ($number == 0)
               {
                   $timeworked=0;
                   $approvehours=0;                         
               }
               // else if there are timesheet records
               elseif ($number > 0)
               {
                     $totalhours=0;
                     $approvehours=0;
                     $i=0;
                               
                     // Go through each record in loop
                     while ($i < $number)
                     {                                                            
                            // Fetching Timesheet Data and storing in local variables  
                            $timeid = mysql_result($result,$i,"timeid");                     
                            $roundedtime= mysql_result($result,$i,"roundedtime");
                            $checked= mysql_result($result,$i,"checked");
                                                                        
                            if ($checked=='y')
                            {
                                 $approvehours=$approvehours+$roundedtime;
                            } 
                                   
                            // Calculating Total Hours
                            $totalhours=$totalhours+$roundedtime; 

                            $i++;
                                    
                    } // end while i < number

                } // end of else if number > 0


// get employee type
// hourly or salary support only for now
$typeid=genericget($empid,'empid','typeid','employee');
$catid=genericget($empid,'empid','catid','employee');

$catname=genericget($catid,'catid','catname','empcategory');
$typename=genericget($typeid,'typeid','typename','employeetype');


// Hourly Worker
// Hourly Type id = 1
if ($typeid=="1")
{
     $hourlyrate=genericget($empid,'empid','hourlyrate','hourly');
     $grosspay=$approvehours*$hourlyrate;
     $grosspay=twodecimals($grosspay);
     $finalpay=$grosspay;
     
     // DEDUCTIONS
     // Query to get deductions
     $querydeduc="select * from deductions where empid='$empid'";

     $resultdeduc = MYSQL_QUERY($querydeduc);
     $numberdeduc = MYSQL_NUMROWS($resultdeduc);

     $noded = 0;
                
     if ($numberdeduc > 0) 
     {     
              WHILE ($noded < $numberdeduc)
              { 
              	
              	 $dedtype=mysql_result($resultdeduc,$noded,"deductype");
              	 $dedamount=mysql_result($resultdeduc,$noded,"amount");
              	 $dednote=mysql_result($resultdeduc,$noded,"note");
              	 
              	 $deducdesc[]="$dednote";
              	 $deducamount[]=$dedamount;
              	 
              	 $finalpay=$finalpay-$dedamount;
              	 
              	 $noded++;
      
      
              }
     } 
      
     // BONUSES
     // Query to get bonueses
     $querybonus="select * from bonus where empid='$empid' and datebonus>='$startdate' and datebonus<'$enddate'";

     $resultbonus = MYSQL_QUERY($querybonus);
     $numberbonus = MYSQL_NUMROWS($resultbonus);

     $nobon = 0;
                
     if ($numberbonus > 0) 
     {     
              WHILE ($nobon < $numberbonus)
              { 
              	
              	 $datebon=mysql_result($resultbonus,$nobon,"datebonus");
              	 $bonamount=mysql_result($resultbonus,$nobon,"bonuspayment");
              	 $bonnote=mysql_result($resultbonus,$nobon,"note");
              	           	 
              	 $bonusdesc[]="$bonnote ($datebon)";
              	 $bonusamount[]=$bonamount;
              	 
              	 $finalpay=$finalpay+$bonamount;
              	 
              	 $nobon++;   
      
              }
     }       
      
     
     // HOLIDAYS
     // Query to get holidays
     $queryhols="select * from holidays where empid='$empid' and datehols>='$startdate' and datehols<'$enddate'";

     $resulthols = MYSQL_QUERY($queryhols);
     $numberhols = MYSQL_NUMROWS($resulthols);

     $nohols = 0;
                
     if ($numberhols > 0) 
     {     
              WHILE ($nohols < $numberhols)
              { 
              	
              	 $datehols=mysql_result($resulthols,$nohols,"datehols");
              	 $holspayment=mysql_result($resulthols,$nohols,"payment");
              	 $holsnote=mysql_result($resulthols,$nohols,"note");
              	 
              	           	 
              	 $holsdesc[]="$holsnote ($datehols)";
              	 $holsamount[]=$holspayment;
              	 
              	 $finalpay=$finalpay+$holspayment;
              	 
              	 $nohols++;   
      
              }
     }       
     
     // SICK DAYS
     // Query to get sick days
     $querysick="select * from sickday where empid='$empid' and datesick>='$startdate' and datesick<'$enddate'";

     $resultsick = MYSQL_QUERY($querysick);
     $numbersick = MYSQL_NUMROWS($resultsick);

     $nosick = 0;
                
     if ($numbersick > 0) 
     {     
              WHILE ($nosick < $numbersick)
              { 
              	
              	 $datesick=mysql_result($resultsick,$nosick,"datesick");
              	 $sickpayment=mysql_result($resultsick,$nosick,"payment");
              	 $sicknote=mysql_result($resultsick,$nosick,"note");
              	 
              	           	 
              	 $sickdesc[]="$sicknote ($datesick)";
              	 $sickamount[]=$sickpayment;
              	 
              	 $finalpay=$finalpay+$sickpayment;
              	 
              	 $nosick++;   
      
              }
     }       
     
     
     // Starting Payslip display
     
?>


<table width="640" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> 
      <h2>Employee PayRoll Slip</h2>
      <table width="640" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Name : </div>
          </td>
          <td height="30" width="492"><font color="#990033"><b><? echo $empname; ?></b></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Pay Period :</div>
          </td>
          <td height="30" width="492"><font color="#990033"><b><? echo "$startdate - $enddate"; ?></b></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Employee Category : </div>
          </td>
          <td height="30" width="492"><font color="#990033"><b><? echo $catname; ?></b></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Payroll Type : </div>
          </td>
          <td height="30" width="492"><font color="#990033"><b><? echo $typename; ?></b></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Hourly Pay :</div>
          </td>
          <td height="30" width="492"><font color="#990033">$<? echo $hourlyrate; ?></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"><div align="right">Hours Worked :</div> </td>
          <td height="30" width="492"><font color="#990033"><? echo $approvehours; ?></font></td>
        </tr>
        <tr> 
          <td height="30" width="148"> 
            <div align="right">Pay Before Adjustments :</div>
          </td>
          <td height="30" width="492"><font color="#990033">$<? echo $grosspay; ?></font></td>
        </tr>
        
      </table>
      <p>&nbsp;</p>
      <table width="640" border="0" cellspacing="0" cellpadding="0">
        <tr bgcolor="#CCCCCC"> 
          <td width="120" height="30"> 
            <div align="right"><b>Description</b></div>
          </td>
          <td width="1" height="30"> 
            <div align="right"><b><b><b><b></b></b></b></b></div>
          </td>
          <td width="231" height="30"> 
            <div align="center"><b>Description</b></div>
          </td>
          <td width="1" height="30"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="243" height="30"> 
            <div align="right"><b>Compensation</b></div>
          </td>
          <td width="15" height="30"> 
            <div align="right"><b><b><b><b><b></b></b></b></b></b></div>
          </td>
        </tr>
        
        
        
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Hours Worked</div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center">Normal Pay</div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<? echo $grosspay; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>+</b></div>
          </td>
        </tr>
        
        <?
          
            // ****************************************
            // DEDUCTIONS
            for ($x1=0;$x1<count($deducamount);$x1++)
            {
            	 $x11=$x1+1;
            	
        ?>    	
            	  
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Deduction <? echo $x11; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center"><? echo $deducdesc[$x1]; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<? echo $deducamount[$x1]; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>-</b></div>
          </td>
        </tr>
        
        <?
        
           } // end for $x1
        
        ?>

         <?
          
         // ****************************************
         // BONUSES
         for ($x3=0;$x3<count($bonusamount);$x3++)
         {
            $x33=$x3+1;
            	
        ?>    	
            	  
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Bonus <? echo $x33; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center"><? echo $bonusdesc[$x3]; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<? echo $bonusamount[$x3]; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>+</b></div>
          </td>
        </tr>
        
        <?
        
           } // end for $x3
        
        ?>


        
        
         <?
          
            // ****************************************
            // HOLIDAYS
            for ($x2=0;$x2<count($holsamount);$x2++)
            {
            	 $x22=$x2+1;
            	
        ?>    	
            	  
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Holiday <? echo $x22; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center"><? echo $holsdesc[$x2]; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<? echo $holsamount[$x2]; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>+</b></div>
          </td>
        </tr>
        
        <?
        
           } // end for $x2
        
        ?>
        
         <?
          
            // ****************************************
            // SICK DAYS
            for ($x4=0;$x4<count($sickamount);$x4++)
            {
            	 $x44=$x4+1;
            	
        ?>    	
            	  
        <tr> 
          <td width="120" height="30"> 
            <div align="right">Holiday <? echo $x44; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="231" height="30"> 
            <div align="center"><? echo $sickdesc[$x4]; ?></div>
          </td>
          <td width="1" height="30" bgcolor="#000000">&nbsp;</td>
          <td width="243" height="30"> 
            <div align="right">$<? echo $sickamount[$x4]; ?></div>
          </td>
          <td width="15" height="30"> 
            <div align="center"><b>+</b></div>
          </td>
        </tr>
        
        <?
        
           } // end for $x2
        
        ?>        
        
        
        
        <tr bgcolor="#000000"> 
          <td width="120" height="1"> 
            <div align="right"></div>
          </td>
          <td width="1" height="1" bgcolor="#000000"></td>
          <td width="231" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="1" height="1" bgcolor="#000000"></td>
          <td width="243" height="1"> 
            <div align="right"></div>
          </td>
          <td width="15" height="1"> 
            <div align="center"><b></b></div>
          </td>
        </tr>
        <tr> 
          <td width="120" height="30"> 
            <div align="right"></div>
          </td>
          <td width="1" height="30"> 
            <div align="right"></div>
          </td>
          <td width="231" height="30"> 
            <div align="right"><b>Total :</b></div>
          </td>
          <td width="1" height="30"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="243" height="30"> 
            <div align="right"><b><font color="#990000">$<? echo $finalpay; ?></font></b></div>
          </td>
          <td width="15" height="30"> 
            <div align="right"><b></b></div>
          </td>
        </tr>
        <tr bgcolor="#000000"> 
          <td width="120" height="1"> 
            <div align="right"></div>
          </td>
          <td width="1" height="1"> 
            <div align="center"></div>
          </td>
          <td width="231" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="1" height="1"><img src="http://192.168.1.2/payroll/images/shim.gif"></td>
          <td width="243" height="1"> 
            <div align="right"></div>
          </td>
          <td width="15" height="1"> 
            <div align="center"><b></b></div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>     
     
     
     
<?
     
  
         
}// end if typeid=1
// Employee is salaried
else if ($typeid=="2")
{

    $baseyear=genericget($empid,'empid','baseyear','salary');
    
    echo "<h3>This employee is a salaried employee. Salaried Employee Payroll Generation not yet supported.</h3>";
    echo "<h3>Base Pay per Year : $baseyear </h3>";
    
    

}
else
{

    echo "<h3>This employee type not yet supported for payroll generation by this system.</h3>";

}

?>

<? include("footer.php"); ?>