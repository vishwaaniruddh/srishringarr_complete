<?php session_start();
include("access.php");
include('config.php');
include("menubar.php"); 


function get_so_data($parameter,$id){}


function get_cust_vertical_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from customer where cust_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $cust_vertical = $sql_result['cust_name'];
    
    return $cust_vertical;
}


function get_state_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from state where state_id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $state_name = $sql_result['state'];
    
    return $state_name;
}


function get_branch_name($id){
    
    global $con1;
    
    $sql=mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $branch_name = $sql_result['name'];
    
    return $branch_name;
}



function get_asset_name($id){

    global $con1;
    
    $sql = mysqli_query($con1,"select * from assets_specification where ass_spc_id = '".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);

    $asset_name = $sql_result["name"];
    
    return $asset_name;
    
}



function get_avail_quantity($po,$product){
    
    global $con1;
    
    $sql = mysqli_query($con1,"SELECT * FROM po_consumption where po_trackid='".$po."' and po_product='".$product."'");
    
    if($sql_result = mysqli_fetch_assoc($sql)){
        
        $available_quantity = $sql_result['po_qty'] - $sql_result['po_consumqty'];
    
        return $available_quantity;
    
    }
    else{
        return false;
    }
    
    
    
    
}

function get_consume_quantity($po,$product){
    
    global $con1;
    
    $sql = mysqli_query($con1,"SELECT * FROM po_consumption where po_trackid='".$po."' and po_product='".$product."'");
    
    
    
    if($sql_result = mysqli_fetch_assoc($sql)){
    
        $consume_quantity = $sql_result['po_consumqty'];
    
        return $consume_quantity;    
    }
    else{
        return 0;
    }
    
    
    
    
}

?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>New Sales Order </title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="menu.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.4.1.js"
      integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script>
      
      <style>
      
      input:focus{
          outline: none;
      }
      .custom_radio{
              width: 5%;
    height: 20px;
      }
      .cust_column{
          display:flex;
      }
      .submit_btn{
          display:flex;
          justify-content:center;
      }
      .submit_btn input{
          width:15%;
          margin:2%;
      }
      
      
      input[type="text"]{
          width:100%;
      }
      .optional_input, .hide{
    display: none;
}

.show {
    display: block ! important;
}
           html[xmlns] #menu-bar {
    display: block;
    z-index: 1000;
    position: relative;
}
#menu-bar li:hover > ul {
    text-align: center;
}

#menu-bar{
        width: 100%;
}
   
   body{
           background-color: #4D9494;
    margin-top: 20px;
    
   }
   #custer_vertical, #po_no{
       width:100%;
   }

   .additional_buttons{
       display: flex;
    justify-content: center;

   }
   .additional_buttons form{
       margin:1%;
   }
   .custom_row label{
       display:block;
           font-size: 18px;
   }
   .row{
       margin:2%;
   }
   label{
       color:white;
   }
    html[xmlns] #menu-bar {
    display: block;
    z-index: 1000;
    position: relative;
}
#menu-bar ul{
    z-index: 999;
}
   html[xmlns] #menu-bar {
    display: block;
    z-index: 10000;
    position: relative;
}
table{
    width: 50% !important;
    margin: auto;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

#check_partial_product ,#check_all_product{
    border: 0;
    border-radius: 0;
    box-shadow: none;
}
input[type=checkbox]{
        height: 20px;
    width: 20px;
    margin: 0;
}
#po_qty{
        background-color: transparent;
    border: none;
        text-align: center;
    width: 100%;
}
      </style>
    </head>
    <body>
        
     <?   
    $so_trackid = $_GET['id'];
     
    $sql = mysqli_query($con1,"select * from new_sales_order where so_trackid='".$so_trackid."'");
        

    $sql_result=mysqli_fetch_assoc($sql);

   $buyerid = $sql_result['buyerid'];
   
   $po_id = $sql_result['po_trackid'];
   
$demo_sql = mysqli_query($con1,"select * from demo_atm where so_id ='".$so_trackid."'");
$demo_atm = mysqli_fetch_assoc($demo_sql);
?>

