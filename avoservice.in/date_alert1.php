<?php
include('config.php');
############# must create your db base connection
//echo "hhj";
//$strPage = $_REQUEST['Page'];
//if($_REQUEST['mode']=="Listing"){

$adate1="";
$adate2="";
//$br=$_GET['br'];

if(isset($_POST['adate1']))
$adate1=$_REQUEST['adate1'];
if(isset($_POST['adate2']))
$adate2=$_REQUEST['adate2']; 


$str="";

//include_once('class_files/date_range.php');
//$fil= new date_range();
//$table=$fil->date_filter('localhost','site','site','atm_site',"alert","alert_date",$adate1,$adate2);
//echo "Select * from alert where entry_date BETWEEN STR_TO_DATE('".$adate1."','%d/%m/%Y') AND STR_TO_DATE('".$adate2."%','%d/%m/%Y')";
$table=mysqli_query($con1,"Select * from alert where entry_date BETWEEN STR_TO_DATE('".$adate1."','%d/%m/%Y') AND STR_TO_DATE('".$adate2."%','%d/%m/%Y')");
?><table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res" id="custtable"> 

<th width="77">Name</th>
<th width="75">ATM</th>
<th width="125">Bank</th>
<th width="125">State</th>
<th width="125">Site Address</th>
<th width="75">Problem</th>
<th width="75">Date of Call</th>
<th width="75">Recd Time</th>
<th width="75">Alert Date</th>
<th width="75">Contact Person</th>
<th width="75">Phone</th>
<th width="75">Email</th>
<th width="45">Status</th>
<th width="45">Call Close Date</th>
<th width="45">Close Time</th>
<th width="45">Response Time</th>
<th width="45">Customer Status</th>

<?php
// Insert a new row in the table for each person returned

while($row= mysqli_fetch_row($table))
{
if($row[17]=='service')
$atm=mysqli_query($con1,"select atmid from Amc where amcid='".$row[2]."'");
if($row[17]=='new')
$atm=mysqli_query($con1,"select atm_id from atm where track_id='".$row[2]."'");

$atmrow=mysqli_fetch_row($atm);
$qry3=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
$row3=mysqli_fetch_row($qry3);
$tab=mysqli_query($con1,"select up from alert_updates where alert_id='$row[0]' order by id DESC");
	//include_once('class_files/filter.php');
	//$ob=new filter();
	//$tab=$ob->filter_by('localhost','satyavan_acc','Myaccounts123*','satyavan_accounts',array("up"),'alert_updates',array("alert_id"),array($row[0]),'','');
	$row1=mysqli_fetch_row($tab);
	

$time1 = strtotime($row[10]);
$time2 = strtotime($row[18]);

$diff = $time2-$time1;
$hours = $diff / 3600; // 3600 seconds in an hour
$minutes = ($hours - floor($hours)) * 60;
$final_hours = round($hours,0);
$final_minutes = round($minutes);//echo $final_hours. "/" .$final_minutes;	

?><tr <?php if($row[16]=='2'){ ?> style="background:#990000"<?php  } ?>>
<td width="77">&nbsp;<?php echo $row[25]?></td>
<td width="77">&nbsp;<?php echo $row3[0] ?></td>
<td width="125">&nbsp;<?php if($row[17]=='service'){ echo $atmrow[0]; }else{ echo $row[2]; } ?></td>
<td width="75">&nbsp<?php echo $row[3]; ?></td>
<td width="75">&nbsp;<?php echo $row[7] ?></td>
<td width="75">&nbsp;<?php echo $row[5]?></td>
<td width="75">&nbsp;<?php echo $row[9]?></td>
<td width="75">&nbsp;<?php if($row[17]=='new'){ echo "".date('d/m/Y',strtotime($row[11])); }else { echo date('d/m/Y',strtotime($row[10])); }
?></td>
<td width="75">&nbsp;<?php echo $row[12] ?></td>
<td width="75">&nbsp;<?php echo $row[13] ?></td>
<td>&nbsp;<?php 
if($row[16]=='1')
echo "Pending";
elseif($row[16]=='2')
echo "Waitng for Final Close";
else
echo $row[16] ?></td>
<td width="75">&nbsp;<?php  
if(isset($row[18]) and $row[18]!='0000-00-00 00:00:00') echo date('d/m/Y h:i a',strtotime($row[18]));
?></td>
<td width="75">&nbsp;<?php 
if($row[24]!='0000-00-00 00:00:00')
echo date('d/m/Y g:i:s a',strtotime($row[24]));
?></td><td>&nbsp;<?php 

if($row[18]!='0000-00-00 00:00:00')
echo ''.$final_hours. "h " .$final_minutes."m";
?></td>
<td width="75">&nbsp;<?php echo $row[17] ?></td>
<td>

<?php echo $row1[0]; ?></td>
<td>

<!--<a class="update" href="#"  onClick="openpopup('<?php echo $row[0] ?>','display')" >Update</a>-->
<a class="update" href="#" onclick="newwin('call_update.php?id=<?php echo $row[0] ?>','display')" >View Update</a>
<div id="<?php echo $row[0] ?>"  class="popup"></div></td>
</tr><?php 

}

?></table>