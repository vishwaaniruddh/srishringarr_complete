<?php include('config.php');
require 'vendor/autoload.php';


// error_reporting(E_ALL);
// error_reporting(-1);
// ini_set('error_reporting', E_ALL);


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


function getColumnLabel($index) {
    $base26 = '';
    
    // Calculate the first part of the label (A, B, C, ...)
    if ($index >= 26) {
        $base26 .= chr(65 + ($index / 26) - 1);
    }
    
    // Calculate the second part of the label (A, B, C, ...)
    $base26 .= chr(65 + ($index % 26));
    
    return $base26;
}




if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return $length === 0 ||
            (substr($haystack, -$length) === $needle);
    }
}
if (!function_exists('clean')) {
    function clean($string)
    {
        $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
    }
}
if (!function_exists('remove_special')) {

    function remove_special($site_remark2)
    {
        $site_remark2_arr = explode(" ", $site_remark2);

        foreach ($site_remark2_arr as $k => $v) {
            $a[] = preg_split('/\n/', $v);
        }

        $site_remark = '';
        foreach ($a as $key => $value) {
            foreach ($value as $ke => $va) {
                $site_remark .= $va . " ";
            }
        }

        return clean($site_remark);
    }
}

$sql_query = $_REQUEST['exportSql'];
$sql_app = mysqli_query($con, $sql_query);




// Set Header Styles
$headerStyle = [
     'font' => [
        'bold' => true, // Make the text bold
        'color' => ['rgb' => 'FFFFFF'], // Font color (white)
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '0070C0'], // Background color (blue)
    ],
    'borders' => [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => 'FF000000'], // Border color (black)
        ],
    ],
];





$date = date('Y-m-d');
$date1 = date_create($date);

$headers = array(
    'SR',
    'TicketId',
    'Customer',
    'Bank',
    'Atmid',
    'Atm Address',
    'City',
    'State',
    'Branch',
    'Call Type',
    'Call Receive From',
    'Component',
    'Sub Component',
    'Current Status',
    'Current Status Remarks',
    'Schedule Date',
    'Schedule Remark',
    'Material Condition',
    'Required Material Name',
    'Material Remark',
    'Courier Agency (Material Dispatch)',
    'POD (Material Dispatch)',
    'Serial Number',
    'Material dispatch date ',
    'Material Dispatch Remark',
    'DOCKET NO',
    'REQUEST FOOTAGE DATE',
    'Time From',
    'Time To',
    'Close Type',
    'Close Remark',
    'Last Action By',
    'Last Action Date',
    'Call Log Date',
    'Call Log By',
    'BM',
    'Aging',
    'Call Log Remark',
    'Engineer Name',
    'Engineer Contact Number'
);

$columnWidths = [
    'F' => 35,
    'O' => 35,
    'Q' => 35,
    'T' => 35,
    'Y' => 35,
    'AL' => 35,
];

// Apply Header Styles
foreach ($headers as $index => $header) {
    $column = getColumnLabel($index);
    $sheet->setCellValue($column . '1', $header);
    $sheet->getStyle($column . '1')->applyFromArray($headerStyle);
    //   $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
    
     if (isset($columnWidths[$column])) {
        $sheet->getColumnDimension($column)->setWidth($columnWidths[$column]);
    }
    

}



$i = 2; // Start from row 2 for data

