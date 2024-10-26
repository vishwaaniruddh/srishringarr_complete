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

      // Query to get department info 
       $query = "select * from iptable where ipid='$ipid'";
       $result = MYSQL_QUERY($query) or die("SQL Error Occured : ".mysql_error().':'.$query); 

       // Getting number of rows from Query : 0 = no match != password incorrect
       $number = MYSQL_NUMROWS($result); 
	
       if ($number==0 ) 
       { 
            
          echo "<h3>No Such IP Access Rule </h3>"; 
       }
       else if ($number>0)
       {
           
           $ipid=mysql_result($result,0,"ipid");
           $type=mysql_result($result,0,"type");
           $linkid=mysql_result($result,0,"linkid");
           $ipaddress=mysql_result($result,0,"ipaddress");
           $note=mysql_result($result,0,"note");
           
           list ($ip1,$ip2,$ip3,$ip4) = explode('.',$ipaddress);
          
           if ($type=="d")
           {
                      $name=genericget($linkid,'deptid','deptname','department');  
                      
                      $name="Department of $name";
           }
           else
           {
           	      $name=getempname($linkid);
           	      
           	      $name="Employee $empname";
           	
           }
 

?>

<table width="100%" border="0">
  <tr> 
    <td> 
      <p><b>Edit IP Address Access Rule for <? echo $name; ?></b></p>
      <blockquote>
        <p>Please choose the IP address you want for <? echo $name; ?> to be able to access the system from.</p>
      </blockquote>
      <form method="post" action="updateipaddress.php">
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
                <input name=ip1 size="5" value="<? echo $ip1; ?>">
                . 
                <input name=ip2 size="5" value="<? echo $ip2; ?>">
                . 
                <input name=ip3 size="5" value="<? echo $ip3; ?>">
                . 
                <input name=ip4 size="5" value="<? echo $ip4; ?>">
                <br>
                (e.g 130.74.96.*)</p>
              <p>Note that wildcards can be used. e.g * means all the whole range 
                of numbers from 1-255 of an IP address</p>
            </td>
          </tr>
    <tr> 
      <td height="35" valign="top"><div align="right"><b>IP Description :</b></div></td>
      <td valign="top"> 
        <textarea name="note" cols="35" rows="5" wrap="VIRTUAL"><? echo $note; ?></textarea><? echo $star; ?>
      </td>
    </tr>          
          
          

        </table>
        <p> 
          <input type="hidden" name=ipid value="<? echo $ipid; ?>">           
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

   } // end else if number > 0

?>


<? include("footer.php"); ?>
