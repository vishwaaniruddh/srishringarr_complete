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
<th width="5%">Vertical Customer</th>
<th width="5%">End User Name</th>
<th width="5%">Address</th>
<th width="5%">Branch</th>
<th width="5%">Site/Sol/ATM ID</th>
<th width="5%">Credit Note No</th> 
<th width="5%">Credit Note Date</th>
<th width="5%">Credit Note Amount</th>
<th width="5%">Courier</th>
<th width="5%">Docket No.</th>
<th width="5%">Estimated Delivery Date</th>
<th width="5%">Dispatch Date</th>
<th width="5%">Delivery Date</th>

<th width="5%">Invoice Submission Date</th>
<th width="5%">Invoice Copy</th>
<th width="5%">Credit Note Copy</th>
<th width="5%">Edit</th>
<th width="5%">View SO</th>
<th width="5%">View Remarks</th>
<th width="5%">Add Remarks</th>

<?php
function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}
if($_SESSION['designation']=="7")
{

?>
<th>Generate Calls</th>


<th>Options</th>
<?php } ?>
<th>Call Docket No.</th>
<th>Call Status</th>
<th>SO Date and time</th>
<th>Invoice Upload time</th>
<th>Engineer name and No.</th>
<th >Last Update</th>
<th>Last Update Date</th>
<th>Asset Details</th>
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

}//echo "hh:".$_POST['invno'];

if(isset($_POST['invno']) && $_POST['invno']!=''){
		$invno=$_POST['invno'];		
	//echo "hh:".$invno;
			//$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			//$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and inv_no like'%".$invno."%'";
	
	
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}


if(isset($_POST['crnno']) && $_POST['crnno']!=''){
		$crnno=$_POST['crnno'];		
	
			//$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
			//$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));
			$sql.=" and crn_no='".$crnno."'";
	
}

               if($_POST['del_date']=='pending')
                  $sql.=" and del_date='0000-00-00'";
               else if($_POST['del_date']=='completed')
                  $sql.=" and del_date!='0000-00-00'";
               
               if($_POST['sub_date']=='pending')
                  $sql.=" and sub_date='0000-00-00'";
               else if($_POST['sub_date']=='completed')
                  $sql.=" and sub_date!='0000-00-00'";
//echo $sql;

if($_POST['invtyp']!="")
{

$sql.=" and inv_img IS NULL ";
}

if($_POST['sostats']!="")
{

$sql.=" and status='".$_POST['sostats']."'";
}
$sql2="select * from so_cancel_hold_track_new where status='".$_POST['sostats']."'";
$runsql2=mysqli_query($con1,$sql2);
$blqnckrow=mysqli_fetch_array($runsql2);

//echo "ram".$sql;
//echo $sql2;
$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows;
  ?></b>
<!-- Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">

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
 </select>-->
 
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
$sql.=" order by inv_date DESC ";//LIMIT $Page_Start , $Per_Page";
// echo $sql;
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
$pono=mysqli_query($con1,"select atmid,type,alert_id,cust_id,id,status,entry_date from pending_installations where id='".$row[1]."'");
$pon=mysqli_fetch_row($pono);
	//echo "select bankname,atmid,cid,area,city,address,state,pincode from Amc where po='".$pon[0]."'";
	if($pon[1]=="AMC")
{
$nm="select bankname,atmid,cid,area,city,address,state,pincode,branch from Amc where amcid='".$pon[0]."'";


            $atm=mysqli_query($con1,$nm);	
}
	else{
	//echo "select  bank_name,cid,area,city,address,state1 from atm where atm_id='".$row[1]."'";
	//echo "select  bank_name,atm_id,cust_id,area,city,address,state1 from atm where po='".$pon[0]."'";
$nm="select  bank_name,atm_id,cust_id,area,city,address,state1,pincode,branch_id from atm where track_id='".$pon[0]."'";
	    $atm=mysqli_query($con1,$nm);
	

}
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
        $flag=-1;
        if($pon[5]=="2"){
        $qryx=mysqli_query($con1,"select status,call_status from alert where alert_id='".$pon[2]."'");
        $qryrx=mysqli_fetch_row($qryx);
        if($qryrx[0]=="Done" or $qryrx[1]=="Done")
            $flag=1;
        else
            $flag=0;
        }
        $td=date('Y-m-d');
       
        $nod=dateDifference($row[3],$td);
