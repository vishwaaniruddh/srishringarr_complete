<?php session_start(); 
// include('config.php');
include("access.php");
 //var_dump($_SESSION);
include("db_connection.php");
$con1 = OpenCon1();
$con2 = OpenCon2();

//echo "Hello........";

//echo $_SESSION['user']."-".$_SESSION['branch']."--".$_SESSION['designation'];

$strPage = $_REQUEST['Page'];



$sql="SELECT a.* FROM new_sales_order a, so_order b WHERE a.so_trackid = b.po_id AND a.bb_available='1' and a.status=2 and b.status=2 ";



if(isset($_POST['status']) && $_POST['status']!='') 
if($_POST['status'] =='err'){
$sql.=" and a.so_trackid  not in(select so_trackid from new_buyback)";
    
} else

{
$sql.=" and a.so_trackid in(select so_trackid from new_buyback where is_collected='".$_POST['status']."')";


}

//======search by ATM id=============================================

if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];

$sql.=" and a.atm_id LIKE '%".$id."%' ";
//echo $sql;
}

//echo $sql;

//==========search by customer id======================================
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and a.po_custid ='".$cid."'";

}

//==========search by Invoice no===================================
if(isset($_POST['invno']) && $_POST['invno']!='')
{
$invno=$_REQUEST['invno'];

$sql.=" and b.inv_no like '%".$invno."%'";

}

//==========search by Bank nameo===================================
/*if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];

$sql.=" and a.so_trackid in (select so_id from demo_atm where bank_name like '%".$bank."%')";

} */

//==========search by Branch===========================================
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_POST['state'];
//$sql.=" and state1 LIKE '%".$state."%'";
$sql.=" and a.branch_id ='".$state."'";
}
//echo $sql;

//==========search by Date======================================================
if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
$fromdt=$_REQUEST['sdate'];
$todt=$_REQUEST['edate'];

//$sql.=" and a.so_time Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')"; //   + INTERVAL 1 DAY";

$sql.=" and b.inv_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')"; //   + INTERVAL 1 DAY";


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
$sql.=" order by a.so_trackid DESC LIMIT $Page_Start , $Per_Page";

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
                 <th width="5%">Call Tkt No.</th>
                 <th width="5%">End User Name</th>
                  <th width="5%">City</th>
                   <th width="5%">Address</th>
                <th width="5%">SO Date/time</th>
                <th width="5%">Buyback Product</th>
                <th width="5%">BB Capacity</th>
                <th width="5%">BB Qty</th>
                <th width="5%">BB Value</th>
                <th width="5%">Onward Transporter</th>
                <th width="5%">Transporter Doc No</th>
                <th width="5%">Engineer Name</th>
                <th width="5%">Site Contact Person</th>
                <th width="5%">Engr Final Update</th>
                <th width="5%">Call close date</th>
                <th width="5%">Engineer Feedback on BB</th>
                <th width="5%">Buyback Coll Date</th>   
                <th width="5%">Is Collected</th>
                <th width="5%">Pickup By</th>
                <th width="5%">UPS Capacity</th>
                <th width="5%">UPS Qty</th>
                <th width="5%">Battery Cap</th>
                <th width="5%">Batt Qty</th>
                
                <th width="10%">Other Items </th>
                <th width="5%">Other Qty</th>
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


//===alert id to eng last update======


$alertidqry= mysqli_query($con1,"Select * from so_order where po_id= '".$so_id."' order by id DESC LIMIT 1");
$so_order=mysqli_fetch_assoc($alertidqry);
$alert_id = $so_order['alert_id'];

$call= mysqli_query($con1,"Select feedback, engineer from eng_feedback where alert_id= '".$alert_id."' order by id DESC LIMIT 1");
$update=mysqli_fetch_row($call);

//===alert id to eng last update======
$alertqry= mysqli_query($con1,"Select close_date,caller_name,caller_phone,createdby from alert where alert_id= '".$alert_id."' ");
$alertr=mysqli_fetch_row($alertqry);

