<?Php
    include("myclass/CheckLogin.class.php");
       include("form/forms.php");
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
               //echo "hi";
       $login=new CheckLogin();
       
     //  echo $login->Process();
       if($login->Process())        
       {
       //header("location: view_alert.php");
       if($_SESSION['designation']=='6'){ 
       header("location: view_alert.php");  }
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
</div>

</center>
<?php        }
       
?>