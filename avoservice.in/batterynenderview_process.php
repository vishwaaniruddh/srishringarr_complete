<?php
include 'config.php';
include("access.php");

$fix=10;



$abc="select * from batteryVendor where 1=1";



$strPage=$_POST['Page'];



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

$abc.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($con1,$abc);

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
 Records Per Page :<select name="perpg" id="perpg" onchange="a('1','perpg');">

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
 
 
<!--=================================================-->


</div></br>

  <table border="1" style="margin-top:30px"  width="100%">
  <tr>
      
         <th>Sr</th>
    <!--<th>batter_serial_no</th>-->
    <th>batteryVendorName</th>
    <th>Mobile</th>
    <!--<th>email</th>-->
      
    <th>Edit</th>
  
  </tr>

  <?php  while($row = mysqli_fetch_array($qrys)) {
  
  $result3=mysqli_query($con1,"select * from UpdateStatus where brf_id='$row[1]' order by currentdate desc ");
$fetchBrf_id=mysqli_fetch_array($result3);
  
  
   ?>
  
 <tr style="background-color:#cfe8c7">
    <td><?php echo $sr;?></td>
    <!--<td><?php echo $row["batter_serial_no"];?></td>-->
    <td><?php echo $row["batteryVendorName"];?></td>
    <td><?php echo $row["Mobile"];?></td>
    <td><?php echo $row["email"];?></td>
    

   <!--<td><?php
if($row['statu']=="") {
?><a href="Edit_brfform.php?ticketno=<?php echo $row["Call_Ticket"];?> ">&nbsp;<font color="red" >Edit</font></a><?php }
 ?></td>-->
    
  
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







