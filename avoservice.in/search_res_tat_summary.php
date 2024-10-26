<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection



if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='') {

$frmdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			//echo Sfrmdt. " ".$todt;

} else

$frmdt = date('Y-m-d');
$todt = date('Y-m-d');



//echo $frmdt;
//echo $todt;

$strPage = $_REQUEST['Page'];


?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="5%">Branch</th>
<!--<th width="5%">No. of Tickets</th>
<th width="5%">No. of Visits</th>  -->
<th width="5%">12am-8am</th> 
<th width="5%">8am-9am</th> 
<th width="5%">9am-10am</th>
<th width="5%">10am-11am</th>
<th width="5%">11am-1pm</th>
<th width="5%">1pm-3pm</th>
<th width="5%">3pm-5pm</th>
<th width="5%">5pm-7pm</th>
<th width="5%">7pm-8pm</th>

<th width="5%">8pm-9pm</th>
<th width="5%">9pm-10pm</th>
<th width="5%">10pm-12pm</th>
<th width="5%">Total</th>
</tr>
<?php

$ii=1;
$qry="SELECT id, name FROM `avo_branch`";


$qy=mysqli_query($con1,$qry);

while ($engg=mysqli_fetch_row($qy))


{



$dt= "select  b.responsetime from alert a, alert_progress b where a.alert_id=b.alert_id and a.branch_id='".$engg[0]."' and b.responsetime between '".$frmdt." 00:00:00' and '".$todt." 23:59:59' " ;


//$alert= "select count(b.alert_id)  as `count`,  count(a.alert_id) as `visit` from alert_progress a, alert b  where a.alert_id=b.alert_id and branch_id= '".$engg[0]."' and b.responsetime between '".$frmdt." 00:00:00' and '".$todt." 23:59:59'" ;    




//echo $dt."<br>";
//echo $alert."<br>";

//$alert_id= mysqli_query($con1,$alert);
//$row = mysqli_fetch_assoc($alert_id);
$callcnt = $row['count'];
$visitcnt = $row['visit'];

$qry1 =mysqli_query($con1,$dt);

$tcnt=0;

 $cnt1=0;$cnt2=0;$cnt3=0;$cnt4=0;$cnt5=0;$cnt6=0;$cnt7=0;$cnt8=0;$cnt9=0;$cnt10=0;$cnt11=0;$cnt12=0; 
      
//==================

while($fetchdt=mysqli_fetch_row($qry1))
{
//==============check in First Attend call time=============


$time = date("H:i:s",strtotime($fetchdt[0]));

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
<!-- <td  valign="center"><?php echo $callcnt; ?></td>
<td  valign="center"><?php echo $visitcnt; ?></td> -->
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


 ?>
</table>


 
<div id="bg" class="popup_bg"> </div> 

