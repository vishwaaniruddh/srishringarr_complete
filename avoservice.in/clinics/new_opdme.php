<?php 
include('config.php');
//echo "hi";
if(isset($_POST['Submit']))
{
//echo "hello";
 $patid=$_POST['patient_id'];
//echo "<br>";
  $hospital=$_POST['hospital'];
  $date1=$_POST['date1'];
  $examtemp=$_POST['examtemp'];
  $opdtemp=$_POST['opdtemp'];
  $comp=$_POST['comp'];
  $findin=$_POST['findin'];
  $soi=$_POST['soi'];
  $hos=$_POST['hos'];
  $surgery=$_POST['surgery'];
  //$adv=$_POST['adv'];
  $adv='';
 // $diag=$_POST['diag'];
  $diag='';
  $key1=$_POST['key1'];
$impr=$_POST['impr'];
$invest=$_POST['invest'];
$physio=$_POST['physio'];
$actxt=$_POST['actxt'];
$comm=$_POST['comm'];
$cost=$_POST['cost'];
$instruc=$_POST['instruc'];
 $nxtdate=$_POST['nxtdate'];
  $hos1=$_POST['hos1'];
$med=$_POST['med'];
$tak=$_POST['tak'];
$dos=$_POST['dos'];
$days=$_POST['days'];
$pot=$_POST['pot'];
$cmnt=$_POST['cmnt'];
$drugs=$_POST['drugs'];
$dosage=$_POST['dosage'];
$blis=$_POST['blis'];
$inst=$_POST['inst'];
$d=count($med);
$aid=$_POST['aid'];
$finding=trim($findin," ");
//$newhospital=$_POST['newhospital'];
$block_id=$_POST['block_id'];
 $slot=$_POST['sl'];
$tp='new';
$strarray1='';
		//$strarray2=$tak[$i];
  $strarray3='';
 
$strarray5='';
 $nxttext=$_POST['nxttext'];
 if(isset($_POST['cekpres']))
 {
	 for($i=0;$i<count($_POST['cekpres']);$i++)
	 if(isset($_POST['cekpres'][$i]))
	 {
		// echo "select  medicines,days1,prescmnt from opd where opd_id='".$_POST['cekpres'][$i]."'";
	 $op=mysql_query("select  medicines,days1,prescmnt from opd where opd_id='".$_POST['cekpres'][$i]."'");
	 $opro=mysql_fetch_row($op);
	if($opro[0]!='')
	{
	echo	$strarray1=$opro[0];
		//$strarray2=$tak[$i];
   echo     $strarray3=$opro[1];
 
	echo	$strarray5=$opro[2];
	}
		
	 }
 }
for($i=0;$i<$d;$i++)
{ 
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $med[$i]))
{
   $med[$i]=str_replace("'","\'",$med[$i]);
}
else
$med[$i]=$med[$i];
if($i!=0) {
	if($med[$i]!=''){
		$strarray=$strarray.",".$dos[$i];
		$strarray1=$strarray1.",".$med[$i];
		//$strarray2=$strarray2.",".$tak[$i];
        $strarray3=$strarray3.",".($days[$i]);
		$strarray4=$strarray4.",".$pot[$i];
		$strarray5=$strarray5.",".$cmnt[$i];
		$strarray6=$strarray6.",".$drugs[$i];
		$strarray7=$strarray7.",".$dosage[$i];
		$strarray8=$strarray8.",".$blis[$i];
		$strarray9=$strarray9.",".$inst[$i];
		
	}
	} else {
	
	if($strarray1=='')
	{
		$strarray=$dos[$i];
		$strarray1=$med[$i];
		//$strarray2=$tak[$i];
        $strarray3=($days[$i]);
  $strarray4=$pot[$i];
		$strarray5=$cmnt[$i];
		$strarray6=$drugs[$i];
		$strarray7=$dosage[$i];
		$strarray8=$blis[$i];
		$strarray9=$inst[$i];
	}
	else
	{
		if($med[$i]!=''){
		$strarray=$strarray.",".$dos[$i];
		$strarray1=$strarray1.",".$med[$i];
		//$strarray2=$strarray2.",".$tak[$i];
        $strarray3=$strarray3.",".($days[$i]);
		$strarray4=$strarray4.",".$pot[$i];
		$strarray5=$strarray5.",".$cmnt[$i];
		$strarray6=$strarray6.",".$drugs[$i];
		$strarray7=$strarray7.",".$dosage[$i];
		$strarray8=$strarray8.",".$blis[$i];
		$strarray9=$strarray9.",".$inst[$i];
		}
	}
	}
	}
	
	$sq12=mysql_query("select * from `machine_code` where machine_name='Net'");
