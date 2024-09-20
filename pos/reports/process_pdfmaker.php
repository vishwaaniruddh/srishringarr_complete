<?php 

// phpinfo();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


ini_set("memory_limit", "-1");
set_time_limit(0);


include('../db_connection.php');
include_once('fpdf.php');
require('html2pdf.php');

class PDF extends FPDF
{

//variables of html parser
protected $B;
protected $I;
protected $U;
protected $HREF;
protected $fontList;
protected $issetfont;
protected $issetcolor;

function __construct($orientation='P', $unit='mm', $format='A4')
{
    //Call parent constructor
    parent::__construct($orientation,$unit,$format);

    //Initialization
    $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';

    $this->tableborder=0;
    $this->tdbegin=false;
    $this->tdwidth=0;
    $this->tdheight=0;
    $this->tdalign="L";
    $this->tdbgcolor=false;

    $this->oldx=0;
    $this->oldy=0;

    $this->fontlist=array("arial","times","courier","helvetica","symbol");
    $this->issetfont=false;
    $this->issetcolor=false;
}

//////////////////////////////////////
//html parser

function WriteHTML($html)
{
    $html=strip_tags($html,"<b><u><i><a><img><p><br><strong><em><font><tr><blockquote><hr><td><tr><table><sup>"); //remove all unsupported tags
    $html=str_replace("\n",'',$html); //replace carriage returns with spaces
    $html=str_replace("\t",'',$html); //replace carriage returns with spaces
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE); //explode the string
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            elseif($this->tdbegin) {
                if(trim($e)!='' && $e!="&nbsp;") {
                    $this->Cell($this->tdwidth,$this->tdheight,$e,$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
                }
                elseif($e=="&nbsp;") {
                    $this->Cell($this->tdwidth,$this->tdheight,'',$this->tableborder,'',$this->tdalign,$this->tdbgcolor);
                }
            }
            else
                $this->Write(5,stripslashes(txtentities($e)));
        }
        else
        {
            //Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                //Extract attributes
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $attr=array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    //Opening tag
    switch($tag){

        case 'SUP':
            if( !empty($attr['SUP']) ) {    
                //Set current font to 6pt     
                $this->SetFont('','',6);
                //Start 125cm plus width of cell to the right of left margin         
                //Superscript "1" 
                $this->Cell(2,2,$attr['SUP'],0,0,'L');
            }
            break;

        case 'TABLE': // TABLE-BEGIN
            if( !empty($attr['BORDER']) ) $this->tableborder=$attr['BORDER'];
            else $this->tableborder=0;
            break;
        case 'TR': //TR-BEGIN
            break;
        case 'TD': // TD-BEGIN
            if( !empty($attr['WIDTH']) ) $this->tdwidth=($attr['WIDTH']/4);
            else $this->tdwidth=40; // Set to your own width if you need bigger fixed cells
            if( !empty($attr['HEIGHT']) ) $this->tdheight=($attr['HEIGHT']/6);
            else $this->tdheight=6; // Set to your own height if you need bigger fixed cells
            if( !empty($attr['ALIGN']) ) {
                $align=$attr['ALIGN'];        
                if($align=='LEFT') $this->tdalign='L';
                if($align=='CENTER') $this->tdalign='C';
                if($align=='RIGHT') $this->tdalign='R';
            }
            else $this->tdalign='L'; // Set to your own
            if( !empty($attr['BGCOLOR']) ) {
                $coul=hex2dec($attr['BGCOLOR']);
                    $this->SetFillColor($coul['R'],$coul['G'],$coul['B']);
                    $this->tdbgcolor=true;
                }
            $this->tdbegin=true;
            break;

        case 'HR':
            if( !empty($attr['WIDTH']) )
                $Width = $attr['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            $x = $this->GetX();
            $y = $this->GetY();
            $this->SetLineWidth(0.2);
            $this->Line($x,$y,$x+$Width,$y);
            $this->SetLineWidth(0.2);
            $this->Ln(1);
            break;
        case 'STRONG':
            $this->SetStyle('B',true);
            break;
        case 'EM':
            $this->SetStyle('I',true);
            break;
        case 'B':
        case 'I':
        case 'U':
            $this->SetStyle($tag,true);
            break;
        case 'A':
            $this->HREF=$attr['HREF'];
            break;
        case 'IMG':
            if(isset($attr['SRC']) && (isset($attr['WIDTH']) || isset($attr['HEIGHT']))) {
                if(!isset($attr['WIDTH']))
                    $attr['WIDTH'] = 0;
                if(!isset($attr['HEIGHT']))
                    $attr['HEIGHT'] = 0;
                $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
            }
            break;
        case 'BLOCKQUOTE':
        case 'BR':
            $this->Ln(5);
            break;
        case 'P':
            $this->Ln(10);
            break;
        case 'FONT':
            if (isset($attr['COLOR']) && $attr['COLOR']!='') {
                $coul=hex2dec($attr['COLOR']);
                $this->SetTextColor($coul['R'],$coul['G'],$coul['B']);
                $this->issetcolor=true;
            }
            if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist)) {
                $this->SetFont(strtolower($attr['FACE']));
                $this->issetfont=true;
            }
            if (isset($attr['FACE']) && in_array(strtolower($attr['FACE']), $this->fontlist) && isset($attr['SIZE']) && $attr['SIZE']!='') {
                $this->SetFont(strtolower($attr['FACE']),'',$attr['SIZE']);
                $this->issetfont=true;
            }
            break;
    }
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='SUP') {
    }

    if($tag=='TD') { // TD-END
        $this->tdbegin=false;
        $this->tdwidth=0;
        $this->tdheight=0;
        $this->tdalign="L";
        $this->tdbgcolor=false;
    }
    if($tag=='TR') { // TR-END
        $this->Ln();
    }
    if($tag=='TABLE') { // TABLE-END
        $this->tableborder=0;
    }

    if($tag=='STRONG')
        $tag='B';
    if($tag=='EM')
        $tag='I';
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
    if($tag=='FONT'){
        if ($this->issetcolor==true) {
            $this->SetTextColor(0);
        }
        if ($this->issetfont) {
            $this->SetFont('arial');
            $this->issetfont=false;
        }
    }
}

