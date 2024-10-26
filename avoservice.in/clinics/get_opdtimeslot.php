<?php
include('config.php');
$hos=$_GET['hos1']; 
$appdate=$_GET['nxtdate'];


$qry="SELECT * FROM `slot` where hospital='$hos' and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y')";
$res=mysql_query($qry);
$row=mysql_fetch_row($res);


$qry1="SELECT slot FROM `appoint` where hospital='$hos' and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y')";
$res1=mysql_query($qry1);
//$row1=mysql_fetch_row($res1);
$booked=array();
$k=0;
while($row1=mysql_fetch_row($res1)){
	$booked[$k]=$row1[0];
	//echo $booked[$k];
	$k++;
}
//echo count($booked);

$time = strtotime($row[3]);//echo $time;
$startTime = date("h:i a",$time);//echo $startTime; echo $row[4];
//echo $startTime;
$arr = explode(":", $row[4]);
$m=$arr[0] * 60 + $arr[1] ;//. " minutes";
$arr1 = explode(":", $row[3]);
$m1=$arr1[0] * 60 + $arr1[1];// . " minutes";

if($m<$m1) { $diff=$m1-$m;
            $netdiff = 1440-$diff;
	     $d=$netdiff/10;
		 //echo $diff." ".$netdiff;
}
else $d=($m-$m1)/10; //echo " ".$d." ".$m." ".$m1;
/*
$startTime1=$startTime; 
$a=explode(' ',$startTime1);
list($hr,$min)=explode(":",$startTime1);//echo $hr;
if($a[1]=="am" && $hr==12){
	$hr-=12;
	}
if($a[1]=="pm" && $hr==12){
	$hr-=12;
	}
	
$startTime1=$hr.":".$min;*/
?>

<input type="hidden" value="<?php echo $row[0]; ?>" name="block_id" />

<table width="172" style="background-color:#FFC"><tr>
<?php
for($i=1;$i<=$d;$i++)
{
	if($i%4==0)
{
	if (in_array($i, $booked)) {
  
echo "<td width='40' height='20' style='border:1px solid;background-color:#090'  >$startTime</td></tr>"; }
else
echo "<td width='40' height='20' style='border:1px solid;' onClick='colorchange(this,".$i.")'; id='".$i."'>$startTime</td></tr>";
} 

else
{
	if (in_array($i, $booked)) {
   
	echo "<td width='40' height='20' style='border:1px solid;background-color:#090'  >$startTime</td>"; }
else
echo "<td width='40' height='20' style='border:1px solid;' onClick='colorchange(this,".$i.")'; id='".$i."'>$startTime</td>";
}
//echo $startTime;
//$ex=explode(" ",$startTime);
//echo $startTime;
$str_time=strtotime($startTime); //echo $str_time;
$time_24=date("H:i",$str_time); //echo $time_24;
$add_str=strtotime($time_24." + 10 minutes"); //echo $add_str;
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
 //echo $startTime1;



?>
</tr></table>