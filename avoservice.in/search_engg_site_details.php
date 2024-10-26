<?php
include("access.php");
include("config.php");
session_start();

//echo $_SESSION['logid']." ".$_SESSION['branch']." ".$_SESSION['designation'];

//echo $_SESSION['designation'];
$strPage = $_REQUEST['Page'];



$branch = $_POST['Branch'];
$status= $_POST['status'];// distance required
$table= $_POST['table'];
$city= $_POST['city']; 
$siteid= $_POST['siteid'];
?>
<body>
<form name="form1" method="post">

<table align="center" width="600" border="2" cellpadding="2" cellspacing="0" style="margin-top:5px;margin-left:20px;" id="custtable">
    <thead>
		            <tr>
		                <th width="2%">S.No</th>
		                <th width="8%">Branch</th>
		                <th width="8%">Customer / Vertical</th>
		                <th width="8%">Site ID</th>
		                <th width="10%">End User Name</th>
		                <th width="25%">Site Address</th>
		                <th width="10%">Distance</th>
		                <th width="5%">Last Call Closed</th>
		                <th width="8%">Action</th>
		            </tr>  
	 </thead>
	 
<?php
$engg_id = $_POST['Employee_name'];
if($engg_id ==""){
if($SESSION['designation']==4){
$qry2=mysqli_query($con1,"select engg_id, area from area_engg where loginid ='".$_SESSION['logid']."' and status=1 and deleted=0");
$qry2ro=mysqli_fetch_row($qry2);
$engg_id =$qry2ro[0];
$branch =$qry2ro[1];
}
}
$engqry=mysqli_query($con1,"select engg_name, area, latitude,longitude from area_engg where engg_id ='".$engg_id."' and status=1 and deleted=0");
$engrow=mysqli_fetch_row($engqry);
$branch =$engrow[1];
$latitude=$engrow[2];
$longitude=$engrow[3]; 




//echo $engg_id."</br>";
//echo $latitude."---".$longitude;
$date=date('Y-m-d H:i:s', strtotime('-1 hour'));

if($status=='current'){
 //   echo "SELECT * from engg_current_location where engg_id='".$engg_id."' and last_updated > '$date' and latitude !='0.0' ";
$currqry=mysqli_query($con1,"SELECT * from engg_current_location where engg_id='".$engg_id."' and last_updated > '$date' and latitude !='0.0' ");
if(mysqli_num_rows($currqry)>0){
$cnt = mysqli_fetch_row($currqry);
 $latitude=$cnt[2];
$longitude=$cnt[3];
$radius = 10*0.621371192; // in km
} else { echo "No current Location found";
die;
}
} else if($status==25){
    //$radius = 20; // in miles
    $radius = 30*0.621371192; // in km
} else if($status==50){
     $radius = 50*0.621371192; // in km
} else if($status==100){
     $radius = 100*0.621371192; // in km
} else if($status==150){
     $radius = 150*0.621371192; // in km
} 
//echo $latitude." - ".$engg_id."--".$radius;   


    $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
    $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
    $lat_min = $latitude - ($radius / 69);
    $lat_max = $latitude + ($radius / 69);
if($table=='Amc') {   
    $site="amc";
if($status !='all')
    $abc="SELECT amcid,atmid,cid,branch,bankname,address,latitude1,longitude1,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude1 ) ) 
              * cos( radians( longitude1 ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude1 ) ) ) ) AS distance FROM Amc WHERE (longitude1 BETWEEN $lng_min AND $lng_max) AND (latitude1 BETWEEN $lat_min and $lat_max) and active='Y' and branch='".$branch."' and cid !=96 ";
else 
$abc ="SELECT amcid,atmid,cid,branch,bankname,address,latitude1,longitude1 FROM Amc where active='Y' and branch='".$branch."' and cid !=96";

if($siteid !="") {
    
    
   $abc.=" and atmid like '%".$siteid."%'"; }
    
} else if($table=='atm') {
    $site="site";
 if($status !='all')   
    $abc="SELECT track_id, atm_id,cust_id,branch_id,bank_name,address,latitude1,longitude1,(6371 * acos( cos( radians($latitude) ) 
              * cos( radians( latitude1 ) ) 
              * cos( radians( longitude1 ) - radians($longitude) ) 
              + sin( radians($latitude) ) 
              * sin( radians( latitude1 ) ) ) ) AS distance FROM atm WHERE (longitude1 BETWEEN $lng_min AND $lng_max) AND (latitude1 BETWEEN $lat_min and $lat_max) and active='Y' and branch_id='".$branch."' ";
    else
    $abc="SELECT track_id, atm_id,cust_id,branch_id,bank_name,address,latitude1,longitude1 FROM atm where active='Y' and branch_id='".$branch."'"; 
    
