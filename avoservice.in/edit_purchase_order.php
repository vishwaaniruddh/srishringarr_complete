<?php session_start();
include("access.php");
include('functions.php');
include('config.php');




$po_id = $_GET['id']; 


if(!$po_id){ ?>
   
   <script>
      window.location.href="view_purchase_order.php";
       alert('No Purchase Order Found !');

    
   </script>
    
<? return; }

$po_sql =mysqli_query($con1,"select * from purchase_order where id='".$po_id."'");

$po_sql_result = mysqli_fetch_assoc($po_sql);




$stored_po_no =$po_sql_result['po_no']; 
$stored_no_sites =$po_sql_result['no_sites']; 
$stored_cust_id =$po_sql_result['cust_id']; 
$stored_ref_id =$po_sql_result['ref_id']; 
$stored_pm =$po_sql_result['pm']; 
$stored_po_date =$po_sql_result['po_date']; 
$stored_ed =$po_sql_result['ed']; 
$stored_del_type =$po_sql_result['del_type']; 
$stored_id =$po_sql_result['id']; 
$stored_buyeraddress =$po_sql_result['buyeraddress']; 
$stored_gst =$po_sql_result['gst']; 
$stored_salesperson =$po_sql_result['salesperson']; 
$stored_po_OAN_no =$po_sql_result['po_OAN_no']; 
$stored_buyer_id =$po_sql_result['buyer_id']; 
$stored_po_time =$po_sql_result['po_time']; 
$stored_po_raiseby =$po_sql_result['po_raiseby']; 
$stored_po_mode =$po_sql_result['po_mode']; 
$stored_po_tat =$po_sql_result['po_tat']; 
$stored_po_payment =$po_sql_result['po_payment']; 
$stored_po_remarks =$po_sql_result['po_remarks']; 
$stored_po_status =$po_sql_result['po_status']; 
$stored_other_charge =$po_sql_result['other_charge']; 
$stored_non_standard_item_product =$po_sql_result['non_standard_item_product']; 
$stored_branch_id =$po_sql_result['branch_id']; 
$stored_created_by =$po_sql_result['created_by']; 





$po_get_sql = mysqli_query($con1,"select count(*) as fetch_count from po_assets where po_trackid='".$stored_id."'");

$po_get_sql_result = mysqli_fetch_assoc($po_get_sql);

$asset_count = $po_get_sql_result['fetch_count'];










$product_sql = mysqli_query($con1,"select * from assets");
while($product_sql_result = mysqli_fetch_assoc($product_sql)){
    
    $id = $product_sql_result['assets_id'];
    $name =$product_sql_result['assets_name'];
    
    $data[] = ['id'=>$id,'name'=>$name];
    
}


$data =  json_encode($data);




