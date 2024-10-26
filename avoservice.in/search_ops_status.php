<?php
session_start();

$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
			{
			$fromdt=$_POST['fromdt'];
			$todt=$_POST['todt'];
} else {   $fromdt= date('d/m/Y');
			$todt=date('d/m/Y'); 
}

?>

<table width="" border="1" cellpadding="0" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary" >
<tr>
<?php
//=============================================Branch wise summary========================= 
 if($_POST['calltype']=='brsummary') { ?>
 
<th width="20">SN</th> 
<th width="200">Branch</th>
<th width="100">SO raised</th>
<th width="100">Billed</th>
<th width="100">Dispatched</th>
<th width="100">Delivered</th>
<th width="100">Installed</th>

</tr>


<?php
 $sql.="Select id, name from avo_branch ";

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
$sql.=" order by name ASC LIMIT $Page_Start , $Per_Page";

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))
{		
//============= while loop for so_raise=========================
$str="SELECT count(*) FROM `new_sales_order` where branch_id = '".$row[0]."' and so_time between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by branch_id";
$soqry=mysqli_query($con1,$str);
$so=mysqli_fetch_row($soqry);

//==============Invoiced===============
$invqr="SELECT count(*) FROM `so_order` where inv_img_time between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY and po_id in(select so_trackid from new_sales_order where branch_id= '".$row[0]."')";
$invry=mysqli_query($con1,$invqr);
$inv=mysqli_fetch_row($invry);

//==============Dispatched===============
$disqr="SELECT count(*) FROM `so_order` where dis_date between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') and po_id in(select so_trackid from new_sales_order where branch_id= '".$row[0]."')";
$disry=mysqli_query($con1,$disqr);
$dis=mysqli_fetch_row($disry);

//==============Deliver===============
$delqr="SELECT count(*) FROM `so_order` where del_date between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') and po_id in(select so_trackid from new_sales_order where branch_id= '".$row[0]."')";
$delry=mysqli_query($con1,$delqr);
$del=mysqli_fetch_row($delry);

//==============Inst===============
$insqr="SELECT count(*) FROM `alert` where branch_id = '".$row[0]."' and close_date between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY and alert_type='new' group by branch_id ";
$insry=mysqli_query($con1,$insqr);
$ins=mysqli_fetch_row($insry);


		?>
<tr>
<!--===SN===-->
<td  valign="top" width=""><?php echo $sn; ?></td>

<!--===State===-->   
<td  valign="top"> <?php echo $row[1]; ?> </td>

<!--===so===-->   
<td  valign="top"><?php $tot1+=$so[0]; echo $so[0];   ?></td>

<!--===inv===-->
<td  valign="top"><?php $tot2+=$inv[0]; echo $inv[0] ?></td>
<!--===dis===-->
<td  valign="top"><?php $tot3+=$dis[0]; echo $dis[0] ?></td>
<!--===delivery===-->
<td  valign="top"><?php $tot4+=$del[0]; echo $del[0] ?></td>

<!--===inst===-->
<td  valign="top"><?php $tot5+=$ins[0]; echo $ins[0] ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td colspan="2">Grand Total</td> <td><?php echo $tot1; ?></td> <td><?php echo $tot2; ?></td> <td><?php echo $tot3;?></td> <td><?php echo $tot4;?></td> <td><?php echo $tot5;?></td> </tr>
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
//================>>>>>>CUSTOMER WISE=========================================
 }else { ?>
 
 
	 	<th width="20">SN</th> 
<th width="200">Customer</th>
<th width="100">SO raised</th>
<th width="100">Billed</th>
<th width="100">Dispatched</th>
<th width="100">Delivered</th>
<th width="100">Installed</th>

</tr>


<?php
	

$sql.="Select cust_id, cust_name from customer ";



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
$sql.=" order by `cust_id` LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;

while($row= mysqli_fetch_row($table))
{		

//============= while loop for so_raise=========================
$str="SELECT count(*) FROM `new_sales_order` where po_custid = '".$row[0]."' and so_time between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY group by po_custid";

$soqry=mysqli_query($con1,$str);
$so=mysqli_fetch_row($soqry);

//echo $str;

//==============Invoiced===============
$invqr="SELECT count(*) FROM `so_order` where inv_img_time between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY and po_id in(select so_trackid from new_sales_order where po_custid= '".$row[0]."')";
$invry=mysqli_query($con1,$invqr);
$inv=mysqli_fetch_row($invry);
//echo $invqr;

//==============Dispatched===============
$disqr="SELECT count(*) FROM `so_order` where dis_date between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') and po_id in(select so_trackid from new_sales_order where po_custid= '".$row[0]."')";
$disry=mysqli_query($con1,$disqr);
$dis=mysqli_fetch_row($disry);

//==============Deliver===============
$delqr="SELECT count(*) FROM `so_order` where del_date between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') and po_id in(select so_trackid from new_sales_order where po_custid= '".$row[0]."')";
$delry=mysqli_query($con1,$delqr);
$del=mysqli_fetch_row($delry);

//==============Inst===============
$insqr="SELECT count(*) FROM `alert` where cust_id = '".$row[0]."' and close_date between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY and alert_type='new' group by cust_id ";
$insry=mysqli_query($con1,$insqr);
$ins=mysqli_fetch_row($insry);


		?>
<tr>
<!--===SN===-->
<td  valign="top" width=""><?php echo $sn; ?></td>

<!--===Cust===-->   
<td  valign="top"> <?php echo $row[1]; ?> </td>

<!--===so===-->   
<td  valign="top"><?php $tot1+=$so[0]; echo $so[0];   ?></td>

<!--===inv===-->
<td  valign="top"><?php $tot2+=$inv[0]; echo $inv[0] ?></td>
<!--===dis===-->
<td  valign="top"><?php $tot3+=$dis[0]; echo $dis[0] ?></td>
<!--===delivery===-->
<td  valign="top"><?php $tot4+=$del[0]; echo $del[0] ?></td>

<!--===inst===-->
<td  valign="top"><?php $tot5+=$ins[0]; echo $ins[0] ?></td>

</tr>
<?php
	$sn++;
}
?>

<tr><td colspan="2">Grand Total</td> <td><?php echo $tot1; ?></td> <td><?php echo $tot2; ?></td> <td><?php echo $tot3;?></td> <td><?php echo $tot4;?></td> <td><?php echo $tot5;?></td> </tr>
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