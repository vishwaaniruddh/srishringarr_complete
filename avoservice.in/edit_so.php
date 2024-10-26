<?php session_start();
include("access.php");
include('config.php');
include("menubar.php"); 



function get_so_data($parameter,$id){
    

    global $con1;


    $sql = mysqli_query($con1,"select $parameter from new_sales_order where so_trackid ='".$id."'");

    $sql_result = mysqli_fetch_assoc($sql);

    $result = $sql_result[$parameter];
    
    return $result;
    
}


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
    
    $sql = mysqli_query($con1,"SELECT * FROM po_consumption where po_trackid='".$po."' and so_assetID='".$product."'");
    
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




function get_total_qty($so_assetID){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from po_consumption where so_assetID='".$so_assetID."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['po_qty'];
}



function get_demo_atm($parameter,$id){
    global $con1;
    
    $sql = mysqli_query($con1,"select $parameter from demo_atm where atm_id='".$id."' order by track_id desc");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
}




?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Sales Order </title>
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
     
     
     
    $check_sql = mysqli_query($con1,"select * from new_sales_order where so_trackid='".$so_trackid."'");
    
    $check_sql_result = mysqli_fetch_assoc($check_sql);
    
    
    $status = $check_sql_result['status'];
    
    // return;
    
    
    if($status==1){
        
    
    
    
    $sql = mysqli_query($con1,"select * from new_sales_order where so_trackid='".$so_trackid."'");
         
    $sql_result=mysqli_fetch_assoc($sql);

    $buyerid = $sql_result['buyerid']; 
    $po_id = $sql_result['po_trackid'];
?>
     <div class="container-fluid" style="margin: 5% 1%;">
         

             <?
             

$buyer_sql = mysqli_query($con1,"select * from buyer where buyer_ID = '".$buyerid."'");
    
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
<form action="process_edit_so.php?id=<? echo $so_trackid;?>" method="POST" id="preocess_sales">
                
            
        <div class="row">
            <div class="col-md-5 cust_column">
                <input type="radio" class="form-control custom_radio" id="check_all_product" name="select_product_type" > <span style="color:white;margin: auto 2%;">Select All</span>
        <input type="radio" class="form-control custom_radio" id="check_partial_product" name="select_product_type" checked>
        <span style="color:white;margin: auto 2%;">Select Partials</span>
            </div>
                        <div class="col-md-3">
                          <label>Billing To
                          

                          </label>
           <select id="delivered_to" class="form-control" name="delivered_to" required>
                            <option  value="">Select</option>
                            <?php
                            $branch_qry = mysqli_query($con1,"select * from avo_branch");
                            while ($avo_branch = mysqli_fetch_assoc($branch_qry)) { ?>
                              
                              <option value = '<?php echo $avo_branch["id"]; ?>'
                            
                                  <?php if($avo_branch['id']==get_so_data('branch_id',$so_trackid)){ echo 'selected';} ?> > <?php echo $avo_branch["name"]; ?>
                            
                              </option>
                            
                            <?php } ?>
                        </select>
            </div>
            

        <input type="hidden" value="<? echo $po_id; ?>" name="po_id">
                 <table class="table table-striped table-bordered">
                      <!--Hidden fields-->
                            <input type="hidden" value="<? echo $buyerid; ?>" name="buyerid">
                           
                            <input type="hidden" value="<? echo $custid; ?>" name="cust_id">
                            <input type="hidden" value="<? echo $_POST['po_no']; ?>" name="purchase_order">

                        <!--end hidden fields-->
                     <tr>
                         <th width="1%">Select</th>
                         <th>Products</th>
                         <th style="width:20%;">Model</th>
                         
                         
                         <th style="width:10%;">Order Quantity</th>
                         
                         <th style="width:10%;">Pending Quantity</th>
                         <th style="width:10%;">Consume Quantity</th>
                         <th style="width:10%;">Total PO Qty</th>
                        
                    </tr>
                    
                    <? 
                    $po_sql = mysqli_query($con1,"select * from new_sales_order_asset where so_trackid = '".$so_trackid."'");
                    
                    while($po_sql_result= mysqli_fetch_assoc($po_sql)){
                    $id = $po_sql_result['so_assetID'];
                    $asset_id =$po_sql_result['po_model']; 
                    
                    
                    ?>
                       <tr id="<? echo $id; ?>" pending_qty="<? echo get_avail_quantity($po_id,$id)?>"> 
                       
                       <td style="display: flex; justify-content: center;">
                           <input class="select_product" name="select_product[]" class="checkbox_ck" id="check_product" value="<? echo $id; ?>" type="checkbox">
                       </td>
                       
                        <td>
                            <? echo $po_sql_result['po_product']?>
                            
                        </td>
                       
                        <td>
                            <? echo get_asset_name($asset_id); ?>
                           
                        </td>
                       
                       
                    <td style="width:10%;">
                         <input type="number" id="po_qty" class="po_qty <? echo $id;?>" value="<? echo $po_sql_result['po_qty']; ?>" readonly>
                             
                    </td>
                  
                        

                         <td style="width:10%;">
                             
                            <label style="color:black" id="available_qty">
                                <?
                                echo get_avail_quantity($po_id,$id);
                                ?>
                            </label>
                         </td>
                         
                         <td style="width:10%;">


                           <? echo get_consume_quantity($po_id,$id)?>
                            
                         </td>
                         
                        <td class="total_qty">
                            <label style="color:black" id="total_qty" value="<? echo get_total_qty($id); ?>"><? echo get_total_qty($id); ?></label>

                        </td>
                         
                        
                          </tr> 
                    <? } ?>
                
                 </table> 
<hr>




 
            <div class="row">
                
                <div class="col-md-3">
                        <span style="color:white">Delivery Type</span>
                        <select id="del_type" class="form-control" name="del_type">  
                              <option value="">Select</option>
                                <option value="site_del" <? if(get_so_data('del_type',$so_trackid)=='site_del' ){ echo 'selected'; } ?>> 
                                Site delivery
                                </option>
                                <option value="ware_del" <? if(get_so_data('del_type',$so_trackid)=='ware_del' ){ echo 'selected'; } ?>> 
                                Warehouse                                </option>
                              
                              <option value="opex" <? if(get_so_data('del_type',$so_trackid)=='opex' ){ echo 'selected'; } ?>> Opex</option>
                                
                                <option value="stock_trfr" <? if(get_so_data('del_type',$so_trackid)=='stock_trfr' ){ echo 'selected'; } ?>> 
                                Stock Transfers                                </option>
                             
                        </select>      
                </div>
                
                
                <div class="col-md-3">
                    <span style="color:white">Is Installation required?</span>

                              
    <select id="custer_vertical" class="form-control" name="is_install">  
                                  
                                
<option value="">Select</option>
<option value="1" <? if(get_so_data('inst_request',$so_trackid)==1 ){ echo 'selected'; } ?> > Yes</option>
<option value="0" <? if(get_so_data('inst_request',$so_trackid)==0 ){ echo 'selected'; } ?> > No</option>
                                
                        </select>        
                </div>
                
                	<div class="col-md-3">	
						<span style="color:white">	DO Number:  </span>

					 <input class="form-control" type="text" name="do_no" id="do_no" value="<? echo get_so_data('DO_no',$so_trackid) ?>">
						</div>
						
						
                
                    <div class="col-md-3">
                        <span style="color:white">Is Buyback Available?</span>
                        <select id="is_buyback" class="form-control" name="buyback">  
                              <option value="">Select</option>
                                <option value="1" <? if(get_so_data('bb_available',$so_trackid)==1 ){ echo 'selected'; } ?>> Yes</option>
                                <option value="0" <? if(get_so_data('bb_available',$so_trackid)==0 ){ echo 'selected'; } ?>> No</option>
                        </select>      
                </div>
            </div>
            
<!--  Buyback edit------------>

<?php 
if(get_so_data('bb_available',$so_trackid)==1) { 

$bbqry=mysqli_query($con1,"Select * from new_buyback where so_trackid='".$so_trackid."'");
while($bbrow=mysqli_fetch_row($bbqry)){
?>
    <h4><label>Specify</label></h4>
    
    <div class="row">
        
        <div class="col-md-3">
             <div class="form-group">
                <label for="reports_to">Buyback Product</label>
                <input class="form-control" type="text" name="buyback_product" id="buyback_product" value="<?php echo $bbrow[3];?>">
            </div>
        </div>

         <div class="col-md-3">
             <div class="form-group">
                <label for="reports_to">Buyback Cap</label>
                <input class="form-control" type = "text" name="buyback_cap" id="buyback_cap" maxlength="25" value="<?php echo $bbrow[4];?>">
            </div>
        </div>
        
         <div class="col-md-3">
             <div class="form-group">
                <label for="reports_to">Buyback Qty</label>
                <input class="form-control" type = "number" name="buyback_qty" id="buyback_qty" max="999" value="<?php echo $bbrow[5];?>">
            </div>
        </div>
        
         <div class="col-md-3">
             <div class="form-group">
                <label for="reports_to">Buyback Value</label>
                <input class="form-control" type = "number" name="buyback_value" id="buyback_value" max="999999" value="<?php echo $bbrow[6];?>">
            </div>
        </div>        
    </div>
    
<?php    
}
}
?>
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
    
    <? $atm_id =  get_so_data('atm_id',$so_trackid); ?>
    <div class="col-md-5">
            <label>Site / Sol / ATM ID</label>
            <input type="text" class="form-control" value="<? echo $atm_id; ?> " readonly>
  
            
    </div>
    

        <div class="col-md-5">
                <label>Consignee Name</label>
                <input type="text" class="form-control" value="<? echo get_demo_atm('bank_name',$atm_id); ?>" id="consignee" name="consignee_name" placeholder="Consignee Name">        
        </div>
        
</div>


<div class="row">
    <div class="col-md-3">
            <label>City</label>
            <input type="text" class="form-control" id="city" value="<? echo get_demo_atm('city',$atm_id);?>" name="city" placeholder="City">        
    </div>
    
    <div class="col-md-3">
            <label>Area</label>
            <input type="text" class="form-control" id="area" value="<? echo get_demo_atm('area',$atm_id);?>" name="area" placeholder="Area">        
    </div>
    
    <div class="col-md-3">
            <label>Address</label>
            <input type="text" class="form-control" id="address" value="<? echo get_demo_atm('address',$atm_id);?>" name="address" placeholder="Address">        
    </div>
    
    <div class="col-md-3">
            <label>AVO Branch</label>
           
        
           <select id="site_branch" class="form-control" name="site_branch">
                            <option  value="">Select</option>
                            <?php
                            $branch_qry = mysqli_query($con1,"select * from avo_branch");
                            while ($avo_branch = mysqli_fetch_assoc($branch_qry)) { ?>
                              
                              <option value = '<?php echo $avo_branch["id"]; ?>'
                            
                                  <?php if($avo_branch['id']==  get_demo_atm('branch_id',$atm_id) ){ echo 'selected';} ?> > <?php echo $avo_branch["name"]; ?>
                            
                              </option>
                            
                            <?php } ?>
                        </select> 
                        
            
            
    </div>
</div>
<div class="row">
    <div class="col-md-3">
            <label>AVO State</label>

            <select id="state" class="form-control"  name="state" >
                            <option  value="">Select</option>
                            <?php
                            $state_qry = mysqli_query($con1,"select * from state");
                            while ($state = mysqli_fetch_assoc($state_qry)) { ?>
                            
                                <option value = "<?php echo $state['state_id'];?>"
                                <?php if(trim($state['state']) == get_demo_atm('state',$atm_id) ){ echo 'selected';} ?> >
                                     <?php echo $state["state"]; ?>
                                </option>
                                
                            <?php } ?>
                        </select>
                        
    </div>
    
    <div class="col-md-2">
            <label>Pincode</label>
            <input type="text" class="form-control" id="pin" value="<? echo get_demo_atm('pincode',$atm_id);?>" name="pincode" placeholder="Pincode" >        
    </div>
    
    <div class="col-md-2">
            <label>Contact Person Name</label>
            <input type="text" class="form-control" name="contact_person_name" placeholder="Contact Person Name" value="<? echo get_so_data('user_cont_name',$so_trackid); ?>">         
    </div>
    
    <div class="col-md-2">
            <label>Contact Person Mobile</label>
            <input type="text" class="form-control" name="contact_person_mobile" placeholder="Contact Person Mobile" value="<? echo get_so_data('user_cont_phone',$so_trackid); ?>">         
    </div>
    
    
    
    
    <div class="col-md-3">
            <label>E-Mail to</label>
            <input type="email" class="form-control" name="email_to" placeholder="E-Mail to" value="<? echo get_so_data('user_mail',$so_trackid); ?>">        
    </div>
</div>


<div class="row submit_btn">

    <? if($buyer_sql_result){ ?>
    
    <input type="submit" class="form-control btn btn-primary" name="submit" value="Update Sales Order">
    
    <? } ?>
</div>


</form>
<? } ?>









 <script>
 
 
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


