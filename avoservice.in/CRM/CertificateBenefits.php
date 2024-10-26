<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('header.php');
include('config.php');
?>

<script>



function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

</script>

<script>
    function validation()
    {
     var Program= document.getElementById("Program").value;
     var Level= document.getElementById("Level").value;
     var CertificateBenefits= document.getElementById("CertificateBenefits").value;
     if(Program=="")
     {
     swal("Please select Program ");
     return false;
     }  
     else if(Level=="")
     {
     swal("Please select Level");
     return false;
     } 
     else if(CertificateBenefits=="")
     {
     swal("Please enter Certificate Benefits ");
     return false;
     } 
     else
     {
     return true;
     }
         
    }

</script>



</head>
<body class="sidebar-pinned">

<?php include("vertical_menu.php")?>


<main class="admin-main">
 <?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> Certificate Benefits Creation
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
                                Certificate Benefits Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="CertificateBenefits_Process.php"  onsubmit="return validation()" >
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Program Name</label>&nbsp;
                                        <select class="form-control"  name="Program" id="Program"  required>
                                        <option value="">Select Program *</option>
                                         <?php 
                                          $abc="select Progam_name,Program_ID from Program ";
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){?>
                                          <option value="<?php echo $fetch['Program_ID'];?>" id="<?php echo $fetch['Program_ID']?>"><?php echo $fetch['Progam_name'];?></option>
                                         <?php } ?>
                                         </select> 
                                          
                                          </div>
                                          
                                <div class="form-group">
                                <label for="inputAddress">Program Level</label>&nbsp;
                                        <select class="form-control"  name="Level" id="Level"  required>
                                        <option value="">Select Level *</option>
                                         <?php 
                                          $abc="select level_name,Leval_id from Level ";
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){?>
                                          <option value="<?php echo $fetch['Leval_id'];?>" id="<?php echo $fetch['Leval_id']?>"><?php echo $fetch['level_name'];?></option>
                                         <?php } ?>
                                         </select> 
                                          
                                          </div>
                                          
                                     <div class="form-group">
                                        <label for="inputAddress">Certificate Benefits</label>&nbsp;<label id="label3"></label>
                                     
                                      
                                      <table class="form-table" id="customFields">
                                    	<tr valign="top">
                                    	<div class="form-row">
                                        <div class="form-group col-md-10">
                                      	<input type="text" class="code form-control" id="CertificateBenefits" name="CertificateBenefits[]" value="" placeholder="Certificate Benefits *" required/> &nbsp;
                                        </div>
                               
                                    	<div class="form-group col-md-2"><button type="button" class="btn m-b-15 ml-2 mr-2  btn-rounded-circle
                            btn-info addCF"><i class="mdi mdi-plus"></i></button>	 </div>
                                    	 
                                        </div>
                                    	</tr>
                                    </table>
                                      
                                      
                                      
                                  <br />    
                                      
                                 <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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

<script>
    $(document).ready(function(){
	$(".addCF").click(function(){
		$("#customFields").append('<tr valign="top"><td style="display:flex;    width: 179%;"><input type="text" class="code form-control" id="CertificateBenefits" name="CertificateBenefits[]" value="" placeholder="Card Benefit *" required/>  &nbsp;<button type="button" class="btn m-b-15 ml-2 mr-2  btn-rounded-circle btn-info remCF"><i class="mdi mdi-minus"></i></button> </td></tr>');
	});
    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
});
</script>
<?php include('belowScript.php');?>
</body>
</html>