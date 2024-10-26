<?php
//include("access.php");
include("config.php");
session_start();
$strPage = $_REQUEST['Page'];
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$engg_id=$_POST['engg'];
$sdate=$_POST['fromdt'];
$edate=$_POST['todt'];
$branch=$_POST['branch_avo'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" id="custtable" >
<tr>
<th width="5%">Engineer Name</th>
<th width="5%">AVO Branch</th>
<th width="5%">Complain ID</th>
<th width="5%">Vertical</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">User Customer Name</th>
<th width="5%">City</th>
<th width="10%">Address</th>
<th width="5%">Problem</th>
<th width="5%">PM Done Date</th>
<th width="20%">Last FeedBack</th>

<th width="5%">Service Call Log Date</th>
<th width="5%">Call Ticket No</th>
<th width="5%">Problem Reported</th>

</tr>
<?php

 if(isset($_POST['fromdt']) && $_POST['fromdt']=='' || isset($_POST['todt']) && $_POST['todt']=='')
 {
     echo "Select Dates First"; die;
 } else


$result = "SELECT * FROM `alert` where alert_type='pm' and close_date between STR_TO_DATE('$sdate','%d/%m/%Y') and STR_TO_DATE('$edate','%d/%m/%Y') + INTERVAL 1 DAY and atm_id in( select atm_id from alert group by atm_id having COUNT(atm_id)>1 )";

//$result = "SELECT * FROM `alert` where alert_type='pm' and close_date between STR_TO_DATE('$sdate','%d/%m/%Y') and STR_TO_DATE('$edate','%d/%m/%Y') + INTERVAL 1 DAY ";

if(isset($_POST['branch_avo']) && $_POST['branch_avo']!='')
 {
$result .=" and branch_id ='".$branch."' ";
}
$trow=mysqli_query($con1,$result);

$count=0;
$Num_Rows = mysqli_num_rows ($trow);
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


$qr=$result;

$result.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $result;

$table=mysqli_query($con1,$result);
if(mysqli_num_rows($table) >0){
while($row = mysqli_fetch_row($table)){

$delqry=mysqli_query($con1,"SELECT engineer FROM `alert_delegation` where alert_id='".$row[0]."'");
$deleng=mysqli_fetch_row($delqry);

$engqry = "SELECT engg_id, engg_name FROM `area_engg` where engg_id='".$deleng[0]."'";

$engg_row=mysqli_query($con1,$engqry); 
$eng_idd=mysqli_fetch_row($engg_row);

	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	if ($row[21]=='site') {
	$atmid= mysqli_query($con1,"select select atm_id,latitude,longitude,address,city,state1 from atm where track_id='".$row[2]."'"); 
	    
	} else if ($row[21]=='amc') {
	$atmid= mysqli_query($con1,"select atmid,latitude1,longitude1,address,city,state from Amc where amcid='".$row[2]."'"); 
	}
	$atmdet=mysqli_fetch_row($atmid);
	$atm_id=$atmdet[0];
	
	if($atm_id=='') { $atm_id= $row[2]; }
	
	$tab=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
	
	$br= mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'"); 
	
	$branch=mysqli_fetch_row($br);
	

	
	?>
<tr>
<td> <?php echo $eng_idd[1]; ?></td>
<td valign="top">&nbsp;<?php echo $branch[0]; ?></td>

<td valign="top"><?php echo $row[25]; ?></td>
<td valign="top">&nbsp;<?php echo $custrow[0]; ?></td> <!-- Vertical Name-->
<td valign="top">&nbsp;<?php echo $atm_id ; ?></td>
<td valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td valign="top">&nbsp;<?php echo $row[6];?></td>
<td valign="top">&nbsp;<?php  echo $row[5]; ?></td>
<td valign="top">&nbsp;<?php echo $row[9] ?></td>
<td valign="top">&nbsp;<?php echo $row[10] ?></td>
<td valign="top">&nbsp;<?php echo $row1[0] ?></td> <!--- feedback--->



<?
	$serqry=mysqli_query($con1,"select entry_date, createdby,problem from alert where alert_type='service' and atm_id='".$row[2]."' and entry_date > '".$row[18]."' order by alert_id ASC");

if(mysqli_num_rows($serqry) > 0) {
$serrow=mysqli_fetch_row($serqry); 
?>
<td valign="top">&nbsp;<?php echo $serrow[0] ?></td>
<td valign="top">&nbsp;<?php echo $serrow[1] ?></td>
<td valign="top">&nbsp;<?php echo $serrow[2] ?></td>
<? } else { ?>
<td valign="top">No Calls</td>
<? } ?>
   
</tr>

<? } ?>
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
echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a>";
}

?>
</div>

<form name="frm" method="post" action="export_pmtoservice.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 
<div id="bg" class="popup_bg"> </div>
