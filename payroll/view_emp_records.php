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
		
		.cards{
		    padding: 10px;
            border: 1px solid gray;
            margin: 10px auto;
            cursor: pointer;
		}
		.active_box{
            background: red;
            color: white;
            box-shadow: 0px 0px 10px 2px rgb(255 4 4 / 40%);
            font-weight: 700;
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


		<?
		function getemployee($empid){
		    global $db;
		    
		    $sql = mysqli_query($db,"select * from employee where ssn='".$empid."'");
		    $sql_result = mysqli_fetch_assoc($sql);
		    
		    return ucwords($sql_result['salutation'] . ' ' .$sql_result['firstname'] . ' ' .$sql_result['lastname']);
		}
		$empid = $_REQUEST['empid'];
		$empname = getemployee($empid);
		?>
		
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Salary Tracker Info for : <b><u><? echo $empname;?></u></b>
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Reports</li>
				</ol>
			</section>

			<section class="content" style="font-size:11px !important;">
				<div class="row">
        			<div class="col-xs-12">
        			    <div class="box">
        			        <div class="box-body">
        			         <? for ($i = 1; $i <= 12; $i++) {
                                    $months[] = date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
                                } ?>
                        
                                <div class="row months_row">
                                    
                                
                                <? foreach($months as $k=>$v){ ?>
                                    <div class="col-sm-2">
                                        <div class="cards">
                                            <?  
                                            $month_r = $v.'-01'; 
                                            $m = date('F Y', strtotime($month_r) ) ; 
                                            echo $m; 
                                            ?>
                                            
                                        </div>
                                        
                                    </div>
                                <? } ?>
                                </div>
        			        </div>
        			    </div>
        			    
        			    <div class="box">
        			        <div class="box-body result">
        			            
        			        </div>
        			    </div>
        			    
					</div>
				</div>
			</section>
		</div>
		
		
		
		<script>
		$(document).ready(function(){
		   $(".months_row .col-sm-2:first-child .cards").click(); 
		});
		
		    $(document).on('click','.cards',function(){
		       
		       $(".cards").removeClass('active_box');
		       
		       $(this).toggleClass('active_box');
		       
		       empid = '<? echo $empid?>';
		       month = $(this).text();
		       month = month.trim();
               window.history.replaceState(null, null, "?empid=<? echo $empid; ?>&&month="+month);
               
               $.ajax({
                       type:"POST",
                       url:"ajax/get_attendance.php",
                       data : "month="+month+"&empid="+empid,
                       success:function(msg){

                           $(".result").html(msg);
                       }
                    });
               
               
               
		    });
		</script>

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