<?php
include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$id="";
$cid="";
$bank="";
$city="";
$area="";
$state="";
$pin="";
$sdate="";
$edate="";

$strPage = $_REQUEST['Page'];

$noredids="";

$getsodetsqr=mysql_query("select po_id from sales_orders where (status='c' or call_status=1)");
while($gtfrids=mysql_fetch_array($getsodetsqr))
{
if($noredids=="")
{
$noredids=$gtfrids[0];
}else
{
$noredids=$noredids.",".$gtfrids[0];
}

}

	$sql="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.status,b.bankname,b.address,b.state,b.city,b.area,b.pincode,b.amc_st_date,b.atmid from pending_installations a,Amc b where a.type='AMC' and a.status<>2 and a.del_type='site_del' and a.atmid=b.amcid ";


if($noredids!="")
{
$sql.=" and a.id not in($noredids)";
}
//$sql="Select * from Amc where 1";
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and b.atmid LIKE '%".$id."%'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and a.cust_id IN(select cust_id from customer where cust_name LIKE '%".$cid."%')";
}
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and b.bankname LIKE '%".$bank."%'";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and b.address LIKE '%".$area."%'";
}
if(isset($_POST['city']) && $_POST['city']!='')
{
$city=$_REQUEST['city'];
$sql.=" and b.city LIKE '%".$city."%'";
}
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_REQUEST['state'];
$sql.=" and b.state LIKE '%".$state."%'";
}
if(isset($_POST['pin']) && $_POST['pin']!='')
{
$pin=$_REQUEST['pin'];
$sql.=" and b.pincode LIKE '%".$pin."%'";
}
/*
if(isset($_POST['sdate']) && $_POST['sdate']!='')
{
$sdate=$_REQUEST['sdate'];
$sdate2=str_replace("/","-",$sdate);
$sql.=" and podate LIKE '%".date('Y-m-d',strtotime($sdate2))."%'";
}
if(isset($_POST['edate']) && $_POST['edate']!='')
{
$edate=$_REQUEST['edate'];
$edate2=str_replace("/","-",$edate);
$sql.=" and podate LIKE '%".date('Y-m-d',strtotime($edate2))."%'";
}
*/
//$table=mysql_query("select * from atm");

$table=mysql_query($sql);

$Num_Rows = mysql_num_rows ($table);
 
########### pagins
?>
 <div align="center">
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
$sql.=" order by a.id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysql_query($sql);
//$table=mysql_query("select * from atm");

//$str="";
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter1($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);
/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/
include("config.php");

?>
<!--
<th width="45">Edit</th>
<th width="50">Delete</th>-->