//======engr name=========

$enggqry= mysqli_query($con1,"Select engg_name from area_engg where loginid= '".$update[1]."' ");
if(mysqli_num_rows($enggqry)>0){
$engg=mysqli_fetch_row($enggqry);
$engg_name=$engg[0];
} else {$engg_name ="No Engg Name";}


?>

<div align="center">
<tr>
<td width="77"><?php echo $i++; ?></td>
<!-- Cust -->

<td width="77">
 <?   $custname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$cid."'");
$custname1=mysqli_fetch_row($custname);
echo $custname1[0];  ?></td>
     
<td width="5%"><? echo $so_order['inv_no'];?></td> 
<td width="5%"><? echo $so_order['inv_date'];?></td> 
<!-- Branch -->
<td width="5%">
<?php 
$branch=mysqli_query($con1,"select name from avo_branch where id='".$br."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[0]; ?></td>

<!---atm id -->
<td width="95"><?php echo $row['atm_id']; ?></td>

<td width="95"><?php echo $alertr[3]; ?></td>

<!---bank -->

<td width="95"><?php echo $atm[0]; ?></td>
<!--City -->

<td width="50"><?php echo $atm[1]; ?></td>
<!---Address  -->
<td width="70"><?php echo $atm[2]; ?></td>

<!--SOdate and time--->
<td width="70"><?php echo $row['so_time']; ?></td>
<?
//======== new_buyback table========
//echo $_SESSION['designation'];
$inv= mysqli_query($con1,"SELECT * FROM new_buyback WHERE so_trackid='".$so_id."'");
if(mysqli_num_rows($inv)==0 && $_SESSION['designation'] == 1) { ?>

<div id="subdiv<?php echo $so_id; ?>" >

<td><input type="button" name="submission" value="Edit" onclick="setedit(<?php echo $so_id; ?>)" /> </td>

<? } else {

$bb=mysqli_fetch_assoc($inv);

$bb_status= $bb['is_collected'];
$bb_date=$bb['buyback_date'];
$bid= $bb['track_id'];

?>
<!--BB Prod--->
<td width="200"><?php echo $bb['bb_Product']; ?></td>


<!---Cap assets-->
<td width="70"><?php echo $bb['bb_cap']; ?></td>

 
<!---BB Qty-->
<td width="65"><?php echo $bb['bb_qty'];?></td>

<!---BB Value-->
<td width="50"><?php echo $bb['bb_value'];?></td>
<? } ?>

<!---Transporter-->
<td width="75"><?php echo $so_order['courier'];?></td>
<td width="75"><?php echo $so_order['docketno'];?></td>

<!---Engr name-->
<td width="75"><?php echo $engg[0];?></td>

<td width="75"><?php echo $alertr[1]."-".$alertr[2];?></td>
 
<!---Engr Feedback-->
<td width="75"><?php echo $update[0];?></td> 

<!---Close date-->
<td width="75"><?php echo $alertr[0];?></td> 

<!---Engineer update on BB-->
<td width="75">

<a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('engr_buyback.php?id=<? echo $alert_id ;?>','view','width=700px,height=500,left=300,top=100')" class="update">Eng BB Feedback</a>
</td>

<div id="subdiv<?php echo $bid; ?>" >

<td width="75" id="date_select">
 <?php if($bb_status=='0'){ ?>                   
    <input type="text" name="date<?php echo $bid; ?>" id="date<?php echo $bid; ?>"  onclick="displayDatePicker('date<?php echo $bid; ?>');" readonly="readonly" />


 <?php }else echo $bb_date; ?>                   
</td> 

<? if ($bb_status==1) { $status="Yes"; }
else if ($bb_status=='-1') { $status="Not Available"; } ?>

<td> 
<?php if($bb_status=='0'){ ?>
   	
    <select name="reason<?php echo $bid; ?>" id="reason<?php echo $bid; ?>" >

        <option value="0"> No </option>
        <option value="1">Yes </option>
        <option value="-1">Not Available </option>
        
</select>
	
<?php }else echo $status; ?>


</td>

<td>
 
 <?php if($bb_status=='0'){ ?>                   
   
<input type="text" name="pickup_by<?php echo $bid; ?>" id="pickup_by<?php echo $bid; ?>" placeholder="Pickup By" />

 <?php }else echo $bb['ups_qty']; ?>                   
</td> 
<!-- =================================== --> 
<td>
 <?php if($bb_status=='0'){ ?>     
 
<select name="upsspec<?php echo $bid; ?>" id="upsspec<?php echo $bid; ?>"  />
 <option value="">UPS Cap </option>
 
 <? $ups=mysqli_query($con1,"select * from assets_specification where assets_id='1'");               
 // echo "select * from assets_specification where assets_id='1'";
  while($upspec=mysqli_fetch_row($ups)){ ?>
 
 
 <option value="<? echo $upspec[2]; ?>"><? echo $upspec[2]; ?> </option>
 <?php } ?>       
</select>

 <?php  } else{ echo $bb['ups_spec'];} ?>               
</td>

<td>
 
 <?php if($bb_status=='0'){ ?>                   
   
<input type="number" min="0" max="999" name="upsqty<?php echo $bid; ?>" id="upsqty<?php echo $bid; ?>" placeholder="Qty" onkeyup="if(parseInt(this.value)>999){ this.value =0; return false; }" />

 <?php }else echo $bb['ups_qty']; ?>                   
</td> 
<!---   Battery---------- -->
<td>
 <?php if($bb_status=='0'){ ?>     
 
<select name="battspec<?php echo $bid; ?>" id="battspec<?php echo $bid; ?>"  />
 <option value="">Battery </option>
 
 <? $batt=mysqli_query($con1,"select * from assets_specification where assets_id='2'");               
 // echo "select * from assets_specification where assets_id='1'";
  while($bat=mysqli_fetch_row($batt)){ ?>
 
 
 <option value="<? echo $bat[2]; ?>"><? echo $bat[2]; ?> </option>
 <?php } ?>       
</select>

 <?php  } else{ echo $bb['batt_spec'];} ?>               
</td>

<td>
 
 <?php if($bb_status=='0'){ ?>                   
   
<input type="number" min="0" max="999" name="battqty<?php echo $bid; ?>" id="battqty<?php echo $bid; ?>" placeholder="Qty" onkeyup="if(parseInt(this.value)>999){ this.value =0; return false; }" />

 <?php }else echo $bb['batt_qty']; ?>                   
</td> 


<td>
 <?php if($bb_status=='0'){ ?>     
 
<input type="text" name="remarks<?php echo $bid; ?>" placeholder="Others"id="remarks<?php echo $bid; ?>"  />
                
 <?php }else{ echo $bb['remark'];} ?>               
</td>

<td>
 
 <?php if($bb_status=='0'){ ?>                   
   
<input type="number" min="0" max="999" name="remarkqty<?php echo $bid; ?>" id="remarkqty<?php echo $bid; ?>" placeholder="Qty" onkeyup="if(parseInt(this.value)>999){ this.value =0; return false; }" />

 <?php }else echo $bb['other_qty']; ?>                   
</td> 

<td>		
<?php if($bb_status=='0'){ ?>

		<input type="button" name="submission" value="submit" onclick="setSubmit(<?php echo $bid; ?>)" />
<?php } ?> 

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

<form name="frm" method="post" action="export_newbuyback.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export with SO assets" > <span>Max Records-1000</span>
</form>

<!--<form name="frm" method="post" action="export_newbuyback_eng.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export with Engr BB feedback" > <span>Max Records-2000</span>
</form> -->
