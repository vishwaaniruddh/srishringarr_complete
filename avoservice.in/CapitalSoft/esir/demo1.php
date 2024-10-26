<?php include('config.php');
require 'vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

var_dump($sheet);

$headerStyles = [
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


// Define column headers
$headers = array(
    'SR NO',
    'ATMID',
    'SERIAL NUMBER',
    'NETWORK IP',
    'ROUTER IP',
    'ATM IP',
    'CREATED AT',
    'CREATED BY',
);


// Set headers in the Excel sheet with styles
foreach ($headers as $index => $header) {
    $column = chr(65 + $index); // A, B, C, ...
    $sheet->setCellValue($column . '1', $header);
    $sheet->getStyle($column . '1')->applyFromArray($headerStyles); // Apply styles to the header cell
    $sheet->getColumnDimension($column)->setAutoSize(true); // Auto-fill column width
}



    $sheet->getStyle('A' . $i . ':O' . $i)->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'], // Border color (black)
            ],
        ],
    ]);
    
    $i = 1 ; 
    
        $sheet->setCellValue('A' . $i , '$serial_number' ) ; 
        $sheet->setCellValue('B' . $i ,  'NA' ) ;  
        $sheet->setCellValue('C' . $i ,  'NA' ) ;
        $sheet->setCellValue('D' . $i ,  'NA' ) ;
        $sheet->setCellValue('E' . $i ,  'NA' ) ;
        $sheet->setCellValue('F' . $i ,  'NA' ) ;
        $sheet->setCellValue('G' . $i , 'NA' ) ;
        $sheet->setCellValue('H' . $i , 'NA' ) ;


// Create a writer to save the Excel file
$writer = new Xlsx($spreadsheet);

var_dump($writer);
return ; 

// Save the Excel file to a temporary location
$tempFile = tempnam(sys_get_temp_dir(), 'esir');
$writer->save($tempFile);

// Provide the file as a download to the user
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Router Configuration.xlsx"');
header('Cache-Control: max-age=0');
readfile($tempFile);

// Close the database connection
mysqli_close($con);

// Clean up and delete the temporary file
unlink($tempFile);
?>
