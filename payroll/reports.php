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
					Salary Tracker
				</h1>
				<ol class="breadcrumb">
					<li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Reports</li>
				</ol>
			</section>
			

			<section class="content">
				<div class="row">
        			<div class="col-xs-12">
        			    
            		<div class="box">
        		        <div class="box-body">
        		            <form action="<? $_SERVER['PHP_SELF'];?>" method="POST">
        		                <div class="row">
        		                    <div class="col-sm-6">
        		                        <label>Month</label>
        		                        <select class="form-control" name="month" required>
        		                            <option value="">Select</option>
        		                            <? for ($m=1; $m<=12; $m++) { if($m<10){ $m = '0'.$m; } $month = date('F', mktime(0,0,0,$m, 1, date('Y'))); ?> 
                                                <option value="<? echo $m; ?>" <? if($m==$_REQUEST['month']){ echo 'selected'; }?>><? echo $month; ?></option>       
                                            <? } ?>
        		                        </select>
        		                    </div>
        		                    <div class="col-sm-6">
        		                        <label>Year</label>
        		                        <select class="form-control" name="year" required>
        		                            <option value="">Select</option>
        		                            <? $y = date('Y'); $min_year = $y - 9 ; 
        		                            for($i=$y;$i>$min_year;$i--){ ?>
        		                                <option value="<? echo $i; ?>" <? if($i==$_REQUEST['year']){ echo 'selected'; }?>><? echo $i; ?></option>
        		                            <? } ?>
        		                        </select>
        		                    </div>
        		                    <div class="col-sm-12">
        		                        <br>
        		                        <input type="submit" name="submit" class="btn btn-success">
        		                    </div>
        		                    
        		                </div>
        		            </form>        
        		        </div>
            		</div>
        		
        		