<div class="container-fluid" style="margin: 5% 1%;">
    
    <?
     
      $status = $sql_result['status'];
    
    if($status==1){ ?>
        <h5 style="text-align:right;"><a href="edit_so.php?id=<? echo $so_trackid;?>" style="color:white;">Edit This Sales Order</a> </h5>
    <? } ?>
    
             


<? $buyer_sql = mysqli_query($con1,"select * from buyer where buyer_ID = '".$buyerid."'");
    
    if($buyer_sql_result=mysqli_fetch_assoc($buyer_sql)){
    
    $branch_id = $buyer_sql_result['avo_branch'];
    $branch_name = get_branch_name($branch_id);
    
   $state_id = $buyer_sql_result['buyer_state'];
    $state_name = get_state_name($state_id);
    
    $cust_id = $buyer_sql_result['buyer_vertical'];
    $cust_vertical  = get_cust_vertical_name($cust_id);
    
    $buyer_pin = $buyer_sql_result['buyer_pin'];
?>


       <div id="buyer_info">
                 <hr>
                 <h4 style="color:white">Buyer Info</h4>
                 <div class="row custom_row">
                     <div class="col-md-3">
                        
                        <label> Buyer Name </label>
                         <span style="color:white" id= "consignee_name" ><? echo $buyer_sql_result['buyer_name']; ?>
                        </span>
                       </div>
                        
                        <div class="col-md-3">
                        <label> Customer Vertical </label>
                         <span style="color:white" id="cust_vertical"><? echo $cust_vertical; ?>
                        </span>
                       </div>
                      
                      <div class="col-md-3">
                        <label> Branch Name </label>
                         
                            <span style="color:white" id="cust_branch"><? echo $branch_name; ?>
                        </span>
                                                  
                     </div>
                     
                     <div class="col-md-3">
                         <label>
                             City
                         </label>
                          <span style="color:white" id="cust_city"><? echo $buyer_sql_result['buyer_city'] ;?></span>
                     </div>
                     
                     <div class="col-md-3">
                         <label> Address </label>
                         <span style="color:white" id="cust_address">
                          <? echo $buyer_sql_result['buyer_address'];?>   
                         </span>
                          
                     </div>
                     <div class="col-md-3">
                         <label> State </label>
                          <span style="color:white" id="cust_state">
                          <? echo $state_name;?>    
                          </span>
                          
                     </div>
                     
                       <div class="col-md-3">
                         <label>
                             Pincode
                         </label>
                          <span style="color:white" id="cust_pin">
                          <? echo $buyer_pin;?>    
                          </span>
                          
                     </div>
                     
                     
                     <div class="col-md-3">
                         <label>
                             GST No.
                         </label>
                         <span style="color:white" id="cust_gst">
                          <? echo $buyer_sql_result['buyer_gst'];?>   
                         </span>
                          
                     </div>
                     
                 </div>
                 
                 <hr>
             </div>
             
             <? } ?>
             
