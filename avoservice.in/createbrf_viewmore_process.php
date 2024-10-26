<?php
include 'config.php';
include("access.php");
$brfid=$_POST['brfid'];

$fix=10;

$brfid=$_POST['brfid'];
$strPage=$_POST['Page'];



$sql="select * from BRF_details where Brf_id='".$brfid."'";
$rst=mysqli_query($con1,$sql);
    
     $Num_Rows=mysqli_num_rows($rst);

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

$sql.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($con1,$sql);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	// echo "ram".($Page_Start* $Page)-$Page_Start;
	   // echo $fix."-".$Page."-".$fix;
	//   $sr=($Page_Start* $Page)-$Page_Start;
	  $sr=($fix* $Page)-$fix;
	  
	   $sr=$sr+1;
	}


  
   ?> 
   
<html>
<head>

</head>

<style>
.space{margin-left:80px;}
.addcolor{font-size:20px; color:#C60000; font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
</style>

<body>
<Form>
<center>



<div align="center">Total number of Records :<b><?php echo $Num_Rows; ?></b>

<!--=================================================-->
<!-- Records Per Page :<select name="perpg" id="perpg" onchange="a('1','perpg');">-->

 <?php
/*
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {

 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 */
 ?>
<!-- <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>-->
 </select>
 
 
<!--=================================================-->


</div></br>

  <table border="1" style="margin-top:30px"  width="100%">
  <tr>
      
         <th>Sr</th>
      <th>BRF_id</th>
    <th>BatterySerialNo</th>
    <th>Charging_Voltage</th>
    <th>Discharge</th>
   <th>DischargeVoltage</th>


  </tr>

  <?php  while($row = mysqli_fetch_array($qrys)) { ?>

 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <td><?php echo $row["Brf_id"];?></td>
    <td><?php echo $row["BatterySerialNo"];?></td>
    <td><?php echo $row["Charging_Voltage"];?></td>
    <td><?php echo $row["Discharge"];?></td>
    <td><?php echo $row["DischargeVoltage"];?></td>
   
   </tr>



   <?php
$sr++;
  ?>
<?php 
}
?>

</table>


 <?php 
 
if($Prev_Page) 
{
	echo " <center><a href=\"JavaScript:a('$Prev_Page','perpg')\"> << Back></center></a> ";
}

if($Page!=$Num_Pages)
{
	echo " <center><a href=\"JavaScript:a('$Next_Page','perpg')\">Next >></center></a> ";
}

?>
</form>


</body>
</html>







