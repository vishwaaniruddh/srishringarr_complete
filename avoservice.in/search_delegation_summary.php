<?php
session_start();
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary" >


<tr>

<th rowspan="2" width="10%">Branch Name</th> 
<th colspan="9" style="text-align:center">Delegation Ageing</th>

</tr>

<tr>
<th width="10%" style="text-align:center"> < Auto</th>
<th width="10%" style="text-align:center"> < 10 Min</th>
<th width="10%" style="text-align:center"> < 30 Min</th> 
<th width="10%" style="text-align:center"> < 1 Hrs</th>
<th width="10%" style="text-align:center"> < 2 Hrs</th>
<th width="10%" style="text-align:center"> < 3 Hrs</th>
<th width="10%" style="text-align:center"> < 4 Hrs</th>
<th width="10%" style="text-align:center"> < 6 Hrs</th>
<th width="10%" style="text-align:center"> Above 6 Hrs</th>

</tr>
<?php
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
//============= while loop for Call logged & Delegated call =========================
				$str="SELECT  a.entry_date,b.date FROM `alert` a,alert_delegation b where a.alert_id=b.alert_id and branch_id='".$row[0]."' and  alert_type in ('service', 'new temp')";
				if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
				$str.=" and a.entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by a.alert_id";
				
				//	echo "<br>".$str;
			
				$opencall=mysqli_query($con1,$str);
		
	  			while($opencalldata=mysqli_fetch_row($opencall)){
	  		
	  			$et=$opencalldata[0];
	  			$ct=$opencalldata[1];
	  			$to_time = strtotime($ct);
				$from_time = strtotime($et);
				$diff=round(abs($to_time - $from_time) / 3600,2);
				$ddiff=round(abs($to_time - $from_time) / (3600*24),2);
				if($diff<0.02)$hrs2++;
				else if($diff<0.10)$hrs4++;
				else if($diff<0.30)$hrs8++;
				else if($diff<1.0)$hrs12++;
				else if($ddiff<2.0)$day1++;
				else if($ddiff<3.0)$day2++;
				else if($ddiff<4.0)$day3++;
				else if($ddiff<6.0)$day5++;
				else $gt5day++;
	  			}
		?>
<tr>
<!--===SN===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
 ?></td>

<!--===State===-->   
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
}
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
//==============================customer wise========================================================
 
 
?>
 <!--
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 -->
<div id="bg" class="popup_bg"> </div> 