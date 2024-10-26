<?php
session_start();





$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

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
<th width="100">Open</th>
<th width="100">Close</th>
<th width="100">Total</th>

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

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))
{		
//============= while loop for close call =========================
$str="SELECT count(*),call_status FROM `alert` where branch_id = '".$row[0]."' and manual_fsr !=''";
	
	$str.=" and alert_type = 'new' and close_date >= '2021-08-01 00:00:00' ";

	
			//========================================From Date to Date============
			if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
			{
			$fromdt=$_POST['fromdt'];
			$todt=$_POST['todt'];
			//$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			//$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$str.=" and close_date between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
				
		
			}
			
		$str.=" group by branch_id"; 
		$datarow=mysqli_query($con1,$str);
	//	echo "<br>".$str;
	  	
	  	$datarow1=mysqli_fetch_row($datarow);
			
				
//============= while loop for open call =========================
				//echo "<br>SELECT count(*),call_status FROM `alert` where state LIKE '".$row[0]."' and ( call_status = 'Pending' or call_status='1')  group by state";
				$str="SELECT count(*),call_status FROM `alert` where branch_id = '".$row[0]."' and manual_fsr ='' ";
				
				$str.=" and alert_type = 'new' and close_date >= '2021-08-01 00:00:00' ";
				
				//========================================From Date to Date============
				if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
				$str.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
				}
		        $str.=" group by branch_id";		
//$str.=" and  (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and status != 'Done' group by branch_id";
				$opencall=mysqli_query($con1,$str);
			//	echo "<br>".$str;
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

<!--===Open===-->   
<td  valign="top"><?php $tot1=$opencalldata[0]; echo $opencalldata[0];   ?></td>

<!--===Close===-->
<td  valign="top"><?php $tot2=$datarow1[0]; echo $datarow1[0] ?></td>

<!--===Total===-->
<td  valign="top"><?php $grtotopen+=$tot1; $grtotclose+=$tot2; echo $tot1 + $tot2;  ?></td>

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
 }elseif ($_POST['calltype']=='clisummary') { ?>
 
 
	 	<th width="20">SN</th> 
		<th width="200">Name of Customer</th>
		<th width="100">Open</th>
		<th width="100">Close</th>
		<th width="100">Total</th>

</tr>


<?php
	

$sql.="Select distinct(cust_id) from alert where cust_id<>''";




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
$sql.=" group by `cust_id` LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))
{		
//============= while loop for close call =========================
$str="SELECT count(*),call_status FROM `alert` where cust_id = '".$row[0]."'and manual_fsr !='' ";
	$str.=" and alert_type = 'new' and close_date >= '2021-08-01 00:00:00'";
	
	
			//========================================From Date to Date============
			if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
			{
			$fromdt=$_POST['fromdt'];
			$todt=$_POST['todt'];
			$str.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

			}
			
		if(isset($_POST['branch']) && $_POST['branch']!='') {

$str.=" and branch_id= '".$_POST['branch']."'"; }

if($_SESSION['designation']==3){
    $str.=" and branch_id in ('".$_SESSION['branch']."')"; }	
		
		
			
		$str.=" group by cust_id";
		$datarow=mysqli_query($con1,$str);
	//	echo "<br>".$str;
	  	$datarow1=mysqli_fetch_row($datarow);
			
				
//============= while loop for open call =========================
				//echo "<br>SELECT count(*),call_status FROM `alert` where state LIKE '".$row[0]."' and ( call_status = 'Pending' or call_status='1')  group by state";
				$str="SELECT count(*),call_status FROM `alert` where cust_id = '".$row[0]."' and manual_fsr ='' ";
				
				$str.=" and alert_type = 'new' and close_date >= '2021-08-01 00:00:00'";
			
				//========================================From Date to Date============
				if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
				$str.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
				}
		if(isset($_POST['branch']) && $_POST['branch']!='') {

$str.=" and branch_id= '".$_POST['branch']."'"; }

if($_SESSION['designation']==3){
    $str.=" and branch_id in ('".$_SESSION['branch']."')"; }	
    
				$str.=" group by cust_id" ;
				$opencall=mysqli_query($con1,$str);
				//echo "<br>".$str;
	  			$opencalldata=mysqli_fetch_row($opencall);
		?>
<tr>
<!--===SN===-->
<td  valign="top" width=""><?php echo $sn; ?></td>

<!--===customer name===-->   
<td  valign="top">
<?php 
//echo "select `cust_name` from `customer` where `cust_id`='".$row[0]."'";
$customer=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$row[0]."'");
$customer1=mysqli_fetch_row($customer);
echo $customer1[0];
	//echo $row[0];
 ?>
