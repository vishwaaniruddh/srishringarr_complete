<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection


$branch=$_POST['branch_avo'];


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' )
{
$frmdt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['fromdt'])));
//$todt=date('Y-m-d',strtotime(str_replace('/','-',$_POST['todt'])));

}

else{
$frmdt=date('Y-m-d');
//$todt=date('Y-m-d');
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
<th width="5"> First</th> 
 <th width="5">Last </th> 
 <th width="5">Total Records</th> 
 <th width="5">Total KMs</th> 
 

<?php

$ii=1;
$qry="SELECT engg_id,engg_name, loginid,engg_desgn, area FROM `area_engg` where area='".$branch."' and status=1 and deleted=0";

if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
$qry.=" and area ='".$branch."'";

if(isset($_POST['engg']) && $_POST['engg']!='') {
$engg=$_POST['engg'];

$qry.=" and engg_id ='".$engg."'";}

$qy=mysqli_query($con1,$qry);

?>
 </tr>

<?php 
while ($engg=mysqli_fetch_row($qy))

//=====================First Call Attend Time===========
{
$qryengg="SELECT engg_id,engg_name, loginid,engg_desgn,area FROM `area_engg` where engg_id='".$engg[0]."'";

$enggrow=mysqli_query($con1,$qryengg);
$engname=mysqli_fetch_row($enggrow);

$qrybr=mysqli_query($con1,"SELECT name FROM `avo_branch` where id='".$engg[4]."'");

$brname=mysqli_fetch_row($qrybr);

?>

<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="top"><?php echo $engg[1]; ?></td>
<td  valign="top"><?php echo $engg[3]; ?></td>
<td  valign="top"><?php echo $brname[0]; ?></td>


<?

$dt= "select min(dt), max(dt) from Location where engg_id= '".$engname[0]."' and dt between '".$frmdt." 00:00:00' and '".$frmdt." 23:59:59' " ;

$dt2= "select count(dt) As count from Location where engg_id= '".$engname[0]."' and dt between '".$frmdt." 00:00:00' and '".$frmdt." 23:59:59' group by date(dt)" ;

$dis="select dis_travelled from engg_distances where eng_id='".$engname[0]."' and dis_date ='".$frmdt."'" ;
//echo $dis."<br>";

$qry1 =mysqli_query($con1,$dt);
$fetchdt=mysqli_fetch_row($qry1) ;

$qry2 =mysqli_query($con1,$dt2);
$rec_cnt=mysqli_fetch_assoc($qry2) ;
$cnt=$rec_cnt['count'];

$dist1=mysqli_query($con1,$dis);
$dist=mysqli_fetch_row($dist1) ;

if ($fetchdt[0]=='') { $time=''; }
else {$time = date("H:i",strtotime($fetchdt[0]));}

if ($fetchdt[1]=='') { $ltime=''; }
else {$ltime = date("H:i",strtotime($fetchdt[1]));}
?>

<td  align="center"><?php echo $time; ?> </td>
<td  align="center"><?php echo $ltime; ?> </td>
<td  align="center"><?php echo $cnt; ?> </td>

<!--<td  align="center"><a href="travellingmap.php?eid=<?php echo $eng; ?>&date=<?php echo $date; ?>" target="_new"> <?php echo $cnt ; ?> </td> -->

<td  align="center"><?php echo $dist[0]; ?> </td>

</tr>
<?php $ii++;    
} ?>
</table>
