<?php
//include("access.php");
include("config.php");
session_start();
$strPage = $_REQUEST['Page'];
//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];

$engg_id=$_POST['engr'];
$sdate=$_POST['sdate'];
$edate=$_POST['edate'];
$branch=$_POST['branch'];

?>
<table width="100%" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" id="custtable" >
<tr>
<th width="5%">Complain ID</th>
 
<th width="5%">Vertical</th>
<th width="5%">Site/Sol/ATM Id</th>
<th width="5%">User Customer Name</th>
<th width="5%">City</th>
<th width="10%">Address</th>
<th width="5%">AVO Branch</th>
<th width="5%">Problem</th>
<th width="5%">Alert Date</th>
<th width="5%">Call Type</th>

<th width="20%">Last FeedBack</th>
<th width="5%">Reached Time</th>
<th width="3%">Call Status</th>
<th width="5%">Engineer Name</th>
<th width="10%">Engr at Site</th>

</tr>
<?php

 if(isset($_POST['sdate']) && $_POST['sdate']=='' || isset($_POST['edate']) && $_POST['edate']=='')
 {
     echo "Select Dates First";
 } else

 if(isset($_POST['engr']) && $_POST['engr']!='')
 {
$qry1 = "SELECT loginid, engg_name, engg_id FROM `area_engg` where engg_id='".$engg_id."'"; }
else $qry1 = "SELECT loginid, engg_name, engg_id FROM `area_engg` where area in ('".$branch."') and status=1 and deleted=0"; 
$eng_row=mysqli_query($con1,$qry1);

while ($logid=mysqli_fetch_array($eng_row)) {
    $loginid[]=$logid[0];
}
$Engg_string = implode(",",$loginid);
$result = "SELECT alert_id, responsetime,engg_id FROM `alert_progress` where engg_id in($Engg_string) and responsetime between STR_TO_DATE('$sdate','%d/%m/%Y') and STR_TO_DATE('$edate','%d/%m/%Y') + INTERVAL 1 DAY ";

$trow=mysqli_query($con1,$result);

$count=0;
$Num_Rows = mysqli_num_rows ($trow);
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


$qr=$result;

$result.=" order by alert_id DESC LIMIT $Page_Start , $Per_Page";
//echo $result;

