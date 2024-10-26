<? include(dirname(dirname(__FILE__)) . '/config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// var_dump($_REQUEST);



function get_weekoff($empid,$date){
    global $db;
// echo "select * from weekoff_master where status=1 and created_at <= '".$date."' order by id desc" ; 
    $sql = mysqli_query($db,"select * from weekoff_master where empid='".$empid."' and status=1 and created_at <= '".$date."' order by id desc");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return $sql_result['weekoffday'];    
    }else{
        return 'Monday';
    }
    
}

function get_workingtime($empid,$date,$format){
    global $db;
    
    $sql = mysqli_query($db,"select a.emp_id,DATE_FORMAT(a.attendance_date_in,'%H:%i:%s') as attendance_date_in,
    DATE_FORMAT(a.attendance_date_out,'%H:%i:%s') as attendance_date_out, TIMEDIFF(a.attendance_date_out,a.attendance_date_in) as work_hours from new_attendance a 
    where a.emp_id ='".$empid."' and cast(a.attendance_date_in as date) ='".$date."' and a.attendance_date_out<>'0000-00-00 00:00:00' order by id desc");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    $work_hours = $sql_result['work_hours'];
    $work_hours_ar = explode(':',$work_hours);
    
    if($format=='hour'){
        return $work_hours ; 
    }else if($format=='minute'){
        $hour = $work_hours_ar[0];
        $hour2min = (float)$hour * 60 ; 
        $minute = $work_hours_ar[1];
        $total_minute = $hour2min + $minute ;
        return $total_minute ;
    }
}

function holiday_checker($date){
    global $db;
    
    $sql = mysqli_query($db,"select holiday_date from ss_holidays where holiday_date='".$date."'");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return 1;
    }else{
        return 0;
    }
    
}


 
$period = $_REQUEST['month'];
$empid = $_REQUEST['empid'];



$working_sql = mysqli_query($db,"select perday_hours from employee where ssn='".$empid."'");
$working_sql_result = mysqli_fetch_assoc($working_sql);

$working_hours = $working_sql_result['perday_hours'];
$working_minute = $working_hours * 60 ; 


$period_ar = explode(' ',$period);
$month = $period_ar[0];
$year = $period_ar[1];

$date = date_parse($month);
$month = $date['month'];
if($month<10){
    $month = '0'.$month;
}  
  
$sal_sql = mysqli_query($db,"select * from salary where empid='".$empid."'");
$sal_sql_result = mysqli_fetch_assoc($sal_sql);

$salary = $sal_sql_result['baseyear'];


$month_days =  cal_days_in_month(CAL_GREGORIAN, $month, (int)$year);

$perday_sal = $salary / $month_days ; 
// $perday_sal = round($perday_sal,2);  // Per day means 8 hours salary

$perday_sal = round($perday_sal,1); // changed as per requirement of nipa ma'am

// $permin_sal = round($perday_sal/$working_minute,2) ; 
$permin_sal = number_format($perday_sal/$working_minute,1);  // changed as per requirement of nipa ma'am 


?>
<style>
    .card{
            position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: 0.25rem;
    }
    .card-body {
    flex: 1 1 auto;
    padding: 1rem 1rem;
}
.card-title{
    font-weight:700;
}
.card-body hr{
    border-top: 1px solid #eee;
}
.bg-success {
    background-color: #198754!important;
}
.text-white {
    color: #fff!important;
}
.bg-secondary {
    background-color: #6c757d!important;
}
.bg-info {
    background-color: #17a2b8!important;
}
</style>
<div class="row">
    <div class="col-sm-4">
        <div class="card text-white bg-primary">
          <div class="card-body">
            <h4 class="card-title">Salary</h4>
            <hr>
            <p class="card-text">&#x20b9; <? echo number_format((float)$salary, 2, '.', ''); ?></p>
            
          </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card text-white bg-secondary">
          <div class="card-body">
            <h4 class="card-title">Per Day Salary</h4>
            <hr>
            <p class="card-text">&#x20b9; <? echo $perday_sal; ?></p>
            
          </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card text-white bg-success">
          <div class="card-body">
            <h4 class="card-title">Per Min Salary</h4>
            <hr>
            <p class="card-text"> &#x20b9; <? echo $permin_sal; ?></p>
            
          </div>
        </div>
    </div>
    
