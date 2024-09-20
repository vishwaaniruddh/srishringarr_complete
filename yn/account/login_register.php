<? session_start(); ?>

<style>
 

#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: #000;
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 0;
display: none;
}
.cnt a{
text-decoration: none;
}
.popup1{
width: 100%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
}
.cnt{

width: 500px;
height: 300px;
min-height: 150px;
padding: 0px;
margin: 0px auto;
background: #FFFFFF;
position: relative;
z-index: 103;

border-radius: 5px;
box-shadow: 0 2px 5px #000;
}
.cnt p{
clear: both;
color: #555555;
text-align: justify;
}
.cnt p a{
color: #d91900;
font-weight: bold;
}
.cnt .x{
float: right;

top: -25px;
width: 34px;
}
.cnt .x:hover{
cursor: pointer;
}

.myButton {
	-moz-box-shadow:inset 0px 2px 0px 0px #cf866c;
	-webkit-box-shadow:inset 0px 2px 0px 0px #cf866c;
	box-shadow:inset 0px 2px 0px 0px #cf866c;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #d0451b), color-stop(1, #ed3713));
	background:-moz-linear-gradient(top, #d0451b 5%, #ed3713 100%);
	background:-webkit-linear-gradient(top, #d0451b 5%, #ed3713 100%);
	background:-o-linear-gradient(top, #d0451b 5%, #ed3713 100%);
	background:-ms-linear-gradient(top, #d0451b 5%, #ed3713 100%);
	background:linear-gradient(to bottom, #d0451b 5%, #ed3713 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#d0451b', endColorstr='#ed3713',GradientType=0);
	background-color:#d0451b;
	-moz-border-radius:26px;
	-webkit-border-radius:26px;
	border-radius:26px;
	border:2px solid #942911;
	display:inline;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:23px;
	padding:9px 32px;
	text-decoration:none;
	text-shadow:0px 1px 0px #854629;
}

.cnt{
    position:absolute;
    top:20%;
    left:-20%;
}

.cnt2{
height: 50px;
background: #00a0e4;
color: #fff;
padding:9px 32px;
position: relative;
z-index: 103;
}
.top_bg{
    overflow:hidden;
}


.popup{
width: 100%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
}

</style>




 <div class="card">
<div class="card-block">
    
 
 
 
 
<div class="row" id="customer_login">

	<div class="col-md-6">


		<h2>Login</h2>

<form action="logincode.php" method="post">
  
  <div class="row">
      <div class="col-sm-12">
            <label>Email address</label>
            <input type="email" name="usernm" class="form-control" placeholder="Enter email">
      </div>
      <div class="col-sm-12">
            <label for="Email">Password</label>
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Enter Password">
      </div>
      <div class="col-sm-12">
        <p><a class="forget_password" href="forget_password.php" style="color:#227504 !important;">Lost your password</a></p>
          <button type="submit" class="btn btn-primary">Submit</button> 
          <br><br>
      </div>
  </div>     
      
</form>
		
	</div>

	<div class="col-md-6">

		<h2>Register</h2>



			 <!-- Form -->
				<form id="registration_form"  action="/process_reg.php" method="post" >
					<div>
				
				<div class="row">
    				<div class="col-sm-12">
    				<label for="username">First Name&nbsp;<span class="required">*</span></label>
    				
    				<input class="form-control" placeholder="first name:" type="text" name="fname" id="fname" required autofocus>
    				</p>    
				</div>	    
				
				
				<div class="col-sm-12">
    					
    				<label for="username">Last Name&nbsp;<span class="required">*</span></label>
    				
    					<input class="form-control" placeholder="last name:" type="text" name="lname" id="lname" required autofocus>
    				</p>				    
				</div>


                <div class="col-sm-12">
				
				<label for="username">Email&nbsp;<span class="required">*</span></label>
				
					<input class="form-control" placeholder="email address:" name="emailid" id="emailid" type="email" tabindex="3" required>
				                    
                </div>
				
				

				
				
				
				<div class="col-sm-12">
                        <label for="username">Mobile&nbsp;<span class="required">*</span></label>
                        
                        <input class="form-control" placeholder="Mobile:" type="text" name="mob" id="mob" tabindex="3" required>
                </div>



<div class="col-sm-12">
    <p>Gender</p>
		    <label class="radio left">
		        <input class="radio " type="radio" name="radio" value="Male" id="rd1" checked=""><i></i>Male</label>
		        
		    <label >
		        <input type="radio" class="radio " name="radio" id="rd2" value="Female"><i></i>Female</label>
						        						    
						        						    
</div>

			
			<div class="col-sm-12">
				<label for="username">Password&nbsp;<span class="required">*</span></label>
				
					<input class="form-control" placeholder="password" type="password" name="passwd" id="passwd" tabindex="4" required>
				</div>
				
				<div class="col-sm-12">
				<label for="username">Retype Password&nbsp;<span class="required">*</span></label>
				
				<input class="form-control" placeholder="retype password" type="password" id="rpass" tabindex="4" required>
				</div>
				
				
				
				<div class="col-sm-12">
    			    <br>
    				<input type="submit" class="btn btn-success" value="create an account" id="register-submit" >				    
				</div>
            </div>
				
		</form>
				<!-- /Form -->

         
         
         
         
         
         
         
         
         
         
         
         

	</div>

</div>


</div>     
</div>
 
 
