<?php
session_start();
if(isset($_SESSION['SESS_USER_NAME']))
{

//include("../template.html");
require("include/calvars.inc.php");
include("config.php");
//include("config1.php");
//print "ADMIN = $ADMIN";
?>

<SCRIPT SRC="include/functions.js"></SCRIPT>
<link rel="stylesheet" href="styles/calstyles.css" type="text/css">
<?php 
$today = getdate();
$y2 = $today['year'];
$m2 = $today['mon'];
$d2 = $today['mday'];
$hour = $today['hours'];
$min = $today['minutes'];
//print "time = $hour:$min<BR>";

$todaystring = $y2."-".$m2."-".$d2." ".$hour.":".$min;
//print "today = $todaystring<BR>";
 $todaystamp = fixsdate( $todaystring );
//print "todaystamp = $todaystamp<BR>";
$systime = getcurtime();
//print "systime = $systime";

if(!isset($_GET['noinc']))
{
 $_GET['timestamp'] = $todaystamp;
}

$m = strftime("%m",$_GET['timestamp']);
$y = strftime("%Y",$_GET['timestamp']);
$monthname = strftime("%B",$_GET['timestamp']);
$startcol = date("w",mktime(1,1,1,$m,1,$y));

if($week_standard == 0) { //if week starts on monday
   if ($startcol == 0) { //sunday
       $startcol+=6;
   }
   else { //all other days
       $startcol--;
   }
}

$daysinmonth = date("t",mktime(1,1,1,$m,1,$y));

$nextstamp = strtotime("+1 month",$_GET['timestamp']);
$prevstamp = strtotime("-1 month",$_GET['timestamp']);
$stamp2 = $_GET['timestamp'];
//print "m = $m, y = $y<BR>";
?>

<!--<p align="center"><B><FONT FACE="Verdana" SIZE=4 COLOR=maroon>PHP Planner v11c</FONT></B><BR>
  <FONT FACE="Verdana" SIZE=1>
  <?php 
if($time_standard == 0)
   print "(24hr format)";
else if($time_standard == 1)
   print "(12hr format)";
?>
  </FONT><BR>
<CENTER><SCRIPT SRC="include/liveclock.js"></SCRIPT></CENTER>-->
<table border="0" align="center" style="background:#CCCCCC" width="450px">
  <tr align="center" valign="middle">
    <td align="right"><a href="View_app.php?timestamp=<?php echo $prevstamp?>&noinc=0" onMouseOver="window.status='Previous Month';return true" onMouseOut="window.status='';return true"><img src="planner/images/prevbtn1.gif" border=0 height=30></a></td>
    <td><FONT FACE="Verdana" SIZE=3 COLOR=black><B>
      <?php print "$monthname $y";?></B></FONT></td>
    <td align="left"><a href="View_app.php?timestamp=<?php echo $nextstamp?>&noinc=0" onMouseOver="window.status='Next Month';return true" onMouseOut="window.status='';return true"><img src="planner/images/nextbtn1.gif" border=0 height=30 width=30></a></td>
	<td align="left"><a href="View_app.php?timestamp=<?php echo mktime(); ?>&noinc=0" onMouseOver="window.status='Next Month';return true" onMouseOut="window.status='';return true">Current Month</a></td>
  </tr>
</table>
<table border=0 cellpadding=10 align=center>
<TR>
    <TD><!--<a href="#" onClick="popup('add.php', 'mywin1', 450, 425)" onMouseOver="window.status='Add Event To Planner';return true" onMouseOut="window.status='';return true"><img src="images/addbtn1.gif" border="0"></a>&nbsp;&nbsp;
    <a href="#" onClick="popup('findme.php', 'rightnowwin', 600, 150)" onMouseOver="window.status='See what I have scheduled right now';return true" onMouseOut="window.status='';return true"><img src="images/findbtn1.gif" border="0"></a>--></TD>
</TR>
</TABLE>
<table border=<?php echo $tb_border?> cellspacing=<?php echo $tb_cellspacing?> bordercolor="black" align="center" style="background:#CCCCCC" width="450px">
<tr class="daytitle">

<?php  if ($week_standard == 1) { ?>
   <td align="center" height="<?php echo $rowht1; ?>" width="14%" class="daytitle" bgcolor=<?php echo $wkendbg?>>Sun</td>
<?php  } ?>
   <td align="center" height="<?php echo $rowht1; ?>" width="14%" class="daytitle" bgcolor=<?php echo $wkbg?>>Mon</td>
   <td align="center" height="<?php echo $rowht1?>" width="14%" class="daytitle" bgcolor=<?php echo $wkbg?>>Tue</td>
   <td align="center" height="<?php echo $rowht1?>" width="14%" class="daytitle" bgcolor=<?php echo $wkbg?>>Wed</td>
   <td align="center" height="<?php echo $rowht1?>" width="14%" class="daytitle" bgcolor=<?php echo $wkbg?>>Thu</td>
   <td align="center" height="<?php echo $rowht1?>" width="14%" class="daytitle" bgcolor=<?php echo $wkbg?>>Fri</td>
   <td align="center" height="<?php echo $rowht1?>" width="14%" class="daytitle" bgcolor=<?php echo $wkendbg?>>Sat</td>
<?php  if ($week_standard == 0) { ?>
   <td align="center" height="<?php echo $rowht1?>" width="14%" class="daytitle" bgcolor=<?php echo $wkendbg?>>Sun</td>
<?php  } ?>
</tr>
<?php 
$d = 1;
$i = 0;

//start first row
print "<tr align=left valign=top bgcolor=$cellbg>";
//increment through the days before the start of the month
while($i < $startcol)
{
    print "<TD>&nbsp;</TD>";
    $i++;
}
//step through day 1 to day n
//make the timstamp for day 1 of the month/year
$daystring = $y."-".$m."-01";//.$TZONE;
$daystamp = strtotime($daystring);

$lowday = mktime(0,0,0,$m,1,$y);
$highday = mktime(23,59,59,$m,1,$y);
//print "low = $lowday<BR>high = $highday<BR>";
//$test = strftime("%Y-%m-%d %H:%M",$daystamp);
//print "daystamp = $daystamp<BR>";
//print "test = $test<BR>";
//$daystamp = mktime ($hour,0,0,$m,1,$y);
while($d <= $daysinmonth)
{
    /*$string1 = strftime("%Y-%m-%d",$daystamp);
    $string2 = strftime("%Y-%m-%d",$timestamp);
    $string3 = strftime("%Y-%m-%d",$todaystamp);
    print "day = $string1<BR>time = $string2<BR>today = $string3<BR><BR>";
    */
    if($i > 6)
    {
        //start new row
        print "</TR><tr align=left valign=top bgcolor=$cellbg>";
        $i = 0;
    }
    //print day
    /* THIS CHUNK DISPLAYS THE EVENTS ON EACH DAY FOR EACH DAY */
         //$conn2=mysql_connect($host,$user,$pwd);
         //mysql_select_db($db,$conn2);
		//echo "SELECT * FROM appoint WHERE `app_date` in ('".date('Y-m-d',$lowday)."')";
         $sql2="SELECT * FROM appoint WHERE `app_date` in ('".date('Y-m-d',$lowday)."')";
        // $sql2=$sql2." ORDER BY stimestamp";
         $result2=mysql_query($sql2);
		 if(!$result2)
		 echo "failed".mysql_error();
		 
		
		// echo mysql_num_rows($result2);
		//echo date('Y-m-d',$todaystamp)." ".date('Y-m-d',$lowday)."<br>";
         if (mysql_num_rows($result2)>0)
         {
		
         ?>
        <td bgcolor="<?php
		//echo $cellbg;
		
		 if((date('Y-m-d',$todaystamp) > date('Y-m-d',$lowday)) && (date('Y-m-d',$todaystamp) < date('Y-m-d',$highday))){echo $curcellbg; } else{ echo $cellbg; }?>" width="14%" class="dayno"><?php //echo date('Y-m-d',$todaystamp)." ".date('Y-m-d',$lowday);
		// echo mysql_num_rows($result2);
		//echo date('Y-m-d',$todaystamp)." ".date('Y-m-d',$lowday)." ".date('Y-m-d',$highday)." ".$cellbg."<br>";
		 ?>
       <!-- <A HREF="#" onMouseOver="window.status='Click for popup day schedule';return true" onMouseOut="window.status='';return true" onClick="popup('popday.php?daystamp=<?php echo date('Y-m-d',$daystamp) ?>', 'Win1', 600, 275); return false" class="daylink">-->
		
      <?php echo $d; ?><br><br />
		<!--</A>-->
	<div align="right"><a href="#" onClick="filldate('<?php echo date('d/m/Y',$daystamp); ?>');searchById('Listing','1');"><font color="#990000"><?php echo mysql_num_rows($result2); ?></font></a></div>
        <?php 
           /* while($rs=mysql_fetch_array($result2))
            {
               $thisid = $rs[12];
               $datestamp = $rs[15];
               /*if($date_standard == 0)
                  $date = strftime("%Y-%m-%d",$datestamp);
               else if($date_standard == 1)
                  $date = strftime("%m/%d/%Y",$datestamp);
               */
             /*  $stimestamp = $rs['stimestamp'];
               if($time_standard == 0)
                  $stime = strftime("%H:%M",$stimestamp);
               else if($time_standard == 1)
               {
                   $stime = strftime("%I:%M",$stimestamp);
                   $saorp = strftime("%p",$stimestamp);
                   $saorp = strtolower($saorp);
                   $stime = $stime.$saorp;
               }

               $etimestamp = $rs['etimestamp'];
               if($time_standard == 0)
                  $etime = strftime("%H:%M",$etimestamp);
               else if($time_standard == 1)
               {
                   $etime = strftime("%I:%M",$etimestamp);
                   $eaorp = strftime("%p",$etimestamp);
                   $eaorp = strtolower($eaorp);
                   $etime = $etime.$eaorp;
               }

               $loc = $rs['resource'];
               $desc = $rs['descr'];

            ?>

        <span title="<?php echo "$desc  ($loc)";?>">
        <A HREF="#" onMouseOver="window.status='Click for popup detail';return true" onMouseOut="window.status='';return true" onClick="popup('popdetail.php?loc=<?php echo $loc?>&stime=<?php echo $stime?>&etime=<?php echo $etime?>&desc=<?php echo $desc?>&id=<?php echo $thisid?>&daystamp=<?php echo $daystamp?>', 'Win1', 600, 125); return false" class="eventlink">
        <?php print "$stime-$etime<BR>";?>
        </a></span>
        <?php 
            }*/ // end while
      }// end if(mysql_num_rows($result2)>0)
         /* END DAY EVENTS CHUNK */
      else
      {?>
        <td bgcolor=<?php if(($todaystamp > $lowday) && ($todaystamp < $highday))echo $curcellbg; else echo $cellbg;?> width="14%" class="dayno">&nbsp;<?php echo $d?><BR>
      <?php }
    //print "day = $daystamp";
    print "</TD>";
    $daystamp = strtotime("+1 day",$daystamp);
    $lowday = strtotime("+1 day",$lowday);
    $highday = strtotime("+1 day",$highday);
    $i++;
    $d++;
}// end while($d < $daysinmonth)
?>
</TABLE>
<BR>
<CENTER>
<B>

</B>
</CENTER>
<?php 
//include('../footer.html');
}else
{ 
 header("location: ../index.html");
}
?>