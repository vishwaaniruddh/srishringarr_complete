<?php include($_SERVER["DOCUMENT_ROOT"]."/CRM/side-top.php");?>

<div class="container ">

<form action="new_customer_process.php" method="POST">
<div class="row">
<div class="col-lg-12">

<!--widget card begin-->
<div class="card m-b-30">
    <div class="card-header">

<div class="row">
        <h5 class="m-b-0">New Customer Lead</h5>
</div>


        <!-- <p class="m-b-0 text-muted">Create new customer</p> -->
    </div>
    <div class="card-body ">
        
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name">
            </div>
            <div class="form-group col-md-6">
                <label for="branch_name">Branch Name</label>
                <input type="text" class="form-control" id="branch_name" name="branch_name">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="end_user_seg">End User Seg</label>
                
                <select class="form-control" name="end_user_seg">
                   <?php 

$branch_sql="select seg_name from user_segment where status=1 order by id ASC";


if ($result = $conn -> query($branch_sql)) {
  while ($row = $result -> fetch_assoc()) {




?>    

<option><?php echo $row['seg_name']; ?></option>


  <?php }
  $result -> free_result();
}



 ?>


                </select>
            </div>

<div class="col-md-4">
                <label for="end_user_seg">Customer Vertical</label>

        <select class="form-control" name="cust_vertical" id="cust_vertical">
            
           <?php 

$branch_sql=mysql_query("select * from customer_vertical");



  while ($branch_sql_result = mysql_fetch_assoc($branch_sql)) { ?>    

<option><?php echo $branch_sql_result['cust_name']; ?></option>


  <?php }



 ?>
 
 
        </select>
    </div>

            <div class="form-group col-md-4">
                <label for="designation">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" >
            </div>
        </div>



        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mobile">Mobile</label>
                <input type="number" class="form-control" id="mobile" placeholder="Mobile" name="mobile">
            </div>

	<div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
            </div>
        </div>





        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="landline">Landline</label>
                <input type="number" class="form-control" id="landline" placeholder="landline" name="landline">
            </div>
            <div class="form-group col-md-6">
                <label for="contact_type">Contact Type</label>
                <select class="form-control" name="end_user_seg">
                    <option>Visit</option>
                    <option>Phone</option>
                    <option>Mail</option>
                </select>
            </div>
        </div>



   <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" placeholder="city" name="city">
            </div>
            <div class="form-group col-md-6">
                <label for="state">State</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="state">
            </div>
        </div>

   <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pincode">Pincode</label>
                <input type="text" class="form-control" id="pincode" placeholder="pincode" name="pincode">
            </div>
            <div class="form-group col-md-6">
                <label for="area">Area</label>
                <input type="text" class="form-control" placeholder="Area" id="area" name="area">
            </div>
        </div>

        	<div class="form-row">
            <div class="form-group col-md-6">
                <label for="contact_person">Contact Person</label>
                <input type="text" class="form-control" id="contact_person" placeholder="contact_person" name="contact_person">
            </div>
            <div class="form-group col-md-6">
                <label for="sales_exe_name">Sales Executive Name</label>
                <input type="text" class="form-control" id="sales_exe_name" name="sales_exe_name">
            </div>
        </div>




        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="1234 Main St">
        </div>

        <div class="form-row">
        	
        	<div class="form-group col-md-8">
            <label for="remark">Remark</label>
            <input type="text" class="form-control" id="remark"
                   placeholder="Remarks" name="remark">
        	</div>

        		<div class="form-group col-md-4 cust_check">
                <input class="form-check-input" name="isCheck" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    If Customer is worth
                </label>
            </div>

    </div>




<div class="form-row">
            <div class="form-group col-md-6">
                <label for="product_requirement">Product Requirement</label>
                <input type="text" class="form-control" id="product_requirement" placeholder="Product Requirement" name="product_requirement">
            </div>
            <div class="form-group col-md-6">
                <label for="capacity">Capacity</label>
                <input type="text" class="form-control" id="capacity" name="capacity">
            </div>
        </div>





<div class="form-row">
            <div class="form-group col-md-4">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity">
            </div>

            <div class="form-group col-md-4">
                <label for="lakh_value">Value <span style="font-size: 12px;">(In lakhs)</span></label>
                <input type="number" class="form-control" id="lakh_value" name="lakh_value">
            </div>

            <div class="form-group col-md-4">
                <label for="finalization_date">Expected date of Finalization</label>
				<input type="text" name="finalization_date" class="js-datepicker form-control" placeholder="Select a Date">
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
                <input type="text" class="form-control" id="addition_remark" name="addition_remark">
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

</div>

</main>
</body>
</html>
