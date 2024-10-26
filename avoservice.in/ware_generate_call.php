<?php
include('config.php');

  $soid = $_GET['id'];

$sales_qry = mysqli_query($con1,"select * from new_sales_order where so_trackid='".$soid."'");
    
    $so_row = mysqli_fetch_assoc($sales_qry);
    //==========Customer========
    $cust_sql = mysqli_query($con1,"select cust_id, cust_name from customer where cust_id ='".$so_row['po_custid']."'");
    $cust_row=mysqli_fetch_assoc($cust_sql);
    $cust_id=$cust_row['cust_id'];
    $cust_name=$cust_row['cust_name'];
    
    //=============PO
    
    $posql= mysqli_query($con1,"select po_no from purchase_order where id = '".$so_row['po_trackid']."' ");
    
    $po_result = mysqli_fetch_assoc($posql);
    $po_no=$po_result['po_no'];

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



function get_consume_quantity($soid,$product){
    
    global $con1;
    
 //echo "SELECT * FROM so_consumption where so_trackid='".$soid."' and po_product='".$product."'";
    $sql = mysqli_query($con1,"SELECT * FROM so_consumption where so_trackid='".$soid."' and po_product='".$product."'");
    
    
    if($sql_result = mysqli_fetch_assoc($sql)){
    
        $consume_quantity = $sql_result['po_consumqty'];
    
        return $consume_quantity;    
    }
    else{
        return 0;
    }
    
    
    
    
}


function get_atm($parameter, $id){
    
    global $con1;
    
    $sql= mysqli_query($con1,"select $parameter from demo_atm where so_id = '".$id."' ");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result[$parameter];
    
}



function get_avail_quantity($soid,$product){
    
    global $con1;
    
    $sql = mysqli_query($con1,"SELECT * FROM so_consumption where so_trackid='".$soid."' and po_product='".$product."'");
    
    if($sql_result = mysqli_fetch_assoc($sql)){
        
        $available_quantity = $sql_result['po_qty'] - $sql_result['po_consumqty'];
    
        return $available_quantity;
    
    }
    else{
        return false;
    }
    
}


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
  #menu-bar li:hover > ul{
            text-align:center;
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
 #menu-bar ul{
    z-index: 999;
}
      </style>
      
      
</head>

<body>
<center>
<?php include("menubar.php"); ?>

<h2>Generate Installation Call <span style="font-size:12px; color:#fdd835;">(warehouse- Installation Required)</span></h2>

<?
$sql = mysqli_query($con1,"select * from demo_atm where so_id='".$soid."'");
$sql_result = mysqli_fetch_assoc($sql);
?>
<div class="demo_consignee_details">

    <h3 style="color:white; text-align:center;">Consignee Details</h3>
    <div>
        <label>SO Track Id</label>
        <span><? echo $sql_result['atm_id'];?></span>
    </div>
    

    <div>
        <label>City</label>
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
        <label>Pincode</label>
    <span><? echo $sql_result['pincode'];?></span>    
    </div>
    
    
    <div>
        <label>Address</label>
        <span><? echo $sql_result['address'];?></span>    
    </div>
    

    <div>
        <label>State</label>
        <span><? echo $sql_result['state'];?></span>    
    </div>
    
    
    <div>
        <label>Branch</label>
        <span><? echo get_branch_name($sql_result['branch_id']);?></span>
    </div>
    
</div>

<div id="header">

<form action="process_warehouse.php?id=<? echo $soid; ?>" method="post" name="form" onSubmit="return validate1(this)">

<input type="hidden" id="so_id" name="so_id" value="<?php echo $soid;?>">
<br/>


<div id="assets" style="display:block;">
<table >
 <tr><td>
Subject : </td>
  <td>

<input type="text" name="sub" id="sub">
<input type="hidden" name="callid" id="callid" value="<?php echo $callid; ?>" />
</td>
<td> Client Docket Number :
<td> 
<input type="text" name="doc" id="doc" value="New Installation" readonly>

</td></tr>
<tr>