function SetStyle($tag, $enable)
{
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s) {
        if($this->$s>0)
            $style.=$s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    //Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

function SetCellMargin($margin){
        // Set cell margin
        $this->cMargin = $margin;
    }


}



// Create a new PDF with landscape orientation and custom size
$pdf = new PDF('L', 'in', array(7.50, 10.00));
$pdf->SetAutoPageBreak(false); // Disable automatic page breaks

// Title Page
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 48); // Bold, large font
$pdf->SetTextColor(75, 73, 172); // Instagram-like color
$pdf->SetXY(0, 3); // Center the title vertically
$pdf->Cell(10.00, 1, 'Sri Shringarr Fashion Studio', 0, 1, 'C'); // Center the title horizontally

// Add a smaller subtitle or logo-like text
$pdf->SetFont('Arial', 'I', 24); // Italic, medium font
$pdf->SetTextColor(150, 150, 255); // A lighter, complementary color
$pdf->SetXY(0, 4); // Position slightly below the main title
$pdf->Cell(10.00, 1, 'The Ultimate Fashion Destination', 0, 1, 'C'); // Centered subtitle

// Add an additional decorative line or design element (optional)
$pdf->SetLineWidth(0.1);
$pdf->SetDrawColor(75, 73, 172); // Match the title color
$pdf->Line(2, 4.8, 8, 4.8); // Draw a line below the title

// Add a new page for the data content
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 20); // Set font for the data content
$pdf->SetTextColor(0, 0, 0); // Reset text color to black

// Margins and layout settings for the data pages
$left_margin = 0.5;
$right_margin = 0.5;
$top_margin = 0.5;
$bottom_margin = 0.5;

$column_width = 4.4; // Width of each image
$column_spacing = 0.2; // Space between columns
$columns = 2;

// Calculate usable height
$usable_height = 10.00 - $top_margin - $bottom_margin;

// Calculate X positions for columns
$positions = [];
for ($col = 0; $col < $columns; $col++) {
    $positions[$col] = $left_margin + ($col * ($column_width + $column_spacing));
}

