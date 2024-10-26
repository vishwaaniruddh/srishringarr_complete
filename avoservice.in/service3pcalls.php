<?php
include("access.php");
include('config.php');
session_start();
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
 $strPage = $_REQUEST['Page'];
?>
<center>
<table  border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;border:1px #fff solid" >

<th width="10px">S.No</th>
<th width="20px">Customer Name</th>
<th width="20px">Atm ID</th>
<th width="20px">End User</th>
<th width="20px">City</th>
<th width="100px">Address</th>
<th width="20px">Branch</th>
<th width="10px">Count</th>
<th width="50px">Last Call No.</th>
<th width="50px">Engineer Name</th>
<th width="100px">Last Engr Update</th>
<th width="50px">Call Ticket No.</th>

<th width="20px">View</th>


<?php 
$query="select * from alert where atm_id  NOT LIKE '%temp%' and alert_type='service' and (call_status = 'Done' or status='Done')  ";

//$query= "SELECT a.* FROM alert a INNER JOIN   (SELECT atm_id,    MIN(alert_id) as id   FROM alert GROUP BY atm_id ) AS b  ON a.atm_id = b.atm_id";

//$query="select * from alert where atm_id  NOT LIKE '%temp%'"; 

//$query="select distinct(atm_id) from alert where atm_id NOT LIKE '%temp%' and alert_type='service' and (call_status = 'Done' or status='Done')  ";


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){
		
$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));

} else {
$fromdt=date('Y-m-d', strtotime('-30 days'));
$todt=date('Y-m-d', strtotime('-1 days'));
}
$query.=" and entry_date > '".$fromdt." 00:00:00' and entry_date < '".$todt." 23:59:59'";

//$query.=" group by atm_id having (count(atm_id) >=2)";

$qr1=mysqli_query($con1,$query);
$Num_Rows =mysqli_num_rows($qr1);
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

$qr22=$query;

$query.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";

echo $query;


$qryss=mysqli_query($con1,$query);


$srno=1;
while($row=mysqli_fetch_array($qryss))
{
//=========Last Call ===

$lastqry=mysqli_query($con1,"select * from alert where atm_id='".$row[2]."' and entry_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' order by alert_id DESC limit 2");

$coqry= mysqli_query($con1,"select count(alert_id) AS count from alert where atm_id='".$row[2]."' and entry_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59' and (call_status='Done' or status='done') ");

$countrow=mysqli_fetch_assoc($coqry);
$count=$countrow['count'];

$last=mysqli_fetch_array($lastqry);

//============ATM ID============        
if($row[21] ==  'amc')
  {
 	$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
	}
        else if($row[21] ==  'site'){
	$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");
	//echo "select atm_id from atm where track_id='".$row[2]."'";
	}
	$aid=mysqli_fetch_array($atm);
//==========Customer===========
$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
$custfetch=mysqli_fetch_array($custqry);
//==============Branch==========
$brqry=mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'");
$br=mysqli_fetch_array($brqry);

//=======Engineer==============
$engdel=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC");
$engid=mysqli_fetch_array($engdel);
$enggqry=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engid[0]."'");
$eng=mysqli_fetch_array($enggqry);
//========================Last feedback
$upqry=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");


$update=mysqli_fetch_row($upqry);

?>
<tr>
<td><?php echo $srno;?></td>
<td><?php echo $custfetch[0];?></td>
<td><?php echo $aid[0];?></td>
<td><?php echo $row[3];?></td>
<td><?php echo $row[6];?></td>
<td><?php echo $row[5];?></td>
<td><?php echo $br[0];?></td>
<td><?php echo $count;?></td>
<td><?php echo $row[25];?></td>

<td><?php echo $eng[0];?></td>
<td><?php echo $update[0];?></td>

<td><?php echo $last[25];?></td>

<td><a href="javascript:void(0);" onclick="window.open('view_servicepcalls.php?id=<?php echo $row[2]?>&type=<?php echo $row[21];?>&frdt=<?php echo $fromdt;?>&todt=<?php echo $todt;?>   ','View_servicepcalls','width=700px,height=750,left=200,top=40')" class="update">
  View</a></td>
</tr>

<?php
$srno++;
}




?>
</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php

//echo $Prev_Page;
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

</div>
</center>

<form name="frm" method="post" action="export3Plus.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="hidden" name="fromdt" value="<?php echo $fromdt; ?>" readonly>
<input type="hidden" name="todt" value="<?php echo $todt; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 860 Record at one Time.)</span>
</form>