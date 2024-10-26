<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select a.app_real_id,a.app_date,a.block_id,a.slot,a.hospital,a.new_old,b.name,b.no,b.city,b.telno,b.age,b.email,b.reference,b.mobile,b.add from appoint a,patient b where a.no=b.srno and a.waiting_list='0' and a.status=''";


if(isset($_REQUEST['odate']) && $_REQUEST['odate']!="")
{
$odate=$_REQUEST['odate'];
$query.="and a.app_date like STR_TO_DATE('".$odate."%','%d/%m/%Y') ";
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

$query.="order by a.app_id desc LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> 
<link href="All_MiddleBar.css" rel="stylesheet" type="text/css" />
<div  style="overflow:scroll;width:auto;">
<table class="results">
 <thead>
       
          <tr>
          <th>Time</th>
          <th>Name</th>
          <th>Hospital </th>
          <th>City </th>
          <th>Date </th>
          <th>Contact</th>
          <th>N/F,Age</th>
          <th>Email</th
          ><th>Ref</th>
          <th>Diagnosis</th>
          </tr>
</thead>
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

$result3 = mysql_query("select doc_id,name from doctor where doc_id='$row[12]'");
$row3=mysql_fetch_row($result3);

$result6=mysql_query("select * from slot where block_id='$row[2]'");
$row6=mysql_fetch_row($result6);
$stime=$row6[3];
$mins=($row[3]-1)* 10;
$added=strtotime($stime." + ".$mins." minutes");
$apptime=date("h:i a",$added);	 
if($row[13]==""){
$phone=$row[9]	;
}else if($row[13]==""){

$phone=$row[14]	;
}elseif($row[14]==""){

$phone=$row[9]	;
} 
?>
<tbody>
	<tr>
    <td> <?php echo $apptime; ?></td>
    <td> <?php echo $row[6]; ?></td>
    <td> <?php echo $row[4]; ?></td>
    <td> <?php echo $row[8]; ?></td>
    <td> <?php if(isset($row[1]) and $row[1]!='0000-00-00') echo date('d/m/Y',strtotime($row[1])); ?></td>
    <td> <?php echo $phone; ?></td>
    <td> <?php echo $row[5].",".$row[10]; ?></td>
    <td style="text-transform:lowercase"> <?php echo $row[11]; ?></td>
    <td> <?php echo $row3[1]; ?></td>
    <td style="word-break:break-all;"> <?php echo $row2[0]; ?></td>
    </tr>
    </tbody>
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
<form method="post" action="mail.php" >
<input type="hidden" name="msg" value="<?php echo $query; ?>" />
<button type="submit" value="" class=" submit formbutton" >Mail </button>
</form>