<?php
$count=0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($table)>0) {
?>

<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="113">Customer</th>
<th width="181">Bank</th>
<th width="109">Area</th>
<th width="109">City</th>
<th width="138">State</th>
<th width="102">Pincode</th>
<th width="138">Address</th>
<th width="109">ATM</th>
<th width="206">Assets Details</th>

<th width="53">Detail</th>
<th width="53">Delete</th>
<th width="53">Updates</th>
<th width="53">Invoice Copy</th>
<?php


while($row= mysql_fetch_row($table))
{
$count=$count+1;
//$atmdet=mysql_query("select * from Amc where amcid='".$row[0]."'");	
//$atmrow=mysql_fetch_row($atmdet);	

$qry1=mysql_query("select * from customer where cust_id='$row[2]'");
$crow=mysql_fetch_row($qry1);

?><tr>

<td width="113"><?php echo $crow[1] ?></td>
<td width="181"><?php echo $row[10]?></td>
<td width="109"><?php echo $row[14]?></td>
<td width="109"><?php echo $row[13]?></td>
<td width="138"><?php echo $row[12]?></td>
<td width="102"><?php echo $row[15]?></td>
<td width="138"><?php echo $row[11]?></td>
<td width="109"><?php echo $row[17]?></td>
<td width="206"><?php 
$qry2me=mysql_query("select * from amcassets where `siteid`='$row[0]' and callid='".$row[8]."'");
while($detail1=mysql_fetch_row($qry2me))
{
//echo "select * from assets_specification where ass_spc_id='$detail1[2]'";
$qry3me=mysql_query("select * from assets_specification where ass_spc_id='$detail1[2]'");
$row3me=mysql_fetch_row($qry3me);

$qry4me=mysql_query("select * from assets where assets_id='$row3me[1]'");
$row4me=mysql_fetch_row($qry4me);

$qry5me=mysql_query("select * from `amcpurchaseorder` where amcsiteid='".$row[0]."'");
$row5me=mysql_fetch_row($qry5me);
if($row5me[3]!='0000-00-00' && $row5me[4]!='0000-00-00')
{ 
echo $row4me[1]."-".date('d/m/Y',strtotime($row5me[3]))."-".date('d/m/Y',strtotime($row5me[4]))."</br>";
}

}
?>
</td>
<td width="53" height="31">
<?php



$gcsts=1;
$reas="";
//echo $reas;

$gtsofrmtable=mysql_query("select status,call_status from sales_orders where po_id='".$row[8]."'");
$gtsofrmtablenum=mysql_num_rows($gtsofrmtable);

if($gtsofrmtablenum>0)
{
$frrw=mysql_fetch_array($gtsofrmtable);

//echo $frrw[1];

if($frrw[0]=="h")
{
$gcsts=0;
$reas="On Hold";
}

if($frrw[0]=="c")
{
$gcsts=0;
$reas="SO Cancelled";
}

if($frrw[1]=="1")
{
$gcsts=0;
$reas="Call Cancelled";
}


}

//echo $reas;
if($row[9]==0){
echo "Waiting for SO";
}
else { 
if($gcsts=1)
{
?>
<a href="javascript:confirm_generate('<?php echo $row[2]; ?>','<?php echo $row[17]; ?>','<?php echo $row[0]; ?>','<?php echo $row[8]; ?>');" > Generate Call</a>
<?php 
}else
{
echo $reas;

}
} ?>
</td>
<!--<td width="53" height="31"> <a href="detail1_site.php?id=<?php echo $row[0]?>" target="_blank"> Detail </a>&nbsp;&nbsp;
<a href="#" class="update" onClick="window.open('edit_site.php?id=<?php echo $row[0]; ?>&type=amc','edit_site','width=700px,height=750,left=200,top=40')"> Edit </a>
</td>-->
<td width="45" height="31"> 
<?php
if($row[9]==0){ ?>
<a href="javascript:confirm_delete('<?php echo $row[0]; ?>');" > Delete Call</a>
<?php } ?>
</td>
<?php $qry_soupdt=mysql_query("select Remarks_update from SO_Update where po_id='".$row[8]."' order by updt_id DESC");
//echo "select Remarks_update from SO_Update where po_id='".$row[8]."' and date <='".$today."' order by date DESC";
$fetchsoupdt=mysql_fetch_array($qry_soupdt);
?>
<td> <?php echo $fetchsoupdt[0];?><br><a href="javascript:void(0);" onclick="window.open('../view_SO.php?id=<?php echo $row[8]?>','view updates','width=700px,height=750,left=200,top=40')" class="update" >View All</a></td>
<td><?php 
$qry_inv=mysql_query("select inv_img from sales_orders where po_id='".$row[8]."'");
//echo "select Remarks_update from SO_Update where po_id='".$row[8]."' and date <='".$today."' order by date DESC";
$fetchinv=mysql_fetch_array($qry_inv);
if($fetchinv[0]!=null){ ?>
<a href="<?php echo '../'.$fetchinv[0]; ?>" target="_blank" ><image src="<?php echo '../'.$fetchinv[0]; ?>" alt="no attachment" width="50" height="50" /></a>
<?php } ?>
</td>

<!--
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.$row[0].');"> Delete </a></td>-->
</tr>

<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
?>
<tr><td colspan="10" align="center">
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<?php
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
?></font></div></td></tr></table>

<?php } ?>