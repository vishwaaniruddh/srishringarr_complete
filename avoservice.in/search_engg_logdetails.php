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
<th width="25%">Engineer Name</th>
<th width="10%">Desination</th>
<th width="10%">Branch</th>

<?php

$ii=1;

if($_SESSION['designation']==1){

$qry="SELECT engg_id,engg_name, loginid, emp_code,engg_desgn, area FROM `area_engg` where status=1 and deleted=0";
} else
$qry="SELECT engg_id,engg_name, loginid, emp_code,engg_desgn, area FROM `area_engg` where area='".$branch."' and status=1 and deleted=0";

if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')

$qry.=" and area ='".$branch."'";

if(isset($_POST['engg']) && $_POST['engg']!='') {
$engg=$_POST['engg'];

$qry.=" and engg_id ='".$engg."'";}

//echo $qry;

$qy=mysqli_query($con1,$qry);

//================= Date heading====
$rowdate="select distinct(cdate)  from start_end_day where cdate between '".$frmdt."' and '".$todt."' ORDER BY cdate ASC";
//echo $sday1;

$rdate=mysqli_query($con1,$rowdate);
 

while($row4=mysqli_fetch_array($rdate))
{?>
 <th width="5"> <?php echo date("d-m", strtotime($row4[0]) )."/ Start";?> </th> 
 <th width="5"> <?php echo date("d-m", strtotime($row4[0]) )."/ End";?> </th> 
<th width="5"> <?php echo "Work Hrs";?> </th>

 <?php }?>

 </tr>
  <?php 

while ($engg=mysqli_fetch_row($qy))

//=====================First Call / Last call Time===========
{
$qryengg="SELECT loginid FROM `area_engg` where engg_id='".$engg[0]."'";
$enggrow=mysqli_query($con1,$qryengg);
$engname=mysqli_fetch_row($enggrow);
//===Branch====
$branchqry=mysqli_query($con1,"select name from avo_branch where id='".$engg[5]."'");
$brname=mysqli_fetch_row($branchqry);

$loginid=mysqli_query($con1,"select username from login where srno='".$engname[0]."'");
$uid=mysqli_fetch_row($loginid);
?>

<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="center"><?php echo $engg[1]; ?></td>
<td  valign="center"><?php echo $engg[4]; ?></td>
<td  valign="center"><?php echo $brname[0]; ?></td>

<?
$sday1="select distinct(cdate) from start_end_day where cdate between '".$frmdt."' and '".$todt."' ORDER BY cdate ASC";


$rday2=mysqli_query($con1,$sday1);
while($row2=mysqli_fetch_array($rday2)){

$dt= "select tstamp from start_end_day where username= '".$uid[0]."' and etype='S' and cdate ='".$row2[0]."' ";

$dt2= "select tstamp from start_end_day where username= '".$uid[0]."' and etype='E' and cdate ='".$row2[0]."'";

//echo $dt."<br>";
//echo $dt2."<br>";

$qry1 =mysqli_query($con1,$dt);
$fetchdt=mysqli_fetch_row($qry1) ;

$qry2 =mysqli_query($con1,$dt2);
$fetchdt2=mysqli_fetch_row($qry2) ;


if ($fetchdt[0]=='') { $time=''; }
else {$time = date("H:i",strtotime($fetchdt[0]));}

if ($fetchdt2[0]=='') { $ltime=''; }
else {$ltime = date("H:i",strtotime($fetchdt2[0]));}

if($fetchdt[0] !='' && $fetchdt2[0]!='') {
$diff = abs(strtotime($ltime) - strtotime($time));



$tmins = $diff/60;
$hours = floor($tmins/60);
$mins = $tmins%60;

//echo $diff;
$dif= $diff/60/60;} else {$hours=''; $mins=''; }

?>

<td  align="center"><?php echo $time; ?> </td>
<td  align="center"><?php echo $ltime; ?> </td>
<td  align="center"><font color=red> <?php echo $hours.":".$mins ; ?> </td>


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

?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>
<!-- <form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>-->
 
<div id="bg" class="popup_bg"> </div> 