<td> Customer :</td> 
<td><? echo $cust_name; ?> </td>
<input type="hidden" name="cust" id="cust" value="<?php echo $cust_id; ?>">  

<td> PO No :
<td id="po_no"> 

<input type="text" name="po" id="po" value="<?php echo $po_no; ?>" >

</td></tr>


</table>
<br>

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
                    $po_sql = mysqli_query($con1,"select * from new_sales_order_asset where so_trackid = '".$soid."'");
                    
                    while($po_sql_result= mysqli_fetch_assoc($po_sql)){
                        

                        
                    $assid = $po_sql_result['so_assetID'];
                    $asset_id =$po_sql_result['po_model']; 
                    
                    $avlqty=get_avail_quantity($soid,$assid);
                    $consqty=get_consume_quantity($soid,$assid);
                  //  echo $consqty."-Consumed Qty";
                    
                    
                    ?>
                       <tr id="<? echo $id; ?>" pending_qty="<? echo $avlqty?>"> 
                       
                       <td style="display: flex; justify-content: center;">
                           
                           <input class="select_product" name="select_product[]" class="checkbox_ck" id="check_product" value="<? echo $assid; ?>" type="checkbox">
 
                       </td>
                       
                        <td>
                            <? echo $po_sql_result['po_product'];?>
                            
                        </td>
                       
                        <td>
                            <? echo get_asset_name($asset_id); ?>
                           
                        </td>
                       
                        <td style="width:10%;">
                             <input type="number" id="po_qty" class="po_qty <? echo $assid;?>"
                             
                             value="<? echo get_consume_quantity($soid,$assid) ? get_avail_quantity($soid,$assid) : $po_sql_result['po_qty']; ?>"
                             
                             
                             max-quantity="<? echo get_consume_quantity($soid,$assid) ? get_avail_quantity($soid,$assid) : $po_sql_result['po_qty']; ?>" readonly>
                             
                        </td>
                  
                        

                         <td style="width:10%;">
                             
                            <label style="color:black" id="available_qty">
                                <?
                                 if(get_consume_quantity($soid,$assid) != false){

                                echo $avlqty;
                            }
                            else{
                                echo $po_sql_result['po_qty'];
                            }
                                ?>
                            </label>
                         </td>
                         
                         <td style="width:10%;">


                           <? echo get_consume_quantity($soid,$assid)?>
                            
                         </td>
                         
                        <td class="total_qty">
                            <label style="color:black" id="total_qty" value="<? echo $po_sql_result['po_qty']?>"><? echo $po_sql_result['po_qty']?></label>

                        </td>
                         
                        
                          </tr> 
                    <? } ?>

</table>







<?
$qryasst=mysqli_query($con1,"Select * from new_sales_order_asset where so_trackid='".$soid."'");
$cnt=1;
while($asstres=mysqli_fetch_assoc($qryasst))
{
  ?>  
       <input type="hidden" name="assetsme[]" id="assetsme[]" onClick="javascript:astselect('assetsme<?php echo $cnt ?>');"
       
       value="<?php echo $asstres['so_assetID']."*". $asstres['po_product']."*".$asstres['po_model']."*".$asstres['po_qty']."*".$asstres['po_warr']; ?>" checked/> 
       
          
       
  <? 
 $cnt=$cnt+1;   
}
?>

<br>
<table style="width:80%;">

<tr>
    <h3 style="color:white; text-align:center;">Installation Location</h3>
    <td>Site ATM Id </td>
    
    <td><input type="text" id="atm_id_check" name="demo_atm_id" onchange="check_atm(); return;"></td> </tr>
    <tr><td>End User Name</td>
    <td><input type="text" name="demo_bank_name"> </td></tr>

    <tr><td>City :</td>
    <td><input type="text" name="demo_city"></td></tr>
    <tr>
    <td>Area</td>
    <td><input type="text" name="demo_area"></td></tr>
    <tr>
   <td>Pincode</td>
   <td><input type="number" name="demo_pincode"></td> </tr>
   <tr>
    <td>Address :</td>
    <td><input type="text" name="demo_address"> </td>
    </tr>

