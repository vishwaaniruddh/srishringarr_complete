<?php
session_start();
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');

$type=$_POST['type'];
$strPage = $_REQUEST['Page'];

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
} else {  $fromdt=date('d/m/Y');
				$todt=date('d/m/Y');

}

?>
<table style="max-width: 900px; width: 100%;" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary1" >
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

<th width="15%" rowspan="2">Engineer Name</th> 
<th width="15%" rowspan="2">Employee code</th> 
<th width="15%" rowspan="2">Designation</th> 

<th width="10%" rowspan="2">Branch</th> 
<th width="10%" rowspan="2">City Name</th> 
<th width="5%" rowspan="2">City Cat</th> 
<th colspan="9" style="text-align:center"><?php if($type=='resp')echo "Response Time";
                                                else echo "Resolution Time";
 ?></th>

</tr>

<tr>
<th width="5%" style="text-align:center"> &lt; 2 Hrs</th>
<th width="5%" style="text-align:center"> &lt; 4 Hrs</th>
<th width="5%" style="text-align:center"> &lt; 8 Hrs</th> 
<th width="5%" style="text-align:center"> &lt; 12Hrs</th>
<th width="5%" style="text-align:center"> &lt; 1Day</th>
<th width="5%" style="text-align:center"> &lt; 2Days</th>
<th width="5%" style="text-align:center"> &lt; 3Days</th>
<th width="5%" style="text-align:center"> &lt; 5Days</th>
<th width="5%" style="text-align:center"> Above 5 Days</th>

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
$sql.=" order by `area` ASC LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);


if(mysqli_num_rows($table)>0) {
	$sn=1;
 $gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;
while($row= mysqli_fetch_row($table))
{		
 $hrs2=0;$hrs4=0;$hrs8=0;$hrs12=0;$day1=0;$day2=0;$day3=0;$day5=0;$gt5day=0;
//============= while loop for open call =========================

$str= "SELECT distinct(a.alert_id), a.entry_date, a.close_date, b.engineer  FROM alert a, alert_delegation b where a.alert_id=b.alert_id and b.engineer='".$row[0]."' and (a.status='Done' or a.call_status='Done') and b.status !=2 and a.alert_type in( 'service','new temp') and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY ";

//echo $str."<br>";

//	$str="SELECT entry_date,close_date FROM `alert` where alert_type in( 'service','new temp') and alert_id in (select alert_id from alert_delegation where engineer='".$row[0]."' and status !=2 ORDER BY id DESC)";
				//========================================From Date to Date============
				
//				$str.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
//				$str.=" and (call_status = 'Done' or status = 'Done')";
				$opencall=mysqli_query($con1,$str);
				
			//	echo "<br>".$str;
	  			while($opencalldata=mysqli_fetch_row($opencall)){
	  			$et=$opencalldata[1];
	  			$ct=$opencalldata[2];
	  			
	  			
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
				else if($ddiff>5.0)$gt5day++;
				else $hrs2++;
				          
	  			}
		?>
<tr>
<!--===Engineer ===-->

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
<td  valign="top"> <?php  echo $city[1]; ?></td> <!-- City Cat -->

  
<td  valign="top"> <?php $gt1+=$hrs2; echo $hrs2; ?></td>

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

<tr><td >Grand Total</td><td></td><td></td><td></td><td></td> <td></td><td><?php echo $gt1; ?></td> <td><?php echo $gt2; ?></td> <td><?php echo $gt3;  ?></td><td><?php echo $gt4;  ?></td><td><?php echo $gt5;  ?></td><td><?php echo $gt6;  ?></td><td><?php echo $gt7;  ?></td><td><?php echo $gt8;  ?></td><td><?php echo $gt9;  ?></td></tr>
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
 ?>
 
<div id="bg" class="popup_bg"> </div> 