<?php
session_start();
//$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');

$cdate= date('Y-m-d H:i:s');
$tattype= $_POST['tattype'];

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

?>

<table style="width:60%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary1" >
<?php
	
 if($_POST['calltype']=='brsummary'){
 
 $sql.="Select id, name from avo_branch";


$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%25==0)
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

<th width="10%" rowspan="2">Branch Name</th> 
<th colspan="7" style="text-align:center"><?php if($tattype=='bill')echo " Pending Bill : SO Date -> ".$cdate ;
                                                elseif ($tattype=='dely')echo "Delivery Pending : SO Date -> ".$cdate;
                                                else echo "Install Pending (Site-Delivery) : SO Date -> ".$cdate;
 ?></th>

</tr>

<tr>
<th width="10%" style="text-align:center"> &lt; 2 Days</th>
<th width="10%" style="text-align:center"> &lt; 3 Days</th>
<th width="10%" style="text-align:center"> &lt; 5 Days</th>
<th width="10%" style="text-align:center"> &lt; 7 Days</th> 
<th width="10%" style="text-align:center"> &lt; 10 Days</th>
<th width="10%" style="text-align:center"> Abv 10 Days</th>
<th width="10%" style="text-align:center"> Total</th>


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

//echo $sql;
$qr22=$sql;
$sql.=" order by `name` LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table=mysqli_query($con1,$sql);

$date=date('Y-m-d');

$sn=1;
 $gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;$gt10=0;$gtot=0;
while($result= mysqli_fetch_row($table))
{		
 $day2=0;$day3=0;$day5=0; $day7=0; $day10=0; $gt10day=0; $tot=0;
//============= SO -Invoice =========================

if($_POST['tattype']=='bill') {

	$str="SELECT so_time from new_sales_order where branch_id = '".$result[0]."' and status=1 ";
}

if($_POST['tattype']=='dely') {

//	$str="SELECT a.so_time, a.so_trackid from new_sales_order a, so_order b where a.so_trackid=b.po_id and a.branch_id = '".$result[0]."' and (b.del_date ='0000-00-00' or b.del_date > '".$date."') and a.status=2 and b.status=1";
	
	$str="SELECT a.so_time from new_sales_order a, so_order b where a.so_trackid= b. po_id and a.branch_id = '".$result[0]."' and b.status=1";
}

if($_POST['tattype']=='inst') {
	$str="SELECT a.so_time from new_sales_order a, alert b, so_order c where a.so_trackid=c.po_id and c.alert_id=b.alert_id and a.branch_id ='".$result[0]."' and a.status=2 and c.status=2 and (b.call_status = 'Pending' or b.call_status='1') and b.status != 'Done'";
}


//echo $str;
$qry = mysqli_query($con1,$str);
	
		while($row=mysqli_fetch_row($qry)){
	  			$et=$row[0];
	  			$ct=$cdate;
	  			
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
				
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				
				if($ddiff<2.0)$day2++;
				else if($ddiff<3.0)$day3++;
				else if($ddiff<5.0)$day5++;
				else if($ddiff<7.0)$day7++;
				else if($ddiff<10.0)$day10++;
				else if($ddiff>10.0)$gt10day++;
			
			$tot=$day2+$day3+$day5+$day7+$day10+$gt10day;
				
	  			}
		?>
<tr>
<!--===SN===-->
<td  valign="top"> <? echo $result[1];  ?></td>


<td  valign="top"><?php $gt5+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt6+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt7+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt8+=$day7; echo $day7;  ?></td>
<td  valign="top"><?php $gt9+=$day10; echo $day10;  ?></td>
<td  valign="top"><?php $gt10+=$gt10day; echo $gt10day;  ?></td>

<td  valign="top"><?php $gtot+=$tot; echo $tot;  ?></td>
</tr>
<?php

	$sn++;
	}


?>

