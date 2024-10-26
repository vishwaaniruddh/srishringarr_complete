<?php
session_start();

$count=0;
 $strPage = $_REQUEST['Page'];

	include("config.php");
	//echo "select srno from login where username='".$_SESSION['user']."'";
	$qry=mysqli_query($con1,"select srno from login where username='".$_SESSION['user']."'");
	$row=mysqli_fetch_row($qry);
	
	$qry2=mysqli_query($con1,"select engg_id, engg_name from area_engg where loginid='".$row[0]."'");
	$result=mysqli_fetch_row($qry2);
    $engg_id=$result[0];
    $engname=$result[1];

//echo "<br>".$row2[0];

?>
<table width="700" border="1" cellpadding="2" cellspacing="0" class="res">
<th>Complain ID</th>
<th>Engineer name</th>
<th width="49">ATM</th>
<th width="49">Site Status</th>
<th width="68">Bank</th>
<th width="58">Area</th>
<th width="58">State</th>
<th width="58">Address</th>
<th width="150">Problem</th>
<th width="150">Alert Date/Time</th>
<!--<th width="58">Assets / Qty</th> -->
<th width="106">Status</th>
<th width="200">Last Update</th>
<th width="200">Update</th>
<th width="106">FSR Copy</th>


<?php
$qry="select * from alert where alert_id in (select alert_id from alert_delegation where engineer='".$engg_id."') ";

if(isset($_POST['calltype']) && $_POST['calltype']!='')
{
$calltype=$_POST['calltype'];
if($calltype=='Delegated')
$qry.=" and status='Delegated' and call_status='1'";
if($calltype=='Done')
$qry.=" and (status='Done' or call_status='Done')";

if($calltype=='Rejected')
$qry.=" and call_status='Rejected'";
if($calltype=='onhold')
$qry.=" and call_status='onhold'";

}
if(isset($_POST['type']) && $_POST['type']!='')
{
$type=$_POST['type'];

if($type=='service')
$qry.=" and (alert_type='service' || alert_type= 'new temp')";
if($type=='inst')
$qry.=" and alert_type='new'";
if($type=='pm')
$qry.=" and (alert_type='pm' || alert_type= 'temp_pm')";
if($type=='de_re')
$qry.=" and (alert_type='dere' || alert_type= 'temp_dere')";

}

if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_POST['bank'];
$qry.=" and bank_name Like ('%".$bank."%')";
}

if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];;
$qry.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y')";
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
$Num_Rows = mysqli_num_rows($table);
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


	while($row2=mysqli_fetch_row($sq))
	{
if($row2[21] ==  'amc')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row2[2]."'");
	if($row2[21] == 'site')
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row2[2]."'");
	
$atmrow=mysqli_fetch_row($atm);
$atm_id=$atmrow[0];
if ($atm_id=='') { $atm_id= $row2[2];}

if($row2[21] ==  'amc') { $site= "AMC" ; }
if($row2[21] ==  'site') { $site= "Warranty" ; }
if($row2[21] ==  '') { $site= "PCB" ; }

$branch=$row2[7];

$count=$count+1;

?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row2[25]; ?></td>
<td><?php echo $engname; ?></td>

<td><?php echo $atm_id; ?> </td>

<td><?php echo $site; ?></td>

<td><?php echo $row2[3]; ?></td>
<td><?php echo $row2[4]; ?></td>
<td><?php echo $row2[27]; ?></td>
<td><?php echo $row2[5]; ?></td>
<td><?php echo $row2[9]; ?> </td> <!-- Problem -->

 
  <td><?php 
echo date("d/m/Y h:i:s a",strtotime($row2[10]));
 ?></td>

<td>
    <?php if($row2[15]=="Delegated" && $row2[16]=="1") { echo "Pending"; }
     if($row2[15]=="Delegated" && $row2[16]=="Rejected") { echo "Delegated but Branch Rejected"; }
     if($row2[15]=="Done" && $row2[16]=="Rejected") { echo "Engr Closed but Branch Rejected"; }
     if($row2[15]=="Pending" && $row2[16]=="Rejected") { echo "Branch Rejected"; }
     if($row2[15]=="Done" || $row2[16]=="Done") { echo "Closed"; } ?>
</td>

<td valign="top">
<!-- <div height="100px" style="height:50px; width:150px; overflow:hidden;"> -->
<div height="100px" style="width:150px; ">
<?php //============Updates=========	
$tab=mysqli_query($con1,"select feedback,standby,feed_date from eng_feedback where alert_id='".$row2[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
if(mysqli_num_rows($tab)>0){

 echo wordwrap($row1[0],50,"<br />\n",TRUE);
 ?>

<!--<a href="javascript:void(0);" onclick="newwin('masteralert.php?id=<?php echo $row2[0] ?>','display',700,700)" class="update">
<a href='masteralert.php?id=<?php echo $row2[0] ?>','display',700,700' class="update"> 

<?php echo date('d/m/Y h:i:s a',strtotime($row1[2]))."<br>".wordwrap($row1[0],10,"<br />\n",TRUE); ?></a> -->
<?php
}
else
echo "No Updates so far";
?>
</div>

</td>

<td>
 <?php
 if($row2[15] !="Done" && $row2[16] !="Done"){
  ?>
 <a href="#" onClick="window.open('call_update.php?id=<?php echo $row2[0]; ?>&ctype=<?php echo $row2[17] ?>&eng_id=<?php echo $engg_id ?>&br=<?php echo $branch?>','edit_site','width=700px,height=750,left=200,top=40')"> <font size="+1" color="Red">Update Call</font></a>
 
 
 <!-- <a href="call_update.php?id=<?php echo $row[0] ?>" style="color:red" target="_new"> Update99 call </a>
 <a href="javascript:void(0);" onclick="newwin('call_update.php?id=<?php echo $row[0] ?>&br=<?php echo $br?>&ctype=<?php echo $row[17] ?>&alerts_id=<?php echo $row[0] ?>&eng_id=<?php echo $getoldname[2] ?>','display',600,600)" class="update"> <font size="+1">Update</font></a> -->
  
  <?php }    ?>
 
 </td>

<td>
 <?php 

 if(($row2[16]=='Done' || $row2[15]=='Done') && $row2[44]== ''){
  ?>
 <button input type="button" style="color:blue; font:bold;" <a href="javascript:void(0);" class="btn btn-primary" onclick="window.open('manual_fsr.php?id=<? echo $row2[0];?>','upload','width=700px,height=500,left=300,top=100')" class="update">Attach Manual FSR</a></button>
 
 <?php } elseif ($row2[44] != '') { ?>
 
 <button input type="button" class="btn btn-primary" style="color:blue ;"> <a href="<?php echo $row2[44]; ?>" target="_blank" <image src="<?php echo $row2[44]; ?>.jpg" alt="Inst" width="300" height="300" />View FSR</a> </button>

<?php } ?>

 </td>

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