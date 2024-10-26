<?php require( 'ssp.class.php' );
include('config.php');

    // select cast(att.attendance_date_in as date) as pdate, emp.empid as empid,emp.firstname,emp.lastname, DATE_FORMAT(att.attendance_date_in,"%H:%i:%s") as Intime,
// 	DATE_FORMAT(att.attendance_date_out,"%H:%i:%s") as Outtime from employee as emp , new_attendance as att
$table = '(
select a.id,a.emp_id,DATE_FORMAT(a.attendance_date_in,"%H:%i:%s") as attendance_date_in,DATE_FORMAT(a.attendance_date_out,"%H:%i:%s") as attendance_date_out,
concat(b.firstname, " ", b.lastname) as username, TIMEDIFF(a.attendance_date_out,a.attendance_date_in) as work_hours,cast(a.attendance_date_in as date) as pdate
from new_attendance a
INNER JOIN employee b ON a.emp_id=b.empid
) tbl';
    

$primaryKey = 'id';

$columns = array(
array( 'db' => 'emp_id', 'dt' => 1), 
array( 'db' => 'pdate', 'dt' => 2),
array( 'db' => 'attendance_date_in', 'dt' => 3),
array( 'db' => 'attendance_date_out', 'dt' => 4 ),
array( 'db' => 'username', 'dt' => 5 ),
array( 'db' => 'work_hours', 'dt' => 6),

);

echo json_encode(SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns));