$counter=1; 
while ($sql_result = mysqli_fetch_assoc($sql_app)) {


    $id = '';
    $createdBy = '';
    $site_eng_contact = '';
    $mis_id = '';
    $closed_date = '';
    $date2 = '';
    $atmid = '';
    $bm_name = '';
    $status = '';
    $created_by = '';
    $customer = '';
    $ticket_id = '';
    $createdBy = '';
    $mis_id = '';
    $closed_date = '';
    $date2 = '';
    $bank = '';
    $atmid = '';
    $bm_name = '';
    $status = '';
    $created_by = '';
    $site_eng_contact = '';
    $city = '';
    $call_type = '';
    $case_type = '';
    $component = '';
    $subcomponent = '';
    $footage_date = '';
    $fromtime = '';
    $totime = '';
    $created_at = '';
    $remarks = '';
    $site_engineer = '';
    $site_engineer_contact = '';
    $serial_number  = '';
    $status_remark = '';
    $schedule_date = '';
    $material_condition = '';
    $material = '';
    $material_req_remark = '';
    $courier_agency = '';

    $pod = '';
    $serial_number = '';
    $dispatch_date  = '';
    $material_dispatch_remark = '';
    $docket_no = '';
    $footage_date = '';
    $fromtime = '';
    $totime = '';
    $close_type = '';
    $close_remark = '';
    $last_action_by = '';
    $created_date = '';
    $created_at = '';
    $createdBy = '';
    $bm_name = '';
    $remarks = '';
    $site_engineer = '';
    $site_engineer_contact = '';
    $schedule_remark = '';


    $id = $sql_result['id'];
    $createdBy = $sql_result['createdBy'];
    $site_eng_contact = $sql_result['eng_name_contact'];
    if ($site_eng_contact == '') {
        $site_engineer = "";
        $site_engineer_contact = "";
    } else {
        $site_engcontact = explode("_", $site_eng_contact);
        $site_engineer = $site_engcontact[0];
        $site_engineer_contact = $site_engcontact[1];
    }

    $mis_id = $sql_result['mis_id'];

    $historydate = mysqli_query($con, "select created_at from mis_history where mis_id='" . $id . "' order by id desc limit 1");
    $created_date_result = mysqli_fetch_row($historydate);
    $created_date = $created_date_result[0];

    $closed_date = $sql_result['close_date'];

    if ($closed_date != '0000-00-00') {
        $date1 = date_create($closed_date);
    }

    $date2 = $sql_result['created_at'];
    $cust_date2 = date('Y-m-d', strtotime($date2));

    $cust_date2 = date_create($cust_date2);
    $diff = date_diff($date1, $cust_date2);
    $atmid = $sql_result['atmid'];

    $bm_name = $sql_result['bm'];

    $status = $sql_result['status'];
    $created_by = $sql_result['created_by'];
    $aging_day = $diff->format("%a");

    $mis_his_key = 0;

    $lastactionsql = mysqli_query($con, "select type,created_by,remark,schedule_date,material,material_condition,courier_agency,pod,serial_number,dispatch_date,(SELECT name FROM mis_loginusers WHERE id=mis_history.created_by) AS last_action_by from mis_history where mis_id='" . $id . "' order by id desc");
    if ($lastactionsql_result = mysqli_fetch_assoc($lastactionsql)) {

        $his_type = $lastactionsql_result['type'];


        $lastactionuserid = $lastactionsql_result['created_by'];
        $status_remark = $lastactionsql_result['remark'];

        if ($mis_his_key == 0) {
            $last_action_by = $lastactionsql_result['last_action_by'];
        }
        $mis_his_key = $mis_his_key + 1;
        $schedule_date = "";
        if ($his_type == 'schedule') {
            $schedule_date = $lastactionsql_result['schedule_date'];
            $schedule_remark = $lastactionsql_result['remark'];
        }


        $material = "";
        $material_req_remark = "";
        if ($his_type == 'material_requirement') {
            $material = $lastactionsql_result['material'];
            $material_req_remark = $lastactionsql_result['remark'];
            $material_condition = $lastactionsql_result['material_condition'];
        }
        $courier_agency = "";
        $pod = "";
        $serial_number = "";
        $dispatch_date = "";
        $material_dispatch_remark = "";
        // if($his_type=='material_dispatch'){
        $courier_agency = $lastactionsql_result['courier_agency'];
        $pod = $lastactionsql_result['pod'];
        $serial_number = $lastactionsql_result['serial_number'];
        $dispatch_date = $lastactionsql_result['dispatch_date'];
        $material_dispatch_remark = $lastactionsql_result['remark'];
        // }
        $close_type = "";
        $close_remark = "";
        $close_created_at = "";
        $attachment = "";
        if ($his_type == 'close') {
            $close_type = $lastactionsql_result['close_type'];
            $close_remark = $lastactionsql_result['remark'];
            $close_created_at = $lastactionsql_result['created_at'];
            $attachment = $lastactionsql_result['attachment'];
        }
    }


    $customer = $sql_result['customer'];
    $ticket_id = $sql_result['ticket_id'];
    $createdBy = $sql_result['createdBy'];
    $mis_id = $sql_result['mis_id'];
    $closed_date = $sql_result['close_date'];
    $date2 = $sql_result['created_at'];
    $bank = $sql_result['bank'];
    $atmid = $sql_result['atmid'];
    $bm_name = $sql_result['bm'];
    $status = $sql_result['status'];
    $created_by = $sql_result['created_by'];
    $site_eng_contact = $sql_result['eng_name_contact'];
    $city = $sql_result['city'];
    $state = $sql_result['state'];
    $branch = $sql_result['branch'];
    $call_type = $sql_result['call_type'];
    $case_type = $sql_result['case_type'];
    $component = $sql_result['component'];
    $subcomponent = $sql_result['subcomponent'];

    $footage_date = $sql_result['footage_date'];
    $fromtime = $sql_result['fromtime'];
    $totime = $sql_result['totime'];
    $close_type = "";

    $created_at = $sql_result['created_at'];
    $remarks = $sql_result['remarks'];
    $site_engineer = $sql_result['eng_name'];
    $site_engineer_contact = $sql_result['eng_contact'];
    $serial_number = $sql_result['serial_number'];



    $sheet->getStyle('A' . $i . ':AN' . $i)->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'], // Border color (black)
            ],
        ],
    ]);





    $sheet->setCellValue('A' . $i, $counter);
    $sheet->setCellValue('B' . $i, ($ticket_id ? $ticket_id : '-'));
    $sheet->setCellValue('C' . $i, ($customer ? $customer : '-'));
    $sheet->setCellValue('D' . $i, ($bank ? $bank : '-'));
    $sheet->setCellValue('E' . $i, ($atmid ? $atmid : '-'));
    $sheet->setCellValue('F' . $i, ($sql_result['location'] ? $sql_result['location'] : '-'));
    $sheet->setCellValue('G' . $i, ($city ? $city : '-'));
    $sheet->setCellValue('H' . $i, ($state ? $state : '-'));
    $sheet->setCellValue('I' . $i, ($branch ? $branch : '-'));
    $sheet->setCellValue('J' . $i, ($call_type ? $call_type : '-'));
    $sheet->setCellValue('K' . $i, ($case_type ? $case_type : '-'));
    $sheet->setCellValue('L' . $i, ($component ? $component : '-'));
    $sheet->setCellValue('M' . $i, ($subcomponent ? $subcomponent : '-'));
    $sheet->setCellValue('N' . $i, ($status ? $status : '-'));
    $sheet->setCellValue('O' . $i, ($status_remark ? $status_remark : '-'));
    $sheet->setCellValue('P' . $i, ($schedule_date ? $schedule_date : '-'));
    $sheet->setCellValue('Q' . $i, ($schedule_remark ? $schedule_remark : '-'));
    $sheet->setCellValue('R' . $i, ($material_condition ? $material_condition : '-'));
    $sheet->setCellValue('S' . $i, ($material ? $material : '-'));
    $sheet->setCellValue('T' . $i, ($material_req_remark ? $material_req_remark : '-'));
    $sheet->setCellValue('U' . $i, (trim($courier_agency) ? trim($courier_agency) : '-'));
    $sheet->setCellValue('V' . $i, ($pod ? $pod : '-'));
    $sheet->setCellValue('W' . $i, ($serial_number ? $serial_number : '-'));
    $sheet->setCellValue('X' . $i, ($dispatch_date ? $dispatch_date : '-'));
    $sheet->setCellValue('Y' . $i, ($material_dispatch_remark ? $material_dispatch_remark : '-'));
    $sheet->setCellValue('Z' . $i, ($docket_no ? $docket_no : '-'));
    $sheet->setCellValue('AA' . $i, ($footage_date ? $footage_date : '-'));
    $sheet->setCellValue('AB' . $i, ($fromtime ? $fromtime : '-'));
    $sheet->setCellValue('AC' . $i, ($totime ? $totime : '-'));
    $sheet->setCellValue('AD' . $i, ($close_type ? $close_type : '-'));
    $sheet->setCellValue('AE' . $i, ($close_remark ? $close_remark : '-'));
    $sheet->setCellValue('AF' . $i, ($last_action_by ? $last_action_by : '-'));
    $sheet->setCellValue('AG' . $i, ($created_date ? $created_date : '-'));
    $sheet->setCellValue('AH' . $i, ($created_at ? $created_at : '-'));
    $sheet->setCellValue('AI' . $i, ($createdBy ? $createdBy : '-'));
    $sheet->setCellValue('AJ' . $i, ($bm_name ? $bm_name : '-'));
    $sheet->setCellValue('AK' . $i, ($diff->format("%a days") ? $diff->format("%a days") : '-'));
    $sheet->setCellValue('AL' . $i, ($remarks ? $remarks : '-'));
    $sheet->setCellValue('AM' . $i, ($site_engineer ? $site_engineer : '-'));
    $sheet->setCellValue('AN' . $i, ($site_engineer_contact ? $site_engineer_contact : '-'));


    $sheet->getStyle('A' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('B' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('C' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('D' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('E' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('F' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('G' . $i)->getAlignment()->setWrapText(true); 
    
    $sheet->getStyle('H' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('I' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('J' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('K' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('L' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('M' . $i)->getAlignment()->setWrapText(true);
    $sheet->getStyle('N' . $i)->getAlignment()->setWrapText(true);
    $sheet->getStyle('O' . $i)->getAlignment()->setWrapText(true);
    $sheet->getStyle('P' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('Q' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('R' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('S' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('T' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('U' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('V' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('W' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('X' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('Y' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('Z' . $i)->getAlignment()->setWrapText(true);
    
    $sheet->getStyle('AA' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AB' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AC' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AD' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AE' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AF' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AG' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AH' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AI' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AJ' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AK' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AL' . $i)->getAlignment()->setWrapText(true); 
    $sheet->getStyle('AM' . $i)->getAlignment()->setWrapText(true);
    $sheet->getStyle('AN' . $i)->getAlignment()->setWrapText(true);
    
    
    $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('A' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('B' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('B' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('C' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('C' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('D' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('D' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('E' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('E' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('F' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('F' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('G' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('G' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('H' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('H' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('I' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('I' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('J' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('J' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('K' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('K' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('L' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('L' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('M' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('M' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('N' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('N' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('O' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('O' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('P' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('P' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('Q' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('Q' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('R' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('R' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('S' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('S' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('T' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('T' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('U' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('U' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically

    
    $sheet->getStyle('V' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('V' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('W' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('W' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('X' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('X' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('Y' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('Y' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('Z' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('Z' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AA' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AA' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AB' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AB' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AC' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AC' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AD' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AD' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AE' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AE' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AF' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AF' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AG' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AG' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AH' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AH' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AI' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AI' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AJ' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AJ' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AK' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AK' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AL' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AL' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AM' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AM' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically
    $sheet->getStyle('AN' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // Left-align text
    $sheet->getStyle('AN' . $i)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // Center vertically


    $i++;
$counter++ ; 
}

// return ; 
// Create a writer to save the Excel file
$writer = new Xlsx($spreadsheet);

// Save the Excel file to a temporary location
$tempFile = tempnam(sys_get_temp_dir(), 'Inventory');
$writer->save($tempFile);

// Provide the file as a download to the user
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Exported MIS.xlsx"');
header('Cache-Control: max-age=0');
readfile($tempFile);

// Close the database connection
mysqli_close($con);

// Clean up and delete the temporary file
unlink($tempFile);
