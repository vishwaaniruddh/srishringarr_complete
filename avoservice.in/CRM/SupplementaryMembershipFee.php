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


function setProgram(){
    

                $.ajax({
                    type:'POST',
                    url:'setProgram.php',
                     data:'',
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                      
                        var newoption=' <option value="">Select Program *</option>' ;
                        $('#Program').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["Program_ID"]+' value='+ jsr[i]["Program_ID"]+'   >'+jsr[i]["Progam_name"]+'</option> ';
		
                        
                        }                       
                     	$('#Program').append(newoption);
 
                    }
                })
                
            }



function levelSet(){
    
var Program=document.getElementById("Program").value;
//alert(state);
                $.ajax({
                    type:'POST',
                    url:'levelset.php',
                     data:'Program='+Program,
                     datatype:'json',
                    success:function(msg){
                        //alert(msg);
                       var jsr=JSON.parse(msg);
                      
                        var newoption=' <option value="">Select Level *</option>' ;
                        $('#P_Level').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                         
                       
                      //var newoption= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'>'+jsr[i]["modelno"]+'</option> ';
		                   newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'   >'+jsr[i]["levelname"]+'</option> ';
		
                        
                        }                       
                     	$('#P_Level').append(newoption);
 
                    }
                })
                
            }
            
        

    function validation()
    {
     var Membership= document.getElementById("Membership").value;
     var HotelName= document.getElementById("HotelName").value;
     
     if(Membership=="")
     {
     swal("Please enter Membership Type ");
     return false;
     } 
     else if(HotelName=="")
     {
     swal("Please enter Hotel Name ");
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
    <!--site header begins-->
<?php include('navbar.php');?>
<!--site header ends -->    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> Other Membership Fee Creation
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
                                 Other Membership Fee Entry
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        <form method="post" action="SupplementaryMembershipFee_process.php"  onsubmit="return validation()" >
                        <div class="card-body ">
                            <div class="form-group">
                                <label for="inputAddress">Program Name</label>&nbsp;
                                        <select class="form-control"  name="Program" id="Program" onfocus="setProgram();" onchange="levelSet()" required>
                                        <option value="">Select Program *</option>
                                         <?php 
                                         /* $abc="select Progam_name,Program_ID from Program ";
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){?>
                                          <option value="<?php echo $fetch['Program_ID'];?>" id="<?php echo $fetch['Program_ID']?>"><?php echo $fetch['Progam_name'];?></option>
                                         <?php }*/ ?>
                                         </select> 
                                          
                                          </div>
                                          
                                           <div class="form-group">
                                <label for="inputAddress">Program Level</label>&nbsp;
                                        <select class="form-control"  name="P_Level" id="P_Level"  required>
                                        <option value="">Select Level *</option>
                                         <?php 
                                        /*  $abc="select level_name,Leval_id from Level ";
                                          $runabc=mysqli_query($conn,$abc);
                                          while($fetch=mysqli_fetch_array($runabc)){?>
                                          <option value="<?php echo $fetch['Leval_id'];?>" id="<?php echo $fetch['Leval_id']?>"><?php echo $fetch['level_name'];?></option>
                                         <?php } */?>
                                         </select> 
                                          
                                          </div>
                                          
                                           <div class="form-group">
                                        <label for="inputAddress">Membership Fee</label>&nbsp;
                                        <select class="form-control"  name="MembershipFee" id="MembershipFee"  required>
                                        <option value="">Select Fee *</option>
                                       <option  value="SupplementaryMembershipFee">Supplementary Membership Fee</option>
                                       <option value="ComplimentaryMembershipFee">Complimentary Membership Fee</option>
                                         </select> 
                                        </div>
                                      
                                          
                                       <div class="form-group">
                                        <label for="inputAddress"> Fee</label>&nbsp;
                                        <input type="text" class="form-control" id="Fee" name="Fee" value="0" placeholder="Membership Fee*" required>
                                        </div>
                                      
                                      
                                   
                                      
                                      
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

<?php include('belowScript.php');?>
</body>
</html>