<?php include($_SERVER["DOCUMENT_ROOT"]."/CRM/side-top.php");?>






<section class="admin-content">
	
<div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span>All Customer
                        </h4>
                    </div>
                </div>
            </div>
        </div>






<div class="container  pull-up">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example_length">
                               

                                </div>
                            </div>
                        </div>

                        
<div class="row">
	<div class="col-sm-12">
		<table id="example" class="table dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
<thead>
<tr role="row">



    <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 157px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Sr. No.</th>

	<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 157px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>

	<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 247px;" aria-label="Position: activate to sort column ascending">Title</th>
	<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119px;" aria-label="Office: activate to sort column ascending">Designation</th>

	<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 57px;" aria-label="Age: activate to sort column ascending">Employee ID</th>

	<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 131px;" aria-label="Start date: activate to sort column ascending">Location</th>

	<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 92px;" aria-label="Salary: activate to sort column ascending">Email</th>
	
	<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 92px;" aria-label="Salary: activate to sort column ascending">Team Head</th>

	<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 92px;" aria-label="Salary: activate to sort column ascending">Report To</th>

    <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 92px;" aria-label="Salary: activate to sort column ascending">Actions</th>

</tr>

</thead>
<tbody>



<?php 
$sql = "SELECT * FROM customer where status=1";

if ($result = $conn -> query($sql)) {
  while ($row = $result -> fetch_row()) {

?>    

<tr role="row" class="odd">
<td><?php echo ucwords($row[0]); ?></td>
<td><?php echo ucwords($row[1]); ?></td>
<td><?php echo ucwords($row[2]); ?></td>
<td><?php echo ucwords($row[3]); ?></td>
<td><?php echo ucwords($row[4]); ?></td>
<td><?php echo ucwords($row[5]); ?></td>
<td><?php echo ucwords($row[6]); ?></td>
<td><?php echo ucwords($row[7]); ?></td>
<td><?php echo ucwords($row[8]); ?></td>
<td class="actions"><a class="btn btn-success edit" href="<?php $_SERVER["SERVER_NAME"]?>/CRM/customer/edit_customer.php?id=<?php echo $row[0];?>">Edit</a>
 <button  class="btn btn-danger delete" 
 onclick="if(window.confirm('Are you sure !!'))

 window.location.href='<?php $_SERVER["SERVER_NAME"]?>/CRM/customer/delete_customer.php?id=<?php echo $row[0];?>';">
Delete
</button></td>

</tr>


  <?php }
  $result -> free_result();
}



 ?>


</tbody>
</table>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>




</main>


</body>
</html>

