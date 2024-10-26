<?php //echo "hello";die;
       include("myclass/CheckLogin.class.php");
       include("form/forms.php");
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
               //echo "hi";
       $login=new CheckLogin();
       
       if($login->Process())   
  
   
       {
	  	if($_SESSION['designation']=='2'){ header("location: view_alert.php");  }
	  
	   else if($_SESSION['designation']=='4'){ header("location: engg_site_details.php");  } 
	   
	   else if($_SESSION['designation']=='5'){ header("location:http://avoservice.in/AccountManager/accmanager.php");  }
	   	elseif($_SESSION['designation']=='1'){ header("location: view_alert.php");  }
	   	elseif($_SESSION['designation']=='1' && $_SESSION['logid']=='2493' ){ header("location: view_alert.php");  }
	   	elseif($_SESSION['designation']=='3'){ header("location: view_alert.php");  }
	   	else if($_SESSION['designation']=='6' && $_SESSION['logid']=='2908'){ header("location:http://avoservice.in/capital_soft/view_alert.php");  }
	   	else if($_SESSION['designation']=='6' && $_SESSION['logid']=='2935'){ header("location:http://avoservice.in/rc_alltech/view_alert.php");  }
	   	
	   	else if($_SESSION['designation']=='6'){ header("location:http://avoservice.in/ClientPanel/view_alert.php");  }
	 else if($_SESSION['designation']=='7'){ header("location: sales_ordernew.php");  }
	  else if($_SESSION['designation']=='8'){ header("location: view_entries.php");  }
       	else header("location: index.php"); 
       }
       else
       {
               ?>
               <link href="style.css" rel="stylesheet" type="text/css" />
        <center>
             <img src="AVO LOGO-new.jpg"/>
            
<h2>Please Login to Continue..</h2>
<div id="header">
       <?php
               $login->ShowErrors();
LoginForm();
?>
</div>


        <h5> Terms of Use: <h5>You must not disclose your Login Information to any person or otherwise allow any person to access the Portal using your Login Information.<br>
        &nbsp;&nbsp;Any mis-use of data or any false entries which is not relevant or any unethical entries etc if found through your login credentials,<br> you are bound to accept the same and will lead to disciplinary actions as per law.<br>
        We reserve the right to terminate your access to this Portal if you breach the terms of Use.<br> @ 2019 AVO | Copyright is reserved</h5>
    
    
     

</center>
<?php
       }
       }
       else
       {
?>
        <center>
<h2>Welcome to Switching AVO Portal</h2>
  <img src="AvologoFinals.jpg"/>

<h3>Please Login to Continue..</h3>
<div id="header">
       <?php
LoginForm();
?>
</div>

 <h5>Terms of Use: You must not disclose your Login Information to any person or otherwise allow any person to access the Portal using your Login Information. <br>
 &nbsp;&nbsp;Any mis-use of data or any false entries which is not relevant or any unethical entries etc if found through your login credentials,<br> you are bound to accept the same and will lead to disciplinary actions as per law.<br>
 We reserve the right to terminate your access to this Portal if you breach the terms of Use.<br> @ 2019 AVO | Copyright is reserved</h5>

</center>
<?php        }
       /*}
       else
       {
               if($_SESSION['designation']=="Engineer") { header("location: eng_alert.php"); }
else if($_SESSION['designation']=="call_centre") { header("location: view_callalert.php"); }
else{ header("location: view_alert.php"); }
       }*/
?>