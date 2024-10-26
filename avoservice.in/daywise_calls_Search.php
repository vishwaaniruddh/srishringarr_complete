<?php
session_start();

//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

//echo "Br".$_POST['branch_avo'];

include('config.php');
############# must create your db base connection



$startdate1="";

//$startdate1=date('Y-m-d');


if(isset($_POST['fromdt']) && $_POST['fromdt']!='')
{
$startdate1=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));

}
else
{
    
$startdate1 =date('Y-m-d');
echo $startdate1;
}

if(isset($_POST['fromdt']))// == " ")
{
$enddate=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
}else {
$enddate=date('Y-m-d');
}

$branch = $_POST['branch_avo'];

//echo "ddd".$startdate1;
//echo "hh".$startdate1."  ".$enddate;

$strPage = $_REQUEST['Page'];



?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="5%">Date</th> 
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

</tr>
<?php

//$qrydt="select a.alert_id,a.close_date,a.responsetime ,b.responsetime from alert a,alert_progress b where a.close_date >= '".$startdate1."' 00:00:00 and a.close_date <='".$enddate."' and a.responsetime >= '".$startdate1."' and  a.responsetime  <='".$enddate."' and b.responsetime >= '".$startdate1."' and  b.responsetime  <='".$enddate."' and a.alert_id=b.alert_id";




$ii=1;


/*while (strtotime($startdate1) <= strtotime($enddate)) {                
       $cnt1=0;$cnt2=0;$cnt3=0;$cnt4=0;$cnt5=0;$cnt6=0;$cnt7=0;$cnt8=0;$cnt9=0;$cnt10=0;$cnt11=0;$cnt12=0;       
$qrydt="select a.alert_id,a.close_date,a.responsetime,b.responsetime from alert a,alert_progress b where (SUBSTRING(a.close_date,1,10)='".$startdate1."' or SUBSTRING( a.responsetime,1,10) ='".$startdate1."' or SUBSTRING( b.responsetime, 1,10) = '".$startdate1."') and a.alert_id=b.alert_id";*/



while (strtotime($startdate1) <= strtotime($enddate))
{                
       $cnt1=0;$cnt2=0;$cnt3=0;$cnt4=0;$cnt5=0;$cnt6=0;$cnt7=0;$cnt8=0;$cnt9=0;$cnt10=0;$cnt11=0;$cnt12=0;       

$qrydt="select a.alert_id, b.responsetime, a.branch_id from alert a,alert_progress b where b.responsetime between '".$startdate1." 00:00:00' and '".$startdate1." 23:59:59' and a.alert_id=b.alert_id and a.branch_id= '".$branch."'";

//echo $qrydt."<br>";


$qry_dt=mysqli_query($con1,$qrydt);

while($fetchdt=mysqli_fetch_array($qry_dt))

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
}



?>

<tr>
<td  align="center"><?php echo $ii; ?></td>
<td  valign="top"><?php echo $startdate1; ?></td>
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



</tr>
<?php 
$startdate1= date("Y-m-d", strtotime("+1 day", strtotime($startdate1)));
$ii++; } ?>
</table>

<div id="bg" class="popup_bg"> </div> 

