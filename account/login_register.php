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



/* Choose all input elements that have the attribute: type="radio" and make them disappear.*/
input[type="radio"] {
  display:none;
}

/* The label is what's left to style. 
As long as its 'for' attribute matches the input's 'id', it will maintain the function of a radio button. */
label.radio {
  padding: 0.5em;
  display: inline-block;
  border: 1px solid grey;
  cursor: pointer;
}

.blank-label {
  display: none;
}

/* The '+' is the adjacent sibling selector.
It selects what ever element comes right after it,
as long as it is a sibling. */
input[type="radio"]:checked + label {
  background: grey;
  color: #fff;
}





</style>




 <div class="card" style="    padding: 5%;">
<div class="card-block">
    
 
 
 
 
<div class="row" id="customer_login">

	<div class="col-md-6">


		<h2>Login</h2>




<? 

if($_SERVER['USER'] == 'srishringarr'){
    $referer = $_SERVER['HTTP_REFERER'];
    $_SESSION['referer']= $referer;
}else{
    $referer = 'my-account.php';
    
}





 ?>






<form autocomplete="off" action="./logincode.php" method="post">
  <input type="hidden" name="referer" value="<? echo $referer; ?>">
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


<hr />

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<hr />
<!--
<a class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" href="https://arpeeindustries.in/phpSocialAuth/index.php?session=destroy">
    <i class="fab fa-google me-2"></i> Sign in with google
    </a>  -->
    
    <a class="btn btn-lg btn-block btn-primary" style="background-color: #dd4b39;" href="https://srishringarr.com/googleLogin/login.php">
    <i class="fab fa-google me-2"></i> Sign in with google
    </a>

	</div>

	<div class="col-md-6">

		<h2>Register</h2>



			 <!-- Form -->
				<form id="registration_form"  action="verify_otp.php" method="post" >
					<div>
				
				<div class="row">
    				<div class="col-sm-12">
    				<label for="username">First Name&nbsp;<span class="required">*</span></label>
    				
    				<input class="form-control" placeholder="First Name:" type="text" name="fname" id="fname" required autofocus>
    				</p>    
				</div>	    
				
				
				<div class="col-sm-12">
    					
    				<label for="username">Last Name&nbsp;<span class="required">*</span></label>
    				
    					<input class="form-control" placeholder="Last Name:" type="text" name="lname" id="lname" required autofocus>
    				</p>				    
				</div>


                <div class="col-sm-12">
				
				<label for="username">Email&nbsp;<span class="required">*</span></label>
				
					<input class="form-control" placeholder="Email Address:" name="emailid" id="emailid" type="email" tabindex="3" required>
				                    
                </div>
				
				

				
				
				
				<div class="col-sm-12">
                        <label for="username">Mobile&nbsp;<span class="required">*</span></label>
                        
                        <input class="form-control" placeholder="Mobile:" type="text" name="mob" id="mob" tabindex="3" required>
                </div>



<div class="col-sm-12">
    <p>Gender</p>
    
        <input type="radio" id="male" name="gender" value="Male" />
        <label class="radio"  for="male">Male</label>
        
        <input type="radio" id="female" name="gender" value="Female" />
        <label class="radio"  for="female">Female</label>
</div>

			
			<div class="col-sm-12">
				<label for="username">Password&nbsp;<span class="required">*</span></label>
				
					<input class="form-control" placeholder="Password" type="password" name="passwd" id="passwd" tabindex="4" required>
				</div>
				
				<div class="col-sm-12">
				<label for="username">Retype Password&nbsp;<span class="required">*</span></label>
				
				<input class="form-control" placeholder="Retype Password" type="password" id="rpass" tabindex="4" required>
				</div>
				
				
				
				<div class="col-sm-12">
    			    <br>
    				<input type="submit" class="btn btn-success" value="create an account" id="register-submit" >				    
				</div>
            </div>
				
		</form>
				<!-- /Form -->

         
         
         
         
         
         
         
         
         
         
         <script>
                     form.setAttribute( "autocomplete", "off" ); 

         </script>
         

	</div>

</div>


</div>     
</div>
 
 
