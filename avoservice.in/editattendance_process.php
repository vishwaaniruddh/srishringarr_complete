<?php
 session_start();
include 'config.php';
include("access.php");

$fix=10;
$Branch=$_POST['Branch'];
$Department=$_POST['Department'];
$Employee_name=$_POST['Employee_name'];
$Employee_code=$_POST['Employee_code'];
$from=$_POST['from'];

if($_POST['from'] ==''){
  echo "Please select Date ";
  
  die;
}
 


$brch=mysqli_query($con1,"select name from avo_branch where id='".$_SESSION['branch']."'");
$brname=mysqli_fetch_array($brch);
//echo $_SESSION['branch'];

if($_SESSION['branch']=="all"){
$abc="select * from Attendance where date='".$from."'" ; 

}else{

$abc="select * from Attendance where date='".$from."' and branch='".$brname[0]."'" ;

}
if(isset($_POST['Branch']) && $_POST['Branch'] !=''){
   $abc .=" and branch='".$Branch."' " ;
}

if(isset($_POST['Employee_name']) && $_POST['Employee_name'] !=''){
   $abc .=" and empName like '%".$Employee_name."%' " ;
}
if(isset($_POST['Employee_code']) && $_POST['Employee_code'] !=''){
   $abc .=" and empcode='".$Employee_code."' " ;
}
 
// echo $abc;

$strPage=$_POST['Page'];


?>
<?php



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
      
         <!--<th>Sr</th>-->
    <th>Sr No</th>
    <th>EmployeeName</th>
    <th>empcode</th>
       <th>department</th>
      <th>branch</th>
      <th>Attendance</th>
	   
    
    <th>Edit</th>
   

  </tr>

  <?php  while($row = mysqli_fetch_row($qrys)) {
  
 ?>
  
 <tr style="background-color:#cfe8c7">
    

    <td><?php echo $sr;?></td>
    <td><?php echo $row[2];?></td>
    <td><?php echo $row[4];?></td>
    <td><?php echo $row[5];?></td>
      <td><?php echo $row[9];?></td>
    <td><?php echo $row[6];?></td>
    
    
    
    <td><input type="button" value="edit"  onclick='window.location.href="vieweditattendance.php?ids=<?php echo $row[0];?>"'/></td>
    
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