// Initialize Y position
$current_y = $top_margin;

// Initialize counters
$i = 0;

// Prepare POST data
array_shift($_POST);
$pdfName = isset($_REQUEST['pdfName']) ? $_REQUEST['pdfName'] : 'output';
array_pop($_POST);

// Total items
$total_items = count($_POST);

// Loop through each product
foreach ($_POST as $radioName => $selectedValue) {
    // Extract product details
    $nameParts = explode('-', $radioName);
    $sku = isset($nameParts[0]) ? $nameParts[0] : 'SKU';
    $product_id = isset($nameParts[1]) ? $nameParts[1] : 'ID';
    $selectedImagePart = explode('-', $selectedValue);
    $selectedImage = isset($selectedImagePart[2]) ? $selectedImagePart[2] : '';

    // Database query to get image
    $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `gproduct_id`='$product_id'";
    if (!empty($selectedImage)) {
        $sqlimg .= " AND img_name LIKE '%" . mysqli_real_escape_string($web_con, $selectedImage) . "%'";
    }

    $qryimg = mysqli_query($web_con, $sqlimg);
    $link = 'apparel_detail.php?id=' . $product_id . '&days=3&page=1';

    if (!$qryimg || mysqli_num_rows($qryimg) == 0) {
        $sqlimg = "SELECT img_name FROM `product_images_new` WHERE `product_id`='$product_id'";
        if (!empty($selectedImage)) {
            $sqlimg .= " AND img_name LIKE '%" . mysqli_real_escape_string($web_con, $selectedImage) . "%'";
        }

        $qryimg = mysqli_query($web_con, $sqlimg);
        $link = 'jewel_detail.php?id=' . $product_id . '&days=3&page=1';
    }

    if ($qryimg && mysqli_num_rows($qryimg) > 0) {
        $rowimg = mysqli_fetch_array($qryimg);
        $source_img = "yn/uploads" . $rowimg['img_name'];
        $filename = basename($source_img);
        $_file_parent = "https://srishringarr.com/";
        $_new_filename = $_file_parent . $source_img;

        // Check if the image exists on the server
        if (!@file_get_contents($_new_filename)) { // Suppress warnings with @
            $destination_img = "../../" . $source_img;
        } else {
            $destination_img = $_new_filename; // Use the URL if exists
        }
    } else {
        // Default image if none found
        $destination_img = 'path_to_default_image.jpg'; // Replace with your default image path
    }

    // Determine column and row
    $column = $i % $columns;
    $row = floor($i / $columns);

    // Calculate X and Y positions
    $x = $positions[$column];
    $y = $current_y;

    // Check if adding the image exceeds the page height
    // Estimate image height based on width (assuming aspect ratio ~1:1.5, adjust as needed)
    $image_width = $column_width;
    $image_height = 6.0; // Adjust as necessary

    if ($y + $image_height + 0.5 > ($top_margin + $usable_height)) { // 0.5 inch space for SKU and padding
        $pdf->AddPage();
        $current_y = $top_margin;
        $y = $current_y;
    }

    // Add Image
    $pdf->Image($destination_img, $x, $y, $image_width, $image_height);

    // Add hyperlink
    $pdf->Link($x, $y, $image_width, $image_height, 'https://srishringarr.com/' . $link);

    // Add SKU below the image
    $pdf->SetTextColor(75, 73, 172); // Set desired color
    $pdf->SetXY($x, $y + $image_height + 0.2); // 0.2 inches below the image
    $pdf->SetFont('Arial', '', 12); // Smaller font for SKU
    $pdf->Cell($image_width, 0.3, 'View: ' . $sku, 0, 0, 'C');

    // Increment counters
    $i++;

    // After two columns, move to next row
    if ($column == ($columns - 1)) {
        $current_y += $image_height + 0.8; // 0.8 inch between rows, adjust as needed
    }

    // If it's the last item and it's not filling the entire row, adjust Y
    if ($i == $total_items && $column != ($columns - 1)) {
        $current_y += $image_height + 0.8;
    }
}

// Output the PDF
$pdf->Output($pdfName . '.pdf', 'D'); // 'I' for inline display, 'D' for download

?>