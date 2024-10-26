<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
include('datefunctions.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>

<th width="5%">S.N.</th> 
<th width="5%">Invoice No</th> 
<th width="5%">Invoice Date</th>
<th width="5%">Invoice Value</th>
<th width="5%">Customer</th>
<th width="5%">Bank Name</th>
<th width="5%">Address</th>
<th width="5%">Branch</th>
<th width="5%">ATM ID</th>
<th width="5%">Remarks</th>
<th width="5%">BuyBack Condition</th> 
<th width="5%">Received</th>
<th width="5%">Material Details</th>
<th width="5%">BuyBack Date</th>
<th width="5%">BuyBack Comment</th>
<th width="5%">Update</th>

<?php
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
} ?>
</tr>
<?php


$BuyStatus= $_POST['BuyStatus'];
$BuyCondition= $_POST['BuyCondition'];



$sql="Select a.inv_no,a.inv_date,a.inv_value,b.cust_id,b.BB_Details,b.bbdrate,b.atmid,b.type,a.BuybackDate,a.Buyback_Coment,a.BuybackStatus,b.bback from sales_orders a,pending_installations b where a.po_id=b.id   ";
//======================================Search Call Date wise
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];
	
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and a.inv_date between '".$fromdt."' and '".$todt."'";
	
	
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}//echo "hh:".$_POST['invno'];
if(isset($_POST['invno']) && $_POST['invno']!=''){
		$invno=$_POST['invno'];		
	                //echo "hh:".$invno;
			//$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			//$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and a.inv_no like'%".$invno."%'";
	
	
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}

if($BuyCondition=="y" || $BuyCondition==""){
$sql.=" and b.bback='y' ";
}else{
$sql.=" and b.bback='n' ";
}

             
if($_POST['invtyp']!="")
{

$sql.=" and inv_img IS NULL ";
}


if($_POST['BuyStatus']!="")
{

if($BuyStatus=="No"){
$bbStatus="";
}else{
$bbStatus="Yes";
}

$sql.=" and BuybackStatus='".$bbStatus."'  ";
}


if($_POST['sostats']!="")
{

$sql.=" and status='".$_POST['sostats']."'";
}
$sql2="select * from so_cancel_hold_track_new where status='".$_POST['sostats']."'";
$runsql2=mysqli_query($con1,$sql2);
$blqnckrow=mysqli_fetch_array($runsql2);

//echo $sql;
//echo $sql2;
$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 

?>
<div align="center">Total number of Records :<b><?php echo $Num_Rows;
  ?></b>
 <!--Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

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
 -->
 </div>
 <?php
//echo $sql;
$qr22=$sql;
$sql.=" order by a.inv_date DESC ";


$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$i=0;
while($row= mysqli_fetch_row($table))
{
 $xx=0; $yy=0; $zz=0;$add=0;
//echo "select atmid,type,status,cust_id,id,status from pending_installations where id='".$row[1]."'";
//$pono=mysqli_query($con1,"select atmid,type,alert_id,cust_id,id,status,entry_date from pending_installations where id='".$row[1]."'");
//$pon=mysqli_fetch_row($pono);
	//echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where po='".$pon[0]."'";
	if($row[7]=="AMC")
{
$nm="select bankname,atmid,cid,area,city,address,state,pincode,branch from Amc where amcid='".$row[6]."'";


            $atm=mysqli_query($con1,$nm);	
}
	else{
	//echo "select  bank_name,cid,area,city,address,state1 from atm where atm_id='".$row[1]."'";
	//echo "select  bank_name,atm_id,cust_id,area,city,address,state1 from atm where po='".$pon[0]."'";
$nm="select  bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id from atm where track_id='".$row[6]."'";
	    $atm=mysqli_query($con1,$nm);
	

}






//========================================


########### pagins
/*
$Per_Page =$_POST['perpg'];  

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
$sql.="  LIMIT $Page_Start , $Per_Page";
*/
//======================================
	$atmdet=mysqli_fetch_row($atm);
	if(isset($_POST['cid']) && $_POST['cid']!='' )
         {
          if($_POST['cid']==$atmdet[2]){}
          else
             $xx=-1;
         }
         if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='' )
         {
           if($_POST['branch_avo']==$atmdet[8]){}
          else
             $yy=-1;
         }
         if(isset($_POST['atmid']) && $_POST['atmid']!='' )
         {
           //if($_POST['atmid']==$atmdet[1]){}
           if(startsWith($atmdet[1], $_POST['atmid'])){}
          else
             $zz=-1;
         }
 if(isset($_POST['address']) && $_POST['address']!='' )
         {
//echo $_POST['address'];
if (strpos($atmdet[5], $_POST['address']) !== false)
{}
          else
             $add=-1;
         }

      if($xx==0 and $yy==0 and $zz==0 and $add==0)
      {
      
      
      
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atmdet[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$brqry=mysqli_query($con1,"select name from avo_branch where id='".$atmdet[8]."'");
	$brrow=mysqli_fetch_row($brqry);
	//$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."'");	
	//$row1=mysqli_fetch_row($tab)
	//echo "eng stat".$row[15];
        ?>
<tr>
<td  valign="top"><?php echo ++$i; ?></td>
<td  valign="top">&nbsp;<?php echo $row[0]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[1]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[2]; ?></td> 
<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td>
<td  valign="top">&nbsp;<?php echo $atmdet[0]; ?></td>  
<td  valign="top">&nbsp;<?php echo $atmdet[5]; ?></td> 
<td  valign="top">&nbsp;<?php echo $brrow[0]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atmdet[1]; ?></td> 
<td  valign="top">&nbsp;<?php echo $row[4].' '.$row[5]; ?></td>
<td  valign="top">&nbsp;<?php if($row[11]=="n"){ echo "Not Available";}else if($row[11]=="y"){ echo "Available";} ?></td>
<td  valign="top">&nbsp;<?php if($row[10]==""){ echo "NO";}else if($row[10]=="Yes"){ echo "YES";}  ?></td>


<td  valign="top">&nbsp;<?php echo "NA"; ?></td>  

<td  valign="top">&nbsp;<?php echo $row[8]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[9]; ?></td>

 <?php if($row[10]==""){?>
<td><a href="javascript:void(0);" onclick="window.open('update_buyback.php?id=<?php echo $row[0]?>','Update_generateSO','width=400px,height=450,left=500,top=180')" class="update" >Update</a></td>
<?php }else{ ?><td></td><? }?>


</tr>
<?php

}
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
/*if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}*/

?>
<input type="hidden" id="soid"  readonly>
<input type="hidden" id="sosts"  readonly>

 
<form name="frm" method="post" action="exportBuyBack.php" target="_new">
<input type="hidden" name="cid" value="<?php echo $_POST['cid']; ?>" readonly>
<input type="hidden" name="branch_avo" value="<?php echo $_POST['branch_avo']; ?>" readonly>
<input type="hidden" name="atmid" value="<?php echo $_POST['atmid']; ?>" readonly>
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
<div id="bg" class="popup_bg"> </div> 