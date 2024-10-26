<?php
session_start();
//$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');


//echo "test";
############# must create your db base connection

$strPage = $_REQUEST['Page'];


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
				{
	$fromdt=date('Y-m-d 00:00:00',strtotime(str_replace('/','-',$_POST['fromdt'])));
    $todt=date('Y-m-d 23:59:59',strtotime(str_replace('/','-',$_POST['todt'])));

} else 
        $fromdt=date('Y-m-d 00:00:00');
       $todt=date('Y-m-d 23:59:59');
       
//echo $fromdt;
//echo $todt ;

?>
<table width="80%" border="1" cellpadding="2" cellspacing="0" style="margin-left:15%; margin-right:15%;" class=""  id="call_summary1" >
<?php
 
 //===============Branchwise Summary==========
 
 if($_POST['calltype']=='brsummary'){
 $sql.="Select distinct(branch_id) from new_sales_order where branch_id<>'' ";


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
<th width="10%" style="text-align:center">Total SO</th>
<th width="10%" style="text-align:center">SO Pending</th>
<th width="10%" style="text-align:center">SO Cancelled</th>
<th width="10%" style="text-align:center">SO on Hold</th> 
<th width="10%" style="text-align:center">Invoiced</th>
<th width="10%" style="text-align:center">Dispatched</th>
<th width="10%" style="text-align:center">Delivered/ Supply Fulfilled</th>
<th width="10%" style="text-align:center">Inst. U/Process </th>
<th width="10%" style="text-align:center">Installed/ Order Fulfilled</th>


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


$sql.=" order by name ASC LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table=mysqli_query($con1,$sql);


if(mysqli_num_rows($table)>0) {
	$sn=1;
$gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;


while($row= mysqli_fetch_row($table))
{		
 

//============= SO Pending =========================

$str=mysqli_query($con1,"SELECT count(so_trackid) as `tot` FROM `new_sales_order` where branch_id ='".$row[0]."'and  so_time Between '".$fromdt."'AND '".$todt."'");

//echo "<br>"."SELECT count(so_trackid) as all FROM `new_sales_order` where branch_id ='".$row[0]."'and  so_time Between '".$fromdt."'AND '".$todt."'";

$all=mysqli_fetch_assoc($str);
//=======So Pending=====


$pending=mysqli_query($con1,"SELECT count(so_trackid) AS `pend`  FROM `new_sales_order` where branch_id ='".$row[0]."' and status=1 and so_time Between '".$fromdt."'AND '".$todt."'");

$pend=mysqli_fetch_assoc($pending);

//===========Cancel=======
$so_cancel=mysqli_query($con1,"SELECT count(so_trackid) AS `socancel` FROM `new_sales_order` where branch_id ='".$row[0]."' and status='c' and so_time Between '".$fromdt."'AND '".$todt."'");

$socan=mysqli_fetch_assoc($so_cancel);
//===Hold======
$so_hold=mysqli_query($con1,"SELECT count(so_trackid) AS `sohold` FROM `new_sales_order` where branch_id ='".$row[0]."' and status='h' and so_time Between '".$fromdt."'AND '".$todt."'");
$sohold=mysqli_fetch_assoc($so_hold);

//======== Invoiced but not disp=====
$so_inv=mysqli_query($con1,"SELECT count(a.so_trackid) AS `invoiced` FROM `new_sales_order` a, so_order b  where a.so_trackid=b.po_id and a.branch_id ='".$row[0]."' and b.status='1' and a.so_time Between '".$fromdt."'AND '".$todt."' and b.dis_date='0000-00-00'");
$inv=mysqli_fetch_assoc($so_inv);
//==========Dispatched======
$so_dis=mysqli_query($con1,"SELECT count(a.so_trackid) AS `disp` FROM `new_sales_order` a, so_order b  where a.so_trackid=b.po_id and a.branch_id ='".$row[0]."' and b.status='1' and a.so_time Between '".$fromdt."'AND '".$todt."' and b.dis_date !='0000-00-00' and del_date= '0000-00-00'");		
$dis=mysqli_fetch_assoc($so_dis);
//=======Delivery =Order Fulfilled=========
$so_del=mysqli_query($con1,"SELECT count(a.so_trackid) AS `del` FROM `new_sales_order` a, so_order b  where a.so_trackid=b.po_id and a.branch_id ='".$row[0]."' and b.status='2' and a.so_time Between '".$fromdt."'AND '".$todt."' and b.del_date != '0000-00-00' and a.inst_request='0'");		

$del=mysqli_fetch_assoc($so_del);

//===Inst UP====
$inst=mysqli_query($con1,"SELECT count(a.so_trackid) AS `inst` FROM `new_sales_order` a, so_order b, alert c where a.so_trackid=b.po_id and b.alert_id=c.alert_id and a.branch_id ='".$row[0]."' and b.status='2' and a.so_time Between '".$fromdt."'AND '".$todt."' and c.close_date ='0000-00-00 00:00:00'");		
$inst1=mysqli_fetch_assoc($inst);

//===Inst UP====
$comp1=mysqli_query($con1,"SELECT count(a.so_trackid) AS `comp` FROM `new_sales_order` a, so_order b, alert c where a.so_trackid=b.po_id and b.alert_id=c.alert_id and a.branch_id ='".$row[0]."' and b.status='2' and a.so_time Between '".$fromdt."'AND '".$todt."' and c.close_date !='0000-00-00 00:00:00'");		
$comp=mysqli_fetch_assoc($comp1);
				
	  		
		?>
<tr>
<!--===SN===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo trim($branch1[1]);
 ?></td>


<td  valign="top"> <?php $gt1+=$all['tot'];  echo $all['tot'];  ?> </td>
<td  valign="top"><?php $gt2+=$pend['pend'];echo $pend['pend'];  ?></td>

<!--===Cancel===-->
<td valign="top"><?php $gt3+=$socan['socancel'];echo $socan['socancel']; ?></td>

<!--===hold===-->
<td  valign="top"><?php  $gt4+=$sohold['sohold']; echo $sohold['sohold']; ?></td>

<td  valign="top"><?php $gt5+=$inv['invoiced']; echo $inv['invoiced']; ?></td>
<td  valign="top"><?php $gt6+=$dis['disp']; echo $dis['disp']; ?></td>
<td  valign="top"><?php $gt7+=$del['del']; echo $del['del']; ?></td>
<td  valign="top"><?php $gt8+=$inst1['inst']; echo $inst1['inst']; ?></td>
<td  valign="top"><?php $gt9+=$comp['comp']; echo $comp['comp']; ?></td>


</tr>
<?php

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

?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
//==============================customer wise========================================================
 }else{
 $sql.="Select distinct(po_custid) from new_sales_order where po_custid<>''";


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
<th width="10%" style="text-align:center">Total SO</th>
<th width="10%" style="text-align:center">SO Pending</th>
<th width="10%" style="text-align:center">SO Cancelled</th>
<th width="10%" style="text-align:center">SO on Hold</th> 
<th width="10%" style="text-align:center">Invoiced</th>
<th width="10%" style="text-align:center">Dispatched</th>
<th width="10%" style="text-align:center">Delivered/ Supply Fulfilled</th>
<th width="10%" style="text-align:center">Inst. U/Process </th>
<th width="10%" style="text-align:center">Installed/ Order Fulfilled</th>


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


$sql.=" order by po_custid ASC LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table=mysqli_query($con1,$sql);


if(mysqli_num_rows($table)>0) {
	$sn=1;

while($row= mysqli_fetch_row($table))
{		
 

//============= SO Pending =========================

$str=mysqli_query($con1,"SELECT count(so_trackid) as `tot` FROM `new_sales_order` where po_custid ='".$row[0]."'and  so_time Between '".$fromdt."'AND '".$todt."'");

//echo "<br>"."SELECT count(so_trackid) as all FROM `new_sales_order` where po_custid ='".$row[0]."'and  so_time Between '".$fromdt."'AND '".$todt."'";

$all=mysqli_fetch_assoc($str);
//=======So Pending=====


$pending=mysqli_query($con1,"SELECT count(so_trackid) AS `pend`  FROM `new_sales_order` where po_custid ='".$row[0]."' and status=1 and so_time Between '".$fromdt."'AND '".$todt."'");

$pend=mysqli_fetch_assoc($pending);

//===========Cancel=======
$so_cancel=mysqli_query($con1,"SELECT count(so_trackid) AS `socancel` FROM `new_sales_order` where po_custid ='".$row[0]."' and status='c' and so_time Between '".$fromdt."'AND '".$todt."'");

$socan=mysqli_fetch_assoc($so_cancel);
//===Hold======
$so_hold=mysqli_query($con1,"SELECT count(so_trackid) AS `sohold` FROM `new_sales_order` where po_custid ='".$row[0]."' and status='h' and so_time Between '".$fromdt."'AND '".$todt."'");
$sohold=mysqli_fetch_assoc($so_hold);

//======== Invoiced but not disp=====
$so_inv=mysqli_query($con1,"SELECT count(a.so_trackid) AS `invoiced` FROM `new_sales_order` a, so_order b  where a.so_trackid=b.po_id and a.po_custid ='".$row[0]."' and b.status='1' and a.so_time Between '".$fromdt."'AND '".$todt."' and b.dis_date='0000-00-00'");
$inv=mysqli_fetch_assoc($so_inv);
//==========Dispatched======
$so_dis=mysqli_query($con1,"SELECT count(a.so_trackid) AS `disp` FROM `new_sales_order` a, so_order b  where a.so_trackid=b.po_id and a.po_custid ='".$row[0]."' and b.status='1' and a.so_time Between '".$fromdt."'AND '".$todt."' and b.dis_date !='0000-00-00' and del_date= '0000-00-00'");		
$dis=mysqli_fetch_assoc($so_dis);
//=======Delivery =Order Fulfilled=========
$so_del=mysqli_query($con1,"SELECT count(a.so_trackid) AS `del` FROM `new_sales_order` a, so_order b  where a.so_trackid=b.po_id and a.po_custid ='".$row[0]."' and b.status='2' and a.so_time Between '".$fromdt."'AND '".$todt."' and b.del_date != '0000-00-00' and a.inst_request='0'");		

$del=mysqli_fetch_assoc($so_del);

//===Inst UP====
$inst=mysqli_query($con1,"SELECT count(a.so_trackid) AS `inst` FROM `new_sales_order` a, so_order b, alert c where a.so_trackid=b.po_id and b.alert_id=c.alert_id and a.po_custid ='".$row[0]."' and b.status='2' and a.so_time Between '".$fromdt."'AND '".$todt."' and c.close_date ='0000-00-00 00:00:00'");		
$inst1=mysqli_fetch_assoc($inst);

//===Inst UP====
$comp1=mysqli_query($con1,"SELECT count(a.so_trackid) AS `comp` FROM `new_sales_order` a, so_order b, alert c where a.so_trackid=b.po_id and b.alert_id=c.alert_id and a.po_custid ='".$row[0]."' and b.status='2' and a.so_time Between '".$fromdt."'AND '".$todt."' and c.close_date !='0000-00-00 00:00:00'");		
$comp=mysqli_fetch_assoc($comp1);
				
	  		
		?>
<tr>
<!--===SN===-->
<td  valign="top">


<?php $cust=mysqli_query($con1,"select cust_id, cust_name from `customer` where cust_id='".$row[0]."'");
$customer=mysqli_fetch_row($cust);
echo $customer[1];
 ?></td>


<td  valign="top"> <?php $gt1+=$all['tot'];  echo $all['tot'];  ?> </td>
<td  valign="top"><?php $gt2+=$pend['pend'];echo $pend['pend'];  ?></td>

<!--===Cancel===-->
<td valign="top"><?php $gt3+=$socan['socancel'];echo $socan['socancel']; ?></td>

<!--===hold===-->
<td  valign="top"><?php  $gt4+=$sohold['sohold']; echo $sohold['sohold']; ?></td>

<td  valign="top"><?php $gt5+=$inv['invoiced']; echo $inv['invoiced']; ?></td>
<td  valign="top"><?php $gt6+=$dis['disp']; echo $dis['disp']; ?></td>
<td  valign="top"><?php $gt7+=$del['del']; echo $del['del']; ?></td>
<td  valign="top"><?php $gt8+=$inst1['inst']; echo $inst1['inst']; ?></td>
<td  valign="top"><?php $gt9+=$comp['comp']; echo $comp['comp']; ?></td>


</tr>
<?php

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

?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
//==============================customer wise========================================================
 }
 
?>

 
<div id="bg" class="popup_bg"> </div> 