<?php include('header.php'); ?>
 <main class="mainContent" role="main">
            <section id="pageContent">
    <div class="container">
        <div class="velaAccountContainer"><div class="velaFormAccount">
    <ul class="nav navFormAccount">
        <li class="active">
            <a href="#frmAccountTabLogin" data-toggle="tab">
                Login
            </a>
        </li>
        <li class="">
            <a href="#frmAccountTabRegister" data-toggle="tab">
                Create Account
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="frmAccountTabLogin" class="tab-pane active">
            <div id="ResetPassword" class="resetPassword alert alert-success hidden">
                We&#39;ve sent you an email with a link to update your password.
            </div>
            <div id="CustomerLoginForm" class="formAccount formAccountLogin">
                
                
                <form method="post" action="account/logincode.php" id="customer_login" accept-charset="UTF-8">
                    
                    <input type="hidden" name="form_type" value="customer_login" />
                    <input type="hidden" name="utf8" value="✓" />
                    
                    <div class="formContent">
                        
                        <div class="form-group">
                            <label for="CustomerEmail" class="hidden">Email</label>
                            <input type="email" name="usernm" id="CustomerEmail" class="form-control" placeholder="Email" required autofocus>
                        </div>
                        
                        <div class="form-group form-group--pasword">
                                <label for="CustomerPassword" class="hidden">Password</label>
                                <input type="password" value="" name="pass" id="CustomerPassword" class="form-control" placeholder="Password" required>
                                <a href="javascript:void(0)" class="velaShowPassword" onclick="showPassword()">Show</a>
                            </div>
                            
                            <div class="form-button">
                            <input type="submit" class="btn btnVelaOne" value="Sign In">
                        </div>
                        
                        <div class="forgetPassword">
                                <a href="recover.php" class="velaAccountButton velaRecoverPassword">Forgot your password?</a>
                        </div>
                        </div>
                </form>
                
                
                
                
            </div>
            <div id="RecoverPasswordForm" class="formAccount formAccountRecover hidden">
                <h2 class="velaAccountTitle">
                    <span>Reset your password</span>
                </h2>
                <form method="post" action="/account/recover" accept-charset="UTF-8"><input type="hidden" name="form_type" value="recover_customer_password" /><input type="hidden" name="utf8" value="✓" />
                    <div class="formContent">
                        <div class="formAccountText">
                            <p>We will send you an email to reset your password.</p>    
                        </div><div class="form-group">
                            <label for="RecoverEmail" class="hidden">Email</label>
                            <input type="email" value="" name="email" id="RecoverEmail" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-button">
                            <input type="submit" class="btn btnVelaOne" value="Submit">
                            <div class="forgetPassword">
                                <a href="javascript:void(0)" class="velaAccountButton velaHideRecoverPasswordLink">Back to login</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
            
            
        <div id="frmAccountTabRegister" class="tab-pane">
            <div id="CustomerRegisterForm" class="formAccount formAccountRegister">
                <form method="post" action="account/reg_process.php" id="create_customer" accept-charset="UTF-8"><input type="hidden" name="form_type" value="create_customer" /><input type="hidden" name="utf8" value="✓" />
                    <div class="formContent"><div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="FirstName" class="hidden">First Name</label>
                                    <input type="text" name="fname" id="FirstName" class="form-control" placeholder="First Name"  required >
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="LastName" class="hidden">Last Name</label>
                                    <input type="text" name="lname" id="LastName" class="form-control" placeholder="Last Name" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Email" class="hidden">Email</label>
                            <input type="email" name="emailid" id="Email" class="form-control" placeholder="Email"  required>
                        </div>
                        <div class="form-group">
                            <label for="Mobile" class="hidden">Mobile</label>
                            <input type="text" name="mob" id="Mobile" class="form-control" placeholder="Mobile"  required>
                        </div>
                        
                        <div class="form-group form-group--pasword">
                            <label for="CreatePassword" class="hidden">Password</label>
                            <input type="password" name="passwd" id="CustomerPassword_register" class="form-control" placeholder="Password" required>
                            <a href="javascript:void(0)" onclick="showPassword_register()" class="velaShowPassword">Show</a>
                        </div>
                        <div class="form-button">
                            <input type="submit" value="Create an account" class="btn btnVelaOne">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</section>
        </main>
        <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
        <script>
            function showPassword() {
  var x = document.getElementById("CustomerPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function showPassword_register() {
  var x = document.getElementById("CustomerPassword_register");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

        </script>
        
        <?php include('footer.php'); ?>