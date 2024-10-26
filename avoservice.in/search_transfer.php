<?php
session_start();
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
	//echo $_POST['br'];
$id="";
$cid="";
$bank="";
$city="";
$area="";
$state="";
//$br="Mumbai";
$bran=array();
//echo $_SESSION['branch'];

//$br=$_SESSION['branch']; 
//$br=$_POST['br'];
$brnow=$_SESSION['branch'];


$branch=mysqli_query($con1,"select * from avo_branch where id in(".$brnow.")");
$branch1=mysqli_fetch_row($branch);

/*if($_POST['br']!='all')
{
$br1=str_replace(",","','",$br);
$br1="'".$br1."'";

$src=mysqli_query($con1,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}*/

$str="";
//for($i=0;$i<count($br1);$i++){ 
//echo "select * from alert where state='$br1[$i]'";
//$table=mysqli_query($con1,"select * from alert where state='$br1[$i]'");
//include_once('class_files/generic_filter.php');
//$filter= new generic_filter();

//$table=$filter->filter($id,$cid,$bank,$area,$pin,$city,$state,$sdate,$edate);
/*include_once('class_files/table_formation.php');

$form=new table_formation();
$form->table_forming(array("","","","","","","","","","",""),$table,"n");*/

?><table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res">
<th width="77">Complain ID</th> 
<th width="77">Name</th>
<th width="75">ATM</th>
<th width="125">Bank</th>
<th width="125">From Branch</th>
<th width="125">To Branch</th>
<th width="75">City</th>
<th width="75">Area</th>
<th>Address</th>
<th width="75">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Contact Person</th>
<th width="75"> Phone</th>

<th width="45">Approve</th>
<?php
//include("config.php");

//echo $_POST['br'];
//$table=$filter->filter('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',"alert",array("state"),array($br1[$i]));
if($_POST['br']=='all')
$sql="Select * from transfersites where 1";
else
$sql="Select * from transfersites where tobranch ='".$branch1[1]."'";
//echo $sql;
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and alertid IN(select alert_id from alert where cust_id IN (select cust_id from customer where cust_name LIKE '%".$cid."%'))";
}
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
//$sql.=" and (alertid IN (select alert_id from alert where atm_id like ('%".$id."%')) or alertid IN (select amcid from Amc where atmid LIKE '%".$id."%'))";

$sql.=" and alertid IN (select alert_id from alert where (((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') and assetstatus='site') or (atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%' and assetstatus='amc') )))";
$sql.=" or atm_id LIKE '%".$id."%' ) ";
//$sql.=" or atm_id LIKE '%".$id."%' ";
}
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and alertid IN(select alert_id from alert where bank_name LIKE '%".$bank."%')";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.="  and alertid IN(select alert_id from alert where address LIKE '%".$area."%')";
}
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
$table=mysqli_query($con1,$sql);
$count=0;
$Num_Rows = mysqli_num_rows ($table);
 
########### pagins

$Per_Page =10;   // Records Per Page
 
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
$sql.=" and approval='0' and status='0' LIMIT $Page_Start , $Per_Page";
//echo $sql;
$table=mysqli_query($con1,$sql);
//echo "Select * from alert where state in (".$br1.") order by alert_id DESC";
//echo "count ".mysqli_num_rows($table);
// Insert a new row in the table for each person returned
if(mysqli_num_rows($table)>0) {
$cnt=0;
while($row= mysqli_fetch_row($table))
{
$cnt=$cnt+1;
//echo "select * from alert where alert_id='".$row[3]."'";
$qr=mysqli_query($con1,"select * from alert where alert_id='".$row[3]."'");
$ro=mysqli_fetch_row($qr);
	//include("config.php");
	//echo $ro[17];
	if($ro[17]=='service')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$ro[2]."'");
elseif($ro[17]=='new')
$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$ro[2]."'");
elseif($ro[17]=='new temp')
$atm=mysqli_query($con1,"select atmid from tempsites where atmid='".$ro[2]."'");
//echo "select atm_id from atm where track_id='".$ro[2]."'";
$atmrow=mysqli_fetch_row($atm);
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$ro[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
		?>
<tr>
<td width="77" valign="top">&nbsp;<?php echo $ro[25]; ?></td>
<td width="77" valign="top">&nbsp;<?php echo $custrow[0] ?></td>
<td width="125" valign="top">&nbsp;<?php // echo $row[17]." ".$row[2];
  if($ro[17]=='new temp'){ echo $ro[2]; } else {   echo $atmrow[0];  }?></td>
<td width="75" valign="top">&nbsp;<?php echo $ro[3] ?></td>
<!---Show from branch-->
<td width="75" valign="top">&nbsp;<?php 
$frbr=mysqli_query($con1,"select * from `avo_branch` where id='".$ro[7]."'");
$frbr1=mysqli_fetch_row($frbr);
echo $frbr1[1] ?></td>
<!---Show to branch-->

<td width="75" valign="top">&nbsp;<?php
//$tobr=mysqli_query($con1,"select * from `avo_branch` where id='".$row[2]."'");
//$tobr1=mysqli_fetch_row($tobr);
// echo $tobr1[1]; 
   echo $row[10]; 
 ?>
 </td>
 
<td width="75" valign="top">&nbsp;<?php echo $ro[6] ?></td>
<td width="75" valign="top">&nbsp;<?php echo $ro[4] ?></td>
<td valign="top">&nbsp;<?php echo $ro[5] ?></td>
<td width="75" valign="top">&nbsp;<?php echo $ro[9]?></td>
<td width="75" valign="top">&nbsp;<?php
if($ro[17]=='service' || $row[17]=='new temp'){ echo date('d/m/Y',strtotime($ro[10]));  } else{ if(isset($ro[11]) and $ro[11]!='0000-00-00') echo date('d/m/Y',strtotime($ro[11])); }
?></td>
<td width="75" valign="top">&nbsp;<?php echo $ro[12] ?></td>
<td width="75" valign="top">&nbsp;<?php echo $ro[13] ?></td>


<td valign="top" id="done<?php echo $cnt; ?>">
<input type="checkbox" value="<?php echo $row[0]; ?>" id="app<?php echo $cnt; ?>" onclick="showtext(this.id,'approval<?php echo $cnt; ?>');" />&nbsp;Approve/Disapprove
<div id="approval<?php echo $cnt; ?>" style="display:none">
Comment:<textarea name="tocmnt<?php echo $cnt; ?>" id="tocmnt<?php echo $cnt; ?>"></textarea>
<a href="#" style="text-decoration:none" onclick="approve('app<?php echo $cnt; ?>','tocmnt<?php echo $cnt; ?>','approve','done<?php echo $cnt; ?>')"><input type="button" value="Approve" style="background:#CCCCCC; height:40" /></a>
<a href="#" style="text-decoration:none" onclick="approve('app<?php echo $cnt; ?>','tocmnt<?php echo $cnt; ?>','disapprove','done<?php echo $cnt; ?>')"><input type="button" value="Disapprove" style="background:#CCCCCC; height:40" /></a>
</div>
</td>
</tr><?php

}
?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
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
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a> ";
}
?>
</font></div>
<div id="bg" class="popup_bg"> </div> 