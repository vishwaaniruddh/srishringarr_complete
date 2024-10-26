<?php
session_start();
include('config.php');

$timetype=$_POST['timetype'];
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];
	
	if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
 } else { $fromdt= date('d/m/Y');
 $todt= date('d/m/Y');
 }


?>
<table style="max-width: 900px; width: 90%;" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary1" >
<?php
 $sql.="Select * from area_engg where status=1 and deleted=0 ";
 
 if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='') {
			    $branch=$_POST['branch_avo'];
			    $sql.=" and area='".$branch."'";
			   // echo $branch;
			}

$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
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
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>


<tr>

<th width="10%" rowspan="2">Engineer Name</th>
<th width="10%" rowspan="2">Employee code</th>
<th width="10%" rowspan="2">Designation</th>
<th width="10%" rowspan="2">Branch </th> 
<th width="10%" rowspan="2">City Name</th> 
<th width="5%" rowspan="2">City Cat</th> 
<th colspan="2" style="text-align:center"> Service Calls</th>
<th colspan="2" style="text-align:center"> Inst Calls</th>
<th colspan="2" style="text-align:center"> De-Re Calls</th>
<th colspan="2" style="text-align:center"> PM Calls</th>

</tr>

<tr>
<th width="5%" style="text-align:center"> Calls</th>
<th width="5%" style="text-align:center"> Avg TAT in Hrs</th>
<th width="5%" style="text-align:center"> Calls</th>
<th width="5%" style="text-align:center"> Avg TAT in Hrs</th>
<th width="5%" style="text-align:center"> Calls</th>
<th width="5%" style="text-align:center"> Avg TAT in Hrs</th>
<th width="5%" style="text-align:center"> Calls</th>
<th width="5%" style="text-align:center"> Avg TAT in Hrs</th>

</tr>
 <?php
########### pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
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


$sql.=" order by area ASC LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table=mysqli_query($con1,$sql);


	$sn=1;
 $gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;
 
 
