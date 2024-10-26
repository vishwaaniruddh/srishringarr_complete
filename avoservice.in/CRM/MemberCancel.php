<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>

</head>
<body class="jumbo-page">

<main class="admin-main  bg-pattern">
    <div class="container">
        <div class="row m-h-100 ">
            <div class="col-md-8 col-lg-4  m-auto">
                <div class="card shadow-lg ">
                    <div class="card-body ">
                        <div class=" padding-box-2 ">
                            <div class="text-center p-b-20 pull-up-sm">

                                <div class="avatar avatar-lg">
                                    <span class="avatar-title rounded-circle bg-pink"> <i
                                                class="mdi mdi-key-change"></i> </span>
                                </div>

                            </div>
                            <h3 class="text-center">Reson For Member Cancellation</h3>
                            <form action="MemberCancel_Process.php" method="post">
                                <div class="form-group">
                                   <input type="hidden" id="HiddenId" name="HiddenId" value="<?php echo $_GET['id'];?>" >
                                    <div class="input-group input-group-flush mb-3">
                                       
                                             <textarea class="form-control form-control-prepended" rows="3" id="Reson" name="Reson"></textarea>     
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="mdi mdi-emoticon-cool"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                  
                                   
                                   
                                </div>


                                <div class="form-group">
                                    
                                    <input type="submit" class="btn text-uppercase btn-block  btn-primary" value="Member Cancel">
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('belowScript.php');?>
</body>
</html>