// 	$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
        	
        	$("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
        		

// 		$("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
// 		$("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
		
		

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
        
        // $("#area,#city,#pin,#address,#consignee, #state").prop('readonly', true);
        // $("#site_branch,#state").prop('disabled', true);
// 		$("#city, #area, #pin,#site_branch,#address,#consignee,#state").css('background','#a5a5a5');
// 		$("#city, #area,#pin,#site_branch,#state,#address,#consignee").css('color','white');
		
        
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

function getallatm(){
       
atm=document.getElementById('atm').value;
    
    if(! atm){
        alert('enter something !');
        	
        // 	$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
        	
        	$("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
        		
        // 	 $("#site_branch,#state").prop('disabled', false);
// 		$("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
// 		$("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
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

                // console.log(msg);
                
                //  $("#is_same_check").css('display','none');
			    
			    
// 		$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', true);
        // $("#site_branch,#state").prop('disabled', true);
// 		$("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','#a5a5a5');
// 		$("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','white');
        
        		$("#atm").prop('readonly', true);
        $("#atm").css('background','#a5a5a5');
        $("#atm").css('color','white');
                
            }
            else{
                alert('No such ATM');
                
                
                $("#preocess_sales").append("<input type='hidden' name='insert_site' id='insert_site'>");
                
                
                $("#same_customer").prop('checked',false);    
                // $("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
                $("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
                $("#is_same_check").css('display','block');
                // $("#site_branch,#state").prop('disabled', false);
                // $("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
                // $("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
            }
    
                
            }
        });
    }

}


// $(document).ready(function(){

// getallatm();
    
// });
    
    

</script>

</div>
<? } 

else{ ?>
    <script>
        alert('Sorry ! This Sales Order Cannot be edited .');
        window.location.href="view_sales_order.php";
    </script>
    
<? }
?>
</body>
</html>