</div>
<br>
<hr>

<?

$first_day = $year.'-'.$month.'-'.'01';
$last_day = $year.'-'.$month.'-'.$month_days;

// End Calculations and setting ups the variables
// starting the queries
$y_m = $year.'-'.$month; // set year and month.




$list = array();
$d = date('d', strtotime('last day of this month', strtotime($y_m))); // get max date of current month: 28, 29, 30 or 31.

for ($i = 1; $i <= $d; $i++) {
    $list[] = $y_m . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
}

$week = array();
$monday_skip_count=0;
$working = 0 ; 
$not_working = 0 ; 
$leave_count = 0; 
$total_working_min = 0;
$official_weekoff = 0 ;
$count = 0;


echo '<div class="row seven-cols">';

foreach($list as $listk=>$listv){
    
    $weekoffday = get_weekoff($empid,$listv);
    

    $sql = mysqli_query($db,"select * from new_attendance where emp_id='".$empid."' and cast(attendance_date_in as date) ='".$listv."' order by id desc");
    if($sql_result = mysqli_fetch_assoc($sql)){
        echo '<div class="col-sm-1 day_wise">';
        
        $attendance_date_in = $sql_result['attendance_date_in'];
        $attendance_date_out = $sql_result['attendance_date_out'];
        $dayname = date('l', strtotime($attendance_date_in));
        $working_min = get_workingtime($empid,$listv,'minute');
        $status = $sql_result['status'];
        
        echo '<h4>'.$dayname.'
        <span style="font-size:13px; color:gray;">  ( '.$listv.' )  </span>
        </h4>';
        
        if($weekoffday==$dayname){
            echo 'Official weekoff';
            if($status = 1){
                $count++;
            }
        }
        
        $punch_in = substr($attendance_date_in, -8);
        $punch_out = substr($attendance_date_out, -8);
         
            echo '<h6>Punch In : '; if($punch_in!='00:00:00'){ echo $punch_in; }else{ echo 'No Puch In'; } echo '</h6>';
            echo '<h6>Punch Out : '; if($punch_out!='00:00:00'){ echo $punch_out; }else{ echo 'No Puch Out'; } echo '</h6>';
            echo '<hr>';
            // echo '<h6>Punch Out : '. $punch_out .'</h5>';
            
        echo '<label style="color:green;">Working Hours='.get_workingtime($empid,$listv,'hour').'<br> In Minute = '.$working_min.'</label>';
        $working++;
        echo '</div>';
        
        // $is_leave = holiday_checker($listv);
        // // echo $is_leave;
        // if($is_leave==1){
        //     $leave = 'Official Leave';
        //     $leave_count++;
        // }else{
        //     $leave = '';
        // }
        
        $total_working_min = $total_working_min + $working_min ; 
    }else{
        // check for official leave
        $dayname = date('l', strtotime($listv));
        
        echo '<div class="col-sm-1 day_wise">';
        
        $is_leave = holiday_checker($listv);
        if($is_leave==1){
            $leave = 'Official Leave';
            $leave_count++;
        }else{
            $leave = '';
        }
        // End
        
        echo '<h4>'.$dayname.'</h4>';
        

        echo '<br>';
        if($weekoffday==$dayname){
            $official_weekoff++;
            
            if($is_leave==1){
                $leave_count--;
            }
            
        }
        
        echo '<label style="color:red;">'. $listv . ' = holiday   '.$leave . '</label>';
        
        if($dayname=='Sunday'){
            echo 'loop start';
            $tuesday_check = date('Y-m-d', strtotime($listv. ' + 2 days'));
        }
        
        
        
        // echo 'holiday_checker = ' . holiday_checker($tuesday_check) ; 

        if($listv==$tuesday_check){
            // echo '$tuesday_check ' . $tuesday_check ; 
            $monday_skip_count++;
            // echo 'IN skip';
        }
            $not_working++;
            echo '</div>';
    }
}
echo '</div>';



