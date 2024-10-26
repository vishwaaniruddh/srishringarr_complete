<?php Session_Start(); ?>
<!DOCTYPE html>
<html >
<head>
<?php include('header.php');
include('config.php');
?>

<!--=====================multiselect=============-->
 <link rel="stylesheet" href="multipledropdown.css">

<style>
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
   
  
}
.ms-options-wrap > button > span {
    display: inline-block;
}

</style>

<!--==================================-->


<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
} 

 


function chkIndividual(){
 var ddl=  document.getElementById('Membership_Level').value;
if(ddl=="Individual"){
    
  $("#hd_mul").show();
    
}else{
  
    $("#hd_mul").hide();  
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

                        <h4 class="">  Template
                        </h4>
                      

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
                               Send Template
                            </h5>
                            <!--<p class="m-b-0 text-muted">
                                Standard form controls
                            </p>-->
                        </div>
                        
                        
                        <form id="myForm" method="POST" action="TemplateSend_Process.php"  >
                        <div class="card-body">
                                <div class="form-group ">
                                    <label for="inputPassword4">Level</label>
                                    <select class="form-control"  name="Membership_Level" id="Membership_Level" onchange="chkIndividual()" required>
                                          <option value="">Select Level *</option>
                                          <option value="All">All</option>
                                           <?php
                                         $levelQry="select * from Level where 1=1";
                                         
                                          $runlevel=mysqli_query($conn,$levelQry);
                                          while($fetchLevel=mysqli_fetch_array($runlevel)){
                                          if($fetchLevel['Leval_id']!="1"){
                                          ?>
                                          <option value="<?php echo $fetchLevel['Leval_id'];?>"><?php echo $fetchLevel['level_name'];?></option>
                                          <? }} ?>
                                         
                                          <option value="Individual">Individual mail send</option>
                                       
                                  </select>
                                </div>
                            
                            
                            
                            <div class="form-group " id="hd_mul" style="display:none">
                            <input type="hidden" name="drop" id="drop"/>
                            <select name="lstStates" multiple="multiple" id="lstStates" class="form-control" onchange="per()"  >
          
                            <optgroup label="Membership Number">
                            <optgroup label=" ">
                                     <?php 
                                      
                                      $abc="select VoucherBookletNumber,MembershipNumber from voucher_Details where 1=1 order by MembershipNumber";
                                      
                                      $runabc=mysqli_query($conn,$abc);
                                      while($fetch=mysqli_fetch_array($runabc)){
                                      
                                       $View1="select Primary_nameOnTheCard,MembershipDetails_Level from Members where GenerateMember_Id='".$fetch['MembershipNumber']."' and MembershipDetails_Level!='1' ";
 	                                   $qrys1=mysqli_query($conn,$View1);
                                       $fetchMem=mysqli_fetch_array($qrys1);
                                       if($fetchMem['MembershipDetails_Level']=="2" || $fetchMem['MembershipDetails_Level']=="3"){
                                      ?>
                                      <option value="<?php echo $fetch['MembershipNumber'];?>"><?php echo $fetch['MembershipNumber']."          ".$fetchMem['Primary_nameOnTheCard'];?></option>
                                       <
                                      
                                     <?php } } ?>
                                     </optgroup>
               </optgroup>
                                      </select>
                            </div>
                            
                            
                                
                        
                          
                           
                             
<br />
                         
                            <div class="form-group">
                                <input  type="submit" class="btn btn-primary" value="Send"/>
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
  

  <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>



 <script>
 
   
 function per(){
    
   var obj = myForm.lstStates,
        options = obj.options, 
        selected = [], i, str;
   
    for (i = 0; i < options.length; i++) {
        options[i].selected && selected.push(obj[i].value);
    }
    
    str = selected.join();
    
    // what should I write here??
   // alert("Options selected are " + str);
  
document.getElementById("drop").value=str;
 }
 
 
    $(function () {
    $('#lstStates').multiselect({
        buttonText: function(options){
          if (options.length === 0) {
              return 'No option selected ...';
           }
           var labels = [];
           options.each(function() {
               if ($(this).attr('value') !== undefined) {
                   labels.push($(this).attr('value'));
               } 
            });
            return labels.join(', ');  
         }
    }); 
});
</script>


</body>

</html>