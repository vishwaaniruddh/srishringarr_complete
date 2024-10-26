<?php session_start();
include($_SERVER["DOCUMENT_ROOT"]."/CRM/side-top.php");
include($_SERVER["DOCUMENT_ROOT"]."/config.php");

// include($_SERVER["DOCUMENT_ROOT"]."/functions.php");


function get_cust_vertical_name($id){
    
    global $con;
    
    $sql=mysql_query("select * from customer where cust_id='".$id."'",$con);
    
    $sql_result = mysql_fetch_assoc($sql);
    
    $cust_vertical = $sql_result['cust_name'];
    
    return $cust_vertical;
}


function get_state_name($id){
    
    global $con;
    
    $sql=mysql_query("select * from state where state_id='".$id."'",$con);
    
    $sql_result = mysql_fetch_assoc($sql);
    
    $state_name = $sql_result['state'];
    
    return $state_name;
}


function get_branch_name($id){
    
    global $con;
    
    $sql=mysql_query("select * from avo_branch where id='".$id."'",$con);
    
    $sql_result = mysql_fetch_assoc($sql);
    
    $branch_name = $sql_result['name'];
    
    return $branch_name;
}



function get_asset_name($id){

    global $con;
    
    $sql = mysql_query("select * from assets_specification where ass_spc_id = '".$id."'",$con);
    
    $sql_result = mysql_fetch_assoc($sql);

    $asset_name = $sql_result["name"];
    
    return $asset_name;
    
}



function get_avail_quantity($po,$product){
    
    global $con;
    
    $sql = mysql_query("SELECT * FROM po_consumption where po_trackid='".$po."' and po_product='".$product."'",$con);
    
    if($sql_result = mysql_fetch_assoc($sql)){
        
        $available_quantity = $sql_result['po_qty'] - $sql_result['po_consumqty'];
    
        return $available_quantity;
    
    }
    else{
        return false;
    }
    
    
    
    
}

function get_consume_quantity($po,$product){
    
    global $con;
    
 
    $sql = mysql_query("SELECT * FROM po_consumption where po_trackid='".$po."' and po_product='".$product."'",$con);
    
    
    if($sql_result = mysql_fetch_assoc($sql)){
    
        $consume_quantity = $sql_result['po_consumqty'];
    
        return $consume_quantity;    
    }
    else{
        return 0;
    }
    
    
    
    
}

?>


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
.custom_row{
    background: antiquewhite;
    padding: 5%;
}
      </style>



     <?   
     $purchase_id = $_GET['id'];
     
     if($purchase_id){
         
         
         $get_puchase_order_sql = mysql_query("select * from crm_purchase_order where id='".$purchase_id."'",$crm_con);
         
         $get_puchase_order_sql_result = mysql_fetch_assoc($get_puchase_order_sql);
         
         
        //  var_dump($get_puchase_order_sql_result);
         $purchase_order =$get_puchase_order_sql_result['po_no'];
         
          $sql= "select * from crm_purchase_order where po_no LIKE '%".$purchase_order."%'";
         
         $sql = mysql_query($sql,$crm_con);
     }
     
     else if(!empty($_POST['po_no'])){
                
                $k = $_POST;
                $sliced = array_slice($k, 0, -1);
                
                if(isset($sliced)){
                    
                    $i = 0;
                    $string = '';
                    $statement= "select * from crm_purchase_order where";
                    foreach($sliced as $key=>$val){
                        
                        if($val){
                            
                            if($key=='po_no'){ 
                                
                                 $statement .=" $key LIKE '%".$val."%'";
                                
                                  $statement .= " and";

                            }
                            else{
                                
                                $statement .=" $key='".$val."'";
                                
                                $statement .= " and";

                            }
                        }
                        
                    }   
                }


    $statement = substr($statement, 0, strlen($statement)-3);
   
    $statement .= " order by id desc";
    $sql = $statement;
    
    // echo $sql;
    
    $sql = mysql_query($sql);
    
    // Counting Rows for pagination
    
    $result = mysql_query($statement,$crm_con);
    $total_rows = mysql_num_rows($result);    
  
} 


$sql_result=mysql_fetch_assoc($sql);

$custid= $sql_result['cust_id'];
    
    $po_id = $sql_result['id'];
    $po_no = $sql_result['po_no'];
    
    $buyerid = $sql_result['buyer_id']; 
