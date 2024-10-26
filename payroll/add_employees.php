<?php require_once(dirname(__FILE__) . '/config.php'); 
if ( !isset($_SESSION['Admin_ID']) || $_SESSION['Login_Type'] != 'admin' ) {
   	header('location:' . BASE_URL);
} ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="icon" type="image/png" href="https://srishringarr.com/static/images/icons/favicon.png" />
	<title>Employees - Payroll</title>

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datatables/jquery.dataTables_themeroller.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/AdminLTE.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datepicker/datepicker3.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/skins/_all-skins.min.css">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		
		<?php require_once(dirname(__FILE__) . '/partials/topnav.php'); ?>

		<?php require_once(dirname(__FILE__) . '/partials/sidenav.php'); ?>

		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Employees
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Add Employees</li>
				</ol>
			</section>

			<section class="content">
				<div class="row">
        			<div class="col-xs-12">
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Add Employee</h3>
								<?php if ( $_SESSION['Login_Type'] == 'admin' ) { ?>
									<button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#AddEmpModal">
										<i class="fa fa-plus"></i> Add Employee
									</button>
								<?php } ?>
							</div>
						<br>
							<div class="box">
        			        <div class="box-body">
        			            <h3 class="box-title"><b>Employee List</b></h3>
        			            <table class="table">
        			                <thead>
        			                    <tr>
        			                        <th>Sr No.</th>
        			                        <th>Employee Code.</th>
        			                        <th>Name</th>
        			                        <th>Email</th>
        			                        <th>Address</th>
        			                        <th>Woking Hours</th>
        			                        <!--<th>Actions</th>-->
        			                    </tr>
        			                    <tbody>
        			                        
            			            <?
            			            $i=1;
            			            $emp_sql = mysqli_query($db,"select ssn,concat(salutation, ' ', firstname,' ',lastname) as name,email,address1,perday_hours from employee order by empid asc");
            			            while($emp_sql_result = mysqli_fetch_assoc($emp_sql)){ 
                			            $empid = $emp_sql_result['ssn'];
                			            $nextempid = $empid + 1;
                			            $empname = ucwords($emp_sql_result['name']);
                			            $email = $emp_sql_result['email'];
                			            $address = $emp_sql_result['address1'];
                			            $work_hr = $emp_sql_result['perday_hours'];
            			            ?>
                			            <tr>
                			                <td><? echo $i; ?></td>
                			                <td><? echo $empid; ?></td>
                			                <td><? echo $empname; ?></td>
                			                <td><? echo $email; ?></td>
                			                <td><? echo $address; ?></td>
                			                <td><? echo $work_hr; ?></td>
                			                <!--<td><a class="btn btn-success" href="../view_emp_records.php?empid=<? echo $empid; ?>" target="_blank">View</a></td>-->
                			            </tr>    
            			            <? $i++; } ?>
        			            
        			                    </tbody>
        			                </thead>
        			            </table>
        			            
        			        </div>
        			    </div>
						</div>
					</div>
				</div>
			</section>
		</div>

		
		
			<div class="modal fade in" id="AddEmpModal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">Add Employee Details</h4>
					</div>
					<form method="post" role="form" data-toggle="validator" id="add-employee-form">
						<div class="modal-body">
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="salutation">Salutation</label>
										<input type="text" class="form-control" name="salutation" id="salutation" required />
									</div>
									<div class="col-sm-4">
										<label for="first_name">First Name</label>
										<input type="text" class="form-control" name="first_name" id="first_name" required />
									</div>
									<div class="col-sm-4">
										<label for="last_name">Last Name</label>
										<input type="text" class="form-control" name="last_name" id="last_name" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="dob">Emp. DOB (MM/DD/YYYY)</label>
										<input type="text" class="form-control datepicker" name="dob" id="dob" required />
									</div>
									<div class="col-sm-4">
										<label for="gender">Gender</label>
										<select class="form-control" name="gender" id="gender" required>
											<option value="">Please make a choice</option>
											<option value="m">Male</option>
											<option value="f">Female</option>
										</select>
									</div>
									<div class="col-sm-4">
										<label for="merital_status">Marital Status</label>
										<input type="text" class="form-control" name="merital_status" id="merital_status" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									
									<div class="col-sm-4">
										<label for="city">City</label>
										<input type="text" class="form-control" name="city" id="city" required />
									</div>
									
									<div class="col-sm-4">
										<label for="state">State</label>
										<input type="text" class="form-control" name="state" id="state" required />
									</div>
									
									<div class="col-sm-4">
										<label for="email">Email</label>
										<input type="email" class="form-control" name="email" id="email" required />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label for="address">Address</label>
										<textarea class="form-control" name="address" id="address" required></textarea>
									</div>
								</div>
							</div>
						
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label for="active">Active</label>
										<select class="form-control" name="active" id="active" required >
										    <option value="">Select</option>
										    <option value="y">Yes</option>
										    <option value="n">No</option>
										</select>
									</div>
									
									<div class="col-sm-4">
										<label for="work_hours">Per Day Work (Hr.)</label>
										<input type="text" class="form-control" name="work_hours" id="work_hours" required />
									</div>
									
									<div class="col-sm-4">
										<label for="empid">Empid</label>
										<input type="text" class="form-control" name="empid" id="empid" value="<? echo $nextempid; ?>" readonly />
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="submit" class="btn btn-primary">Add Employee</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<footer class="main-footer">
		<strong> &copy; <?php echo date("Y");?> Payroll Management System | </strong> Developed By Sar Solutions Pvt. Ltd.
		</footer>
	</div>

	<script src="<?php echo BASE_URL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo BASE_URL; ?>bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/jquery-validator/validator.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo BASE_URL; ?>dist/js/app.min.js"></script>
	<script type="text/javascript">var baseurl = '<?php echo BASE_URL; ?>';</script>
	<script src="<?php echo BASE_URL; ?>dist/js/script.js?rand=<?php echo rand(); ?>"></script>
</body>
</html>