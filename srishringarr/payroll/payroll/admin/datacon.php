<?
      
      /* script to connect fo Mandir Database and pick up neccesary Information to display on screen */

      /* declare some relevant variables */
      $hostname = "localhost";
      $username = "srishrin_payroll";
      $passwordsc = "vertrigo123sar45";
      $dbName = "srishrin_payrolldb";

      /* make connection to database */
      /* If no connection made, display error Message */
          
      MYSQL_CONNECT($hostname, $username, $passwordsc) OR DIE("Unable to connect to database");


      /* Select the database name to be used or else print error message if unsuccessful*/
      @mysql_select_db( "$dbName") or die( "Unable to select database"); 
      
      $noquery=" or die(SQL Error Occured : ".mysql_error().':'.$query.")";
      $noquery1=" or die(SQL Error Occured : ".mysql_error().':'.$query1.")";
      $noquery2=" or die(SQL Error Occured : ".mysql_error().':'.$query2.")"; 
      
      $ipaddress=getenv("remote_addr");     
?>