<?php session_start();
include("access.php");
include('functions.php');


function get_modelname($modelid){
    
    $sql= mysqli_query($con1,"select * from assets_specification where ass_spc_id='".$modelid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    $name = $sql_result['name'];
    
    return $name;
}


$executive_qry = mysqli_query($con2,"SELECT * FROM salesteam where status='1'");


    $sql_buyer = mysqli_query($con1,"select * from buyer where status = 1");

    $sql_customer = mysqli_query($con1,"select * from customer ");

    $sql_assets = mysqli_query($con1,"select * from assets ");

    $sql_deliveryType = mysqli_query($con1,"select * from delivery_type where status = 1");

    $sql_sales = mysqli_query($con1,"select * from modeOfSales where status = 1");

    if(isset($_GET['id']) && $_GET['id']>0){
        $id = $_GET['id'];
        



        $purchase_details = mysqli_query($con1,'select * from purchase_order where id = "'.$id.'"');
        while($row = mysqli_fetch_assoc($purchase_details)){
            

            $buyer_id = $row['buyer_id'];
            $customer_vertical = $row['cust_id']; 
            $sales_exe_name = $row['salesperson'];
            
            $modeOfSale = $row['po_mode'];
            
            $po_number = $row['po_no'];
            $po_date = $row['po_time']; 
            

            
            $delivery_type = $row['del_type'];
            $product = $row['product'];
            
            $model = $row['model'];
            $capacity = $row['capacity']; 
            $quantity = $row['quantity'];
            $basic_Price = $row['basic_Price'];
            
            $warranty = $row['warranty'];
            $non_std_product = $row['non_standard_item_product']; 
            $other_charges = $row['other_charge'];
            $po_payment = $row['po_payment'];
            
            $tat = $row['po_tat'];
            $gst =$row['gst'];
            $po_remarks =$row['po_remarks'];
            
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
    <title>Edit Purchase Order </title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="menu.css" rel="stylesheet" type="text/css" />
    
    <script
      src="https://code.jquery.com/jquery-3.4.1.js"
      integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
      crossorigin="anonymous"></script>
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      
    <script>
    /////for city
    function getXMLHttp()
    {
    
      var xmlHttp
    
     //alert("hi1");
    
      try
    
      {
    
        //Firefox, Opera 8.0+, Safari
     xmlHttp = new XMLHttpRequest();
      }
    
      catch(e)
      {
        //Internet Explorer
        try
        {
          xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
       catch(e)
        {
          try
          {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          catch(e)
          {
            alert("Your browser does not support AJAX!")
           return false;
          }
       }
     }
      return xmlHttp;
    }
    function MakeRequest()
    
    { 
      var xmlHttp = getXMLHttp();
     
    
      xmlHttp.onreadystatechange = function()
      {
        if(xmlHttp.readyState == 4)
        {
    
          HandleResponse3(xmlHttp.responseText);
        }
      }
    
     //alert("hi2");
    
      //alert("getarea.php?ccode="+document.forms[0].city.value);
    var str=document.getElementById('city').value;
    //alert(str);
      xmlHttp.open("GET", "get_area.php?city="+str, true);
    
      xmlHttp.send(null);
    
    }
    
    function HandleResponse3(response)
    
    {
    
      document.getElementById('res').innerHTML = response;
    
    }
    
    function validate()
    {
    //alert("hello");
    var form=document.getElementById('engform');
    with(form)
    {
    //alert("hello");
    /*if(city.value=='')
    {
    //alert("hi");
    alert("Select City first");
    city.focus();
    return;
    }*/
    if(logintype.value=='0')
    {
    alert("Please Select Login Type");
    logintype.focus();
    return;
    }
    if(name.value=='')
    {
    alert("Please Enter  Name");
    name.focus();
    return;
    }
    if(cont.value=='')
    {
    alert("Please Enter Contact Number");
    cont.focus();
    return;
    }
    if(cont.value!='')
    {
    //alert("hello");
     var y = cont.value;
     if(isNaN(y)||y.indexOf(" ")!=-1)
               {
                  alert("Enter numeric value for Phone ");
                  cont.value='';
                  cont.focus();
                  return;
               }
               if (y.length>11)
               {
                    alert("Enter 11 characters starting with 0");
                    cont.focus();
                    return;
               }
               if (y.charAt(0)!="0")
               {
               cont.value='0'+y;
                   // alert("Phone1 should start with 0 ");
                    //ph1.focus();
                  //  return;
               }
    }
    if(email.value=='')
    {
    alert("Please Enter Email ID");
    email.focus();
    return;
    }
    if(email.value!='')
    {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
    if(!email.value.match(mailformat))  
    {   
    alert("You have entered an invalid email address!");  
    email.focus();  
    return;  
    }
    
    }
    
    form.submit();
    }
    }
    
    
    
    </script>
    
    
   <style>
   
   body{
           background-color: #4D9494;
    margin-top: 20px;
    
   }
   
      html[xmlns] #menu-bar {
    display: block;
    z-index: 100000;
    position: relative;
}


      #custome_buyer_information{
       color: white;
    text-align: left;
   }
   
    #custome_buyer_information label{
       width:30%;
   }
    #custome_buyer_information span{
       width:70%;
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
 
 input,option{
     color:red;
 }
 
        </style>

</head>

<body>
<center>
<?php include("menubar.php"); ?>








<h2>Edit Purchase Order </h2>

<div class="row">	


				<div class="col-xs-8">	
					<div id="header">

						<div class="row">	
						<span class="span_label">	PO Number :</span>
						<input type="text" name="po_number" id="po_number" value="<?php echo $po_number; ?>" required/>
						</div>





						<div class="row">	
						<span class="span_label">	Customer Vertical :</span>
						<div id="res">	
						<select name='customer_vertical' id='customer_vertical' required readonly>
						<option value=''>Select</option>
						<?php
						while($row=mysqli_fetch_assoc($sql_customer))
						{  ?>
						<option value="<?php echo $row['cust_id']; ?>" <?php if($row['cust_id'] ==$customer_vertical){ echo 'selected';}?> ><?php echo $row['cust_name'];  ?></option>
						<?php } ?>
						</select>

						</div>

						</div>


						<div class="row">	
						<span class="span_label">	Buyer Name:</span>
						<div id="res">	
						<input list="buyers" name="buyer" id="buyer_name" value="<?php echo $buyer_name;?>" >
						<input type="hidden" name="buyerID" id="buyerID" <?php echo $buyer_id; ?>>
						<datalist id="buyers" >
						<?php 
						$sql_buyer = mysqli_query($con1,"select * from buyer where status = 1");

						while($result = mysqli_fetch_assoc($sql_buyer)){ ?>

						<option value="<?php echo $result['buyer_name'];?>" data-value="<?php echo $result['buyer_ID'];?>">

						
						<?php
						
						
						} ?>
        			
						</datalist>
							<script>
							

							
						    $( "#buyer_name" ).change(function() {

                                var e =document.getElementById("buyerID").innerHTML;
                                
                               
                                
            //                     alert(e);
    						  //  alert($(this).attr('data-value'));
                            });

						</script>
						</div>
						</div>


<?
$saleteam_sql = mysqli_query($con1,"select salesperson from purchase_order where id='".$id."'");
$saleteam_sql_result = mysqli_fetch_assoc($saleteam_sql);

$salesexe = $saleteam_sql_result['salesperson'];
?>
						<div class="row">	
						<span class="span_label">	Sales Executive Name : </span>
						 <select id="sales_exe_name" name="sales_exe_name" readonly>
                            <option  value="">Select</option>
                            <?php
                            while ($executive_name = mysqli_fetch_assoc($executive_qry)) { ?>
                             <option value = '<?php echo $executive_name["exe_id"]; ?>' <?php if($executive_name['exe_id']==$salesexe){echo 'selected';} ?> ><?php echo $executive_name["exe_name"];?> </option>
                            <?php }  ?>
                        </select> 
                    
						<!--<input type="text" name="sales_exe_name" id="sales_exe_name" value="<? echo $sales_exe_name; ?>" required/>-->


						</div>


						<div class="row">	
						<span class="span_label">	Mode of Sales: </span>
						<div id="res">

						<select name='modeOfSale' id='modeOfSale' required readonly>
						<option value=''>select</option>
						<?php while($row = mysqli_fetch_assoc($sql_sales)){ ?>
						<option value='<?php echo $row['id'];?>' <?php if($row['id'] ==$modeOfSale){ echo 'selected';}?> > <?php echo $row['mode'];?></option>
						<?php } ?>
						</select>
						</div>
						</div>



						<div class="row">	
						<span class="span_label">	PO Date : </span>
						<input type="text" name="po_date" id="po_date" value="<? echo $po_date; ?>" readonly/>
						</div>


						<div class="row">	
						<span class="span_label">	Delivery Type:  </span>
						<div id="res">
						<select name='delivery_type' id='delivery_type' required readonly>
						<option value=''>select</option>
						<?php while($row = mysqli_fetch_assoc($sql_deliveryType)){ ?>
						<option value='<?php echo $row['id'];?>' <?php if($row['id'] ==$delivery_type){ echo 'selected';}?> > <?php echo $row['delivery_type'];?></option>
						<?php } ?>
						</select>
						</div>
						</div>



<? $sql=mysqli_query($con1,"select * from po_assets where po_trackid='".$id."'");

while($sql_result=mysqli_fetch_assoc($sql)){ 
    
    $selected_product=$sql_result['assets_name'];
    
    $selected_po_model = $sql_result['specs'];
    
    ?>
    	<div class='input-form'>




					<div class="row">
						<span class="span_label"> Product </span>


						<select name='product[]' id='product'  class="demoInputBox" onChange="getProductData(this.value);" required readonly>
						    
						<option value=''>select</option>
						
						<?php
						    $sql_assets = mysqli_query($con1,"select * from assets");
						while($row = mysqli_fetch_assoc($sql_assets)){ 
					
						?>

						    <option value="<?php echo $row['assets_id'];?>" <?php if($row['assets_name'] == $selected_product ){ echo 'selected';}?> ><?php echo $row['assets_name'];?></option>
						
						<?php } ?>
						</select>
					</div>
					
					
					
					
					
					
					



				<div class="row">
						<span class="span_label">Model:</span>

						<select name='model[]' id='model' required readonly>
						<option>select</option>
						
						<?
						$sql_assets_specification = mysqli_query($con1,"select * from assets_specification");
    while ($row = mysqli_fetch_assoc($sql_assets_specification)) {
    ?>
        <option value="<?php echo $row["ass_spc_id"]; ?>" <? if($row["ass_spc_id"]== $selected_po_model) { echo 'selected';}?>><?php echo $row["name"]; ?></option>
    <?php   } ?>
    
						?>

						</select>
					</div>


						<div class="row">
							
						<span class="span_label">Quantity :</span>

						<input type="text" name="quantity[]" id="quantity" maxlength='3'  value="<? echo $sql_result['qty'];?>"  required onkeypress="return onlyNumberKey(event)"/>

						</div>

                    <div class="row">
	
						<span class="span_label">Basic Price :</span>
						<input type="text" name="basic_Price[]" id="basic_price" value="<? echo $sql_result['rate'];?>" required onkeypress="return onlyNumberKey(event)" maxlength='3'/>

                    </div>


					<div class="row">
						
						<span class="span_label">Warranty terms :</span>
						<input type="text" name="warranty[]" id="warranty" value="<? echo $sql_result['warranty'];?>" required maxlength='2' onkeypress="return onlyNumberKey(event)"/>
					</div>

						</div>
						
						
    
<? } ?>





















						<div class="row">	
						<span class="span_label">	Non-standard item Product : </span>
						<input type="text" name="non_std_product" id="non_std_product"  value= " <? echo $non_std_product; ?>" required/>
						</div>


						<div class="row">	
						<span class="span_label">	Other Charges :  </span>
						<input type="text" name="other_charges" id="other_charges" value="<? echo $other_charges; ?>" required/>
						</div>


						<div class="row">	
						<span class="span_label">	Payment Terms:  </span>
						<input type="text" name="payment_term" id="payment_term" value="<? echo $po_payment ;?>" required/>
						</div>


						<div class="row">	
						<span class="span_label">	Remarks :  </span>
						<input type="text" name="remarks" id="remarks" value="<? echo $po_remarks;?>" required/>
						</div>


						<div class="row">	
						<span class="span_label">	Delivery TAT within Days : </span>
						<input type="text" name="tat" id="tat" value="<? echo $tat ; ?>" required/>
						</div>

						<div class="row">	
						<span class="span_label">	Status: </span>
						<div id="res">
						<select name='status' id='status' required readonly>
						<option value=''>Status</option>
						<option value='1' <?php if($status ==1){ echo 'selected'; } ?> >Open</option>
						<option value='0' <?php if($status ==0){ echo 'selected'; }?> >Close</option>
						</select>
						</div>
						</div>
						    
						

					</div>
				</div>



				<div class="col-xs-4">	
						
   <? if($buyer_id){
				        
	
$sql = mysqli_query($con1,"select * from buyer where buyer_ID = '".$buyer_id."'");

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


</div>

</center>






<script>	


$(document).ready(function(){

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

$('document').ready(function(){


  $('input').prop('readonly', true); 
//   $("input").css('background','#a5a5a5');
  
  jQuery('select.readonly option:not(:selected)').attr('disabled',true);


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
console.log("change");

var name = document.getElementById("buyer_name").value;
var bid  = document.querySelector("#buyers option[value='"+name+"']").dataset.value;

alert(bid);

$("#buyerID").val(bid);
document.getElementById('buyerID').value=bid;
console.log('Id: ',bid,' name : ',name)
});

$("#buyer_name").val(<? echo $buyer_id; ?>);

</script>

<style>
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
    .span_label{ color:white;width:20%;text-align:left;}
    .input-form{border: 1px solid #ffe150;background: #e8e6e6;padding: 2%;border-radius: 10px; margin: 1%;}
    .input-form .span_label{ color:black} 
    #res{width:100%;}
    input,input[type="text"],select{width:100%;}
    
</style>

</body>
</html>