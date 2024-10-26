<?php
session_start();  
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];

	$ddl_branch=$_POST['ddl_branch'];
	$sdate1=$_POST['date'];
	
	$timestamp = strtotime(str_replace('/', '.', $sdate1));
    $sdate = date('Y-m-d', $timestamp); 

    $postdate=date("Y-m-d", strtotime('-1 days', $timestamp));
$postdm=date('d-m',strtotime($postdate));
$seldm = date('d-m',strtotime($sdate)); 
   

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="callsummary" >
<tr>

<th width="8%" rowspan="2" style="text-align:center">Engr Name</th> 
<th rowspan="2" style="text-align:center">Designation</th>
<th rowspan="2" style="text-align:center">Emp Code</th>
<th rowspan="2" style="text-align:center">City</th>
<th rowspan="2" style="text-align:center">Branch</th>
<th rowspan="2" style="text-align:center">Start Day</th>
<th rowspan="2" style="text-align:center">First Call Type</th>
<th rowspan="2" style="text-align:center">First Call Attended</th>

<th colspan="2" style="text-align:center">Summary on: <? echo $seldm; ?></th>
<th colspan="4" style="text-align:center">Service Calls</th>
<th colspan="4" style="text-align:center">Installation Calls</th>
<th colspan="4" style="text-align:center">PM Calls</th>
<th colspan="4" style="text-align:center">De-Re Calls</th>
</tr>
<tr>
<th width="5%" style="text-align:center">Total Pend as on: <? echo $seldm; ?></th>
<th width="5%" style="text-align:center">Total CLosed on: <? echo $seldm; ?></th>
<!--<th width="5%" style="text-align:center">Prev Pendg:  <? echo $postdm; ?></th>
<th width="5%" style="text-align:center">Logged on: <? echo $seldm; ?></th>
<th width="5%" style="text-align:center">Closed on: <? echo $seldm; ?></th>
<th width="5%" style="text-align:center">Pending as on: <? echo $seldm; ?></th>--> 

<th width="5%" style="text-align:center">Previous Pending</th>
<th width="5%" style="text-align:center">Logged On date</th>
<th width="5%" style="text-align:center">Completed</th>
<th width="5%" style="text-align:center">Pending on date</th> 

<th width="5%" style="text-align:center">Previous Pending</th>
<th width="5%" style="text-align:center">Logged On date</th>
<th width="5%" style="text-align:center">Completed</th>
<th width="5%" style="text-align:center">Pending on date</th> 

<th width="5%" style="text-align:center">Previous Pending</th>
<th width="5%" style="text-align:center">Logged On date</th>
<th width="5%" style="text-align:center">Completed</th>
<th width="5%" style="text-align:center">Pending on date</th> 

<th width="5%" style="text-align:center">Previous Pending</th>
<th width="5%" style="text-align:center">Logged On date</th>
<th width="5%" style="text-align:center">Completed</th>
<th width="5%" style="text-align:center">Pending on date</th> 

</tr>
<?php
$br=$_SESSION['branch'];

if($_SESSION['branch']=='all')
 $sql.="Select branch_id,engg_name,engg_id, engg_desgn, city,emp_code,loginid from area_engg where status=1 and `deleted` = 0 ";
else 
$sql.="Select branch_id,engg_name,engg_id, engg_desgn, city,emp_code,loginid from area_engg where status=1 and `deleted` = 0 and area in ('$br')";

if($ddl_branch!=""){
    if($ddl_branch=='south')
   $sql.=" and branch_id in(1,8,9,15,18) "; 
   elseif ($ddl_branch=='north')
   $sql.=" and branch_id in(5,13,14,16,19)"; 
   elseif ($ddl_branch=='east')
   $sql.=" and branch_id in(2,3,7,12,17,20)"; 
   elseif ($ddl_branch=='west')
   $sql.=" and branch_id in(4,6,10,11)"; 
   else
  $sql.=" and branch_id='".$ddl_branch."' ";
}


$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
<option value="<?php echo $Num_Rows; ?>" ><?php echo "All"; ?></option>
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
     
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
  </select>
  </div>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
//$Per_Page = $Num_Rows;
$Page = $strPage;
if(!$strPage)
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}

$qr22=$sql;
$sql.="  order by engg_name LIMIT $Page_Start , $Per_Page";

//echo $sql;
 
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;

