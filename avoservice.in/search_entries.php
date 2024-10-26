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
<th width="10%">S.No</th> 
<th width="5%">Customer / Party Name</th>
<th width="5%">Agent Name</th>
<th width="5%">Material</th>
<th width="5%">Qty</th>
<th width="5%">Actual Qty</th>
<th width="10%">PI/ SO No</th>


<th width="5%">Booking date</th>
<th width="10%">Invoice </th>
<th width="5%">Rate</th>
<th width="5%"> Delivery Terms</th>
<th width="5%"> Name of the Port</th> 

<th width="5%">Factory</th>
<th width="10%"> Payment Term</th>
<th width="5%">BL No</th>
<th width="5%">Loading Date </th>

<th width="5%">Vessel Date </th>
<th width="5%">ETA </th>
<th width="5%">Special terms </th>
<th width="5%">Status </th>
<th width="10%">Doc Status </th>
<th width="5%">Action</th>

</tr>
<?php

$sql.="Select * from factory_entries where 1";

if(isset($_POST['factory']) && $_POST['factory']!='') {
    $fact=$_POST['factory'];
 $sql.=" and factory='".$fact."'";    
}

if(isset($_POST['cust']) && $_POST['cust']!='') {
    $cust=$_POST['cust'];
 $sql.=" and cust_id='".$cust."'";    
}

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		$fromdt=$_POST['fromdt'];
		$todt=$_POST['todt'];

$sql.=" and bookdate Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
	}

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
$sql.=" order by id DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;

$table=mysqli_query($con1,$sql);

if(mysqli_num_rows($table)>0) {
include("config.php");
while($row= mysqli_fetch_row($table)) {

$id=$row[0];

$count++;
$agentqry=mysqli_query($con1,"select * from agents where id='".$row[2]."'");
$agent=mysqli_fetch_row($agentqry);

$prtqry=mysqli_query($con1,"select * from parties where id='".$row[1]."'");
$party=mysqli_fetch_row($prtqry);

?>    

<tr>
<td  valign="top"><?php echo $count; ?></td>
<td  valign="top"><?php echo $party[1]; ?></td>
<td  valign="top"><?php echo $agent[1]; ?></td>

<td  valign="top"><?php echo "Material"; ?></td>

<td  valign="top"><?php echo $row[4]; ?></td>
<td  valign="top"><?php echo $row[5]; ?></td>
<td  valign="top"><?php echo $row[6]; ?></td>
<td  valign="top"><?php echo $row[7]; ?></td>
<td  valign="top"><?php echo $row[8]; ?></td>
<td  valign="top"><?php echo $row[9]; ?></td>
<td  valign="top"><?php echo $row[10]; ?></td>
<td  valign="top"><?php echo $row[11]; ?></td>

<td  valign="top"><?php echo $row[12]; ?></td>
<td  valign="top"><?php echo $row[13]; ?></td>
<td  valign="top"><?php echo $row[14]; ?></td>
<td  valign="top"><?php echo $row[15]; ?></td>
<td  valign="top"><?php echo $row[16]; ?></td>

<td  valign="top"><?php echo $row[17]; ?></td>
<td  valign="top"><?php echo $row[18]; ?></td>

<td  valign="top"><?php echo $row[19]; ?></td>

<!--<div id="subdiv<?php echo $id; ?>" >
<td valign="top">
    
<select name="reason<?php echo $id; ?>" id="reason<?php echo $id; ?>" >

    <option value="<?php echo $row[19]; ?>"> <?php echo $row[19]; ?></option>
    <option value="1">Yes </option>
    <option value="-1">Not Available </option>
        
</select></td> -->


<td  valign="top"><?php echo $row[20]; ?></td>

<td width="47" height="31" style="color:#AFA;"> <a href='edit_entry.php?id=<?php echo $row[0]; ?>' ><font color="yellow">Edit </font></a></td>
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