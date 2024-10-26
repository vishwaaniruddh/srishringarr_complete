<? 
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];

$contents='';
$contents.=" \t Month \t $month \t $year \t \t";
$contents.="\nSr no \t Employee ID \t Name \t Total Working Minutes \t Salary \t";

$count = 0 ; 
$i=1;
$emp_name = $_REQUEST['emp_name'];
$emp_id = $_REQUEST['empid'];
$total_min = $_REQUEST['grand_total_minute'];
$salary = $_REQUEST['salary'];

foreach($emp_name as $emp_name_key => $emp_name_val){
    
    $contents.="\n".$i."\t";
    $contents.= $emp_id[$count]."\t";
    $contents.= $emp_name[$count]."\t";
    $contents.= $total_min[$count]."\t";
    $contents.= $salary[$count]."\t";
    
    $i++;
    $count++;
}

$contents = strip_tags($contents);
    header("Content-Disposition: attachment; filename=salary.xlsx");
    header("Content-Type: application/vnd.ms-excel");
    print $contents;
    



?>