<tr>
<td >Preffered Date : </td><td colspan="3"><input type="text" name="adate" id="adate" onclick="displayDatePicker('adate');" value="<?php echo date('d/m/Y'); ?>" /></td>
</tr>

<!---STATE wise-->

<tr>
<td height="35">STATE : </td>
<td colspan="3">
    
<select id="state_st" name="state_st">
<option value="0">Select State</option>
<?php 
$sqlst=mysqli_query($con1,"select * from `state`");
while($sqlst1=mysqli_fetch_row($sqlst)){
?>
<option value="<?php echo $sqlst1[1]; ?>" <?php if($sqlst1[1]== get_atm('state', $soid)) echo "selected"; ?>><?php echo $sqlst1[1]; ?></option>
<?php }?>
</select>
</td>
</tr>

<!---Branch wise-->

<tr>
<td height="35">Branch : </td>
<td colspan="3">
<select id="branch_avo" name="branch_avo">
<option value="0">Select Branch</option>
<?php 
$sqlbr=mysqli_query($con1,"select * from `avo_branch`");
while($sqlbr1=mysqli_fetch_row($sqlbr)){
?>
<option value="<?php echo $sqlbr1[0]; ?>" <?php if($sqlbr1[0]==get_atm('branch_id', $soid)) echo "selected"; ?>><?php echo $sqlbr1[1]; ?></option>
<?php }?>
</select>
</td>
</tr>

<tr>
<td height="35">Requirement : </td>
<td colspan="3"><textarea rows="4" cols="28" name="prob" id="prob"></textarea></td>
</tr>

 <tr>
<td height="35">Contact Person : </td>
<td colspan="3"><input type="text" name="cname" id="cname" value="<?php echo $so_row['user_cont_name'];?>"/></td>
</tr>

<tr>
<td height="35">Contact : </td>
<td colspan="3"><input type="text" name="cphone" id="cphone" value="<?php echo $so_row['user_cont_phone'];?>"/></td>
</tr>   


<tr>
<td height="35">Email : </td>
<td colspan="3"><input type="checkbox" name="em" id="em" checked/><input type="text" name="cemail" id="cemail" value="<?php echo $so_row['user_mail'];?>"/></td>
</tr>
<tr>
<td height="35">CC Email : </td>
<td colspan="3"><?php
$cc=mysqli_query($con1,"select e.email,c.cust_name,e.bank from emailid e,customer c where e.custid=c.cust_id and e.status=0 and type='service' order by c.cust_name,e.bank ASC");
?>
<select name='cc' id='cc' onchange="fill();">
<option value="">Select CC Emails</option>
<?php
while($ccro=mysqli_fetch_array($cc))
{
?>
<option value="<?php echo $ccro[0]; ?>"><?php echo $ccro[1]." - ".$ccro[2]; ?></option>
<?php
}
?>
</select><br><textarea name="ccemail" id="ccemail"  rows=5 cols=25><?php if(isset($_POST['ccemail'])){ echo $_POST['ccemail']; } ?></textarea></td>
</tr>
<tr>
<td colspan="4" height="35"><input type="submit" value="submit" class="readbutton" /></td>
</tr>
</table>
</div>
</form>

</div>
</center>

 <script>
 

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
    
   // atm=document.getElementById('atm').value;
   // alert("Size: "+document.getElementById('atm').value.length)
    length=atm.length;
   // alert(length);
    if(length <= 5){
       //  alert("Size: "+document.getElementById('atm').value.length)
        alert('Site Id Must be 5+ Charecters without any space !');
        	
        	$("#area,#city,#pin,#address,#consignee, #state").prop('readonly', false);
        	
        	$("#area,#city,#pin,#address,#consignee,#site_branch,#state").val('');
        		
        	 $("#site_branch,#state").prop('disabled', false);
        	 
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
        }

</script>

</body>
</html>
<?php  ?>