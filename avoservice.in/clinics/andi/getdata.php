<?php
include("../config.php");
//echo $apptype=$name=str_replace(" ",'_',$_GET['apptype']);
if(isset($_GET['apptype']) && isset($_GET['appdate']) && isset($_GET['branch']))
{
 $apptype=str_replace('_'," ",$_GET['apptype']);
 //$apptype=$_GET['apptype'];
  $appdate=$_GET['appdate'];
  $center=$_GET['branch'];
$str=array();
$time=array();
//echo "SELECT * FROM `slot` where `app_date`=STR_TO_DATE('".$appdate."','%d/%m/%Y') and `center`='".$center."' and `hospital`='".$apptype."'";
$qry="SELECT * FROM `slot` where `app_date`=STR_TO_DATE('".$appdate."','%d/%m/%Y') and `center`='".$center."' and `hospital`='".$apptype."'";
//echo $qry;
$res=mysql_query($qry);
if(mysql_num_rows($res)>0)
{
$row=mysql_fetch_row($res);
$frmtime=$row[3];
//$str.='_';
$totime=$row[4];
//$str.='_';
$dur=mysql_query("select duration from apptype where type='".$apptype."'");
$durro=mysql_fetch_row($dur);
//$str.=$durro[0];

//$str.='_';
$qry1="SELECT slot FROM `appoint` where hospital='$apptype' and cancstat=0 and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
$booked=array();
$k=0;
$res1=mysql_query($qry1);
while($row1=mysql_fetch_row($res1)){

$booked[$k]=$row1[0];
	//echo $booked[$k];
	$k++;
}


$time = strtotime($row[3]);
//echo "<br>".$time;
$startTime = date("h:i a",$time);
//echo "<br>".$startTime;

 //echo "<br>".$row[4];
//echo "<br>".$startTime;
$arr = explode(":", $row[4]);
//echo "<br>".$arr[0]." ".$arr[1];
$m=$arr[0] * 60 + $arr[1] ;//. " minutes";
$arr1 = explode(":", $row[3]);
$m1=$arr1[0] * 60 + $arr1[1];// . " minutes";
//echo "<br>".$m." ".$m1." ".$durro[0];
if($m<$m1) { $diff=$m1-$m;
            $netdiff = 1440-$diff;
	     $d=$netdiff/$durro[0];
		//echo $diff." ".$netdiff;
}
else  $d=($m-$m1)/$durro[0];


//$str.=$row[0];
//$str.='_';
for($i=1;$i<=ceil($d);$i++)
{
//echo $i."<br>";
	if($i%4==0)
{
	if (in_array($i, $booked)) {
	}
	else
$str[]=array( 'slot' => $startTime);
} 
else
{
	if (in_array($i, $booked)) {
    }
else
$str[]=array( 'slot' => $startTime);
}
//echo $startTime;
//$ex=explode(" ",$startTime);
//echo $startTime;
$str_time=strtotime($startTime); //echo $str_time;
$time_24=date("H:i",$str_time); //echo $time_24;
$add_str=strtotime($time_24." + $durro[0] minutes"); //echo $add_str;
//if($ex[1]=="am"){
//	
//	}
$add_time=date("h:i a",$add_str); //echo $add_time;
$startTime=$add_time;

//echo $startTime1;
/*
$startTime1 = $startTime1."+10 minutes"; echo $startTime1;
//$startTime1=date("h:i a",$startTime1);
$startTime1=str_replace("am","",$startTime1);//echo $startTime1." ";
$startTime1=str_replace("pm","",$startTime1);
//echo $hr;
$date_formed = strtotime($startTime1); //echo $date_formed." ";
$startTime = date("h:i a",$date_formed);//echo $startTime;
$a1=explode(' ',$startTime);
list($hr1,$min1)=explode(":",$startTime);//echo $hr;
if($a1[1]=="am" && $hr1==12){
	$hr1-=12;
	}
if($a1[1]=="pm" && $hr1==12){
	
	}
$startTime1=$hr1.":".$min1;*/
		}
		//$str[]=array( 'slotid' => $row[0]);





echo json_encode($str);
}
else
{
$str.="No Slot Found";
//echo json_encode($str);
}

}
?>