while($row= mysqli_fetch_row($table))
{		
 $hrs2=0;$hrs4=0;$hrs8=0;$hrs12=0;$day1=0;$day2=0;$day3=0;$day5=0;$gt5day=0;
//============= while loop for last delegte engr =========================

/*$alerts='';
				$engqry=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$row[0]."'");                          
				while($engrow= mysqli_fetch_row($engqry)){
				$alerts=$alerts.$engrow[0].',';
				}
				$alerts=substr($alerts,0,strlen($alerts)-1);  */				

$respqry="select count(alert_id), SUM(TIME_TO_SEC(TIMEDIFF(close_date, entry_date))/3600) total_hours from alert where alert_id in (select alert_id from alert_delegation where engineer='".$row[0]."' and status=0) and alert_type in('service','new temp')" ; 

//$respqry = "select count(a.alert_id), SUM(TIME_TO_SEC(TIMEDIFF(a.close_date, a.entry_date))/3600) total_hours from alert a, alert_delegation b where a.alert_id='".$del[0]."' and b.engineer='".$del[1]."' and b.engineer='".$row[0]."' group by b.engineer" ; 

//$respqry = "select count(a.alert_id), SUM(TIME_TO_SEC(TIMEDIFF(a.close_date, a.entry_date))/3600) total_hours from alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer ='".$row[0]."' and alert_type in('service','new temp')";
//$respqry= "select(sum(elapse)/60) as diff from( SELECT alert.entry_date, alert.close_date, TIMESTAMPDIFF(MINUTE,alert.entry_date,alert.close_date) as elapse from alert) where branch_id LIKE '".$row[0]."' and alert_type in('service','new temp')";

				$respqry.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
				$respqry.=" and (call_status = 'Done' or status = 'Done')";
				$service=mysqli_query($con1,$respqry);
				$ser=mysqli_fetch_row($service);
		
				$sercal=$ser[0];
				$sumser=$ser[1];
				$avgser= $sumser / $sercal;
				
$instqry= "select count(alert_id), SUM(TIME_TO_SEC(TIMEDIFF(close_date, entry_date))/3600) total_hours FROM alert  where alert_id in(select alert_id from alert_delegation where engineer ='".$row[0]."' and status=0) and alert_type in('new')";
				$instqry.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
				$instqry.=" and (call_status = 'Done' or status = 'Done') GROUP BY alert_type";
				$inst1=mysqli_query($con1,$instqry);
				$ins=mysqli_fetch_row($inst1);
					$avgins= $ins[1] / $ins[0];

//$dereqry="select count(a.alert_id), SUM(TIME_TO_SEC(TIMEDIFF(a.close_date, a.entry_date))/3600) total_hours from alert a INNER JOIN alert_delegation b ON a.alert_id=b.alert_id where b.engineer='".$row[0]."' and a.alert_type in('dere', 'temp_dere')";
					
$dereqry= "select count(alert_id), SUM(TIME_TO_SEC(TIMEDIFF(close_date, entry_date))/3600) total_hours FROM alert  where alert_id in(select alert_id from alert_delegation where engineer ='".$row[0]."' and status=0) and alert_type in('dere', 'temp_dere')";
				$dereqry.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
				$dereqry.=" and (call_status = 'Done' or status = 'Done')";
				$dere1=mysqli_query($con1,$dereqry);
				$dere=mysqli_fetch_row($dere1);
					$avgdere= $dere[1] / $dere[0];
//$pmqry="select count(a.alert_id), SUM(TIME_TO_SEC(TIMEDIFF(a.close_date, a.entry_date))/3600) total_hours from alert a INNER JOIN alert_delegation b ON a.alert_id=b.alert_id where b.engineer='".$row[0]."' and a.alert_type in('pm', 'temp_pm')";
$pmqry= "select count(alert_id), SUM(TIME_TO_SEC(TIMEDIFF(close_date, entry_date))/3600) total_hours FROM alert  where alert_id in(select alert_id from alert_delegation where engineer ='".$row[0]."' and status=0) and alert_type in('pm', 'temp_pm')";
				$pmqry.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
				$pmqry.=" and (call_status = 'Done' or status = 'Done') ";
				$pm1=mysqli_query($con1,$pmqry);
				$pm=mysqli_fetch_row($pm1);
					$avgpm= $pm[1] / $pm[0];
			
//echo $respqry."<br>";				
		?>
<tr>
<td  valign="top"> <?php  echo $row[1]; ?></td>
<td  valign="top"> <?php  echo $row[6]; ?></td>
<td  valign="top"> <?php  echo $row[11]; ?></td>

<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[2]."'");
$branch1=mysqli_fetch_row($branch);
echo trim($branch1[1]);
 ?></td>
<?php $cityqry=mysqli_query($con1,"select city, category from cities where city_id='".$row[3]."'") ;
$city= mysqli_fetch_row($cityqry);
?>

<td  valign="top"> <?php  echo $city[0]; ?></td>
<td  valign="top"> <?php  echo $city[1]; ?></td> <!-- City Cat --

<!--===Service===-->   
<td  valign="top"> <?php $cnt1+=$ser[0];echo $ser[0];  ?></td>
<td  valign="top"> <?php $gt1+=$ser[1];echo $avgser;  ?></td> <!--  Avg -->

<td  valign="top"> <?php $cnt2+=$ins[0];echo $ins[0];  ?></td>
<td  valign="top"> <?php $gt2+=$ins[1];echo $avgins;  ?></td>

<td  valign="top"> <?php $cnt3+=$dere[0];echo $dere[0];  ?></td>
<td  valign="top"> <?php $gt3+=$dere[1];echo $avgdere;  ?></td>

<td  valign="top"> <?php $cnt4+=$pm[0];echo $pm[0];  ?></td>
<td  valign="top"> <?php $gt4+=$pm[1];echo $avgpm;  ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total</td> <td></td> <td></td><td></td><td></td><td></td><td><?php echo $cnt1; ?></td> <td><?php $tot1=$gt1/$cnt1; echo $tot1; ?></td><td><?php echo $cnt2; ?></td> <td><?php $tot2=$gt2/$cnt2; echo $tot2; ?></td> <td><?php echo $cnt3; ?></td><td><?php $tot3=$gt3/$cnt3; echo $tot3;  ?></td> <td><?php echo $cnt4; ?></td> <td><?php $tot4=$gt4/$cnt4; echo $tot4;  ?></td></tr>
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
//==============================customer wise========================================================
 ?>
<div id="bg" class="popup_bg"> </div> 