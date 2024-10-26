<?php
define('PHP_INT_MIN', ~PHP_INT_MAX);
// Test CVS
//$ass=$_POST['ass'];
//$ass2=$_POST['ass1'];
//$spec=$_POST['spec'];
//$valid=$_POST['valid'];
include("config.php");
//$astcnt=mysql_query("select * from assets");
//$astnum= mysql_num_rows($astcnt);
//$cust=$_POST['cust'];
//$po=$_POST['po'];
$err=array();
//$po2=$_POST['po2'];
 //$type=$_POST['type'];
//$specass=$_POST['specass'];
//$service=$_POST['servicetype'];
$pattern = '/[^0-9]*/';
$counter=0;
$d=date('Y-m-d');
//include_once('class_files/select.php');
//$sel_obj=new select();
//$state=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("state","state_id"),"state","","",array(""),"y","state","a");
//$stqr=mysql_query("select state,state_id from state ");

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');

/***
* if you want you can change 'iconv' to mb_convert_encoding:
* $data->setUTFEncoder('mb');
*
**/

/***
* By default rows & cols indeces start with 1
* For change initial index use:
* $data->setRowColOffset(0);
*
**/



/***
*  Some function for formatting output.
* $data->setDefaultFormat('%.2f');
* setDefaultFormat - set format for columns with unknown formatting
*
* $data->setColumnFormat(4, '%.3f');
* setColumnFormat - set format for column (apply only to number fields)
*
**/
function registration($patid,$stdt,$amt,$dis,$exp,$pack,$center)
{
	/*$qr=mysql_query("select * from patient_package where patid='".$patid."' and center='".$center."'");
	if(mysql_num_rows($qr)>0)
	{
		$qrr=mysql_fetch_row($qr);
		if($qrr[4]<=$stdt)
		{
		$up=mysql_query("update patient_package set status='1' where patid='".$patid."' and expdt<='$stdt' and center='".$center."'");
		$package=mysql_query("Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`,`center`) Values('".$patid."','".$pack."','".$stdt."','".$exp."','".$amt."','".$dis."','".$center."')");
		}
		else
		$package=mysql_query("Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`,`status`,`center`) Values('".$patid."','".$pack."','".$stdt."','".$exp."','".$amt."','".$dis."','1','".$center."')");
	}
	else
	{*/
//echo "Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`) Values('".$patid."','".$pack."','".$stdt."','".$exp."','".$amt."','".$dis."')<br>";
	$package=mysql_query("Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`,`center`) Values('".$patid."','".$pack."','".$stdt."','".$exp."','".$amt."','".$dis."','".$center."')");
	//}
}
$maxsize='2000';

$size=($_FILES['userfile']['size']/1024);

