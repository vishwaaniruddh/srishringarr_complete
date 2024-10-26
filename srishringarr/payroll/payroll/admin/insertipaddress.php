<?


   include("header.php"); 
   include("$absolutepath/$dbfile");
   include("functions.php");

?>

<?
    // FILE DOCUMENTATION
    // Filename    : insertproject.php
    // Description : This file inserts a new project in project table
    //   
    // License : GPL
    // Date    : 11/04/2001
    // Related Files : enternewproject.php
    
?>


<?

// If no project title is supplied, print error
if (($ip1=="") or ($ip2=="") or ($ip3=="") or ($ip4==""))
{

      echo "<ul>";
       	     
      echo "<h3>Error - All 4 IP blocks need to filled. For Wildcards, put a *</h3>";
  
      echo $back;
              
      echo "</ul>";	

} 
// if everything filled, then insert ip address
else
{
	
       $ipadd=$ip1.".".$ip2.".".$ip3.".".$ip4;
 

       // Query to insert a new project
       $queryproj = "INSERT INTO iptable (ipid, type, linkid, ipaddress, note) VALUES (null, '$itype', '$linkid', '$ipadd', '$note') ";
       $resultdept = MYSQL_QUERY($queryproj) or die("SQL Error Occured : ".mysql_error().':'.$queryproj);

   if ($itype=="d")
   {

       // getting Department Name
       $name=genericget($linkid,'deptid','deptname','department'); 
       
   }
   else
   {
   
      $name=getempname($linkid);	
   	
   }
              
?>


<table border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td height="35"> 
      <div align="right">Rules for whom :</div>
    </td>
    <td><b><font color=red><? echo $name; ?></b></td>
  </tr>
  <tr> 
    <td height="35"> 
      <div align="right">Accesible IP Address :</div>
    </td>
    <td><b><font color=red><? echo $ipadd; ?></b></td>
  </tr>
  <tr> 
    <td height="35"> 
      <div align="right">IP Description :</div>
    </td>
    <td><b><font color=red><? echo $note; ?></b></td>
  </tr>
</table>



<h2>IP Address (<? echo $ipadd; ?>) has been Inserted</h2>

<b><a href="index.php">Go back to Main Admin Page</a></b><br>


<?
 
}  // end of else if ip != ""

?>


<? include("footer.php"); ?>