<? if($sql){ ?>
        

                                
    <form action="process_sales_order.php" method="POST" id="preocess_sales">
                
        <input type="hidden" value="<? echo $po_id; ?>" name="po_id">
                 <table class="table table-striped table-bordered">
                      <!--Hidden fields-->
                            <input type="hidden" value="<? echo $buyerid; ?>" name="buyerid">
                           
                            <input type="hidden" value="<? echo $custid; ?>" name="cust_id">
                            <input type="hidden" value="<? echo $_POST['po_no']; ?>" name="purchase_order">
                            

                            

                        <!--end hidden fields-->
                     <tr>
                         <th>Products</th>
                         <th style="width:20%;">Model</th>
                         <th style="width:10%;">Rate</th>
                         <th style="width:10%;">Warranty</th>
                         
                         <th style="width:10%;">Order Quantity</th>
                         
                         <!--<th style="width:10%;">Pending Quantity</th>-->
                         <!--<th style="width:10%;">Consume Quantity</th>-->
                         <!--<th style="width:10%;">Total PO Qty</th>-->
                        
                    </tr>
                    
                    <? 

                    $po_sql = mysqli_query($con1,"select * from new_sales_order_asset where so_trackid = '".$so_trackid."'");
                    
                    while($po_sql_result= mysqli_fetch_assoc($po_sql)){
                    $id = $po_sql_result['so_assetID'];
                    $asset_id =$po_sql_result['po_model']; 
                    
                    
                    ?>
                       <tr id="<? echo $id; ?>" pending_qty="<? echo get_avail_quantity($po_id,$id)?>"> 
                       
                 
                       
                        <td>
                            <? echo $po_sql_result['po_product']?>
                            
                        </td>
                       
                        <td>
                            <? echo get_asset_name($asset_id); ?>
                           
                        </td>
                       
                        <td>
                            <? echo $po_sql_result['po_rate']; ?>
                            <input type="text" name="po_rate[]" value="<? echo $po_sql_result['po_rate']?>" hidden>    
                        </td>
                        
                        <td>
                            <? echo $po_sql_result['po_warr']; ?>
                            <input type="text" name="po_warr[]" value="<? echo $po_sql_result['po_warr']?>" hidden>    
                        </td>
                        
                    <td style="width:10%;">
                         <input type="number" id="po_qty" class="po_qty <? echo $id;?>" value="<? echo $po_sql_result['po_qty']; ?>" readonly>
                             
                    </td>
                  
                        

                         
                        
                          </tr> 
                    <? } ?>
                
                 </table> 
<hr>



 
            <div class="row">
                
                <div class="col-md-3">
                    <span style="color:white">Is Installation required?</span>
<? $inst_req=$sql_result['inst_request'];
if($inst_req==1) { $inst= "Yes"; }
else if($inst_req==0) { $inst= "No"; }
?>
<input class="form-control" type="text" value="<? echo $inst ?>">                              
                </div>
                
                	<div class="col-md-3">	
						<span style="color:white">	DO Number:  </span>

					 <input class="form-control" type="text" value="<? echo $sql_result['DO_no'] ?>">
						</div>
						
						
                
                    <div class="col-md-3">
                        <span style="color:white">Is Buyback Available?</span>
    <?  if($sql_result['bb_available']==1) { $bb= "Yes"; } else if($sql_result['bb_available']==0) { $bb = "No"; } ?>
    
                        <input class="form-control" type="text" value="<? echo $bb ?>" >
						</div>
                           
                </div>
            </div>

<div class="row optional_input">
    
    <h4><label>Specify</label></h4>
    
    <div class="row">
        
        <div class="col-md-3">
             <div class="form-group">
                <label for="reports_to">Buyback Product</label>
                <input class="form-control" type="text" name="buyback_product" id="buyback_product" style="">
            </div>
        </div>

         <div class="col-md-3">
             <div class="form-group">
                <label for="reports_to">Buyback Cap</label>
                <input class="form-control" type = "text" name="buyback_cap" id="buyback_cap" maxlength="25">
            </div>
        </div>
        
         <div class="col-md-3">
             <div class="form-group">
                <label for="reports_to">Buyback Qty</label>
                <input class="form-control" type = "number" name="buyback_qty" id="buyback_qty" max="999">
            </div>
        </div>
        
         <div class="col-md-3">
             <div class="form-group">
                <label for="reports_to">Buyback Value</label>
                <input class="form-control" type = "number" name="buyback_value" id="buyback_value" max="999999">
            </div>
        </div>        
    </div>
    
</div>

<hr>

<div class="row">
    
    <div class="col-md-5">
            <label>Site / Sol / ATM ID</label>
            <input type="text" class="form-control" value="<? echo $demo_atm['atm_id']; ?> ">
            
    </div>
    

       <!-- <div class="col-md-2" id="is_same_check">
            <label style="display:block">Confirm Consignee</label>
            <div style="margin: auto; display: flex;">
                <input type="checkbox" id="same_customer" name="same_customer" > <span style="color:white; margin-left:10px;">Same as Buyer</span>    
            </div>   
        </div> -->
        
        
        <div class="col-md-5">
                <label>Consignee Name</label>
                <input type="text" class="form-control" value="<? echo $demo_atm['bank_name'];?>" >        
        </div>
 
    
</div>


<div class="row">
    <div class="col-md-3">
            <label>City</label>
            <input type="text" class="form-control" value="<? echo $demo_atm['city'];?>" > 
                 
    </div>
    
    <div class="col-md-3">
            <label>Area</label>
            <input type="text" class="form-control" value="<? echo $demo_atm['area'];?>" >      
    </div>
    
    <div class="col-md-3">
            <label>Address</label>
            <input type="text" class="form-control" value="<? echo $demo_atm['address'];?>" >       
    </div>
    
    <div class="col-md-3">
            <label>AVO Branch</label>
            <input type="text" class="form-control" value="<? echo get_branch_name($demo_atm['branch_id']);?>" > 
    
            
    </div>
</div>
<div class="row">
    <div class="col-md-3">
            <label>AVO State</label>
            
        <input type="text" class="form-control" value="<? echo $demo_atm['state'];?>" > 
        
 
    </div>
    
    <div class="col-md-2">
            <label>Pincode</label>
            <input type="text" class="form-control" id="pin" name="pincode" value ="<? echo $demo_atm['pincode'];?>" >        
    </div>
    
    <div class="col-md-2">
            <label>Contact Person Name</label>
            <input type="text" class="form-control" id="pin" name="pincode" value ="<? echo $sql_result['user_cont_name'];?>" >         
    </div>
    
    <div class="col-md-2">
            <label>Contact Person Mobile</label>
            <input type="text" class="form-control" id="pin" name="pincode" value ="<? echo $sql_result['user_cont_phone'];?>" >         
    </div>
    
    
    
    
    <div class="col-md-3">
            <label>E-Mail to</label>
            <input type="text" class="form-control" id="pin" name="pincode" value ="<? echo $sql_result['user_mail'];?>" >
               
    </div>
</div>



</form>
<? } ?>









 <script>
 
 
  $(document).ready(function(){
        $("input").prop("disabled", true);
        $("#site_branch, #state").prop("disabled", true);
    });
    
    
    
    

