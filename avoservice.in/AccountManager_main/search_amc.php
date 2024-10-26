<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
include('../config.php');
//include("config.php");
//require("myfunction/function.php");
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
//paging
/*$page=1;//Default page
$limit=10;//Records per page
$start=0;//starts displaying records from 0
if(isset($_GET['page']) && $_GET['page']!=''){
	$page=$_GET['page'];
}
	$start=($page-1)*$limit;*/
	//end paging
	$strPage = $_REQUEST['Page'];
	//echo "Select * from `Amc` where 1";
	$sql="Select * from `Amc` where 1";
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and atmid LIKE '%".$id."%'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and cid IN(select cust_id from customer where cust_name LIKE '%".$cid."%')";
//echo $sql;
}
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bankname LIKE '%".$bank."%'";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and address LIKE '%".$area."%'";
}
if(isset($_POST['city']) && $_POST['city']!='')
{
$city=$_REQUEST['city'];
$sql.=" and address LIKE '%".$city."%'";
}
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_REQUEST['state'];
$sql.=" and state1 LIKE '%".$state."%'";
}
if(isset($_POST['pin']) && $_POST['pin']!='')
{
$pin=$_REQUEST['pin'];
$sql.=" and pincode LIKE '%".$pin."%'";
}
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
$sql.=" order by atmid DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysql_query($sql);
//include_once('class_files/filter_new.php');
//$filter=new filter_new();
//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);

/*include_once('class_files/table_formation.php');
$form=new table_formation();
$form->table_forming(array("","","","","",""),$table,"n");*/

?>
<style>
.vassets{color:#FF0;}

.po_assets{color:#000;}

.gc_assets{color:#C00;}
</style>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="77">Customer</th>
<th width="125">Bank</th>
<th width="75">Area</th>
<th width="75">City</th>
<th width="95">State</th>
<th width="70">Pincode</th>
<th width="70">Address</th>
<th width="75">ATM</th>
<th width="75">Start Date</th>
<th width="75">Expiry Date</th>
<th width="75">Generate Call</th>
<!--<th width="75">Asset Details</th>
<th width="45">Detail</th></tr>-->
<!--
<th width="45">Edit</th>
<th width="50">Delete</th>-->

<?php
// Insert a new row in the table for each person returned
if(mysql_num_rows($table)>0) {
while($row= mysql_fetch_row($table))
{
	
$qry1=mysql_query("select * from customer where cust_name='$cid'");
$crow=mysql_fetch_row($qry1);	
$stat=array();
//echo "select * from site_assets where cust_id='$row[2]' and po='$row[11]' and atmid='".$row[0]."'";
//echo "Select * from site_assets where atmid = '".$row[0]."' ";
$qry2me=mysql_query("Select * from Amc where atmid = '".$row[3]."' ");
while($detailme=mysql_fetch_row($qry2me))
{
//echo "Select * from installed_sitesme where assets like '".$detailme[3]."%' and atm_id=(select atm_id from atm where track_id='".$row[0]."')";
$qryin=mysql_query("Select * from installed_sitesme where assets like '".$detailme[3]."%' and atm_id=(select atm_id from atm where track_id='".$row[0]."')");
	if(mysql_num_rows($qryin)>0)
	{
	$ast=mysql_fetch_row($qryin);
	//echo $ast[1];
	//echo "hii";
	$stat[]='1';
	}
	else
	{
	//echo "hello";
	$stat[]=0;
	}

} 
//echo "<br>".in_array(0,$stat);
if(in_array(0,$stat)){
?><div class=article>
<div class=title><tr>

<td width="77"><?php echo $crow[1] ?></td> <!-- Customer -->
<td width="125"><?php echo $row[4] ?></td>  <!-- Bank-->
<td width="75"><?php echo $row[5] ?></td>  <!-- Area-->
<td width="75"><?php echo $row[7] ?></td>  <!-- City-->
<td width="95"><?php echo $row[12] ?></td>  <!--State -->
<td width="70"><?php echo $row[6] ?></td>  <!--Pincode -->
<td width="70"><?php echo $row[9] ?></td>  <!-- Address-->
<td width="75"><?php echo $row[3] ?></td>  <!-- ATM-->
<td width="75"><?php

$qury=mysql_query("SELECT * FROM `amcpurchaseorder` where amcsiteid='".$row[0]."'"); 
$dateme=mysql_fetch_row($qury);

echo date('d/m/Y',strtotime($dateme[3]));
//if(isset($row[13]) and $row[13]!='0000-00-00') echo date('d/m/Y',strtotime($row[13]));
?></td> <!--start date-->

<td width="75"><?php 
echo date('d/m/Y',strtotime($dateme[4]));
//if(isset($row[13]) and $row[13]!='0000-00-00') echo date('d/m/Y',strtotime($row[13]));
?></td><!--end date-->

<!--<td width="75"><?php 

$qry2me=mysql_query("select * from amcassets where cust_id='$row[2]' and po='$row[11]' and atmid='".$row[0]."'");
while($detailme=mysql_fetch_row($qry2me))
{
/*echo "select * from assets_specification where ass_spc_id='$detail[4]'";
$qry3=mysql_query("select * from assets_specification where ass_spc_id='$detail[4]'");
$row3=mysql_fetch_row($qry3);*/

$validmnth=str_replace(',',' ',$detailme[5]);
$expdt=date('d-m-Y', strtotime($row[13] .' +'.$validmnth));


echo $detailme[3]."(".str_replace(',',' ',$detailme[5]).")"." <b>/".$expdt."</b>"."</br>";
} 
?>
</td>-->
<td width="45" height="31"> 
<a href="po_generate.php?cust=<?php echo  $crow[1] ; ?>&atmid=<?php echo $row[0] ; ?>" target="_blank"><span class="po_assets"> Generate PO Call<span></a>

<!--<a href="amc_generate.php?cust=<?php echo  $cid; ?>&atmid=<?php echo $row[0] ; ?>" target="_blank"><span class="gc_assets"> Generate Call</span></a>&nbsp;&nbsp;/-->
<?php

$qrytype=mysql_query("select * from site_assets where atmid='".$row[3]."' ");
$qrytype1=mysql_fetch_row($qrytype);


if($qrytype1[9]=="AMC"){ ?>
<!--<a href="view_amcassets.php?cust=<?php echo  $cid; ?>&atmid=<?php echo $row[3] ; ?>&atmidnew=<?php echo $qrytype1[0]; ?>" target="_blank" > <span class="vassets">View Amc Assets</span></a>-->
<?php } ?>
</td>
<!--<td width="45" height="31"> <a href="detail_site.php?id=<?php echo $row[0] ?>" target="_blank"> Detail </a>&nbsp;&nbsp;
<a href="#" onClick="window.open('edit_site.php?id=<?php echo $row[0]; ?>&type=new','edit_site','width=700px,height=750,left=200,top=40')"> Edit </a>
</td>-->
<!--
<td width="45" height="31"> <a href="edit_site.php?id='.$row[0].'"> Edit </a></td>
<td width="50" height="31">  <a href="javascript:confirm_delete('.$row[0].');"> Delete </a></td>-->
</tr></div></div><?php
}
}

?></table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
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
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?>