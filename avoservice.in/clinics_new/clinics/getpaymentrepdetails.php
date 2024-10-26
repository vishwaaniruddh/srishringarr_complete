<?php
include 'config.php';
$strPage = $_REQUEST['Page'];

$frdt="";
$todt="";

$pay=$_REQUEST['pay'];
$payto=$_REQUEST['payto'];


$docids="";
$query="select * from payment_dets where 1";

if($payto!="")
{
	
	$query.=" and pay_to='".$payto."'";
	
}

if($pay!="")
{
	
	$query.=" and pay='".$pay."'";
	
}

if($_REQUEST['frdt']!="")
{
	
$frdt=date("Y-m-d",strtotime(str_replace("/","-",$_REQUEST['frdt'])));
$query .=" and pay_dt>='".$frdt."'";	
}

if($_REQUEST['todt']!="")
{
	
$todt=date("Y-m-d",strtotime(str_replace("/","-",$_REQUEST['todt'])));
$query .=" and pay_dt<='".$todt."'";
}


//echo $query;

$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}
 
$Num_Rows = mysqli_num_rows($result);
 
$Per_Page = 15;   // Records Per Page
 
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

$query.=" order  by pay_dt ASC LIMIT $Page_Start , $Per_Page";
//echo $query;
$result = mysqli_query($con,$query);
if(!$result){
	mysqli_error($con);
}

?>
<table width="100%"  border="1" id="results" cellpadding="4" cellspacing="0">
 
       
         <tr> <td width="10%" align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Sr No.</td>
		 <td width="25%" align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Name</td>
           <td width="25%" align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Description</td>
          <td width="20%" align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Date </td>
		  <td width="20%"align="center" style="color:#ac0404; font-size:14px; font-weight:bold;">Amount </td>
          
</tr>

<?php
$intRows = 0;
$srno=1;
$totamt=0;
if(mysqli_num_rows($result)) 
{
while($row= mysqli_fetch_array($result))
{
	$getnmqr="";
	
	if($row[1]=="1")
	{
		
	$getnmqr="select name from doctor where doc_id='".$row[2]."'";	
		
	}
	elseif($row[1]=="2")
	{
		
	$getnmqr="select name from staff where staff_id='".$row[2]."'";	
		
	}
	elseif($row[1]=="3")
	{
		
	$getnmqr="select namer from other_typ where id='".$row[2]."'";	
		
	}
	
	$exeqr=mysqli_query($con,$getnmqr);
	
	$fetr=mysqli_fetch_array($exeqr);
	
?>
<tr>

<td  width='10%'><?php echo $srno; ?></td>
<td  width='25%'><?php echo $fetr[0]; ?></td>
    <td  width='25%'><?php echo $row[4]; ?></td>
	<td  width='20%'> <?php echo date("d/m/Y",strtotime($row[5])); ?></td>
    <td  width='20%'align="right"><?php echo  $row[3];$totamt=$totamt+$row[3]; ?></td>
</tr><?php
$srno++;
			$intRows++;
	?> 

	<?php
			
		}
		?>
		<tr>
		<td colspan="3"></td>
		<td align="center"><b>Total<b></td>
		<td align="right"><b><?php echo $totamt; ?></b></td>
		
		</tr>
		</table>

<div class="pagination" style="width:100%;"><font size="4" color="#000">

<?php
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
?>