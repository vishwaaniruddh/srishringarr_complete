<?php
session_start();

$count=0;
 $strPage = $_REQUEST['Page'];

	include("config.php");
	//echo "select srno from login where username='".$_SESSION['user']."'";
	$qry=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
	$row=mysqli_fetch_row($qry);
	//echo $row[0];
	//echo "<br>select engg_id from area_engg where loginid='".$row[0]."'";
	$qry2=mysqli_query($con1,"select engg_id from area_engg where loginid='".$row[0]."'");
	$row2=mysqli_fetch_row($qry2);
	//echo "<br>".$row2[0];
?>
<table width="506" border="1" cellpadding="2" cellspacing="0" class="res">
<th>Complain ID</th>
<th>Engineer name</th>
<th width="49">ATM</th>
<th width="68">Bank</th>
<th width="58">Area</th>
<th width="58">State</th>
<th width="58">Address</th>
<th width="106">Problem</th>
<th width="106">Date/Time</th>
<th width="58">Alert</th>
<th width="58">Assets / Qty</th>
<th width="106">Status</th>


<?php
$qry="select * from pmalert where 1 ";
if(isset($_POST['calltype']) && $_POST['calltype']!='')
{
$calltype=$_POST['calltype'];
$qry.=" and status='$calltype'";
}
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_POST['bank'];
$qry.=" and bank_name Like ('%".$bank."%')";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_POST['area'];
$qry.=" and bank_name Like ('%".$area."%')";
}

if(isset($_POST['state']) && $_POST['state']!='')
{
$state=$_POST['state'];
$qry.=" and state Like ('%".$state."%')";
}

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];;
$qry.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')";
}
if(isset($_POST['eng']) && $_POST['eng']!='')
{
$eng=$_POST['eng'];
$qry.=" and alert_id in (select alert_id from pmdelegation where engineer='".$eng."' )";
}
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
$qry.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or (atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%')))";
$qry.=" or atm_id LIKE '%".$id."%') ";
}
//echo $qry;
$sql=$qry;
$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 ?>
 <div align="center">Total Number Of Records :>> <?php echo $Num_Rows; ?>
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
$sq=mysqli_query($con1,$sql);

if(!$sq)
echo mysqli_error();
	while($row2=mysqli_fetch_row($sq))
	{
if($row2[21]=='amcnew' || $row2[21] ==  'amc')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row2[2]."'");
	if($row2[21]=='service'||  $row2[21] == 'new')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row2[2]."'");
	
	$atmrow=mysqli_fetch_row($atm);

$count=$count+1;
//echo "select engg_name from area_engg where engg_id=(select engineer from alert_delegation where alert_id='".$row2[0]."')";
$engq=mysqli_query($con1,"select engg_name from area_engg where engg_id=(select engineer from pmdelegation where alert_id='".$row2[0]."')");	
$engqr=mysqli_fetch_row($engq);
$engname=$engqr[0];
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row2[25]; ?></td>
<td><?php echo $engname; ?></td>
<td><?php if($row2[17]=='new' || $row2[17]=='new temp' ){ echo $row2[2];}else{ echo $atmrow[0]; } ?></td>
<td><?php echo $row2[3]; ?></td>
<td><?php echo $row2[4]; ?></td>
<td><?php echo $row2[7]; ?></td>
<td><?php echo $row2[5]; ?></td>
<td><?php echo $row2[9];

 ?></td>
  <td><?php 
echo date("d/m/Y h:i:s a",strtotime($row2[10]));
 ?></td>

<td><?php if($row2[16]=='1')
echo "Pending";
else
echo $row2[16]; ?></td>

<td><?php

 for($i=0;$i<count($row2[0]);$i++) {
//echo "select assets,qty from alert_assets where alert_id='$row2[0]'";
 $sql3=mysqli_query($con1,"select assets,qty from alert_assets where alert_id='$row2[0]'");
       while($row3=mysqli_fetch_row($sql3))
       echo $row3[0]."($row3[1])".", ";}
       ?></td>
<td>
<?php if($row2[15]!='Done') { ?>
<input type="button" value="Done" class="readbutton" onclick="javascript:location.href='eng_feedbackpm.php?id=<?php echo $row2[0]; ?>&eng_id=<?php echo $row[0]; ?>'"/>
<?php } else { ?>
<img src="images/right.png" /><?php } ?></td>
</tr>
<?php }  	

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
?>