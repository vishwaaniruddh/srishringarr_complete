<?php
session_start();
 //echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){
$strPage = $_REQUEST['Page'];
//echo $strPage;
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
$src=mysqli_query($con1,"select state from state where state_id in (".$br1.")");
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

?><table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res">
<th width="77">Complain ID</th> 
<th width="77">Client Docket Number</th> 
<th width="77">Name</th>
<th width="75">ATM</th>
<th width="125">Bank</th>
<th width="125">State</th>
<th width="75">City</th>
<th width="75">Area</th>
<th>Address</th>
<th width="75">Problem</th>
<th width="75">Alert Date</th>
<th width="75">Contact Person</th>
<th width="75"> Phone</th>

<th width="45">Delegated To</th>
<th width="45">Customer Status</th>
<th width="45">Engineer Last FeedBack</th>
<th width="45">Status</th>
<th width="45">Update</th>
<?php
//include("config.php");


//$table=$filter->filter('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',"alert",array("state"),array($br1[$i]));
if($_POST['br']=='all')
 $sql="Select * from tempclosedcall where status='0'";
else
$sql="Select * from tempclosedcall where branch in (".$br2.")";

if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid'];
$sql.=" and alert_id IN(select alert_id from alert where cust_id IN (select cust_id from customer where cust_name LIKE '%".$cid."%'))";
}
if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
$sql.=" and (alert_id IN (select alert_id from alert where atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%') or atm_id LIKE '%".$id."%'))";

//$sql.=" and (alert_id IN (select atm_id from alert)";
//echo $sql;
}

/*if(isset($_POST['atmid']) && $_POST['atmid']!='')
{
 $id=$_POST['atmid'];
 $qr=mysqli_query($con1,"select track_id from atm where atm_id LIKE '%".$id."%'");
  $qr2=mysqli_query($con1,"select amcid from Amc where atmid LIKE '%".$id."%'");
  $qr3=mysqli_query($con1,"select atm_id from alert where atm_id LIKE '%".$id."%'");
 $r1=mysqli_num_rows($qr);
 $r2=mysqli_num_rows($qr2);
 $r3=mysqli_num_rows($qr3);
 if($r1>0 && $r2>0)
 {
 $sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%'))";
 //echo $sql;
 }
 elseif($r1>0 && $r2==0)
 {
 $sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%'))";
 echo $sql;
 }
 elseif($r2>0 && $r1==0)
 {
 $sql.=" and ((atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%'))";
}
 
 
//$sql.=" and ((atm_id IN (select track_id from atm where atm_id LIKE '%".$id."%') or atm_id IN (select amcid from Amc where atmid LIKE '%".$id."%') or atm_id LIKE '%".$id."%'))";



if($r1=='0' && $r2=='0')
{
$sql.=" and atm_id LIKE '%".$id."%' ";
}
else
{
$sql.=" or atm_id LIKE '%".$id."%' ) ";
}
}

*/



