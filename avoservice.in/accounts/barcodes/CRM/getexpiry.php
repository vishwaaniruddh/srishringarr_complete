<?php
include("config.php");
$pm=$_GET['cid'];
$date=date("Y-m-d");
//echo $pm;
?>
<center><h2><?php if($pm=='AMC') { echo "Expired AMC";} elseif($pm=='PM'){ echo "Expired Warranty"; }elseif($pm=='both'){ echo "Expired "; } ?></h2></center>
<table width="826" border="1">
<tr>
<th>
Sr NO
</th>
<th>Name</th><th width="20%">Item</th><th>Contact Number</th><th>Address</th><th>Expired On</th><th>Last Call On</th><th>Feedback</th>	<th>&nbsp;</th>
</tr>

<?php
if($pm=='AMC')
{
	$cnt=0;

$qry=mysql_query("select * from phppos_service1 where amc_cust<>''");
while($row=mysql_fetch_array($qry))
{
	$qry4=mysql_query("select * from phppos_amc where person_id='".$row[0]."'");
	$row4=mysql_fetch_row($qry4);
	if($row4[5]<date("Y-m-d"))
	{
	//echo $row[9];
	$cnt=++$cnt;
	
	//echo "Select * from phppos_custfeedback where person_id='".$row[9]."' order by id DESC limit 1";
	$qry3=mysql_query("Select * from phppos_custfeedback where person_id='".$row[9]."' order by id DESC limit 1");
	$row3=mysql_fetch_row($qry3);

	?>
    <tr><td><?php echo $cnt;  ?></td>
    
    <td><?php echo $row[2];  ?></td>
    <td width="20%" ><?php echo $row[6];  ?></td>
    <td><?php  echo $row[3];   ?></td>
    <td><?php  echo $row[5];  ?></td>
    <td><?php  echo date('d/m/Y',strtotime($row4[5]));  ?></td>
    <td><?php echo $row3[2];  ?></td>
    <td><?php echo $row3[3]; ?></td>
    <td><?php // echo $row[9]; ?><a href="#" onclick="Showform('<?php echo $row[9]; ?>');" style="text-decoration:none">Update</a>
    <div id="form<?php echo $row[9]; ?>" style="display:none"></div>
    </td>
    </tr>
    
    <?php
	}
}
}
elseif($pm=='PM')
{
	$cnt=0;

$qry=mysql_query("select * from phppos_service where amctaken=0 ");
while($row=mysql_fetch_array($qry))
{
	//echo $row[9];
	$cnt=++$cnt;
	$today = strtotime($row[7]);
 $expdate = strtotime("+12 months", $today);
if(date("Y-m-d",$expdate)<=date("Y-m-d") && $row[19]=='0')
{
	
	//echo "Select * from phppos_custfeedback where person_id='".$row[9]."' order by id DESC";
	$qry3=mysql_query("Select * from phppos_custfeedback where person_id='".$row[18]."' order by id DESC");
	$row3=mysql_fetch_row($qry3);

	?>
    <tr><td><?php echo $cnt;  ?></td>
    
    <td><?php  echo $row[2];  ?></td>
    <td width="20%"><?php  echo $row[6];  ?></td>
    <td><?php echo $row[3];  ?></td>
    <td><?php echo $row[5];  ?></td>
    <td><?php  echo date("d/m/Y",$expdate);  ?></td>
    <td><?php echo $row3[2];  ?></td>
    <td><?php echo $row3[3]; ?></td>
    <td><?php //echo $row[18]; ?><a href="#" onclick="Showform('<?php  echo $row[18]; ?>');" style="text-decoration:none">Update Feedback</a>
    <div id="form<?php echo $row[18]; ?>" style="display:none"></div>
    </td>
    </tr>

    <?php
	}
}
}

?></table>