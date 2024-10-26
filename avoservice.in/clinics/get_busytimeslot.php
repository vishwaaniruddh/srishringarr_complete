<?php
include('config.php');
 $hos=$_GET['hos']; 
 $appdate=$_GET['appdate'];
 $center=$_GET['center'];
 $cnt=0;
$d=0;
//echo "SELECT * FROM `slot` where hospital='$hos' and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
$qry="SELECT * FROM `slot` where hospital='$hos' and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
//echo $qry;
$res=mysql_query($qry);
if(mysql_num_rows($res)>0)
{
$row=mysql_fetch_row($res);

//echo "SELECT slot FROM `appoint` where hospital='$hos' and cancstat=0 and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
$qry1="SELECT slot FROM `appoint` where hospital='$hos' and cancstat=0 and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."'";
//echo "<br>".$qry1;
$res1=mysql_query($qry1);
//echo "select duration from apptype where type='".$hos."'";
$dur=mysql_query("select duration from apptype where type='".$hos."'");
$durro=mysql_fetch_row($dur);
//$row1=mysql_fetch_row($res1);
$booked=array();
$k=0;
while($row1=mysql_fetch_row($res1)){
	$booked[$k]=$row1[0];
	 $booked[$k];
	$k++;
}
//echo count($booked);
//echo "<br>".$row[3];
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
else $d=($m-$m1)/$durro[0]; //echo "<br>"." ".$d." ".$m." ".$m1;

//echo "<br><br>".(($m-$m1)/$durro[0]);
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
$sl=mysql_query("SELECT block_id FROM `slot` where app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."' and hospital='".$hos."'");
$slro=mysql_fetch_row($sl);

?>

<input type="hidden" value="<?php echo $slro[0]; ?>" name="block_id" />

<table width="172" style="background-color:#FFC"><tr>
<?php
for($i=1;$i<=ceil($d);$i++)
{
$cnt=$cnt+1;
//echo "select * from busyslot where date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and branch='".$center."' and slotid='".$slro[0]."' and time='".$startTime."'";
$busy=mysql_query("select * from busyslot where date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and branch='".$center."' and slotid='".$slro[0]."' and time='".$startTime."'");

//echo $i."<br>";
	if($i%4==0)
{

	if (in_array($i, $booked)) {
 //echo "SELECT confirmstat FROM `appoint` where hospital='$hos' and cancstat=0 and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."' and slot='".$i."'";;
  $cong="SELECT confirmstat FROM `appoint` where hospital='$hos' and cancstat=0 and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."' and slot='".$i."'";
//echo $cong."<br>";
$congr=mysql_query($cong);
$congro=mysql_fetch_row($congr);
//echo $congro[0];
if($congro[0]=='w')
$color='orange';
elseif($congro[0]=='c')
$color='green';
else
$color='#090';

//echo $color;
echo "<td width='30' height='20' style='border:1px solid;background-color:".$color."'  >$startTime</td></tr>"; }
else
{
if(mysql_num_rows($busy)>0)
echo "<td width='30' height='20' style='border:1px solid;background-color:white'> $startTime</td></tr>";
else
echo "<td width='30' height='20' style='border:1px solid;' id='".$i."'><input type='checkbox' name='busyslot[]' value='".$startTime."'> $startTime</td></tr>";

}
} 
else
{
	if (in_array($i, $booked)) {
		//echo "SELECT confirmstat FROM `appoint` where hospital='$hos' and cancstat=0 and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."' and slot='".$i."'";
    $cong="SELECT confirmstat FROM `appoint` where hospital='$hos' and cancstat=0 and app_date=STR_TO_DATE('".$appdate."','%d/%m/%Y') and center='".$center."' and slot='".$i."'";
//echo $cong."<br>";
$congr=mysql_query($cong);
$congro=mysql_fetch_row($congr);
//echo $congro[0];
if($congro[0]=='w')
$color='orange';
elseif($congro[0]=='c')
$color='green';
else
$color='#090';


//echo $color;
echo "<td width='30' height='20' style='border:1px solid;background-color:".$color."'  >$startTime</td>"; }
else
{
if(mysql_num_rows($busy)>0)
echo "<td width='30' height='20' style='border:1px solid;background-color:white'> $startTime</td>";
else
echo "<td width='30' height='20' style='border:1px solid;' id='".$i."'><input type='checkbox' name='busyslot[]' value='".$startTime."'> $startTime</td>";
}
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
 //echo $startTime1;



?>
<input type="hidden" name="cnt" id="cnt" value="<?php echo $cnt; ?>" />
</tr></table>
<?php
}
else
echo "No Slots Found";
?>