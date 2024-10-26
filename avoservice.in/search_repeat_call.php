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
<th width="10px">City</th>
<th width="100px">Address</th>
<th width="20px">Branch</th>
<th width="70px">Last Call Date</th>
<th width="20px">Last Call No.</th>
<th width="50px">Last Engr Name</th>
<th width="65px">Last Close Date</th>
<th width="150px">Last Engr Update</th>
<th width="150px">Last Problem Type</th>

<th width="50px">Current Call No.</th>
<th width="70px">Current Log time</th>
<th width="20px">Current Engineer</th>
<th width="150px">Current Update</th>
<th width="20px">Problem Type, if attend</th>
<th width="20px">Call Status</th>


<?php 
//$query="select * from alert where repeat_callid!='' and atm_id NOT like '%temp%' ";
$query="select a.alert_id, b.repeat_callid from alert a, alert b where a.repeat_callid!='' and b.alert_id=a.repeat_callid and b.call_status !='Rejected' ";


if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!=''){

$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];

//$fromdt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['fromdt'])));
//$todt=date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['todt'])));

$query.=" and a.entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";

//echo $fromdt;

} else {
$fromdt=date('Y-m-d');
$todt=date('Y-m-d');
}

//$query.=" and date(a.entry_date) ='".$date."'";
//$query.=" and a.entry_date between '".$fromdt." 00:00:00' and '".$todt." 23:59:59'";



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

$query.=" order by a.alert_id DESC LIMIT $Page_Start , $Per_Page";

//echo $query;


$qryss=mysqli_query($con1,$query);


$srno=1;
while($rrow=mysqli_fetch_array($qryss))

{
$qry=mysqli_query($con1,"select * from alert where alert_id='".$rrow[0]."' ");
$row=mysqli_fetch_array($qry);

//=========Last Call ===

$lastqry=mysqli_query($con1,"select * from alert where alert_id='".$row[43]."' ");
//echo "select * from alert where alert_id='".$row[43]."' ";

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

//=======Last Engineer==============
$engdel=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$last[0]."' order by id DESC");
$engid=mysqli_fetch_array($engdel);
$enggqry=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engid[0]."'");
$eng=mysqli_fetch_array($enggqry);
//========================Last call--- feedback
$upqry=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$last[0]."' order by id DESC limit 1");
$update=mysqli_fetch_row($upqry);

//========Current Call===========
//=======Engineer==============
$engqry=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$row[0]."' order by id DESC");
$engneid=mysqli_fetch_array($engqry);
$enqry=mysqli_query($con1,"select engg_name from area_engg where engg_id='".$engneid[0]."'");
$engnew=mysqli_fetch_array($enqry);
//========================curr- feedback
$upqry1=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$row[0]."' order by id DESC limit 1");
$update1=mysqli_fetch_row($upqry1);

if ($row[15] =='Done' || $row[16] =='Done'){$status= "Closed"; }
if ($row[15] =='Delegated'){$status= "Delegated"; }
if ($row[16] =="Rejected"){$status= "Rejected"; }
if ($row[16] =='onhold'){$status= "On Hold"; }
if ($row[16] =='Pending'){$status= "Pending"; }
?>
<tr>
<td><?php echo $srno;?></td>

<td><?php echo $custfetch[0];?></td>
<td><?php echo $aid[0];?></td>
<td><?php echo $row[3];?></td>
<td><?php echo $row[6];?></td>
<td><?php echo $row[5];?></td>
<td><?php echo $br[0];?></td>

<td><?php echo $last[10];?></td>
<td><?php echo $last[25];?></td>
<td><?php echo $eng[0];?></td>
<td><?php echo $last[18];?></td> <!-- Close Date -->
<td><?php echo $update[0];?></td>

<!------ Problem type --->

<td><?php echo $update[0];?></td>

<td><?php echo $row[25];?></td>
<td><?php echo $row[10];?></td>
<td><?php if ($engnew[0] !='') {echo $engnew[0];}
else { echo "Not Delegated";} ?></td>
<td><?php echo $update1[0];?></td>

<!------ Problem type --->
<td><?php echo $status;?></td>
<td><?php echo $status;?></td>



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

<form name="frm" method="post" action="export_repeat.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" > <span>(From here you can Export MAX 2000 Record at one Time.)</span>
</form>