if($nod>4 and $flag!=1){ //echo $nod;
		?>
<tr style="background-color:red">
<?php }else{ ?>
<tr>
<?php } ?>

<td  valign="top"><?php echo ++$i; ?></td>
<td  valign="top">&nbsp;<?php echo $row[2]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[4]; ?></td> 
<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td>
<td  valign="top">&nbsp;<?php echo $atmdet[0]; ?></td>  
<td  valign="top">&nbsp;<?php echo $atmdet[5]; ?></td> 
<td  valign="top">&nbsp;<?php echo $brrow[0]; ?></td> 
<td  valign="top">&nbsp;<?php echo $atmdet[1]; ?></td> 
<td  valign="top">&nbsp;<?php echo $row[12]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[13]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[14]; ?></td>   
<td  valign="top">&nbsp;<?php echo $row[5]; ?></td>
<td width="71" valign="top">&nbsp;<?php echo $row[6]; ?></td>
<td  valign="top">&nbsp;<?php echo $row[7]; ?></td>
<td valign="top">&nbsp;<?php echo $row[8] ;?></td>

<td valign="top">&nbsp;<div id="deldiv<?php echo $row[0]; ?>" >
<?php
if($row[9]!='0000-00-00'){ 
echo $row[9];
}?>

		<?php 
		//$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[14]."'");
		//$branch_name1=mysqli_fetch_row($branch_name);
		//echo  wordwrap($branch_name1[0],10,"<br />\n",TRUE); 
		/*if($row[9]=='0000-00-00'){ ?>
		<input type="text" name="del<?php echo $row[0]; ?>" id="del<?php echo $row[0]; ?>"  onclick="displayDatePicker('del<?php echo $row[0]; ?>');"  />
		<input type="button" name="delivery" value="delivery" onclick="setDelivery(<?php echo $row[0]; ?>)" />
		<?php }
		else{
*/
/*		//echo $row[9] ; 
 ?>

<input type="text" name="del<?php echo $row[0]; ?>" id="del<?php echo $row[0]; ?>"  onclick="displayDatePicker('del<?php echo $row[0]; ?>');" value="<?php echo $row[9]; ?>" readonly/>
		<input type="button" name="delivery" value="Update" onclick="setDelivery(<?php echo $row[0]; ?>)" />

<?php

 }*/ ?>
</div>
   </td>

<td valign="top">&nbsp;<div id="subdiv<?php echo $row[0]; ?>" >
<?php if($row[10]=='0000-00-00'){ ?>
		<input type="text" name="sub<?php echo $row[0]; ?>" id="sub<?php echo $row[0]; ?>"  onclick="displayDatePicker('sub<?php echo $row[0]; ?>');"  />
		<input type="button" name="submission" value="submission" onclick="setSubmit(<?php echo $row[0]; ?>)" />
		<?php }
		else{
		  ?>

<input type="text" name="sub<?php echo $row[0]; ?>" id="sub<?php echo $row[0]; ?>"  onclick="displayDatePicker('sub<?php echo $row[0]; ?>');"  value="<?php echo $row[10]; ?>"/>
		<input type="button" name="submission" value="Update" onclick="setSubmit(<?php echo $row[0]; ?>)" />
<?php } ?>
</div>
		</td>
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
<td><a href="javascript:void(0);" onclick='window.open("edit_inv.php?id=<?php echo $row[0]; ?>","_blank");'>EDIT</a></td>
<td><a href="view_sodetails.php?id=<?php echo $row[1]; ?>" >VIEW SO</a></td>

