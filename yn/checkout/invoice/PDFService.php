<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);


class PDFService {

    function generatePDF($result, $oid) {
        require_once __DIR__ . '/../library/tcpdf/tcpdf.php';
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetHeaderData('', PDF_HEADER_LOGO_WIDTH, '', '', array(
            0,
            0,
            0
        ), array(
            255,
            255,
            255
        ));
        $pdf->SetTitle('Invoice - ' . $oid);
         $pdf->SetMargins(3, 2, 3, true);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once (dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();

        require_once __DIR__ . '/../Invoice.php';
        $html = getHTMLPurchaseDataToPDF($result, $oid);
        $filename = "Invoice-" . $oid;
        $pdf->writeHTML($html, true, false, true, false, '');
        // ob_end_clean();
        if (ob_get_contents()) ob_end_clean();
        // $pdf->Output($filename . '.pdf', 'F');
        $pdf->Output(__DIR__ . '/bills/'.$filename . '.pdf', 'F');
        // $pdf->Output(__DIR__ . '/bills/'.$filename . '.pdf', 'I');
        
    }
}

?>