<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
include('config.php');
//require("myfunction/function.php");
############# must create your db base connection

   
$strPage = $_REQUEST['Page'];



$sql="SELECT * FROM new_sales_order WHERE bb_available='0' and status=2";



//======search by ATM id=============================================

if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];

$sql.=" and atm_id LIKE '%".$id."%' ";
//echo $sql;
}


//==========search by customer id======================================
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and po_custid = '".$cid."'";

}

//==========search by Invoice no===================================
if(isset($_POST['invno']) && $_POST['invno']!='')
{
$invno=$_REQUEST['invno'];

$so_ord=mysqli_query($con1,"select po_id from so_order where inv_no LIKE '%".$invno."%'");
$invrow= mysqli_fetch_row($so_ord);

$sql.=" and so_trackid='".$invrow[0]."'";

    
    
}

//==========search by Branch===========================================
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_POST['state'];
//$sql.=" and state1 LIKE '%".$state."%'";
$sql.=" and branch_id ='".$state."'";
}
//echo $sql;

//==========search by Date======================================================
if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
$fromdt=$_REQUEST['sdate'];
$todt=$_REQUEST['edate'];

$sql.=" and so_time Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";


}

//echo $sql;



$sqlr=$sql;

$table=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
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
$sql.=" order by so_trackid DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table=mysqli_query($con1,$sql);

?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 
<tr>
               
                
                <th width="5%">S.No</th>
                <th width="5%">Customer Vertical</th>
                <th width="5%">Invoice No.</th>
                <th width="5%">Invoice Date</th>
                <th width="5%">Branch</th>
                 <th width="5%">Site/Sol/ATM Id</th>
                 <th width="5%">End User Name</th>
                  <th width="5%">City</th>
                   <th width="20%">Address</th>
                <th width="5%">SO Date/time</th>
                
                <th width="5%">Engineer Name</th>
                <th width="20%">Engr Final Update</th>
                <th width="20%">Engr BB Status</th>
                <th width="20%">Engr BB Collection</th>
                <th width="20%">Engr BB Products</th>
                
                <th width="5%">Change Buyback SO </th>
                <th width="5%">Submit</th>
            </tr>

<?php
$i=1;

if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_assoc($table))
{ 


$so_id=$row['so_trackid'];
$cid= $row['po_custid'];
$br=  $row['branch_id'];

$atmqry= mysqli_query($con1,"SELECT bank_name,city, address FROM demo_atm WHERE so_id='".$so_id."'");
$atm=mysqli_fetch_row($atmqry);
//======== inv no , alert id========

$inv= mysqli_query($con1,"SELECT inv_no, inv_date, alert_id FROM so_order WHERE po_id='".$so_id."'");
$inv_no=mysqli_fetch_row($inv);

$alert_id=$inv_no[2];
//===alert id to eng last update======
$call= mysqli_query($con1,"Select feedback, engineer from eng_feedback where alert_id= '".$inv_no[2]."' order by id DESC LIMIT 1");


$update=mysqli_fetch_row($call);
//======engr name=========

$enggqry= mysqli_query($con1,"Select engg_name from area_engg where loginid= '".$update[1]."' ");
$engg=mysqli_fetch_row($enggqry);


?>

<div align="center">
<tr>
<td width="77"><?php echo $i++; ?></td>
<!-- Cust -->

<td width="77">
 <?   $custname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$cid."'");
$custname1=mysqli_fetch_row($custname);
echo $custname1[0];  ?></td>
     
<td width="5%"><? echo $inv_no[0];?></td> 
<td width="5%"><? echo $inv_no[1];?></td> 
<!-- Branch -->
<td width="5%">
<?php 
$branch=mysqli_query($con1,"select name from avo_branch where id='".$br."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[0]; ?></td>

<!---atm id -->
<td width="95"><?php echo $row['atm_id']; ?></td>

<!---bank -->

<td width="95"><?php echo $atm[0]; ?></td>
<!--City -->

<td width="50"><?php echo $atm[1]; ?></td>
<!---Address  -->
<td width="100"><?php echo $atm[2]; ?></td>

<!--SOdate and time--->
<td width="70"><?php echo $row['so_time']; ?></td>


<!---Engr name-->
<td width="75"><?php echo $engg[0];?></td>
 
<!---Engr Feedback-->
<td width="100"><?php echo $update[0];?></td> 

<?
//===========Engg BB feedback==========
$sqlqry = mysqli_query($con1,"SELECT * from buyback_engg where alert_id='".$alert_id."'");
$coll=mysqli_fetch_row($sqlqry);
?>
<td> <? echo $coll[4]; ?> </td>
<td> <? echo $coll[8]; ?> </td>

<td width="75">

<a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('engr_buyback.php?id=<? echo $alert_id ;?>','view','width=700px,height=500,left=300,top=100')" class="update">Eng BB Products</a>
</td>



<div id="subdiv<?php echo $so_id; ?>" >


<td width="20"> 

    <select name="bbchange<?php echo $so_id; ?>" id="bbchange<?php echo $so_id; ?>" >

        <option value=""> No </option>
        <option value="1">Available </option>
        
</select>

</td>
    

<td width="20">		

<input type="button" name="submission" value="submit" onclick="setchange(<?php echo $so_id; ?>)" />

</td>	
</div>



</tr></div><?php

} 

?> 
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
?>

<form name="frm" method="post" action="export_nobuyback.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