</td>

<!--===Open===-->   
<td  valign="top"><?php $tot1=$opencalldata[0]; echo $opencalldata[0];   ?></td>

<!--===Close===-->
<td  valign="top"><?php $tot2=$datarow1[0]; echo $datarow1[0] ?></td>

<!--===Total===-->
<td  valign="top"><?php $grtotopen+=$tot1; $grtotclose+=$tot2; echo $tot1 + $tot2;  ?></td>

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

	 } 
	//=============Engrwise==============================================
	elseif ($_POST['calltype']=='engrsummary') {
	    
	     ?>
 
 
	 	<th width="20">SN</th> 
		<th width="200">Engineer Name</th>
		<th width="200">Branch</th>
		<th width="100">Open</th>
		<th width="100">Close</th>
		<th width="100">Total</th>

</tr>


<?php
	

 $sql.="Select engg_id, engg_name, area from area_engg where status=1 and deleted=0";

if(isset($_POST['branch']) && $_POST['branch']!='') {

$sql.=" and branch_id= '".$_POST['branch']."'"; }

if($_SESSION['designation']==3){
    $sql.=" and branch_id in ('".$_SESSION['branch']."')"; }


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
$sql.=" order by area  LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
	$sn=1;
while($row= mysqli_fetch_row($table))
{		
//============= while loop for close call =========================


$str= "select alert_id, engineer from alert_delegation where alert_id in(select alert_id from alert where manual_fsr !='' and alert_type = 'new' and close_date >= '2021-08-01 00:00:00'" ;


//========================================From Date to Date============
			if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
			{
			$fromdt=$_POST['fromdt'];
			$todt=$_POST['todt'];
			$str.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY)";
			}

$str.=" order by id DESC";

//echo "<br>".$str;
$datarow=mysqli_query($con1,$str);
	    $alert_row=mysqli_fetch_row($datarow);

$engqry="select count(*), alert_id from alert_delegation where alert_id='".$alert_row[0]."' and engineer='".$alert_row[1]."' and engineer='".$row[0]."'";
		
//	$data1=mysqli_query($con1,$engqry);
	
echo $engqry;	
	  	
	  	$datarow1=mysqli_fetch_row($data1);
			
				
//============= while loop for open call =========================
			
		$str="SELECT a.alert_id FROM `alert`a, alert_delegation b where a.alert_id=b.alert_id and engineer='".$row[0]."' and manual_fsr ='' ";
		//		$str="SELECT count(*),call_status FROM `alert` where alert_id in (select alert_id from alert_delegation where engineer='".$row[0]."') and manual_fsr ='' ";
				
				$str.=" and a.alert_type = 'new' and a.close_date >= '2021-08-01 00:00:00'";
			
				//========================================From Date to Date============
				if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
				$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];
				$str.=" and a.close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";			
				}
			
    $str.=" group by b.alert_id order by b.id DESC";
			
				$opencall=mysqli_query($con1,$str);
				//echo "<br>".$str;
	  			$opencalldata=mysqli_num_rows($opencall);
	  		//	$opencalldata=mysqli_fetch_row($opencall);
		?>
<tr>
<!--===SN===-->
<td  valign="top" width=""><?php echo $sn; ?></td>

<!--===Engr name===-->   
<td  valign="top"> <?php echo $row[1]; 	 ?></td>

<td  valign="top">
<?php 
$branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[2]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];

 ?></td>

<!--===Open===-->   
<td  valign="top"><?php $tot1=$opencalldata; echo $opencalldata;   ?></td>

<!--===Close===-->
<td  valign="top"><?php $tot2=$datarow1[0]; echo $datarow1[0] ?></td>

<!--===Total===-->
<td  valign="top"><?php $grtotopen+=$tot1; $grtotclose+=$tot2; echo $tot1 + $tot2;  ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td colspan="2">Grand Total</td><td></td> <td><?php echo $grtotopen; ?></td> <td><?php echo $grtotclose; ?></td> <td><?php  echo $grtotopen+$grtotclose; ?></td></tr>
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