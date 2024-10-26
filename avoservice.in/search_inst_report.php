<?php
session_start(); 
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
// echo "br=".$br=$_POST['branch'];
include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable" >

<tr>
<th width="10%">Complain ID</th> 
<th width="5%">Vertical Name</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">User Customer Name</th>
<th width="5%">City</th>
<th width="5%">Area</th>
<th width="10%">Address</th>


<th width="5%">AVO Branch</th>
<?php if($_SESSION['designation']!=4) { ?>
<th width="10%">Subject</th>
<th width="5%">Alert Date</th>
<th width="5%"> Delegated To</th>
<th width="5%"> e-FSR</th>  <? } ?>

<th width="5%">Call Close Date</th>
<th width="10%"> Last FeedBack</th>
<th width="5%">Status</th>
<th width="5%">IR copy </th>

</tr>
<?php

//======================================== Search Branch wise
$branch=$_POST['branch_avo'];
$br_id= $_POST['bravo'];

$sql.="Select * from alert where branch_id <>'' and close_date >= '2021-08-01 00:00:01'";

if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
  	{
   	$sql.=" and branch_id ='".$branch."' ";
  	} 
  	
 
if(isset($_POST['bravo']) && $_POST['bravo']!='all')
  	{
   	$sql.=" and branch_id in(".$br_id.") ";
  	} 

//echo $sql;  	
//===================================Closed Installation call=== 

$sql.=" and alert_type = 'new' and (call_status = 'Done' or status = 'Done') ";
//============Engineer ======
if(isset($_POST['engg']) && $_POST['engg']!='')
{
$engg_id=$_REQUEST['engg'];


$sql.=" and alert_id in (select alert_id from alert_delegation where engineer='".$engg_id."')";
//echo $sql;
    
}
if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '".$complaintno."%'";
}

if(isset($_POST['calltype']))
{
$calltype=$_REQUEST['calltype'];
if($calltype=='0')
$sql.=" and (manual_fsr='' or manual_fsr is NULL)";

elseif($calltype=='1')
$sql.=" and (manual_fsr !='' && manual_fsr !='NULL')" ;
}

//======================================Search Call Date wise
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];

$sql.=" and close_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
	}
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";

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

//======================================Search


//echo $sql;
$sqlr=$sql;

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

if(mysqli_num_rows($table)>0) {
include("config.php");
while($row= mysqli_fetch_row($table))
{
    
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
		?>

<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } if($row[31]!='0000-00-00 00:00:00' && $row[31]<=date('Y-m-d H:i:s') && $row[16]<>'Done'){ echo "style='background:red'"; } ?>>

<td  valign="top"><?php echo $row[25]; ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($custrow[0],10,"<br />\n",TRUE); ?></td>
<td valign="top"> <? $atmrow=mysqli_fetch_row($atm);
   			echo  $atmrow[0];  ?></td>


<td  valign="top">&nbsp;<?php echo wordwrap($row[3],6,"<br />\n",TRUE); ?></td>
<!--<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>-->
<td  valign="top">&nbsp;<?php echo wordwrap($row[6],5,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[4] ,7,"<br />\n",TRUE) ;?></td>

<td valign="top"><div height="50px" style="height:50px; overflow:hidden;"><?php  echo $row[5];
  ?></div></td>

<!--================Branch show here==================-->
<td ><?php 
$branch_name=mysqli_query($con1,"select `name` from `avo_branch` where `id`='".$row[7]."'");
$branch_name1=mysqli_fetch_row($branch_name);
echo  $branch_name1[0];  ?></td>


<?php 
//===========Engr Display block start======

if($_SESSION['designation']!=4) { ?>

<!---===============Problem/ Product Inst===============-->

<td width="200" valign="top" style="width:100px; overflow:hidden;"><?php echo $row[9]; ?></td>




<td valign="top">&nbsp;<?php echo date('d/m/Y h:i:s a',strtotime($row[10])); ?></td>

<td  valign="top">&nbsp;
<?php 
$fetchengid=mysqli_query($con1,"Select e.engg_name,e.phone_no1,e.engg_id from area_engg e,alert_delegation d where e.engg_id=d.engineer and alert_id='".$row[0]."' order by id DESC limit 1");
$getoldname=mysqli_fetch_row($fetchengid);
echo wordwrap($getoldname[0],30,"<br />\n",TRUE)."<br>".$getoldname[1];
  ?></td>
 
 <td>
<?   if($row[15]=='Done') {?>

	 <a href="avopdf/report2.php?aid=<?php echo $row[0]; ?>" target="_blank" >e-FSR </a>
	<?php } else echo "No FSR"; ?>
    
 </td>
 
 <?  } //======Engr block end ?>
 
 <!--- Close Date ================  -->
<td valign="top">&nbsp;<?php echo date('d/m/Y h:i:s a',strtotime($row[18])); ?></td>
 <!-- =============Last Update----------->
 
 <td valign="top">
<div height="150px" style="height:150px; overflow:hidden;">
<?php //if($row1[0]!=''){
//echo "select feedback,standby,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC";

if(mysqli_num_rows($tab)>0){
?>
<a href="javascript:void(0);" onclick="newwin('masteralert.php?id=<?php echo $row[0] ?>','display',700,700)" class="update">
<?php echo date('d/m/Y h:i:s a',strtotime($row1[2]))."<br>".wordwrap($row1[0],10,"<br />\n",TRUE); ?></a>
<?php
}
else
echo "No Updates so far";
?>
</div>
 </td>
 
 <td>
    <?php if($row[44]=='') { echo "No IR found";}
    else { echo " IR Available"; }?>

 </td>
 
 <td>
    <?php  if($row[44]== ''){
  ?>
    <button input type="button" style="color:blue; font:bold;" <a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('manual_fsr.php?id=<? echo $row[0];?>','upload','width=700px,height=500,left=300,top=100')" class="update">Attach IR</a></button>
 
       
    <? }  elseif ($row[44] != '') {?>
     <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="<?php echo $row[44]; ?>" target="_blank" <image src="<?php echo $row[44]; ?>.jpg" width="300" height="300" />View IR</a> </button>
   <br>
   <button input type="button" style="color:blue; font:bold;" <a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('manual_fsr.php?id=<? echo $row[0];?>','upload','width=700px,height=500,left=300,top=100')" class="update">Edit IR file</a></button>
    <?  }  ?>
 </td>
 
 
</tr>
<?php
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
} ?>

<form name="frm" method="post" action="export_ir_report.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $sqlr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>


<div id="bg" class="popup_bg"> </div> 