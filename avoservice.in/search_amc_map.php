<?php
include('config.php');

session_start();
//require("myfunction/function.php");
############# must create your db base connection

//echo $_SESSION['designation']; echo $_SESSION['branch']; echo $_SESSION['user'];


$strPage = $_REQUEST['Page'];
 $br=$_POST['br'];
//$status=$_POST['mapp'];

echo $status;
//==========================================	
if($_POST['br']=='all')
$sql="Select * from Amc where active='Y'";
else
 $sql="Select * from Amc where active='Y' and branch in(".$br.") ";	

if(isset($_POST['mapp']) && $_POST['mapp']!='')
{
$status=$_POST['mapp'];    
if($status =='mapped')
//echo "select site_id from engg_site_mapping_warr where engg_id !='' ";
$map_qry=mysqli_query($con1,"select site_id from engg_site_mapping where (engg_id !='' or engg_id !=0) ");

else if($status =='unmapp')
$map_qry=mysqli_query($con1,"select site_id from engg_site_mapping where (engg_id ='' or engg_id is NULL) ");
$all_alid=array();
while($eng_alert1=mysqli_fetch_row($map_qry)){
         
	 $all_alid[]=$eng_alert1[0];
}
$alert_string = implode(",",$all_alid);

$sql.=" and amcid in ($alert_string)";

}	
//echo $sql;

if(isset($_POST['id']) && $_POST['id']!='')
{
$id=$_POST['id'];
$sql.=" and atmid LIKE '%".$id."%'";
}

if(isset($_POST['add']) && $_POST['add']!='')
{
$add=$_POST['add'];
$sql.=" and address LIKE '%".$add."%'";
}
if(isset($_POST['cid']) && $_POST['cid']!='')
{
$cid=$_POST['cid']; 
$sql.=" and cid IN('".$cid."')";
}

if(isset($_POST['branch']) && $_POST['branch']!='')
{
$branch=$_REQUEST['branch'];
$sql.=" and branch='".$branch."'";
}

//echo $sql;
$table=mysqli_query($con1,$sql);

$Num_Rows = mysqli_num_rows ($table);
 
########### pagins
?>
 <div align="center"><b>Total Records: <?php echo $Num_Rows; ?></b>&nbsp;&nbsp;&nbsp;
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
$qry22=$sql;
$sql.=" order by amcid DESC LIMIT $Page_Start , $Per_Page";

//echo $sql;
$table=mysqli_query($con1,$sql);

include("config.php");
?>
<table border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;"  id="custtable"> 


<th width="77">Vertical/Customer</th>
<th width="75">Sol/Sol/ATM Id</th>
<th width="40">End User</th>
<th width="50">City</th>
<th width="70">Address</th>
<th width="95">State</th>
<th width="95">Branch</th>
<th width="70">Mapped Engineer</th>
<th width="70">Map / Change Engineer</th>

<th width="70">Distance </th>


<?php
if(mysqli_num_rows($table)>0) {
while($row= mysqli_fetch_row($table))
{
	
$qry1=mysqli_query($con1,"select cust_name from customer where cust_id='$row[1]'");
$crow=mysqli_fetch_row($qry1);
$qrybr=mysqli_query($con1,"select name from avo_branch where id='$row[8]'");
$bran=mysqli_fetch_row($qrybr);	

?><div class=article>
<div class=title><tr>

<td width="77"><?php echo $crow[0] ?></td>
<td width="40"><?php echo $row[3] ?></td>

<td width="50"><?php echo $row[4] ?></td>
<!---state-->
<td width="95"><?php echo $row[7] ?></td>
<td width="70"><?php echo $row[9] ?></td>
<td width="70"><?php echo $row[10] ?></td>
<td width="70"><?php echo $bran[0] ?></td>
<?
//echo "select engg_id,id from engg_site_mapping where site_id='$row[0]' order by id desc";
$qry1=mysqli_query($con1,"select engg_id,id from engg_site_mapping where site_id='$row[0]' order by id desc");

$enrow=mysqli_fetch_row($qry1);
$mapid=$enrow[1];

$engqry=mysqli_query($con1,"select engg_name, status from area_engg where engg_id='$enrow[0]' ");
$engrow=mysqli_fetch_row($engqry);
if(mysqli_num_rows($engqry)==0) { $enng="Eng Not Mapped";}
elseif($engrow[1]==1) {$enng=$engrow[0]; }
else{ $enng=$engrow[0]." - Engineer Left, assign"; }
?>
<td width="95"><?php echo $enng ?></td>


<div id="subdiv<?php echo $mapid; ?>" >
<td width="20"> 
<select name="bbchange<?php echo $mapid; ?>" id="bbchange<?php echo $mapid; ?>" >
<? $qrybr=mysqli_query($con1,"select engg_id, engg_name,city from area_engg where area='$row[8]' and status=1");


?>
<option value=""> Select </option>
<?
while($engan=mysqli_fetch_row($qrybr)) { 

$cityqr=mysqli_query($con1,"select city from cities where city_id='$engan[2]'");
$city=mysqli_fetch_row($cityqr);
?>	

<option value="<?php echo $engan[0]; ?>"><?php echo $engan[1]." - ".$city[0]; ?></option>
<? } ?>        
</select>
</td>
    
<td width="20">		
<input type="button" name="submission" value="submit" onclick="setamcchange(<?php echo $mapid; ?>)" />

</td>	
</div>

</tr></div></div><?php
}

?></table>
<div class="pagination" style="width:90%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <a href=\"JavaScript:searchById('Listing','$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:searchById('Listing','$Next_Page','perpg')\">Next >></a> ";
}
?> 
<form name="frm" method="post" action="export_mapp_amc.php" target="_new">
<input type="hidden" name="qr" value="<?php echo $qry22; ?>" readonly>
<input type="submit" name="cmdsub" value="Export" >
</form>