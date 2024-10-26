<?php
// Test CVS

include("config.php");

$cust=$_POST['cust'];
$po=$_POST['po'];
$err=array();
$po2=$_POST['po2'];
$type=$_POST['type'];
$specass=$_POST['specass'];
$service=$_POST['servicetype'];
$pattern = '/[^0-9]*/';
$counter=0;

require_once 'Excel/reader.php';


// ExcelFile($filename, $encoding);
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
			//get the extension of the file in a lower case format
				$extension = getExtension($filename);
				$extension = strtolower($extension);
				
				$image_name=time().'.'.$extension;
				
$newname="excel_img/".$image_name;

//	echo $newname;	


$copied = copy($_FILES['userfile2']['tmp_name'], $newname);

if (!$copied) 
{
	echo '<h1>Copy unsuccessfull!</h1>';
		$errors=1;
}
}
$error=0;

//echo $newname;

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
$contents='';
$citycat=array("A", "B", "C", "D","E");



if($type=="AMC")
{
$contents='';
$contents.="ATM Id \t Bank Name \t Area \t Pincode \t City \t State \t Branch \t Address \t Ref_id \t Amc Start date \t Ups \t Number of Ups \t  Ups warrenty \t Battery(separated with commas if multiple) \t Number of Battery (separated with commas) \t Battery warranty(separated with commas if multiple) \t  Isolation Transformer \t Number of Isolation transformer \t Isolation Transformer Warranty \t  Stablizer \t number of stablizer \t  Stablizer warranty \t amc end dt \t AVR\t number of AVR\t  AVR warranty \t Reason \t Distance from Branch";
	//echo "Total rows=".;
for ($x = 1; $x <= $data->sheets[0]['numRows']; $x++) {

	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
	
	$ab=$data->sheets[0]['cells'][$x];
	
	
//	echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
		
	}// end j ka for loop

//	echo $ab[1].",".$ab[2].",/".$ab[3].",".$ab[4].",/".$ab[5].",/".$ab[6].",/".$ab[7]."/".$ab[8]."/".$ab[9].", date ".$ab[10].",".$ab[11]."<br>";
	
	//echo "date=".$ab[10]."<br>";
	 
	 $dat=trim($ab[10]);
	$dt="0000-00-00";
$UNIX_DATE = ($dat - 25569) * 86400;
	//echo "<br>".$ab[18];
	if($UNIX_DATE>0){
 $dt=gmdate("Y-m-d",$UNIX_DATE);
// echo $UNIX_DATE.">>><<<".$dat." *** *** ".$dt."<br>";
}
  
	//echo $dt."<br> ";
	 $start=date('Y-m-d', strtotime($dt));
         $end=date('Y-m-d', strtotime("+12 months $start"));
	if($ab[23]!='')
	{
	 $UNIX_DATE1 = (trim($ab[23]) - 25569) * 86400;
	//echo "<br>".$ab[18];
	
	if($UNIX_DATE1>0){
        $dt1=gmdate("Y-m-d",$UNIX_DATE1);  
        $end=date('Y-m-d', strtotime($dt1)); 
                         }      
        }
        
	$ab1=preg_replace('/\s+/', ' ', $ab[1]);
	$ab2=preg_replace('/\s+/', ' ', $ab[2]);
	$ab3=preg_replace('/\s+/', ' ', $ab[3]);
	$ab4=preg_replace('/\s+/', ' ', $ab[4]);
	$ab5=preg_replace('/\s+/', ' ', $ab[5]);
	$ab6=preg_replace('/\s+/', ' ', $ab[6]);
	$ab7=preg_replace('/\s+/', ' ', $ab[7]);
	$ab8=preg_replace('/\s+/', ' ', $ab[8]);
	$ab9=preg_replace('/\s+/', ' ', $ab[9]);
	$ab10=preg_replace('/\s+/', ' ', $ab[10]);
	$ab11=preg_replace('/\s+/', ' ', $ab[11]);
	$ab12=preg_replace('/\s+/', ' ', $ab[12]);
	$ab13=preg_replace('/\s+/', ' ', $ab[13]);
	$ab14=preg_replace('/\s+/', ' ', $ab[14]);
	$ab15=preg_replace('/\s+/', ' ', $ab[15]);
	$ab16=preg_replace('/\s+/', ' ', $ab[16]);
	$ab17=preg_replace('/\s+/', ' ', $ab[17]);
	$ab18=preg_replace('/\s+/', ' ', $ab[18]);
	$ab19=preg_replace('/\s+/', ' ', $ab[19]);
	$ab20=preg_replace('/\s+/', ' ', $ab[20]);
	$ab21=preg_replace('/\s+/', ' ', $ab[21]);
	$ab22=preg_replace('/\s+/', ' ', $ab[22]);
	$ab23=preg_replace('/\s+/', ' ', $ab[23]);
	$ab24=preg_replace('/\s+/', ' ', $ab[24]);
	$ab25=preg_replace('/\s+/', ' ', $ab[25]);
	
	
	if($start=='0000-00-00' || $ab[10]=='' || $ab[1]=='')
	{
	//echo $start." A ".$ab[10]." B ".$ab[1]."<br>";
	$contents.="\n ".$ab1." \t ".$ab2." \t ".$ab3." \t ".$ab4." \t ".$ab5." \t ".$ab6." \t ".$ab7." \t ".$ab8." \t ".$ab9." \t ".$ab10." \t ".$ab11." \t ".$ab12." \t ".$ab13." \t ".$ab14." \t ".$ab15." \t ".$ab16." \t ".$ab17." \t ".$ab18." \t ".$ab19." \t ".$ab20." \t ".$ab21." \t ".$ab22." \t ".$ab23." \t ".$ab24." \t ".$ab25." \t Invalid Date or Blank ATM ID12 \t".$ab[26];

	 $err[$counter]=$x;
	 $counter=$counter+1;
	}
	else
	{
	
	//echo "select atmid from atm where atmid='".$ab[1]."'";
	$check=mysqli_query($con1,"select atmid,amc_st_date from Amc where atmid='".$ab[1]."'");
	if(mysqli_num_rows($check)>0)
	{
         $rowa=mysqli_fetch_row($check);
         if($start==$rowa[1])
           {
	$contents.="\n ".$ab1." \t ".$ab2." \t ".$ab3." \t ".$ab4." \t ".$ab5." \t ".$ab6." \t ".$ab7." \t ".$ab8." \t ".$ab9." \t ".$ab10." \t ".$ab11." \t ".$ab12." \t ".$ab13." \t ".$ab14." \t ".$ab15." \t ".$ab16." \t ".$ab17." \t ".$ab18." \t ".$ab19." \t ".$ab20." \t ".$ab21." \t ".$ab22." \t ".$ab23." \t ".$ab24." \t ".$ab25." \t ATM ID Already Exists \t".$ab[26];

	$err[$counter]=$x;
	 $counter=$counter+1;
           }
           else
           {
            $state=mysqli_query($con1,"select id from `avo_branch` where `name`='".$ab[7]."'");
	     if(mysqli_num_rows($state)==0)
	       {
            //============= If address & other details rectify
            mysqli_query($con1,"update Amc set amc_st_date='".$start."',amc_ex_date='".$end."',bankname='".$ab2."', city='".$ab5."', state='".$ab6."', address='".addslashes($ab8)."',cid='".$cust."' where atmid='".$ab1."'");
          
          
          // Update start Date enddate only===============
         //  mysqli_query($con1,"update Amc set amc_st_date='".$start."',amc_ex_date='".$end."', state='".$ab[6]."' where atmid='".$ab1."'");   
          }
              else
	       {
                       $rr=mysqli_fetch_row($state);
        
             mysqli_query($con1,"update Amc set amc_st_date='".$start."',amc_ex_date='".$end."',bankname='".$ab2."',city='".$ab5."',state='".$ab6."', address='".addslashes($ab8)."',cid='".$cust."',branch='".$rr[0]."' where atmid='".$ab1."'");
           
           
           // Update start Date enddate only================  
         //    mysqli_query($con1,"update Amc set amc_st_date='".$start."',amc_ex_date='".$end."' where atmid='".$ab1."'");
               }

             mysqli_query($con1,"update amcpurchaseorder set startdt='".$start."',expdt='".$end."' where amcsiteid=(select AMCID from Amc where atmid='".$ab1."')");
           
           //  echo "update amcpurchaseorder set startdt='".$start."',expdt='".$end."' where amcsiteid='".$ab1."'";
           }
	}
	else{
	//echo "select * from `avo_branch` where `name`='".$ab[7]."'";
	$state=mysqli_query($con1,"select id from `avo_branch` where `name`='".$ab[7]."'");
	if(mysqli_num_rows($state)==0)
	{
	
	
	$contents.="\n ".$ab1." \t ".$ab2." \t ".$ab3." \t ".$ab4." \t ".$ab5." \t ".$ab6." \t ".$ab7." \t ".$ab8." \t ".$ab9." \t ".$ab10." \t ".$ab11." \t ".$ab12." \t ".$ab13." \t ".$ab14." \t ".$ab15." \t ".$ab16." \t ".$ab17." \t ".$ab18." \t ".$ab19." \t ".$ab20." \t ".$ab21." \t ".$ab22." \t ".$ab23." \t ".$ab24." \t ".$ab25." \t Branch does not match \t".$ab[26];
	
	
	$err[$counter]=$x;
	 $counter=$counter+1;
	}
	else
	{
          $rr=mysqli_fetch_row($state);
	//echo "<br>INSERT INTO  Amc(po,cid,atmid,bankname,area,pincode,city,state,address,Ref_id,servicetype) VALUES('$po2','$cust','$ab[1]','$ab[2]','$ab[3]','$ab[4]','$ab[5]','$ab[6]','$ab[8]','$ab[9]','".$service."')<br>";
	if($ab[2]!='' || $ab[8]!='')
	{
if(!in_array($ab[28],$citycat))
	{
	
	$contents.="\n ".$ab1." \t ".$ab2." \t ".$ab3." \t ".$ab4." \t ".$ab5." \t ".$ab6." \t ".$ab7." \t ".$ab8." \t ".$ab9." \t ".$ab10." \t ".$ab11." \t ".$ab12." \t ".$ab13." \t ".$ab14." \t ".$ab15." \t ".$ab16." \t ".$ab17." \t ".$ab18." \t ".$ab19." \t ".$ab20." \t ".$ab21." \t ".$ab22." \t ".$ab23." \t ".$ab24." \t ".$ab25." \t Invalid city category \t".$ab[26];
	
	
	}
	else
	{
         //$qry=mysqli_query($con1,"select id from avo_branch where name='".$ab[7]."'");	 
	
	 $result= mysqli_query($con1,"INSERT INTO  Amc(po,cid,atmid,bankname,area,pincode,city,address,Refid,state,amc_st_date,amc_ex_date,cat,branch) VALUES('$po2','$cust','".trim($ab1)."','".trim($ab2)."','$ab3','$ab4','$ab5','".mysqli_real_escape_string($ab8)."','$ab9','$ab6','".$start."','".$end."','".$ab[28]."','".$rr[0]."')");
	
	
	
$id=mysqli_insert_id();

//echo $ab[9]." ";
	$exp=date('Y-m-d', strtotime("+12 months $start"));
	if($ab[23]!='')
	{
	$exp=trim($ab[23]);
	
$UNIX_DATE2 = ($exp- 25569) * 86400;
	//echo "<br>".$ab[18];
	if($UNIX_DATE>0){
 $exp=gmdate("Y-m-d",$UNIX_DATE2);
 //echo $UNIX_DATE.">>><<<".$dat." *** *** ".$dt."<br>";
}
	}
	
	 $qry=mysqli_query($con1,"INSERT INTO `amcpurchaseorder` (`id`, `cid`, `po`, `startdt`, `expdt`,`amcsiteid`) VALUES (NULL, '".$cust."', '".$po2."', '".$start."','".$exp."','".$id."')");

 if(!$result)
echo "".mysqli_error();

/*
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
	if(date("Y-m-d",strtotime("+".$j." months", $today))<$exp)
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
	if(date("Y-m-d",strtotime("+".$j." months", $today))<$exp)
	$q=mysqli_query($con1,"Insert into servicemonth(`po`,`date`,`type`,`siteid`) Values('".$po2."','".date("Y-m-d",strtotime("+".$j." months", $today))."','AMC','".$id."')");
	if(!$q)
	echo "failed".mysqli_error();
	}
} */
	
 $cnt=11;
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
		}//end of else city category
		else
		{
		
		$contents.="\n ".$ab1." \t ".$ab2." \t ".$ab3." \t ".$ab4." \t ".$ab5." \t ".$ab6." \t ".$ab7." \t ".$ab8." \t ".$ab9." \t ".$ab10." \t ".$ab11." \t ".$ab12." \t ".$ab13." \t ".$ab14." \t ".$ab15." \t ".$ab16." \t ".$ab17." \t ".$ab18." \t ".$ab19." \t ".$ab20." \t ".$ab21." \t ".$ab22." \t ".$ab23." \t ".$ab24." \t ".$ab25." \t Bank Name or Adress is Empty \t".$ab[26];	
		
	
		 $err[$counter]=$x;
	 $counter=$counter+1;
		}
		}//end of state check
		}//end of check else
	} ///end else of startdate "<br/>";

}//end x ka for loop	
}



 //print $contents;

if(count($err)>0)
{
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=rejectedsites.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  //echo "<br>";
echo "<script type='text/javascript'>window.location='newsite.php';</script>";

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