<? if(isset($_REQUEST['submit'])){ ?> 
    <style>
        .sal_result{
            display:block;
        }
    </style>
<? }else{ ?> 
    <style>
        .sal_result{
            display:none;
        }
    </style>
<? }?>
        		
        		
        			<div class="box sal_result">
        		        <div class="box-body">
        		            <? 
        		            
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

        		            $month = $_REQUEST['month'];
        		            $year = $_REQUEST['year'];
        		            $monthname = date("F", mktime(0, 0, 0, $month, 10));
        		            ?>
        		            <h1> Salary Info for : <b><u><? echo    $monthname. ' ' .$year ; ?></u></b> </h1>
        		            <hr>
        		            <?
        		            
        		            function holiday_checker($date){
    global $db;
    
    $sql = mysqli_query($db,"select holiday_date from ss_holidays where holiday_date='".$date."'");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return 1;
    }else{
        return 0;
    }
    
}


    function check_skip($empid,$year,$month){
    
    global $db; 
    $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    
             $sql = mysqli_query($db,"select cast(attendance_date_in as date) as attendance_date_in from new_attendance where YEAR(attendance_date_in)='".$year."' and MONTH(attendance_date_in)='".$month."' and emp_id='".$empid."' and status=1");
             if(mysqli_num_rows($sql) > 0){
                while($sql_result = mysqli_fetch_assoc($sql)){
                    $present_day[] = $sql_result['attendance_date_in']; 
                }                 
             } else{
                  $present_day[] = '';
             }
             

            
            $weekoff_day =  get_weekoff($empid,$holiday_date);   
            $holiday_checker=0;
            $skip=0;
            $month_days =  cal_days_in_month(CAL_GREGORIAN, $month, (int)$year); 

    for($i=1;$i<=$month_days;$i++){
        if($i<10){
            $i='0'.$i;
        }
        $today = $year.'-'.$month.'-'.$i ;
        $dayname = date('l', strtotime($today));
        
        
        
        if(in_array($today,$present_day)){}
        else{
        $holiday_checker = holiday_checker($today);
            if($holiday_checker==0){
                if($dayname == $weekoff_day){    
                    $b = date('Y-m-d', strtotime($today. ' - 1 days'));
                    $a = date('Y-m-d', strtotime($today. ' + 1 days'));
                    $s = "select count(distinct(cast(attendance_date_in as date))) as attendance_date_in from new_attendance where emp_id='".$empid."' and (cast(attendance_date_in as date)='".$b."' or cast(attendance_date_in as date)='".$a."')";

                    $check_sql = mysqli_query($db,$s);
                    $check_sql_result = mysqli_fetch_assoc($check_sql);
                    
                    $attendance_date_in_cout  = $check_sql_result['attendance_date_in'];
                    
                    if($attendance_date_in_cout > 0){  }
                    else{
                        $skip++;
                    }
                }
            }
        }
    }
    
    return $skip ; 
}                            
	            
        		           function week_off_min($month,$year,$empid){
        		               global $db; 
        		               $month_days =  cal_days_in_month(CAL_GREGORIAN, $month, (int)$year);
        		               $sql = mysqli_query($db,"select * from employee where ssn='".$empid."'");
        		               $sql_result = mysqli_fetch_assoc($sql);
        		               $perday_hours = $sql_result['perday_hours'];
        		               $count = 0 ; 
        		               for($i=1;$i<=$month_days;$i++){
        		                   $date = $year.'-'.$month.'-'.$i;
        		                    $weekoff = get_weekoff($empid,$date) ;
        		                    $dayname = date('l', strtotime($date));
        		                   if($weekoff==$dayname){
        		                       $count++;
        		                   }
        		               }
        		                $total_working_hours = $perday_hours * $count ;  
        		               return $total_working_hours * 60 ;
                            }
        		            
        		            
        		            function get_workingtime($empid,$date,$format){
                                global $db;
                                
                                $sql = mysqli_query($db,"select a.emp_id,DATE_FORMAT(a.attendance_date_in,'%H:%i:%s') as attendance_date_in,
                                DATE_FORMAT(a.attendance_date_out,'%H:%i:%s') as attendance_date_out, TIMEDIFF(a.attendance_date_out,a.attendance_date_in) as work_hours from new_attendance a 
                                where a.emp_id ='".$empid."' and cast(a.attendance_date_in as date) ='".$date."' and a.attendance_date_out<>'0000-00-00 00:00:00'");
                                $sql_result = mysqli_fetch_assoc($sql);
                                
                                $work_hours = $sql_result['work_hours'];
                                $work_hours_ar = explode(':',$work_hours);
                                
                                if($format=='hour'){
                                    return $work_hours ; 
                                }else if($format=='minute'){
                                    $hour = $work_hours_ar[0];
                                    $hour2min = $hour * 60 ; 
                                    $minute = $work_hours_ar[1];
                                    $total_minute = $hour2min + $minute ;
                                    return $total_minute ;
                                }
                            }
                            
                            function get_weekoff($empid,$date){
                                global $db;
                                $sql = mysqli_query($db,"select * from weekoff_master where empid='".$empid."' and status=1 and created_at <= '".$date."' order by id desc");
                                if($sql_result = mysqli_fetch_assoc($sql)){
                                    return $sql_result['weekoffday'];    
                                }else{
                                    return 'Monday';
                                }   
                            }
                            




        		            $salary = 0 ;
        		            $emp_sql = mysqli_query($db,"SELECT DISTINCT(a.empid) as empid, a.baseyear,concat(b.salutation, ' ', b.firstname, ' ', b.lastname) as name,b.perday_hours FROM salary a 
            			            INNER JOIN employee b ON a.empid=b.ssn order by firstname");
            			     
            			     echo '<form action="../get_sal_excel.php" method="POST">'; 
            			     echo '<table class="table table-striped">
            			            <thead>
            			                <tr>
            			                    <th> Sr No </th>
            			                    <th> Name </th>
            			                    <th> Employee ID </th>
            			                    <th> Total Working Minutes </th>
            			                    <th> Salary </th>
            			                </tr>
            			            </thead>
            			            <tbody>';
            			     
            			            $rec_count = 1 ;
            			                $holiday_count=0;
            			                
            			                $holiday_count_sql = mysqli_query($db,"select * from ss_holidays where month(holiday_date)='".$month."'");
            			                while($holiday_count_sql_result = mysqli_fetch_assoc($holiday_count_sql)){
            			                    $holiday_date = $holiday_count_sql_result['holiday_date'];
                			                $dayname = date('l', strtotime($holiday_date));
                			                $weekoff_day =  get_weekoff($empid,$holiday_date);
                			                if($weekoff_day!=$dayname){
                    			                $holiday_count++;        
                			                }
            			                }
            			                
            			                
            			            while($emp_sql_result = mysqli_fetch_assoc($emp_sql)){
            			                $empid= $emp_sql_result['empid'];
            			                $total_minute = 0 ; 
            			                $salary = $emp_sql_result['baseyear'];
            			                $name = $emp_sql_result['name'];
            			                
            			                
            			                $skip_count = check_skip($empid,$year,$month) ; 
            			                
            			                $month_days =  cal_days_in_month(CAL_GREGORIAN, $month, (int)$year);
                                        $perday_sal = $salary / $month_days ; 
                                        $perday_sal = round($perday_sal,2);  // Per day means 8 hours salary
                                        
                                        $working_hours = $emp_sql_result['perday_hours'];
                                        $working_minute = $working_hours * 60 ;
                                        $permin_sal = round($perday_sal/$working_minute,2) ;
            			                
            			             //   echo "SELECT DISTINCT(attendance_date_in) as attendance_date_in ,attendance_date_out,emp_id,TIMEDIFF(attendance_date_out,attendance_date_in) as work_hours,cast(attendance_date_in as date) as pdate FROM `new_attendance` 
            			             //   where MONTH(attendance_date_in) ='".$month."' and Year(attendance_date_in) = '".$year."' and emp_id='".$empid."' and attendance_date_out<>'0000-00-00 00:00:00'" ;
            			                
            			                $sql = mysqli_query($db,"SELECT DISTINCT(attendance_date_in) as attendance_date_in ,attendance_date_out,emp_id,TIMEDIFF(attendance_date_out,attendance_date_in) as work_hours,cast(attendance_date_in as date) as pdate FROM `new_attendance` 
            			                where MONTH(attendance_date_in) ='".$month."' and Year(attendance_date_in) = '".$year."' and emp_id='".$empid."' and attendance_date_out<>'0000-00-00 00:00:00'");
            			                $count = '1' ; 
            			                $paid_leave = 0 ;
                                        $week_off_min =  week_off_min($month,$year,$empid) ;
                                        while($sql_result = mysqli_fetch_assoc($sql)){
                                            $pdate = $sql_result['pdate'];
                                            $minute = get_workingtime($empid,$pdate,'minute') ; 
                                            $weekoff = get_weekoff($empid,$pdate);
                                            $total_minute = $total_minute + $minute ;
            			                }
            			                
            			             //   echo ' $holiday_count = ' . $holiday_count ; 
            			                $holiday_min = $holiday_count * $working_minute ;
            			                
            			             //   SKIP 
            			             $skip_count_min = $skip_count * $working_hours * 60 ; 
            			                
            			                $grand_total_minute = ($total_minute + $week_off_min + $holiday_min) - $skip_count_min; 
            			                
            			                if($grand_total_minute > 0){
                			                $salary = $permin_sal * $grand_total_minute ;    
            			                }else{
            			                    $salary = '0';
            			                }
            			                 
            			                 $salary = number_format((float)$salary, 2, '.', '');
            			                
            			                echo '<tr>
                    			                <td>'.$rec_count.'</td>
                    			                <td><input type="hidden" name="emp_name[]" value="'.$name.'">'.ucwords($name).'</td>
                    			                <td><input type="hidden" name="empid[]" value="'.$empid.'">'.$empid.'</td>
                    			                <td><input type="hidden" name="grand_total_minute[]" value="'.$grand_total_minute.'">'.$grand_total_minute.'</td>
                    			                <td>&#x20b9; <input type="hidden" name="salary[]" value="'.$salary.'"> '.$salary.'</td>
                			                </tr>';
            			                $rec_count++;
            			            }
            			            
            			            echo '</tbody>
            			            </table>
            			            <hr>
            			            <input type="hidden" name="month" value="'.$monthname.'">
            			            <input type="hidden" name="year" value="'.$year.'">
                			            <input type="submit" name="submit" value="Download Excel" class="btn btn-success">
            			            </form>
            			            ';
        		            ?>
        		            
            		            
        		            

        		        </div>
            		</div>
            		
            		
        			    <div class="box">
        			        <div class="box-body">
        			            <table class="table">
        			                <thead>
        			                    <tr>
        			                        <th>Sr No.</th>
        			                        <th>Employee Code.</th>
        			                        <th>Name</th>
        			                        <th>Salary</th>
        			                        <th>Actions</th>
        			                    </tr>
        			                    <tbody>
        			                        
            			            <?
            			            $i=1;
            			            $emp_sql = mysqli_query($db,"SELECT DISTINCT(a.empid) as empid,a.baseyear,concat(b.salutation, ' ', b.firstname, ' ', b.lastname) as name FROM salary a 
            			            INNER JOIN employee b ON a.empid=b.ssn order by firstname");
            			            while($emp_sql_result = mysqli_fetch_assoc($emp_sql)){ 
                			            $empid = $emp_sql_result['empid'];
                			            $empname = ucwords($emp_sql_result['name']);
            			            ?>
                			            <tr>
                			                <td><? echo $i; ?></td>
                			                <td><? echo $empid; ?></td>
                			                <td><? echo $empname; ?></td>
                			                <td><? echo $emp_sql_result['baseyear']; ?></td>
                			                <td><a class="btn btn-success" href="../view_emp_records.php?empid=<? echo $empid; ?>" target="_blank">View</a></td>
                			            </tr>    
            			            <? $i++; } ?>
        			            
        			                    </tbody>
        			                </thead>
        			            </table>
        			            
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