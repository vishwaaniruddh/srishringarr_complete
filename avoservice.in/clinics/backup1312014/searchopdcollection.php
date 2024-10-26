<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
$dt=date('Y-m-d');
//echo "select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.status='' and a.reason='' ";
$query="select * from opd_collection where 1 and status=0 ";
//$query ="select a.app_real_id,a.no,a.app_date,a.block_id,a.slot,a.new_old,a.type,a.hospital,b.srno,b.name,b.mobile,a.status from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.reason='' ";


if(isset($_REQUEST['searchdate']) && isset($_REQUEST['searchdate2']) && $_REQUEST['searchdate']!="" && $_REQUEST['searchdate2']!="")
{
	
$searchdate=str_replace("/","-",$_REQUEST['searchdate']);
$searchdate=date("Y-m-d",strtotime($searchdate));
$searchdate2=str_replace("/","-",$_REQUEST['searchdate2']);
$searchdate2=date("Y-m-d",strtotime($searchdate2));
//echo "hi";
$query.="and date between '".$searchdate." 00:00:00' and '".$searchdate2." 00:00:00' ";
$amt=mysql_query("select sum(amt) from opd_collection where status=0 and date between '".$searchdate." 00:00:00' and '".$searchdate2." 00:00:00'");
$amtro=mysql_fetch_row($amt);
}
else
{
$query.="and date LIKE '".$dt."%'";
$amt=mysql_query("select sum(amt) from opd_collection where status=0 and date between '".$searchdate." 00:00:00' and '".$searchdate2." 00:00:00'");
$amtro=mysql_fetch_row($amt);

}


$query.=" order by date DESC ";


//$query.=" order by date DESC LIMIT $Page_Start , $Per_Page";
//echo $query;

$result = mysql_query($query) or die(mysql_error());

?> 
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />

<div  style="overflow:auto;width:910px; height:400px">
<table class="results">
 
       <thead>
         <tr>
		<!-- <td width="5" style="color:#ac0404; font-size:12px; font-weight:bold;">Mail</td>-->
		 
          <th>Date</th>
          <th>Patient ID</th>
          <th>Patient_Name</th>
          <!--<th>Contact</th>
          <th>New/Old</th>
          <th>Ref.Doctor</th>
          <th>Hospital</th>
          <th>Type</th>-->
          <th>Amount</th>
          <!--<td width="40" style="color:#ac0404; font-size:12px; font-weight:bold;">Edit</td>
          <td width="51" style="color:#ac0404; font-size:12px; font-weight:bold;">Delete</td>-->
</tr>
</thead>
<?php
$intRows = 0;
$cnt=0;
$amt=0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)>0) {
while($row= mysql_fetch_row($result))
{
$amt=$amt+$row[2];
//echo "select * from appoint where app_real_id='".$row[1]."'";
//$qry2=mysql_query("select * from appoint where app_real_id='".$row[1]."'");
//$qrro=mysql_fetch_row($qry2);
$result1 = mysql_query("select name from patient where srno='$row[5]'");
$row1=mysql_fetch_row($result1);
//$result2=mysql_query("select doc_id,name from doctor where doc_id='$row1[9]'");
//$row2=mysql_fetch_row($result2);


//$result6=mysql_query("select * from slot where block_id='$row[3]'");
//$row6=mysql_fetch_row($result6);
//$stime=$row6[3];
//$mins=($row[4]-1)* 10;
//echo $mins;
//$added=strtotime($stime." + ".$mins." minutes");
//$apptime=date("h:i a",$added);	 
?>

<tbody>
   <tr>
  <td><?php echo date("d/m/Y",strtotime($row[3])); ?></td>
  <td><?php echo $row[5]; ?></td>
   <td><?php echo $row1[0]; ?></td>
    <td align="right"><div align="right"><?php echo $row[2]; ?></div></td>
    </tr>

<?php
			$intRows++;
			$cnt=$cnt+1;
	?> 

	<?php
	}		
		
	?>
    <tr><td>Total Collection</td><td colspan="8" align="right"><div align="right"><b>Rs. <?php echo $amtro[0].".00"; ?></b></div></td></tr>
    
    </tbody>
    </table>
    

<?php
}
?>
</div>
<?php

}
?>