$model_sql = mysqli_query($con1,"select * from assets_specification order by ass_spc_id asc
");
while($model_sql_result = mysqli_fetch_assoc($model_sql)){
    
    $id2 = $model_sql_result['ass_spc_id'];
    $asset_id = $model_sql_result['assets_id'];
    $name2 = $model_sql_result['name'];
    
    $data2[] = ['id'=>$id2,'fk'=>$asset_id,'name'=>$name2];
    
}

$data2 = json_encode($data2);






function customer_vertical_id($name){
    
    global $con;
    
    $sql= mysqli_query($con1,"select * from customer where cust_name='".$name."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['cust_id'];
}



        if($_SESSION['designation']==5){
            
            $customer_qry = mysqli_query($con1,"select * from clienthandle where logid='".$_SESSION['logid']."'");
            
        }
        else{
            
            $customer_qry = mysqli_query($con1,"select * from customer");
            
            
        }
        
        
        
        
        
$get_buyer = $_GET['id'];


$executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where status='1'");

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
//var_dump($_SESSION);

    $sql_buyer = mysqli_query($con1,"select * from buyer where status = 1");
    /*$result = mysqli_fetch_assoc($sql_buyer);
    var_dump($result['buyer_name']);*/
   
    $sql_customer = mysqli_query($con1,"select * from customer ");
    //$result = mysqli_fetch_assoc($sql);


    $sql_assets = mysqli_query($con1,"select * from assets ");
    //$result = mysqli_fetch_assoc($sql);

    $sql_deliveryType = mysqli_query($con1,"select * from delivery_type where status = 1");
    //$result = mysqli_fetch_assoc($sql);

    $sql_sales = mysqli_query($con1,"select * from modeOfSales where status = 1");
    //$result = mysqli_fetch_assoc($sql);
    
    if(isset($_GET['id']) && $_GET['id']>0){
        $id = $_GET['id'];
        //echo $id;
        $purchase_details = mysqli_query($con1,'select * from buyer where buyer_id = "'.$id.'"');
        while($row = mysqli_fetch_assoc($purchase_details)){
           // $buyer_id = $_POST['buyer_ID'];
            $customer_vertical = $row['buyer_vertical']; 
            
            $sales_exe_name = $row['salesperson'];
            $modeOfSale = $row['po_mode'];
            
            $po_number = $row['po_no'];
            $po_date = $row['po_date']; 
            $delivery_type = $row['del_type'];
            $product = $row['product'];
            
            $model = $row['model'];
            $capacity = $row['capacity']; 
            $quantity = $row['quantity'];
            $basic_Price = $row['basic_Price'];
            
            $warranty = $row['warranty'];
            $non_std_product = $row['non_std_product']; 
            $other_charges = $row['other_charges'];
            $payment_term = $row['po_payment'];
            
            $tat = $row['po_tat'];
            $gst =$row['gst'];
            $remarks =$row['po_remarks'];
            
            $status = $row['po_status'];
        }
        
    } else {
        $id =0;
        
        $buyer_id = '';
        $customer_vertical = ''; 
        $sales_exe_name = '';
        $modeOfSale = '';
        
        $po_number = '';
        $po_date = ''; 
        $delivery_type = '';
        $product = '';
        
        $model = '';
        $capacity = ''; 
        $quantity = '';
        $basic_Price = '';
        
        $warranty = '';
        $non_std_product = ''; 
        $other_charges = $_POST['other_charges'];
        $payment_term = '';
        
        $tat = '';
        $gst ='';
        $remarks ='';
        
        $status = 1;
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>New Purchase Order </title>
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
   #custome_buyer_information,#buyer_information{
       color: white;
    text-align: left;
   }
   
   #buyer_information label,#custome_buyer_information label{
       width:30%;
   }
  #buyer_information span, #custome_buyer_information span{
       width:70%;
   }
   .add_heading{
       color:white;
   }
   .custom_inside_row{
       width:47%;
       display: flex;
    height: fit-content;
   }
   
   .custom_inside_row .span_label{
       width:98%;
       
   }
   html[xmlns] #menu-bar {
    display: block;
    z-index: 100000;
    position: relative;
}

   #header, #form1 table{
       width:80%;
   }
   
   body{
           background-color: #4D9494;
    margin-top: 20px;
    
   }
 
             .select-editable {
     position:relative;
     background-color:white;
     border:solid grey 1px;
     width:120px;
     height:18px;
 }
 .select-editable select {
     position:absolute;
     top:0px;
     left:0px;
     font-size:14px;
     border:none;
     width:120px;
     margin:0;
 }
 .select-editable input {
     position:absolute;
     top:0px;
     left:0px;
     width:100px;
     padding:1px;
     font-size:12px;
     border:none;
 }
 .select-editable select:focus, .select-editable input:focus {
     outline:none;
 }
        </style>

</head>

<body>
<center>
        <?
        if($_SESSION['designation']==5){

            include("AccountManager/menubar.php");
        }
        else{

          include("menubar.php");  
        }
        ?>



<h2 class="add_heading">Add Purchase Order Details </h2>

