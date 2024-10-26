<!--<link href="myfunction/style.css" rel="stylesheet" type="text/css">-->
<?php
include('config.php');

$id="";
$cid="";
$bank="";
$ticket="";
$area="";
$state="";
$pin="";
$sdate="";
$edate="";
$status="";
   

$strPage = $_REQUEST['Page'];
	//echo "Select * from alert where alert_type='new'";
$sql="Select * from alert where alert_type like '%temp%'";
//$sql="SELECT * FROM alert WHERE alert_id  NOT IN (SELECT alert_id FROM tempcall_status1)";

//$sql.="and alert_type like '%temp%'";

if(isset($_POST['status']) && $_POST['status']!='')
{
$sql.=" and alert_id  IN (SELECT alert_id FROM tempcall_status1)";
//echo $sql;
}

//==========search by ATM id======================================================
if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];

$sql.=" and atm_id LIKE '%".$id."%' ";
//echo $sql;
}

//echo $sql;


//==========search by customer id ======================================================
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and cust_id IN(select cust_id from customer where cust_name LIKE '%".$cid."%')";

}

	$sql.=" and (call_status = 'Done' or status = 'Done')";
	

//==========search by Bank======================================================
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}
//==========search by Area======================================================
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and address LIKE '%".$area."%'";
}
//==========search by City======================================================
if(isset($_POST['city']) && $_POST['city']!='')
{
$city=$_REQUEST['city'];
$sql.=" and address LIKE '%".$city."%'";
}

if(isset($_POST['ticket']) && $_POST['ticket']!='')
{
$ticket=$_REQUEST['ticket'];
$sql.=" and createdby LIKE '%".$ticket."%'";
}


//==========search by State======================================================
if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_REQUEST['state'];
//$sql.=" and state1 LIKE '%".$state."%'";
$sql.=" and branch_id ='".$state."'";
}
//echo $state;

//==========search by Date======================================================
if(isset($_POST['sdate']) && $_POST['sdate']!='' && isset($_POST['edate']) && $_POST['edate']!='')
{
$fromdt=$_REQUEST['sdate'];
$todt=$_REQUEST['edate'];

$sql.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}
$sql.=" and date(entry_date) >'2020-04-01'";

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
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $sql;

$table=mysqli_query($con1,$sql);

?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 
<tr>
<th width="75">SN</th>
<th width="77">Docket No</th>

<th width="75">Call Log Time</th>
<th width="75">ATM ID</th>
<th width="75">Customer</th>
<th width="75">Bank</th>
<!--<th width="75">Area</th>
<th width="75">City</th> -->
<th width="75">Branch</th>
<th width="75">Address</th>
<th width="70">Problem Reported</th>
<th width="75">Delegated To</th>
<th width="75">Approved By</th>
<th width="75">Approval Remarks</th>
<th width="75">Closing Date-Time</th>
<th width="75">Update</th>
<th width="75">Call Type</th>
<th width="75">Tempcall Reason</th>
<th width="75">Remarks</th> 
<th width="75">Submit</th>

</tr>

<?php
$i=1;

if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{
	




	$qry2me=mysqli_query($con1,"Select * from site_assets where atmid = '".$row[0]."' ");
    $tab=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$row[0]."' order by id DESC");
	$row1=mysqli_fetch_row($tab);



?><div align="center">

<tr>
<td width="77"><?php echo $i++; ?></td>
<!---Doct No-->
<td width="77"><?php echo $row[25]; ?></td>

<!--call log date and time--->
<td width="200"><?php echo $row[10]; ?></td>
<!---temp_atm id-->
<td width="95"><?php echo $row[2]; ?></td>

<!---customer-->
<td width="95"><?php 
$custname=mysqli_query($con1,"select `cust_name` from `customer` where `cust_id`='".$row[1]."'");
$custname1=mysqli_fetch_row($custname);
echo $custname1[0];
 ?></td>
<!---bank-->
<td width="95"><?php echo $row[3]; ?></td>
<!--Area
<td width="70"><?php echo $row[4]; ?></td> -->
<!---City
<td width="70"><?php echo $row[6]; ?></td> -->
<!---state-->
<td width="70">
<?php 
$branch=mysqli_query($con1,"select * from avo_branch where id='".$row[7]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1]; ?></td>
<!---address-->
<td width="70"><?php echo $row[5]; ?></td>


<!---assets-->

<td width="70"><?php echo $row[9]; ?></td>

 <!---Delegate To eng name -->
<td width="95"> 
 <?php 
$oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."'");
$getold=mysqli_fetch_row($oldeng);
$fetchengid=mysqli_query($con1,"Select `engg_name`,`phone_no1` from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);
echo ucfirst($getoldname[0]);
echo "<br>";
echo $getoldname[1];  ?>
</td>
<!---Approver Name-->
<td width="75"><?php echo $row[22];?></td>

<!---App Remarks-->
<td width="75"><?php echo $row[23];?></td>
 
 <!---closing date and time-->

<td width="95">
<?php if(isset($row[18]) and $row[18]!='0000-00-00 00:00:00') echo wordwrap(date('d/m/Y h:i a',strtotime($row[18])),8,"<br />\n",TRUE); ?> </td>
<!---update-->
<td width="75">
<?php 
$al=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");
$alro=mysqli_fetch_row($al);
echo $alro[0];
  ?>
</td>
<!---call Type=====================-->
<td width="95"><?php 
if($row[17]=='new temp') 
echo "Service";
elseif($row[17]=='temp_dere')
echo "Reinstall";
elseif($row[17]=='temp_pm') 
echo "PM"; ?></td>

<?php
$db=mysqli_query($con1,"select * from tempcall_status1 where alert_id='".$row[0]."' ");
$erow=mysqli_fetch_row($db);

?>


<div id="subdiv<?php echo $row[0]; ?>" >

<td> 
<?php if($erow[2]==''){ ?>
    
    
   	
    <select name="reason<?php echo $row[0]; ?>" id="reason<?php echo $row[0]; ?>" value=<?php echo $erow[2]; ?> >

        <option value=""> Select </option>
        <option value="Chargeable">Chargeable </option>
        <option value="Goodwill">Goodwill</option>
        <option value="Add on AMC">Add on AMC </option>
        <option value="Warranty Issue">Warranty Issue</option>

</select>
	
<?php }else{ echo $erow[2];} ?>


</td>
    
<td>
 <?php if($erow[3]==''){ ?>     
 
<input type="text" name="remarks<?php echo $row[0]; ?>" id="remarks<?php echo $row[0]; ?>"  />
                
 <?php }else{ echo $erow[3];} ?>               
                </td>

<td>		
<?php if($erow[2]==''){ ?>

		<input type="button" name="submission" value="submit" onclick="setSubmit(<?php echo $row[0]; ?>)" />
<?php } ?> 

</td>	
</div>

	







</tr></div><?php

}

?></table>
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

<form name="frm" method="post" action="export_tempcall.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
