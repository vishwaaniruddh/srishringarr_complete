<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');
?>



<script>
   function validate(form){
 with(form)
 {


 if(userfile.value.length < 1)
{
    swal("You Forgot to select an *.xls File to Import");
     return false;
}

 }
 return true;
 }

</script>



</head>
<body class="sidebar-pinned">

<?php include("vertical_menu.php")?>


<main class="admin-main">
    
    <?php include('navbar.php'); ?>
    
        <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class="">  Upload POS Details
                        </h4>
                       <!-- <p class="opacity-75 ">
                            Examples for form control styles, layout options, and custom components for
                            creating a wide variety of forms elements.
                            <br>
                            we have included dropzone for file uploads, datepicker and select2 for custom controls.
                        </p>-->


                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">
            <div class="row">
                <div class="col-lg-6">

                    <!--widget card begin-->
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                Upload POS Details 
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form action="excel_POS_uplode_Process.php" method="post" enctype="multipart/form-data" onSubmit="return validate(this)" name="form">
                            
                            
                           
                        <div class="card-body ">
                           
                            
                            <div class="form-group">
                                <label for="inputAddress">Upload Excel:</label>&nbsp;<label id="label3"></label>
                                <b> <a href="Excel/POS.xls" download>Download format </a></b>
                            </div>
                            
                             
                            <div class="form-group">
                                <label for="inputAddress">Select *.xls File to Import</label>&nbsp;<label id="label3"></label>
                                <input type="file" name="userfile" value="" id="userfile" />
                          </div>
                        
                          
                            
                        
                            <div class="form-group">
                                <button type="submit" id="Submit" name="Submit" class="btn btn-primary" >Submit</button>
                            </div>
                          
                            
                        </div>
                        </form>
                    </div>
                    <!--widget card ends-->

                                     


                </div>
              
            </div>


        </div>
    </section>
</main>


<?php include('belowScript.php');?>
</body>
</html>