<tr><td >Grand Total </td> <td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td><td><?php echo $gt9;  ?></td><td><?php echo $gt10;  ?></td><td><?php echo $gtot;  ?></td></tr>
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

 } else {
 
 
 
 $sql.="Select cust_id, cust_name from customer";


$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%25==0)
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

<th width="15%" rowspan="2">Customer Name</th> 
<th colspan="7" style="text-align:center"><?php if($tattype=='bill')echo " Pending Bill : SO Date -> ".$cdate ;
                                                elseif ($tattype=='dely')echo "Delivery Pending : SO Date -> ".$cdate;
                                                else echo "Install Pending (Site-Delivery) : SO Date -> ".$cdate;
 ?></th>

</tr>

<tr>
<th width="10%" style="text-align:center"> &lt; 2 Days</th>
<th width="10%" style="text-align:center"> &lt; 3 Days</th>
<th width="10%" style="text-align:center"> &lt; 5 Days</th>
<th width="10%" style="text-align:center"> &lt; 7 Days</th> 
<th width="10%" style="text-align:center"> &lt; 10 Days</th>
<th width="10%" style="text-align:center"> Abv 10 Days</th>
<th width="10%" style="text-align:center"> Total</th>


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

//echo $sql;
$qr22=$sql;
$sql.=" order by `cust_id` LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table=mysqli_query($con1,$sql);


$sn=1;
 $gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;$gt10=0;$gtot=0;
while($result= mysqli_fetch_row($table))
{		
 $day2=0;$day3=0;$day5=0; $day7=0; $day10=0; $gt10day=0; $tot=0;
//============= SO -Invoice =========================

if($_POST['tattype']=='bill') {

	$str="SELECT so_time from new_sales_order where po_custid = '".$result[0]."' and status=1 ";
}

if($_POST['tattype']=='dely') {

	$str="SELECT a.so_time from new_sales_order a, so_order b where a.so_trackid=b.po_id and a.po_custid = '".$result[0]."' and (b.del_date ='0000-00-00' or b.del_date > '".$cdate."') and a.status=2 and b.status=1";
	
		$str="SELECT a.so_time from new_sales_order a, so_order b where a.so_trackid=b.po_id and a.po_custid = '".$result[0]."' and b.status=1";

}

if($_POST['tattype']=='inst') {
	$str="SELECT a.so_time from new_sales_order a, alert b, so_order c where a.so_trackid=c.po_id and c.alert_id=b.alert_id and a.po_custid ='".$result[0]."' and a.status=2 and c.status=2 and (b.call_status = 'Pending' or b.call_status='1') and b.status != 'Done'";
}


//echo $str;
$qry = mysqli_query($con1,$str);
	
		while($row=mysqli_fetch_row($qry)){
	  			$et=$row[0];
	  			$ct=$cdate;
	  			
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
				
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				
				if($ddiff<2.0)$day2++;
				else if($ddiff<3.0)$day3++;
				else if($ddiff<5.0)$day5++;
				else if($ddiff<7.0)$day7++;
				else if($ddiff<10.0)$day10++;
				else if($ddiff>10.0)$gt10day++;
			
			$tot=$day2+$day3+$day5+$day7+$day10+$gt10day;
				
	  			}
		?>
<tr>
<!--===SN===-->
<td  valign="top"> <? echo $result[1];  ?></td>


<td  valign="top"><?php $gt5+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt6+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt7+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt8+=$day7; echo $day7;  ?></td>
<td  valign="top"><?php $gt9+=$day10; echo $day10;  ?></td>
<td  valign="top"><?php $gt10+=$gt10day; echo $gt10day;  ?></td>

<td  valign="top"><?php $gtot+=$tot; echo $tot;  ?></td>
</tr>
<?php

	$sn++;
	}


?>

<tr><td >Grand Total </td> <td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td><td><?php echo $gt9;  ?></td><td><?php echo $gt10;  ?></td><td><?php echo $gtot;  ?></td></tr>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
 
 ?>
 
<div id="bg" class="popup_bg"> </div> 