<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : composeemail.php
    // Description : This file lets logged in user compose an email
    //               and then send it to $scriptname to be processed
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : resultssearch.php
    
?>
<?
if ((!isset($scriptname)) or (!isset($towhom)))
{
              echo "<ul>";
       	     
              echo "<h3>Sorry some variables are not set correctly. This Script cannot proceed</h3>";
  
              echo $back;
              
              echo "</ul>";
}
else
{
	
   if ($scriptname=="emailmanager.php")
   {   
	                      
       $managerid=genericget($session[deptid],'deptid','managerid','department');
       
           
                     if (($managerid=="0") or ($managerid==""))
                     {
                             
                             $managererror=1;
                     }
                     else
                     {
                     	
                     	$managername=getempname($managerid); 
                     	
                     	echo "<h3>Your Manager is $managername</h3>";
                     	
                     	$managererror=0;
                     
                     }
                     

  
    }

    if ($managererror==1)
    {
          echo "<ul>";
       	     
          echo "<h3>Your Department does not have a manager yet. Please contact an administror to add a manager to this department</h3>";
  
          echo $back;
              
          echo "</ul>";    	
    }
    else
    {
     

?>


<h3>Send Email to <? echo $towhom; ?></h3>

<form method="post" action="<? echo $scriptname; ?>">
  <table width="640" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td bgcolor="#F4F4F4"> 
        <div align="right">From :</div>
      </td>
      <td bgcolor="#F4F4F4" height="30"><font color="#000066"><b><? echo "$session[lastname] $session[firstname]"; ?></b></font></td>
      <td rowspan="6" width="185" valign="middle"> 
        <div align="center"><img src="<? echo $siteaddress; ?>/images/emailat.jpg" alt="" width="135" height="217"> 
        </div>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#F4F4F4"> 
        <div align="right">Email :</div>
      </td>
      <td bgcolor="#F4F4F4" height="30"><font color="#000066"><b><? echo $session[email]; ?></b></font></td>
    </tr>
    <tr> 
      <td bgcolor="#F4F4F4"> 
        <div align="right">To :</div>
      </td>
      <td bgcolor="#F4F4F4" height="30"><font color="#000066"><b><? echo $towhom; ?></b></font></td>
    </tr>
    <tr>
      <td bgcolor="#F4F4F4">
        <div align="right">Subject :</div>
      </td>
      <td bgcolor="#F4F4F4" height="30" valign="middle"> 
        <input type="text" name="subject" size="40">
      </td>
    </tr>
     <tr> 
      <td> 
        <div align="right">Message :</div>
      </td>
      <td> 
        <textarea name="emailbody" cols="50" rows="10" wrap="VIRTUAL"></textarea>
      </td>
    </tr>
    <tr> 
      <td colspan="2" rowspan="2"> 
      <br>
   
        <input type=hidden name=managerid value="<? echo $managerid; ?>">
        <input type=hidden name=managername value="<? echo $managername; ?>">
        <input type="submit" name="Submit" value="Send Email to <? echo $towhom; ?>">
      </td>
    </tr>
    <tr> </tr>
  </table>
  <p>&nbsp;</p>
</form>

<?
       } //end of else managerid==0

    } // else of !isset


?>


<? include("footer.php"); ?>