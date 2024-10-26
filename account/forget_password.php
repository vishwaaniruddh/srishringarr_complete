<?php session_start();

include_once('site_header.php'); ?>


<br><br>


<div class="container">
    <form method="POST" action="reset_password.php">
        <div class="row">
            <div class="col-sm-12">
                <label>Enter Email ID</label>
                <input type="email" name="emailid" class="form-control">
            </div>
            <div class="col-sm-12">
                <br />
                <input type="submit" name="submit" value="Submit" class="btn btn-primary" />
            </div>
        </div>
    </form>
</div>

</body>
</html>