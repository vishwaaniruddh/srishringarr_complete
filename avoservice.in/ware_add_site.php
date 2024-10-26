<?php
include('config.php');

  $soid = $_GET['id'];



function asset_name($id){
    
    global $con1;
    
    $sql = mysqli_query($con1,"select * from new_sales_order_asset where so_assetID='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['po_product'];

}

function get_branch_name($id){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select * from avo_branch where id='".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['name'];
}
  
  
 
  
  function get_asset_name($id){

    global $con1;
    
    $sql = mysqli_query($con1,"select * from assets_specification where ass_spc_id = '".$id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);

    $asset_name = $sql_result["name"];
    
    return $asset_name;
    
}



function get_consume_quantity($so_id,$asset_id){
    
    global $con1;
   // echo $so_id;
  //  echo $asset_id;
    
//    echo "SELECT * FROM so_consumption where so_trackid='".$so_id."' and po_product='".$asset_id."'";
 
    $sql = mysqli_query($con1,"SELECT * FROM so_consumption where so_trackid='".$so_id."' and po_product='".$asset_id."'");
    
     if($sql_result = mysqli_fetch_assoc($sql)){
    
        $consume_quantity = $sql_result['po_consumqty'];
    
        return $consume_quantity;    
    }
    else{
        return 0;
    }

}


function get_avail_quantity($soid,$product){
    
    global $con1;
 //   echo "SELECT * FROM so_consumption where so_trackid='".$soid."' and po_product='".$product."'";
    
    $sql = mysqli_query($con1,"SELECT * FROM so_consumption where so_trackid='".$soid."' and po_product='".$product."'");
    
    if($sql_result = mysqli_fetch_assoc($sql)){
        
        $available_quantity = $sql_result['po_qty'] - $sql_result['po_consumqty'];
    
        return $available_quantity;
    
    }
    else{
        return false;
    }
    
}


  //$customer_vertical = get_customer($soid);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--validation-->
     <style>
      

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

.consignee_details div,.demo_consignee_details div{
    width:100%;
    display:flex;
    margin:5px;
}
.consignee_details div label, .demo_consignee_details div label{
    width:30%;
    text-align:left;
        font-weight: 700;
        color:white;
}
.consignee_details div input,.consignee_details div select, .consignee_details div span{
    width:70% ! important;
}
.demo_consignee_details{
    width:45%;
}
.demo_consignee_details div span{
    color:white;
}
.consignee_details{
    width:77%;
}
      </style>     
</head>

<body>
<center>
<?php 
include("menubar.php");  
?>

<h2>Add Site to Warranty <span style="font-size:12px; color:#fdd835;">(Warehouse- Installation Not Required)</span></h2>

<?
$sql = mysqli_query($con1,"select * from demo_atm where so_id='".$soid."'");
$sql_result = mysqli_fetch_assoc($sql);

//echo "select * from new_sales_order where so_trackid='".$soid."'";

$new_sale_sql = mysqli_query($con1,"select * from new_sales_order where so_trackid='".$soid."'");
$new_sales = mysqli_fetch_assoc($new_sale_sql);
$po_id=$new_sales['po_trackid'];

$po_qry = mysqli_query($con1,"select * from purchase_order where id='".$po_id."'");
$po_row = mysqli_fetch_assoc($po_qry);
$po_no=$po_row['po_no'];


?>
<div class="demo_consignee_details">

    <h3 style="color:white; text-align:center;">Consignee Details</h3>
    <div>
        <label>Track ID</label>
        <span><? echo $sql_result['atm_id'];?></span>
    </div>
    

    <div>
        <label>CITY</label>
    <span> <? echo $sql_result['city'];?> </span>
    </div>
    
    
    <div>
        <label>Consignee Name</label>
        <span><? echo $sql_result['bank_name'];?></span>    
    </div>
    
    
    <div>
        <label>Area</label>
        <span><? echo $sql_result['area'];?></span>    
    </div>
    
    
    <div>
        <label>PINCODE</label>
    <span><? echo $sql_result['pincode'];?></span>    
    </div>
    
    
    <div>
        <label>ADDRESS</label>
        <span><? echo $sql_result['address'];?></span>    
    </div>
    

    <div>
        <label>STATE</label>
        <span><? echo $sql_result['state'];?></span>    
    </div>
    
    
    <div>
        <label>BRANCH</label>
        <span><? echo get_branch_name($sql_result['branch_id']);?></span>
    </div>
    
    <div>
     <label>Customer</label>
    <? 
     $cust_sql = mysqli_query($con1,"select cust_name from customer where cust_id ='".$new_sales['po_custid']."' ");
    $cust_name=mysqli_fetch_assoc($cust_sql); ?>
    <span><? echo $cust_name['cust_name'];?></span>   
 </div>
 
     <div>
     <label> Purchase Order No:</label>
        <span><? echo $po_no;?></span>   
 </div>

    
</div>

<div id="header">

<form action="process_ware_site.php?id=<? echo $soid; ?>" method="post" name="form" >  <!--onSubmit="return validate1(this)"> -->
<input type="hidden" id="so_id" name="so_id" value="<?php echo $soid;?>">
<input type="hidden" id="cust" name="cust" value="<?php echo $new_sales['po_custid'];?>">
<input type="hidden" name="po_id" id="po_id" value="<?php echo $po_id; ?>" >
<input type="hidden" name="ref_id" id="ref_id" value="<?php echo $sql_result['atm_id']; ?>" >
<br/>


<div id="assets" style="display:block;"> 
<?
$sql = mysqli_query($con1,"select * from demo_atm where so_id='".$soid."'");
$sql_result = mysqli_fetch_assoc($sql);
?>

<table>
    

<tr>
	<th width="10">Select</th>
    <th width="30">Products</th>
    <th width="20">Model</th>

    <th width="10">Order Quantity</th>
    <th width="10">Pending Quantity</th>
    <th width="10">Consume Quantity</th>
    <th width="10">Total PO Qty</th>
                        
</tr>

                    <? 
//echo "select * from new_sales_order_asset where so_trackid = '".$soid."'";
$so_asset_sql = mysqli_query($con1,"select * from new_sales_order_asset where so_trackid = '".$soid."'");
                    
                    while($asset_row= mysqli_fetch_assoc($so_asset_sql)){
                        

                        
                    $asset_id = $asset_row['so_assetID'];
                    $asset_model =$asset_row['po_model']; 
                    
                    
                    ?>
                       <tr id="<? echo $asset_id; ?>" pending_qty="<? echo get_avail_quantity($po_id,$asset_id)?>"> 
                       
                       <td style="display: flex; justify-content: center;">
                           
                           <input class="select_product" name="select_product[]" class="checkbox_ck" id="check_product" value="<? echo $asset_id; ?>" type="checkbox">
                        </td>
                       
                        <td>
                            <? echo $asset_row['po_product'];?>
                            
                        </td>
                       
                        <td>
                            <? echo get_asset_name($asset_model); ?>
                           
                        </td>
                       
                        <td style="width:10%;"> 
                     
                        <input type="number" id="po_qty" class="po_qty <? echo $asset_id;?>"
                             
                             value="<? echo get_consume_quantity($soid,$asset_id) ? get_avail_quantity($soid,$asset_id) : $asset_row['po_qty']; ?>"
                             
                             
                             max-quantity="<? echo get_consume_quantity($soid,$asset_id) ? get_avail_quantity($po_id,$asset_id) : $asset_row['po_qty']; ?>" readonly>
                             
                        </td>
                  
                        

                         <td style="width:10%;">
                             
                            <label style="color:black" id="available_qty">
                                <?
                                 if(get_consume_quantity($soid,$asset_id) != false){

                                echo get_avail_quantity($soid,$asset_id);
                            }
                            else{
                                echo $asset_row['po_qty'];
                            }
                                ?>
                            </label>
                         </td>
                         
                         <td style="width:10%;">


                           <? echo get_consume_quantity($soid,$asset_id)?>
                            
                         </td>
                         
                        <td class="total_qty">
                            <label style="color:black" id="total_qty" value="<? echo $asset_row['po_qty']?>"><? echo $asset_row['po_qty']?></label>

                        </td>
                         
                        
                          </tr> 
                    <? } ?>

</table>
<?
$qryasst=mysqli_query($con1,"Select * from new_sales_order_asset where so_trackid='".$soid."'");

while($asstres=mysqli_fetch_assoc($qryasst))
{
  ?>  
       <input type="hidden" name="assetsme[]" id="assetsme[]" onClick="javascript:astselect('assetsme<?php echo $cnt ?>');"
       value="<?php echo $asstres['so_assetID']."*". $asstres['po_product']."*".$asstres['po_model']."*".$asstres['po_qty']."*".$asstres['po_warr']; ?>" checked/>       
<? 
 $cnt=$cnt+1;   
}
?>

<div class="consignee_details">

    <h3 style="color:white; text-align:center;">Installation Location</h3>
    <div>
        <label>Site/Sol Id</label>
        <input type="text" id="atm_id_check" name="demo_atm_id" onchange="check_atm(); return;">
        
    </div>
    
    <div>
        <label>Consignee Name</label>
        <input type="text" name="demo_bank_name">    
    </div>
   <div>
        <label>City</label>
        <input type="text" name="demo_city">    
    </div> 
    
    <div>
        <label>Area</label>
        <input type="text" name="demo_area">    
    </div>
    
    
    <div>
        <label>Pincode</label>
        <input type="text" name="demo_pincode">    
    </div>
    
    
    <div>
        <label>ADDRESS</label>
        <input type="text" name="demo_address">    
    </div>
    
<div>
        <label>Date of Installation</label>
        <input type="text" name="ins_date" id="ins_date" onclick="displayDatePicker('ins_date');" value="<?php echo date('d/m/Y'); ?>" /> 
    </div>
    
    <div>
        <label>Installation State</label>
        <select id="state_st" name="state_st">
<option value="0">Select State</option>
<?php 
$sqlst=mysqli_query($con1,"select * from `state` order by state ASC");
while($sqlst1=mysqli_fetch_row($sqlst)){
?>
<option value="<?php echo $sqlst1[1]; ?>" <?php if($sqlst1[1]== $sql_result['state']) echo "selected"; ?>><?php echo $sqlst1[1]; ?></option>
<?php }?>
</select>
    </div>
    
    <div>
        <label>Installation Branch</label>
        <select id="branch_avo" name="branch_avo">
<option value="0">Select Branch</option>
<?php 
$sqlbr=mysqli_query($con1,"select * from `avo_branch`");
while($sqlbr1=mysqli_fetch_row($sqlbr)){
?>
<option value="<?php echo $sqlbr1[0]; ?>" <?php if($sqlbr1[0]==$sql_result['branch_id']) echo "selected"; ?>><?php echo $sqlbr1[1]; ?></option>
<?php }?>
</select> 
    </div>
 </div> 
<div><colspan="4" ><input type="submit" value="submit" class="readbutton" /></div>


</div>
</form>

</div>
</center>

 <script>
 
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
        $(this).val('');
    }
    
    
});

$(".total_qty").on("load",function(){


    alert($(this).val());
    
});


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




function check_atm(){
    

    var atm = $("#atm_id_check").val();
    
        $.ajax({
           type: "POST",
           url: 'get_custom_atmdetails.php',
           data: 'atm='+atm,
           success:function(msg) {

            if(msg !=0){
                   alert('Found ..! Please choose other name for atm');   
                   $("#atm_id_check").focus();
                   $("#atm_id_check").val('');

            }
            else{
                   alert('You can Proceed');       
                }
            }
           });
           
        }

</script>

</body>
</html>
<?php  ?>