//echo $size;
if($size>$maxsize)
{
//echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['userfile']['name']; 

//echo $fichier;
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
//echo "<br>file name ".$filename;
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
////echo $newname;

$data->read($newname);
/*


 $data->sheets[0]['numRows'] - count rows
 $data->sheets[0]['numCols'] - count columns
 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column

 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
    
    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
*/

error_reporting(E_ALL ^ E_NOTICE);
$ab=array();

for ($x = 1; $x <= $data->sheets[0]['numRows']; $x++) {


	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}// end j ka for loop
	$ini=substr($ab[1],0,1);
	$newsrno=$ini."-".$ab[3];
	if($ab[3]!='')
	{
	$patid='';
	
	//echo "<br>".$ab[1]." ".$ab[2]." ".$ab[3]." ".$ab[4]." ".$ab[5]." ".$ab[6]." ".$ab[7]." ".$ab[8]." ".$ab[9]." ".$ab[10]." ".$ab[11]." ".$ab[12]." ".$ab[13]." ".$ab[14]." ".$ab[15]." ".$ab[16]." ".$ab[17]." ".$ab[18]." ".$ab[19]." ".$ab[20]." ".$ab[21]." ".$ab[22]." ".$ab[23]." ".$ab[24]." ".$ab[25]." ".$ab[26]." ".$ab[27]." ".$ab[28]." ".$ab[29]." ".$ab[30]."<br> ";
$get=mysql_query("select * from patient where srno='".$newsrno."' and area='$ab[1]'");
if(mysql_num_rows($get)>0)
{
$entrydt=str_replace("/","-",$ab[4]);
$entrydt=date("Y-m-d",strtotime($entrydt,'-1 day'));
$patid=$newsrno;
//echo "<br>entry date ".$entrydt." ".$ab[5]." ".$ab[25]." ".$ab[8];
if($ab[9]=='r')
{
//echo $ab[11];

if($ab[11]!='')
{
$stdt=explode("to",$ab[11]);
$stdt=str_replace("/","-",$stdt[0]);
$stdt=date("Y-m-d",strtotime($stdt,'-1 day'));
$expdt=date('Y-m-d', strtotime($stdt .' +'.$ab[10].''));
registration($newsrno,$stdt,$ab[15],$ab[14],$expdt,$ab[10],$ab[1]);
}
if($ab[12]!='')
{
$stdt=explode("to",$ab[12]);
$stdt=str_replace("/","-",$stdt[0]);
$stdt=date("Y-m-d",strtotime($stdt,'-1 day'));
$expdt=date('Y-m-d', strtotime($stdt .' +'.$ab[10].''));
registration($newsrno,$stdt,$ab[15],$ab[14],$expdt,$ab[10],$ab[1]);
}
}
}
else
{
$entrydt=str_replace("/","-",$ab[4]);
$entrydt=date("Y-m-d",strtotime($entrydt,'-1 day'));
//echo "<br>entry date ".$entrydt." ".$ab[5]." ".$ab[25];
$dob=str_replace("/","-",$ab[25]);
$dob=date("Y-m-d",strtotime($dob,'-1 day'));
echo $patid=$newsrno;
echo "select max(no) from `patient` where area='".$ab[1]."'<br>";
$sq=mysql_query("select max(no) from `patient` where area='".$ab[1]."'");
$max=mysql_fetch_row($sq);
echo $max[0]." area<br>";
$newpatid=$max[0]+1;
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $ab[6]))
   $add=str_replace("'","\'",$ab[6]);
else
$add=$ab[6];
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $ab[7]))
   $mob=str_replace("'","\'",$ab[7]);
else
$mob=$ab[7];

if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $ab[5]))
   $name=str_replace("'","\'",$ab[5]);
else
$name=$ab[5];
$qr=mysql_query("INSERT INTO `patient` (`no`,`srno`,`name`,`birth`, `sex`,`telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`)values('$newpatid','".$newsrno."','$name','$dob','$ab[26]','','$mob','Mumbai','$add','','$entrydt','$ab[8]','','','','$ab[9]','$ab[1]')");
//echo "INSERT INTO `patient` (`no`,`srno`,`name`,`birth`, `sex`,`telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`)values('$newpatid','".$ab[3]."','$ab[5]','$dob','$ab[26]','','$mob','Mumbai','$add','','$entrydt','$ab[8]','','','','$ab[9]','$ab[1]')";
if(!$qr)
echo "failed".mysql_error();
if($qr && $ab[9]=='r')
{
//echo $ab[11];

if($ab[11]!='')
{
$stdt=explode("to",$ab[11]);
$stdt=str_replace("/","-",$stdt[0]);
$stdt=date("Y-m-d",strtotime($stdt,'-1 day'));
$expdt=date('Y-m-d', strtotime($stdt .' +'.$ab[10].''));
registration($newsrno,$stdt,$ab[15],$ab[14],$expdt,$ab[10],$ab[1]);
}
if($ab[12]!='')
{
$stdt=explode("to",$ab[12]);
$stdt=str_replace("/","-",$stdt[0]);
$stdt=date("Y-m-d",strtotime($stdt,'-1 day'));
$expdt=date('Y-m-d', strtotime($stdt .' +'.$ab[10].''));
registration($newsrno,$stdt,$ab[15],$ab[14],$expdt,$ab[10],$ab[1]);
}
}
else
echo mysql_error();
//$qry=mysql_query("INSERT INTO `patient` (`no`,`srno`,`name`,`birth`, `sex`,`telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`)values('$newpatid','".$ab[2]."','$ab[3]','$dob','$ab[22]','$ab[5]','$ab[5]','mumbai','$ab[4]','','$d','$ab[6]','$ab[6]','$ab[5]','','".$ab[7]."','Malad')");

}
}

