<?php Session_Start();?>
<!DOCTYPE html>
<html lang="en">
<head>

    
<?php include('header.php');
include('config.php');
$Mainid=$_GET['id'];
if($Mainid!=""){
$QuryGetLead=mysqli_query($conn,"select * from Leads_table where Lead_id='".$Mainid."'");
$fetchLead=mysqli_fetch_array($QuryGetLead);

$HOtelNameChk=$fetchLead['Hotel_Name'];


$QuryDelegate=mysqli_query($conn,"select * from LeadDelegation where LeadId='".$Mainid."'");
$fetchDelegate=mysqli_fetch_array($QuryDelegate);
if($QuryDelegate){
$QurySalesmanId=mysqli_query($conn,"select * from SalesAssociate where SalesmanId='".$fetchDelegate['SalesmanId']."'");
$fetchSalesmanId=mysqli_fetch_array($QurySalesmanId);
}

$QuryLead_Sources=mysqli_query($conn,"SELECT * FROM `Lead_Sources` where SourceId='".$fetchLead['LeadSource']."' and Active='YES'");
$fetchLead_Sources=mysqli_fetch_array($QuryLead_Sources);



$QuryState=mysqli_query($conn,"select * from state where state_id='".$fetchLead['State']."'");
$fetchState=mysqli_fetch_array($QuryState);
}
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

 $(document).ready(function(){
 var value=document.getElementById('Primary_MaritalStatus').value;
  if(value=='Married'){
        $("#Spouse").show();
         $("#Spouse_Title").attr("required",true);
          $("#Spouse_FirstName").attr("required",true);
           $("#Spouse_LastName").attr("required",true);
            $("#Spouse_GmailMArrid1").attr("required",true);
             $("#Spouse_mcode1Married1").attr("required",true);
              $("#Spouse_mob1MArid1").attr("required",true);
              $("#Spouse_nameOnTheCardMarried").attr("required",true);
    }
});
 
function setSpouseMember(){
    var value=document.getElementById('Primary_MaritalStatus').value;
   //  Spouse_Title Spouse_FirstName Spouse_LastName Spouse_GmailMArrid1 Spouse_GmailMArrid2 Spouse_PhotoUpload Spouse_mcode1Married1
  //   Spouse_mob1MArid1 Spouse_mcode1Married2 Spouse_mob1MArid2  Spouse_Contact1Married Spouse_Contact2Married Spouse_nameOnTheCardMarried
     
    if(value=='Married'){
        $("#Spouse").show();
       
         $("#Spouse_Title").attr("required",true);
          $("#Spouse_FirstName").attr("required",true);
           $("#Spouse_LastName").attr("required",true);
            $("#Spouse_GmailMArrid1").attr("required",true);
             $("#Spouse_mcode1Married1").attr("required",true);
              $("#Spouse_mob1MArid1").attr("required",true);
              $("#Spouse_nameOnTheCardMarried").attr("required",true);
        
    }
    else{
       
       document.getElementById('Spouse_Title').value=""; 
       document.getElementById('Spouse_FirstName').value=""; 
       document.getElementById('Spouse_LastName').value=""; 
       document.getElementById('Spouse_GmailMArrid1').value=""; 
      document.getElementById('Spouse_GmailMArrid2').value=""; 
       document.getElementById('Spouse_PhotoUpload').value=""; 
      document.getElementById('Spouse_mcode1Married1').value=""; 
       document.getElementById('Spouse_mob1MArid1').value=""; 
      document.getElementById('Spouse_mcode1Married2').value=""; 
       document.getElementById('Spouse_mob1MArid2').value=""; 
      document.getElementById('Spouse_Contact1Married').value=""; 
       document.getElementById('Spouse_Contact2Married').value=""; 
      document.getElementById('Spouse_nameOnTheCardMarried').value=""; 
         
          $("#Spouse").hide(); 
    }
      
      
    
}

