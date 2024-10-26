<?php
session_start();
//$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

?>

<table width="" border="1" cellpadding="0" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary" >
<tr>
<?php
//=============================================Branch wise summary========================= 
 if($_POST['calltype']=='brsummary') { ?>
 
<th width="20">SN</th> 
<th width="200">Branch</th>
<th width="100">Pending Approval</th>
<th width="100">Approved</th>
<th width="100">Total</th>

</tr>


<?php
	

 $sql.="Select distinct(branch_id) from daily_expenses";




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


$table=mysqli_query($con1,$sql);


if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))

{		
//============= while loop for Pending Approval =========================
$str1="SELECT count(*), status FROM `daily_expenses` where branch_id LIKE '".$row[0]."' ";
	
			//========================================From Date to Date============
$fromdt2 = str_replace('/', '-', $_POST['fromdt']);  
$fromdt = date("Y-m-d", strtotime($fromdt2));

$todt1 = str_replace('/', '-', $_POST['todt']);
$todt = date("Y-m-d", strtotime($todt1));



if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
			{
		
			$str1.=" and date between '".$fromdt."' AND '".$todt."'";
				
			
			}
			
		$str1.=" and status=1  group by branch_id"; 
		
		
		$datarow=mysqli_query($con1,$str1);
	//	echo "<br>".$str1;
	  	
$datarow1=mysqli_fetch_row($datarow);
			
				
//============= while loop for Approved claim =========================
				
$str="SELECT count(*),status FROM `daily_expenses` where branch_id LIKE '".$row[0]."' ";
				
//========================================From Date to Date============
				if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
			
		$str.=" and date between '".$fromdt."' AND '".$todt."'";			
				}
				
$str.=" and status=2 group by branch_id";
			
			$opencall=mysqli_query($con1,$str);
		//		echo "<br>".$str;
	 $opencalldata=mysqli_fetch_row($opencall);
		?>

<tr>
<!--===SN===-->
<td  valign="top" width=""><?php echo $sn; ?></td>

<!--===State===-->   
<td  valign="top">
<?php 
$branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
//echo $row[0];
 ?>
</td>


<!--===Pending===-->
<td  valign="top"><?php $tot2=$datarow1[0]; echo $datarow1[0] ?></td>

<!--===Approved===-->   
<td  valign="top"><?php $tot1=$opencalldata[0]; echo $opencalldata[0];   ?></td>


<!--===Total===-->
<td  valign="top"><?php $grtotopen+=$tot2; $grtotclose+=$tot1; echo $tot2 + $tot1;  ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td colspan="2">Grand Total <td><?php echo $grtotopen; ?></td> <td><?php echo $grtotclose; ?></td> <td><?php  echo $grtotopen+$grtotclose; ?></td></tr>
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
 }else{ ?>
	 	<th width="20">SN</th> 
		<th width="200">Name of Customer</th>
		<th width="200">Designation</th>
		<th width="100">Pending</th>
		<th width="100">Approved</th>
		<th width="100">Total</th>

</tr>


<?php
	

 
$sql="SELECT distinct(engg_id) FROM `daily_expenses`";
//========================================for open and close call============
	
	

//echo $sql;

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
$sql.=" group by `engg_id` LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))
{		
//============= while loop for Approved call =========================
$str="SELECT count(*),status FROM `daily_expenses` where engg_id LIKE '".$row[0]."' ";
	
//========================================From Date to Date============
			if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
			{
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$str.=" and date between '".$fromdt."' and '".$todt."' ";
				
			
			}
			
		$str.=" and status = 2 group by engg_id";
		$datarow=mysqli_query($con1,$str);
		//echo "<br>".$str;
$datarow1=mysqli_fetch_row($datarow);
			
				
//============= while loop for open call =========================
				
$str="SELECT count(*),status FROM `daily_expenses` where engg_id LIKE '".$row[0]."' ";
				
				//========================================From Date to Date============
				if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
				$str.=" and date between '".$fromdt."' and '".$todt."' ";		
				}
				
				$str.=" and  status = 1 group by engg_id" ;
				
				$opencall=mysqli_query($con1,$str);
				//echo "<br>".$str;
	$opencalldata=mysqli_fetch_row($opencall);
	
	
$customer=mysqli_query($con1,"select `engg_name`, `engg_desgn` from `area_engg` where `engg_id`='".$row[0]."'");
$customer1=mysqli_fetch_row($customer);

//echo "select `engg_name`, `engg_desgn` from `area_engg` where `engg_id`='".$row[0]."'";

	
		?>
<tr>
<!--===SN===-->
<td  valign="top" width=""><?php echo $sn; ?></td>

<!--===customer name===-->   

<td  valign="top">
<?php echo $customer1[0];
	//echo $row[0];
 ?>
</td>
<td  valign="top"><?php echo $customer1[1];   ?></td>

<!--===Open===-->   
<td  valign="top"><?php $tot1=$opencalldata[0]; echo $opencalldata[0];   ?></td>

<!--===Close===-->
<td  valign="top"><?php $tot2=$datarow1[0]; echo $datarow1[0] ?></td>

<!--===Total===-->
<td  valign="top"><?php $grtotopen+=$tot2; $grtotclose+=$tot1; echo $tot2 + $tot1;  ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td colspan="2">Grand Total </td> <td></td> <td><?php echo $grtotclose; ?></td> <td> <?php echo $grtotopen ; ?></td> <td><?php  echo $grtotopen+$grtotclose; ?></td></tr>
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
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<!--<input type="submit" name="cmdsub" value="Export" >-->
</form>
 
<div id="bg" class="popup_bg"> </div> 