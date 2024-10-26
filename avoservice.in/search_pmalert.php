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
$br=$_POST['br'];
if($_POST['br']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con1,"select state from state where branch_id in (".$_SESSION['branch'].")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}
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

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res"  id="custtable" >
<tr>
<th width="10%">Complain ID</th> 

<th width="5%">Name</th>
<th width="5%">ATM</th>
<th width="5%">ETA</th>
<th width="5%">Bank</th>
<th width="5%">City</th>
<th width="5%">Area</th>
<th width="5%">Address</th>
<th width="5%">State</th>
<th width="5%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%"> Delegated To</th>

<th width="5%"> Last FeedBack</th>

<th width="5%">Update</th>

</tr>
<?php
include("config.php");


//$table=$filter->filter('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',"alert",array("state"),array($br1[$i]));
if($_POST['br']=='all')
{
 if(isset($_POST['state']) && $_POST['state']!='')
  { $stt=$_POST['state'];
   $sql.="Select * from pmalert where state1 like ('%".$stt."%') ";
  } 
  else
   $sql.="Select * from pmalert where 1";
}
else
{
 if(isset($_POST['state']) && $_POST['state']!='')
  { $stt=$_POST['state'];
   $sql.="Select * from pmalert where state1 like ('%".$stt."%') ";
  } 
  else
	$sql.="Select * from pmalert where state1 in (".$br2.") ";
}
if(isset($_POST['calltype']))
{
$calltype=$_REQUEST['calltype'];
if($calltype=='')
{
}
elseif($calltype=='open')
$sql.=" and (call_status = 'Pending' or call_status='1' or call_status='2' or call_status='Delegated') and atm_id<>'temp_'";
elseif($calltype=='Done')
$sql.=" and call_status = 'Done'";
elseif($calltype=='onhold')
$sql.=" and call_status = 'onhold'";
elseif($calltype=='Rejected')
$sql.=" and call_status = 'Rejected'";
}
if(isset($_POST['eng']) && $_POST['eng']!='')
{
$eng=$_POST['eng'];
if($eng!='-1')
$sql.=" and alert_id in (select alert_id from pmdelegation where engineer='".$eng."' )";
else
$sql.=" and alert_id not in (select alert_id from pmdelegation )";
}
if(isset($_POST['fromdt']) && $_POST['fromdt']!='' && isset($_POST['todt']) && $_POST['todt']!='')
{
$fromdt=$_POST['fromdt'];
$todt=$_POST['todt'];
$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt','%d/%m/%Y') + INTERVAL 1 DAY";
//$sql.=" and entry_date Between STR_TO_DATE('$fromdt','%d/%m/%Y') AND STR_TO_DATE('$todt 11,59,00','%d/%m/%Y %h,%i,%s')";
}
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];

$sql.=" and (((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') and assetstatus='site') or (atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%' and assetstatus='amc') ))";
$sql.=" or atm_id LIKE '%".$id."%' ) ";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and cust_id ='".$cid."'";
}
 
if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and bank_name LIKE '%".$bank."%'";
}
if(isset($_POST['sitetp']) && $_POST['sitetp']!='')
{
$sitetp=$_REQUEST['sitetp'];
$sql.=" and alert_type ='".$sitetp."'";
}
if(isset($_POST['docket']) && $_POST['docket']!='')
{
$docket=$_REQUEST['docket'];
$sql.=" and custdoctno LIKE '%".$docket."%'";
}

if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.=" and address LIKE '%".$area."%'";
}
if(isset($_POST['complaintno']) && $_POST['complaintno']!='')
{
$complaintno=$_REQUEST['complaintno'];
$sql.=" and createdby LIKE '%".$complaintno."%'";
}

//echo $sql;
//echo "Select * from alert where state in (".$br2.") order by alert_id DESC";
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
while($row= mysqli_fetch_row($table))
{

	include("config.php");
	$atmm='';
	if($row[21] ==  'amc' || $row[21]=='amcnew')
   $atmm="select atmid from Amc where amcid='".$row[2]."'";
	elseif($row[21] == 'site')
	$atmm="select atm_id from atm where track_id='".$row[2]."'";

 $atm=mysqli_query($con1,$atmm);
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	$tab=mysqli_query($con1,"select feedback,standby,feed_date from pmfeedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);


	//echo "eng stat".$row[15];
		?>
<tr <?php if($row[26]=='1'){ echo "style='background:#99CC33'"; } if($row[16]=='2'){ echo "style='background:#990000'"; } if($row[31]!='0000-00-00 00:00:00' && $row[31]<=date('Y-m-d H:i:s') && $row[16]<>'Done'){ echo "style='background:red'"; } ?>>
<td  valign="top"><?php echo $row[25]; ?></td>

<td  valign="top">&nbsp;<?php echo $custrow[0]; ?></td>
<td  valign="top">&nbsp;<?php 
    
  $atmrow=mysqli_fetch_row($atm);
   echo $atmrow[0];  ?></td>
   <td><?php if($row[31]!='0000-00-00 00:00:00'){echo date('d/m/Y H:i:s',strtotime($row[31])); } ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[3],6,"<br />\n",TRUE); ?></td>
<!--<td width="71" valign="top">&nbsp;<?php echo $row[27] ?></td>-->
<td  valign="top">&nbsp;<?php echo wordwrap($row[6],5,"<br />\n",TRUE); ?></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[4] ,7,"<br />\n",TRUE) ;?></td>
<td valign="top">&nbsp;<div height="100px" style="height:150px; overflow:;"><?php  $brtxt= preg_replace("/[^\p{Latin} ]/u", "", $row[5]); echo  $brtxt1=wordwrap($brtxt ,10,"<br />\n",TRUE); ?></div></td>
<td  valign="top">&nbsp;<?php echo wordwrap($row[27],6,"<br />\n",TRUE); ?> </td>
<td  valign="top">&nbsp;<?php

 echo $row[9];
 ?></td>
