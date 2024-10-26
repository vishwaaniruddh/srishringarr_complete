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

<th width="3%" rowspan="1">S.N.</th> 
<th width="15%" rowspan="1">Engineer Name</th>
<th width="10%" rowspan="1">Employee code</th>
<th width="8%" rowspan="1">Branch</th>

<?php

$ii=1;
if($_SESSION['designation']==1)
$qry="SELECT engg_id,engg_name, loginid, emp_code,area FROM `area_engg` where status=1 and deleted=0";
else

$qry="SELECT engg_id,engg_name, loginid, emp_code,area FROM `area_engg` where area='".$branch."' and status=1 and deleted=0";

if(isset($_POST['engg']) && $_POST['engg']!='') {
$engg=$_POST['engg'];

$qry.=" and engg_id ='".$engg."'";}


$qy=mysqli_query($con1,$qry);

//================= Date heading====

$sday1="select distinct(date(pending_date))  from alert_progress where pending_date between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' ORDER BY date(pending_date) ASC";


//echo $sday1;

$rday1=mysqli_query($con1,$sday1);
 

while($row4=mysqli_fetch_array($rday1))
{?>
 <th width="5" >Calls</th> 
 <th width="5">First </th> 
 <th width="5">Last</th>
<th width="7"> <?php echo date("D d-m", strtotime($row4[0]) )." Work Hrs";?> </th>
 
 <?php }?>
</tr>

  <?php 

while ($engg=mysqli_fetch_row($qy))

//=====================First Call / Last call Time===========

{

$qryengg="SELECT engg_id,engg_name, loginid,area FROM `area_engg` where engg_id='".$engg[0]."'";

$enggrow=mysqli_query($con1,$qryengg);
$engname=mysqli_fetch_row($enggrow);

$brqry="SELECT name FROM `avo_branch` where id='".$engname[3]."'";
$brrow=mysqli_query($con1,$brqry);
$brname=mysqli_fetch_row($brrow);


$sday2="select distinct(date(pending_date))  from alert_progress where pending_date between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' ORDER BY date(pending_date) ASC";
?>

<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="top"><?php echo $engg[1]; ?></td>
<td  valign="top"><?php echo $engg[3]; ?></td>
<td  valign="top"><?php echo $brname[0]; ?></td>

<?

$rday2=mysqli_query($con1,$sday2);
    
while($row2=mysqli_fetch_array($rday2)){

$dt= "select min(responsetime) from alert_progress where engg_id= '".$engname[2]."' and responsetime between '".$row2[0]." 00:00:00' and '".$row2[0]." 23:59:59' group by date(responsetime), engg_id " ;

$dt2= "select max(eng_left_site) from alert_progress where engg_id= '".$engname[2]."' and eng_left_site between '".$row2[0]." 00:00:00' and '".$row2[0]." 23:59:59' group by date(eng_left_site)" ;

$alert= "select count(distinct alert_id)  as `count` from alert_progress where engg_id= '".$engname[2]."' and responsetime between '".$row2[0]." 00:00:00' and '".$row2[0]." 23:59:59' " ;

$alrt =mysqli_query($con1,$alert);
$alcnt=mysqli_fetch_assoc($alrt) ;
$calcnt = $alcnt['count'];

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



$diff = abs(strtotime($ltime) - strtotime($time));

$tmins = $diff/60;

$hours = floor($tmins/60);

$mins = $tmins%60;

//echo $diff;
$dif= $diff/60/60;

?>
<td  align="center"><?php echo $calcnt; ?> </td>
<td  align="center"><?php echo $time; ?> </td>
<td  align="center"><?php echo $ltime; ?> </td>
<td  align="center"><font color=red> <?php echo $hours.":".$mins ; ?> </td>


<? } ?>

</tr>
<?php $ii++;    


} ?>
</table>

