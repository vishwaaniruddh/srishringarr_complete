<?php
session_start();  
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

$branch=$_POST['branch_avo'];

?>
<table width="105" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="callsummary" >
<?php 
 if($_POST['calltype']=='brsummary') { ?>
<tr>

<th rowspan="2" >Branch Name</th> 

<th colspan="2" width="40%" style="text-align:center">Service Call</th>
<th colspan="2" width="40%" style="text-align:center">Installation Call</th>

</tr>
<tr><th>Within ETA</th><th>Out of ETA</th><th>Within ETA</th><th>Out of ETA</th></tr>
<?php



$frm=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
$to=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));

 //echo date('d-m-Y ',strtotime($frm)); 
$d1 = new DateTime($frm);
$d2 = new DateTime($to);
$diff=$d1->diff($d2)->days; 

$incnt=0;$outcnt=0;	$incnt1=0;$outcnt1=0;		

		
$branch_=mysqli_query($con1,"select * from `avo_branch` ");

while($branch1=mysqli_fetch_array($branch_))
{
		$incnt=0;$outcnt=0;	$incnt1=0;$outcnt1=0;	
$qrybreta=mysqli_query($con1,"select alert_id,eta,responsetime, alert_type from alert where eta between '".$frm." 00:00:00' and '".$to." 23:59:59'  and branch_id='".$branch1[0]."' ");	//and responsetime between '".$frm." 00:00:00' and '".$to." 23:59:59'

//echo "select alert_id,eta,responsetime,alert_type from alert where eta between '".$frm." 00:00:00' and '".$to." 23:59:59'  and branch_id='".$branch1[0]."'";
while($fetchbr=mysqli_fetch_array($qrybreta))
{
if($fetchbr[3] == "new")
{
if($fetchbr[2] <= $fetchbr[1])
{
$incnt1++;
}
else
{
$outcnt++;
}
}
else
{
if($fetchbr[2] <= $fetchbr[1])
{
$incnt++;
}
else
{
$outcnt++;
}

}
}
				
				
				
		?>		
<tr>
<!--=== Branch name ===-->
<td  valign="top">&nbsp;<?php 
echo $branch1[1];
 ?></td>

<!--===Service Call===-->   
<td  valign="top"><?php echo $incnt;
 ?>
</td>
<td  valign="top"><?php echo $outcnt;
 ?>
</td>


<!--===Installation Call===-->   
<td  valign="top"><?php echo $incnt1; ?></td>
<td  valign="top"><?php echo $outcnt1; ?></td>


</tr>
<?php } ?>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php


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
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
//==============================customer wise========================================================
 }else{ ?>
<tr>
<th rowspan="2" ">Engineer Name</th> 
<th rowspan="2" ">Branch Name</th> 

<th colspan="2" width="35%" style="text-align:center">Service Call</th>
<th colspan="2" width="35%" style="text-align:center">Installation Call</th>

</tr>
<tr><th>Within ETA</th><th>Out of ETA</th><th>Within ETA</th><th>Out of ETA</th></tr>
<?php

 $sql ="SELECT engg_id,engg_name FROM `area_engg` where area='".$branch."' and deleted=0 and status=1";
 

$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>
 Records Per Page :<select name="perpg" id="perpg" onChange="searchById('Listing','1','perpg');">

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
$sql.=" LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);

 


$frm=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
$to=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));


//if(mysqli_num_rows($table)>0) {
	//$sn=1;
//$gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;
//if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')

$b1=$branch;
$startdt=$frm;

while($row= mysqli_fetch_array($table))
{$incnt=0;$outcnt=0;	$incnt1=0;$outcnt1=0;	
	$qryengid=mysqli_query($con1,"select alert_id from alert_delegation where engineer='".$row[0]."'");	

while($fetchengid=mysqli_fetch_array($qryengid))
{
//$frm=$startdt;
$qrybreta=mysqli_query($con1,"select alert_id,eta,responsetime,custdoctno from alert where eta between '".$frm." 00:00:00' and '".$to." 23:59:59' and  alert_id='".$fetchengid[0]."'");	

//echo "select alert_id,eta,responsetime,custdoctno from alert where eta between '".$frm." 00:00:00' and '".$to." 23:59:59' and responsetime between '".$frm." 00:00:00' and '".$to." 23:59:59'  and alert_id='".$fetchengid[0]."'";

while($fetchbr=mysqli_fetch_array($qrybreta))
{ //echo "hello";
if($fetchbr[3]=="New Installation Call")
{ 
if($fetchbr[2] <= $fetchbr[1])
{
$incnt1++;
}
else
{
$outcnt1++;
}
}
else
{
if($fetchbr[2] <= $fetchbr[1])
{
$incnt++;
//echo "Count".$incnt;
}
else
{
$outcnt++;
}
}
}
}
 ?>
<tr>
<td  valign="top">&nbsp;
<?php echo $row[1];
 ?>
</td>
<!--=== Branch name ===-->
<td  valign="top">&nbsp;<?php $branch = $b1; $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$branch."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];
 ?></td>

<!--===Service Call===-->   
<td  valign="top">&nbsp;
<?php echo $incnt;
 ?>
</td>
<td  valign="top">&nbsp;
<?php echo $outcnt;
 ?>
</td>


<!--===Installation Call===-->   
<td  valign="top">&nbsp;<?php echo $incnt1; ?></td>
<td  valign="top">&nbsp;<?php echo $outcnt1; ?></td>


</tr>

<?php

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
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
	 	 	 
	 }
 
?>
 <!--
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 -->
<div id="bg" class="popup_bg"> </div> 