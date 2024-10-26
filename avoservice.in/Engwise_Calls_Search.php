<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection


$branch=$_POST['branch_avo'];

$frmdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			//echo Sfrmdt. " ".$todt;

//echo $frmdt;
//echo $todt;
//$type= $_POST['type'];

$strPage = $_REQUEST['Page'];


?>
<table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="10%">Engineer Name</th>
<th width="10%">Designation</th>
<th width="5%">Employee Code</th>
<th width="10%">Branch</th>
<th width="8%">City</th>
<th width="5%">City Cat</th>
<th width="5%">Days in field</th>
<!--<th width="5%">No. of Tickets</th>-->
<th width="5%">No. of Visits</th>
<th width="5%">12AM - 8AM</th> 
<th width="5%">8AM - 9AM</th> 
<th width="5%">9AM - 10AM</th>
<th width="5%">10AM - 11AM</th>
<th width="5%">11AM - 1PM</th>
<th width="5%">1PM - 3PM</th>
<th width="5%">3PM - 5PM</th>
<th width="5%">5PM - 7PM</th>
<th width="5%">7PM - 8PM</th>

<th width="5%">8PM - 9PM</th>
<th width="5%">9PM - 10PM</th>
<th width="5%">10PM - 12AM</th>
<th width="5%">Total</th>
</tr>
<?php

$ii=1;

if($_SESSION['user'] =='masteradmin') {
 $qry="SELECT engg_id,engg_name, loginid, area, city, engg_desgn, emp_code FROM `area_engg` where status=1 and deleted=0";
    
if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')

$qry.=" and area ='".$branch."'";

} else 
$qry="SELECT engg_id,engg_name, loginid, area, city, engg_desgn FROM `area_engg` where status=1 and deleted=0 and area ='".$branch."'";





//echo $qry ;

$qy=mysqli_query($con1,$qry);

while ($engg=mysqli_fetch_row($qy))


