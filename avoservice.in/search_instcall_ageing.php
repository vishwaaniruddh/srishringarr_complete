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
<th rowspan="2" width="10%" style="text-align:center"> Customer Dependency</th>
<th colspan="8" style="text-align:center">Call Ageing</th>

</tr>

<tr>

<th width="10%" style="text-align:center"> < 1 Day</th>
<th width="10%" style="text-align:center"> < 2 Days</th>
<th width="10%" style="text-align:center"> < 3 Days</th> 
<th width="10%" style="text-align:center"> < 5 Days</th>
<th width="10%" style="text-align:center"> < 7 Days</th>
<th width="10%" style="text-align:center"> < 10 Days</th>
<th width="10%" style="text-align:center"> Above 10 Days</th>
<th width="10%" style="text-align:center"> Total</th>

</tr>
<?php

 $sql.="Select id from avo_branch";


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
$sql.=" order by `id` LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1; 
 $gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0; $cnt1=0;
while($row= mysqli_fetch_row($table))
{		
$day1=0;$day2=0;$day3=0;$day5=0; $day7=0; $day10=0;$gt10day=0;$total=0; $hold=0;
//======On hold cases===========

$holdqry=mysqli_query($con1,"select count(branch_id) As `count` FROM `alert` where branch_id = '".$row[0]."' and alert_type='new' and call_status = 'onhold'  ");

//echo "<br>.select count(branch_id) As `count` FROM `alert` where branch_id = '".$row[0]."' and alert_type='new' and call_status = 'onhold'";

$holdrow=mysqli_fetch_assoc($holdqry);

$hold=$holdrow['count'];

//============= while loop for open call =========================
$str="SELECT entry_date FROM `alert` where branch_id LIKE '".$row[0]."' and alert_type='new'";
			
				
				$str.=" and  (call_status = 'Pending' or call_status='1') and status != 'Done'";
				$opencall=mysqli_query($con1,$str);
				//echo "<br>".$str;
	  			while($opencalldata=mysqli_fetch_row($opencall)){
	  			$et=$opencalldata[0];
	  			$ct=date('Y-m-d H:i:s');
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
			//	$diff=round(abs($to_time - $from_time) / 3600,2);
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				
				
				if ($ddiff<1.0)$day1++;
				else if($ddiff<2.0)$day2++;
				else if($ddiff<3.0)$day3++;
				else if($ddiff<5.0)$day5++;
				else if($ddiff<7.0)$day7++;
				else if($ddiff<10.0)$day10++;
				else $gt10day++;
				
				$total=$day1+$day2+$day3+$day5+$day7+$day10+$gt10day;
				
	  			}
		?>
<tr>
<!--===SN===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
 ?></td>

  
<td  valign="top"><?php $cnt1+=$hold; echo $hold;  ?></td>
<td  valign="top"><?php $gt1+=$day1; echo $day1;  ?></td>
<td  valign="top"><?php $gt2+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt3+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt4+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt5+=$day7; echo $day7;  ?></td>
<td  valign="top"><?php $gt6+=$day10; echo $day10;  ?></td>
<td  valign="top"><?php $gt7+=$gt10day; echo $gt10day;  ?></td>
<td  valign="top"><?php $gt8+=$total; echo $total;  ?></td>
</tr>
<?php

	$sn++;
	
   }
?>

<tr><td >Grand Total </td> <td><?php echo $cnt1; ?></td><td><?php echo $gt1; ?></td> <td><?php echo $gt2; ?></td> <td><?php echo $gt3;  ?></td><td><?php echo $gt4;  ?></td><td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td></tr>
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
//==============================customer wise========================================================
 }else{ ?>
 <tr>

<th rowspan="2">Customer Name</th> 
<th rowspan="2" width="10%" style="text-align:center"> Customer Dependency</th>
<th colspan="8" style="text-align:center">Call Ageing</th>

</tr>

<tr>

<th width="10%" style="text-align:center"> < 1 Day</th>
<th width="10%" style="text-align:center"> < 2 Days</th>
<th width="10%" style="text-align:center"> < 3 Days</th> 
<th width="10%" style="text-align:center"> < 5 Days</th>
<th width="10%" style="text-align:center"> < 7 Days</th>
<th width="10%" style="text-align:center"> < 10 Days</th>
<th width="10%" style="text-align:center"> Above 10 Days</th>
<th width="10%" style="text-align:center"> Total</th>

</tr>
<?php

 $sql.="Select `cust_id`,count(*) from alert where cust_id<>'' group by `cust_id`";

//========================================for open and close call============
	

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

if(mysqli_num_rows($table)>0) {
	$sn=1;

 $gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0; $cnt1=0;
while($row= mysqli_fetch_row($table))
{		
$day1=0;$day2=0;$day3=0;$day5=0; $day7=0; $day10=0;$gt10day=0;$total=0; $hold=0;
//======On hold cases===========

$holdqry=mysqli_query($con1,"select count(cust_id) As `count` FROM `alert` where cust_id ='".$row[0]."' and alert_type='new' and call_status = 'onhold'  and status !='Done' group by cust_id");

$holdrow=mysqli_fetch_assoc($holdqry);

$hold=$holdrow['count'];

 //============= while loop for open call =========================

$str="SELECT entry_date FROM `alert` where cust_id ='".$row[0]."' and alert_type='new'";
			
			
$str.=" and  (call_status = 'Pending' or call_status='1') and status != 'Done'";
				$opencall=mysqli_query($con1,$str);

			
	  			while($opencalldata=mysqli_fetch_row($opencall)){
	  			$et=$opencalldata[0];
	  			$ct=date('Y-m-d H:i:s');
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
			//	$diff=round(abs($to_time - $from_time) / 3600,2);
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				
				
				if ($ddiff<1.0)$day1++;
				else if($ddiff<2.0)$day2++;
				else if($ddiff<3.0)$day3++;
				else if($ddiff<5.0)$day5++;
				else if($ddiff<7.0)$day7++;
				else if($ddiff<10.0)$day10++;
				else $gt10day++;
				
				$total=$day1+$day2+$day3+$day5+$day7+$day10+$gt10day;
				
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
<td  valign="top"><?php $cnt1+=$hold; echo $hold;  ?></td>
<td  valign="top"><?php $gt1+=$day1; echo $day1;  ?></td>
<td  valign="top"><?php $gt2+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt3+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt4+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt5+=$day7; echo $day7;  ?></td>
<td  valign="top"><?php $gt6+=$day10; echo $day10;  ?></td>
<td  valign="top"><?php $gt7+=$gt10day; echo $gt10day;  ?></td>
<td  valign="top"><?php $gt8+=$total; echo $total;  ?></td>
</tr>
<?php

	$sn++;
	
   
}
?>

<tr><td >Grand Total </td> <td><?php echo $cnt1; ?></td><td><?php echo $gt1; ?></td> <td><?php echo $gt2; ?></td> <td><?php echo $gt3;  ?></td><td><?php echo $gt4;  ?></td><td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td></tr>
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
	 	 	 
	 }
 
?>

<div id="bg" class="popup_bg"> </div> 