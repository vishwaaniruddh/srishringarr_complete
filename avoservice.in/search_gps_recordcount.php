<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection


$branch=$_POST['branch_avo'];


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$frmdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['fromdt'])));
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));

}

else{
$frmdt=date('Y-m-d');
$todt=date('Y-m-d');
}

//echo $frmdt;
//echo $todt;

$strPage = $_REQUEST['Page'];


?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="3%">S.N.</th> 
<th width="15%">Engineer Name</th>
<th width="15%">Designation</th>
<th width="15%">Branch</th>

<th width="15%">Day First</th>
<th width="15%">Day Last</th>
<th width="15%">Total Records</th>


<?php

$ii=1;

if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
$qry="SELECT engg_id,engg_name, loginid, engg_desgn FROM `area_engg` where  status=1 and deleted=0";
$qry.=" and area ='".$branch."'";

if(isset($_POST['engg']) && $_POST['engg']!='') {
$engg=$_POST['engg'];

$qry.=" and engg_id ='".$engg."'";}

//echo $qry;

$qy=mysqli_query($con1,$qry);

//================= Date heading====

//$sday1="select distinct(date(pending_date))  from alert_progress where responsetime between '".$frmdt." 00:00:00' and '".$todt." 00:00:00' ORDER BY date(responsetime) ASC";



 </tr>
  <?php 

while ($engg=mysqli_fetch_row($qy))

//=====================First Call Attend Time===========
{


$qryengg="SELECT engg_id,engg_name, loginid, engg_desgn, area FROM `area_engg` where engg_id='".$engg[0]."'";

$enggrow=mysqli_query($con1,$qryengg);
$engname=mysqli_fetch_row($enggrow);

$sday2="select distinct(date(dt))  from Location where dt between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' ORDER BY date(dt) ASC";

//======== Branch
$qrybr=mysqli_query($con1,"SELECT name FROM `avo_branch` where id='".$engname[4]."'");
$br= mysqli_fetch_row($qrybr);

//echo $sday2 ;
?>

<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="top"><?php echo $engg[1]; ?></td>

<td  valign="top"><?php echo $engg[3]; ?></td>
<td  valign="top"><?php echo $br[0]; ?></td>


<?

$rday2=mysqli_query($con1,$sday2);
    
while($row2=mysqli_fetch_array($rday2)){

$dt2= "select count(id) As count from Location where engg_id= '".$engname[0]."' and dt between '".$row2[0]." 00:00:00' and '".$row2[0]." 23:59:59' group by engg_id" ;



$qry3= mysqli_query($con1,$dt2) ;
$rec_cnt= mysqli_fetch_assoc($qry3);

$cnt=$rec_cnt['count'];



?>

<td  align="center"><?php echo $cnt; ?> </td>

<!-- <td  align="center"><?php echo $time; ?> </td>
<td  align="center"><?php echo $ltime; ?> </td>
<td  align="center"><a href="travellingmap.php?eid=<?php echo $eng; ?>&date=<?php echo $date; ?>" target="_new"> <?php echo $cnt ; ?> </td> 

<td  align="center"><?php echo $dist[0]; ?> </td> -->

<? } ?>

</tr>
<?php $ii++;    


} ?>


</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
/*
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}*/
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 

