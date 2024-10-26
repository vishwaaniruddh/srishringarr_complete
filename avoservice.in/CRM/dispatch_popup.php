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
                            <h3 class="text-center">Package Dispatch</h3>
                            <form action="dispatch_Process.php" method="post">
                                <div class="form-group">
                                   <input type="hidden" id="HiddenId" name="HiddenId" value="<?php echo $_GET['id'];?>" >
                                    <div class="input-group input-group-flush mb-3">
                                        <input type="text" class="form-control form-control-prepended"
                                             id="CourierName" name="CourierName"  placeholder="Courier Name" required>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="mdi mdi-emoticon-cool"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-flush mb-3">
                                        <input type="text" class="form-control form-control-prepended"
                                              id="DocketNumber" name="DocketNumber"   placeholder="Docket Number" required>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="mdi mdi-exit-run"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group input-group-flush mb-3">
                                         <input type="text" class="js-datepicker form-control"  id="dispatchDate" name="dispatchDate"  placeholder="Select a Date" required>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="mdi mdi-calendar-multiselect"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <p class="small">
                                        We will send a dispatch details to your E-Mail
                                    </p>
                                </div>


                                <div class="form-group">
                                    
                                    <input type="submit" class="btn text-uppercase btn-block  btn-primary" value="Package Dispatch">
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
