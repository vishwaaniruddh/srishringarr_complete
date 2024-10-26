<?php
session_start();
//$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');

$strPage = $_REQUEST['Page'];


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
	$fromdt=date('Y-m-d 00:00:00',strtotime(str_replace('/','-',$_POST['fromdt'])));
    $todt=date('Y-m-d 23:59:59',strtotime(str_replace('/','-',$_POST['todt'])));

} else 
        $fromdt=date('Y-m-d 00:00:00');
       $todt=date('Y-m-d 23:59:59');
       
       
?>
<table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-left:15%; margin-right:15%;" class=""  id="call_summary1" >
<?php
 
 //===============Branchwise Summary==========
 
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

<th width="15%" style="text-align:center">Branch Name</th> 
<th width="10%" style="text-align:center">Add ON AMC</th>
<th width="10%" style="text-align:center">Goodwill Basis</th>
<th width="10%" style="text-align:center">Chargeable</th>
<th width="10%" style="text-align:center">Warr Dispute</th>
<th width="10%" style="text-align:center">Total</th>


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


$sql.=" order by `id` LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table=mysqli_query($con1,$sql);


$sn=1;
$gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;


while($row= mysqli_fetch_row($table))
{		
 

//============= SO Pending =========================

$str=mysqli_query($con1,"SELECT count(alert_id) as `tot` FROM `alert` where branch_id ='".$row[0]."'and custdoctno like 'addon' and  close_date Between '".$fromdt."'AND '".$todt."' group by branch_id ");

$pmqry=mysqli_query($con1,"SELECT count(alert_id) as `tot` FROM `alert` where branch_id ='".$row[0]."'and custdoctno like 'goodwill' and  close_date Between '".$fromdt."'AND '".$todt."' group by branch_id");

$dereqry=mysqli_query($con1,"SELECT count(alert_id) as `tot` FROM `alert` where branch_id ='".$row[0]."'and custdoctno like 'pcb' and  close_date Between '".$fromdt."'AND '".$todt."' group by branch_id");

$warrqry=mysqli_query($con1,"SELECT count(alert_id) as `tot` FROM `alert` where branch_id ='".$row[0]."'and custdoctno like 'warr' and  close_date Between '".$fromdt."'AND '".$todt."' group by branch_id");

//echo "SELECT count(alert_id) as `tot` FROM `alert` where branch_id ='".$row[0]."'and  close_date Between '".$fromdt."'AND '".$todt."'";

$all=mysqli_fetch_assoc($str);
$pm=mysqli_fetch_assoc($pmqry);
$dere=mysqli_fetch_assoc($dereqry);
$warr=mysqli_fetch_assoc($warrqry);

 
 $allc= $all['tot']+$pm['tot']+$dere['tot']+$warr['tot'];		
		?>
<tr>
<!--===SN===-->
<td  valign="top"><?php echo trim($row[1]); ?></td>


<td  valign="top"> <?php $gt1+=$all['tot'];  echo $all['tot'];  ?> </td>
<td  valign="top"> <?php $gt2+=$pm['tot'];  echo $pm['tot'];  ?> </td>
<td  valign="top"> <?php $gt3+=$dere['tot'];  echo $dere['tot'];  ?> </td>
<td  valign="top"> <?php $gt4+=$warr['tot'];  echo $warr['tot'];  ?> </td>
<td  valign="top"> <?php $total+=$allc;     echo $allc;  ?> </td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total</td> <td><?php echo $gt1; ?></td><td><?php echo $gt2; ?></td><td><?php echo $gt3; ?></td><td><?php echo $gt4; ?></td><td><?php echo $total; ?></td></tr>
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
} 
//=====================Client

else {
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

<th width="15%" style="text-align:center">Customer Name</th> 
<th width="10%" style="text-align:center">Add ON AMC</th>
<th width="10%" style="text-align:center">Goodwill Basis</th>
<th width="10%" style="text-align:center">Chargeable</th>
<th width="10%" style="text-align:center">Warr Dispute</th>
<th width="10%" style="text-align:center">Total</th>


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


$sql.=" order by `cust_id` LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table=mysqli_query($con1,$sql);


$sn=1;
$gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;


while($row= mysqli_fetch_row($table))
{		
 

//============= SO Pending =========================

$str=mysqli_query($con1,"SELECT count(alert_id) as `tot` FROM `alert` where cust_id ='".$row[0]."'and custdoctno like 'addon' and  close_date Between '".$fromdt."'AND '".$todt."'group by cust_id");

$pmqry=mysqli_query($con1,"SELECT count(alert_id) as `tot` FROM `alert` where cust_id ='".$row[0]."'and custdoctno like 'goodwill' and  close_date Between '".$fromdt."'AND '".$todt."' group by cust_id");

$dereqry=mysqli_query($con1,"SELECT count(alert_id) as `tot` FROM `alert` where cust_id ='".$row[0]."'and custdoctno like 'pcb' and  close_date Between '".$fromdt."'AND '".$todt."' group by cust_id");

$warrqry=mysqli_query($con1,"SELECT count(alert_id) as `tot` FROM `alert` where cust_id ='".$row[0]."'and custdoctno like 'warr' and  close_date Between '".$fromdt."'AND '".$todt."' group by cust_id");

//echo "SELECT count(alert_id) as `tot` FROM `alert` where branch_id ='".$row[0]."'and  close_date Between '".$fromdt."'AND '".$todt."'";

$all=mysqli_fetch_assoc($str);
$pm=mysqli_fetch_assoc($pmqry);
$dere=mysqli_fetch_assoc($dereqry);
$warr=mysqli_fetch_assoc($warrqry);

 
 $allc= $all['tot']+$pm['tot']+$dere['tot']+$warr['tot'];		
		?>
<tr>
<!--===SN===-->
<td  valign="top"><?php echo trim($row[1]); ?></td>


<td  valign="top"> <?php $gt1+=$all['tot'];  echo $all['tot'];  ?> </td>
<td  valign="top"> <?php $gt2+=$pm['tot'];  echo $pm['tot'];  ?> </td>
<td  valign="top"> <?php $gt3+=$dere['tot'];  echo $dere['tot'];  ?> </td>
<td  valign="top"> <?php $gt4+=$warr['tot'];  echo $warr['tot'];  ?> </td>
<td  valign="top"> <?php $total+=$allc;     echo $allc;  ?> </td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total</td> <td><?php echo $gt1; ?></td><td><?php echo $gt2; ?></td><td><?php echo $gt3; ?></td><td><?php echo $gt4; ?></td><td><?php echo $total; ?></td></tr>
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

}

?>