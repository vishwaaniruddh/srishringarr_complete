<?php
// Test CVS

include("config.php");

$pattern = '/[^0-9]*/';
$counter=0;

require_once 'Excel/reader.php';

$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');
$maxsize='800';

$size=($_FILES["userfile"]["size"] / 1024);
 
if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['userfile']['name'];


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
}
			//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().'.'.$extension;
				
$newname="excel_img/".$image_name;

$copied = copy($_FILES['userfile']['tmp_name'], $newname);



if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$error=1;
}
}

$error=0;
$cdate=date('Y-m-d');
$data->read($newname);

error_reporting(E_ALL ^ E_NOTICE);
$ab=array();

$contents='';
$contents.="S.No \t SIte Id\t Expiry Date";

for ($x = 1; $x <= $data->sheets[0]['numRows']; $x++) {

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
	

	$date=$ab[3];

if($date=='') {
    $date=$cdate;
}

	$dt="0000-00-00";
    $UNIX_DATE = ($date - 25569) * 86400;
	if($UNIX_DATE>0){
 $dt=gmdate("Y-m-d",$UNIX_DATE);

}
	 $expiry=date('Y-m-d', strtotime($dt));	

	$sno=$ab[1];
	$site_id=$ab[2];
	

$atmqry=mysqli_query($con1,"select amcid from `Amc` where `atmid`='".$site_id."'");
if(mysqli_num_rows($atmqry)==0) {

	$contents.="\n ".$ab1." \t ".$ab2." \t ".$ab3." \t Id Not Available";

	 $err[$counter]=$x;
	 $counter=$counter+1;
	 
	}  else {
	
$result=mysqli_query($con1,"update Amc set amc_ex_date='".$expiry."', active='N' where atmid='".$site_id."'");
// echo "update Amc set amc_ex_date='".$expiry."',active='N' where atmid='".$site_id."'";         
}

}

}

 //======================print $contents;

if(count($err)>0)
{

$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
  header("Content-Disposition: attachment; filename=rejectedsites.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  //echo "<br>";
//echo "<script type='text/javascript'>window.location='newsite.php';</script>";

}
else
{ 
    
?>
<script type="text/javascript">
alert("Data uploaded successfully");
window.location='deactivate_amc.php';
//window.close();
</script>
<?php
} ?>