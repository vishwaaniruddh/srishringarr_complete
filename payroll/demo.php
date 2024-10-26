<?php require_once(dirname(__FILE__) . '/config.php'); 
if ( !isset($_SESSION['Admin_ID']) || $_SESSION['Login_Type'] != 'admin' ) {
  	header('location:' . BASE_URL);
} 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



date_default_timezone_set('Asia/Kolkata');

ini_set("max_execution_time", "-1");
ini_set("memory_limit", "-1");
ignore_user_abort(true);
set_time_limit(0);

function datetimeval($id,$date){
    global $db;
    $in_out = array();
    $sql = mysqli_query($db,"select * from raw_attendance where emp_id='".$id."' and cast(attendance_date as date)='".$date."'");
    while($sql_result = mysqli_fetch_assoc($sql)){
        $in_out[] = $sql_result['attendance_date'];        
    }

return $in_out ;
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
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.memin.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
		
		<?php require_once(dirname(__FILE__) . '/partials/topnav.php'); ?>

		<?php require_once(dirname(__FILE__) . '/partials/sidenav.php'); ?>
		
		<style>
		thead{
		    background: #3939bd;
                color: white;
		}
		        
		</style>
		
		<script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
		
		  <script>
      $(document).ready(function() {
    	$('#example').DataTable( {
	    "order": [],
		"processing": true,
		"serverSide": true,
		"ajax": "<?php echo BASE_URL; ?>json/view_attendance.php",
		"dom" : 'Bfrtip',
		"buttons": [
            'copy', 'csv', 'excel', 'print'
        ],
		"columnDefs": [
		    {
		        "render": createManageBtn,
		        "data": 5,
		        "targets": [0]
		    }
		    ],
	} );
} );

        function createManageBtn() {
            return '<button id="manageBtn" type="button" class="btn btn-success btn-xs">Edit</button>';
        }
        
var table;
$(document).ready( function () {
 table  = $('#example').DataTable();
} );



    $('body').on('click', '#manageBtn', function(){
        var row  = $(this).parents('tr')[0];
        let data =  table.row( row ).data() 
        var id = data[1];
        
        // window.location.href="designsheet.php?id="+id ; 
});
  </script>   


		
		
		
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
                                    
                                    // mysqli_query($db,"truncate table raw_attendance");
                                    // mysqli_query($db,"truncate table new_attendance");
                                    
                                    
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
                                    
                                    $in_ar = array();
                                    $out_ar = array();
                                    for ($i = 0; $i <= $row; $i++) {

                                        $id = $rowData[$i][0][0] ;
                                        
                                        $col = $i+1 ;
                                        
                                        $datetime = $objPHPExcel->getActiveSheet()->getCell('B'.$col)->getFormattedValue();
                                        $datetime = date("Y-m-d H:i:s", strtotime($datetime) );
                                        
                                        $onlydate = date("Y-m-d", strtotime($datetime) );
                                        if(isset($id) && $id!='' ){
                                            $string =  $id.'='.$onlydate;
                                            
                                            if (!in_array($string, $in_ar)){
                                                $in_ar[] = $string; 
                                            }else{
                                                $out_ar[] = $string; 
                                            }
                                            

                                            $check_sql = mysqli_query($db,"select * from raw_attendance where emp_id='".$id."' and attendance_date='".$datetime."' and status=1");
                                            if( $check_sql_result = mysqli_fetch_assoc($check_sql)){}
                                            else{
                                                $sql = "insert into raw_attendance(emp_id,attendance_date,status,created_at)
                                                    values('" . $id . "','" . $datetime . "',1,'" . $created_at . "')";
                                                    mysqli_query($db,$sql);
                                            }
                                        }
                                    }
                                
                                
                                foreach($in_ar as $key => $val){
                                    $pair_val_ar = explode('=',$val);
                                    $emp_id = $pair_val_ar[0];
                                    $in_date = $pair_val_ar[1];
                                    
                                    $in_datetime = datetimeval($emp_id,$in_date);
                                    $in =$in_datetime[0];
                                    $out = $in_datetime[1];
                                    
                                    $sql = "insert into new_attendance(emp_id,attendance_date_in,attendance_date_out,status,created_at) values('".$emp_id."','".$in."','".$out."',1,'".$created_at."')";
                                    mysqli_query($db,$sql);
                                    
                                }
                                }
                                
                                ?>
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
									<!--<table id="bulk_upload_attendance" class="table table-bordered table-striped">-->
								 <!--   <table id="bulk_upload_attendance1" class="table table-bordered table-striped">-->
									<!--	<thead>-->
									<!--		<tr>-->
									<!--			<th>DATE</th>-->
									<!--			<th>EMP CODE</th>-->
									<!--			<th>NAME</th>-->
									<!--			<th>PUNCH-IN</th>-->
									<!--			<th>PUNCH-OUT</th>-->
									<!--			<th>WORK HOURS</th>-->
									<!--		</tr>-->
									<!--	</thead>-->
									<!--</table>-->
									
									<table id="example" class="display" style="width:100%">
									    <thead>
                                        <tr>
                                            <td>Action</td>
                                            <td>Emp ID</td>
                                            <td>Date</td>
                                            <td>Punch In</td>
                                            <td>Punch Out</td>
                                            <td>Name</td>
                                            <td>Work Hours</td>
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
	
	<script src="<?php echo BASE_URL; ?>cdn/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_URL; ?>cdn/datatable/dataTables.buttons.min.js"></script>
<script src="<?php echo BASE_URL; ?>cdn/datatable/jszip.min.js"></script>
<script src="<?php echo BASE_URL; ?>cdn/datatable/buttons.html5.min.js"></script>
<script src="<?php echo BASE_URL; ?>cdn/datatable/buttons.print.min.js"></script>


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