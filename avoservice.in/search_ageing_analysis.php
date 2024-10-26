<?php
session_start();
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];


?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary" >
<?php 
 if($_POST['calltype']=='brsummary') { ?>
<tr>

<th rowspan="2" width="10%">Branch Name</th> 
<th colspan="10" style="text-align:center">Call Ageing</th>

</tr>

<tr>
<th width="8%" style="text-align:center"> < 2 Hrs</th>
<th width="8%" style="text-align:center"> < 4 Hrs</th>
<th width="8%" style="text-align:center"> < 8 Hrs</th> 
<th width="8%" style="text-align:center"> < 12Hrs</th>
<th width="8%" style="text-align:center"> < 1Day</th>
<th width="8%" style="text-align:center"> < 2Days</th>
<th width="8%" style="text-align:center"> < 3Days</th>
<th width="8%" style="text-align:center"> < 5Days</th>
<th width="8%" style="text-align:center"> Above 5 Days</th>
<th width="8%" style="text-align:center"> Total</th>

</tr>
<?php
	//$ctype=$_POST['calltype'];
	//$ctyp1=explode(',',$ctype);
	//$alert_type=$_POST['openall'];

 $sql.="Select distinct(branch_id) from alert where branch_id<>'' ";


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

//echo $sql;
$qr22=$sql;
$sql.=" group by `branch_id` LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
 $gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;
while($row= mysqli_fetch_row($table))
{		
 $hrs2=0;$hrs4=0;$hrs8=0;$hrs12=0;$day1=0;$day2=0;$day3=0;$day5=0;$gt5day=0;
//============= while loop for open call =========================
				//echo "<br>SELECT count(*),call_status FROM `alert` where state LIKE '".$row[0]."' and ( call_status = 'Pending' or call_status='1')  group by state";
$str="SELECT entry_date FROM `alert` where branch_id ='".$row[0]."' and cust_id !=96 and alert_type in('new temp', 'service') ";
			
				$str.=" and  (call_status = 'Pending' or call_status='1') and status != 'Done'";
				$opencall=mysqli_query($con1,$str);
				//echo "<br>".$str;
	  			while($opencalldata=mysqli_fetch_row($opencall)){
	  			$et=$opencalldata[0];
	  			$ct=date('Y-m-d H:i:s');
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
				$diff=round(abs($to_time - $from_time) / 3600,2);
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				if($diff<2.0)$hrs2++;
				else if($diff<4.0)$hrs4++;
				else if($diff<8.0)$hrs8++;
				else if($diff<12.0)$hrs12++;
				else if($ddiff<1.0)$day1++;
				else if($ddiff<2.0)$day2++;
				else if($ddiff<3.0)$day3++;
				else if($ddiff<5.0)$day5++;
				else $gt5day++;
	  			}
	$tot=$hrs2+$hrs4+$hrs8+$hrs12+$day1+$day2+$day3+$day5+$gt5day;
		?>
<tr>
<!--===SN===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
 ?></td>

<td  valign="top"> <?php $gt1+=$hrs2; echo $hrs2; ?></td>
<td  valign="top"><?php $gt2+=$hrs4; echo $hrs4;  ?></td>
<td  valign="top"><?php $gt3+=$hrs8; echo $hrs8; ?></td>
<td  valign="top"><?php $gt4+=$hrs12; echo $hrs12;  ?></td>
<td  valign="top"><?php $gt5+=$day1; echo $day1;  ?></td>
<td  valign="top"><?php $gt6+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt7+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt8+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt9+=$gt5day; echo $gt5day;  ?></td>

<td  valign="top"><?php $tot1+=$tot; echo $tot;  ?></td>
</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total <td><?php echo $gt1; ?></td> <td><?php echo $gt2; ?></td> <td><?php echo $gt3;  ?></td><td><?php echo $gt4;  ?></td><td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td><td><?php echo $gt9;  ?></td><td><?php echo $tot1;  ?></td></tr>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php 

}
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
//==============================customer wise========================================================
 }else{ ?>
 <tr>

<th rowspan="2">Customer Name</th> 
<th colspan="9" style="text-align:center">Call Ageing</th>

</tr>

<tr>
<th width="10%" style="text-align:center"> < 2 Hrs</th>
<th width="10%" style="text-align:center"> < 4 Hrs</th>
<th width="10%" style="text-align:center"> < 8 Hrs</th> 
<th width="10%" style="text-align:center"> < 12Hrs</th>
<th width="10%" style="text-align:center"> < 1Day</th>
<th width="10%" style="text-align:center"> < 2Days</th>
<th width="10%" style="text-align:center"> < 3Days</th>
<th width="10%" style="text-align:center"> < 5Days</th>
<th width="10%" style="text-align:center"> Above 5 Days</th>
</tr>
<?php
	//$ctype=$_POST['calltype'];
	//$ctyp1=explode(',',$ctype);
	//$alert_type=$_POST['openall'];

 $sql.="Select `cust_id`,count(*) from alert where cust_id<>'' group by `cust_id`";

//========================================for open and close call============
	
	//echo $ctyp1[0];
	//echo "<br>".$ctyp1[1];
		
		/*if($ctyp1[0]=='Done')
		{
		$sql.=" and call_status = 'Done'";
		}
		if($ctyp1[1]=='1')
		{
		$sql.=" and `call_status`= 1 or `call_status`='Pending' ";
		}*/
	
//========================================for sate============

/*if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_POST['state'];
$sql.=" and state LIKE '%".$state."%'";
}

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}*/

//echo $sql;
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
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

//echo $sql;
$qr22=$sql;
$sql.=" LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$sn=1;
$gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;
while($row= mysqli_fetch_row($table))
{		
 $hrs2=0;$hrs4=0;$hrs8=0;$hrs12=0;$day1=0;$day2=0;$day3=0;$day5=0;$gt5day=0;
 //============= while loop for open call =========================
				//echo "<br>SELECT count(*),call_status FROM `alert` where state LIKE '".$row[0]."' and ( call_status = 'Pending' or call_status='1')  group by state";
				$str="SELECT entry_date FROM `alert` where cust_id LIKE '".$row[0]."' ";
				/*if(isset($_POST['openall']))
				{
				if($_POST['openall']=='new')
				$str.=" and (alert_type = 'new' or `alert_type`='new temp')";
				elseif($_POST['openall']=='service')*/
				$str.=" and alert_type in('service','new temp')";
				/*elseif($_POST['openall']=='pm')
				$str.=" and alert_type = 'pm'";
				}
				
				//========================================From Date to Date============
				if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
				$str.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
				}*/
				
				$str.=" and  (call_status = 'Pending' or call_status='1') and status != 'Done'";
				$opencall=mysqli_query($con1,$str);
				//echo "<br>".$str;
	  			while($opencalldata=mysqli_fetch_row($opencall)){
	  			$et=$opencalldata[0];
	  			$ct=date('Y-m-d H:i:s');
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
				$diff=round(abs($to_time - $from_time) / 3600,2);
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				if($diff<2.0)$hrs2++;
				else if($diff<4.0)$hrs4++;
				else if($diff<8.0)$hrs8++;
				else if($diff<12.0)$hrs12++;
				else if($ddiff<1.0)$day1++;
				else if($ddiff<2.0)$day2++;
				else if($ddiff<3.0)$day3++;
				else if($ddiff<5.0)$day5++;
				else $gt5day++;
	  			}
		?>
<tr>
<!--===SN===-->
<td  valign="top" width=""><?php 
$customer=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$row[0]."'");
$customer1=mysqli_fetch_row($customer);
echo $customer1[0];
 ?></td>

<!--===customer name===-->   
<td  valign="top">
<?php 
$gt1+=$hrs2;
echo $hrs2;
 ?>
</td>

<!--===Open===-->   
<td  valign="top"><?php $gt2+=$hrs4; echo $hrs4;  ?></td>

<!--===Close===-->
<td  valign="top"><?php $gt3+=$hrs8; echo $hrs8; ?></td>

<!--===Total===-->
<td  valign="top"><?php $gt4+=$hrs12; echo $hrs12;  ?></td>
<td  valign="top"><?php $gt5+=$day1; echo $day1;  ?></td>
<td  valign="top"><?php $gt6+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt7+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt8+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt9+=$gt5day; echo $gt5day;  ?></td>
</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total <td><?php echo $gt1; ?></td> <td><?php echo $gt2; ?></td> <td><?php echo $gt3;  ?></td><td><?php echo $gt4;  ?></td><td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td><td><?php echo $gt9;  ?></td></tr>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
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
	 	 	 
	 }
 
?>
 <!--
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 -->
<div id="bg" class="popup_bg"> </div> 