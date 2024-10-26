<?php
session_start(); 
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
<th width="10%">Complain ID</th> 
<th width="5%">Client Docket Number</th> 
<th width="5%">Name</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">User Customer Name</th>
<th width="5%">City</th>
<th width="5%">Area</th>
<th width="25%">Address</th>
<!--<th width="5%">State</th>-->
<th width="5%">AVO Branch</th>
<th width="10%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%">Contact Person</th>
<th width="5%"> Phone</th>

<th width="5%"> Call Type</th>

<th width="5%"> Customer Status</th>
<th width="5%"> Delegate To</th>
<!--<th width="7%">Update</th> -->

</tr>
<?php

//======================================== Search Branch wise

//$sql= "Select * from alert where alert_id not in (select alert_id from alert_delegation)"; 
$sql= "Select * from alert where branch_id<>'' and (call_status = 'Pending' or call_status='1' ) and alert_id not in (select alert_id from alert_delegation ) " ;




if($_POST['bravo']=='all')
	{
 	if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='') { 
 	    
 	    $stt=$_POST['branch_avo'];

$sql.=" and branch_id ='".$stt."' ";
  	}} else {


  	$br1= $_POST['bravo'];
$sql.=" and branch_id ='".$br1."' ";
 	
} 

if(isset($_POST['openall']))
{

$calltype=$_REQUEST['openall'];
if($calltype=='')
{
}
elseif($calltype=='all')
{
}

elseif($calltype=='install')
$sql.=" and (alert_type = 'new')";

elseif($calltype=='service')
$sql.=" and (alert_type = 'service' or `alert_type`='new temp')";

elseif($calltype=='pm')
$sql.=" and (alert_type = 'pm' or `alert_type`='temp_pm')";

elseif($calltype=='dere')
$sql.=" and (`alert_type`='dere' or `alert_type`='temp_dere') ";


}

//======================================Search Call Date wise
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];

$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
	}


//======================================Search ATM ID Wise
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];

$sql.=" and (((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') and assetstatus='site') or (atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%' and assetstatus='amc') ))";
$sql.=" or atm_id LIKE '%".$id."%' ) ";
}
//======================================Search 
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}
 //======================================Search
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}



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


$qr22=$sql;
$sql.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);
//===========If no Records redirect to View Alert========

 $row = mysqli_fetch_row($table);

if(!empty($row)) {
         do {



//if (!empty($table)) {    

//while($row= mysqli_fetch_row($table))
//{
      
//======ATM ID========
	if($row[21] ==  'amc' || $row[21] ==  'AMC')
   { 	$atm=mysqli_query($con1,"select atmid,cat from Amc where amcid='".$row[2]."'");
     
   }
	elseif($row[21] == 'site')
	{
	$atm=mysqli_query($con1,"select atm_id,cat from atm where track_id='".$row[2]."'");
	if(mysqli_num_rows($atm)==0)
	$atm=mysqli_query($con1,"select atmid,cat from Amc where amcid='".$row[2]."'");
	}
//=========Customer Name=======	
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);

		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } if($row[31]!='0000-00-00 00:00:00' && $row[31]<=date('Y-m-d H:i:s') && $row[16]<>'Done'){ echo "style='background:red'"; } ?>>


<td  valign="top"><?php echo $row[25]; ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[30],8,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($custrow[0],10,"<br />\n",TRUE); ?></td>

<td  valign="top">&nbsp;
	<?php // echo $row[17]." ".$row[2];
  	
  	if($row[17]=='new temp' || $row[17]=='temp_pm' || $row[17]=='temp_dere' ){ echo $row[2];
		
		}else{  
  			$atmrow=mysqli_fetch_row($atm);
   			echo  wordwrap($atmrow[0] ,40,"<br />\n",TRUE);  }?></td>
  
<td  valign="top">&nbsp;<?php echo wordwrap($row[3],6,"<br />\n",TRUE); ?></td>
<!--<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>-->
<td  valign="top">&nbsp;<?php echo wordwrap($row[6],5,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[4] ,7,"<br />\n",TRUE) ;?></td>

<td  valign="top"><div width="50px" style="width:150px;" > &nbsp;<?php echo wordwrap($row[5],40,"<br />\n",TRUE); ?>  </div></td>
<!--<td valign="top"> &nbsp;<div height="100px" style="height:50px; overflow:hidden;"><?php  //$brtxt= preg_replace("/[^\p{Latin} ]/u", "", $row[5]);
 //echo  $brtxt1=wordwrap($brtxt ,10,"<br />\n",TRUE);
 echo $row[5];
  ?></div></td>  -->


<!--================Branch show here==================-->
<td ><?php 
$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[7]."'");
$branch_name1=mysqli_fetch_row($branch_name);
echo  wordwrap($branch_name1[0],10,"<br />\n",TRUE);  ?></td>

<!---==========Problem====================-->

<td  valign="top"><div width="50px" style="width:150px;" > &nbsp;<?php echo wordwrap($row[9],25,"<br />\n",TRUE); ?>  </div></td>

<td  valign="top">&nbsp;<?php echo $row[10]; ?></td>

<!---==========Contact Details====================-->

<td  valign="top">&nbsp;<?php echo wordwrap($row[12],8,"<br />\n",TRUE); ?></td>

<td  valign="top">&nbsp;<?php echo $row[13] ?></td>



  <td  valign="top">&nbsp;<?php 
  
  if($row[17]=='service' || $row[17]=='new temp') echo "Service Call";
  
   if($row[17]=='new' ) echo "Installation";
   if($row[17]=='dere' || $row[17]=='temp_dere') echo "Reinstall Call";
   if($row[17]=='pm' || $row[17]=='temp_pm') echo "PM Call";
 ?>

 </td>
     

<td  valign="top">&nbsp;<?php 
  
  if($row[21]=='amc' || $row[21]=='AMC') echo "AMC Site";
  
  else if($row[21]=='site' ) echo "Warranty Site";
   
   else  echo "Temporary Site";
  
 ?>

 <td>

 <a href="delegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $_POST['bravo']; ?>&state=<?php echo $row[7]; ?>"><font color="#000066" size="+1">Delegate</font></a>

  	<br />
   <a href="javascript:void(0);" onclick="newwin('calltransfer.php?id=<?php echo $row[0] ?>','transfer',700,700)" class="update">
	Transfer
	<?php if(mysqli_num_rows($qr)>0){ 
		$qrro=mysqli_fetch_row($qr);
		echo " Failed<br>Reason :".$qrro[6]; }  ?></a>

 
 </td>
 
<!-- <td>

  <a href="javascript:void(0);" onclick="newwin('call_update.php?id=<?php echo $row[0] ?>&br=<?php echo $br?>&ctype=<?php echo $row[17] ?>&alerts_id=<?php echo $row[0] ?>&eng_id=<?php echo $getoldname[2] ?>','display',600,600)" class="update"> <font size="+1">Update</font></a> 
 
 </td> -->

</tr>
<?php
}    
 while($row=mysqli_fetch_array($table));   
    
} else {
    

echo " Hi DBBB" ;

  //  echo "<script>location.href='view_alert.php';</script>";
//header('Location: view_alert.php');
header("Location: view_alert.php");
exit();
    
    
    
    
}
?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


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
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>
 
<div id="bg" class="popup_bg"> </div> 