<?php
   session_start();
   include('cal_attendance1.php');
   include("constants.php"); 
   include("$absolutepath/$dbfile");
   require_once 'Excel/reader.php';
   
// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();

// Set output Encoding.
$data->setOutputEncoding('CP1251');

$maxsize='412';
$rep=array();
$size=($_FILES['userfile']['size']/1024); 

if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['userfile']['name']; 

//echo $fichier."<br/>";
function getExtension($str)
{
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}	
	
if($fichier){
	 
$filename = stripslashes($_FILES['userfile']['name']);

//get the extension of the file in a lower case format
$extension = getExtension($filename);
$extension = strtolower($extension);
$image_name=time().'.'.$extension;				
$newname="excel_img/".$image_name;
	///echo $newname;	
	
$copied = copy($_FILES['userfile']['tmp_name'], $newname);


if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}
$error=0;
//echo $newname."<br/>";

$data->read($newname);

error_reporting(E_ALL ^ E_NOTICE);
$ab=array();
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
$errors=0;
   mysql_query("BEGIN");
for ($x = 1; $x <= $data->sheets[0]['numRows']; $x++) {
//echo $x." <br>";

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}
		
        $aa=str_replace("/","-",$ab[2]);
	$dtt=date('Y-m-d H:i:s',strtotime($aa));	
	$dt=substr($dtt,0,10);
	$mon=substr($dtt,5,2);
	$y=substr($dtt,0,4);
	$tim=substr($dtt,11,8);
	
	if($month==$mon && $year==$y)
	{
       //  echo $ab[1].",".$aa.",".$dtt.",".$dt.",".$tim.",".$mon.",".$y."<br/>";
		$qry=mysql_query("INSERT INTO `punches_log`(`ID`, `punchtime`, `p_date`, `p_time`) VALUES ('".$ab[1]."','".$dtt."','".$dt."','".$tim."')");
		if(!$qry)
		{
   	        $errors++;
   	        break;
   	        }
	}
	//$qry=mysql_query();
}
 if($errors>0){
 mysql_query("ROLLBACK");
 echo 'Error occured while uploading data. Please check your data and try again. Click <a href="upload_punch.php" >here</a> to go back';
 }
 else
 {
   mysql_query("COMMIT");
   	update_all($month);
   	echo 'Attendance uploaded Successfully. Click <a href="generatePayroll.php" >here</a> to view';
 }
 
}
?>