<td><a href="javascript:void(0);" onclick="window.open('view_SO.php?id=<?php echo $row[1]; ?>&typ=2','view updates','width=700px,height=750,left=200,top=40')" class="update" >View Remarks</a></td>


<td><a href="javascript:void(0);" onclick="window.open('update_generateSO.php?id=<?php echo $row[1]?>&typ=2','Update_generateSO','width=700px,height=750,left=200,top=40')" class="update" >Add Remarks</a></td>


<?php
if($_SESSION['designation']=="7" )
{

?>
<td width="53" height="31">

<?php



if($pon[5]==0)
{
echo "Waiting for SO";
}
else { 

if($row[16]=="")/*******************if so is not canceld or on hold**************************/
{
if($row[9]!="0000-00-00" && $row[16]=="")/**********if delivery date is there and status in not cancelled or on hold*************************/
{

if($row[17]=="0") /************if installation call is not cancelled******************/
{
if($pon[5]!="2")/****************if call is not generated*************************/
{
?>
<a href="javascript:confirm_generate('<?php echo $pon[3]; ?>','<?php echo $atmdet[1]; ?>','<?php echo $pon[0]; ?>','<?php echo $pon[4]; ?>');" > Generate Call</a></br>
<?php echo "------------";?></br>
<a href="javascript:cancelinstallationcallfunc('<?php echo $row[0]; ?>');" > Cancel Installation </a>
<?php
}else
{
echo "Call is generated";
}
if($row[9]=="0000-00-00" && $pon[5]=="2")/**********if delivery date is not there and call is generated*************************/
{
 echo "Call is generated";
}
}else
{
echo "Call Cancelled";
}
}
}
 } ?>
</td>

<td>



<?php if($row[16]!="" )
{

$getchdets=mysqli_query($con1,"select * from so_cancel_hold_track_new where so_id='".$row[0]."' and so_status='".$row[16]."' order by id desc");
$frchrws=mysqli_fetch_array($getchdets);
echo "Reason: ".$frchrws[6]."<br>";
}


?>


<?php 

if($pon[5]!="2" && $row[17]=="0")/*******************if call is not generated and not cancelled*********************/
{
if($row[16]=="c")/*******************if so is cancelled*********************/
{
//echo "Cancelled";
}
else
{
?>
<button type="button" id="canc" name="canc" onclick='processsofunc("<?php echo $row[0];?>","c");'>Cancel</button>
<?php 
if($row[16]=="")
{
?>
<button type="button" id="hold" name="hold" onclick='processsofunc("<?php echo $blqnckrow[0];?>","h");'>Hold</button></td>
<?php 
}
else if($row[16]=="h")
{
?>
<button type="button" id="hold" name="hold" onclick='processsofunc("<?php echo $row[0];?>","");'>Unhold</button></td>

<?php
}
 } ?>
<?php } 
 }
 ?>
<td>
<?php
if($pon[5]=="2"){
$qry=mysqli_query($con1,"select createdby,status,call_status from alert where alert_id='".$pon[2]."'");
$qryr=mysqli_fetch_row($qry);
echo $qryr[0];
}
?>
</td>
<td>
<?php
if($pon[5]=="2"){
if($qryr[1]=="Done" or $qryr[2]=="Done")echo "Closed";
else if($qryr[1]=="Delegated")echo "Delegated";
else if($qryr[1]=="Pending")echo "Not Delegated";

}
?>
</td>
<td><?php echo $pon[6]; ?></td>
<td><?php if($row[18]!="0000-00-00 00:00:00")echo $row[18]; ?></td>
<td><?php 
if($pon[5]=="2"){
$qry=mysqli_query($con1,"select a.engg_name,a.phone_no1 from area_engg a,alert_delegation b where a.engg_id=b.engineer and b.alert_id='".$pon[2]."'");
$qryr=mysqli_fetch_row($qry);
echo $qryr[0].'-'.$qryr[1];
}
?>
</td>
<td style="display: inline-block;width:250px"><?php 
if($pon[5]=="2"){
$qry=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$pon[2]."' order by id desc limit 1");
$qryr=mysqli_fetch_row($qry);
echo $qryr[0];
}
?>
</td>
<td><?php echo $qryr[1];?></td>
<!--====================== by anand================-->
<td style="display: inline-block;width:250px">

