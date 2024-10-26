<?php session_start();
include('config.php'); ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<body>

 <div class="container" style="width:100%">
	  
	 <div class="registration">
		 <div class="registration_left">
	
			 

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            
                        </div>  
                        <div class="registration_form" style="padding: 20px;">
			 <!-- Form -->
				<form method="post" action="#">
					<div>
					    
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username">First Name&nbsp;<span class="required">*</span></label>
				
				<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="first name:" type="text" name="fname" id="fname" tabindex="1" autofocus="">
				</p>
				
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username">Last Name&nbsp;<span class="required">*</span></label>
				
					<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="last name:" type="text" name="lname" id="lname" tabindex="2" autofocus="">
				</p>
				
				
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username">Email&nbsp;<span class="required">*</span></label>
				
					<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="email address:" name="emailid" id="emailid" type="email" tabindex="3">
				</p>
				
				
				
				
					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username">Mobile&nbsp;<span class="required">*</span></label>
				
					<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Mobile:" type="text" name="mob" id="mob" tabindex="3">
				</p>
				
				
				
				
					</div>
<!--<div>
						<label>
							<input placeholder="Address:" type="text" name="add" id="add" tabindex="2" required autofocus>
						</label>
					</div>		-->		
						<div class="sky_form1">
							<ul>
								<li><label class="radio left"><input type="radio" name="radio" value="Male" id="rd1" checked=""><i></i>Male</label></li>
								<li><label class="radio"><input type="radio" name="radio" id="rd2" value="Female"><i></i>Female</label></li>
								<div class="clearfix"></div>
							</ul>
						</div>					
					<div>
					    
					    	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username">Password&nbsp;<span class="required">*</span></label>
				
					<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="password" type="password" name="passwd" id="passwd" tabindex="4">
				</p>
				
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username">Retype Password&nbsp;<span class="required">*</span></label>
				
					<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="retype password" type="password" id="rpass" tabindex="4">
				</p>
				
					</div>
<div>
						<label>
							We will send You a verification code, please check your email.
						</label>
					</div>	
					<div>
						<input id="create_btn" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success" value="create an account">
					</div>
				
				</form>
				<!-- /Form -->
			 </div>
		 </div>
	
		 <div class="clearfix"></div>
	 </div>
</div>

               
               
                
         </div>










<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class
="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>

        <form action="reg_process.php" method="POST">
        	
        	<input type="text" name="fnamea" id="fnamea" value="" hidden>
        	<input type="text" name="lnamea" id="lnamea" value="" hidden>
        	<input type="text" name="emaila" id="emaila" value="" hidden>
        	<input type="text" name="moba" id="moba" value="" hidden>
        	<input type="text" name="radioa" id="radioa" value="" hidden>
        	<input type="text" name="passworda" id="passworda" value="" hidden>



        	<input type="text" name="otp">
        	<input type="submit" value="verify" class="btn btn-primary">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script>
	
	$('#create_btn').click(function(){
	var fname_element = document.getElementById('fname');
	var lname_element = document.getElementById('lname');
	var email_element = document.getElementById('emailid');
	var mob_element = document.getElementById('mob');
	var radio_element = document.getElementById('radio');
	var password_element = document.getElementById('passwd');



	var fname = document.getElementById('fnamea');
	var fname = fname_element.value;

	var lname = document.getElementById('lnamea');
	var lname = lname_element.value;

	var email = document.getElementById('emaila');
	var email = email_element.value;

	var mob = document.getElementById('moba');
	var mob = mob_element.value;

	var radio = document.getElementById('radioa');
	var radio = radio_element.value;


	var passwd = document.getElementById('passworda');
	var passwd = password_element.value;



	});

</script>

</body>
</html>