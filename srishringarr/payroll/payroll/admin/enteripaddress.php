<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : enteripaddress.php
    // Description : This file gets a deptid and allows user to 
    //               add a new ip address restriction to that department
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : insertipaddress.php
    
?>


<?

// if dept id is not set, print error message
if ($deptid=="")
{
	
	      echo "<ul>";
       	     
              echo "<h3>Error - Dept ID not set</h3>";
  
              echo $back;
              
              echo "</ul>";
	
}
// if deptid is set, proceed
else
{

	
       $deptname=genericget($deptid,'deptid','deptname','department');  


      // Form Enter an IP address Rule for a department     

?>

<table width="100%" border="0">
  <tr> 
    <td> 
      <p><b>Enter IP Address Acess Rule for <? echo $deptname; ?></b></p>
      <blockquote>
        <p>Please choose the IP address you want the department of <? echo $deptname; ?> employees to be able to access the system from.</p>
      </blockquote>
      <form method="post" action="insertipaddress.php">
        <table width="80%" align=center border=0>
          <tr> 
            <td width=200> 
              <div align="right"></div>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td width=200 valign="top"> 
              <div align="right"><b>IP Address Sequence : </b></div>
            </td>
            <td> 
              <p> 
                <input name=ip1 size="5">
                . 
                <input name=ip2 size="5">
                . 
                <input name=ip3 size="5">
                . 
                <input name=ip4 size="5">
                <br>
                (e.g 130.74.96.*)</p>
              <p>Note that wildcards can be used. e.g * means all the whole range 
                of numbers from 1-255 of an IP address</p>
            </td>
          </tr>
    <tr> 
      <td height="35" valign="top"><div align="right"><b>IP Description :</b></div></td>
      <td valign="top"> 
        <textarea name="note" cols="35" rows="5" wrap="VIRTUAL"></textarea><? echo $star; ?>
      </td>
    </tr>          
          
          

        </table>
        <p>
          <input type="hidden" name=itype value="d">   
          <input type="hidden" name=linkid value="<? echo $deptid; ?>">           
          <input type="submit" name="Submit" value="Submit">
          <input type="submit" name="Submit2" value="Reset">
        </p>
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </td>
  </tr>
</table>

<?

   } // end else if !isset deptid


?>


<? include("footer.php"); ?>
