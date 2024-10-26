<?php
  $nxt=str_replace("/","-",$_GET['nxtdt']);
 $nxt2=date("Y-m-d",strtotime($nxt));
if(isset($_GET['val']))
{
 $val=$_GET['val'];

 $date=date("Y-m-d",strtotime("+1 day"));
//echo "<br>";
$time=strtotime($date);
//echo date('Y-m-d',$time)."<br>";
 //$nxtdt=$_GET['nxtdt'];
$val2=explode(",",$val);

for($i=0;$i<count($val2);$i++)
{
//echo "<br>". $val2[$i]."<br>";
//echo $date."<br>";
 $twoMonthsLater =date("Y-m-d", strtotime("+".$val2[$i], $time));
 $dt=getdatefun($date,$twoMonthsLater);
$date=$dt;
//echo "<br>";
}
//echo $nxt2." ".$dt;
/*if($dt<=$nxt2)
echo date("d/m/Y",strtotime($nxt2));
else*/
echo date("d/m/Y",strtotime($dt));
}
function getdatefun($dt1,$dt2)
{
if($dt1>=$dt2)
return $dt1;
else
return $dt2;
}
/*$nextdt=str_replace("/","-",$nxtdt);

$nextdt=date("Y-m-d", strtotime($nextdt));

$date = date("Y-m-d");// current date
 $time=strtotime(date("Y-m-d", strtotime($date)) . " +$val");
$nexttime=strtotime($nextdt);

if($time>$nexttime)
{
echo date('d/m/Y',strtotime(date("Y-m-d", strtotime($date)) . " +$val"));
}
else
echo $nxtdt;	 */

?>