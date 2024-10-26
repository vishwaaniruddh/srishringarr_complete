<?php
session_start();  
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];
$time=date('d-m-Y H:i:s');

?>
<table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="callsummary" >

<tr><th colspan="9" style="text-align:center"> <?php echo $time; ?> </th> </tr>
<tr>
<th rowspan="1">Branch Name</th> 
<th colspan="1" style="text-align:center">Bills Pending</th>
<th colspan="1" style="text-align:center">Billed Today</th>
<th colspan="1" style="text-align:center">Dispatch Pending</th>
<th colspan="1" style="text-align:center">Dispatched Today</th>
<th colspan="1" style="text-align:center">Delivery Pending</th>
<th rowspan="1" style="text-align:center">Delivered Today</th>
<th rowspan="1" style="text-align:center">Inst Pending</th>
<th rowspan="1" style="text-align:center">Installed Today</th>
</tr>

<?php
	
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

$to=str_replace("/","-",$_POST['todt']); //echo $to;


$table=mysqli_query($con1,$sql);


	$sn=1;

$todt=$_POST['todt'];

$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$tot8=0;

while($row= mysqli_fetch_row($table)) { 
  
 /* 
  
    
   $pts=0;		
$openb="SELECT count(*) FROM `new_sales_order` where branch_id='".$row[0]."' and status=1 group by branch_id ";
$closebill= "SELECT count(*) FROM `new_sales_order` where branch_id='".$row[0]."' and status=2 and so_trackid in(select po_id from so_order where date(inv_img_time) =STR_TO_DATE('$todt','%d/%m/%Y')) group by branch_id ";

//=========Dispatch================ 
$opndis="SELECT count(*) FROM `so_order` where avo_branch='".$row[0]."' and status=1 and dis_date='0000-00-00' group by avo_branch ";
$closedis ="SELECT count(*) FROM `so_order` where avo_branch='".$row[0]."' and dis_date=STR_TO_DATE('$todt','%d/%m/%Y') group by avo_branch ";

//=========Delivery=======
$opndel="SELECT count(*) FROM `so_order` where avo_branch='".$row[0]."' and status=1 and del_date='0000-00-00' group by avo_branch ";
$closedel ="SELECT count(*) FROM `so_order` where avo_branch='".$row[0]."' and del_date=STR_TO_DATE('$todt','%d/%m/%Y') group by avo_branch ";

//=========For  Inst===============
 $opnins="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and alert_type='new' and call_status in ('0', 'Pending', '1' ,'2' ,'Delegated') and status in ('0', 'Pending','delegated', '1') ";
$strins="SELECT count(*) FROM `alert` where branch_id='".$row[0]."' and alert_type='new' and date(close_date)=STR_TO_DATE('$todt','%d/%m/%Y')";

 
								
				
		$opnbillqry=mysqli_query($con1,$openb);		
		$obrow=mysqli_fetch_row($opnbillqry)	;
		$obcnt=$obrow[0];
		
		$clsbillqry=mysqli_query($con1,$closebill);		
		$cbrow=mysqli_fetch_row($clsbillqry)	;
		$cbcnt=$cbrow[0];		
		
		$opndisqry=mysqli_query($con1,$opndis);		
		$odisrow=mysqli_fetch_row($opndisqry)	;
		$odiscnt=$odisrow[0];
		
		$clsdisqry=mysqli_query($con1,$closedis);		
		$cdisrow=mysqli_fetch_row($clsdisqry)	;
		$cdiscnt=$cdisrow[0];
		
		$opndelqry=mysqli_query($con1,$opndel);		
		$odelrow=mysqli_fetch_row($opndelqry)	;
		$odelcnt=$odelrow[0];
		
		$clsdelqry=mysqli_query($con1,$closedel);		
		$cdelrow=mysqli_fetch_row($clsdelqry)	;
		$cdelcnt=$cdelrow[0];
		
		$opninsqry=mysqli_query($con1,$opnins);		
		$oinsrow=mysqli_fetch_row($opninsqry)	;
		$oinscnt=$oinsrow[0];
		
		$clsinssqry=mysqli_query($con1,$strins);		
		$insrow=mysqli_fetch_row($clsinssqry)	;
		$inccnt=$insrow[0];
				
*/
?>
<tr>
<!--=== Branch name ===-->
<td  valign="top"><?php  echo $row[1];  ?></td>

<!--===Bill===-->   
<td  valign="top"> <?php $tot1+=$obcnt; echo $obcnt ;?> </td>
<td  valign="top"> <?php $tot2+=$cbcnt; echo $cbcnt ;  ?> </td>

<!--===disp===-->   
<td  valign="top"> <?php $tot3+=$odiscnt; echo $odiscnt;  ?> </td>
<td  valign="top"> <?php $tot4+=$cdiscnt; echo $cdiscnt; ?></td>

<!--===Delivery  ===-->
<td  valign="top"> <?php $tot5+=$odelcnt; echo $odelcnt;  ?> </td>
<td  valign="top"><?php $tot6+=$cdelcnt; echo $cdelcnt; ?></td>

<!--===Inst===-->
<td  valign="top"> <?php $tot7+=$oinscnt; echo $oinscnt;  ?> </td>
<td  valign="top"><?php  $tot8+=$inccnt; echo $inccnt;  ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td><font color="red" >Grand Total </font></td><td> <?php echo $tot1; ?></td> <td><?php echo $tot2; ?></td> <td><?php echo $tot3; ?></td> <td><?php echo $tot4; ?></td> <td><?php echo $tot5; ?></td> <td><?php echo $tot6; ?></td> <td><?php echo $tot7; ?></td> <td><?php echo $tot8; ?></td></tr>

</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}

?>

<div id="bg" class="popup_bg"> </div> 