<td valign="top">&nbsp;<?php
echo date('d/m/Y h:i:s a',strtotime($row[10])); 
?></td>
<td  valign="top">&nbsp;
<?php 
//echo "Select e.engg_name,e.phone_no1 from area_engg e,pmdelegation d where e.engg_id=d.engineer and alert_id='".$row[0]."'";
$fetchengid=mysqli_query($con1,"Select e.engg_name,e.phone_no1 from area_engg e,pmdelegation d where e.engg_id=d.engineer and alert_id='".$row[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);
echo wordwrap($getoldname[0],30,"<br />\n",TRUE)."<br>".$getoldname[1];
  ?></td>

 <td>
 <?php 
 //echo $row[16]." ".$row[15]."<br>";
 if($row[16]!='Done'){
 if($row[15]!='Delegated' && $row[15]!='Done')
 {

 ?><br><a href="pmdelegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $br; ?>">Delegate</a>
<?php
}
else
echo "Delegated";
if($row[15]=='Done')
{
?>
Call closed by Engineer
<?php
}
}
else
echo "Call closed<br>";
if(mysqli_num_rows($tab)>0)
echo $row1[0]." ".date('d/m/Y h:i:s a',strtotime($row1[2]));
 /*if($row[16]=='1')
 {
  //echo $row[15]." ".$row[16];
 if($row[15]!='Delegated' && $row[15]!='Done')
 {

 ?><br><a href="pmdelegate.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $br; ?>">Delegate</a>
<?php
}

if($row[15]=='Done')
{
?>
Call closed by Engineer
<?php
}
 }*/
 /* if($row[16]=='Pending')
  {
  echo $row[16];
  if($row[26]!='1')
  {
  ?>
<br><a href="decision.php?alertid=<?php echo $row[0]?>">Questions</a>
<br />
   <a href="javascript:void(0);" onclick="newwin('calltransfer.php?id=<?php echo $row[0] ?>','transfer',700,700)" class="update">
Transfer<?php if(mysqli_num_rows($qr)>0){ 
$qrro=mysqli_fetch_row($qr);
echo " Failed<br>Reason :".$qrro[6]; }  ?></a>
<?php
}
else
echo "<br><br>Under Transferring Process";
  }
  elseif($row[16]=='onhold')
  {
echo "<br><a href=unhold.php?id=$row[0]>Unhold</a>";

}
elseif($row[16]=='Rejected')
echo $row[16];
elseif($row[16]=='2')
{
?>
<!--<br><a href="notify.php?req=<?php echo $row[0]?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>-->
<?php }
elseif($row[16]=='Done')
{
?>
Call Closed
<?php }
elseif($row[16]=='Delegated')
{
?>
<br><a href="redelegateme.php?req=<?php echo $row[0]?>&city=<?php echo $row[6]; ?>&atm=<?php echo $row[2]?>&br=<?php echo $br; ?>">Redelegate</a>
<?php }*/


 ?>
 </td>
 
 <td>
 <?php
 //echo "Select * from tempclosedcall where alert_id='".$row[0]."' and status=0";
 //$qrytmp=mysqli_query($con1,"Select * from tempclosedcall where alert_id='".$row[0]."' and status=0");
	
// echo $row[16]
 //if(($row[16]=='Delegated' || $row[16]=='2' || $row[16]=='1' || (mysqli_num_rows($qrytmp)>0) && $row[26]!='1') )
 //{
 ?>
 <a href="javascript:void(0);" onclick="newwin('pmbrupdate.php?id=<?php echo $row[0] ?>&br=<?php echo $br?>&ctype=<?php echo $row[17] ?>','display',600,600)" class="update">
  Update</a>
	
	<?php
 //}
 
 
 ?>
<!--<a href="update1.php?id=<?php echo $row[0]?>&br=<?php echo $br?>&ctype=<?php echo $row[17] ?>" style="text-decoration:none">Update</a>-->
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
<!--<form name="frm" method="post" action="exportme.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>-->
 
<div id="bg" class="popup_bg"> </div> 