if(isset($_POST['bank']) && $_POST['bank']!='')
{
$bank=$_REQUEST['bank'];
$sql.=" and alert_id IN(select alert_id from alert where bank_name LIKE '%".$bank."%')";
}
if(isset($_POST['area']) && $_POST['area']!='')
{
$area=$_REQUEST['area'];
$sql.="  and alert_id IN(select alert_id from alert where address LIKE '%".$area."%')";
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

$sql.=" and status='0' LIMIT $Page_Start , $Per_Page";
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
$qr=mysqli_query($con1,"select * from alert where alert_id='".$row[1]."'");
$ro=mysqli_fetch_row($qr);
	//include("config.php");
	//echo $ro[17];
	
	//echo "select feedback,standby from eng_feedback where alert_id='".$ro[0]."' order by id DESC";
	$tabfeed=mysqli_query($con1,"select feedback,standby from eng_feedback where alert_id='".$ro[0]."' order by id DESC");
	$row1=mysqli_fetch_row($tabfeed);
	
	
	if($ro[21]=='amc')
$at=("select atmid from Amc where amcid='".$ro[2]."'");
elseif($ro[21]=='site')
$at=("select atm_id from atm where track_id='".$ro[2]."'");
elseif($ro[21]=='')
$at=("select atmid from tempsites where atmid='".$ro[2]."'");
//echo "select atm_id from atm where track_id='".$ro[2]."'";
//echo $at;
$atm=mysqli_query($con1,$at);
$atmrow=mysqli_fetch_row($atm);
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$ro[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
		?>
<tr>
<td width="77" valign="top">&nbsp;<?php echo wordwrap($ro[25],10,"<br />\n",true); ?></td>
<td width="77" valign="top">&nbsp;<?php echo $ro[30]; ?></td>
<td width="77" valign="top">&nbsp;<?php echo wordwrap($custrow[0],8,"<br />\n",true) ; ?></td>

<td width="72" valign="top">&nbsp;<?php 
//echo "select atm_id from atm where track_id='".$ro[2]."'";

   echo wordwrap($atmrow[0],8,"<br />\n",true);  ?></td>
   
<td width="75" valign="top">&nbsp;<?php echo $ro[3] ?></td>
<td width="75" valign="top">&nbsp;<?php echo wordwrap($ro[7],8,"<br />\n,",true); ?></td>
<td width="75" valign="top">&nbsp;<?php echo wordwrap($ro[6],8,"<br />\n,",true) ; ?></td>
<td width="75" valign="top">&nbsp;<?php echo wordwrap($ro[4],8,"<br />/n",TRUE); ?></td>
<td valign="top">&nbsp;<?php echo wordwrap($ro[5],14,"<br />\n",TRUE); ?></td>
<td width="75" valign="top">&nbsp;<?php echo $ro[9]?></td>

<td width="75" valign="top">&nbsp;<?php
if($ro[17]=='service' || $ro[17]=='new temp' || $ro[17]=='new'){ echo date('d/m/Y h:i:s a',strtotime($ro[10]));  } else{ if(isset($ro[11]) and $ro[11]!='0000-00-00') echo date('d/m/Y h:i:s a',strtotime($ro[11])); }
?></td>

<td width="75" valign="top">&nbsp;<?php echo $ro[12] ?></td>
<td width="75" valign="top">&nbsp;<?php echo $ro[13] ?></td>


<td width="75" valign="top">&nbsp;
<?php 
$oldeng=mysqli_query($con1,"select engineer from alert_delegation where alert_id='".$ro[0]."'");
$getold=mysqli_fetch_row($oldeng);
$fetchengid=mysqli_query($con1,"Select engg_name from area_engg where engg_id='".$getold[0]."'");
$getoldname=mysqli_fetch_row($fetchengid);
echo wordwrap($getoldname[0],8,"<br />\n",true);
  ?></td>


<td width="75" valign="top">&nbsp;
<?php 
if(0 === strpos($ro[2], 'temp'))
	echo "PCB";
	else
 if($ro[21]=='' || $ro[21]=='site'){ echo "Under Warrenty"; }else if($ro[21]=='amc'){ echo "AMC"; }else{ echo "PCB"; }
  ?></td>
  
  
  <td valign="top">&nbsp;<?php if($row1[0]!=''){ ?><a class="update" href="#" onclick="newwin('masteralert.php?id=<?php echo $ro[0] ;?>','display')" target="_new" ><?php echo $row1[0]; ?></a><?php }else{ 
$al=mysqli_query($con1,"select feedback from eng_feedback where alert_id='".$ro[0]."' order by id DESC limit 1");
$alro=mysqli_fetch_row($al);
echo $alro[0];
 } ?></td>
 
 
 
 
 
 <!--Status td-->
 
 <td>
 <?php 
 if($ro[16]=='1')
 {
  //echo $row[15]." ".$row[16];
 if($ro[15]!='Delegated')
 {

 if($ro[15]!='Done')
 {
 ?><br><a href="delegate.php?req=<?php echo $ro[0]?>&city=<?php echo $ro[6]; ?>&atm=<?php echo $ro[2]?>&br=<?php echo $br; ?>">Delegate</a>
<?php
}
}


if($ro[15]=='Delegated')
{
//echo "Delegated";
?>
<br><a href="redelegateme.php?req=<?php echo $ro[0]?>&city=<?php echo $ro[6]; ?>&atm=<?php echo $ro[2]?>&br=<?php echo $br; ?>">Redelegate</a>
<?php
}
if($ro[16]!='1')
{
echo $ro[16];
?>
 <!--<?php if($ro[17] != 'new'){ ?><br><a href="notify.php?req=<?php echo $ro[0]?>&br=<?php echo $br ?>&type=wait">Standby Close</a><?php } ?>
<br><a href="notify.php?req=<?php echo $ro[0]?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>-->
<?php }
 }
  elseif($ro[16]=='Pending')
  {
  echo $ro[16];
  if($ro[26]!='1')
  {
  ?>
<br><a href="decision.php?alertid=<?php echo $ro[0]?>">Questions</a>
<?php
//echo "select * from transfersites where alertid='".$row[0]."' and approval LIKE 'disapprove%' order by id DESC limit 1";
$qr=mysqli_query($con1,"select * from transfersites where alertid='".$ro[0]."' and approval LIKE 'disapprove%' and status='0' order by id DESC limit 1");


  ?><br />
   
<a class="update" onclick="newwin('calltransfer.php?id=<?php echo $ro[0] ?>','transfer')"  href="#"  >Transfer<?php if(mysqli_num_rows($qr)>0){ 
$qrro=mysqli_fetch_row($qr);
echo " Failed<br>Reason :".$qrro[6]; }  ?></a>
<?php
}
else
echo "<br><br>Under Transferring Process";
  }
  elseif($ro[16]=='onhold')
  {
echo "<br><a href=unhold.php?id=$ro[0]>Unhold</a>";

}
elseif($ro[16]=='Rejected')
echo $ro[16];
elseif($ro[16]=='2')
{
?>
<!--<br><a href="notify.php?req=<?php echo $ro[0]?>&br=<?php echo $br ?>&type=close" style="text-decoration:none; color:#FFFFFF">Permanent Close</a>-->
<?php }
elseif($ro[16]=='Done')
{
?>
Call Closed
<?php }

 ?>
 </td>
 
 <!--end of status td-->
 
 <td>
 <?php
 //echo "Select * from tempclosedcall where alert_id='".$row[0]."' and status=0";
 $qrytmp=mysqli_query($con1,"Select * from tempclosedcall where alert_id='".$ro[0]."' and status=0");
	
// echo $row[16]
 if(($ro[16]=='Delegated' || $ro[16]=='2' || $ro[16]=='1' || mysqli_num_rows($qrytmp)>0) && $ro[26]!='1' )
 {
 ?>
	<a href="update1.php?id=<?php echo $ro[0]?>&br=<?php echo $br?>&ctype=<?php echo $ro[17] ?>" style="text-decoration:none; color:#FF0;">Update</a>
	<?php
 }
 
 
 ?><!--<a class="update" href="#" onclick="newwin('call_update.php?id=<?php //echo $ro[0] ?>','display')" >View Update</a>-->
 </td>
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

<!--<td valign="top" id="done<?php echo $cnt; ?>">
<input type="checkbox" value="<?php echo $row[0]; ?>" id="app<?php echo $cnt; ?>" onclick="showtext(this.id,'approval<?php echo $cnt; ?>');" />&nbsp;Approve/Disapprove
<div id="approval<?php echo $cnt; ?>" style="display:none">
Comment:<textarea name="tocmnt<?php echo $cnt; ?>" id="tocmnt<?php echo $cnt; ?>"></textarea>
<a href="#" style="text-decoration:none" onclick="approve('app<?php echo $cnt; ?>','tocmnt<?php echo $cnt; ?>','approve','done<?php echo $cnt; ?>')"><input type="button" value="Approve" style="background:#CCCCCC; height:40" /></a>
<a href="#" style="text-decoration:none" onclick="approve('app<?php echo $cnt; ?>','tocmnt<?php echo $cnt; ?>','disapprove','done<?php echo $cnt; ?>')"><input type="button" value="Disapprove" style="background:#CCCCCC; height:40" /></a>
</div>
</td>-->

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

/*for($i=1; $i<=$Num_Pages; $i++){
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