$gstot=0;$glstot=0;$gcstot=0;$gpstot=0;
$gitot=0;$glitot=0;$gcitot=0;$gpitot=0;
$gptot=0;$glptot=0;$gcptot=0;$gpptot=0;
$gdtot=0;$gldtot=0;$gcdtot=0;$gpdtot=0;

$totcom=0; $totpen=0;


 while($row= mysqli_fetch_row($table))
{
//echo "select a.tstamp from start_end_day a, login b where a.username = b.username and b.srno ='".$row[6]."' and a.cdate ='".$sdate."' </br>";

$startqry = mysqli_query($con1,"select a.tstamp from start_end_day a, login b where a.username = b.username and b.srno ='".$row[6]."' and a.cdate ='".$sdate."' ");
if(mysqli_num_rows($startqry)>0) { $present = "Present";} else { $present = "No Info"; }

	$cnt=0;$cnt1=0;$cntsc=0;$cntins=0;$cntpm=0;$cntdere=0;	

//=========open calls for that day 
$strsc="SELECT a.alert_id,a.alert_type FROM  alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$row[2]."' and date(a.entry_date) <= '$postdate' and (date(a.close_date) >='$sdate' or date(a.close_date) ='0000-00-00 00:00:00') and branch_id <> '' and call_status != 'Rejected' and call_status != 'onhold'";

//echo $strsc."</br>";

$service=mysqli_query($con1,$strsc);
$cntsc=mysqli_num_rows($service);
$pts=0;$sercnt=0;$instcnt=0;$pmcnt=0;$derecnt=0;
while($prv_open=mysqli_fetch_array($service)){
    if($prv_open[1]=='service' || $prv_open[1]=='new temp') $sercnt++;
    elseif($prv_open[1]=='new') $instcnt++;
    elseif($prv_open[1]=='pm' || $prv_open[1]=='temp_pm') $pmcnt++;
    elseif($prv_open[1]=='dere' ||$prv_open[1]=='temp_dere') $derecnt++;
}

//echo $instcnt. "Inst COunt and ser count is:".$sercnt;

$loged="SELECT a.alert_id,a.alert_type FROM  alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$row[2]."' and date(a.entry_date) = '$sdate'";

$logqr=mysqli_query($con1,$loged);

$logsercnt=0;$loginscnt=0;$logpmcnt=0; $logderecnt=0;

while($log=mysqli_fetch_row($logqr)){
    if($log[1]=='service' ||$log[1]=='new temp') $logsercnt++;
    elseif($log[1]=='new') $loginscnt++;
    elseif($log[1]=='pm' ||$log[1]=='temp_pm') $logpmcnt++;
    elseif($log[1]=='dere' ||$log[1]=='temp_dere') $logderecnt++;
}


//$cntins=mysqli_num_rows($log);

$closed="SELECT a.alert_id,a.alert_type FROM  alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$row[2]."' and date(a.close_date) = '$sdate' and (a.status='Done' or a.call_status ='Done') order by a.close_date DESC";

$closqry=mysqli_query($con1,$closed);
$cmpsercnt=0;$cmpinscnt=0;$cmppmcnt=0;$cmpderecnt=0;
while($comp=mysqli_fetch_row($closqry)){
    
    if($comp[1]=='service' ||$comp[1]=='new temp') $cmpsercnt++;
    elseif($comp[1]=='new') $cmpinscnt++;
    elseif($comp[1]=='pm' ||$comp[1]=='temp_pm') $cmppmcnt++;
    elseif($comp[1]=='dere' ||$comp[1]=='temp_dere') $cmpderecnt++;
}

$attqry1="SELECT a.alert_id,a.alert_type,b.responsetime FROM  alert a, alert_progress b where a.alert_id=b.alert_id and b.engg_id='".$row[6]."' and date(b.responsetime) = '$sdate' order by b.pro_id ASC limit 1";

//echo $attqry1."</br>";
$first_time='';
$attqry=mysqli_query($con1,$attqry1);
if(mysqli_num_rows($attqry)>0) {
$att=mysqli_fetch_row($attqry);
$time1=$att[2];
$time = strtotime($time1);
$first_time = date('H:i', $time);
if($att[1]=='service' ||$att[1]=='new temp') { $first = "Service";}
elseif($att[1]=='new') { $first = "Inst";}
elseif($att[1]=='pm' ||$att[1]=='temp_pm') { $first = "PM";}
elseif($att[1]=='dere' ||$att[1]=='temp_dere') { $first = "Re-De";}
} else { $first = "No Call";}


                $sc+=$cntsc; $ic+=$cntins; $pc+=$cntpm;
		?>
<tr>
<!--=== Branch name ===-->
<?php $branch=mysqli_query($con1,"select name from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);

$cityqry=mysqli_query($con1,"select city from `cities` where city_id='".$row[4]."'");
$city=mysqli_fetch_row($cityqry);

$totcom=$cmpsercnt+$cmpinscnt+$cmppmcnt+$cmpderecnt;
$totpen=$sercnt+$logsercnt-$cmpsercnt+$instcnt+$loginscnt-$cmpinscnt+$pmcnt+$logpmcnt-$cmppmcnt+$derecnt+$logderecnt-$cmpderecnt;
?>
 
 
 <td><?php echo $row[1]; ?></td>
 <td><?php echo $row[3]; ?></td>
 <td><?php echo $row[5]; ?></td>
 
 <td><?php echo $city[0]; ?></td>
 
 <td><?php echo $branch1[0];?></td>
 <td><?php echo $present;?></td>
 
 <td><?php echo $first;?></td>
 <td><?php echo $first_time;?></td>

<!--===Open Olde Call===-->  
<!--<td  valign="center" style="text-align:center"><?php echo $cntsc;  ?> </td>-->
<td  valign="center" style="text-align:center"><?php $gtp+=$totpen; echo $totpen;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gtc+=$totcom; echo $totcom;  ?> </td>


<td  valign="center" style="text-align:center"><?php $gstot+=$sercnt; echo $sercnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $glstot+=$logsercnt; echo $logsercnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gcstot+=$cmpsercnt; echo $cmpsercnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gpstot+=$sercnt+$logsercnt-$cmpsercnt; echo $sercnt+$logsercnt-$cmpsercnt;  ?> </td>

<td  valign="center" style="text-align:center"><?php $gitot+=$instcnt; echo $instcnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $glitot+=$loginscnt; echo $loginscnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gcitot+=$cmpinscnt; echo $cmpinscnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gpitot+=$instcnt+$loginscnt-$cmpinscnt; echo $instcnt+$loginscnt-$cmpinscnt;  ?> </td>


<td  valign="center" style="text-align:center"><?php $gptot+=$pmcnt; echo $pmcnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $glptot+=$logpmcnt; echo $logpmcnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gcptot+=$cmppmcnt; echo $cmppmcnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gpptot+=$pmcnt+$logpmcnt-$cmppmcnt; echo $pmcnt+$logpmcnt-$cmppmcnt;  ?> </td>

<td  valign="center" style="text-align:center"><?php $gdtot+=$derecnt; echo $derecnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gldtot+=$logderecnt; echo $logderecnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gcdtot+=$cmpderecnt; echo $cmpderecnt;  ?> </td>
<td  valign="center" style="text-align:center"><?php $gpdtot+=$derecnt+$logderecnt-$cmpderecnt; echo $derecnt+$logderecnt-$cmpderecnt;  ?> </td>

</tr>
<?php
	$sn++;
	}
?>

<tr><font color="red" ><td >Grand Total </td><td></td><td></td><td></td><td></td> <td></td><td></td> <td></td> <td style="text-align:center"><?php echo $gtp; ?></td> <td style="text-align:center"><?php echo $gtc; ?></td>

<td style="text-align:center"><?php echo $gstot; ?></td> <td style="text-align:center"><?php echo $glstot; ?></td> <td style="text-align:center"><?php  echo $gcstot; ?></td><td style="text-align:center"><?php echo $gpstot; ?></td>
<td style="text-align:center"><?php echo $gitot; ?></td> <td style="text-align:center"><?php echo $glitot; ?></td> <td style="text-align:center"><?php  echo $gcitot; ?></td><td style="text-align:center"><?php echo $gpitot; ?></td>
<td style="text-align:center"><?php echo $gptot; ?></td> <td style="text-align:center"><?php echo $glptot; ?></td> <td style="text-align:center"><?php  echo $gcptot; ?></td><td style="text-align:center"><?php echo $gpptot; ?></td>
<td style="text-align:center"><?php echo $gdtot; ?></td> <td style="text-align:center"><?php echo $gldtot; ?></td> <td style="text-align:center"><?php  echo $gcdtot; ?></td><td style="text-align:center"><?php echo $gpdtot; ?></td>

</font></tr>

</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
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
<div id="bg" class="popup_bg"> </div> 