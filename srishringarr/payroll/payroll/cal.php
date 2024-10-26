<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : calendartime.php
    // Description : This file allow employees to view their time in a calendar
    //               format, with total hours per day calculated
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : 
    
?>

<?

$empid=1;
$startdate="2001-10-01";
$enddate="2001-10-11";

    // Get Employee Name 
    $empname=getempname($empid);


    echo "<h3><b>Time Record for $empname</h3>Period starting $startdate and ending $enddate</b><br><br>";



    // Finding Number of days between startdate and enddate  
    $nodays=returnnumdays($startdate,$enddate);

    
    // Breaking Startdate and Edndate into Tokens
    list($syear,$smonth,$sday)=explode('-',$startdate);
    list($eyear,$emonth,$eday)=explode('-',$enddate);

 
    // Converting Startdate and Eneddate into Unix Epoch Time
    $enddate1=mktime(0,0,0,date("$emonth"),date("$eday"),date("$eyear"));
    $startdate1=mktime(0,0,0,date("$smonth"),date("$sday"),date("$syear"));


     // Getting Day of the week as an integer
     // for cell placement , Sunday =0, Monday = 1 etc..
     $startday=date ("w", mktime(0,0,0,$smonth,$sday,$syear));


     // Finding Number of Rows in Calendar
     $norows=floor((($nodays+$startday)/7))+1;

     // Finding Number of Cells
     $nocells=$norows*7;


      // Populating Cells for Cells before the $startdate 
      for ($a=0;$a<=$startday;$a++)
      {
             // Finding date before the startdate    
             $d=date( "Y-m-d",mktime(0,0,0,date("$smonth"),date("$sday")-$a,date("$syear")) );	 
             
             // Changing Format to Month Day e.g Nov 13
             $d1=date( "M d",mktime(0,0,0,date("$smonth"),date("$sday")-$a,date("$syear")) ); 
	
             // ActualValue Cell
             $cell[$startday-$a]=$d;
             
             // Display Date
	     $dcell[$startday-$a]=$d1;
      }

      // Next Day
      $nextday=$startday+1;

      // Populating Cells for Cells after the $startdate 
      for ($b=$nextday;$b<=$nocells;$b++)
      {

	     $f=$f+1;
	
	     // Finding date after the startdate  
             $d=date( "Y-m-d",mktime(0,0,0,date("$smonth"),date("$sday")+$f,date("$syear")));
             
             // Changing Format to Month Day e.g Nov 13
             $d1=date( "M d",mktime(0,0,0,date("$smonth"),date("$sday")+$f,date("$syear")));
             
             // Populating Cell
             // Actual Date
	     $cell[$b]=$d;
	     
	     // Display Date
	     $dcell[$b]=$d1;
	
      }

?>

<table width="640" bnrder="1" cellspacing="0" cellpadding="0">
  <tr bgcolor="#CCCCCC"> 
    <td height="40" width="85"> 
      <div align="center"><font size="-1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Sunday</font></b></font></div>
    </td>
    <td height="40" width="85"> 
      <div align="center"><font size="-1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Monday</font></b></font></div>
    </td>
    <td height="40" width="85"> 
      <div align="center"><font size="-1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Tuesday</font></b></font></div>
    </td>
    <td height="40" width="85"> 
      <div align="center"><font size="-1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Wednesday</font></b></font></div>
    </td>
    <td height="40" width="85"> 
      <div align="center"><font size="-1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Thursday</font></b></font></div>
    </td>
    <td height="40" width="85"> 
      <div align="center"><font size="-1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Friday</font></b></font></div>
    </td>
    <td height="40" width="85"> 
      <div align="center"><font size="-1"><b><font face="Verdana, Arial, Helvetica, sans-serif">Saturday</font></b></font></div>
    </td>
    <td height="40" width="40">&nbsp;</td>
  </tr>
  
  
<?

      // Starting Cell Positions
      $num=0;
      $num1=0;
  
   
       // Go through each row of the calendar
       // and printing time worked
       for ($r=0;$r<$norows;$r++)
       {  
   	
          echo "<tr>";
   	
   	  // Go through each column of the calendar
          for ($c=0;$c<7;$c++)
          {
          	
          	echo "<td height=100 valign=top width=85>";
          	echo "<div align=right><font color=#3366CC><b>$dcell[$num]</b></font></div>";
          	echo "<center><font color=red>";
          	
          	list($cyear,$cmonth,$cday)=explode('-',$cell[$num]);
          	$celldate1=mktime(0,0,0,date("$cmonth"),date("$cday"),date("$cyear"));
          	  
          	if (($celldate1>=$startdate1) and ($celldate1<=$enddate1))  
          	{  
          	        // Printing Hours Worked 
          	        // While printhours, print the hours worked
          	        // it also returns the total hours worked in
          	        // $timeworked[$num], $num being cell number
          	        
          	         $timeworked[$num]=printhours($empid,$cell[$num]);
          	 }
          	 else
          	 {
          	       echo "<center><br><br><img src=\"$siteaddress/images/redcross.gif\"></center>";
          	       $timeworked[$num]=0;	
          	 	
          	 }      
          	        
          	  
          	echo "</center>";             
                echo "</td>";                               

                // next cell position                  
                $num=$num+1;
          }
          
          

        
          echo "<td>&nbsp;</td>";
          
        echo "</tr>";  
        
        echo "<tr valign=middle bgcolor=\"#E9EDFE\">";
        
        
        for ($c=0;$c<7;$c++)
        {
          	

          	 echo "<td height=30>";
          	 echo "<div align=center><b><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"-1\">$timeworked[$num1]</font></b></div>";
                 echo "</td>";
          	
                 $num1=$num1+1;
          }
          
          
          
          for ($i=0;$i<7;$i++)
          {
          	
          	$rowtotal[$r]=$rowtotal[$r]+$timeworked[$i+(7*$r)];
          
          }
        
          $rt=substr($rowtotal[$r],0,4);    
          $bigtotal=$bigtotal+$rt;
                    
          echo "<td><b><center><font color=blue>$rt</font></td>";
          
        echo "</tr>";  
        
        
        
        
        
        
    } 

?>
<tr> 
    <td height="30" colspan="7">
      <div align="right"><b>Total Hours for the period <? echo $startdate; ?> to <? echo $enddate; ?>
        :</b></div>
    </td>
    <td width="20" height="30">
      <div align="center"><b><font color="#990033" size="+1"><? echo $bigtotal; ?></font></b></div>
    </td>
  </tr>


</table>




<? include("footer.php"); ?>