{
if(isset($_POST['type']) && $_POST['type'] =='reach')

{

if(isset($_POST['fromdt']) && $_POST['fromdt']!='')
{

//$dt= "select  pro_id,responsetime, engg_id from alert_progress where engg_id= '".$engg[2]."' and responsetime between '".$frmdt." 00:00:00' and '".$todt." 23:59:59'" ;

$dt= "select  pro_id,MIN(responsetime) from alert_progress where engg_id= '".$engg[2]."' and responsetime between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' group by date(responsetime) " ;

//$dt= "select  count(distinct date(responsetime))  as `count`,MIN(responsetime), count(alert_id) as `visit` from alert_progress where engg_id= '".$engg[2]."' and responsetime between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' group by date(responsetime) " ;


//echo $dt."</br>";

//$alert= "select count(distinct alert_id)  as `count`,  count(alert_id) as `visit` from alert_progress where engg_id= '".$engg[2]."' and responsetime between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' " ; 

$alert= "select count(distinct date(responsetime))  as `count`,  count(alert_id) as `visit` from alert_progress where engg_id= '".$engg[2]."' and responsetime between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' " ;   


} 

else 

{ //$dt= "select pro_id, responsetime, engg_id from alert_progress where engg_id= '".$engg[2]."' and date(responsetime) = '".$date."' ";

//$alert= "select count(distinct alert_id) as `count`, count(alert_id) as `visit` from alert_progress where engg_id= '".$engg[2]."' and date(responsetime) = '".$date."' ";   
    
}


//echo $dt;
//echo $alert;

$alert_id= mysqli_query($con1,$alert);
$row = mysqli_fetch_assoc($alert_id);

$callcnt = $row['count'];
$visitcnt = $row['visit'];

$qry1 =mysqli_query($con1,$dt);

$tcnt=0;

 $cnt1=0;$cnt2=0;$cnt3=0;$cnt4=0;$cnt5=0;$cnt6=0;$cnt7=0;$cnt8=0;$cnt9=0;$cnt10=0;$cnt11=0;$cnt12=0; 
      
//==================

while($fetchdt=mysqli_fetch_row($qry1))
{
//==============check in First Attend call time=============


$time = date("H:i:s",strtotime($fetchdt[1]));

if($time >='00:00:01' and $time <='07:59:59')

//if(substr($fetchdt[1],11,8) >='00:00:01' and substr($fetchdt[1],11,8)<='07:59:59')
{
$cnt12++;
$tcnt++;
}
if($time >='08:00:00' and $time <='08:59:59')

//if(substr($fetchdt[1],11,8) >= "08:00:00" and substr($fetchdt[1],11,8) <= "08:59:59")
{
$cnt1++;
$tcnt++;
}

if($time >='09:00:00' and $time <='09:59:59')
//if(substr($fetchdt[1],11,8) >= "09:00:00" and substr($fetchdt[1],11,8) <= "09:59:59")
{
$cnt2++;
$tcnt++;
}

if($time >='10:00:00' and $time <='10:59:59')
//if(substr($fetchdt[1],11,8) >='10:00:00' and substr($fetchdt[1],11,8)<='10:59:59')
{
$cnt3++;
$tcnt++;
}
if($time >='11:00:00' and $time <='12:59:59')
//if(substr($fetchdt[1],11,8) >='11:00:00' and substr($fetchdt[1],11,8)<='12:59:59')
{
$cnt4++;
$tcnt++;

}

if($time >='13:00:00' and $time <='14:59:59')
//if(substr($fetchdt[1],11,8) >='13:00:00' and substr($fetchdt[1],11,8)<='14:59:59')
{
$cnt5++;
$tcnt++;
}

if($time >='15:00:00' and $time <='16:59:59')
//if(substr($fetchdt[1],11,8) >='15:00:00' and substr($fetchdt[1],11,8) <='17:59:59')
{
$cnt6++;
$tcnt++;
}

if($time >='17:00:00' and $time <='18:59:59')
//if(substr($fetchdt[1],11,8) >='17:00:00' and substr($fetchdt[1],11,8) <='18:59:59')
{
$cnt7++;
$tcnt++;
}
if($time >='19:00:00' and $time <='19:59:59')
//if(substr($fetchdt[1],11,8) >='19:00:00' and substr($fetchdt[1],11,19)<='19:59:59')
{
$cnt8++;
$tcnt++;
}
if($time >='20:00:00' and $time <='20:59:59')
//if(substr($fetchdt[1],11,8) >='20:00:00' and substr($fetchdt[1],11,8)<='20:59:59')
{
$cnt9++;
$tcnt++;
}
if($time >='21:00:00' and $time <='21:59:59')
//if(substr($fetchdt[1],11,8) >='21:00:00' and substr($fetchdt[1],11,8)<='21:59:59')
{
$cnt10++;
$tcnt++;
}
if($time >='22:00:00' and $time <='23:59:59')
//if(substr($fetchdt[1],12,8) >='22:00:00' and substr($fetchdt[1],12,8)<='23:59:59')
{
$cnt11++;
$tcnt++;
}
}  ?>

<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="top"><?php echo $engg[1]; ?></td>
<td  valign="top"><?php echo $engg[5]; ?></td>
<td  valign="top"><?php echo $engg[6]; ?></td>

<? $brch=mysqli_query($con1,"select name from avo_branch where id='".$engg[3]."' ");
$bravo=mysqli_fetch_row($brch); ?>
<td  valign="center"><?php echo $bravo[0]; ?></td>
<?php 
$cityqry=mysqli_query($con1,"select city, category from cities where city_id='".$engg[4]."' ");
$city=mysqli_fetch_row($cityqry);
?>
<td  valign="center"><?php echo $city[0]; ?></td>
<td  valign="center"><?php echo $city[1]; ?></td>

<!--<td  valign="center"><?php echo $fetchdt['count']; ?></td>
<td  valign="center"><?php echo $fetchdt['visit']; ?></td>-->

<td  valign="center"><?php echo $callcnt; ?></td>
<td  valign="center"><?php echo $visitcnt; ?></td>

<td  align="center"><?php echo $cnt12; ?></td>
<td  align="center"><?php echo $cnt1; ?></td>
<td align="center"><?php echo $cnt2; ?></td>
<td align="center"><?php echo $cnt3; ?></td>
<td  align="center"><?php echo $cnt4; ?></td>
  
<td  align="center"><?php echo $cnt5; ?></td>

<td  align="center"><?php echo $cnt6; ?></td>

<td align="center"><?php echo $cnt7 ;?></td>

<td align="center"><?php echo $cnt8 ;?></td>

<td align="center"><?php echo $cnt9 ;?></td>

<td align="center"><?php echo $cnt10 ;?></td>
 <td align="center"><?php echo $cnt11 ;?></td>
<td align="center"><?php echo $tcnt ;?></td>


</tr>
<?php $ii++;   } 

//-----------------Last left===========================

elseif(isset($_POST['type']) && $_POST['type'] =='left')
{

if(isset($_POST['fromdt']) && $_POST['fromdt']!='')
{

$dt= "select pro_id, max(eng_left_site),engg_id from alert_progress where engg_id= '".$engg[2]."' and eng_left_site between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' group by date(eng_left_site)" ;


$alert= "select count(distinct alert_id)  as `count` from alert_progress where engg_id= '".$engg[2]."' and responsetime between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' " ;    

} 

else 

{ $dt= "select pro_id, max(eng_left_site), engg_id from alert_progress where engg_id= '".$engg[2]."' and date(eng_left_site) = '".$date."' ";


$alert= "select count(distinct alert_id) as `count`from alert_progress where engg_id= '".$engg[2]."' and date(responsetime) = '".$date."' ";   
    
}


echo $dt."<br>";
//echo $alert;

$alert_id= mysqli_query($con1,$alert);
$row = mysqli_fetch_assoc($alert_id);
$callcnt = $row['count'];

$qry1 =mysqli_query($con1,$dt);

$tcnt=0;

 $cnt1=0;$cnt2=0;$cnt3=0;$cnt4=0;$cnt5=0;$cnt6=0;$cnt7=0;$cnt8=0;$cnt9=0;$cnt10=0;$cnt11=0;$cnt12=0; 
      
//==================

while($fetchdt=mysqli_fetch_row($qry1))
{
//==============check Last Left Site time=============


$time = date("H:i:s",strtotime($fetchdt[1]));

if($time >='00:00:01' and $time <='07:59:59')

{
$cnt12++;
$tcnt++;
}
if($time >='08:00:00' and $time <='08:59:59')

{
$cnt1++;
$tcnt++;
}

if($time >='09:00:00' and $time <='09:59:59')

{
$cnt2++;
$tcnt++;
}

if($time >='10:00:00' and $time <='10:59:59')

{
$cnt3++;
$tcnt++;
}
if($time >='11:00:00' and $time <='12:59:59')

{
$cnt4++;
$tcnt++;

}

if($time >='13:00:00' and $time <='14:59:59')

{
$cnt5++;
$tcnt++;
}

if($time >='15:00:00' and $time <='16:59:59')
{
$cnt6++;
$tcnt++;
}

if($time >='17:00:00' and $time <='18:59:59')
{
$cnt7++;
$tcnt++;
}
if($time >='19:00:00' and $time <='19:59:59')
{
$cnt8++;
$tcnt++;
}
if($time >='20:00:00' and $time <='20:59:59')
{
$cnt9++;
$tcnt++;
}
if($time >='21:00:00' and $time <='21:59:59')
{
$cnt10++;
$tcnt++;
}
if($time >='22:00:00' and $time <='23:59:59')
{
$cnt11++;
$tcnt++;
}

} ?>

<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="top"><?php echo $engg[1]; ?></td>
<td  valign="top"><?php echo $callcnt; ?></td>
<td  align="center"><?php echo $cnt12; ?></td>
<td  align="center"><?php echo $cnt1; ?></td>
<td align="center"><?php echo $cnt2; ?></td>
<td align="center"><?php echo $cnt3; ?></td>
<td  align="center"><?php echo $cnt4; ?></td>
  
<td  align="center"><?php echo $cnt5; ?></td>

<td  align="center"><?php echo $cnt6; ?></td>

<td align="center"><?php echo $cnt7 ;?></td>

<td align="center"><?php echo $cnt8 ;?></td>

<td align="center"><?php echo $cnt9 ;?></td>

<td align="center"><?php echo $cnt10 ;?></td>
 <td align="center"><?php echo $cnt11 ;?></td>
<td align="center"><?php echo $tcnt ;?></td>


</tr>
<?php $ii++;   





}

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

 
<div id="bg" class="popup_bg"> </div> 

