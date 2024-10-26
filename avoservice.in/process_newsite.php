<?php
// Test CVS
//$ass=$_POST['ass'];
//$ass2=$_POST['ass1'];
//$spec=$_POST['spec'];
//$valid=$_POST['valid'];
include("config.php");
//$astcnt=mysqli_query($con1,"select * from assets");
//$astnum= mysqli_num_rows($astcnt);
$cust=$_POST['cust'];
$po=$_POST['po'];
$err=array();
$po2=$_POST['po2'];
 $type=$_POST['type'];
$specass=$_POST['specass'];
$service=$_POST['servicetype'];
$pattern = '/[^0-9]*/';
$counter=0;
//include_once('class_files/select.php');
//$sel_obj=new select();
//$state=$sel_obj->select_rows('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("state","state_id"),"state","","",array(""),"y","state","a");
//$stqr=mysqli_query($con1,"select state,state_id from state ");

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
$maxsize='412';
if($type=="sales")
$size=($_FILES['userfile']['size']/1024);
else
$size=($_FILES["userfile2"]["size"] / 1024);
 

if($size>$maxsize)
{
echo "Your file size is ".$size;
echo "File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 if($type=="sales")
$fichier=$_FILES['userfile']['name']; 
elseif($type=="AMC")
$fichier=$_FILES['userfile2']['name'];
///echo $fichier;
 function getExtension($str)
		 {
		 	$i = strrpos($str,".");
			if (!$i) { return ""; }
			$l = strlen($str) - $i;
			$ext = substr($str,$i+1,$l);
			return $ext;
		 }
	
	
if($fichier){
	 if($type=="sales"){
$filename = stripslashes($_FILES['userfile']['name']);
}elseif($type=="AMC"){
$filename = stripslashes($_FILES['userfile2']['name']);
}
			//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().'.'.$extension;
				
$newname="excel_img/".$image_name;
	///echo $newname;	
	if($type=="sales"){
$copied = copy($_FILES['userfile']['tmp_name'], $newname);
}
elseif($type=="AMC"){
$copied = copy($_FILES['userfile2']['tmp_name'], $newname);
}
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

if($type=='sales')
{
for ($x = 1; $x <= $data->sheets[0]['numRows']; $x++) {
//echo $x." <br>";

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}// end j ka for loop
	////echo $ab[1].",".$ab[2].",".$ab[3].",".$ab[4].",".$ab[5].",".$ab[6].",".$ab[7]."/".$ab[8]."/".$ab[9].",".$ab[10].",".$ab[11];
	
	
  $dt=str_replace("/","-",$ab[9]);
	//echo $dt." ";
	 $dt2=date('Y-m-d', strtotime($dt .' -1 day'));
	if($start=='1970-01-01')
	{
	$err[$counter]=$x;
	$counter=$counter+1;
	}
	else
	{
	///echo $ab[8];
	//echo $ab[9];
	//echo "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id)  VALUES('$ab[1]','$ab[2]','$ab[3]','$ab[4]','$ab[5]','$ab[6]','$ab[7]','$ab[8]','$po','$cust')";
	
	//$dt2=date('Y-m-d',strtotime($dt));
	//echo "INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype)  VALUES('$ab[1]','$ab[2]','$ab[3]','$ab[4]','$ab[5]','$ab[6]','$ab[7]','$ab[8]','$po','$cust','".$service."')";
	if($ab[2]!='' || $ab[7]!='')
	{
	$ref='';
	if($ab[8]=='')
	$ref=$ab[1];
	else
	$ref=$ab[8];
	 $result= mysqli_query($con1,"INSERT INTO  atm(atm_id,bank_name,area,pincode,city,state,address,ref_id,po,cust_id,servicetype,podate,state1)  VALUES('$ab[1]','$ab[2]','$ab[3]','$ab[4]','$ab[5]','$ab[6]','$ab[7]','".$ref."','$po','$cust','".$service."','".$dt2."','$ab[6]')");
	 $atmid=mysqli_insert_id();
	 $cnt=10;
	 $cnt2=0;
	$astdata=mysqli_query($con1,"select * from assets");
	 while($astrow=mysqli_fetch_array($astdata))
	 {
		 $cnt2=$cnt2+1;
		//echo "<br>---".$ab[$cnt]."--<br>".$cnt."<br>";
	 if($ab[$cnt]=='')
	    {
			//echo "***hi***";
		  $cnt=$cnt+3;	
		}
		else
		{
		//echo "***hello***";	
		//echo "<br>";
		
		
	 $ast=array();
	 $astcnt=array();
	 $astwarr=array();
	 $astspecid=array();
	 
	 //if multiple same asset
	// echo $ab[$cnt];
	 $ass=explode(",",$ab[$cnt]);
	 //echo count($ass);
	 $num=explode(",",$ab[$cnt+1]);
	 $warr=explode(",",$ab[$cnt+2]);
	 for($b=0;$b<count($ass);$b++)
	       {
			  //echo "<br>hi<br>";
	 //removing of any characters expect numbers
	$ast[]= preg_replace($pattern,'', $ass[$b]);
	$astcnt[]= preg_replace($pattern,'', $num[$b]);
	$astwarr[]= preg_replace($pattern,'', $warr[$b]).",month";
	//echo "<br>select ass_spc_id from assets_specification where assets_id='".$astrow[0]."' and name LIKE '".$ast[$b]."%'<br>";
	$qr=mysqli_query($con1,"select ass_spc_id from assets_specification where assets_id='".$astrow[0]."' and name LIKE '".$ast[$b]."%'");
	$qrrow=mysqli_fetch_row($qr);
	
	$astspecid[]=$qrrow[0];
	//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity) values('$cust','$po','".$astrow[1]."','".$astspecid[$b]."','".$astwarr[$b]."','".$astcnt[$b]."')";
	/*$qry2=mysqli_query($con1,"select * from site_assets where cust_id='".$cust."' and po='".$po."' and assets_spec='".$astspecid[$b]."'");
	if(!$qry2)
	echo "".mysqli_error();
	if(mysqli_num_rows($qry2)>0)
	{*/
		//echo "insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity) values('$cust','$po','".$astrow[1]."','".$astspecid[$b]."','".$astwarr[$b]."','".$astcnt[$b]."')";
	$insert=mysqli_query($con1,"insert into `site_assets`(cust_id,po,assets_name,assets_spec,valid,quantity,atmid) values('$cust','$po','".$astrow[1]."','".$astspecid[$b]."','".$astwarr[$b]."','".$astcnt[$b]."','".$atmid."')");
	     
		 if(!$insert)
		 echo "failed".mysqli_error();
	//}//echo $cnt."<br>";
		    
		   }//end for loop
		
			$cnt=$cnt+3;
	 
	     }//end else
	 }//end while
	}
	else
	{
	$err[$counter]=$x;
	$counter=$counter+1;
	}
	
	
	///echo "<br/>";

}//end of date else

}//end x ka for loop
}//end sales site
elseif($type=="AMC")
{
	//echo "Total rows=".;
for ($x = 1; $x <= $data->sheets[0]['numRows']; $x++) {

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
		///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}// end j ka for loop
	//echo $ab[1].",".$ab[2].",/".$ab[3].",".$ab[4].",/".$ab[5].",/".$ab[6].",/".$ab[7]."/".$ab[8]."/".$ab[9].", date ".$ab[10].",".$ab[11]."<br>";
	
	//echo "date=".$ab[9]."<br>";
	 $dt=str_replace("/","-",$ab[9]);
	//echo $dt."<br> ";
	 $start=date('Y-m-d', strtotime($dt .' -1 day'));
	if($start=='1970-01-01' || $ab[9]=='')
	{
//	echo $ab[1]." ".date('Y-m-d', strtotime($ab[9]))." ".$x."<br>";
	//echo $start." ".$ab[1]."<br>";
	 $err[$counter]=$x;
	 $counter=$counter+1;
	}
	else
	{
	//echo "<br>INSERT INTO  Amc(po,cid,atmid,bankname,area,pincode,city,state,address,Ref_id,servicetype) VALUES('$po2','$cust','$ab[1]','$ab[2]','$ab[3]','$ab[4]','$ab[5]','$ab[6]','$ab[7]','$ab[8]','".$service."')<br>";
	if($ab[2]!='' || $ab[7]!='')
	{
	 $result= mysqli_query($con1,"INSERT INTO  Amc(po,cid,atmid,bankname,area,pincode,city,state,address,Ref_id,servicetype,state1) VALUES('$po2','$cust','$ab[1]','$ab[2]','$ab[3]','$ab[4]','$ab[5]','$ab[6]','$ab[7]','$ab[8]','".$service."','$ab[6]')");
$id=mysqli_insert_id();

//echo $ab[9]." ";
	
	//echo $start." <br>";
	//echo "<br>INSERT INTO `satyavan_accounts`.`amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$po2."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id."')<br>";
	 $qry=mysqli_query($con1,"INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$po2."', '".$start."','".date('Y-m-d', strtotime("+12 months $start"))."','".$id."')");

if(!$result)
echo "".mysqli_error();
$today = strtotime($dt .' -1 day');
//$twoMonthsLater = strtotime("+2 months", $today);
$j=0;
//echo $service;
if($service=='3')
{
	
	for($i=1;$i<=4;$i++)
	{
		//echo $i."<br>";
	$j=$service*$i;
	//echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
elseif($service=='6')
{
	
	for($i=1;$i<=2;$i++)
	{
		//echo $i."<br>";
	$j=$service*$i;
	//echo "<br>Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')<br>";
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
}
	
 $cnt=10;
	 $cnt2=0;
	$astdata=mysqli_query($con1,"select * from assets");
	 while($astrow=mysqli_fetch_array($astdata))
	 {
		 $cnt2=$cnt2+1;
		 if($ab[$cnt]=='')
	    {
			//echo "***hi***";
		  $cnt=$cnt+3;	
		}
		else
		{
		//echo "***hello***";	
		//echo "<br>";
		
		
	 $ast=array();
	 $astcnt=array();
	 $astwarr=array();
	 $astspecid=array();
	 
	 //if multiple same asset
	 //echo $ab[$cnt];
	 $ass=explode(",",$ab[$cnt]);
	 //echo count($ass);
	 $num=explode(",",$ab[$cnt+1]);
	 $warr=explode(",",$ab[$cnt+2]);
	 for($b=0;$b<count($ass);$b++)
	       {
			  //echo "<br>hi<br>";
	 //removing of any characters expect numbers
	$ast[]= preg_replace($pattern,'', $ass[$b]);
	$astcnt[]= preg_replace($pattern,'', $num[$b]);
	$astwarr[]= preg_replace($pattern,'', $warr[$b]).",month";
	//echo "<br>select ass_spc_id from assets_specification where assets_id='".$astrow[0]."' and name LIKE '".$ast[$b]."%'<br>";
	$qr=mysqli_query($con1,"select ass_spc_id from assets_specification where assets_id='".$astrow[0]."' and name LIKE '".$ast[$b]."%'");
	$qrrow=mysqli_fetch_row($qr);
	
	$astspecid[]=$qrrow[0];
	
		//echo "<br>insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$po2','".$astrow[1]."','".$astspecid[$b]."','".$astcnt[$b]."','".$id."')<br>";
		if($astspecid[$b]!='')
		{
	$insert=mysqli_query($con1,"insert into `amcassets`(amcid,amcpoid,assets_name,assetspecid,quantity,siteid) values('$cust','$po2','".$astrow[1]."','".$astspecid[$b]."','".$astcnt[$b]."','".$id."')");
	 if(!$insert)
		 echo "failed".mysqli_error();
	     }
		
	//echo $cnt."<br>";
		    
		   }//end for loop
		
			$cnt=$cnt+3;
	 
	     }//end else
	 } //end while
		}
		else
		{
		 $err[$counter]=$x;
	 $counter=$counter+1;
		}
	} ///end else of startdate "<br/>";

}//end x ka for loop	
}
//header('location:newsite.php');

}
if(count($err)>0)
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
alert("Data uploaded successfully");
window.location='newsite.php';
</script>
<?php
}
///print_r($data);
////print_r($data->formatRecords);
?>