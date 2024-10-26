<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];
?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
 <?php 
 if($_POST['calltype']=='brsummary') { ?>
<th width="5%">Name of Branch</th> 
<th width="5%">Total Calls</th>
</tr>

<?php

//==============================
 if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
   	
	 		if($_POST['callwise']=='all'){		 
			 	$fromdate=$_POST['fromdt'].' 00:00:00';
   				$todate=$_POST['todt'].' 23:59:59';
			 	$sql.="Select `branch_id`,count(*) from alert where entry_date between STR_TO_DATE('".$fromdate."','%d/%m/%Y %H:%i:%s') and STR_TO_DATE('".$todate."','%d/%m/%Y %H:%i:%s')  group by branch_id ";
			 }elseif($_POST['callwise']=='service'){
				$service=$_POST['callwise'];		 
			 	$fromdate=$_POST['fromdt'].' 00:00:00';
   				$todate=$_POST['todt'].' 23:59:59';
			 	$sql.="Select branch_id,count(*) from alert where entry_date between STR_TO_DATE('".$fromdate."','%d/%m/%Y %H:%i:%s') and STR_TO_DATE('".$todate."','%d/%m/%Y %H:%i:%s')  && `alert_type` like('%".$service."%') group by branch_id ";
			 }else{	
			 	$new=$_POST['callwise']	;	 
			 	$fromdate=$_POST['fromdt'].' 00:00:00';
   				$todate=$_POST['todt'].' 23:59:59';
			 	$sql.="Select branch_id,count(*) from alert where entry_date between STR_TO_DATE('".$fromdate."','%d/%m/%Y %H:%i:%s') and STR_TO_DATE('".$todate."','%d/%m/%Y %H:%i:%s') && `alert_type` like('%".$new."%') group by branch_id ";
			 }
  }
  
  else{
	     if($_POST['callwise']=='all'){
			 	$curdate=$_POST['curdate'];
			 	$sql.="Select branch_id,count(*) from alert where `entry_date` like ('%".$curdate."%') group by branch_id ";
			 }elseif($_POST['callwise']=='service'){
				 		$service=$_POST['callwise']	;
						$curdate=$_POST['curdate'];	 
				 $sql.="Select branch_id,count(*) from alert where entry_date like ('%".$curdate."%') && `alert_type` like('%".$service."%') group by branch_id ";				 
				 	}else{
						$new=$_POST['callwise']	;
						$curdate=$_POST['curdate'];
					 	$sql.="Select branch_id,count(*) from alert where entry_date like ('%".$curdate."%') && `alert_type` like('%".$new."%') group by branch_id ";
					 	}
	  
	  } 
  /*else
  { $curdate=$_POST['curdate'];
	$sql.="Select state,count(*) from alert where entry_date like  ('%".$curdate."%')group by state ";
  }*/
 
//======

//echo $sql;
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
$table=mysql_query($sql);
$count=0;
$Num_Rows = mysql_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

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
$table=mysql_query($sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysql_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysql_num_rows($table);
if(mysql_num_rows($table)>0) {
	$cnt=0;
while($row= mysql_fetch_row($table))
{
		?>
<tr>
<td  valign="top">
<?php 
$branch=mysql_query("select * from `avo_branch` where `id`='".$row[0]."'");
$branch1=mysql_fetch_row($branch);

echo $branch1[1]; ?></td>

<td  valign="top">&nbsp;<?php  $tot+=$cnt+$row[1];  echo $row[1]; ?></td>
</tr>
<?php
}
$cnt++;
?>
<tr><td>Total</td> <td style="color:red;"><?php echo $tot;?></td></tr>
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
 else
 { ?>
	 <th width="5%">Name of Customer</th> 
<th width="5%">Total Calls</th>
</tr>

<?php
//==============================
 if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
  		 if($_POST['callwise']=='all'){		 
			 	$fromdate=$_POST['fromdt'].' 00:00:00';
   				$todate=$_POST['todt'].' 23:59:59';
			 	$sql.="Select cust_id,count(*) from alert where entry_date between STR_TO_DATE('".$fromdate."','%d/%m/%Y %H:%i:%s') and STR_TO_DATE('".$todate."','%d/%m/%Y %H:%i:%s')  group by cust_id";
			 }elseif($_POST['callwise']=='service'){
				$service=$_POST['callwise'];		 
			 	$fromdate=$_POST['fromdt'].' 00:00:00';
   				$todate=$_POST['todt'].' 23:59:59';
			 	$sql.="Select cust_id,count(*) from alert where entry_date between STR_TO_DATE('".$fromdate."','%d/%m/%Y %H:%i:%s') and STR_TO_DATE('".$todate."','%d/%m/%Y %H:%i:%s')  && `alert_type` like('%".$service."%') group by cust_id";
			 }else{	
			 	$new=$_POST['callwise']	;	 
			 	$fromdate=$_POST['fromdt'].' 00:00:00';
   				$todate=$_POST['todt'].' 23:59:59';
			 	$sql.="Select cust_id,count(*) from alert where entry_date between STR_TO_DATE('".$fromdate."','%d/%m/%Y %H:%i:%s') and STR_TO_DATE('".$todate."','%d/%m/%Y %H:%i:%s') && `alert_type` like('%".$new."%') group by cust_id";
			 }
  
  } 
  
  	else{
	  
	     if($_POST['callwise']=='all'){
			 	$curdate=$_POST['curdate'];
			 	$sql.="Select cust_id,count(*) from alert where `entry_date` like ('%".$curdate."%') group by cust_id";
			 }elseif($_POST['callwise']=='service'){
				 		$service=$_POST['callwise']	;
						$curdate=$_POST['curdate'];	 
				 $sql.="Select cust_id,count(*) from alert where entry_date like ('%".$curdate."%') && `alert_type` like('%".$service."%') group by cust_id";				 
				 	}else{
						$new=$_POST['callwise']	;
						$curdate=$_POST['curdate'];
					 	$sql.="Select cust_id,count(*) from alert where entry_date like ('%".$curdate."%') && `alert_type` like('%".$new."%') group by cust_id";
					 	}
	  
	  } 
  
  /*else
  { $curdate=$_POST['curdate'];
	$sql.="Select cust_id,count(*) from alert where entry_date like  ('%".$curdate."%')group by cust_id ";
  }*/
  
//======

//echo $sql;
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
$table=mysql_query($sql);
$count=0;
$Num_Rows = mysql_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

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
$table=mysql_query($sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysql_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysql_num_rows($table);
if(mysql_num_rows($table)>0) {
	$cnt2=0;
while($row= mysql_fetch_row($table))
{
 $sqlx=mysql_query('select cust_name from customer where cust_id='.$row[0]);
 $rowx=mysql_fetch_row($sqlx);	
		?>
<tr>
<td  valign="top"><?php echo $rowx[0]; ?></td>
<td  valign="top">&nbsp;<?php $tot2+=$cnt2+$row[1]; echo $row[1]; ?></td>
</tr>
<?php
}
$cnt2++;
?>
<tr><td>Total</td> <td style="color:red;"><?php echo $tot2; ?></td></tr>
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