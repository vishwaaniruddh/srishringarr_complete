<?php
include 'config.php';
############# must create your db base connection
$dt=date('Y-m-d');
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select b.esino,b.name,b.relation,b.esiname,b.ref,b.referral_date,a.admit_date,a.admit_time,b.diagnosis ,a.treat_type from admission a,patient b where a.patient_id=b.no ";

if(isset($_REQUEST['adate']) && $_REQUEST['adate']!="")
{
$adate=$_REQUEST['adate'];
$query.="and a.admit_date like STR_TO_DATE('".$adate."%','%d/%m/%Y') ";
}

else
$query.="and a.admit_date='".$dt."'";

$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}
 
$Num_Rows = mysqli_num_rows ($result);
 
########### pagins

$Per_Page = 10;   // Records Per Page
 
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

$query.="order by a.ad_id desc LIMIT $Page_Start , $Per_Page";
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}

?> 
<style>
td{ padding:2px;}
</style>

<table class="results" border="1" style="font-size:14px; border:1px #ac0404 solid;">
          <tr>
		  <td style="color:#ac0404; font-size:12px; font-weight:bold;">IP NO.</td>
		  <td style="color:#ac0404; font-size:12px; font-weight:bold;">IP Name</td>
		  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Dependent Name</td>
		  <td style="color:#ac0404; font-size:12px; font-weight:bold;">Relation with IP</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Patient Name</td>		  
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Case Reg no.</td>	
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Ref No.</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Ref Date</td>	
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Treatment Type</td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Diagnosis</td>		  	  		  	  
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Admit Date </td>
          <td style="color:#ac0404; font-size:12px; font-weight:bold;">Admit Time </td>
          </tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysqli_num_rows($result)) {
while($row= mysqli_fetch_row($result))
{
//$result1 = mysqli_query($con,"select * from patient where no='$row[1]'");
//$row1=mysqli_fetch_row($result1);

//$result2 = mysqli_query("select * from appoint where app_id='$row[10]'");
//$row2=mysqli_fetch_row($result2);

//$result2 = mysqli_query("select diagnosis from opd where patient_id='$row[7]'");
//$row2=mysqli_fetch_row($result2);

//$result3 = mysqli_query("select doc_id,name from doctor where doc_id='$row[10]'");
//$row3=mysqli_fetch_row($result3);

?>

	<tr>
        <td> <?php echo $row[0]; ?></td>
      <td> <?php echo $row[3]; ?></td>
      <td> <?php echo $row[1]; ?></td>
      <td> <?php echo $row[2]; ?></td>
      <td> <?php echo $row[1]; ?></td>
     <td> &nbsp; </td>
     <td> <?php echo $row[4]; ?></td>
    <td width="71" height="31"> <?php if(isset($row[5]) and $row[5]!='0000-00-00') echo date('d/m/Y',strtotime($row[5])); ?></td>
    <td> <?php echo $row[9]; ?> </td>
    <td> <?php echo $row[8]; ?></td>
    <td> <?php echo $row[6]; ?></td>
    <td> <?php echo $row[7]; ?></td>   
   
    </tr>
    
<?php $intRows++; } echo"</table>"; ?>

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
<form method="post" action="mail_ad.php" >
<input type="hidden" name="msg" value="<?php echo $query; ?>" />
<input type="submit" value="Mail" class=" submit formbutton"/>
</form>
