<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
   <?php include('header.php');?>
<script>
             function ReGenerateOTP(){
         
         var mob=document.getElementById('mob').value;
         var email=document.getElementById('emailId').value;
         
         $.ajax({
   type: 'POST',
   url: 'sendOTP.php',
   //async:false,
   data:{mob:mob,email:email},
   
success: function(data) {
//alert(data)
if(data=='1'){
    swal("OTP Send");
}
}

});
         
         
          }
   
  </script>
    <script>
 
   
   function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}
   
    function verify(){
//alert("hiii")
  
    var mob=document.getElementById('mob').value;
    var email=document.getElementById('emailId').value;
    var otp=document.getElementById('otp').value;
    
   
$.ajax({
   type: 'POST',
   url: 'check_OTP.php',
   //async:false,
   data:{mob:mob,email:email,otp:otp},
   
success: function(data) {
   // alert(data)
if(data==1){
 // swal("send mail");
  
  
  swal({
  title: "Success !",
  text: "Please check your email for the password to login!",
  icon: "success",
 // buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   // swal("Poof! Your imaginary file has been deleted!", {
    //  icon: "success",
  //  });
    window.open("login.php","_self");
    
  } 
});
  
  
  
  
  
  
 /*sleep(290).then(() => {
   
   window.open('','_self').close();
   window.open("login.php","_blank");
  // window.open("index.php","_self");
 
});*/

}else if(data==2){
    swal("Invalid OTP");
}
else if(data==0){
    swal("Expire OTP ! Please Generate New OTP");
}else
{
    
}

}

});

     }


</script>


</head>
<body class="jumbo-page">

<main class="admin-main  ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-4  bg-white">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <?php include('logo.php');?>
                        <h3 class="text-center p-b-20 fw-400">OTP VERIFICATION</h3>
                        <form class="needs-validation" action="process_login.php" method="post">
                            <div class="form-row">
                                <div class="form-group floating-label col-md-12">
                                      <label id="label1">OTP</label>
                                     <input type="text" required class="form-control" id="otp" name="otp" style="text-align: center" placeholder="OTP">
                                     <input type="hidden" name="mob" id="mob" value="<?php echo $_SESSION['$mob'];?>">
                                     <input type="hidden" name="emailId" id="emailId" value="<?php echo $_SESSION['$email'];?>">
                                </div>
                           </div>
                            <center>
                                     <label id="label3" style="font-size:12px;"></label>
                                 </center>

                            <button type="button" class="btn btn-primary btn-block btn-lg" onClick="javascript:verify();">VERIFY</button><br />
 <p style="display: inline;"><a onClick="ReGenerateOTP();" style="float: right;" class="text-underline ">Generate OTP</a></p>
                      
                        </form>
                        
                           </div>

                </div>
            </div>
            <div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url('assets/img/login.svg');">

            </div>
        </div>
    </div>
</main>

<div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-all-0" id="site-search">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots" >
                    <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

                    <div class="container-fluid">
                        <div class="col-md-10 p-t-10 m-auto">
                            <input type="search" placeholder="Search Something"
                                   class=" search form-control form-control-lg">

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                        results
                    </div>
                    <div class="list-group list  ">


                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"   src="assets/img/users/user-3.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Eric Chen</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="assets/img/users/user-4.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Sean Valdez</div>
                                <div class="text-muted">Marketing</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="assets/img/users/user-8.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Marie Arnold</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-pdf"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">SRS Document</div>
                                <div class="text-muted">25.5 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-document-box"></i></div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">Design Guide.pdf</div>
                                <div class="text-muted">9 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm  ">
                                        <div class="avatar-title bg-primary rounded"><i
                                                    class="mdi mdi-24px mdi-code-braces"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">response.json</div>
                                <div class="text-muted">15 Kb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-info rounded"><i
                                                    class="mdi mdi-24px mdi-file-excel"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">June Accounts.xls</div>
                                <div class="text-muted">6 Mb</div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="assets/vendor/popper/popper.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendor/select2/js/select2.full.min.js"></script>
<script src="assets/vendor/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/vendor/listjs/listjs.min.js"></script>
<script src="assets/vendor/moment/moment.min.js"></script>
<script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/atmos.min.js"></script>
<!--page specific scripts for demo-->

</body>
</html>