<?php require_once(dirname(__FILE__) . '/config.php'); 
if ( !isset($_SESSION['Admin_ID']) || $_SESSION['Login_Type'] != 'admin' ) {
   	header('location:' . BASE_URL);
   	
} 

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="https://srishringarr.com/static/images/icons/favicon.png" />
	<title>Bulk Upload Attendance - Payroll</title>

	<link rel="stylesheet" href="<?php echo BASE_URL; ?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datatables/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datatables/jquery.dataTables_themeroller.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/AdminLTE.css">
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
					Attendance
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Attendance</li>
				</ol>
			</section>

			<section class="content">
				<div class="row">
        			<div class="col-xs-12">
        			    <div class="box">
        			        <div class="box-body">
                                <div>
                                    <h4>Employee Attendance<span style="font-size:12px; color:red;">(Bulk Upload)</span></h4>
                                    <a class="btn btn-success" href="https://srishringarr.com/payroll/excelformat/bulk_payroll_format.xlsx" download>ATTENDANCE UPLOAD FORMAT</a>
                                </div>

                                <?

                                if (isset($_POST['submit'])) {
                                    $userid = $_SESSION['userid'];
                                    
                                    $target_dir = 'PHPExcel/';
                                    $file_name = $_FILES["images"]["name"];
                                    $file_tmp = $_FILES["images"]["tmp_name"];
                                    $file =  $target_dir . '/' . $file_name;


                                    $status = 'open';
                                    $created_by = $_SESSION['userid'];
                                   // date_default_timezone_set('Asia/Kolkata');   
                                    $created_at = date('Y-m-d H:i:s');




                                    move_uploaded_file($file_tmp = $_FILES["images"]["tmp_name"], $target_dir . '/' . $file_name);
                                    include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
                                    $inputFileName = $file;

                                    try {
                                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                                        $objPHPExcel = $objReader->load($inputFileName);
                                    } catch (Exception $e) {
                                        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                                            $e->getMessage());
                                    }

                                    $sheet = $objPHPExcel->getSheet(0);
                                    $highestRow = $sheet->getHighestRow();
                                    $highestColumn = $sheet->getHighestColumn();

                                    for ($row = 1; $row <= $highestRow; $row++) {
                                        $rowData[] = $sheet->rangeToArray(
                                            'A' . $row . ':' . $highestColumn . $row,
                                            null,
                                            true,
                                            false
                                        );
                                    }

                                    $row = $row - 2;
                                    $error = '0';
                                    $contents = '';
                                    $updatekey = 0;
                                    $error_array = array();
                                    // echo '<pre>';print_r($rowData);echo '</pre>'; die;
                                    for ($i = 1; $i <= $row; $i++) {

                                        $id = $rowData[$i][0][0];
                                         
                                        if(isset($id) && $id!='' ){
                                            
                                            $date = $rowData[$i][0][1];
                                            //$pdate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($date));
                                            // $complaint_date =	date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($complaint_date));
                                            if($date!=''){
                                                $pdate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($date));
										    	//$pdate = date("Y-m-d",strtotime($date));
                                            }else{
                                                $pdate = '0000-00-00';
                                            }

                                            $start_time = $rowData[$i][0][2];
                                           // $_in_time = date('H:i', PHPExcel_Shared_Date::ExcelToPHP($in_time));
                                           
                                           $end_time = $rowData[$i][0][3];
                                          //  $_out_time = date('H:i', PHPExcel_Shared_Date::ExcelToPHP($out_time));
                                            
                                            if($start_time!=''){
                                              //  $date = new DateTime();
                                              //  $start_time = date('H:i:s', PHPExcel_Shared_Date::PHPToExcel($date->setTimestamp($start_time)));
											   $start_time = date('H:i:s', PHPExcel_Shared_Date::ExcelToPHP($start_time));
											} 
											if($end_time!=''){
											   $end_time = date('H:i:s', PHPExcel_Shared_Date::ExcelToPHP($end_time));
											}

                                            
                                          //  echo $_out_time."<br>";

                                            if($start_time !='' && $end_time !='') {

                                                $sql = "insert into attendance_test(ID,pdate,Intime,Outtime,created_at) 
                                                    values('" . $id . "','" . $pdate . "','" . $start_time . "','" . $end_time . "','" . $created_at . "')";

                                                if (mysqli_query($db, $sql)) {
                                                    $updatekey = $updatekey + 1;
                                                } else {
                                                    $sentence = "ID ". $id . " not able to update its value";
                                                    array_push($error_array, $sentence);
                                                }
                                            } else {

                                                $sentence = "<b> Wrong Excel Format !! Please Check !! </b>";
                                                array_push($error_array, $sentence);
                                            }
                                    } else {
                                        
                                    }
                                       
                                    }if ($updatekey > 0) { ?>
                                        <script>
                                            var key = <?php echo $updatekey; ?>;
                                            alert("Total no of rows inserted : " + key);
                                        </script>
                                <?php   }
                                }
                                ?>
                                <?php if (isset($error_array)) {
                                    if (count($error_array) > 0) {
                                ?> List of errors :
                                        <ul>
                                            <?php for ($i = 0; $i < count($error_array); $i++) { ?>
                                                <li>
                                                    <?php echo $error_array[$i]; ?>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                <?php }
                                } ?>
                                <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">

                                        <div class="col-sm-4">
                                            <input type="file" name="images" class="form-control" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="submit" name="submit" value="upload" class="btn btn-danger">
                                        </div>

                                    </div>
                                </form>
                                <br>
                            </div>
        			    </div>
        			    
						<div class="box">
							<div class="box-header">
								<h3 class="box-title">Employee Attendance</h3>
							</div>
                            
                        
							
							<div class="box-body">
								<div class="table-responsiove">
									<table id="bulk_upload_attendance1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>DATE</th>
												<th>EMP CODE</th>
												<th>NAME</th>
												<th>PUNCH-IN</th>
												<th>PUNCH-OUT</th>
												<th>WORK HOURS</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<footer class="main-footer">
			<strong> &copy; <?php echo date("Y");?> Payroll Management System | </strong> Developed By SAR Solutions Pvt. Ltd.
		</footer>
	</div>

	<script src="<?php echo BASE_URL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="<?php echo BASE_URL; ?>bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="<?php echo BASE_URL; ?>dist/js/app.min.js"></script>
	<script type="text/javascript">var baseurl = '<?php echo BASE_URL; ?>';</script>
	<script src="<?php echo BASE_URL; ?>dist/js/script.js?rand=<?php echo rand(); ?>"></script>
</body>
</html>