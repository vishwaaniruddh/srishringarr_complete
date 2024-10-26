<?php
session_start();
//$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');


$tattype= $_POST['tattype'];

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
			{	
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
			} else {
			    $fromdt=date('d/m/Y');
				$todt= date('d/m/Y');
			}

?>

<table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary1" >
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

<th width="10%" rowspan="2">Branch Name</th> 
<th colspan="6" style="text-align:center"><?php if($tattype=='bill')echo "SO -> Bill TAT";
                                                elseif ($tattype=='dely')echo "SO -> Delivery TAT";
                                                else echo "SO -> Install";
 ?></th>

</tr>

<tr>
<th width="10%" style="text-align:center"> &lt; 2 Days</th>
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


$sn=1;
 $gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;$gtot=0;
while($result= mysqli_fetch_row($table))
{		
 $day1=0;$day2=0;$day3=0;$day5=0;$gt5day=0; $tot=0;
//============= SO -Invoice =========================

if($_POST['tattype']=='bill') {

	$str="SELECT c.so_date, b.inv_img_time from new_sales_order a, so_order b, demo_atm c where a.so_trackid=b.po_id and b.po_id=c.so_id and a.status = '2' and a.branch_id = '".$result[0]."' and b.inv_img_time between STR_TO_DATE('$fromdt','%d/%m/%Y') and STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
}

if($_POST['tattype']=='dely') {

	$str="SELECT date(c.so_date), b.del_date from new_sales_order a, so_order b, demo_atm c where a.so_trackid=b.po_id and b.po_id=c.so_id and a.branch_id = '".$result[0]."' and b.del_date between STR_TO_DATE('$fromdt','%d/%m/%Y') and STR_TO_DATE('$todt','%d/%m/%Y')";
}

if($_POST['tattype']=='inst') {

//$str="SELECT a.so_date, b.close_date from demo_atm a, alert b,  c where a.so_id=c.po_id and c.alert_id=b.alert_id and b.branch_id = '".$result[0]."' and b.close_date between STR_TO_DATE('$fromdt','%d/%m/%Y') and STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

	$str="SELECT a.so_date, b.close_date from demo_atm a, alert b, so_order c where a.so_id=c.po_id and c.alert_id=b.alert_id and b.branch_id = '".$result[0]."' and b.close_date between STR_TO_DATE('$fromdt','%d/%m/%Y') and STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
}


//echo $str;
$qry = mysqli_query($con1,$str);
	
		while($row=mysqli_fetch_row($qry)){
	  			$et=$row[0];
	  			$ct=$row[1];
	  			
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
				
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				
				if($ddiff<2.0)$day1++;
				else if($ddiff<5.0)$day2++;
				else if($ddiff<7.0)$day3++;
				else if($ddiff<10.0)$day5++;
				else if($ddiff>10.0)$gt5day++;
			
			$tot=$day1+$day2+$day3+$day5+$gt5day;
				
	  			}
		?>
<tr>
<!--===SN===-->
<td  valign="top"> <? echo $result[1];  ?></td>


<td  valign="top"><?php $gt5+=$day1; echo $day1;  ?></td>
<td  valign="top"><?php $gt6+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt7+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt8+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt9+=$gt5day; echo $gt5day;  ?></td>

<td  valign="top"><?php $gtot+=$tot; echo $tot;  ?></td>
</tr>
<?php

	$sn++;
	}


?>

<tr><td >Grand Total </td> <td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td><td><?php echo $gt9;  ?></td><td><?php echo $gtot;  ?></td></tr>
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

<th width="10%" rowspan="2">Branch Name</th> 
<th colspan="6" style="text-align:center"><?php if($tattype=='bill')echo "SO -> Bill TAT";
                                                elseif ($tattype=='dely')echo "SO -> Delivery TAT";
                                                else echo "SO -> Install";
 ?></th>

</tr>

<tr>
<th width="10%" style="text-align:center"> &lt; 2 Days</th>
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
 $gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;$gtot=0;
while($result= mysqli_fetch_row($table))
{		
 $day1=0;$day2=0;$day3=0;$day5=0;$gt5day=0; $tot=0;
//============= SO -Invoice =========================

if($_POST['tattype']=='bill') {

	$str="SELECT c.so_date, b.inv_img_time from new_sales_order a, so_order b, demo_atm c where a.so_trackid=b.po_id and b.po_id=c.so_id and a.status = '2' and a.po_custid = '".$result[0]."' and b.inv_img_time between STR_TO_DATE('$fromdt','%d/%m/%Y') and STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
}

if($_POST['tattype']=='dely') {

	$str="SELECT date(c.so_date), b.del_date from new_sales_order a, so_order b, demo_atm c where a.so_trackid=b.po_id and b.po_id=c.so_id and a.po_custid = '".$result[0]."' and b.del_date between STR_TO_DATE('$fromdt','%d/%m/%Y') and STR_TO_DATE('$todt','%d/%m/%Y')";
}

if($_POST['tattype']=='inst') {

//$str="SELECT a.so_date, b.close_date from demo_atm a, alert b,  c where a.so_id=c.po_id and c.alert_id=b.alert_id and b.branch_id = '".$result[0]."' and b.close_date between STR_TO_DATE('$fromdt','%d/%m/%Y') and STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

	$str="SELECT a.so_date, b.close_date from demo_atm a, alert b, so_order c where a.so_id=c.po_id and c.alert_id=b.alert_id and b.cust_id = '".$result[0]."' and b.close_date between STR_TO_DATE('$fromdt','%d/%m/%Y') and STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
}


//echo $str;
$qry = mysqli_query($con1,$str);
	
		while($row=mysqli_fetch_row($qry)){
	  			$et=$row[0];
	  			$ct=$row[1];
	  			
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
				
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				
				if($ddiff<2.0)$day1++;
				else if($ddiff<5.0)$day2++;
				else if($ddiff<7.0)$day3++;
				else if($ddiff<10.0)$day5++;
				else if($ddiff>10.0)$gt5day++;
			
			$tot=$day1+$day2+$day3+$day5+$gt5day;
				
	  			}
		?>
<tr>
<!--===SN===-->
<td  valign="top"> <? echo $result[1];  ?></td>


<td  valign="top"><?php $gt5+=$day1; echo $day1;  ?></td>
<td  valign="top"><?php $gt6+=$day2; echo $day2;  ?></td>
<td  valign="top"><?php $gt7+=$day3; echo $day3;  ?></td>
<td  valign="top"><?php $gt8+=$day5; echo $day5;  ?></td>
<td  valign="top"><?php $gt9+=$gt5day; echo $gt5day;  ?></td>

<td  valign="top"><?php $gtot+=$tot; echo $tot;  ?></td>
</tr>
<?php

	$sn++;
	}


?>

<tr><td >Grand Total </td> <td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td><td><?php echo $gt9;  ?></td><td><?php echo $gtot;  ?></td></tr>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

}
 
 ?>
 
<div id="bg" class="popup_bg"> </div> 