<?php session_start();
include_once('site_header.php');  ?>



<br><br>

<div class="container">
    <h3>Reset Password</h3>
    <form action="process_password_reset.php" method="POST">
        <div class="row">
            <div class="col-sm-12">
                <label>Old Password</label>
                <input type="text" name="old_pwd" class="form-control">
            </div>
            <div class="col-sm-12">
                <label>New Password</label>
                <input type="text" name="pwd" class="form-control">
            </div>
            <div class="col-sm-12">
                <label>Confirm Password</label>
                <input type="text" name="cpwd" class="form-control">
            </div>
            
            <div class="col-sm-12">
                
                <input type="submit" name="submit" value="submit" class="btn btn-success">
            </div>
            
        </div>
    </form>
</div>
<? include('footer.php'); ?>