$table=mysqli_query($con1,$result);
if(mysqli_num_rows($table) >0){
while($calls = mysqli_fetch_row($table)){

$sql="Select * from alert where alert_id ='".$calls[0]."' ";
//echo $sql;
$aler=mysqli_query($con1,$sql);
$row= mysqli_fetch_row($aler);

     
	$qry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[1]."'");
	$custrow=mysqli_fetch_row($qry);
	
	if ($row[21]=='site') {
	$atmid= mysqli_query($con1,"select select atm_id,latitude,longitude,address,city,state1 from atm where track_id='".$row[2]."'"); 
	    
	} else if ($row[21]=='amc') {
	$atmid= mysqli_query($con1,"select atmid,latitude1,longitude1,address,city,state from Amc where amcid='".$row[2]."'"); 
	}
	$atmdet=mysqli_fetch_row($atmid);
	$atm_id=$atmdet[0];
	
	if($atm_id=='') { $atm_id= $row[2]; }
	
	$tab=mysqli_query($con1,"select feedback,feed_date from eng_feedback where alert_id='".$row[0]."' order by feed_date DESC limit 1");
	$row1=mysqli_fetch_row($tab);
	
	$br= mysqli_query($con1,"select name from avo_branch where id='".$row[7]."'"); 
	
	$branch=mysqli_fetch_row($br);
	?>
<tr>
<td valign="top"><?php echo $row[25]; ?></td>
<td valign="top">&nbsp;<?php echo $custrow[0]; ?></td> <!-- Vertical Name-->
<td valign="top">&nbsp;<?php echo $atm_id ; ?></td>
<td valign="top">&nbsp;<?php echo $row[3]; ?></td>
<td valign="top">&nbsp;<?php echo $row[6];?></td>
<td valign="top">&nbsp;<?php  echo $row[5]; ?></td>
<td valign="top">&nbsp;<?php echo $branch[0]; ?></td>
<td valign="top">&nbsp;<?php echo $row[9] ?></td>
<td valign="top">&nbsp;<?php echo $row[10] ?></td>


<td valign="top">&nbsp;<?php echo $row[17] ?></td> <!-- Call type-->
<td valign="top">&nbsp;<?php echo $row1[0] ?></td>
<td valign="top">&nbsp;<?php echo $calls[1] ?></td>

<td valign="top">&nbsp;<?php if ($row[15]=='Done') {echo "Closed By Engineer";} else if($row[16]=='Done') {echo "Closed By Branch" ;} ?></td> <!-- Status-->


<?php
   //=================================================
 $cdate = $calls[1];
$rdate = date("Y-m-d",strtotime($cdate)); 


$engqry = "SELECT engg_id, engg_name FROM `area_engg` where loginid='".$calls[2]."'";
//echo $engqry;
$engg_row=mysqli_query($con1,$engqry); 
$eng_idd=mysqli_fetch_row($engg_row);

//echo "Hello".$eng_idd;
  
$mintime = date("Y-m-d H:i:s", strtotime("-1 minute", strtotime($cdate)));
$maxtime=  date("Y-m-d H:i:s", strtotime("+1 minute", strtotime($cdate)));

$timeqry = "SELECT latitude, longitude FROM `Location` where dt between '$mintime' and '$maxtime' and engg_id ='$eng_idd[0]' order by id DESC limit 1 "; 
//echo $timeqry;
$time_row=mysqli_query($con1,$timeqry); 
$time_row=mysqli_fetch_row($time_row);  

$latitude=$time_row[0]; 
$longitude=$time_row[1]; 
//echo $latitude."--".$longitude;
?>
<td> <?php echo $eng_idd[1]; ?></td>
<td valign="top">
    <?php

if($latitude ==0) { echo "Unable to get LatLong"; } 
  else {
    //$radius = 20; // in miles
    //  $radius = 25*0.621371192; // in km
    $radius = 0.5*0.621371192;

    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);
 
 //echo $longitude."===".$lng_min."---".$lng_max;
   //=======or Engineer Residence========



  /* $qry2="SELECT *,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude ) ) 
              * cos( radians( longitude ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude ) ) ) ) AS distance FROM Location WHERE  (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) and engg_id='".$eng_idd[0]."' and date(dt)='".$calls[1]."' ORDER BY dt ASC"; */
$qry2="SELECT * FROM Location WHERE  (longitude BETWEEN $lng_min AND $lng_max) AND (latitude BETWEEN $lat_min and $lat_max) and engg_id='$eng_idd[0]' and CAST(dt AS date)= '$rdate' order by dt ASC";

//echo $qry2;
$res=mysqli_query($con1,$qry2);
if(mysqli_num_rows($res) >0){
while ($locrow=mysqli_fetch_row($res)) {
    $ftime[]=$locrow[4];
}

$first=current($ftime);
$end=end($ftime);
$total = count($ftime);
//echo $ftime[0];
//echo "<br>";
//echo $ftime[$total-1];
//echo "<br>";
//echo "st:".$first."end:".$end;
$diff = abs(strtotime($end) - strtotime($first));
$tmins = $diff/60;
$hours = floor($tmins/60);
$mins = $tmins%60;

echo $hours." Hours, ".$mins." Minutes";
// echo "From: ".reset($ftime)." Till: ".end($ftime);
  } else echo "No Records Found"; }

?>
</td>

</tr>
<? } ?>
</table>
<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252> << Back</font></a>";
}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
if($Page!=$Num_Pages)
{
echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\" style=\"text-decoration:none\"><font color=:#005252>Next >></font></a>";
}

?>
</div>

<form name="frm" method="post" action="export_visit_duratn.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qr; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>
 
<div id="bg" class="popup_bg"> </div>
