<?php
session_start();
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 //echo "br=".$br=$_POST['branch'];
include('config.php');
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
<th width="5%">Address</th>
<th width="5%">Site/Sol/ATM ID</th>
<th width="5%">Courier</th>
<th width="5%">Docket No.</th>
<th width="5%">Estimated Delivery Date</th>
<th width="5%">Dispatch Date</th>
<th width="5%">Delivery Date</th>
<th width="5%">Invoice Submission Date</th>
<th width="5%">Credit Note</th>
<th width="5%">Invoice Copy</th>
<th width="5%">Credit Note Copy</th>
<th width="5%">View Remarks</th>
</tr>
<?php


$sql="Select * from sales_orders where 1";
//======================================Search Call Date wise

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];
	
			$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));

			$sql.=" and inv_date between '".$fromdt."' and '".$todt."'";
}

//============================search by invoice no
if($_POST['invoiceno']!="")
{

$sql.=" and inv_no='".$_POST['invoiceno']."'";
}
//==================================search by creditnote no

if($_POST['crno']!="")
{

$sql.=" and crn_no='".$_POST['crno']."'";
}


//=====================search by address or customer or atmid================================================
if($_POST['address']!="" || $_POST['cid']!="" || $_POST['atmid']!="")
{
$poidsstr="";
$tablef=mysqli_query($con1,$sql);
while($porws=mysqli_fetch_array($tablef))
{

$mnqrr="select atmid,type from pending_installations where id ='".$porws[1]."'";
$pono=mysqli_query($con1,$mnqrr);
$pon=mysqli_fetch_row($pono);
	//echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where po='".$pon[0]."'";
    if($pon[1]=="AMC")
{
$atmqrr="select bankname,atmid,cid,area,city,address,state,pincode from Amc where amcid='".$pon[0]."'";
if($_POST['address']!="")
{
$atmqrr.=" and address like '%".$_POST['address']."%'";
}
if($_POST['cid']!="")
{
$atmqrr.=" and cid='".$_POST['cid']."'";
}

if($_POST['atmid']!="")
{
//echo $_POST['atmid'];
$atmqrr.=" and atmid='".$_POST['atmid']."'";
}

            $atm=mysqli_query($con1,$atmqrr);
          
}

	else
{

$atmqrr="select  bank_name,atm_id,cust_id,area,city,address,state1,pincode from atm where track_id='".$pon[0]."'";

if($_POST['address']!="" )
{
$atmqrr.=" and address like '%".$_POST['address']."%'";
}

if($_POST['cid']!="")
{
$atmqrr.=" and cust_id='".$_POST['cid']."'";
}

if($_POST['atmid']!="")
{
//echo $_POST['atmid'];

$atmqrr.=" and atm_id='".$_POST['atmid']."'";

}
//echo $atmqrr;
	    $atm=mysqli_query($con1,$atmqrr);
}

$atmderrwsno=mysqli_num_rows($atm);
if($atmderrwsno>0)
{

  if($poidsstr=="")
  {
  $poidsstr=$porws[1];
  }else
  {
  $poidsstr=$poidsstr.",".$porws[1];
  }
}
}//-- $tablef while loop end

//echo $poidsstr;

if($poidsstr!="")
{
$sql.=" and po_id in($poidsstr)";

}else
{
$sql.=" and po_id in(-1)";
}
}

//=====================search by address or customer end=================================================

//=====================no invoice attached search

if($_POST['invtyp']!="")
{

$sql.=" and inv_img IS NULL ";
}


//echo "BBB" .$sql;

$table=mysqli_query($con1,$sql);
$count=0;
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

