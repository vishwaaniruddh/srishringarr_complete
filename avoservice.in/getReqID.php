<html>
<head>

</head>

<body>
   <table  id="aTable">

 <tr>
<?php 
include 'config.php';
include("access.php");

$from=$_POST['$from'];
$to=$_POST['$to'];




$qsday2="select distinct(date) from Attendance where date between '".$from ."' and '".$to ."'";
$qrday2=mysqli_query($con1,$qsday2);
 echo "ram".$qsday2;
while($row2=mysqli_fetch_array($qrday2))
{

$fsday3="select distinct(date) from Attendance where date='".$row2[0]."'";
  
echo "hiii".$fsday3;
$fetchrday3=mysqli_query($con1,$fsday3);




 while($rda7=mysqli_fetch_array($fetchrday3)){


 $sday1="select attendance,date from Attendance where date='".$rda7[0]."'";
 echo $sday1;
 $rday1=mysqli_query($con1,$sday1);
 $rowcount=mysqli_num_rows($rday1);

 while($row4=mysqli_fetch_array($rday1)){

   ?>
<td ><?php echo $row4[0];?></td>
</tr>

<?php
} 
?>

<?
}
?>



<?
}
?>




</table>
</body>
</html>