/*	if($ab[3]!='' && $ab[1]!='')
	{
	$get=mysql_query("select * from patient where srno='".$ab[1]."'");
	
	echo "<h2>".$x."</h2> <br>";
  $dt=str_replace("/","-",$ab[2]);
	//echo $dt." ";
	 $dt2=date('Y-m-d', strtotime($dt .' -1 day'));
echo "<br>";
$dob=str_replace("/","-",$ab[21]);
$dob=date('Y-m-d', strtotime($dob .' -1 day'));
	if($dt2=='1970-01-01')
	{
	$err[$counter]=$x;
	$counter=$counter+1;
	$UNIX_DATE = ($ab[2] - 25569) * 86400;
	$EXCEL_DATE = 25569 + ($UNIX_DATE / 86400);
	$UNIX_DATE = ($EXCEL_DATE - 25569) * 86400;
$dt2= gmdate("Y-m-d", $UNIX_DATE);
	}
	if($dob=='1970-01-01')
	{
	$err[$counter]=$x;
	$counter=$counter+1;
	$UNIX_DATE = ($ab[2] - 25569) * 86400;
	$EXCEL_DATE = 25569 + ($UNIX_DATE / 86400);
	$UNIX_DATE = ($EXCEL_DATE - 25569) * 86400;
$dob= gmdate("Y-m-d", $UNIX_DATE);
	}
	
	if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $ab[4]))
{
   $ab[4]=str_replace("'","\'",$ab[4]);
}
else
$ab[4]=$ab[4];
	//echo $ab[1].",".$ab[2].",".$ab[3].",".$ab[4].",".$ab[5].",".$ab[6].",".$ab[7]."/".$ab[8].",".$ab[10].",".$ab[11]."<br>";
	$sq=mysql_query("select max(no) from `patient`");
$max=mysql_fetch_row($sq);
//echo $max[0];
$newpatid=$max[0]+1;
 
//$newsrno=$max12[0]."-".$newpatid;
	//echo "INSERT INTO `patient` (`no`,`srno`,`name`,`birth`, `sex`, `telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`)values('$newpatid','".$ab[1]."','$ab[3]','$dob','$ab[22]','$ab[5]','$ab[5]','mumbai','$ab[4]','','$d','$ab[6]','$ab[6]','$ab[5]','','".$ab[7]."','Malad')";
	//echo "INSERT INTO `patient` (`no`,`srno`,`name`,`birth`, `sex`, `telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`)values('$newpatid','".$ab[1]."','$ab[3]','$dob','$ab[22]','$ab[5]','$ab[5]','mumbai','$ab[4]','','$d','$ab[6]','$ab[6]','$ab[5]','','".$ab[7]."','Malad')";
	
	$qry=mysql_query("INSERT INTO `patient` (`no`,`srno`,`name`,`birth`, `sex`, `telno`,`mobile`,`city`,`address`,`ref`,`date`,`email`,`email2`,`mobile2`,`photo`,`type`,`area`)values('$newpatid','".$ab[1]."','$ab[3]','$dob','$ab[22]','$ab[5]','$ab[5]','mumbai','$ab[4]','','$d','$ab[6]','$ab[6]','$ab[5]','','".$ab[7]."','Malad')");
	//echo "select * from package where desc='".$ab[8]."'<br>";
	
	if($qry)
	{
	if($ab[7]=='r')
	{
	$expdt=date('Y-m-d', strtotime($dt2 .' +'.$ab[8].''));
	//echo "Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`) Values('".$ab[1]."','".$ab[8]."','".$dt2."','".$expdt."','".$ab[11]."','".$ab[10]."')<br>";
	$package=mysql_query("Insert into patient_package(`patientid`,`packid`,`startdt`,`expdt`,`amt`,`discount`) Values('".$ab[1]."','".$ab[8]."','".$dt2."','".$expdt."','".$ab[11]."','".$ab[10]."')");
	}
	
	
	}
	
	///echo "<br/>";

}*/

}//end x ka for loop



/*if(count($err)>0)
{
echo "<h2>Total ".count($err)." Atm IDs has failed to upload due to Invalid date Format or empty Bank Name or Empty Address</h2><br>";
echo "<a href='newsite.php'>Click here to go back</a><br>";
echo "Please Correct Below rows Data to upload<br>";
for($a=0;$a<count($err);$a++)
{
echo $err[$a]."<br>";

}
}
else
{
?>
<script type="text/javascript">
//alert("Data uploaded successfully");
//window.location='newsite.php';
</script>
<?php
}*/
///print_r($data);
////print_r($data->formatRecords);
?>