<?php include($_SERVER["DOCUMENT_ROOT"]."/CRM/side-top.php");?>

<div class="container ">


<?php 
 $id=$_GET['id'];

$customer = "SELECT * FROM customer WHERE id=$id";

$customer_contact = "SELECT * FROM customer_contact WHERE customer_id=$id";



if ($result = $conn -> query($customer)) {
  while ($cust_row = $result -> fetch_assoc()) {


if ($result2 = $conn -> query($customer_contact)) {
  while ($cust_con_row = $result2 -> fetch_assoc()) {

// var_dump($cust_con_row);



?>    




<form action="<?php $_SERVER["DOCUMENT_ROOT"]?>/CRM/customer/update_customers.php?id=<?php echo $id; ?>" method="POST">
<div class="row">
<div class="col-lg-12">

<!--widget card begin-->
<div class="card m-b-30">
    <div class="card-header">

<div class="row">
        <h5 class="m-b-0">Edit Customer</h5>
</div>


        <!-- <p class="m-b-0 text-muted">Create new customer</p> -->
    </div>
    <div class="card-body ">
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $cust_row['name']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="branch_name">Branch Name</label>
                <input type="text" class="form-control" id="branch_name" name="branch_name" value="<?php echo $cust_row['branch_name']; ?>">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="end_user_seg">End User Seg</label>
                
                <select class="form-control" name="cust_segment">
                    <option>BFSI</option>
                    <option>Commercial</option>
                    <option>Govt</option>
                    <option>Defence</option>
                    <option>Energy</option>
                    <option>Industry</option>
                    <option>IT-BPO</option>
                    <option>Health</option>
                    <option>Infra</option>
                    <option>Others</option>
                </select>

                   <script>
$("select option").each(function(){
  if ($(this).text() == "<?php echo $cust_row['cust_segment']?>")
    $(this).attr("selected","selected");
});
</script>


            </div>

<div class="col-md-4">
                <label for="end_user_seg">Customer Vertical</label>

        <select class="form-control" name="cust_vertical" id="cust_vertical">
            
            <option>Mphasis</option>
            <option>EPS</option>
            <option>TATA</option>
        </select>
    </div>

            <div class="form-group col-md-4">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo $cust_row['designation']; ?>">
            </div>
        </div>



        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mobile">Mobile</label>
                <input type="number" class="form-control" id="mobile" placeholder="Mobile" name="mobile"  value="<?php echo $cust_con_row['mobile']; ?>">
            </div>

	<div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email"  value="<?php echo $cust_con_row['email']; ?>">
            </div>
        </div>





        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="landline">Landline</label>
                <input type="number" class="form-control" id="landline" placeholder="landline" name="landline"  value="<?php echo $cust_con_row['landline']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="contact_type">Contact Type</label>
                <select class="form-control" name="contact_type" value="<?php echo $cust_row['contact_type']; ?>">
                    <option>Visit</option>
                    <option>Phone</option>
                    <option>Mail</option>
                </select>
                 

   <script>
$("select option").each(function(){
  if ($(this).text() == "<?php echo $cust_row['contact_type']?>")
    $(this).attr("selected","selected");
});
</script>
            </div>
        </div>



   <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="city" name="city"  value="<?php echo $cust_con_row['city']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="state"  value="<?php echo $cust_con_row['state']; ?>">
            </div>
        </div>

   <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pincode">Pincode</label>
                <input type="text" class="form-control" id="pincode" placeholder="pincode" name="pincode"  value="<?php echo $cust_con_row['pincode']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="area">Area</label>
                <input type="text" class="form-control" placeholder="Area" id="area" name="area"  value="<?php echo $cust_con_row['area']; ?>">
            </div>
        </div>

        	<div class="form-row">
            <div class="form-group col-md-6">
                <label for="contact_person">Contact Person</label>
                <input type="text" class="form-control" id="contact_person" placeholder="contact_person" name="contact_person"  value="<?php echo $cust_row['contact_person']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="sales_exe_name">Sales Executive Name</label>
                <input type="text" class="form-control" id="sales_exe_name" name="sales_exe_name"  value="<?php echo $cust_row['sales_exe_name']; ?>">
            </div>
        </div>




        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St"  value="<?php echo $cust_con_row['address']; ?>">
        </div>

        <div class="form-row">
        	
        	<div class="form-group col-md-8">
            <label for="remark">Remark</label>
            <input type="text" class="form-control" id="remark"
                   placeholder="Remarks" name="remark"  value="<?php echo $cust_row['remark']; ?>">
        	</div>

        		<div class="form-group col-md-4 cust_check">


                <input class="form-check-input" name="isWorth" type="checkbox" id="isWorth" >

                <label class="form-check-label" for="gridCheck">
                    If Customer is worth
                </label>
            </div>

    </div>




<div class="form-row">
            <div class="form-group col-md-6">
                <label for="product_requirement">Product Requirement</label>
                <input type="text" class="form-control" id="product_requirement" placeholder="Product Requirement" name="product_requirement"  value="<?php echo $cust_row['product_requirement']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="capacity">Capacity</label>
                <input type="text" class="form-control" id="capacity" name="capacity"  value="<?php echo $cust_row['capacity']; ?>">
            </div>
        </div>





<div class="form-row">
            <div class="form-group col-md-4">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity"  value="<?php echo $cust_row['quantity']; ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="lakh_value">Value <span style="font-size: 12px;">(In lakhs)</span></label>
                <input type="number" class="form-control" id="lakh_value" name="lakh_value"  value="<?php echo $cust_row['lakh_value']; ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="finalization_date">Expected date of Finalization</label>
				<input type="text" name="finalization_date" class="js-datepicker form-control" placeholder="Select a Date"  value="<?php echo $cust_row['finalization_date']; ?>">
            </div>



        </div>





        <div class="form-row">
		<div class="form-group col-md-4">
                <label for="order_chance">Chance of Order</label>
                
                      <select class="form-control" name="order_chance">
                    <option>Low</option>
                    <option>Medium</option>
                    <option>High</option>
                </select>
            </div>

            <div class="form-group col-md-8">
                <label for="addition_remark">Additional Remark</label>
                <input type="text" class="form-control" id="addition_remark" name="addition_remark"  value="<?php echo $cust_row['addition_remark']; ?>">
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</div>

</div>




</form>

<script>
    
            

// $("select option").each(function(){
//   if ($(this).text() == "<?php echo $cust_con_row['cust_segment']?>")
//     $(this).attr("selected","selected");
// });



                                </script>


</script>


<?php

 if ($cust_row['isWorth'] !=0 ){ ?>
                   <script>
$('#isCheck').attr('checked', 'checked');
</script>
 <?php }

else { ?>
<script>
$('#isCheck').removeAttr('checked');
    
</script>
<?php } ?>




  <?php }  } 

   }  $result -> free_result();
} ?>




</div>

</main>
</body>
</html>