$("#is_buyback").on("change", function(e){

  if ($("#is_buyback").val() == "1")
 {


    $(".optional_input").addClass('show');
    $(".optional_input").removeClass('hide');


   }

else if($("#is_buyback").val() != "1"){
    $(".optional_input").removeClass('show');
    $(".optional_input").addClass('hide');


}
});


$('document').ready(function(){
    
    
    if ($('#insert_site').length){
        // alert('found');
    }
    else{
           $("#preocess_sales").append("<input type='hidden' name='insert_site' id='insert_site'>");
    }



    $('#check_all_product').click(function(){  
        
         var id = document.getElementsByClassName('po_qty');
         
         
        $('.select_product').prop('checked', true);
        $('.select_product').attr('checked', true);
        $(id).prop('readonly', false);
        $(id).css('background-color','white');
        $(id).css('border', '1px solid gray');
        
        
    });
    
    $('#check_partial_product').click(function(){      
        $('.select_product').prop('checked', false);  
        
         var id = document.getElementsByClassName('po_qty');
         
            $(id).prop('readonly', true);
            $(id).css('background-color','transparent');
            $(id).css('border', 'none');
         
    });

});
        
        
        
$("#same_customer").on("change", function(e){

  if ($("#same_customer").prop('checked') == false)
 {
 
    $("#preocess_sales").append("<input type='hidden' name='insert_site' id='insert_site'>");
    
    $(".optional_is_customer").addClass('show');
    $(".optional_is_customer").removeClass('hide');

$('#buyer_info').css("display","none");


	$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
        	
        	$("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
        		

		$("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
		$("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
		
		

   }

else if($("#same_customer").val() != true){
    
     $("#insert_site").remove();
    
    $(".optional_is_customer").removeClass('show');
    $(".optional_is_customer").addClass('hide');
    
    $('#buyer_info').css("display","block");
    
var cust_state = $.trim($("#cust_state").text());
var cust_branch = $.trim($("#cust_branch").text());

 $.ajax({
        type: "POST",
        url: 'get_cust_info.php',
        data: 'cust_state='+cust_state+'&cust_branch='+cust_branch,
        success:function(msg) {
               
        var returnedData = JSON.parse(msg);
        $('#site_branch').val(returnedData['branch_id']);
        $('#state').val(returnedData['state_id']);
                 
                 
        $("#consignee").val($.trim($("#consignee_name").text()));
        $("#city").val($.trim($("#cust_city").text()));
       // $("#area").val($.trim($("#cust_address").text()));
        $("#address").val($.trim($("#cust_address").text()));
        $("#pin").val($.trim($("#cust_pin").text()));
        
        $("#area,#city,#pin,#address,#consignee, #state").prop('readonly', true);
        $("#site_branch,#state").prop('disabled', true);
		$("#city, #area, #pin,#site_branch,#address,#consignee,#state").css('background','#a5a5a5');
		$("#city, #area,#pin,#site_branch,#state,#address,#consignee").css('color','white');
		
        
    }
        });






}
});


$("#buyback_cap").on("change",function(){
    
    if($("#buyback_cap").val().length>25 || $("#buyback_cap").val() < 0){
        alert('outrange');
        $("#buyback_cap").val('999');
    }
    
});

$(".po_qty").on("change",function(){
    
    
    var max_quantity = $(this).attr("max-quantity");

// alert(max_quantity);
    if($(this).val() > max_quantity ){
        
        alert('higher quantity');
        
            $(this).val(max_quantity);
        
    }
    
    
    
    
    if($(this).val() <= 0){
        alert('you cannot select less than zero !');
        $(this).val('1');
    }
    
    
});

$("#buyback_qty").on("change",function(){
    
    if($("#buyback_qty").val().length>3 || $("#buyback_qty").val() < 0){
        alert('outrange');
        $("#buyback_qty").val('');
    }
    
});


$("#buyback_value").on("change",function(){
    
    if($("#buyback_value").val().length>3 || $("#buyback_value").val() < 0){
        alert('outrange');
        $("#buyback_value").val('999999');
    }
    
});



$(".total_qty").on("load",function(){


    // alert($(this).val());
    
});


// available_qty




$(".select_product").change(function() {
    
        if(this.checked) {
            
            var id = document.getElementsByClassName($(this).val());
                $(id).attr('name',"po_qty[]");
                $(id).prop('readonly', false);
                
                $(id).css('background-color','white');
                $(id).css('border', '1px solid gray');
                     
                  
        }
        else{
            
             var id = document.getElementsByClassName($(this).val());    
                $(id).removeAttr('name');
                $(id).prop('readonly', true);
                    
                $(id).css('background-color','transparent');
                        $(id).css('border', 'none');

        }
});



$(document).ready(function(){
   
    atm=document.getElementById('atm').value;
    
    if(! atm){
        alert('enter something !');
        	
        	$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
        	
        	$("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
        		

		$("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
		$("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
    }
    else{
         $.ajax({
           type: "POST",
           url: 'get_custom_atmdetails.php',
           data: 'atm='+atm,
           success:function(msg) {

            if(msg !=0){
                
                
                 $("#insert_site").remove();
                            var returnedData = JSON.parse(msg);

                $('#consignee').val(returnedData['consignee']);
                $('#city').val(returnedData['city']);
               
                
                // alert(returnedData['state']);
                $('#pin').val(returnedData['pincode']);
                $('#area').val(returnedData['area']);
                $('#address').val(returnedData['address']);
                $('#site_branch').val(returnedData['branch']);
                 $('#state').val(returnedData['state']);

                console.log(msg);
                
                 $("#is_same_check").css('display','none');
			    
			    
		$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', true);
        $("#site_branch,#state").prop('disabled', true);
		$("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','#a5a5a5');
		$("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','white');
			
                
            }
            else{
                alert('No such ATM');
                
                
                $("#preocess_sales").append("<input type='hidden' name='insert_site' id='insert_site'>");
                
                
                $("#same_customer").prop('checked',false);    
                $("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
                $("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
                $("#is_same_check").css('display','block');

                $("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
                $("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
            }
    
                
            }
        });
    }
 
   
    
});
    
    

</script>

</div>
</body>
</html>