//echo $sql;
$qr22=$sql;
$sql.=" order by inv_date DESC LIMIT $Page_Start , $Per_Page";
 //echo $sql;
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
//echo mysqli_num_rows($table);
if(mysqli_num_rows($table)>0) {
	$i=0;
while($row= mysqli_fetch_row($table))
{
$pono=mysqli_query($con1,"select atmid,type from pending_installations where id='".$row[1]."'");
$pon=mysqli_fetch_row($pono);
	//echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where po='".$pon[0]."'";
    if($pon[1]=="AMC")
            $atm=mysqli_query($con1,"select bankname,atmid,cid,area,city,address,state,pincode from Amc where amcid='".$pon[0]."'");	
	else{
	//echo "select  bank_name,cid,area,city,address,state1 from atm where atm_id='".$row[1]."'";
	//echo "select  bank_name,atm_id,cust_id,area,city,address,state1 from atm where po='".$pon[0]."'";
	    $atm=mysqli_query($con1,"select  bank_name,atm_id,cust_id,area,city,address,state1,pincode from atm where track_id='".$pon[0]."'");
	}
	$atmdet=mysqli_fetch_row($atm);

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$atmdet[2]."'");
	$custrow=mysqli_fetch_row($qry);
	
	//$tab=mysqli_query($con1,"select * from po_assets where po_no='".$row[0]."'");	
	//$row1=mysqli_fetch_row($tab)
	//echo "eng stat".$row[15];
		?>
<tr>

<td  valign="top"><?php echo ++$i; ?></td>
<td  valign="top">&nbsp;<?php echo $row[2]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[4]; ?></td> 
<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atmdet[5]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atmdet[1]; ?></td>   
<td  valign="top">&nbsp;<?php echo $row[5]; ?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[6]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[7]; ?></td>
<td valign="top">&nbsp;<?php echo $row[8] ;?></td>

<td valign="top">&nbsp;<div id="deldiv<?php echo $row[0]; ?>" >
		<?php 
		//$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[14]."'");
		//$branch_name1=mysqli_fetch_row($branch_name);
		//echo  wordwrap($branch_name1[0],10,"<br />\n",TRUE); 
		if($_SESSION['designation']=="7")
		{
		
		if($row[9]=='0000-00-00'){ ?>
		<input type="text" name="del<?php echo $row[0]; ?>" id="del<?php echo $row[0]; ?>"  onclick="displayDatePicker('del<?php echo $row[0]; ?>');"  />
		<input type="button" name="delivery" value="delivery" onclick="setDelivery(<?php echo $row[0]; ?>)" />
		<?php }
		else
		{
		echo $row[9] ; 
		}
}
		else
		{
		if($row[9]=='0000-00-00')
		{
		echo "";
		}
		else
		{
		echo $row[9] ;
		}
		}
		 ?></div>
   </td>

<td valign="top">&nbsp;<div id="subdiv<?php echo $row[0]; ?>" >
<?php 
if($_SESSION['designation']=="7")
		{
if($row[10]=='0000-00-00'){ ?>
		<input type="text" name="sub<?php echo $row[0]; ?>" id="sub<?php echo $row[0]; ?>"  onclick="displayDatePicker('sub<?php echo $row[0]; ?>');"  />
		<input type="button" name="submission" value="submission" onclick="setSubmit(<?php echo $row[0]; ?>)" />
		<?php }
		else
		echo $row[10] ; 
}
else
{
if($row[9]=='0000-00-00')
		{
		echo "";
		}
		else
		{
		echo $row[10] ;
		}
}

 ?></div>

<td><?php echo $row[12];?></td>

<td>
<?php if($row[11]!=null ){ ?>
<a href="<?php echo $row[11]; ?>" target="_blank" ><image src="<?php echo $row[11]; ?>" alt="view invoice" width="50" height="50" /></a>
<?php } ?>
</td> 



<td>
<?php if($row[15]!=null or $row[15]!=''){ ?>
<a href="<?php echo $row[15]; ?>" target="_blank" >
<?php
$splt=explode(".",$row[15]);

echo $splt[1];

if(strtolower($splt[1])=="pdf")
{

?>
<a href="<?php echo $row[15]; ?> " download></a>
<?php
}
else{
?>
<image src="<?php echo $row[15]; ?>" alt="view credit note" width="50" height="50" /></a>
<?php } 
} ?>
</td>

<td><a href="javascript:void(0);" onclick="window.open('view_SO.php?id=<?php echo $row[1]; ?>&typ=2','view updates','width=700px,height=750,left=200,top=40')" class="update" >View Remarks</a></td>
<?php
}
?>
</tr>
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
<form name="frm" method="post" action="exportinvoices.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 

