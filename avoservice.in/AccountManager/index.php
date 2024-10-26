<?Php
/*session_start();
       
       if(!$_SESSION['user'] && !$_SESSION['branch'] && !$_SESSION['designation'])
       {*/
               include("myclass/CheckLogin.class.php");
       include("form/forms.php");
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
               //echo "hi";
       $login=new CheckLogin();
       //echo $login->Process();
       if($login->Process())        
       {
      //echo $_SESSION['designation'];
      // header("location: view_alert.php");
       if($_SESSION['designation']=='2'){ header("location: view_callalert.php");  }
	 // else if($_SESSION['designation']=='4'){ header("location: eng_alert.php");  }
	   else if($_SESSION['designation']=='5'){ header("location:http://avoservice.in/AccountManager/accmanager.php");  }
	   //elseif($_SESSION['designation']=='1'){ header("location: view_alert.php");  }
	  // elseif($_SESSION['designation']=='3'){ header("location: view_alert.php");  }
       else header("location: index.php"); 
       }
       else
       {
               ?>
               <link href="../style.css" rel="stylesheet" type="text/css" />
        <center>
<h2>Please Login to Continue..</h2>
<div id="header">
       <?php
               $login->ShowErrors();
LoginForm();
?>
</div></center>
<?php
       }
       }
       else
       {
?>
        <center>
<h2>Please Login to Continue..</h2>
<div id="header">
       <?php
LoginForm();
?>
</div></center>
<?php        }
       /*}
       else
       {
               if($_SESSION['designation']=="Engineer") { header("location: eng_alert.php"); }
else if($_SESSION['designation']=="call_centre") { header("location: view_callalert.php"); }
else{ header("location: view_alert.php"); }
       }*/
?>