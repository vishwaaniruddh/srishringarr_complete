<?php
include("config.php");
include("get_nextappdt.php");
$id=$_GET['id'];
 $date2=date("Y-m-d",strtotime("+1 day"));
$time2=strtotime($date2);
?>

<?php
$query=mysql_query("select  medicines,days1,prescmnt from opd where opd_id='".$id."'");
$cnt=0;
$rowm=mysql_fetch_row($query);
$med=explode(",",$rowm[0]);
$dur=explode(",",$rowm[1]);
$cmt=explode(",",$rowm[2]);
for($i=0;$i<count($med);$i++)
{
	//echo $med[$i];
	if($med[$i]!='')
	{
		$cnt=$cnt+1;
	}
}
if($cnt>0){
	?>
    <table border="1" >
<tr><th>Sr No</th><th>Medicines</th> <th>Duration</th> <th>Remarks</th></tr>

    <?php
   for($i=0;$i<count($med);$i++)
   {
	$twoMonthsLater =date("Y-m-d", strtotime("+ ".$dur[$i], $time2));
 $dt=getdatefun($date,$twoMonthsLater);
$date=$dt;
	?>
   <tr> <td><?php echo $i+1;  ?></td><td> <?php echo $med[$i]; ?></td><td> <?php echo $dur[$i]; ?></td><td> <?php echo $cmt[$i]; ?></td></tr>
	
  <?php
  	
   }
   ?>
   </table>
   <?php
   echo "##@".date("d/m/Y",strtotime($dt));
}
else
{
	echo "No medicine Prescribed";
}

?>