$skip_min = $monday_skip_count * $working_hours * 60 ; 
$paid_leave_mins = $working_hours * $official_weekoff * 60 ;
$official_leave = $leave_count * $working_hours * 60 ;


/* when employee worked on monday start */
if($count){
    $additional_min = $count * $working_min;
    $total_working_min = $total_working_min + $additional_min;
}
/* when employee worked on monday end */

echo '$total_working_min = ' . $total_working_min ; 
$total_working_min =  ($total_working_min + $paid_leave_mins + $official_leave) - $skip_min;

$paid_salary = $total_working_min * $permin_sal ; 



$total_working_hours = $total_working_min / 60 ;

 $total_working_hours = (int)$total_working_hours;

$total_working_min = $total_working_min%60 ; 


$hours = $total_working_hours .' Hours and '. $total_working_min . ' Minutes';


?>

<div class="row">
    <div class="col-sm-6"><div class="box" style="border-top: none;box-shadow: none;"><div class="box-body cnt" style="padding: 20px;border: 1px solid gray;"><b>Total Working Days:</b> <u><? echo $working+$count; ?></u></div></div></div>
    <div class="col-sm-6"><div class="box" style="border-top: none;box-shadow: none;"><div class="box-body cnt" style="padding: 20px; border: 1px solid gray;"><b>Total Leaves:</b> <u><? echo $not_working-$count; ?></u></div></div></div>
</div>
<br>
<hr>
<br>

<div class="row">
    <div class="col-sm-4">
        <div class="card text-white bg-primary">
          <div class="card-body">
            <h4 class="card-title">Salary</h4>
            <hr>
            <p class="card-text">&#x20b9; <? echo number_format((float)$salary, 2, '.', ''); ?></p>
            
          </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card text-white bg-secondary">
          <div class="card-body">
            <h4 class="card-title">Total Work Hours</h4>
            <hr>
            <p class="card-text"> <? echo $hours; ?></p>
            <? // echo $paid_leave_mins; ?>
          </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="card text-white bg-success">
          <div class="card-body">
            <h4 class="card-title">Per Min Salary</h4>
            <hr>
            <p class="card-text">&#x20b9; <? echo $permin_sal; ?></p>
            
          </div>
        </div>
    </div>
    
    <div class="col-sm-12">
        <br>
        <div class="card text-white bg-info">
          <div class="card-body">
            <h4 class="card-title">Calculated Salary</h4>
            <hr>
            <p class="card-text"> &#x20b9; <? echo $paid_salary; ?></p>
            
          </div>
        </div>
    </div>
</div>



<div style="display:none;">
<?
echo '$official_weekoff : ' . $official_weekoff ; 
echo '<br>';
echo '$monday_skip_count = ' .$monday_skip_count ; 

echo '<br>';
echo '$working_hours = ' . $working_hours ;
echo '<br>';

echo '<br>';

echo '$leave_count = ' . $leave_count ;

echo '<br>';
echo '$paid_leave_mins = ' . $paid_leave_mins ; 
echo '<br>';
echo ' $total_working_min = ' . $total_working_min ; 
echo '<br>';


echo '<br>';


echo $hours ; 



echo '<h1>Total Salary : '. $paid_salary . '</h1>' ; 

?>
    
</div>

<style>
hr {
    border-top: 1px solid #623030;
    margin: 5px auto;
}
.day_wise{
    border: 1px solid gray;
    padding: 15px;
    box-shadow: 0px 0px 10px 2px rgb(0 0 0 / 40%);
    height: 200px;
    margin: auto;
}
.seven-cols{
    padding:30px;
}
.cnt{
    padding: 20px;
    border: 1px solid gray;
}
    
    
@media (min-width: 768px){
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1  {
    width: 100%;
    *width: 100%;
  }
}
@media (min-width: 992px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
  }
}


@media (min-width: 1200px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
  }
}
</style>