$max12=mysql_fetch_row($sq12);

$sq11=mysql_query("select max(opd_id) from `opd`");
$max11=mysql_fetch_row($sq11);
//echo $max[0];
$newopd=$max11[0]+1;
 $newsrno=$max12[0]."-".$newopd;
//echo $strarray1;
	
 //echo $strarray3;
 
//echo "med ".$strarray5;
 $qrymetxt=mysql_query("Select saved_text from scratchnotes");
 $qrytxtres=mysql_fetch_row($qrymetxt);
 echo $qrytxtres[0];
 echo "INSERT INTO `opd`(`opd_id`,`patient_id`, `opddate`,`hospital`,`complaint`,`clinical`,`advise`,`diagnosis`, `medicines`,`howtotake`,`dosage`,`intervention`,`impression`,`invadvise`,`goals`,`comments`,`cost`,`days1`,`nextdate`,`nxttext`,`nexttime`,`nexthosp`,`surgery`, `hosp`,`action`,`keyword1`,`exam_temp`, `opd_temp`,`instruct`,`app_id`,`block_id`,`opd_real_id`,`potency`,`prescmnt`,`drugs`,`dos`,`blister`,`instruction`) values('$newopd','$patid',STR_TO_DATE('".$date1."','%d/%m/%Y'), '$hospital','$qrytxtres[0]','$finding','$adv','$diag','$strarray1','','$strarray','$soi','$impr','$invest','$physio','$comm','$cost','$strarray3', STR_TO_DATE('".$nxtdate."','%d/%m/%Y'), '$nxttext','$slot','$hos1','$surgery','$hos','$actxt','$key1','$examtemp','$opdtemp','$instruc','$aid','$block_id','$newsrno','$strarray4','$strarray5','$strarray6','$strarray7','$strarray8','$strarray9')";
$sql="INSERT INTO `opd`(`opd_id`,`patient_id`, `opddate`,`hospital`,`complaint`,`clinical`,`advise`,`diagnosis`, `medicines`,`howtotake`,`dosage`,`intervention`,`impression`,`invadvise`,`goals`,`comments`,`cost`,`days1`,`nextdate`,`nxttext`,`nexttime`,`nexthosp`,`surgery`, `hosp`,`action`,`keyword1`,`exam_temp`, `opd_temp`,`instruct`,`app_id`,`block_id`,`opd_real_id`,`potency`,`prescmnt`,`drugs`,`dos`,`blister`,`instruction`) values('$newopd','$patid',STR_TO_DATE('".$date1."','%d/%m/%Y'), '$hospital','$qrytxtres[0]','$finding','$adv','$diag','$strarray1','','$strarray','$soi','$impr','$invest','$physio','$comm','$cost','$strarray3', STR_TO_DATE('".$nxtdate."','%d/%m/%Y'), '$nxttext','$slot','$hos1','$surgery','$hos','$actxt','$key1','$examtemp','$opdtemp','$instruc','$aid','$block_id','$newsrno','$strarray4','$strarray5','$strarray6','$strarray7','$strarray8','$strarray9')";
//echo $sql;
$result=mysql_query($sql);
echo "update scratchnotes set saved_text=''";
//$qrytxtup=mysql_query("update scratchnotes set saved_text=''");
if(!$result)
echo "failed".mysql_error();

	//echo "update scratchnotes set saved_text=''";

}
?>