<?php
include("datacon.php");
if(isset($_POST['done']))
{
 if(isset($_POST['hdate']) && $_POST['hdate']!=''){
    // echo $_POST['hdate'];
 if(isset($_POST['htype']))
    // echo $_POST['htype'];
 if(isset($_POST['hname']) && $_POST['hname']!=''){
    // echo $_POST['hname'];
   // echo "insert into holiday(hdate,hcode,hname) values(STR_TO_DATE('".$_POST['hdate']."','%d/%m/%Y'),'".$_POST['htype']."','".$_POST['hname']."')";
    $result=mysql_query("insert into holiday(hdate,hcode,hname) values(STR_TO_DATE('".$_POST['hdate']."','%d/%m/%Y'),'".$_POST['htype']."','".$_POST['hname']."')");
    if($result)
     echo "Holiday added Successfully";
    else
     echo "Some Error Occured Please try again";
     }
     else echo "Please Enter Holiday Name";
   }
   else echo "Please Enter Date";

}
?>
<center><br><br>
<h3> ADD HOLIDAY </h3><br><br>
<form action='addHoliday.php' method='post'>
<table>
<tr height='50'><td>DATE (dd/mm/yyyy):</td><td> <input type='text' name='hdate' id='hdate' /></td></tr>
<tr height='50'><td>TYPE OF HOLIDAY  :</td><td> <select name='htype' id='htype' ><option value='wo' >Weekly Off</option><option value='ho' >Holiday</option></select></td></tr>
<tr height='50'><td>NAME OF HOLIDAY  :</td><td> <input type='text' name='hname' id='hname' /></td></tr>
<tr height='50'><td colspan='2' align='center'>     <input type='submit' name='done' id='done' /></td></tr>
</table>
</form>
</center>