<?php
$qrytrackid=mysqli_query($con1,"SELECT track_id FROM  `atm` WHERE  `atm_id`='".$atmdet[1]."'");
$fetch_trackid=mysqli_fetch_row($qrytrackid);

$qrypending_installations=mysqli_query($con1,"SELECT type,atmid FROM  `pending_installations` WHERE  `atmid` ='".$fetch_trackid[0]."'");
$fetch_qrypending_installations=mysqli_fetch_row($qrypending_installations);

$datafetch= $fetch_qrypending_installations[0];


if($datafetch=='sales'){
$flag='atm';
//$sqltest="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atm_id from pending_installations a,atm b where a.status=0 and a.type='sales' and a.del_type='site_del'and a.atmid='$fetch_qrypending_installations[1]'  and a.atmid=b.track_id";
$sqltest="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atm_id from pending_installations a,atm b where  a.del_type='site_del'and a.type='sales' and a.atmid='$fetch_qrypending_installations[1]'  and a.atmid=b.track_id";

}
else
{
$flag='amc';

//$sqltest="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atmid from pending_installations a,Amc b where a.status=0 and a.type='AMC' and a.del_type='site_del'  and a.atmid=b.amcid";
$sqltest="select a.atmid,a.po,a.cust_id,a.req_date,a.DNo,a.del_type,a.type,a.ed,a.id,a.contactperson,a.contactno,a.BB_Details,a.bbdrate,a.createdby,a.entry_date,b.atmid from pending_installations a,Amc b where  a.del_type='site_del' and a.atmid='$fetch_qrypending_installations[1]'  and a.atmid=b.amcid";

}
//echo $sqltest;
$tabletest=mysqli_query($con1,$sqltest);

while($rowtest= mysqli_fetch_row($tabletest)){


if($flag=="amc"){
  // $tab=mysqli_query($con1,"select assetspecid,quantity,rate,buyback from amcassets where assets_name='UPS' and callid='".$rowtest[8]."'");	
	
  $tab=mysqli_query($con1,"select assetspecid,quantity,rate,assets_name,buyback from amcassets where callid='".$rowtest[8]."'");	
	}
else{
   // $tab=mysqli_query($con1,"select assets_spec,quantity,rate from site_assets where po='".$rowtest[1]."' and assets_name='UPS' and callid='".$rowtest[8]."'");	

    $tab=mysqli_query($con1,"select assets_spec,quantity,rate,assets_name from site_assets where po='".$rowtest[1]."'  and callid='".$rowtest[8]."'");	
	//$rowtest1=mysqli_fetch_row($tab);
	//$qrytest=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$rowtest1[0]."'");	
	//$rowe=mysqli_fetch_row($qrytest);
	//$bb=0;
}

while($rowtest1=mysqli_fetch_array($tab)){
$qrytest=mysqli_query($con1,"select name from assets_specification where ass_spc_id='".$rowtest1[0]."'");	

$rowe=mysqli_fetch_row($qrytest);


echo $rowtest1[3].' , '; 
echo $rowe[0].' , ';
echo $rowtest1[1] .' , '; 
echo $rowtest1[2];
//echo $bb; ?></br><?

}

}

?>
</td>
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

 
<form name="frm" method="post" action="exportinvoices.php" target="_new">
<input type="hidden" name="cid" value="<?php echo $_POST['cid']; ?>" readonly>
<input type="hidden" name="branch_avo" value="<?php echo $_POST['branch_avo']; ?>" readonly>
<input type="hidden" name="atmid" value="<?php echo $_POST['atmid']; ?>" readonly>
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>

<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
<div id="bg" class="popup_bg"> </div> 