if($siteid !="") {
   $abc.=" and atm_id like '%".$siteid."%'"; }
    }            

/*$abc ="SELECT amcid,atmid,cid,branch,bankname,address FROM (
SELECT amcid,atmid,cid,branch,bankname,address, 
        (
            (
                (
                    acos(
                        sin(( $latitude * pi() / 180))
                        *
                        sin(( `latitude1` * pi() / 180)) + cos(( $latitude * pi() /180 ))
                        *
                        cos(( `latitude1` * pi() / 180)) * cos((( $longitude - `longitude1`) * pi()/180)))
                ) * 180/pi()
            ) * 60 * 1.1515 * 1.609344
        )
    as distance FROM `Amc`
    ) Amc WHERE distance <= 25 and branch='".$branch."'";*/

if($city!=""){
$abc.=" and address like '%".$city."%'";
// echo $abc;
}




 $result=mysqli_query($con1,$abc);
 $Num_Rows=mysqli_num_rows($result);

$Per_Page =$_POST['perpg'];   // Records Per Page

$Page = $strPage;

if($strPage=="")
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

$export=$abc;
if($table=='atm'){
$abc.=" ORDER BY track_id DESC LIMIT $Page_Start , $Per_Page ";
} elseif($table=='Amc') {
    $abc.=" ORDER BY amcid DESC LIMIT $Page_Start , $Per_Page ";
}	
//echo $abc;

$qrys=mysqli_query($con1,$abc);

	$count=mysqli_num_rows($qrys);

$count=1;
	if($Page=="1" or $Page=="")
	{
	$count="1";
	}else
	{
	  $count=($fix* $Page)-$fix;
	  $count=$count+1;
	}

?>
<div align="center">Total Number Of Records :>> <?php echo $Num_Rows; ?>
 Records Per Page :<select name="perpg" id="perpg" onchange="searchById('Listing','1','perpg');">
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%20==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo "All"; ?></option>
 </select>
 
 </div>
 <?php
//echo $abc;
//die;
$qry=mysqli_query($con1,$abc);


$cnt=1;
while($row=mysqli_fetch_row($qry))
{

$custqry=mysqli_query($con1,"select cust_name from customer where cust_id='".$row[2]."'");
$cust=mysqli_fetch_row($custqry);

$qry2=mysqli_query($con1,"select name from avo_branch where id='".$row[3]."'");
$branch=mysqli_fetch_row($qry2);

$dis= $row[8];// / 60 / 1.1515 / 1.609344;

?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">

<td><?php echo $cnt; ?></td>
<td class="sticky"><?php echo $branch[0]; ?></td>
<td><?php echo $cust[0]; ?></td>
<td><?php echo $row[1]; ?></td> 
<td><?php echo $row[4]; ?></td> 
<td><?php echo $row[5]; ?></td>
<td><?php echo $dis; ?></td>
<!--<td><?php echo $row[6].", ".$row[7]; ?></td>-->
<?php 
$alerqry=mysqli_query($con1,"select date(close_date) from alert where atm_id='".$row[0]."' and (status='Done' or call_status='Done') and call_status !='Rejected' order by alert_id DESC ");
$alert=mysqli_fetch_row($alerqry);

$cdate=date('Y-m-d', strtotime('+3 months', strtotime($alert[0])));
$now=date('Y-m-d');

if($now > $cdate){ $log="Last Call within 3 Months"; }
?>
<td><?php echo $alert[0]; ?></td>
<td>
<?php if($now > $cdate){ ?>

<div id="app<?php echo $row[0]; ?>"><input class="buttn" type='button' onClick="create_pm('<?php echo $row[0]; ?>','<?php echo $site; ?>','<?php echo $engg_id; ?>');" style="background:#; height:25px" value='Generate PM'></div>

<!--<div><input class="buttn" type='button' onClick='window.open("route_plan.php","_blank");' style="background:#; height:20px" value='Route Plan'></div>-->
<?php } else {echo "You Can not go repeatedly within 2 months";}
?>
</td>

</tr>

 <?php
$cnt++;
  ?>
<?php 
} 
    

?>

</table>

<?php 
 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back</center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}

?>


</form>
<form name="frm" method="post" action="export_eng_sites.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $export; ?>" readonly>
<input type="hidden" name="site" value="<?php echo $site; ?>" readonly>
<input type="hidden" name="engg" value="<?php echo $engg_id; ?>" readonly>
<center><input type="submit" name="cmdsub" value="Export" > <span>(MAX 500 Records.)</span></center>
</form> 
</body>