?>



<div class="container">
	
<div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">

                                Add Purchase Order Details 
                            </h5>

                        </div>


<div class="row">	




     <div class="container-fluid" style="margin: 5% 1%;">
         
                <div class="search_fields" >
                    
                    <form class="form-inline" method="POST">    
                        
                    <div class="form-group col-md-5">
                    <label for="staticEmail2" class="sr-only">PO_NO</label>
                    <input type="text"  class="form-control" id="po_no" name="po_no" value="<?= $po_no; ?>" placeholder="PO Number OR OAN Number ">
                    </div>
                   

                    
                    <input class="btn btn-success" type="submit" name="search" value="Search">
                    
                    </form>
                </div>
             
             
             <?
$buyer_sql = mysql_query("select * from buyer where buyer_ID = '".$buyerid."'",$con);
    
    if($buyer_sql_result=mysql_fetch_assoc($buyer_sql)){
    
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
                         <span  id= "consignee_name" ><? echo $buyer_sql_result['buyer_name']; ?>
                        </span>
                       </div>
                        
                        <div class="col-md-3">
                        <label> Customer Vertical </label>
                         <span id="cust_vertical"><? echo $cust_vertical; ?>
                        </span>
                       </div>
                      
                      <div class="col-md-3">
                        <label> Branch Name </label>
                         
                            <span id="cust_branch"><? echo $branch_name; ?>
                        </span>
                                                  
                     </div>
                     
                     <div class="col-md-3">
                         <label>
                             City
                         </label>
                          <span id="cust_city"><? echo $buyer_sql_result['buyer_city'] ;?></span>
                     </div>
                     
                     <div class="col-md-3">
                         <label> Address </label>
                         <span id="cust_address">
                          <? echo $buyer_sql_result['buyer_address'];?>   
                         </span>
                          
                     </div>
                     <div class="col-md-3">
                         <label> State </label>
                          <span id="cust_state">
                          <? echo $state_name;?>    
                          </span>
                          
                     </div>
                     
                       <div class="col-md-3">
                         <label>
                             Pincode
                         </label>
                          <span id="cust_pin">
                          <? echo $buyer_pin;?>    
                          </span>
                          
                     </div>
                     
                     
                     <div class="col-md-3">
                         <label>
                             GST No.
                         </label>
                         <span id="cust_gst">
                          <? echo $buyer_sql_result['buyer_gst'];?>   
                         </span>
                          
                     </div>
                     
                 </div>
                 
                 <hr>
             </div>
             
             <? }
             else if($_POST['po_no'] && !$buyer_sql_result){
                 echo 'No Buyer Info';
             }
             
             ?>
             
