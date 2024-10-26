<?php
include('config.php');
############# must create your db base connection
 
$strPage = $_REQUEST['Page'];
if($_REQUEST['mode']=="Listing"){
	
$query ="select a.w_real_id,a.p_id,a.wdate,a.days,a.waiting,b.no,b.name,b.mobile,b.city,b.telno,a.next_date from surgery_wait a,patient b where a.p_id=b.srno and a.waiting='Yes' and ";

if(isset($_REQUEST['id']))
{
	
$id=$_REQUEST['id'];

$query.="a.w_real_id like('".$id."%') ";
}

if(isset($_REQUEST['fname']))
{
$fname=$_REQUEST['fname'];
$query.="and b.name like('".$fname."%') ";
}

if(isset($_REQUEST['cont']))
{
$cont=$_REQUEST['cont'];
$query.="and b.mobile like('".$cont."%') ";
}

if(isset($_REQUEST['city']))
{
$city=$_REQUEST['city'];
$query.="and b.city like('".$city."%') ";
}

if(isset($_REQUEST['sdate']) && $_REQUEST['sdate']!="")
{
	
$sdate=$_REQUEST['sdate'];
//echo "hi";
$query.="and a.next_date like STR_TO_DATE('".$sdate."%','%d/%m/%Y')";
}

$result = mysql_query($query) or die(mysql_error());
 
$Num_Rows = mysql_num_rows ($result);
 
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

$query.=" order by a.wdate ASC LIMIT $Page_Start , $Per_Page";
$result = mysql_query($query) or die(mysql_error());

?> <table class="results">
 
       
         <tr> 
         <td style="color:#ac0404; font-size:12px; font-weight:bold;">ID</td>
         <td style="color:#ac0404; font-size:12px; font-weight:bold;">Full Name </td>
         <td style="color:#ac0404; font-size:12px; font-weight:bold;">Contact </td>
         <td style="color:#ac0404; font-size:12px; font-weight:bold;">City </td>
		 <td style="color:#ac0404; font-size:12px; font-weight:bold;">Waiting Date</td>
		 <td style="color:#ac0404; font-size:12px; font-weight:bold;">Surgery Date</td>
         <td style="color:#ac0404; font-size:12px; font-weight:bold;">Number of days</td>
         <td style="color:#ac0404; font-size:12px; font-weight:bold;">Give Appointment</td>
         <td style="color:#ac0404; font-size:12px; font-weight:bold;">Delete</td>
         </tr>

<?php
$intRows = 0;
// Insert a new row in the table for each person returned
if(mysql_num_rows($result)) {
while($row= mysql_fetch_row($result))
{
	 
?>
<tr>
    <td><?php echo $row[0]; ?></td>
<?php
$result1 = mysql_query("select * from patient where srno='$row[1]'");
//$result1 = mysql_query("select doc_id,name from new_doc ");
$row1=mysql_fetch_row($result1);
?>  
    <td><?php  echo $row1[6]; ?></td>
    <td><?php  echo $row1[23]; ?></td>
    <td><?php  echo $row1[18]; ?></td>
	<td><?php if(isset($row[2]) and $row[2]!='0000-00-00') echo date('d/m/Y',strtotime($row[2])); ?></td>
	<td><?php if(isset($row[10]) and $row[10]!='0000-00-00') echo date('d/m/Y',strtotime($row[10])); ?></td>
    <td><?php  echo $row[3]; ?></td>
    <td><a href="edit_optsurgery.php?id=<?php echo $row[0]; ?>">Give Appointment</a></td>
    <td><a href="javascript:Ddelete('<?php echo  $row[0]; ?>')"> Delete </a></td>
    </tr>
	 <?php
			$intRows++;
	?> 

	<?php
			
		}
		echo"</table>";
	?>

<div class="pagination" style="width:100%;"><font size="4" color="#000">
<!--Total <?php //echo $Num_Rows;?> Record : -->
<?php
}
if($Prev_Page) 
{
	echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
}

for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
	}
	else
	{
		echo "<li class='currentpage'><b> $i </b></li>";
	}
}
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