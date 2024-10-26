<?php
include("access.php");
include('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
		<script>
			$(document).ready(function() {
				$('.nav-toggle').click(function(){
					//get collapse content selector
					var collapse_content_selector = $(this).attr('href');					
					
					//make the collapse content to be shown or hide
					var toggle_switch = $(this);
					$(collapse_content_selector).toggle(function(){
						if($(this).css('display')=='none'){
							toggle_switch.html('Add New Assets');//change the button label to be 'Show'
						}else{
							toggle_switch.html('Add New Assets');//change the button label to be 'Hide'
						}
					});
				});
				
			});	
		</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>

<h2>New Assets</h2>

<div id="header">

<?php
  
       include("form/Assets_form.php");
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
               //echo "hi";
			   include("myclass/assets.class.php");
      $service=new Service();
       if($service->Process())        
       {
       
  //header('location:service.php');
   // echo "Data added successfully<br><br><a href='service.php'>New Service</a>";
   ?>
   <script type="text/javascript">
   alert("Products added / created successfully");
   window.location="NewAssets.php";
   </script>
   <?php
       }
       else
       {
            ?>
            <div class="errors">
            <?php
            $service->ShowErrors();
			
			
ServiceForm();

       }
       }
       else
       {
		ServiceForm();   
 } ?>
</div>
</center>
</body>
</html>