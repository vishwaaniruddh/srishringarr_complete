<?php
session_start();
$_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection

$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class=""  id="call_summary" >

<tr>

<th rowspan="2" width="10%">Branch Name</th> 
<th colspan="4" style="text-align:center">Database</th>
<th colspan="4" style="text-align:center">Temporary Call</th>
<th colspan="4" style="text-align:center">New Inst</th>

</tr>

<tr>
<th width="10%" style="text-align:center"> GPS </th>
<th width="10%" style="text-align:center"> History</th>
<th width="10%" style="text-align:center"> Mapped</th> 
<th width="10%" style="text-align:center"> Manual</th>

<th width="10%" style="text-align:center"> GPS </th>
<!--<th width="10%" style="text-align:center"> History</th>
<th width="10%" style="text-align:center"> Mapped</th> 
<th width="10%" style="text-align:center"> Manual</th>

<th width="10%" style="text-align:center"> GPS </th>
<th width="10%" style="text-align:center"> History</th>
<th width="10%" style="text-align:center"> Mapped</th> 
<th width="10%" style="text-align:center"> Manual</th> -->


</tr>


<?php
 $sql.="Select distinct(branch_id) from alert where branch_id <>'' ";
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

;
$qr22=$sql;
$sql.=" group by `branch_id` LIMIT $Page_Start , $Per_Page";

$table=mysqli_query($con1,$sql);
	$fromdt=$_POST['fromdt'];
				$todt=$_POST['todt'];


if(mysqli_num_rows($table)>0) {
	$sn=1;
 $gt1=0;$gt2=0;$gt3=0;$gt4=0;$gt5=0;$gt6=0;$gt7=0;$gt8=0;$gt9=0;

while($row= mysqli_fetch_row($table)) {		
 $dball=0; $dbgps=0;  $dbhis=0;$dbmap=0; $dbno=0; 
 
 $str="SELECT alert_id FROM `alert` where branch_id='".$row[0]."' and  alert_type in ('service', 'pm', 'dere') and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

//$str="SELECT alert_id FROM `alert` where branch_id='".$row[0]."' and  alert_type  NOT in ('service', 'pm', 'dere', 'new') and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

//$str="SELECT alert_id FROM `alert` where branch_id='".$row[0]."' and  alert_type  in ('new') and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY ";

//echo $str;

	$dbqry=mysqli_query($con1,$str);
	$dball=mysqli_num_rows($dbqry);

while($dbrow=mysqli_fetch_row($dbqry)) {
	    $dbdelqry="select del_type from Delegation_tracking where alertid='".$dbrow[0]."'";
//echo $dbdelqry;	    
	    $dbdelqr=mysqli_query($con1,$dbdelqry);
	    
	while($dbres=mysqli_fetch_row($dbdelqr)) {
	  	$dbc=$dbres[0];
	  	
	  	if($dbc==1) $dbgps++;
		else if($dbc==2)$dbhis++;
		else if($dbc==3)$dbmap++;
		
	//	$dbno=$dball-($dbgps+$dbhis+$dbmap) ;

}
}

$dbno=$dball-($dbgps+$dbhis+$dbmap) ;
?>	
<tr>
<!--===SN===-->
<td  valign="top"><?php $branch=mysqli_query($con1,"select * from `avo_branch` where id='".$row[0]."'");
$branch1=mysqli_fetch_row($branch);
echo $branch1[1];  ?></td>

<td  valign="top"> <?php $gt1+=$dbgps;echo $dbgps; ?></td>
<td  valign="top"><?php $gt2+=$dbhis; echo $dbhis;  ?></td>
<td  valign="top"><?php $gt3+=$dbmap; echo $dbmap; ?></td>
<td  valign="top"><?php $gt4+=$dbno; echo $dbno;  ?></td>
<td  valign="top"><?php $gt5+=$dball; echo $dball;  ?></td>

</tr>
<?php

	$sn++;
	}
?>

<tr><td >Grand Total <td><?php echo $gt1; ?></td> <td><?php echo $gt2; ?></td> <td><?php echo $gt3;  ?></td><td><?php echo $gt4;  ?></td><td><?php echo $gt5;  ?></td></tr>
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
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
//==============================customer wise========================================================
 
 
?>
 <!--
<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 -->
<div id="bg" class="popup_bg"> </div> 