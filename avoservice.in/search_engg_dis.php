<?php
include("access.php");
session_start();
//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];


?>
<body>
<form name="form1" method="post">

<table border="1" align="center" style="margin-right:35%;margin-left:35% ;margin-top:15px" width="100%" cellpadding="2" cellspacing="0" id="dis_summary">

<!--<table align="center" width="600" border="2" cellpadding="2" cellspacing="0" style="margin-top:5px;margin-left:20px;" id="custtable">  -->

<tr>

<th width="3%">S.No</th>
<th width="10%">Date</th>
<th width="15%">Name</th>
<th width="8%">Distance Travelled</th>


</tr>


<?php

$count=0;
include("config.php");
$fix=25;

$engg=$_POST['Employee_name'];
$from =$_POST['from'];
$to =$_POST['to'];

$strPage=$_POST['Page'];

 
//$sday1="select distinct(dis_date),eng_id  from engg_distances where eng_id='".$engg."' and dis_date between '".$from."' and '".$to."' ORDER BY dis_date ASC";

$sday1="select dis_date,eng_id, dis_travelled from engg_distances where eng_id='".$engg."' and dis_date between '".$from."' and '".$to."' ORDER BY dis_date ASC";

//echo $sday1;

$rday1=mysqli_query($con1,$sday1);

$srn='1';

if(mysqli_num_rows($rday1)>0){
while($result=mysqli_fetch_array($rday1))
{

//$dist=mysqli_query($con1,"select dis_travelled from engg_distances where dis_date='".$result[0]."' and eng_id='".$result[1]."' ");

//$distance=mysqli_fetch_row($dist);

$qry=mysqli_query($con1,"select engg_name,  engg_desgn from area_engg where engg_id='".$result[1]."'");

$eng=mysqli_fetch_row($qry);



?>

<tr>
<td><?php echo $srn;?></td>

<td><?php echo $eng[0];?></td>
<td><?php echo $result[0];?></td>
<td><?php echo $result[2];?></td>

</tr>

<?php
$srn++;
}


} else {

?>
<h4 class="h4color" align="center" style="color:red">No Records found in this Date. Last Record found is:</h4>

<? } ?>
</table>
</form>
</body>