function valueChangedHideShow()
{
    if($('#MembershipDetails_offerCheck1').is(":checked"))  { 
   
        $("#Hide_Discount_UplodeAuthorisation").show();
         $("#sample").show();
        
    }   
    else{
        $("#Hide_Discount_UplodeAuthorisation").hide();
        $("#sample").hide();
        
    }
}

function cal_NetPayment(){
    
     var fee=document.getElementById('MembershipDetails_Fee').value;
     var discnt=document.getElementById('MembershipDts_Discount').value;
   
   if(discnt==""){
      discnt='0'; 
   }
     
     var Amt=(fee*discnt)/100;
     var NetAmt=fee-Amt;
     
     var Gst=(NetAmt*18)/100;
     
     var grossAmt=NetAmt+Gst;
     
     
     
          
           if(fee!="" && discnt!=""){
     document.getElementById('MembershipDts_NetPayment').value=NetAmt;
     document.getElementById('MembershipDts_GST').value=Gst;
     document.getElementById('MembershipDts_GrossTotal').value=grossAmt;       
     }else{
         document.getElementById('MembershipDts_NetPayment').value="";
     document.getElementById('MembershipDts_GST').value="";
     document.getElementById('MembershipDts_GrossTotal').value="";
     }   
}
 $( function() {
    $( "#Primary_DateOfBirth" ).datepicker();
        $( "#Primary_DateOfBirth" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#Primary_DateOfBirth" ).datepicker( "option", "showAnim", "fold" );
   
  } );

$( function() {
    $( "#MembershipDts_PaymentDate" ).datepicker();
        $( "#MembershipDts_PaymentDate" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
        $( "#MembershipDts_PaymentDate" ).datepicker( "option", "showAnim", "fold" );
   
  } );


</script>

<script>
function setDropDownBrand(){
   
      var value=document.getElementById('Hotel').value;
      var tableName='Hotel_Creation'; 
      var Column='hotel_id';
      var id='Brand';
      var name='Hotel_Name';
      
               $.ajax({
                    type:'POST',
                    url:'SetDropdownValueBrand.php',
                     data:'value='+value+'&tableName='+tableName+'&Column='+Column+'&id='+id+'&name='+name,
                    
                    success:function(msg){
                       // alert(msg);
                      document.getElementById('Brand').value=msg;
                    }
                })
                
            }
    


    
    function setDropDown(Textboxid,tableName,Column,id,name,setDropdwon) {
    
    
   document.getElementById('Hidden_MembershipDetails_id').value= $("#MembershipDetails_Level option:selected").text();
    
       var value=document.getElementById(Textboxid).value;
        if(value!=""){
            
        
               $.ajax({
                    type:'POST',
                    url:'SetDropdownValue.php',
                     data:'value='+value+'&tableName='+tableName+'&Column='+Column+'&id='+id+'&name='+name,
                     datatype:'json',
                    success:function(msg){
                       // alert(msg);
                       var jsr=JSON.parse(msg);
                       //alert(jsr.length);
                      
                       if(Textboxid=="MembershipDetails_Level"){
                           
                           document.getElementById('MembershipDetails_Fee').value="";
                           document.getElementById('MembershipDetails_Fee').value=jsr[0]["name"];
                       }else{
                           
                    
                       var hed='#'+setDropdwon;
                      
                        var newoption=' <option value="">Select</option>' ;
                        $(hed).empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                           newoption+= '<option id='+ jsr[i]["ids"]+' value='+ jsr[i]["ids"]+'   >'+jsr[i]["name"]+'</option> ';
		                }                       
                     	$(hed).append(newoption);
                       }
                    
                        cal_NetPayment();
                    }
                })
                
            }else{
                 document.getElementById('MembershipDetails_Fee').value="";
                 document.getElementById('MembershipDts_NetPayment').value="";
                 document.getElementById('MembershipDts_GST').value="";
                 document.getElementById('MembershipDts_GrossTotal').value="";
                 }
            
}
           
</script>
<script>

    function validation()
{
    
     var FirstName= document.getElementById("FirstName").value;
     var LastName= document.getElementById("LastName").value;
     var mcode1= document.getElementById("mcode1").value;
     var mob1= document.getElementById("mob1").value;
     var Email = document.getElementById("Gmail").value;
     
	var emailFilter =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
     
    
     if(FirstName=="")
     {
     swal("Please enter First Name ");
     return false;
     } 
     else if(LastName=="")
     {
     swal("Please enter Last Name");
     return false;
     }
     else if(mcode1=="")
     {
     swal("Please enter Mobile Code");
     return false;
     }
     else if(mob1=="")
     {
     swal("Please enter Mobile Number");
     return false;
     }
     else if (Email == "")
	{
		swal(" Please fill email id ");
		return false;
		
	}
     else if (!emailFilter.test(Email))
	{
		
		swal("Invalid Email ")
		return false;
	}
     else{
 
    // sumitfunc();
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

                        <h4 class=""> Payment Details
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
                                 Payment Entry
                            </h5>
                        </div>
                        
                        
                       <form method="POST" action="invoice.php"  enctype="multipart/form-data" >
                        
                       <!--  <form method="POST" action="member_Payment_Review.php"  enctype="multipart/form-data" >-->
                        <div class="card-body">
                          
                              <!--======================== Part 3 Membership Details (End)================================--->
                             <input type="hidden" value="<?php echo $Mainid;?>" id="Mainid" name="Mainid">
                              <input type="hidden"  id="Hidden_MembershipDetails_id" name="Hidden_MembershipDetails_id">
                          <?php //  echo " select * from Level where  Program_ID=(SELECT Program_ID FROM `Program` where Hotel_id='".$HOtelNameChk."' ";?>
                                <div class="form-group">
                                    <label for="inputPassword4">Membership Level</label>
                                  <select class="form-control"  name="MembershipDetails_Level" id="MembershipDetails_Level"    onchange="setDropDown('MembershipDetails_Level','PrimaryMembershipFee','P_Level_id','MembershipFee_id','NewMembership','MembershipDetails_Fee')" required>
                                          <option value="">Select Level *</option>
                                        <?php
                                         $levelQry="select * from Level where 1=1"; 
                                          if($Mainid!=""){ $levelQry .= " and Program_ID=(SELECT Program_ID FROM `Program` where Hotel_id='".$HOtelNameChk."')";  }
                                         
                                          $runlevel=mysqli_query($conn,$levelQry);
                                          while($fetchLevel=mysqli_fetch_array($runlevel)){?>
                                          <option value="<?php echo $fetchLevel['Leval_id'];?>"><?php echo $fetchLevel['level_name'];?></option>
                                          <? } ?>
                                  </select>
                                </div>
                                 
                                <div class="form-group">
                                    <label for="inputEmail4">Membership Fee</label>
                                    <input type="text" class="form-control" id="MembershipDetails_Fee" name="MembershipDetails_Fee" onblur="cal_NetPayment()" readonly required>
                                    <!--<select class="form-control"  name="MembershipDetails_Fee" id="MembershipDetails_Fee"  onblur="cal_NetPayment()" >
                                        <option value=" ">Select Fee *</option>
                                         
                                    </select> -->
                                 </div>
                                
                         
                         <div class="row">
                             <div class="cols-md-6">
                                <div class="custom-control custom-checkbox">&nbsp;&nbsp;&nbsp;
                                    <input type="checkbox" class="custom-control-input" id="MembershipDetails_offerCheck1"  name="MembershipDetails_offerCheck1" onchange="valueChangedHideShow()">
                                    <label class="custom-control-label" for="MembershipDetails_offerCheck1">Offer</label>&nbsp;&nbsp;&nbsp;
                                </div>
                             </div>
                             <div class="cols-md-6">
                              <div class="custom-control custom-checkbox" id="sample" style="display:none">
                                    <input type="checkbox" class="custom-control-input" id="MembershipSampal_offerCheck1"  name="MembershipSampal_offerCheck1" >
                                    <label class="custom-control-label" for="MembershipSampal_offerCheck1">sampal</label>
                                </div>
                            </div>
                        </div>
                             
                                <div id="Hide_Discount_UplodeAuthorisation" style="display:none">        
                                  <div class="form-group">
                                    <label for="inputEmail4">% Discount</label>
                                    <input type="text" class="form-control" id="MembershipDts_Discount" name="MembershipDts_Discount" onkeyup="cal_NetPayment()"  value="0" >
                                 </div>
                                
                                
                                
                                <div class="form-group">
                                    <label for="inputEmail4">Upload Authorisation</label>
                                    <input type="file" class="form-control" id="MembershipDts_Author" name="MembershipDts_Author"   >
                                 </div>
                                 
                        </div>
                                 
                                 
                                 
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Net Payment</label>
                                    <input type="text" class="form-control" id="MembershipDts_NetPayment" name="MembershipDts_NetPayment" required readonly>
                                 </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">GST @ 18%</label>
                                    <input type="text" class="form-control" id="MembershipDts_GST" name="MembershipDts_GST" required readonly >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Gross Total</label>
                                    <input type="text" class="form-control" id="MembershipDts_GrossTotal" name="MembershipDts_GrossTotal" required readonly >
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Date</label>
                                    <input type="text" class="form-control" id="MembershipDts_PaymentDate" name="MembershipDts_PaymentDate" autocomplete="off"  Placeholder="dd-mm-yyyy" required>
                                 </div>
                                  <div class="form-group">
                                    <label for="inputEmail4">Payment Mode</label>
                                    <select class="form-control"  name="MembershipDts_PaymentMode" id="MembershipDts_PaymentMode" onfocus="PaymentMode()" required >
                                        <option value="">Select Mode *</option>
                                          <?php 
                                          $runLevel=mysqli_query($conn,"select * from Level");
                                          $fetchLevel=mysqli_fetch_array($runLevel);
                                          $runMode=mysqli_query($conn,"select * from MembershipPaymentMode where Program_ID='".$fetchLevel['Program_ID']."'");
                                          while($fetchMode=mysqli_fetch_array($runMode)){
                                          ?>
                                          <option value="<?php echo $fetchMode['Payment_mode'];?>"><?php echo $fetchMode['Payment_mode'];?></option>
                                          <?php } ?>
                                    </select> 
                                    </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">Instrument Number</label>
                                    <input type="text" class="form-control" id="MembershipDts_InstrumentNumber" name="MembershipDts_InstrumentNumber"  placeholder='Credit Card/ Cheque/ Deposit Slip'  >
                                 </div>
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Bank Name</label>
                                    <input type="text" class="form-control" id="BankName" name="BankName"   placeholder='Bank Name'>
                                 </div>
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Upload Copy of the instrument</label>
                                    <input type="file" class="form-control" id="MemshipDts_UploadCopyOfTheInstmnt" name="MemshipDts_UploadCopyOfTheInstmnt"   >
                                 </div>
                                 
                                  <div class="form-group">
                                    <label for="inputEmail4">Batch Number</label>
                                    <input type="text" class="form-control" id="MemshipDts_BatchNumber" name="MemshipDts_BatchNumber"   placeholder='Batch Number'>
                                 </div>
                                 
                                  
                                 
                                 <div class="form-group">
                                    <label for="inputEmail4">Remarks</label>
                                    <input type="text" class="form-control" id="MemshipDts_Remarks" name="MemshipDts_Remarks"   placeholder='Remarks'>
                                 </div>
                                 
                                 <!--======================== Part 3 Membership Details (End)================================--->
                                    <div class="form-group">
                               <!-- <input  type="submit" class="btn btn-primary" value="Submit"/>-->
                               <input  type="submit" class="btn btn-primary" value="Review"/>
                            </div>
                                
    </section>
</main>
<?php include('belowScript.php');?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
</body>
You have made no changes to save.
</html>