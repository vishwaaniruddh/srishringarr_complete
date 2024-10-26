<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select a.wdate,a.next_date,a.room_type,a.adm_date,a.w_real_id,a.type,a.Surgery_start_time,a.Surgery_end_time,a.Diagnosis,a.Suregery,a.ot_type,a.hospital,a.pts,a.implant,a.Anesthetic,a.nbm,a.cat,a.ad_time,b.name,b.srno,b.city,b.mobile,b.age,b.email,b.reference from surgery_wait a,patient b where a.p_id=b.srno and a.waiting='No'";


if(isset($_REQUEST['odate']) && $_REQUEST['odate']!="")
{
$odate=$_REQUEST['odate'];
$query.="and a.next_date like STR_TO_DATE('".$odate."%','%d/%m/%Y') ";
}

$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
########### pagins

$Per_Page = 8;   // Records Per Page
 
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

$query.="order by a.w_id desc LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> 
<div  style="overflow:scroll;width:910px;">
<table class="results" cellpadding="4" cellspacing="0" border="1">
          <tr>
<th width="55" style="color:#ac0404; font-size:12px; font-weight:bold;">ID</th>
<th width="55" style="color:#ac0404; font-size:12px; font-weight:bold;">Surgery Date</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;">Time</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Name</th> 
<th style="color:#ac0404; font-size:12px; font-weight:bold;">N/F,Age</th>	
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Contact no.</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Diagnosis</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Suregery</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> OT Type</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> City</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Hospital Name</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Anesthetic	</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Pts.HB	</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Implant</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Room Type</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> NBM</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Admission	</th>
<th style="color:#ac0404; font-size:12px; font-weight:bold;"> Cat</th>
          </tr>
		  
<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
//$result1 = mysql_query("select * from patient where no='$row[9]'");
//$row1=mysql_fetch_row($result1);

//$result2 = mysql_query("select * from appoint where app_id='$row[10]'");
//$row2=mysql_fetch_row($result2);

$result2 = mysql_query("select diagnosis from opd where patient_id='$row[7]'");
$row2=mysql_fetch_row($result2);

$result3 = mysql_query("select doc_id,name from doctor where doc_id='$row[14]'");
$row3=mysql_fetch_row($result3);

$result6=mysql_query("select * from slot where block_id='$row[2]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[3]-1)* 10;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 	 
?>
	<tr>
	 <td> <?php echo $row[4]; ?></td>
	 <td> <?php if(isset($row[0]) and $row[0]!='0000-00-00') echo date('d/m/Y',strtotime($row[0])); ?></td>
    <td> <?php echo $row[6]."-".$row[7]; ?></td>
    <td> <?php echo $row[18]; ?></td>
	<td> <?php echo $row[5].",".$row[22]; ?></td>
    <td> <?php echo $row[21]; ?></td>
    <td> <?php echo $row[8]; ?></td>
	 <td> <?php echo $row[9]; ?></td>
	  <td> <?php echo $row[10]; ?></td>
	   <td> <?php echo $row[20]; ?></td>
	   <td> <?php echo $row[11]; ?></td>
	    <td> <?php echo $row3[1]; ?></td>
		 <td> <?php echo $row[12]; ?></td>
		  <td> <?php echo $row[13]; ?></td>
		   <td> <?php echo $row[2]; ?></td>
		    <td> <?php echo $row[15]; ?></td>
    <td> <?php if(isset($row[3]) and $row[3]!='0000-00-00') echo date('d/m/Y',strtotime($row[3])); echo "<br/>".$row[17]?></td>
   <td> <?php echo $row[16]; ?></td>
    </tr>
    

<?php $intRows++; } echo"</table></div>"; ?>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<font size="3">Total Records : <?php echo $Num_Rows;?>  </font>
<?php
}
if($Prev_Page) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
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
if($Page!=$Num_Pages)
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page')\">Next >></a> </li>";
}
?>
</font></div>
<?php
############
}
else{
echo "<div class='error'>No Records Found!</div>";
}
 
 
 ################ home end

?>
<form method="post" action="mail1.php" >
<input type="hidden" name="msg" value="<?php echo $query; ?>" />
<input type="submit" value="mail1" class=" submit formbutton"/>
</form>