<? if($sql){ ?> 

            
        <div class="row">
            <div class="col-md-5 cust_column">
                <input type="radio" class="form-control custom_radio" id="check_all_product" name="select_product_type" > <span style="margin: auto 2%;">Select All</span>
        <input type="radio" class="form-control custom_radio" id="check_partial_product" name="select_product_type" checked>
        <span style="margin: auto 2%;">Select Partials</span>
            </div>
        </div>
        

                                
    <form action="process_sales_order.php" method="POST" id="preocess_sales">
                
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
                         <th style="width:10%;">Cap</th>
                         
                         <th style="width:10%;">Order Quantity</th>
                         
                         <th style="width:10%;">Pending Quantity</th>
                         <th style="width:10%;">Consume Quantity</th>
                         <th style="width:10%;">Total PO Qty</th>
                        
                    </tr>
                    
                    <? 

                    $po_sql = mysql_query("select * from crm_po_assets where po_no = '".$po_no."'",$crm_con);
                    
                    while($po_sql_result= mysql_fetch_assoc($po_sql)){
                    $id = $po_sql_result['assettrack_id'];
                    $asset_id =$po_sql_result['specs']; 
                    
                    
                    ?>
                       <tr id="<? echo $id; ?>" pending_qty="<? echo get_avail_quantity($po_id,$id)?>"> 
                       
                       <td style="display: flex; justify-content: center;">
                           <input class="select_product" name="select_product[]" class="checkbox_ck" id="check_product" value="<? echo $id; ?>" type="checkbox">
                       </td>
                       
                        <td>
                            <? echo $po_sql_result['assets_name']?>
                            
                        </td>
                       
                        <td>
                            <? echo get_asset_name($asset_id); ?>
                           
                        </td>
                       
                        <td>
                            <? echo $po_sql_result['po_capacity']?>
                            <input type="text" name="po_capacity[]" value="<? echo $po_sql_result['po_capacity']?>" hidden>    
                        </td>
                        
                        <td style="width:10%;">
                             <input type="number" id="po_qty" class="po_qty <? echo $id;?>" value="<? echo get_consume_quantity($po_id,$id) ? get_avail_quantity($po_id,$id) : $po_sql_result['qty']; ?>"  max-quantity="<? echo get_consume_quantity($po_id,$id) ? get_avail_quantity($po_id,$id) : $po_sql_result['qty']; ?>" readonly>
                             
                        </td>
                  
                        

                         <td style="width:10%;">
                             
                            <label style="color:black" id="available_qty">
                                <?
                                 if(get_consume_quantity($po_id,$id) != false){

                                echo get_avail_quantity($po_id,$id);
                            }
                            else{
                                echo $po_sql_result['qty'];
                            }
                                ?>
                            </label>
                         </td>
                         
                         <td style="width:10%;">


                           <? echo get_consume_quantity($po_id,$id)?>
                            
                         </td>
                         
                        <td class="total_qty">
                            <label style="color:black" id="total_qty" value="<? echo $po_sql_result['qty']?>"><? echo $po_sql_result['qty']?></label>

                        </td>
                         
                        
                          </tr> 
                    <? } ?>
                
                 </table> 
<hr>
            <div class="row">
                
                <div class="col-md-3">
                        <span>Delivery Type</span>
                        <select id="del_type" class="form-control" name="del_type">  
                              <option value="">Select</option>
                                <option value="site_del"> Site </option>
                                <option value="ware_del"> Warehouse</option>
                        </select>      
                </div>
                
                
                <div class="col-md-3">
                    <span>Is Installation required?</span>
                        <select id="custer_vertical" class="form-control" name="is_install">  
                              <option value="">Select</option>
                                <option value="1"> Yes</option>
                                <option value="0"> No</option>
                        </select>        
                </div>
                
                	<div class="col-md-3">	
						<span>	DO Number:  </span>

					 <input class="form-control" type="text" name="do_no" id="do_no" max="999">
						</div>
						
						
                
                    <div class="col-md-3">
                        <span>Is Buyback Available?</span>
                        <select id="is_buyback" class="form-control" name="buyback">  
                              <option value="">Select</option>
                                <option value="1"> Yes</option>
                                <option value="0"> No</option>
                        </select>      
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
            <input type="text" class="form-control" name="site_id" id="atm" placeholder="Site / Sol / ATM ID" required>
            <input type="button" name="getdata" id="getdata" value="GET" onclick="getallatm();" /></td>
    </div>
    

<? if($buyer_sql_result){ ?>
    

        <div class="col-md-2" id="is_same_check">
            <label style="display:block">Confirm Consignee</label>
            <div style="margin: auto; display: flex;">
                <input type="checkbox" id="same_customer" name="same_customer" > <span style="color:white; margin-left:10px;">Same as Buyer</span>    
            </div>   
        </div>
<? } ?>        
        
        <div class="col-md-5">
                <label>Consignee Name</label>
                <input type="text" class="form-control" id="consignee" name="consignee_name" placeholder="Consignee Name" required>        
        </div>
        
    
        
    
    
    
</div>


<div class="row">
    <div class="col-md-3">
            <label>City</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>        
    </div>
    
    <div class="col-md-3">
            <label>Area</label>
            <input type="text" class="form-control" id="area" name="area" placeholder="Area" required>        
    </div>
    
    <div class="col-md-3">
            <label>Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>        
    </div>
    
    <div class="col-md-3">
            <label>AVO Branch</label>
           
            <!--<input type="text" class="form-control" name="avo_branch" placeholder="AVO Branch">-->
            
           <select id="site_branch" class="form-control" name="avo_branch" required>
                            <option  value="">Select</option>
                            <?php
                            $branch_qry = mysql_query("select * from avo_branch",$con);
                            while ($avo_branch = mysql_fetch_assoc($branch_qry)) { ?>
                              
                              <option value = '<?php echo $avo_branch["id"]; ?>'
                            
                                  <?php if($avo_branch['id']==$avo_branc){ echo 'selected';} ?> > <?php echo $avo_branch["name"]; ?>
                            
                              </option>
                            
                            <?php } ?>
                        </select> 
                        
            
            
    </div>
</div>
<div class="row">
    <div class="col-md-3">
            <label>AVO State</label>
            
            <select id="state" class="form-control"  name="state" required>
                            <option  value="">Select</option>
                            <?php
                            $state_qry = mysql_query("select * from state",$con);
                            while ($state = mysql_fetch_assoc($state_qry)) { ?>
                            
                                <option value = '<?php echo $state['state_id'];?>'
                                
                                    <?php if($state['state_id']==$buyer_state){ echo 'selected';} ?> > <?php echo $state["state"]; ?>
                                
                                </option>
                                
                            <?php } ?>
                        </select>
                        
    </div>
    
    <div class="col-md-2">
            <label>Pincode</label>
            <input type="text" class="form-control" id="pin" name="pincode" placeholder="Pincode" required>        
    </div>
    
    <div class="col-md-2">
            <label>Contact Person Name</label>
            <input type="text" class="form-control" name="contact_person_name" placeholder="Contact Person Name" required>        
    </div>
    
    <div class="col-md-2">
            <label>Contact Person Mobile</label>
            <input type="text" class="form-control" name="contact_person_mobile" placeholder="Contact Person Mobile" required>        
    </div>
    
    
    
    
    <div class="col-md-3">
            <label>E-Mail to</label>
            <input type="email" class="form-control" name="email_to" placeholder="E-Mail to" required>        
    </div>
</div>

<div class="row submit_btn">
    <input type="submit" class="form-control btn btn-primary" name="submit" value="Create Sales Order">
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


	$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
        	
        	$("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
        		
        	 $("#site_branch,#state").prop('disabled', false);
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
        url: '../../get_cust_info.php',
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
        
        $("#area,#city,#pin,#address,#consignee").prop('readonly', true);
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
    
    
    var max_quantity = $(this).attr('max-quantity');
    var this_value = $(this).val();
    
    max_quantity = parseInt(max_quantity);
    this_value = parseInt(this_value);





    if(this_value > max_quantity){
        
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
    
    if($("#buyback_value").val().length > 5 || $("#buyback_value").val() < 0){
        alert('outrange');
        $("#buyback_value").val('');
    }
    
});



$(".total_qty").on("load",function(){


    alert($(this).val());
    
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
        	
        	$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
        	
        	$("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
        		
        	 $("#site_branch,#state").prop('disabled', false);
		$("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
		$("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
    }
    else{
         $.ajax({
           type: "POST",
           url: '../../get_custom_atmdetails.php',
           data: 'atm='+atm,
           success:function(msg) {

            if(msg !=0){
                
                
                 $("#insert_site").remove();
                            var returnedData = JSON.parse(msg);

                $('#consignee').val(returnedData['consignee']);
                $('#city').val(returnedData['city']);
               
                
                // alert(returnedData['state']);
                
                var retVal =  confirm("Found this ATM ID ! Want to continue with this ATM ID ?");
                
        if (retVal == true)
        {

            
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
        if (retVal == false)
        {

            
            $("#atm").val('');
            
                $("#preocess_sales").append("<input type='hidden' name='insert_site' id='insert_site'>");
                
                
                $("#same_customer").prop('checked',false);    
                $("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
                $("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
                $("#is_same_check").css('display','block');
                $("#site_branch,#state").prop('disabled', false);
                $("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
                $("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
                
                

        }  
                
                
                
                
            }
            else{
                alert('No such ATM ! Create a new One ..');
                
                
                $("#preocess_sales").append("<input type='hidden' name='insert_site' id='insert_site'>");
                
                
                $("#same_customer").prop('checked',false);    
                $("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
                $("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
                $("#is_same_check").css('display','block');
                $("#site_branch,#state").prop('disabled', false);
                $("#city,#atm, #area, #pin,#site_branch,#address,#consignee,#state").css('background','white');
                $("#city, #atm, #area,#pin,#site_branch,#state,#address,#consignee").css('color','black');
            }
    
                
            }
        });
    }
    
}

</script>

</div>
</main>



</body>
</html>