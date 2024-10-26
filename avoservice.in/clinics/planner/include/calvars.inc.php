<?php
session_start();

//if(!isset($_SESSION['ADMIN']))
  // $_SESSION['ADMIN'] = 0;
//*********************************************/
// COnfigure these for your database connection
//*********************************************/
$host = "localhost";            // 'localhost' or 'www.yoursiteurl.com' if on a remote site
$user = "satyavan_clinics";           // username
$pwd = "doctor123*";               // password
$db = "clinic";               // the name of your database
//$events_table = "sched";        // the name of your events table (the default is "sched")
//$locations_table = "resources"; // the name of your locations table (the default is "resources")
//$admin_table = "admin";         // the name of the table to store admin users

//******************/
// GLOBAL VARIABLES
//******************/
//   date/time standards for phpplanner
//   these are the date/time formats that phpplanner will display
//   0 - ISO International standard  (yyyy-mm-dd)
//   1 - American Style  (mm/dd/yyyy)
$date_standard = 1;
//   time standard
//   0 - ISO Standard 24 hour time
//   1 - 12 hour time
$time_standard = 0;
//  How is the week organised in your area
//  0 - monday is considered the first day of the week
//  1 - sunday is considered the first day of the week
$week_standard = 1;
//   set this variable if the host of your site is in a different timezone than you
//   For example: I live in the Eastern Standard Timezone, but my host is in a different
//                timezone, which is 5 hours ahead of mine.
//                The only effect of setting this incorrectly is that sometimes the current
//                day will be highlighted incorrectly.
//                (i.e. it's Jan 1st 11:00 pm where you are, but your host time is Jan 2nd 4:00 am)
//
// Set this to the timezone you live in. For example: I live in the EST Eastern Timezone,
// but my host is in a different timezone that is 5 hours ahead of mine.
// Use the 3 letter abbreviation ONLY for timezones, do NOT use numerical offsets.
// Timezone abbreviations can be found at: http://www.gnu.org/manual/tar-1.12/html_chapter/tar_7.html
$TZONE = "GMT";
$HOFFSET = "+1";

//*******************/
//  OTHER VARIABLES
//*******************/
//These variables are used in 'viewmonth.php'
$rowht1 = "15px";                 //row height for the day titles i.e 'Sun' 'Mon' etc.
$rowht2 = "15px";                  // row height for the calendar days (where the data goes)
$cellbg = "white";         // the cell background for each day
$curcellbg = "1E90FF";  // the cell background for the current day
$wkendbg = "orange";    // cell background for the weekend days (Sat and Sun)
$wkbg = "F5DEB3";        // cell background for the weekdays (Mon-Fri)
$tb_border = 0;                // table border
$tb_cellspacing = 1;        // table cellspacing

//*********************/
// FUNCTIONS
//*********************/
function future_date( $start_stamp, $incrementer, $value  )
{
   list($y,$m,$d) = explode("-",strftime("%Y-%m-%d",$start_stamp));
   switch($incrementer)
   {
       case "d":
            $stamp = strtotime("+1 day",$start_stamp);
            break;
       case "w":
            $stamp = strtotime("+1 week",$start_stamp);
            break;
       case "m":
            $stamp = strtotime("+1 month",$start_stamp);
            break;
       case "y":
            $stamp = strtotime("+1 year",$start_stamp);
            break;
   }

   return $stamp;
}

/*
Adjust a date to the specified timezone/hour offset
Dates are passed as a string of the form
'yyyy-mm-dd' or 'mm/dd/yyy'
The timestamp of the fixed date is returned
*/
function fixsdate( $sdate2fix )
{
    GLOBAL $HOFFSET;
    GLOBAL $TZONE;
    $todaystring = $sdate2fix;//." ".$TZONE;
    $todaystamp = strtotime($todaystring);
    $string = strftime("%Y-%m-%d %H:%M",$todaystamp);
    //print "(CAL) today = $string<BR>";
    $offset = $HOFFSET." hours";
    //$offset = "-1 hour";
    $newstamp = strtotime($offset,$todaystamp);
    $newstring = strftime("%Y-%m-%d %H:%M",$newstamp);
    //print "(CAL) newstring = $newstring<BR>";

    return $newstamp;
}

/* Returns the current time adjusted for timezone/offset */
function getcurtime()
{
    GLOBAL $HOFFSET,$time_standard;
    if($time_standard == 0)
       $format = "%H:%M";
    else if($time_standard == 1)
       $format = "%I:%M %p";
    $offset = $HOFFSET." hours";
    $systime = strftime($format,strtotime($offset,time()));

    return $systime;
}
?>