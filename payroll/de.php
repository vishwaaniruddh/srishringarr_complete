<? session_start();
include('config.php');
date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)


// echo count($days);
// echo $days[6];

// return ; 
function holiday_checker($date){
    global $db;
    
    $sql = mysqli_query($db,"select holiday_date from ss_holidays where holiday_date='".$date."'");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return 1;
    }else{
        return 0;
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

function check_skip($empid,$year,$month){
    
    global $db; 
    $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
    
    $sql = mysqli_query($db,"select cast(attendance_date_in as date) as attendance_date_in from new_attendance where YEAR(attendance_date_in)='".$year."' and MONTH(attendance_date_in)='".$month."' and emp_id='".$empid."' and status=1");
    while($sql_result = mysqli_fetch_assoc($sql)){
        $present_day[] = $sql_result['attendance_date_in']; 
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
                    echo '<br>';
                    
                }
            }
        }
    }
    
    return $skip ; 
}                            



$empid = 29 ;
$year = 2022 ; 
$month =10; 

echo check_skip($empid,$year,$month);



return ; 



$sql = mysqli_query($db,"select * from weekoff_master where status=1 and created_at < '".$date."' order by id desc");
$sql_result = mysqli_fetch_assoc($sql);

echo $sql_result['weekoffday'];

return ; 

// define week off day for emps

echo $datetime = date('Y-m-d H:i:s');
$userid = $_SESSION['Admin_ID'];

$s = mysqli_query($db,"select * from employee where active='y' and ssn<>10");
while($s_result = mysqli_fetch_assoc($s)){
    $empid = $s_result['ssn'];
    
    $sql = mysqli_query($db,"insert into weekoff_master(emdid,weekoffday,status,created_at,created_by) 
            values('".$empid."','Monday',1,'".$datetime."','".$userid."')");    
}


        



return ; 
// $statement = "insert into ss_holidays()"
$sql = mysqli_query($db,"select * from Sheet1");
while($sql_result = mysqli_fetch_assoc($sql)){
    $date =  $sql_result['A'] .' 2022';
    $cdate = date('Y-m-d',strtotime($date));
    $holiday_name =  $sql_result['C'] ;
    
    if($cdate!='1970-01-01'){
    mysqli_query($db,"insert into ss_holidays(holiday_title,holiday_desc,holiday_date,holiday_type) 
    values('".$holiday_name."','".$holiday_name."','".$cdate."','compulsory')");        
    }

    echo '<br>';
    
    
}
?>