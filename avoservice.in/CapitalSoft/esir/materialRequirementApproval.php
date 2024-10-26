<? session_start();
include('config.php');

if($_SESSION['username']){ 

include('header.php');
?>
<link rel="stylesheet" type="text/css" href="../datatable/dataTables.bootstrap.css">
     
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="page-body">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Material Requirement Approval</h4>
                                    </div>
                                    <div class="card-block">
                                        <?
                                        
                                          $sqlappCount = "select count(1) as total from pre_material_inventory a INNER JOIN mis_details b ON a.mis_id = b.id LEFT JOIN mis_newsite c ON b.atmid = c.atmid
                                        where a.is_approved=0" ; 
                                        
                                        $statement = "select a.id,a.material,a.material_condition,a.remark,a.created_at,a.created_by,a.delivery_address,a.cancel_remarks,a.mis_id,
                                        b.atmid,
                                        c.address from pre_material_inventory a INNER JOIN mis_details b ON a.mis_id = b.id LEFT JOIN mis_newsite c ON b.atmid = c.atmid
                                        where a.is_approved=0 order by id desc"; 
                                        
                                        $result = mysqli_query($con, $sqlappCount);
                                        $row = mysqli_fetch_assoc($result);
                                        $total_records = $row['total'];
                                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        
                                        $page_size = 10;
                                        
                                        $offset = ($current_page - 1) * $page_size;
                                        
                                        
                                        $total_pages = ceil($total_records / $page_size);
                                        
                                        $window_size = 10;
                                        
                                        $start_window = max(1, $current_page - floor($window_size / 2));
                                        $end_window = min($start_window + $window_size - 1, $total_pages);
                                        
                                        // echo $statement ; 
                                        
                                        
                                        $sql_query = "$statement LIMIT $offset, $page_size";
                                        ?>
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th>Sr No</th>
        <th>ATMID</th>
        <th>MATERIAL</th>
        <th>MATERIAL CONDITION</th>
        <th>REMARK</th>
        <th>Created Date</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
        <?
                                        $i = 0;
                                        $counter = ($current_page - 1) * $page_size + 1;
                                        $sql_app = mysqli_query($con, $sql_query);
                                        while ($sql_result = mysqli_fetch_assoc($sql_app)) { 
                                            $id = $sql_result['id'];
                                            $atmid = $sql_result['atmid'] ; 
                                            $mis_id = $sql_result['mis_id'];
                                            ?>
                                            <tr>
                                                <td><? echo $counter; ?></td>
                                                <td><a href="#" class="misid" data-toggle="modal" data-target="#myModal" data-misid="<?= $mis_id; ?>" data-id="<?= $id; ?>" data-atmid="<?= $atmid ; ?>"><?= $atmid ; ?></a></td>
                                                <td><? echo $sql_result['material']; ?></td>
                                                <td><? echo $sql_result['material_condition']; ?></td>
                                                <td><? echo $sql_result['remark']; ?></td>
                                                <td><? echo $sql_result['created_at']; ?></td>
                                                <td><? echo get_member_name($sql_result['created_by']); ?></td>
                                            </tr>
                                                
                                            <?
                                        $counter++;
                                        }
                                        
                                        ?>

    </tbody>
  </table>

<?

						
echo '<div class="pagination"><ul>';
if ($start_window > 1) {

    echo "<li><a href='?page=1'>First</a></li>";
    echo '<li><a href="?page=' . ($start_window - 1) . '">Prev</a></li>';
}

for ($i = $start_window; $i <= $end_window; $i++) {
?>
    <li class="<? if ($i == $current_page) { echo 'active'; }?>" >
        <a href="?page=<? echo $i; ?>" >
            <? echo $i;  ?>
        </a>        
    </li>

 <? }

if ($end_window < $total_pages) {

    echo '<li><a href="?page=' . ($end_window + 1) . '">Next</a></li>';
    echo '<li><a href="?page=' . $total_pages . '">Last</a></li>';
}
echo '</ul></div>';
										
										
										?>



										
										
									<style>
.pagination {
  display: flex;
    margin: 10px 0;
    padding: 0;
    justify-content: center;
}

.pagination li {
  display: inline-block;
  margin: 0 5px;
  padding: 5px 10px;
  border: 1px solid #ccc;
  background-color: #fff;
  color: #555;
  text-decoration: none;
}

.pagination li.active {
  border: 1px solid #007bff;
  background-color: #007bff;
  color: #fff;
}

.pagination li:hover:not(.active) {
  background-color: #f5f5f5;
  border-color: #007bff;
  color: #007bff;
}
									</style>

   </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
 
 
 <script>


function showAlert(type, message) {
          Swal.fire({
            icon: type,
            title: type.charAt(0).toUpperCase() + type.slice(1),
            text: message,
            showConfirmButton: false,
            timer: 1500
          }).then(function () {
                window.location.href = "materialRequirementApproval.php";
            });
        }

$(document).ready(function(){
$('.misid').click(function(){
  var misid = $(this).data('misid');
    $("#misid").val(misid);
    $("#pre_material_inventoryID").val($(this).data("id"));

  $.ajax({
    type: 'GET',
    url: 'getMaterialData.php', 
    data: { 'misid': misid },
    success: function(data) {
      var materialData = JSON.parse(data);
      console.log(materialData);

      $('#materialName').val(materialData.material);
      $('#oldRemark').val(materialData.oldRemark);
    },
    error: function() {
      showAlert('error', 'Error fetching data');
    }
  });
});

$('#myModal form').submit(function(e) {
  e.preventDefault();
  var formData = $(this).serialize();
  
  $.ajax({
    type: 'POST',
    url: 'modifyMaterialRequestRequest.php',
    data: formData,
    success: function(response) {
      showAlert('success', 'Form submitted successfully!');
      $('#myModal').modal('hide');
    },
    error: function() {
      showAlert('error', 'Error submitting form');
    }
  });
});
});

$(document).on('click','.approveEntry',function(){
  var formData = $('#modifyMaterialForm').serialize();
      var misid = $('#misid').val(); 

  $.ajax({
    type: 'POST',
    url: 'modifyMaterialRequestRequest.php',
    data: {
        formData: formData,
        action: 'approve', 
        misid: misid
    },
    success: function(response) {
      showAlert('success', 'Entry approved!');
      $('#myModal').modal('hide');
    },
    error: function() {
      showAlert('error', 'Error submitting form');
    }
  });
})

$(document).on('click','.rejectEntry',function(){
    var formData = $('#modifyMaterialForm').serialize();
    var misid = $('#misid').val(); 
    
      $.ajax({
        type: 'POST',
        url: 'modifyMaterialRequestRequest.php',
        data: {
              formData: formData,
              action: 'reject',
              misid: misid
            },

        success: function(response) {
          showAlert('success', 'Entry rejected!');
          $('#myModal').modal('hide');
          
          
        },
        error: function() {
          showAlert('error', 'Error submitting form');
        }
      });
    });



</script>

</script>



<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Material Requirement Information</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form id="modifyMaterialForm"> <!-- Add an id to the form -->
            <input type="hidden" id="misid" name="misid">
            <input type="hidden" id="pre_material_inventoryID" name="pre_material_inventoryID">
            
            
          <div class="form-group">
            <label for="materialName">MATERIAL NAME:</label>
            <select class="form-control" id="materialName" name="material">
                <option value="">Select</option>
                <?php
                $mat_sql = mysqli_query($con, "select * from material where status=1 ");
                while ($mat_sql_result = mysqli_fetch_assoc($mat_sql)) {
                    ?>
                    <option value="<?php echo $mat_sql_result['material']; ?>">
                        <?php echo $mat_sql_result['material']; ?></option>
                <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="oldRemark">OLD REMARK:</label>
            <input type="text" class="form-control" id="oldRemark" name="oldRemark" placeholder="Enter old remark">
          </div>
          <div class="form-group">
            <label for="newRemark">NEW REMARK:</label>
            <input type="text" class="form-control" id="newRemark" name="newRemark" required placeholder="Enter new remark">
          </div>
          <div class="form-group text-center">
            <button type="button" class="btn btn-success mr-2 approveEntry" >Approve</button>
            <button type="button" class="btn btn-danger rejectEntry">Wrong Entry</button>
          </div>
        </form>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
 .modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 126vw;
    height: 116vh;
    background-color: #000;
}
</style>

    <? include('footer.php');    }
else{ ?>
    
    <script>
        window.location.href="login.php";
    </script>
<? } ?>