<div class="row">	


				<div class="col-xs-8">	
					<div id="header">
						<form action="process_purchase_order.php?action=edit&id=<? echo $stored_id; ?>" method="post" name="po" enctype="multipart/form-data" id="po">

						<div class="row">	
						<span class="span_label">	PO Number :</span>
						<input type="text" name="po_number" id="po_number" value="<?php echo $stored_po_no; ?>" readonly required/>
						</div>





						<div class="row">	
						
						<div class="custom_inside_row">
						    <span class="span_label">	Customer Vertical :</span>
	
						
						  <select id="customer_vertical" name="customer_vertical" id="customer_vertical" required>
                            <option  value="">Select</option>
                            <?php
                        
                        
                                while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { 
                        
                                if($_SESSION['designation']==5){
                                
                                $cust_id = customer_vertical_id($customer_vertical['client']);
                                ?> 
                                    
                                    
                                    
                                   <option value= "<?php echo $cust_id ?>" <?php if($cust_id == $stored_cust_id) {echo 'selected';}?> > <?php echo $customer_vertical["client"];?></option>
                                   
                                <? }
                                else{ ?>
                                    
                                     <option value= "<?php echo $customer_vertical['cust_id']; ?>" <?php if($customer_vertical['cust_id']==$stored_cust_id) {echo 'selected';}?> > <?php echo $customer_vertical["cust_name"];?></option>


                                <? } ?>
                                   

                                <?php } ?>
                        </select>
                        
                        

					</div>
					
						
						<div class="vertical_margin"></div>
				<div class="custom_inside_row">
				    	<span class="span_label" style="width: 35%;">	Buyer Name:</span>

						<input list="buyers" name="buyer" id="buyer_name" value="<? echo get_buyer('buyer_name',$stored_buyer_id);?>" required>
						
						<?
						if($stored_buyer_id){ ?>
						   
						   <input type="hidden" name="buyerID" id="buyerID" value="<? echo $stored_buyer_id; ?>" <?php echo $buyer_id; ?>>
						
						<? }
						else{ ?>
						<input type="hidden" name="buyerID" id="buyerID" <?php echo $buyer_id; ?> required>						    
						<? } ?>

						
						<datalist id="buyers" >

        			    <?

        			    if($stored_buyer_id){ ?>
        			        
        			        
        			        
			       <option selected value="<? echo get_buyer('buyer_name',$stored_buyer_id);?>" data-value="<? echo get_buyer('buyer_ID',$stored_buyer_id);?>"></option> 
        			        
        			    <? }
        			    ?>
        			    
						</datalist>
							<script>
							

							
						    $( "#buyer_name" ).change(function() {

                                var e =document.getElementById("buyerID").innerHTML;
                                
                               

                            });

						</script>
						
						
							
				</div>
                
        <a href="#" id="empty_buyer" style="color:white;" onclick="preventDefault();">Not this buyer? </a>


    </div>

								<button type="button" data-toggle="modal" data-target="#myModal">Add buyer</button>
						
							
							

						<div class="row">	
						<span class="span_label">	Sales Executive Name : </span>
						<select id="sales_exe_name" name="sales_exe_name" required>
                        <option  value="">Select</option>
                        <?php
                        while ($executive_name = mysqli_fetch_assoc($executive_qry)) { ?>
                         <option value = '<?php echo $executive_name["exe_id"]; ?>' <?php if($executive_name['exe_id']==$stored_salesperson){echo 'selected';} ?> ><?php echo $executive_name["exe_name"];?> </option>
                        <?php }  ?>
                    </select>
						<!--<input type="text" name="sales_exe_name" id="sales_exe_name" required/>-->


						</div>


						<div class="row">	
						<span class="span_label">	Mode of Sales: </span>
						<div id="res">

						<select name='modeOfSale' id='modeOfSale' required>
						<option value=''>select</option>
						<?php while($row = mysqli_fetch_assoc($sql_sales)){ ?>
						<option value='<?php echo $row['id'];?>' <?php if($row['id'] ==$stored_po_mode){ echo 'selected';}?> > <?php echo $row['mode'];?></option>
						<?php } ?>
						</select>
						</div>
						</div>






						<div class="row">	
						<span class="span_label">	PO Date : </span>
						<input type="date" name="po_date" id="po_date" value="<? echo $stored_po_date; ?>" required/>
						</div>
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						
						<div class="selectContainer">
						    
						   
						   <? $counter = 1;
						   
						   $asset_loop = mysqli_query($con1,"select * from po_assets where po_trackid='".$stored_id."'");
						   while($asset_loop_result = mysqli_fetch_assoc($asset_loop)){ 
						   
						   $assets_name = $asset_loop_result['assets_name'];
						   $specs = $asset_loop_result['specs'];
						   $quantity = $asset_loop_result['qty'];
						   $rate = $asset_loop_result['rate'];
						   $warranty = $asset_loop_result[
						       'warranty'];
						   ?>
						       
						    
						   
						    <select id="product-<? echo $counter; ?>" class="product" name="product[]" required="">
						        
						        <option value=""> Select Product</option>
						        
						        <?
                                $product_sql = mysqli_query($con1,"select * from assets");
                                while($product_sql_result = mysqli_fetch_assoc($product_sql)){
                                
                                $id = $product_sql_result['assets_id'];
                                $name =$product_sql_result['assets_name']; ?>
                                
                                <option value="<? echo $id ?>" <? if($name==$assets_name){ echo 'selected';}?>>
                                    <? echo $name; ?>
                                    </option>
                                <? }
                                ?>

						   </select><br><br>
						    
						    <select id="model-product-<? echo $counter; ?>" class="model" name="model[]" required="">
						        
						        <option value=""> Select Model</option>
						        
<?
$model_sql = mysqli_query($con1,"select * from assets_specification order by ass_spc_id asc
");
while($model_sql_result = mysqli_fetch_assoc($model_sql)){
    
    $id2 = $model_sql_result['ass_spc_id'];
    $asset_id = $model_sql_result['assets_id'];
    $name2 = $model_sql_result['name']; ?>
    
 <option value="<? echo $id2;?>" <? if($id2==$specs){ echo 'selected';}?>>
     <? echo $name2; ?>
 </option>
    
<? } ?>
						        
						    </select><br><br>
						        
						        
						        
						        
						        <input type="text" name="quantity[]" placeholder="Specify Quantity" required="" value="<? echo $quantity;?>"><br><br>
						        
						        <input type="text" name="price[]" placeholder="Price" required="" value="<? echo $rate;?>"><br><br>
						        
						        <select name="warranty[]" required="">
						            <option value="">Select Warranty</option>
						            <option value="0,months" <? if($warranty=='0 months'){ echo 'selected';}?>>
						                No Warranty</option>
						            <option value="6,months" <? if($warranty=='6 months'){ echo 'selected';}?>>
						                6 Months</option>
						            <option value="12,months" <? if($warranty=='12 months'){ echo 'selected';}?>>
						                1 Year</option>
						            <option value="24,months"<? if($warranty=='24 months'){ echo 'selected';}?>>
						                2 Year</option>
						            <option value="36,months" <? if($warranty=='36 months'){ echo 'selected';}?>>
						                3 Year</option>
						            <option value="48,months" <? if($warranty=='48 months'){ echo 'selected';}?>>
						                4 Year</option>
						            <option value="60,months" <? if($warranty=='60 months'){ echo 'selected';}?>>
						                5 Year</option>
						      </select><br><br><hr style="border-top: 2px solid black;">
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      
						      <?  $counter++ ; }?>
						      
						    </div>
						
						
						
				<!--<div class="selectContainer"></div>-->










                <!--<button onclick="addOptionTags()">Add New</button>-->
 <!--<input type='button' id='but_add' value='Add new' onclick="addOptionTags()" style="width:20%">-->











						<div class="row">	
						<span class="span_label">	Additional PO info, if any: </span>
						<input type="text" name="non_std_product" id="non_std_product" value="<? echo $stored_non_standard_item_product; ?>" required/>
						</div>


						<div class="row">	
						<span class="span_label">	Other charges, if any :  </span>
						<input type="text" name="other_charges" id="other_charges" required onkeypress="return onlyNumberKey(event)" value="<? echo $stored_other_charge;?>" maxlength='10'/>
						</div>


						<div class="row">	
						<span class="span_label">	Payment Terms:  </span>
						<input type="text" name="payment_term" id="payment_term" value="<? echo $stored_po_payment; ?>" required/>
						</div>


						<div class="row">	
						<span class="span_label"> PO Remarks :  </span>
						<input type="text" name="remarks" id="remarks" value="<? echo $stored_po_remarks; ?>" required/>
						</div>


						<div class="row">	
						<span class="span_label">	Delivery TAT within Days : </span>
						<input type="text" name="tat" id="tat"  value="<? echo $stored_po_tat;?>" required/>
						</div>

			

						<input  type="submit" value="Update" class="readbutton" />
						
						
						<?
						$sql = mysqli_query($con1,"select * from buyer where buyer_ID = '".$get_buyer."'");

                        $sql_result = mysqli_fetch_assoc($sql);
                        
                        
						
						?>

<input type="hidden" value="<? echo $sql_result['avo_branch']; ?>" name="branchid" />
						</form>
					</div>
				</div>
				
				
				<div class="col-xs-4" id="buyer-info">
				    
				    
				    
				    <? 



				    if($get_buyer){
				        
	
$sql = mysqli_query($con1,"select * from buyer where buyer_ID = '".$get_buyer."'");

$sql_result = mysqli_fetch_assoc($sql);

$id = $sql_result['buyer_executive'];
echo "

<div id='custome_buyer_information'>
<h2 style='color:white;text-align:center;'>Buyer Information</h2>
    <label>Buyer_vertical</label> 
    <span>".get_cust_vertical_name($sql_result['buyer_vertical'])."</span>
    
    <br>
        <label>Name</label> 
    <span>".$sql_result['buyer_name']."</span>
    <br>
        <label>buyer_segment</label> 
    <span>".get_end_user_name($sql_result['buyer_segment'])."</span>
    <br>
        <label>City</label> 
    <span>".$sql_result['buyer_city']."</span>
    <br>
        <label>Address</label> 
    <span>".$sql_result['buyer_address']."</span>
    <br>
        <label>State</label> 
    <span>".get_state_name($sql_result['buyer_state'])."</span>
    <br>
            <label>Branch</label> 
                        <label>".$sql_result['avo_branch']."</label> 
    
    <span>".get_branch_name($sql_result['avo_branch'])."</span>
    <br>
            <label>Pincode</label> 
    <span>".$sql_result['buyer_pin']."</span>
    <br>
      <label>GST</label> 
    <span>".$sql_result['buyer_gst']."</span>
    <br>
      <label>Executive</label> 
    <span>".get_sales_team('exe_name',$id)."</span>
    <br>
    <label>Contact</label> 
    <span>".$sql_result['buyer_contact']."</span>
    <br>
    <label>Designation</label> 
    <span>".$sql_result['buyer_designation']."</span>
    <br>
       <label>Mail</label> 
    <span>".$sql_result['buyer_mail']."</span>
    <br>
</div>";
				        
				    }
				    
				    
				    
?>
				    
				    
				    	
				    
				</div>



		



</center>






<script>	


$(document).ready(function(){
    
    
    
    
    $("#customer_vertical").change(function(){
        
        $("#custome_buyer_information").remove();
        var customer_vertical = $(this).val(); 
        
        
        $.ajax({
		type: "POST",
		url: "get_selected_buyer.php",
		data:'customer_vertical='+customer_vertical,
		     success:function(data) {
			
			$( "#buyer_name" ).val('');
            $( "#buyers option" ).remove();
			$( "#buyers" ).append(data);

		}
	});
	
	
        
    });
    
    
     $('#empty_buyer').click(function(){
         
         $("#buyer_name").val("");
         
     });
    

 $('#but_add').click(function(){

  // Create clone of <div class='input-form'>
  var newel = $('.input-form:last').clone();

  // Add after last <div class='input-form'>
  $(newel).insertAfter(".input-form:last");
 });

 $('.txt').focus(function(){
  $(this).css('border-color','red');
 });
 
 $('.txt').focusout(function(){
  $(this).css('border-color','initial');
 });

});


</script>










<script type="text/javascript">
    function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
    
    function getProductData(val) {
	$.ajax({
		type: "POST",
		url: "getAssetSpecification.php",
		data:'asset_id='+val,
		beforeSend: function() {
			$("#model").addClass("loader");
		},
		success: function(data){
			$("#model").html(data);
			$("#model").removeClass("loader");
		}
	});
}


$("#buyer_name").change(function(){


var name = document.getElementById("buyer_name").value;
var bid  = document.querySelector("#buyers option[value='"+name+"']").dataset.value;

// alert(bid);

$("#buyerID").val(bid);
document.getElementById('buyerID').value=bid;

var buyer_id = $("#buyerID").attr("value");


$.ajax({
		type: "POST",
		url: "get_buyer_info.php",
		data:'buyer_id='+buyer_id,
		     success:function(data) {
			
			$("#buyer_information").remove();
			
			$( "#buyer-info" ).append(data);

		}
	});


});

</script>

<style>
.vertical_margin{
    width:6%;
}
.col-xs-8{
    width:70%;
}
.col-xs-4{
    width:30%;
}
    .row{display:flex;margin-right:15px;margin-left:15px;margin-top: 10px; margin-bottom: 10px;}
    .row:after,.row:before{display:table;content:" "}
    .row:after{clear:both}
    .col-xs-4{position:relative;min-height:1px;padding-right:15px;padding-left:15px}
    .span_label{ color:white;width:30%;text-align:left; }
    .selectContainer{border: 1px solid #ffe150;background: #e8e6e6;padding: 2%;border-radius: 10px; margin: 1%;}
    .input-form .span_label{ color:black} 
    #res{width:100%;}
    input,input[type="text"],select{width:100%;}
    
</style>

















<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        
        
        <?
        

    
$branch_qry = mysqli_query($con1,"select * from avo_branch  ");
    
$state_qry = mysqli_query($con1,"select * from state ");

$executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where status=1");

$end_user = mysqli_query($con1,"select * from user_segment where status=1");
/*$user = mysqli_fetch_assoc($end_user);
var_dump($user);*/

if(isset($_GET['action']) && $_GET['action']=='edit'){
    $id = $_GET['id'];
    $edit_data =mysqli_query($con1,"select * from buyer where buyer_ID = ".$id);
    $edit_result  = mysqli_fetch_assoc($edit_data);
    
    $buyer_vertical = $edit_result['buyer_vertical'];
    $buyer_name = $edit_result['buyer_name'];
    $buyer_segment = $edit_result['buyer_segment'];
    $avo_branc = $edit_result['avo_branch'];
    $buyer_city = $edit_result['buyer_city'];
    $buyer_address = $edit_result['buyer_address'];
    $buyer_state = $edit_result['buyer_state'];
    $buyer_pin = $edit_result['buyer_pin'];
    $buyer_gst = $edit_result['buyer_gst'];
    $buyer_executive = $edit_result['buyer_executive'];
    $buyer_contact = $edit_result['buyer_contact'];
    $buyer_designation = $edit_result['buyer_designation'];
    $buyer_phone = $edit_result['buyer_phone'];
    $buyer_mail = $edit_result['buyer_mail'];
    $buyer_phone2 = $edit_result['buyer_phone2'];
   
} else {
    $id = 0;
    $customer_vertical = '';
    $buyer_name = '';
    $buyer_segment = '';
    $avo_branc = '';
    $buyer_city = '';
    $buyer_address = '';
    $buyer_state = '';
    $buyer_pin = '';
    $buyer_gst = '';
    $buyer_executive = '';
    $buyer_contact = '';
    $buyer_designation = '';
    $buyer_phone = '';
    $buyer_mail = '';
    $buyer_phone2 = '';
   }
?>
<script type="text/javascript">
function validate1(){
var a=document.getElementById("form1");
//alert(a);
 with(a)
 {
    var numbers = /^[0-9]+$/;
    var namePattern = /^[A-Za-z()_ ]/;
    if(document.getElementById('state').value==0)
    {
    	alert("Please Select State");
    	document.getElementById('state').focus();
    	return;
    }
    if(document.getElementById('avo_branch').value==0)
    {
    	alert("Please Enter Branch Address");
    	document.getElementById('avo_branch').focus();
    	return;
    }
if(document.getElementById('city').value=='')
{
	alert("Please Enter City");
	document.getElementById('city').focus();
	return;
}
if(document.getElementById('pincode').value=='')
{
	alert("Please Enter Pincode");
	document.getElementById('pincode').focus();
	return;
}

if(document.getElementById('buyer_name').value=='' || document.getElementByName('address').value=='')
{
alert("Give atleast one Name");
return;
}

document.getElementById("form1").action = "add_buyer_process.php?id=<?php echo $id;?>";
a.submit();
}
}
</script>

  

    <h2> <?php if(isset($_GET['action']) && $_GET['action']=='edit'){echo 'Edit';} else {echo 'New';}?> Buyer</h2>
    <div id="header">
        <form id="form1" method="post" action ="add_buyer_process.php?id=<?php echo $id;?>">
            <table>
                <tr>
                    <td><label for="customer_vertical">Customer Vertical &nbsp</label></td>
                    <td>
                        <select id="customer_vertical" name="customer_vertical" id="customer_vertical"  required>
                            <option  value="">Select</option>
                            <?php
                            //$customer_qry = mysqli_query($con1,"select * from customer");
                                while ($customer_vertical = mysqli_fetch_assoc($customer_qry)) { ?>
                                    <option value= "<?php echo $customer_vertical['cust_id']; ?>" <?php if($customer_vertical['cust_id']==$buyer_vertical) {echo 'selected';}?> > <?php echo $customer_vertical["cust_name"];?></option>
                                <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="buyer_name">Buyer Name &nbsp</label></td>
                    <td><input type="text" placeholder="Buyer Name" name="buyer_name" id="buyer_name" value="<?php echo $buyer_name;?>" required><br></td>
                </tr>
                <tr>
                    <td><label for="end_user">End user segment &nbsp</label></td>
                    <td>
                        <select id="end_user" name="end_user" required>
                            <option  value="">Select</option>
                            <?php //$end_user
                            while ($user = mysqli_fetch_assoc($end_user)) { var_dump($user);?>
                                <option value= "<?php echo $user["id"];?>"  <?php if($user['id']==$buyer_segment){echo 'selected';}?> ><?php echo $user["name"]; ?></option>;
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="city">City &nbsp</label></td>
                    <td><input type="text" placeholder="City" name="city" id="city" value="<?php echo $buyer_city;?>" required><br></td>
                </tr>
                <tr>
                    <td><label for="address">Address &nbsp</label></td>
                    <td><input type="text" placeholder="Address" name="address" id="address" value="<?php echo $buyer_address;?>" required></td>
                </tr>
                <tr>
                    <td><label for="state">State &nbsp</label></td>
                    <td>
                        <select id="state" name="state" required>
                            <option  value="">Select</option>
                            <?php
                            while ($state = mysqli_fetch_assoc($state_qry)) { ?>
                                <option value = "<?php echo $state['state_id'];?>" <?php if($state['state_id']==$buyer_state){echo 'selected';}?>> <?php echo $state["state"];?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td> <label for="avo_branch">AVO Branch &nbsp</label></td>
                    <td>
                       <select id="avo_branch" name="avo_branch" required>
                            <option  value="">Select</option>
                            <?php
                            while ($avo_branch = mysqli_fetch_assoc($branch_qry)) { ?>
                              <option value = '<?php echo $avo_branch["id"]; ?>' <?php if($avo_branch['id']==$avo_branc){echo 'selected';}?> ><?php echo $avo_branch["name"]; ?> </option>
                            <?php } ?>
                        </select> 
                    </td>
                </tr>
                <tr>
                    <td><label for="pincode">Pincode &nbsp</label></td>
                    <td><input type="text" placeholder="Pincode" maxlength='6' name="pincode" id="pincode" value="<?php  echo $buyer_pin;?>" onkeypress="return onlyNumberKey(event)" required><br></td>
                </tr>
                <tr>
                    <td><label for="gst_no.">Buyer GST No. &nbsp</label></td>
                    <td><input type="text" placeholder="Buyer GST No." name="gst_no" id="gst_no" maxlength="15" value="<?php echo $buyer_gst;?>" required onkeypress="return onlyNumberKey(event)"><br></td>
                </tr>
                <tr>
                    <td><label for="executive_name">Sales Executive Name &nbsp</label></td>
                    <td>
                       <select id="executive_name" name="executive_name" required>
                        <option  value="">Select</option>
                        <?php
                        while ($executive_name = mysqli_fetch_assoc($executive_qry)) { ?>
                         <option value = '<?php echo $executive_name["exe_id"]; ?>' <?php if($executive_name['exe_id']==$buyer_executive){echo 'selected';} ?> ><?php echo $executive_name["exe_name"];?> </option>
                        <?php }  ?>
                    </select> 
                    </td>
                </tr>
                <tr>
                  <td><label for="Buyer_contact_person">Buyer Contact Person &nbsp</label></td>
                  <td><input type="tel" placeholder="Buyer Contact Person" name="Buyer_contact_person" id="Buyer_contact_person" required maxlength='10' value="<?php echo $buyer_contact;?>"></td>
                </tr>
                <tr>
                    <td><label for="Buyer_designation">Buyer Designation &nbsp</label></td>
                    <td><input type="text" placeholder="Buyer Designation" name="Buyer_designation" id="Buyer_designation" required value="<?php echo $buyer_designation;?>"><br></td>
                </tr>
                <tr>
                    <td><label for="Buyer_mobile_mumber">Buyer Mobile Number &nbsp</label></td>
                    <td><input type="tel" maxlength ='10' placeholder="Buyer Mobile Number" name="Buyer_mobile_mumber" required id="Buyer_mobile_mumber"  value="<?php echo $buyer_phone;?>"><br></td>
                </tr>
                <tr>
                    <td><label for="buyer_e-mail">Buyer e-mail Address &nbsp</label></td>
                    <td><input type="email" placeholder="Buyer e-mail Address" name="buyer_e-mail" id="buyer_e-mail" required value="<?php echo $buyer_mail;?>"><br></td>
                </tr>
                <tr>
                    <td><label for="Landline_phone_no.">Landline Phone No. &nbsp</label></td>
                    <td><input type="tel" placeholder="Landline Phone No." maxlength='10' name="Landline_phone_no" required id="Landline_phone_no" value="<?php echo $buyer_phone2;?>"><br></td>
                </tr>
               
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Click" ></td>
                </tr>
            </table>
        </form>
    
<script>
    function onlyNumberKey(evt) { 
          
        // Only ASCII charactar in that range allowed 
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
        return true; 
    } 
</script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?
$po_get_sql = mysqli_query($con1,"select count(*) as fetch_count from po_assets where po_no='".$stored_po_no."'");

$po_get_sql_result = mysqli_fetch_assoc($po_get_sql);

echo 'count'.$po_get_sql_result['fetch_count'];
?>


    <script>
    //     var GroupCount = 0;
    //     var Set1 = <? echo $data; ?>;
    //     var Set2 = <? echo $data2; ?>;
                    
                    
                    
    // function addOptionTags() {
    //     GroupCount++;
    //     var sId = 'product-'+GroupCount;
    //     var s = $('<select id="'+sId+'" class="product" name="product[]"  required /><br><br>');
    //     var s2 = $('<select id="model-'+sId+'" class="model" name="model[]" required /><br><br>');
                 
    //     $("<option value=''> Select Product</option>").appendTo(s);
    //     $("<option value=''> Select Model</option>").appendTo(s2);

    //     var quantity = $('<input type="text" name="quantity[]" placeholder="Specify Quantity" required><br><br>');
    //     var price = $('<input type="text" name="price[]" placeholder="Price" required><br><br>');
        
    //     var warranty = $("<select name='warranty[]' required><option value=''>Select Warranty</option><option value='0 months'>No Warranty</option><option value='6 months'>6 Months</option><option value='12 months'>1 Year</option><option value='24 months'>2 Year</option><option value='36 months'>3 Year</option><option value='48 months'>4 Year</option><option value='60 months'>5 Year</option></select>");
    //     var space  = $('<br><br><hr style="border-top: 2px solid black;">');

        
    //     for(var val of Set1) {
    //         $("<option />", {value: val.id, text: val.name}).appendTo(s);
    //     }
            
    //         s.appendTo(".selectContainer");
    //         s2.appendTo(".selectContainer");
    //         quantity.appendTo(".selectContainer");
    //         price.appendTo(".selectContainer");
    //         warranty.appendTo(".selectContainer");
    //         space.appendTo(".selectContainer");
    // }
        
        
    //     function LoadSet2Options(fk, set2Id) {
    //         var op = $("#"+set2Id);
    //         op.empty();
    //         for(var val of Set2) {
    //             if(val.fk == fk) {
    //                 $("<option />", {value: val.id, text: val.name}).appendTo(op);
    //             }
    //         }
    //     }


    //     $(".selectContainer").on('change', '.product', function() {
    //         LoadSet2Options($(this).val(), "model-"+$(this).attr("id"));
    //     });
    //     $(document).ready(function() {
    //         addOptionTags();
    //     });
        
        
        
        
        // $("#po_number").focusout(function(){
            
        //     var po_number = $("#po_number").val();
            
            
        //     if(po_number){
        //          $.ajax({
        // type: "POST",
        // url: 'check_po.php',
        // data: 'po='+po_number,
        
        // success:function(msg) {
               
        // if(msg==1 || msg=='1'){
            
        //     $("#po_number").val('');
        //     alert('Sorry ! This purchase Nummber already exist..');
            
        // }
        
        //         }
        //     });
        //     }
        //     else{
        //         alert('Purchase Order cannot be empty');
        //     }
            
        // });
        
    </script>
    
    
</body>
</html>